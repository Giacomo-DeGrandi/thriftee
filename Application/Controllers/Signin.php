<?php

namespace Application\Controllers\Signin;

require_once('Header.php');
require_once('Controller.php');

use Application\Controllers\Controller\Controller;
use Application\Controllers\Header\Header;
use Application\Controllers\User\User;

class Signin extends Controller{

    public function showSignin()
    {
        self::render('Signin');
    }

    public function emailTestReceiver($email): string
    {
        return (new User)->emailExists($email);
    }

    public function signIn(mixed $emailIn, mixed $passwordIn, mixed $token, mixed $token_session, mixed $token_expire)
    {
        $errors = [];

        // receive all input values from the form
        $password = $passwordIn;
        $email = htmlspecialchars($emailIn);

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
        $checkExists = self::emailTestReceiver($email);

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
            if ($token_session == $token) {
                // expired?
                if (time() >= $token_expire) {

                    print_r(json_encode("Token expired. Please reload form."));

                } else {

                    $_SESSION['id'] = ((new User)->getId($email))[0]['id'];
                    $_SESSION['rights'] = ((new User)->getRights($email))[0]['id_rights'];
                    setcookie("connected", 0, time() - 3600000 * 240);
                    setcookie("id", 0, time() - 3600000 * 240);
                    setcookie("id", ((new User)->getId($email))[0]['id'], time() + 7200);

                    return json_encode(((new User)->getId($email))[0]['id']);

                }
            }
        }
    }


}