<?php

namespace Application\Controllers\User;

require_once ('Application/Models/User.php');
require_once ('Application/Lib/Token.php');
require_once ('Signup.php');

use Application\Controllers\Signup\Signup;
use Application\Lib\Token\Token;
use Application\Models\User\User as Usermodel;

class User
{

    public function emailExists($email): string
    {
        $exist = (new Usermodel)->checkExists($email);
        if(!empty($exist)){
            return 'exists';
        } else {
            return '';
        }
    }

    public function signUp(mixed $name, mixed $lastname, mixed $username, mixed $email, mixed $pw, int $rights)
    {
        (new Usermodel)->signUp( $name, $lastname, $username, $email, $pw, $rights );
    }

    public function getPw(string $email): bool|array
    {
        return (new Usermodel)->getPw( $email);
    }

    public function getId(string $email): bool|array
    {
        return (new Usermodel)->getId( $email);
    }

    public function getRights(string $email): bool|array
    {
        return (new Usermodel)->getRights($email);
    }

    public function getRightsById($id): bool|array
    {
        return (new Usermodel)->getRightsById($id);
    }


    public function registerDetails(mixed $address, mixed $city, mixed $zipCode, mixed $bios, string $newFilepath, int $id, int $rights)
    {
        (new Usermodel)->registerDetails( $address, $city, $zipCode, $bios, $newFilepath, $id, $rights);
    }

    public function getAddress(mixed $id): bool|array
    {
        return (new Usermodel)->getAddress($id);
    }

    public function validateDetails(mixed $address, mixed $city, mixed $zipCode, mixed $bios, mixed $errors): bool|string
    {
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
        if (strlen($city) < 3 || strlen($city) > 30) {
            $errors[] = "City must be in between 3 and 30 characters";
        }
        if (empty($zipCode)) {
            $errors[] = "Zip Code is required";
        }
        if (!preg_match('/^[0-9]*$/', $zipCode)) {
            $errors[] = "You can use only numbers in zip code field";
        }
        if (strlen($zipCode) < 2 || strlen($zipCode) > 7) {
            $errors[] = "Zip Code must be in between 2 and 7 characters";
        }
        if (!preg_match("/^[a-zA-Z0-9.,_ '?!-]*$/", $bios)) {
            $errors[] = "You can use only numbers, letters and  .,_ '?!-  in bios field";
        }
        if (strlen($bios) < 0 || strlen($bios) > 1000) {
            $errors[] = "Bios must be in between 0 and 1000 characters";
        }

        if (empty($errors)) {

                unset($_SESSION["token"]);
                unset($_SESSION["token-expire"]);
                return  true;

        } else {
            return print_r(json_encode($errors));
        }

    }

    public function validateChoice($seller, $buyer, array $errors): array
    {

        if ($seller == 'false' && $buyer == 'false') {
            $errors [] = 'You have to chose at least a role';
        }
        if ($seller !== 'true' && $buyer !== 'true') {
            $errors [] = 'You can chose at max one role.';
        }
        if($seller === 'false' && $buyer === 'true'){
            $rights = 3;
        }
        if($seller === 'true' && $buyer === 'false'){
            $rights = 2;
        }
        return [$errors, $rights];
    }

    public function uploadImage(array $errors, string $nameCmd): array
    {
        // FILE
        $filepath = $_FILES[$nameCmd]['tmp_name'];
        $fileSize = filesize($filepath);
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $filepath);

        if ($fileSize === 0) {
            $errors [] = 'This file is empty';
        }
        if ($fileSize > 1000000) {
            $errors [] = 'Max size allowed 1MB';
        }



        $allowedTypes = ['image/png' => 'png', 'image/jpeg' => 'jpg', 'image/svg+xml' => 'svg', 'image/gif' => 'gif', 'image/webp' => 'webp'];

        if (!in_array($filetype, array_keys($allowedTypes))) {
            $errors [] = "File not allowed.";
        }

        $filename = basename($filepath); // I'm using the original name here, but you can also change the name of the file in this position
        $extension = $allowedTypes[$filetype];
        $targetDirectory = 'assets/uploads';
        $newFilepath = $targetDirectory . "/" . $filename . "." . $extension;

        // Copy the file, returns false if fail
        if (!copy($filepath, $newFilepath)) {
            $errors [] = "Can't move file.";
        }
        unlink($filepath);

        return [$errors,$newFilepath];

    }

    private static function registerNewImage(mixed $filePaths, mixed $id): bool|array
    {
        return (new Usermodel)->registerNewImage( $filePaths, $id);
    }


    public function getAllInfosByid(mixed $id): bool|array
    {
        return (new Usermodel)->getAllInfosByid($id);
    }

    public function getAllUsers(): bool|array
    {
        return (new Usermodel)-> getAllUsers();
    }

    public function getUserMailById(mixed $idOwner): bool|array
    {
        return (new Usermodel)-> getUserMailById($idOwner);

    }

    public function updateInfoPerso(mixed $id, mixed $filePath, mixed $name, mixed $lastname, mixed $bios, mixed $email): bool|array
    {
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
        if (!preg_match("/^[a-zA-Z0-9.,_ '?!-]*$/", $bios)) {
            $errors[] = "You can use only numbers, letters and  .,_ '?!-  in bios field";
        }
        if (strlen($bios) < 0 || strlen($bios) > 1000) {
            $errors[] = "Bios must be in between 0 and 1000 characters";
        }
        if (empty($email)) {
            $errors[] = "Email is required";
        }
        if (!preg_match('/^[a-z0-9._-]+[@]+[a-zA-Z0-9._-]+[.]+[a-z]{2,3}$/', $email)) {
            $errors[] = "Email format is wrong";
        }

        //check if user exists
        $chkExists = (new Signup)->emailTestReceiverUpdate($_POST['email'], $id);

        if (!empty($chkExists)) {
            $errors[] = "This email is already registered please log in or choose another email";
        }

        if (empty($errors)) {

            (new Usermodel())->updatePersonalInfo($id, $name, $lastname, $filePath, $bios, $email);
            unset($_SESSION["token"]);
            unset($_SESSION["token-expire"]);
            return  true;

        } else {

            return $errors;
        }

    }

    public function getProPicPath(mixed $id): bool|array
    {
        return (new Usermodel())->getProPicPath($id);
    }

    public function emailExistsUpdate($email, $id): bool|array
    {
        return (new Usermodel())->emailExistsUpdate($email, $id);
    }

    public function updatePassword(mixed $password, mixed $passwordConf, mixed $id): bool|array
    {
        if (empty($password)) {
            $errors[] = "Password is required";
        }
        if (empty($passwordConf)) {
            $errors[] = "Password Confirmation is required";
        }
        if ($password !== $passwordConf) {
            $errors[] = "The two passwords do not match";
        }
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/', $password)) {
            $errors[] = "Password format is wrong, minimum 8 characters";
        }

        if(empty($errors)){

            return (new Usermodel())->updatePassword($password, $id);

        } else {
            return $errors;

        }

    }

    public function updateAddress(mixed $address, mixed $city, mixed $zipCode, mixed $id): bool|array
    {
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
        if (strlen($city) < 3 || strlen($city) > 30) {
            $errors[] = "City must be in between 3 and 30 characters";
        }
        if (empty($zipCode)) {
            $errors[] = "Zip Code is required";
        }
        if (!preg_match('/^[0-9]*$/', $zipCode)) {
            $errors[] = "You can use only numbers in zip code field";
        }
        if (strlen($zipCode) < 2 || strlen($zipCode) > 7) {
            $errors[] = "Zip Code must be in between 2 and 7 characters";
        }

        if(empty($errors)){

            return (new Usermodel())->updateAddress($address, $zipCode, $city,  $id);

        } else {
            return $errors;

        }


    }


}