-- Demo-Daten für bhpanel1 (nur für Entwicklung/Test, nach dem Import von bhpanel1.sql ausführen)
-- Alle Demo-Accounts haben das Passwort: demo1234

INSERT INTO `users` (`id`, `username`, `email`, `password`, `state`, `role`, `amount`, `s_pin`, `legal_accepted`, `firstname`, `lastname`, `street`, `number`, `postcode`, `city`, `country`)
VALUES (1, 'demo_admin', 'admin@example.com', '$2y$10$iAd5W3mlBm2NjLzgxMf/t.zjl.gLegktW.WNJmmpcnIORa8J61Jae', 'active', 'admin', 100.00, '111111', 1, 'Alex', 'Admin', 'Musterstraße', '1', '12345', 'Berlin', 'Deutschland'),
       (2, 'demo_support', 'support@example.com', '$2y$10$iAd5W3mlBm2NjLzgxMf/t.zjl.gLegktW.WNJmmpcnIORa8J61Jae', 'active', 'support', 0.00, '222222', 1, 'Sam', 'Support', 'Musterstraße', '2', '12345', 'Berlin', 'Deutschland'),
       (3, 'demo_kunde', 'kunde@example.com', '$2y$10$iAd5W3mlBm2NjLzgxMf/t.zjl.gLegktW.WNJmmpcnIORa8J61Jae', 'active', 'customer', 25.50, '333333', 1, 'Max', 'Mustermann', 'Beispielweg', '3', '45894', 'Gelsenkirchen', 'Deutschland'),
       (4, 'demo_kunde2', 'kunde2@example.com', '$2y$10$iAd5W3mlBm2NjLzgxMf/t.zjl.gLegktW.WNJmmpcnIORa8J61Jae', 'pending', 'customer', 0.00, '444444', 0, 'Erika', 'Musterfrau', 'Testallee', '4', '80331', 'München', 'Deutschland');

INSERT INTO `news` (`id`, `icon`, `title`, `text`)
VALUES (1, 'fa-bullhorn', 'Willkommen im Panel', 'Dies ist eine Demo-Nachricht.'),
       (2, 'fa-wrench', 'Wartungsarbeiten', 'Am Wochenende gibt es kurze Wartungsfenster.');

INSERT INTO `codes` (`id`, `code`, `amount`, `useable`)
VALUES (1, 'DEMO5', 5.00, 10),
       (2, 'WELCOME10', 10.00, 5);

INSERT INTO `tickets` (`id`, `user_id`, `categorie`, `priority`, `title`, `state`, `last_msg`)
VALUES (1, 3, 'TECHNIK', 'MITTEL', 'Server nicht erreichbar', 'OPEN', 'CUSTOMER'),
       (2, 3, 'BUCHHALTUNG', 'NIEDRIG', 'Frage zur Rechnung', 'CLOSED', 'SUPPORT');

INSERT INTO `ticket_message` (`id`, `ticket_id`, `writer_id`, `message`)
VALUES (1, 1, 3, 'Mein Server antwortet seit heute Morgen nicht mehr.'),
       (2, 2, 3, 'Wo finde ich meine Rechnung?'),
       (3, 2, 2, 'Unter Buchhaltung > Rechnungen. Ticket wird geschlossen.');

INSERT INTO `transactions` (`id`, `user_id`, `gateway`, `state`, `amount`, `desc`, `tid`)
VALUES (1, 3, 'paypal', 'success', 30.00, 'Guthabenaufladung mit Paypal', 'DEMO-TXN-0001'),
       (2, 3, 'paysafecard', 'pending', 10.00, 'Guthabenaufladung mit paysafecard', 'DEMO-TXN-0002');

INSERT INTO `user_transactions` (`id`, `user_id`, `amount`, `desc`)
VALUES (1, 3, 30.00, 'Guthabenaufladung'),
       (2, 3, -4.50, 'Bestellung Webspace');
