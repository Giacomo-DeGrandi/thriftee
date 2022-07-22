<?php

session_start();


require_once('Application/Lib/Token.php');
require_once('Application/Controllers/Signup.php');
require_once('Application/Controllers/Signin.php');


use Application\Controllers\Profile\Profile;
use Application\Controllers\User\User;
use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Header\Header;
use Application\Controllers\Profile\Details;
use Application\Controllers\Signin\Signin;
use Application\Controllers\Signup\Signup;
use Application\Lib\Token\Token;


if (isset($_GET['index'])) {       //    <------------ INDEX

    require_once('Application/Controllers/Homepage.php');
    require_once('Application/Controllers/Header.php');
    $homepage = new Homepage;
    $homepage->showHome();
    $header = Header::execute();
    require_once($header);

} elseif (isset($_GET['signup'])) {     //    <-----------  SIGN UP

    require_once('Application/Controllers/Signup.php');
    $signup = new Signup;
    $signup->showSignup();

} elseif (isset($_GET['signin'])) {   //    <-----------  SIGN IN

    require_once('Application/Controllers/Signin.php');
    $signin = new Signin;
    $_SESSION['token'] = (new Token)->generateToken();
    $_SESSION['token-expire'] = (new Token)->generateExpiration();
    $signin->showSignin();

} elseif (isset($_GET['details'])) {   //    <-----------  DETAILS

    require_once('Application/Controllers/Details.php');
    $details = new Details;
    $_SESSION['token'] = (new Token)->generateToken();
    $_SESSION['token-expire'] = (new Token)->generateExpiration();
    $details->showDetails();

}  elseif (isset($_POST['emailExists'])) {    //    <-----------  EMAILS EXISTS

    $email = (new Signup)->emailTestReceiver($_POST['emailExists']);
    if (!empty($email)) {
        print_r(json_encode('exists'));
    } else {
        print_r(json_encode(''));
    }
} elseif ( isset($_POST['submitSub']) &&    //    <------------ SIGN UP
    isset($_POST['email']) &&
    isset($_POST['username']) &&
    isset($_POST['name']) &&
    isset($_POST['lastname']) &&
    isset($_POST['password']) &&
    isset($_POST['passwordConf']) &&
    isset($_POST['date'])) {

    $name = filter_var($_POST['name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pw = filter_var($_POST['password'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pwC = filter_var($_POST['passwordConf'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dob = htmlspecialchars($_POST['date']);

    print_r((new Signup)->validateSignupFields($name,$lastname,$username,$email,$pw,$pwC,$dob));


} elseif(isset($_POST['emailIn'])&&             //    <------------ SIGN IN
         isset($_POST['passwordIn'])&&
         isset($_POST['submitLog'])&&
         isset($_SESSION['token-expire'])&&
         isset($_SESSION['token'])&&
         isset($_POST['token'])) {

            $emailIn = filter_var($_POST['emailIn'],FILTER_SANITIZE_EMAIL);
            $passwordIn = filter_var($_POST['passwordIn'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $token = filter_var($_POST['token'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $token_session = $_SESSION['token'];
            $token_expire = $_SESSION['token-expire'];

            print_r((new Signin)->signIn($emailIn,$passwordIn,$token,$token_session,$token_expire));

}  elseif (isset($_POST['checkAddress'])) {           //   <-------- GET ADRESS FOR DETAILS

            if(isset(((new User)->getAddress($_POST['checkAddress']))[0]['address'])){
                $address = ((new User)->getAddress($_POST['checkAddress']))[0]['address'];
            } else {
                $address = array();
            }

            if (empty($address)) {
                print_r(json_encode('details'));
            } else {
                print_r(json_encode('profile'));
            }

            // we unset the two tokens
            unset($token_session);
            unset($token_expire);
            exit();

} elseif (isset($_SESSION['token-expire'])&&            //   <-------- DETAILS
          isset($_SESSION['token'])&&
          isset($_POST['tokenD'])&&
          isset($_POST['address'])&&
          isset($_POST['city'])&&
          isset($_POST['zipCode'])&&
          isset($_POST['bios'])&&
          isset($_POST['buyer'])||isset($_POST['seller'])&&
          isset($_POST['upload'])&&
          isset($_POST['saveDetails'])){

            $errors = [];

            $errors_newFilepath = (new User)->uploadImage($errors);
            $errors = $errors_newFilepath[0];
            $newFilepath = $errors_newFilepath[1];

        // CHOICE

            $seller = $_POST['seller'];
            $buyer = $_POST['buyer'];

            $errors_rights = (new User())->validateChoice($seller,$buyer,$errors);
            $errors = $errors_rights[0];
            $rights = $errors_rights[1];

            // DETAILS

            $address = $_POST['address'];
            $city = $_POST['city'];
            $zipCode = $_POST['zipCode'];
            $bios = $_POST['bios'];

            (new User())->validateDetails($address,$city,$zipCode,$bios,$errors,$newFilepath,$rights);


    exit();
  // } elseif(){       <--------- add conditions 'routes' here

} elseif(isset($_GET['profile'])||isset($_GET['infoPersonal'])){

    require_once('Application/Controllers/Profile.php');
    $profile = new Profile;
    $_SESSION['token'] = (new Token)->generateToken();
    $_SESSION['token-expire'] = (new Token)->generateExpiration();
    $userInfos = (new User)->getAllInfosByid($_SESSION['id']);
    $profile->showProfile($_SESSION['id'],$userInfos);

}  elseif(isset($_GET['infoPassword'])){

        require_once('Application/Controllers/Profile.php');
        $profile = new Profile;
        $_SESSION['token'] = (new Token)->generateToken();
        $_SESSION['token-expire'] = (new Token)->generateExpiration();
        $userInfos = (new User)->getAllInfosByid($_SESSION['id']);
        $profile->showInfo($userInfos,'InfoPassword');

} elseif(isset($_GET['infoAddress'])){

        require_once('Application/Controllers/Profile.php');
        $profile = new Profile;
        $_SESSION['token'] = (new Token)->generateToken();
        $_SESSION['token-expire'] = (new Token)->generateExpiration();
        $userInfos = (new User)->getAllInfosByid($_SESSION['id']);
        $profile->showInfo($userInfos,'InfoAddress');

} elseif(isset($_GET['infoListings'])){

        require_once('Application/Controllers/Profile.php');
        $profile = new Profile;
        $_SESSION['token'] = (new Token)->generateToken();
        $_SESSION['token-expire'] = (new Token)->generateExpiration();
        $userInfos = (new User)->getAllInfosByid($_SESSION['id']);
        $profile->showInfo($userInfos,'InfoListings');

} elseif(isset($_GET['infoProfile'])){

        require_once('Application/Controllers/Profile.php');
        $profile = new Profile;
        $_SESSION['token'] = (new Token)->generateToken();
        $_SESSION['token-expire'] = (new Token)->generateExpiration();
        $userInfos = (new User)->getAllInfosByid($_SESSION['id']);
        $profile->showInfo($userInfos,'InfoProfile');

}  elseif(isset($_GET['addNewListing'])){

        require_once('Application/Controllers/Profile.php');
        $profile = new Profile;
        $_SESSION['token'] = (new Token)->generateToken();
        $_SESSION['token-expire'] = (new Token)->generateExpiration();
        $userInfos = (new User)->getAllInfosByid($_SESSION['id']);
        $profile->showInfo($userInfos,'InfoNewListing');

} else {

    require_once('Application/Controllers/Homepage.php');
    require_once('Application/Controllers/Header.php');
    $homepage = new Homepage;
    $homepage->showHome();
    $header = Header::execute();
    require_once($header);

}
