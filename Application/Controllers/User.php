<?php

namespace Application\Controllers\User;

require_once ('Application/Models/User.php');
require_once ('Application/Lib/Token.php');

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
        if (strlen($bios) < 0 || strlen($bios) > 500) {
            $errors[] = "Bios must be in between 0 and 500 characters";
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

        $filename = basename($filepath); // I'm using the original name here, but you can also change the name of the file here
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

    public function getAllInfosByid(mixed $id): bool|array
    {
        return (new Usermodel)->getAllInfosByid($id);
    }

    public function getAllUsers(): bool|array
    {
        return (new Usermodel)-> getAllUsers();
    }

    public function getUserMailById(mixed $idOwner)
    {
        return (new Usermodel)-> getUserMailById($idOwner);

    }

}