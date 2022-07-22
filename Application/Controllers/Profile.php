<?php

namespace Application\Controllers\Profile;

require_once('Controller.php');

use Application\Controllers\Controller\Controller;
use Application\Controllers\User\User;

Class Profile extends Controller{


    public function showProfile(mixed $id, mixed $userInfos)
    {
        $rights = (new User)->getRightsById($id);

        if($rights[0]['id_rights'] === '42'){

            self::renderParams('ProfileAdmin',$userInfos);

        } elseif($rights[0]['id_rights'] === '2'){

            self::renderParams('ProfileSeller',$userInfos);

        } elseif($rights[0]['id_rights'] === '3') {

            self::renderParams('ProfileBuyer',$userInfos);
        }
    }

    public function showInfo(bool|array $userInfos, mixed $info)
    {
            self::renderParams($info,$userInfos);

    }
}
