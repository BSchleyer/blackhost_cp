<?php
$currPage = 'team_Support Pin Login';
include BASE_PATH.'app/controller/PageController.php';

if(isset($_POST['login'])){
    $error = null;

    if(empty($_POST['spin'])){
        $error = 'Bitte gebe einen Pin ein';
    }

    $validateSpin = $user->validateSpin($_POST['spin']);
    if($validateSpin == 0){
        $error = 'Der Pin ist ungültig';
    }

    if($user->getDataById($validateSpin,'role') == 'admin' || $user->getDataById($validateSpin,'role') == 'support'){
        $error = 'Du kannst dich nicht in diesen Account einloggen';
    }

    if(empty($error)){

        //$discord->callWebhook('Soeben hat sich '.$username.' mit einem Support Pin in den Account von '.$user->getDataById($validateSpin,'username').' eingeloggt');

        $uspin = $user->renewSupportPin($validateSpin);
        $uspin = str_replace('=','',base64_encode($uspin));

        header('Location: '.env('URL').'team/user/'.$uspin);
    } else {
        echo sendError($error);
    }
}
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">

            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-header-title">
                                Support Pin Login
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post">

                        <label>Support-Pin</label>
                        <input class="form-control" name="spin">
                        <br>
                        <button type="submit" name="login" class="btn btn-primary btn-block">Einloggen</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>