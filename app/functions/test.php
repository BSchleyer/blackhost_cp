<?php

$user = new User();
class User extends Controller {

    // check if user exists
    public function exists($data) {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `email` = :email OR `username` = :username");
        $SQL->execute(array(":email" => $data, ":username" => $data));

        if($SQL->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    // check the state of the user
    public function getState($data) {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `email` = :email OR `username` = :username");
        $SQL->execute(array(":email" => $data, ":username" => $data));

        $data = $SQL->fetch(PDO::FETCH_ASSOC);

        return $data['state'];
    }

    public function getReason($data)
    {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `email` = :email OR `username` = :username");
        $SQL->execute(array(":email" => $data, ":username" => $data));
        $data = $SQL->fetch(PDO::FETCH_ASSOC);

        return $data['ban_reason'];
    }

    // check role of the user
    public function getRole($data) {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `email` = :email OR `username` = :username");
        $SQL->execute(array(":email" => $data, ":username" => $data));

        $data = $SQL->fetch(PDO::FETCH_ASSOC);

        if($data['role'] === 'customer') {
            return 'Kunde';
        }

        if($data['role'] === 'partner') {
            return 'Partner';
        }

        if($data['role'] === 'first') {
            return '1st-Level Support';
        }

        if($data['role'] === 'second') {
            return '2nd-Level Support';
        }

        if($data['role'] === 'third') {
            return '3rd-Level Support';
        }

        if($data['role'] === 'admin') {
            return 'Inhaber';
        }
    }

    // check if user verfied login by email
    public function verifyLoginEmail($data, $email) {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `email` = :email OR `username` = :username");
        $SQL->execute(array(":email" => $data, ":username" => $data));
        $data = $SQL->fetch(PDO::FETCH_ASSOC);

        if($email != $data['email']) {
            return true;
        } else {
            return false;
        }
    }

    // verify login
    public function verifyLogin($data, $password) {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `username` = :username OR `email` = :email");
        $SQL->execute(array(":email" => $data, ":username" => $data));

        $data = $SQL->fetch(PDO::FETCH_ASSOC);

        if(password_verify($password, $data['password'])) {
            return true;
        } else {
            return false;
        }
    }

    // generate session token
    public function generateSessionToken($data) {
        $session_token = Helper::generateRandomString(32);

        $SQL = self::db()->prepare("UPDATE `customers` SET `session_token` = :session_token WHERE `email` = :email OR `username` = :username");
        $SQL->execute(array(":session_token" => $session_token, ":email" => $data, ":username" => $data));

        return $session_token;
    }

    // create user
    public function create($username, $email, $password, $state = 'pending', $role = 'customer') {
        $cost = 10;
        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => $cost]);

        $db = self::db();
        $SQL = $db->prepare("INSERT INTO `customers`(`username`, `email`, `password`, `state`, `role`) VALUES (?,?,?,?,?)");
        $SQL->execute(array($username, $email, $hash, $state, $role));

        return $db->lastInsertId();
    }

    // logged in check
    public function loggedIn($session_token = null) {
        if(is_null($session_token)) {
            return false;
        } else {
            return $this->sessionExists($session_token);
        }
    }

    // check if session exists
    public function sessionExists($session_token) {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `session_token` = :session_token");
        $SQL->execute(array(":session_token" => $session_token));

        if($SQL->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    // get user data by session
    public function getDataBySession($session_token, $data) {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `session_token` = :session_token");
        $SQL->execute(array(":session_token" => $session_token));

        $response = $SQL->fetch(PDO::FETCH_ASSOC);

        return $response[$data];
    }

    // get user data by id
    public function getDataById($id, $data) {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `id` = :id");
        $SQL->execute(array(":id" => $id));

        $response = $SQL->fetch(PDO::FETCH_ASSOC);

        return $response[$data];
    }

    // get user data by username
    public function getDataByUsername($username, $data) {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `username` = :username");
        $SQL->execute(array(":username" => $username));

        $response = $SQL->fetch(PDO::FETCH_ASSOC);

        return $response[$data];
    }

    // get user data
    public function getDataByLogin($user_data, $data) {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `username` = :username OR `email` = :email");
        $SQL->execute(array(":username" => $user_data, ":email" => $user_data));

        $response = $SQL->fetch(PDO::FETCH_ASSOC);

        return $response[$data];
    }

    // get user data by email
    public function getDataByEmail($email, $data) {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `email` = :id");
        $SQL->execute(array(":id" => $email));

        $response = $SQL->fetch(PDO::FETCH_ASSOC);

        return $response[$data];
    }

    // check if user is partner
    public function isPartner($session_token) {
        $role = User::getDataBySession($session_token, 'role');

        if($role == 'admin') {
            return true;
        } elseif($role == 'partner') {
            return true;
        } else {
            return false;
        }
    }

    // check if user in team
    public function isAdmin($session_token) {
        $role = User::getDataBySession($session_token, 'role');

        if($role == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    // check if user in team
    public function isInTeam($session_token) {
        $role = User::getDataBySession($session_token, 'role');

        if($role == 'admin') {
            return true;
        } elseif($role == 'third') {
            return true;
        } elseif($role == 'second') {
            return true;
        } elseif($role == 'first') {
            return true;
        } else {
            return false;
        }
    }

    // check if user is first level
    public function isFirst($session_token) {
        $role = User::getDataBySession($session_token, 'role');

        if($role == 'admin') {
            return true;
        } elseif($role == 'first') {
            return true;
        } else {
            return false;
        }
    }

    // check if user is second level
    public function isSecond($session_token) {
        $role = User::getDataBySession($session_token, 'role');

        if($role == 'admin') {
            return true;
        } elseif($role == 'second') {
            return true;
        } else {
            return false;
        }
    }

    // check if user is third level
    public function isThird($session_token) {
        $role = User::getDataBySession($session_token, 'role');

        if($role == 'admin') {
            return true;
        } elseif($role == 'third') {
            return true;
        } else {
            return false;
        }
    }

    // check os of the user
    public function getOS($user_agent)
    {
        $os_platform  = "Unbekannt";

        $os_array = array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($os_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $os_platform = $value;

        return $os_platform;
    }

    public function addOrder($user_id, $amount, $desc) {
        $SQL = self::db()->prepare("INSERT INTO `customer_transactions` (`user_id`, `amount`, `desc`) VALUES (:user_id, :amount, :desc)");
        $SQL->execute(array(":user_id" => $user_id, ":amount" => $amount, ":desc" => $desc));
    }

    // get ip address of the user
    public function getIP()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe

                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }

    // get agent of the user
    public function getAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    // get location of the user
    public function getLocation() {
        $ip = $this->getIP();
        $location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));

        $city = $location["geoplugin_city"];
        $region = $location["geoplugin_region"];
        $country = $location["geoplugin_countryName"];

        $end = '' . $city . ' (' . $region . ', ' . $country . ')';

        return $end;
    }

    // get partner count
    public function partnerCount() {
        $count = 0;

        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `role` = 'parnter'");
        $SQL->execute();
        $count = $count + $SQL->rowCount();

        return $count;

    }

    // get team count
    public function teamCount() {
        $count = 0;

        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `role` = :role");
        $SQL->execute(array(":role" => 'first' && 'second' && 'third' and 'admin'));

        $count = $count + $SQL->rowCount();

        return $count;
    }

    // get ticket count
    public function ticketCountMax($user_id) {
        $count = 0;

        $SQL = self::db()->prepare("SELECT * FROM `support_tickets` WHERE `user_id` = :user_id AND `state` = :state");
        $SQL->execute(array(":user_id" => $user_id, ":state" => 'OPEN'));
        $count = $count + $SQL->rowCount();

        $SQL2 = self::db()->prepare("SELECT * FROM `support_tickets` WHERE `user_id` = :user_id AND `state` = :state");
        $SQL2->execute(array(":user_id" => $user_id, ":state" => 'PROCESSING'));
        $count = $count + $SQL2->rowCount();

        return $count;
    }

    // add money to user
    public function addMoney($money, $user_id) {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `id` = :id");
        $SQL->execute(array(":id" => $user_id));
        $userData = $SQL->fetch(PDO::FETCH_ASSOC);

        $newUserMoney = $userData['amount'] + $money;
        $updateUserMoney = self::db()->prepare("UPDATE `customers` SET `amount` = :newUserMoney WHERE `id` = :user_id");
        $updateUserMoney->execute(array(":newUserMoney" => $newUserMoney, ":user_id" => $user_id));

    }

    // remove money from user
    public function removeMoney($money, $user_id)
    {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `id` = :id");
        $SQL->execute(array(":id" => $user_id));
        $userData = $SQL->fetch(PDO::FETCH_ASSOC);

        $newUserMoney = $userData['amount'] - $money;
        $updateUserMoney = self::db()->prepare("UPDATE `customers` SET `amount` = :newUserMoney WHERE `id` = :user_id");
        $updateUserMoney->execute(array(":newUserMoney" => $newUserMoney, ":user_id" => $user_id));

    }

    // get service count
    public function serviceCount($user_id) {
        $count = 0;

        // select all teamspeak server from this user
        $SQL = self::db()->prepare("SELECT * FROM `teamspeak_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL->execute(array(":user_id" => $user_id));
        $count = $count + $SQL->rowCount();

        // select all gameserver from this user
        $SQL2 = self::db()->prepare("SELECT * FROM `gamecloud_clouds` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL2->execute(array(":user_id" => $user_id));
        $count = $count + $SQL2->rowCount();

        // select all gameserver from this user
        $SQL2 = self::db()->prepare("SELECT * FROM `game_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL2->execute(array(":user_id" => $user_id));
        $count = $count + $SQL2->rowCount();

        // select all lxc servers from this user
        $SQL3 = self::db()->prepare("SELECT * FROM `lxc_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL3->execute(array(":user_id" => $user_id));
        $count = $count + $SQL3->rowCount();

        // select all kvm servers from this user
        $SQL4 = self::db()->prepare("SELECT * FROM `kvm_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL4->execute(array(":user_id" => $user_id));
        $count = $count + $SQL4->rowCount();

        // select all webspace from this user
        $SQL5 = self::db()->prepare("SELECT * FROM `webspaces` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL5->execute(array(":user_id" => $user_id));
        $count = $count + $SQL5->rowCount();

        // select all domains from this user
        $SQL6 = self::db()->prepare("SELECT * FROM `domains` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL6->execute(array(":user_id" => $user_id));
        $count = $count + $SQL6->rowCount();

        // select all discord bot hostings from this user
        $SQL7 = self::db()->prepare("SELECT * FROM `discord_bots` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL7->execute(array(":user_id" => $user_id));
        $count = $count + $SQL7->rowCount();

        // select all dedicated servers from this user
        $SQL8 = self::db()->prepare("SELECT * FROM `dedicated_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL8->execute(array(":user_id" => $user_id));
        $count = $count + $SQL8->rowCount();

        // select all plesk licenses from this user
        $SQL9 = self::db()->prepare("SELECT * FROM `plesk_licenses` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL9->execute(array(":user_id" => $user_id));
        $count = $count + $SQL9->rowCount();

        return $count;

    }

    // get product count
    public function activeProducts() {
        $count = 0;

        // select all teamspeak server from this user
        $SQL = self::db()->prepare("SELECT * FROM `teamspeak_servers` WHERE `deleted_at` IS NULL AND `state` = 'active'");
        $SQL->execute();
        $count = $count + $SQL->rowCount();

        // select all game_clouds
        $SQL112 = self::db()->prepare("SELECT * FROM `game_clouds`  WHERE `deleted_at` IS NULL AND `state` = 'active'");
        $SQL112->execute();
        $count = $count + $SQL112->rowCount();

        // select all gameserver mc
        $SQL10 = self::db()->prepare("SELECT * FROM `gameserver_mc`  WHERE `deleted_at` IS NULL AND `state` = 'active'");
        $SQL10->execute();
        $count = $count + $SQL10->rowCount();

        // select all sinusbots
        $SQL11 = self::db()->prepare("SELECT * FROM `sinusbots`  WHERE `deleted_at` IS NULL AND `state` = 'active'");
        $SQL11->execute();
        $count = $count + $SQL11->rowCount();


        // select all gameserver from this user
        $SQL2 = self::db()->prepare("SELECT * FROM `game_servers` WHERE `deleted_at` IS NULL AND `state` = 'active'");
        $SQL2->execute();
        $count = $count + $SQL2->rowCount();

        // select all lxc servers from this user
        $SQL3 = self::db()->prepare("SELECT * FROM `lxc_servers` WHERE `deleted_at` IS NULL AND `state` = 'active'");
        $SQL3->execute();
        $count = $count + $SQL3->rowCount();

        // select all kvm servers from this user
        $SQL4 = self::db()->prepare("SELECT * FROM `kvm_servers` WHERE `deleted_at` IS NULL AND `state` = 'active'");
        $SQL4->execute();
        $count = $count + $SQL4->rowCount();

        // select all webspace from this user
        $SQL5 = self::db()->prepare("SELECT * FROM `webspaces` WHERE `deleted_at` IS NULL AND `state` = 'active'");
        $SQL5->execute();
        $count = $count + $SQL5->rowCount();

        // select all domains from this user
        $SQL6 = self::db()->prepare("SELECT * FROM `domains` WHERE `deleted_at` IS NULL AND `state` = 'active'");
        $SQL6->execute();
        $count = $count + $SQL6->rowCount();

        // select all discord bot hostings from this user
        $SQL7 = self::db()->prepare("SELECT * FROM `discord_bots` WHERE `deleted_at` IS NULL AND `state` = 'active'");
        $SQL7->execute();
        $count = $count + $SQL7->rowCount();

        // select all dedicated servers from this user
        $SQL8 = self::db()->prepare("SELECT * FROM `dedicated_servers` WHERE `deleted_at` IS NULL AND `state` = 'active'");
        $SQL8->execute();
        $count = $count + $SQL8->rowCount();

        // select all services from this user
        $SQL9 = self::db()->prepare("SELECT * FROM `services` WHERE `deleted_at` IS NULL AND `state` = 'active'");
        $SQL9->execute();
        $count = $count + $SQL9->rowCount();

        return $count;
    }

    // customer count
    public function customerCount() {
        $SQL = self::db()->prepare("SELECT * FROM `customers`");
        $SQL->execute();

        return $SQL->rowCount();
    }

    // ticket count
    public function ticketCount() {
        $SQL = self::db()->prepare("SELECT * FROM `support_tickets`");
        $SQL->execute();

        return $SQL->rowCount();
    }

    // ticket messages count
    public function ticketMessagesCount() {
        $SQL = self::db()->prepare("SELECT * FROM `support_tickets_messages`");
        $SQL->execute();

        return $SQL->rowCount();
    }

    // teamspeak count
    public function teamspeakCount($user_id) {
        $SQL = self::db()->prepare("SELECT * FROM `teamspeak_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL->execute(array(":user_id" => $user_id));

        return $SQL->rowCount();
    }

    // gameserver count
    public function gameserverCount($user_id) {
        $SQL = self::db()->prepare("SELECT * FROM `game_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL->execute(array(":user_id" => $user_id));

        return $SQL->rowCount();
    }

    // lxc server count
    public function lxcCount($user_id) {
        $SQL = self::db()->prepare("SELECT * FROM `lxc_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL->execute(array(":user_id" => $user_id));

        return $SQL->rowCount();
    }

    // kvm server count
    public function kvmCount($user_id) {
        $SQL = self::db()->prepare("SELECT * FROM `kvm_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL->execute(array(":user_id" => $user_id));

        return $SQL->rowCount();
    }

    // webspace count
    public function webspaceCount($user_id) {
        $SQL = self::db()->prepare("SELECT * FROM `webspaces` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL->execute(array(":user_id" => $user_id));

        return $SQL->rowCount();
    }

    // domain count
    public function domainCount($user_id) {
        $SQL = self::db()->prepare("SELECT * FROM `domains` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL->execute(array(":user_id" => $user_id));

        return $SQL->rowCount();
    }

    // discord bot count
    public function discordBotCount($user_id) {
        $SQL = self::db()->prepare("SELECT * FROM `discord_bots` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL->execute(array(":user_id" => $user_id));

        return $SQL->rowCount();
    }

    // dedicated count
    public function dedicatedCount($user_id) {
        $SQL = self::db()->prepare("SELECT * FROM `dedicated_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL->execute(array(":user_id" => $user_id));

        return $SQL->rowCount();
    }

    // get open tickets
    public function getOpenTickets($user_id, $state = 'OPEN' && 'PROCESSING') {
        $SQL = self::db()->prepare("SELECT * FROM `support_tickets` WHERE `user_id` = :user_id AND `state` = :state");
        $SQL->execute(array(":user_id" => $user_id, ":state" => $state));

        return $SQL->rowCount();
    }

    // get monthly costs
    public function getMonthlyCosts($user_id) {

        $costs = 0.00;

        // select all teamspeakservers from this user
        $SQL = self::db()->prepare("SELECT * FROM `teamspeak_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL->execute(array(":user_id" => $user_id));

        if($SQL->rowCount() != 0) {
            while($row = $SQL->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['price'];
            }
        }

        // select all game_clouds
        $SQL10 = self::db()->prepare("SELECT * FROM `gamecloud_clouds`WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL10->execute();
        if($SQL10->rowCount() != 0) {
            while($row = $SQL10->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['price'];
            }
        }

        // select all gameserver mc
        $SQL11 = self::db()->prepare("SELECT * FROM `gameserver_mc` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL11->execute();
        if($SQL->rowCount() != 0) {
            while($row = $SQL11->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['price'];
            }
        }

        // select all sinusbots
        $SQL12 = self::db()->prepare("SELECT * FROM `sinusbots` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL12->execute();
        if($SQL12->rowCount() != 0) {
            while($row = $SQL12->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['price'];
            }
        }

        // select all gameserver from this user
        $SQL2 = self::db()->prepare("SELECT * FROM `game_servers` WHERE `deleted_at` IS NULL AND `state` = 'active'");
        $SQL2->execute();
        if($SQL->rowCount() != 0) {
            while($row = $SQL->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['price'];
            }
        }

        // select all lxc servers from this user
        $SQL3 = self::db()->prepare("SELECT * FROM `lxc_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL3->execute(array(":user_id" => $user_id));

        if($SQL3->rowCount() != 0) {
            while($row = $SQL3->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['price'];
            }
        }

        // select all kvm servers from this user
        $SQL4 = self::db()->prepare("SELECT * FROM `kvm_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL4->execute(array(":user_id" => $user_id));

        if($SQL4->rowCount() != 0) {
            while($row = $SQL4->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['price'];
            }
        }

        // select all dedicated servers from this user
        $SQL5 = self::db()->prepare("SELECT * FROM `dedicated_servers` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL5->execute(array(":user_id" => $user_id));

        if($SQL5->rowCount() != 0) {
            while($row = $SQL5->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['price'];
            }
        }

        // select all plesk licenses from this user
        $SQL6 = self::db()->prepare("SELECT * FROM `plesk_licenses` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL6->execute(array(":user_id" => $user_id));

        if($SQL6->rowCount() != 0) {
            while($row = $SQL6->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['price'];
            }
        }

        // select all webspaces from this user
        $SQL7 = self::db()->prepare("SELECT * FROM `webspaces` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL7->execute(array(":user_id" => $user_id));

        if($SQL7->rowCount() != 0) {
            while($row = $SQL7->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['price'];
            }
        }

        // select all tekbase licenses from this user
        /*$SQL7 = self::db()->prepare("SELECT * FROM `tekbase_licenses` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL7->execute(array(":user_id" => $user_id));

        if($SQL7->rowCount() != 0) {
            while($row = $SQL7->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['price'];
            }
        }*

        // select all domains from this user
        $SQL8 = self::db()->prepare("SELECT * FROM `domains` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL8->execute(array(":user_id" => $user_id));

        if($SQL8->rowCount() != 0) {
            while($row = $SQL8->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['price'] / 12;
            }
        }*

        // select all discord bot hostings from this user
        $SQL9 = self::db()->prepare("SELECT * FROM `discord_bots` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL9->execute(array(":user_id" => $user_id));

        if($SQL9->rowCount() != 0) {
            while($row = $SQL9->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['price'];
            }
        }*/

        return number_format($costs, 2);
    }

    // get data by affiliate id
    public function getDataByAffiliateId($id, $data) {
        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `affiliate_id` = affiliate_id");
        $SQL->execute(array(":affiliate_id" => $id));

        $response = $SQL->fetch(PDO::FETCH_ASSOC);

        return $response[$data];
    }

    // renew support pin function
    public function renewSupportPin($userid, $token = null) {

        if(is_null($token)) {
            $token = env('SUPPORT_PIN_SHORT') . '-' . Helper::generateRandomString(6, '01234567890');
        }

        $SQL = self::db()->prepare("UPDATE `customers` SET `support_pin` = :support_pin WHERE `id` = :id");
        $SQL->execute(array(":id" => $userid, ":support_pin" => $token));

        return $token;
    }

    // generate id for bank charge
    public function bankCharge($tokenTwo = null)
    {
        if(is_null($tokenTwo)){
            $tokenTwo = Helper::generateRandomString(6,'1234567890');
        }

        // datenbank bank_id festlegung

        return $tokenTwo;
    }

    // validate the support pin
    public function validateSpin($s_pin)
    {
        $SQL = self::db()->prepare('SELECT * FROM `customers` WHERE `s_pin` = :s_pin');
        $SQL->execute(array(":s_pin" => $s_pin,));
        if ($SQL->rowCount() == 1) {
            $userData = $SQL -> fetch(PDO::FETCH_ASSOC);
            return $userData['id'];
        } else {
            return 0;
        }
    }

    // log the logins from user
    public function logLogin($user_id, $user_addr, $user_agent, $user_location)
    {
        $SQL = self::db()->prepare("INSERT INTO `login_logs`(`user_id`, `user_addr`, `user_agent`, `user_location`) VALUES (?,?,?,?)");
        $SQL->execute(array($user_id, $user_addr, $user_agent, $user_location));
    }

    // log user audit log
    public function logAudit($user_id, $product_id, $product, $task) {
        $SQL = self::db()->prepare("INSERT INTO `audit_log` (`user_id`, `product_id`, `product`, `task`) VALUES (?,?,?,?)");
        $SQL->execute(array($user_id, $product_id, $product, $task));
    }

    // get amount of charges
    public function getAllCharges($userid) {
        $costs = 0.00;

        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `id` = :user_id");
        $SQL->execute(array(":user_id" => $userid));
        $data = $SQL->fetch(PDO::FETCH_ASSOC);

        $SQL2 = self::db()->prepare("SELECT * FROM `customers_charge_transactions` WHERE `user_id` = :user_id AND `state` = :state");
        $SQL2->execute(array(":user_id" => $data['id'], ":state" => 'success'));
        if($SQL2->rowCount() != 0) {
            while($row = $SQL2->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['amount'];
            }
        }

        return number_format($costs, 2);
    }

    // count of charges
    public function getCountCharges($userid) {
        $count = 0;

        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `id` = :user_id");
        $SQL->execute(array(":user_id" => $userid));
        $data = $SQL->fetch(PDO::FETCH_ASSOC);

        $SQL2 = self::db()->prepare("SELECT * FROM `customers_charge_transactions` WHERE `user_id` = :user_id AND `state` = :state");
        $SQL2->execute(array(":user_id" => $data['id'], ":state" => 'success'));
        $count = $count + $SQL2->rowCount();

        return $count;

    }

    // all orders and co
    public function getAllTransactions($userid) {
        $costs = 0.00;

        $SQL = self::db()->prepare("SELECT * FROM `customers` WHERE `id` = :user_id");
        $SQL->execute(array(":user_id" => $userid));
        $data = $SQL->fetch(PDO::FETCH_ASSOC);

        $SQL2 = self::db()->prepare("SELECT * FROM `customer_transactions` WHERE `user_id` = :user_id");
        $SQL2->execute(array(":user_id" => $data['id']));
        if($SQL2->rowCount() != 0) {
            while($row = $SQL2->fetch(PDO::FETCH_ASSOC)) {
                $costs = $costs + $row['amount'];
            }
        }

        return number_format($costs, 2);
    }

    // get count of tickets
    public function getCountTickets($user_id) {
        $count = 0;

        $SQL = self::db()->prepare("SELECT * FROM `support_tickets` WHERE `user_id` = :user_id");
        $SQL->execute(array(":user_id" => $user_id));
        $count = $count + $SQL->rowCount();

        return $count;
    }

    // get product count
    public function getProductCount($user_id) {
        $count = 0;

        // select all teamspeak server from this user
        $SQL = self::db()->prepare("SELECT * FROM `teamspeak_servers` WHERE `user_id` = :user_id");
        $SQL->execute(array(":user_id" => $user_id));
        $count = $count + $SQL->rowCount();

        // select all game_clouds
        $SQL10 = self::db()->prepare("SELECT * FROM `game_clouds` WHERE `user_id` = :user_id");
        $SQL10->execute(array(":user_id" => $user_id));
        $count = $count + $SQL10->rowCount();

        // select all gameserver mc
        $SQL10 = self::db()->prepare("SELECT * FROM `gameserver_mc` WHERE `user_id` = :user_id");
        $SQL10->execute(array(":user_id" => $user_id));
        $count = $count + $SQL10->rowCount();

        // select all sinusbots
        $SQL11 = self::db()->prepare("SELECT * FROM `sinusbots` WHERE `user_id` = :user_id");
        $SQL11->execute(array(":user_id" => $user_id));
        $count = $count + $SQL11->rowCount();

        // select all gameserver from this user
        $SQL2 = self::db()->prepare("SELECT * FROM `game_servers` WHERE `user_id` = :user_id");
        $SQL2->execute(array(":user_id" => $user_id));
        $count = $count + $SQL2->rowCount();

        // select all lxc servers from this user
        $SQL3 = self::db()->prepare("SELECT * FROM `lxc_servers` WHERE `user_id` = :user_id");
        $SQL3->execute(array(":user_id" => $user_id));
        $count = $count + $SQL3->rowCount();

        // select all kvm servers from this user
        $SQL4 = self::db()->prepare("SELECT * FROM `kvm_servers` WHERE `user_id` = :user_id");
        $SQL4->execute(array(":user_id" => $user_id));
        $count = $count + $SQL4->rowCount();

        // select all webspace from this user
        $SQL5 = self::db()->prepare("SELECT * FROM `webspaces` WHERE `user_id` = :user_id");
        $SQL5->execute(array(":user_id" => $user_id));
        $count = $count + $SQL5->rowCount();

        // select all domains from this user
        $SQL6 = self::db()->prepare("SELECT * FROM `domains` WHERE `user_id` = :user_id");
        $SQL6->execute(array(":user_id" => $user_id));
        $count = $count + $SQL6->rowCount();

        // select all discord bot hostings from this user
        $SQL7 = self::db()->prepare("SELECT * FROM `discord_bots` WHERE `user_id` = :user_id");
        $SQL7->execute(array(":user_id" => $user_id));
        $count = $count + $SQL7->rowCount();

        // select all dedicated servers from this user
        $SQL8 = self::db()->prepare("SELECT * FROM `dedicated_servers` WHERE `user_id` = :user_id");
        $SQL8->execute(array(":user_id" => $user_id));
        $count = $count + $SQL8->rowCount();

        // select all services
        $SQL9 = self::db()->prepare("SELECT * FROM `services` WHERE `user_id` = :user_id");
        $SQL9->execute(array(":user_id" => $user_id));
        $count = $count + $SQL9->rowCount();

        return $count;
    }

    // get count of logins
    public function getCountLogins($user_id) {
        $count = 0;

        $SQL = self::db()->prepare("SELECT * FROM `login_logs` WHERE `user_id` = :user_id");
        $SQL->execute(array(":user_id" => $user_id));
        $count = $count + $SQL->rowCount();

        return $count;
    }



}