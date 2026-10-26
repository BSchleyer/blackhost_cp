<?php

$pterodactyl = new Pterodactyl();
class Pterodactyl extends Controller
{

    /**
     * Rejects non-numeric, negative or zero (= unlimited) resource limits.
     */
    private function assertLimits(array $limits, array $feature_limits)
    {
        foreach (['memory', 'disk', 'cpu'] as $key) {
            if (!isset($limits[$key]) || !ctype_digit((string) $limits[$key]) || (int) $limits[$key] < 1) {
                throw new \InvalidArgumentException('Invalid resource limit: ' . $key);
            }
        }
        foreach (['databases', 'backups'] as $key) {
            if (isset($feature_limits[$key]) && !ctype_digit((string) $feature_limits[$key])) {
                throw new \InvalidArgumentException('Invalid feature limit: ' . $key);
            }
        }
    }

    private function assertVersion($version_build)
    {
        if (!is_string($version_build) || !preg_match('/^[0-9A-Za-z._-]{1,32}$/', $version_build)) {
            throw new \InvalidArgumentException('Invalid version');
        }
    }

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
        $this->assertLimits($limits, $feature_limits);
        $this->assertVersion($version_build);
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
        $this->assertLimits($limits, $feature_limits);
        $this->assertVersion($version_build);
        $this->assertVersion($modpack);
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
        $this->assertLimits($limits, $feature_limits);
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
        $this->assertLimits($limits, $feature_limits);
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
        $this->assertLimits($limits, $feature_limits);
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
        $this->assertLimits($limits, $feature_limits);
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
        $this->assertLimits($limits, $feature_limits);
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