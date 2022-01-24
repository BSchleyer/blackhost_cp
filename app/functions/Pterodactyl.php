<?php

$pterodactyl = new Pterodactyl();
class Pterodactyl extends Controller
{

    public function createUser($external_id, $username, $email, $first_name, $last_name, $password, $language = 'en')
    {
        $pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl(env('PTERODACTYL_API_KEY'), env('PTERODACTYL_BASE_URL'));

        try {
            $response = $pterodactyl->createUser([
                'external_id' => $external_id,
                'username' => $username,
                'email' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'password' => $password,
                'language' => $language
            ]);
            return $response;
        } catch(\HCGCloud\Pterodactyl\Exceptions\ValidationException $e){
            return $e->errors();
        }
    }

    public function create($name, $user, $egg_id, array $limits, array $feature_limits, $version_build)
    {
        $pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl(env('PTERODACTYL_API_KEY'), env('PTERODACTYL_BASE_URL'));

        $egg = $pterodactyl->egg(2, $egg_id);

        try {
            $response = $pterodactyl->createServer([
                'name' => $name,
                'user' => $user,
                'egg' => $egg_id,
                'limits' => $limits,
                'feature_limits' => $feature_limits,
                'docker_image' => $egg->dockerImage,
                'startup' => $egg->startup,
                'environment' => [
                    "SERVER_AUTOUPDATE" => '1',
                    "SERVER_JARFILE" => 'server.jar',
                    "VANILLA_VERSION" => $version_build,
                    "BUILD_NUMBER" => $version_build
                ],
                'deploy' => [
                    'locations' => [2],
                    'dedicated_ip' => false,
                    'port_range' => []
                ],
                'start_on_completion' => true,
            ]);

            return $response;
        } catch(\HCGCloud\Pterodactyl\Exceptions\ValidationException $e){
            return $e->errors();
        }
    }

    public function createCURSE($name, $user, $egg_id, array $limits, array $feature_limits, $version_build, $modpack)
    {
        $pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl(env('PTERODACTYL_API_KEY'), env('PTERODACTYL_BASE_URL'));

        $egg = $pterodactyl->egg(2, $egg_id);

        try {
            $response = $pterodactyl->createServer([
                'name' => $name,
                'user' => $user,
                'egg' => $egg_id,
                'limits' => $limits,
                'feature_limits' => $feature_limits,
                'docker_image' => $egg->dockerImage,
                'startup' => $egg->startup,
                'environment' => [
                    "SERVER_AUTOUPDATE" => '1',
                    "SERVER_JARFILE" => 'server.jar',
					"MODPACK_ID" => $modpack,
                    "MODPACK_VERSION" => $version_build
                ],
                'deploy' => [
                    'locations' => [2],
                    'dedicated_ip' => false,
                    'port_range' => []
                ],
                'start_on_completion' => true,
            ]);

            return $response;
        } catch(\HCGCloud\Pterodactyl\Exceptions\ValidationException $e){
            return $e->errors();
        }
    }

    public function createTS($name, $user, $egg_id, array $limits, array $feature_limits)
    {
        $pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl(env('PTERODACTYL_API_KEY'), env('PTERODACTYL_BASE_URL'));

        $egg = $pterodactyl->egg(8, $egg_id);

        try {
            $response = $pterodactyl->createServer([
                'name' => $name,
                'user' => $user,
                'egg' => $egg_id,
                'limits' => $limits,
                'feature_limits' => $feature_limits,
                'docker_image' => $egg->dockerImage,
                'startup' => $egg->startup,
                'environment' => [
                    "TS_VERSION" => 'latest',
                    "FILE_TRANSFER" => '30033',
                    "SERVER_AUTOUPDATE" => '1'
                ],
                'deploy' => [
                    'locations' => [2],
                    'dedicated_ip' => false,
                    'port_range' => []
                ],
                'start_on_completion' => true,
            ]);

            return $response;
        } catch(\HCGCloud\Pterodactyl\Exceptions\ValidationException $e){
            return $e->errors();
        }
    }


    public function createSINUS($name, $user, $password, array $limits, array $feature_limits)
    {
        $pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl(env('PTERODACTYL_API_KEY'), env('PTERODACTYL_BASE_URL'));

        $egg = $pterodactyl->egg(44, 449);

        try {
            $response = $pterodactyl->createServer([
                'name' => $name,
                'user' => $user,
                'egg' => 449,
                'limits' => $limits,
                'feature_limits' => $feature_limits,
                'docker_image' => $egg->dockerImage,
                'startup' => $egg->startup,
                'environment' => [
                    "OVERRIDE_PASSWORD" => $password
                ],
                'deploy' => [
                    'locations' => [2],
                    'dedicated_ip' => false,
                    'port_range' => []
                ],
                'start_on_completion' => true,
            ]);

            return $response;
        } catch(\HCGCloud\Pterodactyl\Exceptions\ValidationException $e){
            return $e->errors();
        }
    }

    public function createCSGO($name, $user, $egg_id, array $limits, array $feature_limits)
    {
        $pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl(env('PTERODACTYL_API_KEY'), env('PTERODACTYL_BASE_URL'));

        $egg = $pterodactyl->egg(0, $egg_id);

        try {
            $response = $pterodactyl->createServer([
                'name' => $name,
                'user' => $user,
                'egg' => $egg_id,
                'limits' => $limits,
                'feature_limits' => $feature_limits,
                'docker_image' => $egg->dockerImage,
                'startup' => $egg->startup,
                'environment' => [
                    "SERVER_AUTOUPDATE" => '1',
                    "SRCDS_MAP" => 'de_dust2',
                    "SRCDS_APPID" => '740'
                    //"STEAM_ACC" => '0'
                ],
                'deploy' => [
                    'locations' => [2],
                    'dedicated_ip' => false,
                    'port_range' => []
                ],
                'start_on_completion' => true,
            ]);

            return $response;
        } catch(\HCGCloud\Pterodactyl\Exceptions\ValidationException $e){
            return $e->errors();
        }
    }

    public function delete($serverId)
    {
        $pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl(env('PTERODACTYL_API_KEY'), env('PTERODACTYL_BASE_URL'));

        try {
            $pterodactyl->deleteServer($serverId);
        } catch(\HCGCloud\Pterodactyl\Exceptions\ValidationException $e){
            return $e->errors();
        }
    }

    public function updateBuild($serverId, array $limits, array $feature_limits, $allocation_id)
    {
        $pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl(env('PTERODACTYL_API_KEY'), env('PTERODACTYL_BASE_URL'));

//        $pterodactyl->updateServerDetails()

        try {
            $response = $pterodactyl->updateServerBuild($serverId, [
                'oom_disabled' => false,
                'allocation' => $allocation_id,
                'limits' => $limits,
                'feature_limits' => $feature_limits
            ]);

            return $response;
        } catch(\HCGCloud\Pterodactyl\Exceptions\ValidationException $e){
            return $e->errors();
        }
    }

    public function updateServer($serverId, array $limits, array $feature_limits, $allocation_id)
    {
        $pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl(env('PTERODACTYL_API_KEY'), env('PTERODACTYL_BASE_URL'));

        try {
            $response = $pterodactyl->updateServerBuild($serverId, [
                'oom_disabled' => false,
                'allocation' => $allocation_id,
                'limits' => $limits,
                'feature_limits' => $feature_limits
            ]);

            return $response;
        } catch(\HCGCloud\Pterodactyl\Exceptions\ValidationException $e){
            return $e->errors();
        }
    }

    public function suspend($serverId)
    {
        $pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl(env('PTERODACTYL_API_KEY'), env('PTERODACTYL_BASE_URL'));

        try {
            $pterodactyl->suspendServer($serverId);
        } catch(\HCGCloud\Pterodactyl\Exceptions\ValidationException $e){
            return $e->errors();
        }
    }

    public function unsuspend($serverId)
    {
        $pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl(env('PTERODACTYL_API_KEY'), env('PTERODACTYL_BASE_URL'));

        try {
            $pterodactyl->unsuspendServer($serverId);
        } catch(\HCGCloud\Pterodactyl\Exceptions\ValidationException $e){
            return $e->errors();
        }
    }

    public function reinstall($serverId)
    {
        $pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl(env('PTERODACTYL_API_KEY'), env('PTERODACTYL_BASE_URL'));

        try {
            $pterodactyl->reinstallServer($serverId);
        } catch(\HCGCloud\Pterodactyl\Exceptions\ValidationException $e){
            return $e->errors();
        }
    }

}