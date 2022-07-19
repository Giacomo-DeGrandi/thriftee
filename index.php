<?php

session_start();


require_once('Application/Lib/Token.php');
require_once('Application/Controllers/Signup.php');
require_once('Application/Controllers/Signin.php');


use Application\Controllers\User\User;
use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Header\Header;
use Application\Controllers\Profile\Details;
use Application\Controllers\Signin\Signin;
use Application\Controllers\Signup\Signup;
use Application\Lib\Token\Token;



if (isset($_GET['index'])) {

    require_once('Application/Controllers/Homepage.php');
    require_once('Application/Controllers/Header.php');
    $homepage = new Homepage;
    $homepage->showHome();
    $header = Header::execute();
    require_once($header);

} elseif (isset($_GET['signup'])) {

    require_once('Application/Controllers/Signup.php');
    $signup = new Signup;
    $signup->showSignup();

} elseif (isset($_GET['signin'])) {

    require_once('Application/Controllers/Signin.php');
    $signin = new Signin;
    $_SESSION['token'] = (new Token)->generateToken();
    $_SESSION['token-expire'] = (new Token)->generateExpiration();
    $signin->showSignin();

} elseif (isset($_GET['details'])) {

    require_once('Application/Controllers/Details.php');
    $details = new Details;
    $_SESSION['token'] = (new Token)->generateToken();
    $_SESSION['token-expire'] = (new Token)->generateExpiration();
    $details->showDetails();

}  elseif (isset($_POST['emailExists'])) {

    $email = (new Signup)->emailTestReceiver($_POST['emailExists']);
    if (!empty($email)) {
        print_r(json_encode('exists'));
    } else {
        print_r(json_encode(''));
    }
} elseif ( isset($_POST['name']) &&
    isset($_POST['lastname']) &&
    isset($_POST['username']) &&
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['passwordConf']) &&
    isset($_POST['date'])) {

    $errors = [];

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pw = $_POST['password'];
    $pwC = $_POST['passwordConf'];
    $dob = $_POST['date'];

    // check for errors in user inputs and count them
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (!preg_match('/^[a-zA-Z]*$/', $name)) {
        $errors[] = "You can't use special characters in name field";
    }
    if (strlen($name) < 2 || strlen($name) > 23) {
        $errors[] = "Name must be in between 2 and 23 characters";
    }
    if (empty($lastname)) {
        $errors[] = "Lastname is required";
    }
    if (!preg_match('/^[a-zA-Z]*$/', $lastname)) {
        $errors[] = "You can't use special characters in lastname field";
    }
    if (strlen($lastname) < 2 || strlen($lastname) > 23) {
        $errors[] = "Lastname must be in between 2 and 23 characters";
    }
    if (empty($username)) {
        $errors[] = "Firstname is required";
    }
    if (!preg_match('/^[a-zA-Z]*$/', $username)) {
        $errors[] = "You can't use special characters in username field";
    }
    if (strlen($lastname) < 2 || strlen($lastname) > 30) {
        $errors[] = "Username must be in between 2 and 23 characters";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    }
    if (!preg_match('/^[a-z0-9._-]+[@]+[a-zA-Z0-9._-]+[.]+[a-z]{2,3}$/', $email)) {
        $errors[] = "Email format is wrong";
    }
    if (empty($pw)) {
        $errors[] = "Password is required";
    }
    if (empty($dob)) {
        $errors[] = "Date is required";
    }
    if ($pw !== $pwC) {
        $errors[] = "The two passwords do not match";
    }
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/', $pw)) {
        $errors[] = "Password format is wrong";
    }

    //check if user exists
    $chkExists = (new Signup)->emailTestReceiver($_POST['email']);

    if (!empty($chkExists)) {
        $errors[] = "This user has already subscribed, please log in";
    }

    // check if user is at least 18
    $nowDate = getdate();
    $nowDate = $nowDate['year'] . '-' . $nowDate['mon'] . '-' . $nowDate['mday'] . ' ' . $nowDate['hours'] . ':' . $nowDate['minutes'] . ':' . $nowDate['seconds'];
    $nowDate = new DateTime($nowDate);

    $testDate = new DateTime($dob);


    $difference = $nowDate->diff($testDate);

    if ($difference->y < 18) {
        $errors[] = "You have to be at least 18yo to subscribe";
    }

    // Finally, register user if there are no errors in the form
    if (empty($errors)) {

        $rights = 1;
        $data1 = 'example';
        $connected = 0;

        (new Signup)->signUp($name, $lastname, $username, $email, $pw, $rights);

        print_r(json_encode('setted'));
    }

} elseif(isset($_POST['emailIn'])&&
         isset($_POST['passwordIn'])&&
         isset($_POST['signin'])&&
         isset($_SESSION['token-expire'])&&
         isset($_SESSION['token'])&&
         isset($_POST['token'])) {


    $errors = [];

    // receive all input values from the form
    $password = $_POST['passwordIn'];
    $email = htmlspecialchars($_POST['emailIn']);

    // form validation:
    // count errors
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    }

    // check the database to make sure
    // a user does exist with the same login and password
    $checkExists = (new Signin)->emailTestReceiver($email);

    if (!$checkExists) {
        $errors[] = "This email is not registered, please subscribe to log in";
    }

    $cpw = (new User)->getPw($email);

    if (!password_verify($password, $cpw[0]['password'])) {
        $errors[] = "Wrong password";
        print_r(json_encode('Wrong password'));

        exit();
    }

    if (empty($errors)) {

        //  Token Validation --->
        if ($_SESSION["token"] == $_POST["token"]) {
            // expired?
            if (time() >= $_SESSION["token-expire"]) {

                print_r(json_encode("Token expired. Please reload form."));

            } else {

                $_SESSION['id'] = ((new User)->getId($email))[0]['id'];
                $_SESSION['rights'] = ((new User)->getRights($email))[0]['id_rights'];
                setcookie("connected", 0, time() - 3600000 * 240);
                setcookie("id", 0, time() - 3600000 * 240);
                setcookie("id", ((new User)->getId($email))[0]['id'], time() + 7200);
                print_r(json_encode(((new User)->getId($email))[0]['id']));

                // we unset the two tokens
                unset($_SESSION["token"]);
                unset($_SESSION["token-expire"]);

            }
        }
    }

    exit();
}  elseif (isset($_POST['checkAddress'])) {

    $address = ((new User)->getAddress($_POST['checkAddress']))[0]['address'];

    if (empty($address)) {
        print_r(json_encode('details'));
    } else {
        print_r(json_encode('profile'));
    }

    exit();

} elseif (isset($_SESSION['token-expire'])&&
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

            // FILE

            $filepath = $_FILES['upload']['tmp_name'];
            $fileSize = filesize($filepath);
            $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
            $filetype = finfo_file($fileinfo, $filepath);

            if ($fileSize === 0) {
                $errors [] = 'This file is empty';
            }
            if ($fileSize > 1000000) {
                $errors [] = 'Max size allowed 1MB';
            }

            $allowedTypes = ['image/png' => 'png', 'image/jpeg' => 'jpg', 'image/svg+xml' => 'svg', 'image/gif' => 'gif'];

            if (!in_array($filetype, array_keys($allowedTypes))) {
                $errors [] = "File not allowed.";
            }

            $filename = basename($filepath); // I'm using the original name here, but you can also change the name of the file here
            $extension = $allowedTypes[$filetype];
            $targetDirectory = 'assets/uploads';
            $newFilepath = $targetDirectory . "/" . $filename . "." . $extension;

            // CHOICE

            if ($_POST['seller'] == 'false' && $_POST['buyer'] == 'false') {
                $errors [] = 'You have to chose at least a role';
            }
            if ($_POST['seller'] !== 'true' && $_POST['buyer'] !== 'true') {
                $errors [] = 'You can chose at max one role.';
            }

            // DETAILS

            $address = $_POST['address'];
            $city = $_POST['city'];
            $zipCode = $_POST['zipCode'];
            $bios = $_POST['bios'];

            if (empty($address)) {
                $errors[] = "Address is required";
            }
            if (!preg_match('/^[a-zA-Z0-9_ -]*$/', $address)) {
                $errors[] = "You can use only letters and numbers in address field";
            }
            if (strlen($address) < 3 || strlen($address) > 30) {
                $errors[] = "Address must be in between 2 and 23 characters";
            }
            if (empty($city)) {
                $errors[] = "City is required";
            }
            if (!preg_match('/^[a-zA-Z]*$/', $city)) {
                $errors[] = "You can use only letters in city field";
            }
            if (strlen($city) < 2 || strlen($city) > 23) {
                $errors[] = "City must be in between 3 and 30 characters";
            }
            if (empty($zipCode)) {
                $errors[] = "zip Code is required";
            }
            if (!preg_match('/^[0-9]*$/', $zipCode)) {
                $errors[] = "You can use only numbers in zip code field";
            }
            if (strlen($zipCode) < 2 || strlen($zipCode) > 23) {
                $errors[] = "Zip Code must be in between 2 and 7 characters";
            }
            if (!preg_match("/^[a-zA-Z0-9.,_ '?!-]*$/", $bios)) {
                $errors[] = "You can use only numbers, letters and  .,_ '?!-  in bios field";
            }
            if (strlen($bios) < 0 || strlen($bios) > 500) {
                $errors[] = "Zip Code must be in between 2 and 7 characters";
            }

            if (empty($errors)) {
                if (!copy($filepath, $newFilepath)) {
                    $errors [] = "Can't move file.";
                } // Copy the file, returns false if failed
                unlink($filepath);
                if (empty($errors)) {

                    (new User)->registerDetails($address, $city, $zipCode, $bios, $newFilepath, $_SESSION['id']);

                    unset($_SESSION["token"]);
                    unset($_SESSION["token-expire"]);

                    print_r(json_encode('setted'));
                } else {
                    print_r(json_encode($errors));
                }
            } else {
                print_r(json_encode($errors));
            }

            exit();

}
