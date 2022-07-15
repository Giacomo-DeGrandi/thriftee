<?php


require_once('Application/Controllers/Signup.php');

use Application\Controllers\Signup\Signup;
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
            if(empty($name)){     array_push($errors, "Name is required");     }
            if(empty($lastname)){     array_push($errors, "Lastname is required");     }
            if(empty($username)){     array_push($errors, "Firstname is required");     }
            if(empty($email)){     array_push($errors, "Email is required");       }
            if (!preg_match('/^[a-z0-9._-]+[@]+[a-zA-Z0-9._-]+[.]+[a-z]{2,3}$/', $email)){    array_push($errors, "Email format is wrong");     }
            if(empty($pw)){     array_push($errors, "Password is required"); }
            if(empty($dob)){    array_push($errors, "Date is required");    }
            if ($pw !== $pwC) {     array_push($errors, "The two passwords do not match");      }
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/', $pw)) {    array_push($errors, "Password format is wrong");    }

            //check if user exists
            $chkExists = (new Signup)->emailTestReceiver($_POST['email']);

            if ( !empty($chkExists)) {    array_push($errors, "This user has already subscribed, please log in");     }

            // check if user is at least 18
            $nowDate = getdate();
            $nowDate = $nowDate['year'].'-'.$nowDate['mon'].'-'.$nowDate['mday'].' '.$nowDate['hours'].':'.$nowDate['minutes'].':'.$nowDate['seconds'];
            $nowDate = new DateTime($nowDate);

            $testDate = new DateTime($dob);


            $difference = $nowDate->diff($testDate);

            if($difference-> y < 18){    array_push($errors, "You have to be at least 18yo to subscribe");   }

            // Finally, register user if there are no errors in the form
            if ( empty($errors) ) {

                $rights = 1;
                $data1 = 'example';
                $connected = 0;

                (new Signup)->signUp( $name, $lastname, $username, $email, $pw, $rights);

                print_r(json_encode('setted'));
            }
        break;

        case isset($_POST['emailIn']):
        case isset($_POST['passwordIn']):
        case isset($_POST['signin']):
            


        break;

    endswitch;
}