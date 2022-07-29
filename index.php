<?php

session_start();


require_once('Application/Lib/Token.php');
require_once('Application/Controllers/Signup.php');
require_once('Application/Controllers/Details.php');
require_once('Application/Controllers/Signin.php');
require_once('Application/Controllers/Categories.php');
require_once('Application/Controllers/SubCategories.php');
require_once('Application/Controllers/Listing.php');
require_once('Application/Controllers/State.php');
require_once('Application/Controllers/Shipping.php');
require_once('Application/Controllers/Condition.php');
require_once('Application/Controllers/Homepage.php');
require_once('Application/Controllers/Header.php');
require_once('Application/Controllers/Profile.php');
require_once('Application/Controllers/ListingPage.php');
require_once('Application/Controllers/Rights.php');



use Application\Controller\Shipping\Shipping;
use Application\Controllers\Categories\Categories;
use Application\Controllers\Condition\Condition;
use Application\Controllers\Header\Header;
use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Listing\Listing;
use Application\Controllers\ListingPage\ListingPage;
use Application\Controllers\Profile\Details;
use Application\Controllers\Profile\Profile;
use Application\Controllers\Rights\Rights;
use Application\Controllers\Signin\Signin;
use Application\Controllers\Signup\Signup;
use Application\Controllers\State\State;
use Application\Controllers\SubCategories;
use Application\Controllers\User\User;
use Application\Lib\Token\Token;

foreach ($_POST as $key => $value) {
    $_POST[$key] = htmlspecialchars((string)$value, ENT_NOQUOTES | ENT_HTML5 | ENT_SUBSTITUTE,
        'UTF-8', /*double_encode*/false );
}

// filter every $_POST of user input with this controller

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);


$mostViewd = (new Listing)->getMostViewd();
$allStates = (new State)->getAllStates();
$allCats = (new Categories)->getAllCats();
$allSubCat = (new Subcategories)->getAllSubCats();
$allCond = (new Condition)->getAllCond();
$shipName = (new Shipping)->getAllShipNames();
$allUsers = (new User)->getAllUsers();


if(isset($_SESSION['id'])) {

    $userInfos = (new User)->getAllInfosByid($_SESSION['id']);
    $rights = $userInfos[0]['id_rights'];
    $rightsName = (new Rights)->getRightsName($rights); // Rights will always be at the end of the arrays

} else {

    $rightsName = 'visitor';
}




if (isset($_GET['index'])) {       //    <------------ INDEX


    $homepage = new Homepage;
    if(isset($_SESSION['id'])){

        $params = [$userInfos, $mostViewd, $allStates, $allCats, $allSubCat, $allCond, $shipName, $allUsers, $rightsName]; // keep same chunks orders

    } else {
        $params = [$mostViewd, $allStates, $allCats, $allSubCat, $allCond, $shipName, $allUsers, $rightsName]; // keep same chunks orders

    }

    $homepage->showHome($params);


} elseif (isset($_GET['signup'])) {     //    <-----------  SIGN UP PAGE

    $signup = new Signup;
    $signup->showSignup();

} elseif (isset($_GET['signin'])) {   //    <-----------  SIGN IN PAGE

    $_SESSION['token'] = (new Token)->generateToken();
    $_SESSION['token-expire'] = (new Token)->generateExpiration();
    $signin = new Signin;
    $signin->showSignin();

} elseif (isset($_GET['details'])) {   //    <-----------  DETAILS

    $details = new Details;
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

    /*
        var_dump($_POST['emailIn']);
        var_dump($_POST['passwordIn']);
        var_dump($_POST['submitLog']);
        var_dump($_SESSION['token-expire']);
        var_dump($_SESSION['token']);
        var_dump($_POST['token']);*/

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

            $errors_newFilepath = (new User)->uploadImage($errors,'upload');
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

            if((new User())->validateDetails($address,$city,$zipCode,$bios,$errors))
            {
                (new User)->registerDetails($address, $city, $zipCode, $bios, $newFilepath, $_SESSION['id'], $rights);
                print_r(json_encode('setted'));
                $_SESSION['subs'] = 1;
            }

    exit();
  // } elseif(){       <--------- add conditions 'routes' here

} elseif (isset($_SESSION['subs'])&&$_SESSION['subs'] === 1 ){             // <------   SESSIONS VALIDATION  !!!!!!!!!!!!!


    header('location: index?profile');
    $_SESSION['subs']=0;

    exit();

} elseif(isset($_GET['profile'])||isset($_GET['infoPersonal'])){         //    <-----------  PROFILE

    $profile = new Profile;
    if($rights){
        $rightsName = (new Rights)->getRightsName($rights); // Rights will always be at the end of the arrays
        $userInfos= [$userInfos,$rightsName];
    }
    $profile->showProfile($_SESSION['id'],$userInfos);

} elseif(   isset($_FILES['myPic'])  &&
            isset($_POST['name']) &&
            isset($_POST['lastname']) &&
            isset($_POST['info1'])){         //    <-----------  PROFILE update NAme Etc

    $errors = [];

    $profile = new Profile;

    $errors_newFilepath = (new User)->uploadImage($errors,'myPic');
    $errors = $errors_newFilepath[0];
    $newFilepath = $errors_newFilepath[1];
    $user = (new User)->updateInfoPerso($_SESSION['id'], $newFilepath,  $_POST['name'], $_POST['lastname']);
    if(is_array($user)){
        $errors [] = $user;
    }
    var_dump($errors);
    $rightsName = (new Rights)->getRightsName($rights); // Rights will always be at the end of the arrays
    $userInfos= [$userInfos, $errors, $rightsName];

    $profile->showProfile($_SESSION['id'],$userInfos);

}  elseif(isset($_GET['infoPassword'])){                 //    <-----------  Password

    $profile = new Profile;
    $userInfos = [$userInfos,$rightsName];
    $profile->showInfo($userInfos,'InfoPassword');

} elseif(isset($_GET['infoAddress'])){       //    <-----------  Address

    $profile = new Profile;
    $userInfos = [$userInfos,$rightsName];
    $profile->showInfo($userInfos,'InfoAddress');

} elseif(isset($_GET['infoListings'])){              //    <----------- Listings

        $profile = new Profile;
        $listingInfos = (new Listing)->getAllListingByUser($_SESSION['id']);
        $userInfos = [$userInfos,$listingInfos,$rightsName];
        $profile->showInfo($userInfos,'InfoListings');

} elseif(isset($_GET['infoProfile'])){           //    <----------- General Setting

        $profile = new Profile;
    $userInfos = [$userInfos,$rightsName];
    $profile->showInfo($userInfos,'InfoProfile');

} elseif(isset($_GET['myListings'])){           //    <----------- General Setting

        $state = $_GET['myListings'];
        $profile = new Profile;
        $listingByState = (new Listing)->getListingsByUserAndState($_SESSION['id'],$state);
        $stateName = (new State)->getNameByStateId($state);
        $catName = (new Categories)->getAllCats();
        $subCat = (new Subcategories)->getAllSubCats();
        $allCond = (new Condition)->getAllCond();
        $shipName = (new Shipping)->getAllShipNames();
        $userInfos = [$userInfos, $listingByState, $catName, $shipName, $subCat, $allCond, $rightsName]; // keep same chunks orders
        $profile->showInfo($userInfos,('MyListings'.$stateName[0][0]));

} elseif(isset($_GET['addNewListing'])){            //    <----------- New Listing

        $profile = new Profile;
        $category = (new Categories)->getAllCats();
        $infoCat = [$userInfos, $category, $rightsName];
        $profile->showInfo($infoCat,'InfoNewListing');

} elseif(isset($_GET['ListingPage'])){            //    <-----------  Listings Page Element

        $listingPage = (new ListingPage);
        $id_listing = htmlspecialchars($_GET['ListingPage']);
        $list = new Listing;
        $listInfo = $list->getListInfo($id_listing);
        $allListingsCat = (new Listing)->getAllListingByCat($listInfo[0]['id_categories']);
        $idOwner = $listInfo[0]['id_owner'];
        $mailOwner  = (new User)->getUserMailById($idOwner);
        if(isset($_SESSION['id'])){
            $userInfos = (new User)->getAllInfosByid($_SESSION['id']);
            $params = [$userInfos, $listInfo, $allListingsCat, $allCats, $allSubCat, $mailOwner, $rightsName ];
        } else {
            $params = [$listInfo, $allListingsCat , $allCats,  $allSubCat, $mailOwner, $rightsName];
        }

        $listingPage->showListingPage($params,'ListingPage');

}  elseif(isset($_POST['subId'])){           //    <----------- Sub Categories List

    $subCat = (new SubCategories)->getAllSubCategoriesByCat($_POST['subId']);
    print_r(json_encode($subCat));

} elseif(   isset($_POST['title']) &&                //    <----------- ADD NEW LISTINGS
            isset($_POST['price']) &&
            isset($_POST['category']) &&
            isset($_POST['subCat']) &&
            isset($_POST['description']) &&
            isset($_POST['used']) ||
            isset($_POST['good']) ||
            isset($_POST['mint']) &&
            isset($_FILES['img1']) &&
            isset($_FILES['img2']) &&
            isset($_FILES['img3']) &&
            isset($_FILES['img4']) &&
            isset($_POST['hands']) ||
            isset($_POST['delivery']) &&
            isset($_POST['year']) &&
            isset($_POST['saveNewListing'])){

    $title = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_FLOAT);
    $category = filter_var($_POST['category'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $subCat = filter_var($_POST['subCat'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $used = $_POST['used'];
    $good = $_POST['good'];
    $mint = $_POST['mint'];
    $img1 = $_FILES['img1'];
    $img2 = $_FILES['img2'];
    $img3 = $_FILES['img3'];
    $img4 = $_FILES['img4'];
    $hands = $_POST['hands'];
    $delivery = $_POST['delivery'];
    $year = filter_var($_POST['year'],FILTER_SANITIZE_NUMBER_INT);

    $errors = [];

    $errors_newFilepath1 =(new User)->uploadImage($errors, nameCmd: 'img1');
    $errors1 = $errors_newFilepmath1[0];
    $newFilepath1 = $errors_newFilepath1[1];
    $errors = array_merge(...$errors,...$errors1);

    $errors_newFilepath2 =(new User)->uploadImage($errors, nameCmd: 'img2');
    $errors2 = $errors_newFilepath2[0];
    $newFilepath2 = $errors_newFilepath2[1];
    $errors = array_merge(...$errors,...$errors2);

    $errors_newFilepath3 =(new User)->uploadImage($errors, nameCmd: 'img3');
    $errors3 = $errors_newFilepath3[0];
    $newFilepath3 = $errors_newFilepath3[1];
    $errors = array_merge(...$errors,...$errors3);

    $errors_newFilepath4 =(new User)->uploadImage($errors, nameCmd: 'img4');
    $errors4 = $errors_newFilepath4[0];
    $newFilepath4 = $errors_newFilepath4[1];
    $errors = array_merge(...$errors,...$errors4);

    $errors_cond = (new Listing())->validateCondition($used, $good, $mint, $errors);
    $errors = array_merge(...$errors,...$errors_cond[0]);
    $cond = $errors_cond[1];

    $errors_ship = (new Listing())->validateShipping($hands, $delivery, $errors);
    $errors = array_merge(...$errors,...$errors_ship[0]);
    $ship = $errors_ship[1];

    $errors_valid = (new Listing)->validateListing( $title, $price, $category, $subCat, $description, $year, $errors );
    $errors = array_merge($errors,$errors_valid[0]);
    $valid = $errors_valid[1];

    if($valid)
    {
        $id = (new Listing)->registerListing($_SESSION['id'], $title, $price, $category, $subCat, $description, $cond, $ship, $year, $newFilepath1, $newFilepath2, $newFilepath3, $newFilepath4);
        print_r(json_encode($id));

    } else {

       print_r(json_encode($errors));
    }

} elseif(isset($_GET['owner'])){


    $arr = explode(',', base64_decode(base64_decode($_GET['owner'])));
    $email = $arr[0];
    $title = $arr[1];


    for($i=0;$i<=isset($allUsers[$i]);$i++){
        if($email === $allUsers[$i]['email']){
            header('location: mailto:'.$email.'?subject=Thriftee: '.$title);
        }
    }
   // if($email[0] === .)
    //<a href="mailto:email@example.com">Send Email</a>

    $form = ob_get_clean();

} elseif(isset($_GET['logout'])){

    session_destroy();
    setcookie("connected", 0, time() - 3600000 * 240);
    setcookie("id", 0, time() - 3600000 * 240);
    header('location: index');

} else {


    $homepage = new Homepage;
    $allStates = (new State)->getAllStates();
    $allCats = (new Categories)->getAllCats();
    $allSubCat = (new Subcategories)->getAllSubCats();
    $allCond = (new Condition)->getAllCond();
    $shipName = (new Shipping)->getAllShipNames();
    $allUsers = (new User)->getAllUsers();


    if(isset($_SESSION['id'])){

        $userInfos = (new User)->getAllInfosByid($_SESSION['id']);
        $rights  = $userInfos[0]['id_rights'];
        $rightsName = (new Rights)->getRightsName($rights); // Rights will always be at the end of the arrays
        $params = [$userInfos, $mostViewd, $allStates, $allCats, $allSubCat, $allCond, $shipName, $allUsers, $rightsName]; // keep same chunks orders

    } else {

        $rightsName = 'visitor';
        $params = [$mostViewd, $allStates, $allCats, $allSubCat, $allCond, $shipName, $allUsers, $rightsName]; // keep same chunks orders

    }


    $homepage->showHome($params);

}

/*
var_dump($_POST['title']);
var_dump($_POST['price']);
var_dump($_POST['category']);
var_dump($_POST['subCat']);
var_dump($_POST['description']);
var_dump($_POST['used']);
var_dump($_POST['good']);
var_dump($_POST['mint']);
var_dump($_FILES['img1']);
var_dump($_FILES['img2']);
var_dump($_FILES['img3']);
var_dump($_FILES['img4']);
var_dump($_POST['hands']);
var_dump($_POST['delivery']);
var_dump($_POST['year']);
var_dump($_POST['saveNewListing']);
*/

