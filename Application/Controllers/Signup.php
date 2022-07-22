<?php

namespace Application\Controllers\Signup;

require_once('User.php');
require_once('Controller.php');

use Application\Controllers\Controller\Controller;
use Application\Controllers\User\User;
use DateTime;

class Signup extends Controller{

    public function showSignup()
    {
        self::render('Signup');
    }

    public function emailTestReceiver($email): string
    {
        return (new User)->emailExists($email);
    }

    public function signUp( mixed $name, mixed $lastname, mixed $username, mixed $email, mixed $pw, int $rights )
    {
        (new User)->signUp( $name, $lastname, $username, $email, $pw, $rights );
    }

    public function validateSignupFields(mixed $name, mixed $lastname, mixed $username, mixed $email, mixed $pw, mixed $pwC, mixed $dob)
    {

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
        $nowDate = new \DateTime($nowDate);

        $testDate = new \DateTime($dob);


        $difference = $nowDate->diff($testDate);

        if ($difference->y < 18) {
            $errors[] = "You have to be at least 18yo to subscribe";
        }

        // Finally, register user if there are no errors in the form
        if (empty($errors)) {

            $rights = 1;

            self::signUp($name, $lastname, $username, $email, $pw, $rights);

            return json_encode('setted');
        }
    }

}

