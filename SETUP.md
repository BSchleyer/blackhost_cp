# Setup-Anleitung – Black-Host CP

Diese Anleitung beschreibt, was installiert und konfiguriert werden muss, damit das Panel läuft.
Alle Variablen stammen aus der `.env` im Projektroot (geladen über `vlucas/phpdotenv` in `app/Kernel.php`).

---

## 1. Voraussetzungen

| Komponente | Hinweis |
|---|---|
| PHP | 7.4+ (getestet mit XAMPP/PHP 8.2); Erweiterungen: `pdo_mysql`, `curl`, `mbstring`, `openssl`, `json`, `gd` |
| MySQL / MariaDB | Datenbank im Charset `utf8` |
| Apache | `mod_rewrite` aktiv, `AllowOverride All` (die `public/.htaccess` enthält alle Routen) |
| Composer | zum Installieren der Abhängigkeiten |
| Cron / Scheduler | für die Queue-Worker (siehe Punkt 6) |

## 2. Abhängigkeiten installieren

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/blackhost_cp
composer install
```

Das Verzeichnis `vendor/` existiert nach dem Klonen nicht (steht in `.gitignore`). Ohne `composer install` bricht `public/index.php` ab.

## 3. Datenbank einrichten

1. Datenbank und Benutzer anlegen, z. B. in phpMyAdmin oder per CLI:
   ```sql
   CREATE DATABASE bhpanel1 CHARACTER SET utf8 COLLATE utf8_general_ci;
   CREATE USER 'bhpanel'@'localhost' IDENTIFIED BY 'SICHERES_PASSWORT';
   GRANT ALL PRIVILEGES ON bhpanel1.* TO 'bhpanel'@'localhost';
   ```
2. Schema importieren:
   ```bash
   mysql -u bhpanel -p bhpanel1 < bhpanel1.sql
   ```
3. Optional, nur für Entwicklung/Test: Demo-Daten importieren (`demo_data.sql`).
   - Accounts: `demo_admin`, `demo_support`, `demo_kunde`, `demo_kunde2`
   - Passwort aller Demo-Accounts: `demo1234`
   - **Niemals in Produktion importieren.**

Die Tabelle `settings` wird mit Standardwerten angelegt. Wichtig: `register = 0` (Registrierung ist standardmäßig **aus**), außerdem `captcha = hcaptcha`, `webspace_type = plesk`, `rootserver = venocix`. Zum Ändern direkt in der DB oder über das Team-Backend (`/team/system`).

## 4. Webserver

- **DocumentRoot muss auf `public/` zeigen** (nicht auf den Projektroot), sonst sind `.env`, `app/` und die SQL-Dateien öffentlich abrufbar.
- Die `.htaccess` setzt `RewriteBase /`. Läuft das Panel in einem Unterordner (z. B. `http://localhost/blackhost_cp/public/`), muss `RewriteBase` angepasst werden – oder besser: einen VirtualHost verwenden.

Beispiel VirtualHost (XAMPP, `httpd-vhosts.conf`):
```apache
<VirtualHost *:80>
    ServerName panel.local
    DocumentRoot "/Applications/XAMPP/xamppfiles/htdocs/blackhost_cp/public"
    <Directory "/Applications/XAMPP/xamppfiles/htdocs/blackhost_cp/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```
Dazu in `/etc/hosts`: `127.0.0.1 panel.local`.

## 5. `.env` konfigurieren

### 5.1 Pflicht (ohne diese startet das Panel nicht)

| Variable | Bedeutung |
|---|---|
| `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS` | Datenbankzugang (werden per `$dotenv->required()` erzwungen) |
| `URL` | Basis-URL des Panels **mit** abschließendem `/`, z. B. `https://panel.example.de/` (wird für alle Links genutzt) |
| `APP_NAME`, `APP_DOMAIN` | Name und Domain des Projekts (Titel, Mails, Texte) |
| `CDN_URL`, `PIC_URL` | Basis-URLs für Assets/Bilder (lokal: auf `URL` bzw. `URL`+`assets/` setzen) |
| `MAIN_COLOR` | Hauptfarbe (Hex-Wert, wie in der vorhandenen `.env`) |
| `CRONE_KEY` | Geheimer Schlüssel für die Cron-URLs. **Neu und zufällig setzen**, z. B. `openssl rand -hex 24` (nur `A-Za-z0-9-` erlaubt, siehe Routing-Regex) |
| `DEBUG` | `true` zeigt Whoops-Fehlerseiten. In Produktion `false`! |
| `VERSION_DATE` | Anzeige der Version/des Stands |

### 5.2 E-Mail (Registrierung, Passwort-Reset, Tickets)

```
MAIL_HOST=smtp.example.de
MAIL_PORT=587
MAIL_USERNAME=noreply@example.de
MAIL_PASSWORD=...
MAIL_NAME=Black-Host
EMAIL_PROJECT_NAME=Black-Host
```
Ohne SMTP können sich Nutzer weder aktivieren noch ihr Passwort zurücksetzen.

### 5.3 Captcha (Login/Registrierung)

Das Verfahren wird in der DB-Tabelle `settings.captcha` gewählt (`hcaptcha` oder `google`).
- hCaptcha: `H_CAPTCHA_SITE_KEY`, `H_CAPTCHA_SECRET_KEY` (https://dashboard.hcaptcha.com)
- Google reCAPTCHA: `GOOGLE_SECRET_KEY`

### 5.4 Zahlungen

- `PAYPAL_EMAIL` – PayPal-Empfängeradresse. Der IPN-Callback ist `public/paypal_ipn.php`; die URL `https://DEINE-DOMAIN/paypal_ipn.php` muss im PayPal-Konto als IPN-Benachrichtigungs-URL hinterlegt sein.

### 5.5 Benachrichtigungen

- `DISCORD_WEBHOOK_URL`, `DISCORD_AVATAR_URL`, `DISCORD_NAME` – Discord-Webhook für Tickets/Bestellungen
- `PUSHOVER_APP_KEY`, `PUSHOVER_USER_KEY` – Pushover (werden im Code verwendet, fehlen aber in der mitgelieferten `.env`; bei Bedarf ergänzen)

### 5.6 Produkt-Backends (nur die konfigurieren, die du verkaufst)

| Produkt | Variablen |
|---|---|
| Webspace (KeyHelp) | `KEYHELP_URL`, `KEYHELP_API_KEY`, `WEBSPACE_HOST_URL`, `WEBSPACE_HOST_PLAIN_URL`, `CUSTOM_WEBSPACE_SUBDOMAIN` |
| Webspace (Plesk) | Zugangsdaten stehen pro Host in der DB-Tabelle `webspace_host`; `settings.webspace_type = plesk` |
| Gameserver (Pterodactyl) | `PTERODACTYL_BASE_URL`, `PTERODACTYL_USER_URL`, `PTERODACTYL_API_KEY` |
| KVM / VPS (Proxmox) | `KVM_URL`, `KVM_MAIN_URL`; Nodes in der Tabelle `vm_host_nodes` |
| Rootserver (Venocix) | `VENOCIX_API_KEY`, `VENOCIX_API_TOKEN` (mit `settings.rootserver = venocix`) |
| DDoS-Schutz | `BOLTLAYER_API_KEY` |
| Nextcloud | `NEXTCLOUD_CREATE`, `NEXTCLOUD_DISABLE` |
| TeamSpeak | Hosts in `teamspeak_hosts`; optional Banner/Tooltip: `TEAMSPEAK_TOOLTIP_*`, `TEAMSPEAK_BANNER_*` |
| Externe API / Discord-Bot | `GLOBAL_API_KEY` (Zugriff auf `/api/v1/discord/...`) – **lang und zufällig wählen**, leer lassen = abschalten |

Leere Werte (`""`) für nicht genutzte Dienste sind in Ordnung.

## 6. Cronjobs

Alle Jobs rufen eine URL mit dem `CRONE_KEY` auf. Beispiel `crontab -e` (`DOMAIN` und `KEY` anpassen):

```cron
* * * * *     curl -s https://DOMAIN/crone/worker_queue/KEY   > /dev/null
*/5 * * * *   curl -s https://DOMAIN/crone/runtime_queue/KEY  > /dev/null
0 * * * *     curl -s https://DOMAIN/crone/traffic_queue/KEY  > /dev/null
0 0 * * *     curl -s https://DOMAIN/crone/daily/KEY          > /dev/null
```

| Job | Zweck |
|---|---|
| `worker_queue` | Arbeitet die `queue`-Tabelle ab (Provisionierung: Plesk/KeyHelp/VPS/Rootserver/Gameserver) |
| `runtime_queue` | Laufzeiten, Verlängerungen, Sperrungen, Löschungen |
| `traffic_queue` | Traffic-Auswertung der Server |
| `daily` | Tägliche Aufgaben |

Die Intervalle sind Empfehlungen – bei Bedarf anpassen.

## 7. Ersten Admin anlegen

Mit `demo_data.sql` existiert `demo_admin` / `demo1234` (nur Entwicklung).
Für Produktion: Account über `/register` anlegen (vorher `settings.register = 1` setzen), aktivieren, dann in der Tabelle `users` die Spalte `role` auf `admin` stellen (Rollen: `customer`, `support`, `admin`) und `s_pin` setzen (wird für den Team-Login benötigt). Danach `settings.register` wieder nach Bedarf zurücksetzen.

Produkte und Preise werden in den Tabellen `products`, `product_options`, `product_option_entries`, `product_prices` bzw. im Team-Bereich unter `/team/produkte/...` gepflegt.

## 8. Sicherheits-Checkliste vor dem Livegang

- [ ] **`.env` ist im Git-Repo eingecheckt** (trotz Eintrag in `.gitignore`, weil sie bereits getrackt war). Mit `git rm --cached .env` entfernen, `.env.example` ohne echte Werte einchecken und **alle bereits veröffentlichten Schlüssel/Passwörter rotieren** – sie stehen in der Git-Historie.
- [ ] `DEBUG=false`
- [ ] DocumentRoot = `public/`
- [ ] `CRONE_KEY` und `GLOBAL_API_KEY` neu generiert
- [ ] `DEBUG/index.php` nicht öffentlich erreichbar lassen (Route `/DEBUG` in `public/.htaccess` ggf. entfernen)
- [ ] `demo_data.sql` nicht importiert (bzw. Demo-Accounts gelöscht)
- [ ] HTTPS aktiv und `URL` auf `https://…/` gesetzt
- [ ] Datenbankbenutzer mit minimalen Rechten, nicht `root`
- [ ] Regelmäßige DB-Backups

## 9. Funktionstest

1. `http://panel.local/login` öffnen – Loginseite erscheint (bei weißer Seite: `DEBUG=true` setzen und Fehler lesen; meist fehlt `vendor/` oder DB-Zugang).
2. Mit Demo-/Admin-Account einloggen, Dashboard prüfen.
3. Testmail auslösen (Passwort vergessen).
4. Cron-URL manuell im Browser aufrufen; ohne korrekten Key darf nichts passieren.
