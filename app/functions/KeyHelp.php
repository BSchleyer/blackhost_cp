<?php

$keyhelp = new KeyHelp();
class KeyHelp extends Controller {

    protected $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client([
            'allow_redirect' => false,
            'timeout' => 15,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-API-Key' => env('KEYHELP_API_KEY'),
            ]
        ]);
    }

    public function getPrice($planName) {
        $SQL = self::db()->prepare("SELECT * FROM `webspace_packs` WHERE `keyhelp_id` = :keyhelp_id");
        $SQL->execute(array(":keyhelp_id" => $planName));
        if($SQL->rowCount() == 1){
            $response = $SQL->fetch(PDO::FETCH_ASSOC);
            return $response['price'];
        } else {
            return false;
        }
    }

    public function getName($planName)
    {
        $SQL = self::db()->prepare("SELECT * FROM `webspace_packs` WHERE `keyhelp_id` = :keyhelp_id");
        $SQL->execute(array(":keyhelp_id" => $planName));
        if($SQL->rowCount() == 1){
            $response = $SQL->fetch(PDO::FETCH_ASSOC);
            return $response['name'];
        } else {
            return false;
        }
    }

    public function getPlanId($planName) {
        $SQL = self::db()->prepare("SELECT * FROM `webspace_packs` WHERE `keyhelp_id` = :keyhelp_id");
        $SQL->execute(array(":keyhelp_id" => $planName));
        if($SQL->rowCount() == 1){
            $response = $SQL->fetch(PDO::FETCH_ASSOC);
            return $response['keyhelp_id'];
        } else {
            return false;
        }
    }

    public function getServer() {
        try {
            $response = $this->client->get(
                '' . env('KEYHELP_URL') . '/server'
            );

            return json_decode((string) $response->getBody());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getHostingPlans() {
        try {
            $response = $this->client->get(
                '' . env('KEYHELP_URL') . '/hosting-plans'
            );

            return json_decode((string) $response->getBody());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getClient($user_id) {
        try {
            $response = $this->client->get(
                '' . env('KEYHELP_URL') . '/clients/' . $user_id
            );

            $body = json_decode((string) $response->getBody());

            return $body;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function createUser($username, $email, $password, $hosting_plan, $client_id) {
        try {
            $response = $this->client->post(
                '' . env('KEYHELP_URL') . '/clients',

                [
                    'json' => [
                        'username' => $username,
                        'email' => $email,
                        'password' => $password,
                        'id_hosting_plan' => $hosting_plan,
                        'is_suspended' => false,
                        'suspend_on' => null,
                        'delete_on' => null,
                        'send_login_credentials' => true,
                        'create_system_domain' => true,
                        'contact_data' => [
                            'client_id' => $client_id
                        ]
                    ]
                ]
            );

            $body = json_decode((string) $response->getBody());

            return $body;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function suspendUser($user_id) {
        try {
            $response = $this->client->put(
                '' . env('KEYHELP_URL') . '/clients/' . $user_id,

                [
                    'json' => [
                        'is_suspended' => true,
                    ]
                ]
            );

            $body = json_decode((string) $response->getBody());

            return $body;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function unsuspendUser($user_id) {
        try {
            $response = $this->client->put(
                '' . env('KEYHELP_URL') . '/clients/' . $user_id,

                [
                    'json' => [
                        'is_suspended' => false,
                    ]
                ]
            );

            $body = json_decode((string) $response->getBody());

            return $body;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteUser($user_id) {
        try {
            $response = $this->client->delete(
                '' . env('KEYHELP_URL') . '/clients/' . $user_id
            );

            $body = json_decode((string) $response->getBody());

            return $body;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getTraffic($user_id) {
        try {
            $response = $this->client->get(
                '' . env('KEYHELP_URL') . '/clients/' . $user_id . '/traffic'
            );

            $body = json_decode((string) $response->getBody());

            return $body;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getStats($user_id) {
        try {
            $response = $this->client->get(
                '' . env('KEYHELP_URL') . '/clients/' . $user_id . '/stats'
            );

            $body = json_decode((string) $response->getBody());

            return $body;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getResources($user_id) {
        try {
            $response = $this->client->get(
                '' . env('KEYHELP_URL') . '/clients/' . $user_id . '/resources'
            );

            $body = json_decode((string) $response->getBody());

            return $body;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function login($user_id) {
        try {
            $response = $this->client->get(
                '' . env('KEYHELP_URL') . '/login/' . $user_id
            );

            $body = json_decode((string) $response->getBody());

            return $body->url;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}