<?php

session_start();


require_once('../Controllers/Signup.php');
require_once('../Controllers/Signin.php');

use Application\Controllers\Signup\Signup;
use Application\Controllers\Signin\Signin;
use Application\Controllers\User\User;


if(isset($_POST)) {
    switch ($_POST):

        case isset($_POST['emailExists']) :
            $email = (new Signup)->emailTestReceiver($_POST['emailExists']);
            if (!empty($email)) {
                print_r(json_encode('exists'));
            } else {
                print_r(json_encode(''));
            }
        break;

        case isset($_POST['name']):
        case isset($_POST['lastname']):
        case isset($_POST['username']):
        case isset($_POST['email']):
        case isset($_POST['password']):
        case isset($_POST['passwordConf']):
        case isset($_POST['date']):

            $errors = [];

            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            $pw = $_POST['password'];
            $pwC = $_POST['passwordConf'];
            $dob = $_POST['date'];

            // check for errors in user inputs and count them
            if(empty($name)){     $errors[] = "Name is required";     }
            if(!preg_match('/^[a-zA-Z]*$/', $name)){    $errors[] = "You can't use special characters in name field";     }
            if(count($name) < 2 || count($name) > 23){    $errors[] = "Name must be in between 2 and 23 characters";     }
            if(empty($lastname)){     $errors[] = "Lastname is required";     }
            if(!preg_match('/^[a-zA-Z]*$/', $lastname)){    $errors[] = "You can't use special characters in lastname field";     }
            if(count($lastname) < 2 || count($lastname) > 23){    $errors[] = "Lastname must be in between 2 and 23 characters";     }
            if(empty($username)){     $errors[] = "Firstname is required";     }
            if(!preg_match('/^[a-zA-Z]*$/', $username)){    $errors[] = "You can't use special characters in username field";     }
            if(empty($username)){     $errors[] = "Firstname is required";     }
            if(empty($email)){     $errors[] = "Email is required";       }
            if (!preg_match('/^[a-z0-9._-]+[@]+[a-zA-Z0-9._-]+[.]+[a-z]{2,3}$/', $email)){    $errors[] = "Email format is wrong";     }
            if(empty($pw)){     $errors[] = "Password is required"; }
            if(empty($dob)){    $errors[] = "Date is required";    }
            if ($pw !== $pwC) {     $errors[] = "The two passwords do not match";      }
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/', $pw)) {    $errors[] = "Password format is wrong";    }

            //check if user exists
            $chkExists = (new Signup)->emailTestReceiver($_POST['email']);

            if ( !empty($chkExists)) {    $errors[] = "This user has already subscribed, please log in";     }

            // check if user is at least 18
            $nowDate = getdate();
            $nowDate = $nowDate['year'].'-'.$nowDate['mon'].'-'.$nowDate['mday'].' '.$nowDate['hours'].':'.$nowDate['minutes'].':'.$nowDate['seconds'];
            $nowDate = new DateTime($nowDate);

            $testDate = new DateTime($dob);


            $difference = $nowDate->diff($testDate);

            if($difference-> y < 18){    $errors[] = "You have to be at least 18yo to subscribe";   }

            // Finally, register user if there are no errors in the form
            if ( empty($errors) ) {

                $rights = 1;
                $data1 = 'example';
                $connected = 0;

                (new Signup)->signUp( $name, $lastname, $username, $email, $pw, $rights);

                print_r(json_encode('setted'));
            }
        break;

            // add tokens

        case isset($_POST['emailIn']):
        case isset($_POST['passwordIn']):
        case isset($_POST['signin']):
        case isset($_SESSION['token-expire']):
        case isset($_SESSION['token']):
        case isset($_POST['token']):


            $errors= [];

            // receive all input values from the form
            $password = $_POST['passwordIn'];
            $email = htmlspecialchars($_POST['emailIn']);

            // form validation:
            // count errors
            if(empty($password)){     $errors[] = "Password is required"; }
            if(empty($email)){     $errors[] = "Email is required";       }

            // check the database to make sure
            // a user does exist with the same login and password
            $checkExists = (new Signin)->emailTestReceiver($email);

            if ( !$checkExists ) {
                $errors[] = "This email is not registered, please subscribe to log in";
            }

            $cpw = (new User)->getPw($email);

            if (!password_verify($password, $cpw[0]['password'])) {
                $errors[] = "Wrong password";
                print_r(json_encode('Wrong password'));

                break;
            }

            if (empty($errors)) {

                //  Token Validation --->
                if ($_SESSION["token"]==$_POST["token"]) {
                    // expired?
                    if (time() >= $_SESSION["token-expire"]) {

                        print_r(json_encode("Token expired. Please reload form."));

                    } else {

                        $_SESSION['id']=((new User)->getId($email))[0]['id'];
                        $_SESSION['rights']= ((new User)->getRights($email))[0]['id_rights'];
                        setcookie("connected", 0, time() - 3600000 * 240);
                        setcookie("id", 0, time() - 3600000 * 240);
                        setcookie("id", ((new User)->getId($email))[0]['id'], time()+7200);
                        print_r(json_encode(((new User)->getId($email))[0]['id']));

                        // we unset the two tokens to
                        unset($_SESSION["token"]);
                        unset($_SESSION["token-expire"]);

                    }
                }
            }

        break;

        case isset($_SESSION['token-expire']):
        case isset($_SESSION['token']):
        case isset($_POST['tokenD']):
        case isset($_POST['address']):
        case isset($_POST['city']):
        case isset($_POST['zipCode']):
        case isset($_POST['bios']):
        case isset($_POST['buyer']):
        case isset($_POST['seller']):
        case isset($_POST['myFile']):
        case isset($_POST['saveDetails']):
            var_dump($_POST['myFile']);
        break;

    endswitch;
}