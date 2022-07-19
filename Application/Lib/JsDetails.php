<?php

session_start();


require_once('../Controllers/User.php');

use Application\Controllers\User\User;


if(isset($_POST)) {

    switch ($_POST):

        case isset($_SESSION['token-expire']):
        case isset($_SESSION['token']):
        case isset($_POST['tokenD']):
        case isset($_POST['address']):
        case isset($_POST['city']):
        case isset($_POST['zipCode']):
        case isset($_POST['bios']):
        case isset($_POST['buyer']):
        case isset($_POST['seller']):
        case isset($_POST['upload']):
        case isset($_POST['saveDetails']):

            $errors = [];

            // FILE

            $filepath = $_FILES['upload']['tmp_name'];
            $fileSize = filesize($filepath);
            $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
            $filetype = finfo_file($fileinfo, $filepath);

            if ($fileSize === 0) { $errors [] = 'This file is empty'; }
            if ($fileSize > 1000000) { $errors [] = 'Max size allowed 1MB'; }

            $allowedTypes = ['image/png' => 'png', 'image/jpeg' => 'jpg', 'image/svg+xml' => 'svg', 'image/gif' => 'gif'];

            if(!in_array($filetype, array_keys($allowedTypes))) { $errors [] = "File not allowed."; }

            $filename = basename($filepath); // I'm using the original name here, but you can also change the name of the file here
            $extension = $allowedTypes[$filetype];
            $targetDirectory = '../../assets/uploads';
            $newFilepath = $targetDirectory . "/" . $filename . "." . $extension;

            // CHOICE

            if($_POST['seller'] == 'false' && $_POST['buyer'] == 'false'){ $errors [] = 'You have to chose at least a role'; }
            if($_POST['seller'] !== 'true' && $_POST['buyer'] !== 'true'){ $errors [] = 'You can chose at max one role.'; }

            // DETAILS

            $address = $_POST['address'];
            $city = $_POST['city'];
            $zipCode = $_POST['zipCode'];
            $bios = $_POST['bios'];

            if(empty($address)){     $errors[] = "Address is required";     }
            if(!preg_match('/^[a-zA-Z0-9_ -]*$/', $address)){    $errors[] = "You can use only letters and numbers in address field";     }
            if(strlen($address) < 3 || strlen($address) > 30){    $errors[] = "Address must be in between 2 and 23 characters";     }
            if(empty($city)){     $errors[] = "City is required";     }
            if(!preg_match('/^[a-zA-Z]*$/', $city)){    $errors[] = "You can use only letters in city field";     }
            if(strlen($city) < 2 || strlen($city) > 23){    $errors[] = "City must be in between 3 and 30 characters";     }
            if(empty($zipCode)){     $errors[] = "zip Code is required";     }
            if(!preg_match('/^[0-9]*$/', $zipCode)){    $errors[] = "You can use only numbers in zip code field";     }
            if(strlen($zipCode) < 2 || strlen($zipCode) > 23){    $errors[] = "Zip Code must be in between 2 and 7 characters";     }
            if(!preg_match("/^[a-zA-Z0-9.,_ '?!-]*$/", $bios)){    $errors[] = "You can use only numbers, letters and  .,_ '?!-  in bios field";     }
            if(strlen($bios) < 0 || strlen($bios) > 500){    $errors[] = "Zip Code must be in between 2 and 7 characters";     }

            if(empty($errors)){
                if (!copy($filepath, $newFilepath )) {  $errors [] = "Can't move file."; } // Copy the file, returns false if failed
                unlink($filepath);
                if(empty($errors)){

                    (new User)->registerDetails($address, $city, $zipCode, $bios, $newFilepath, $_SESSION['id']);

                    unset($_SESSION["token"]);
                    unset($_SESSION["token-expire"]);

                    print_r(json_encode('setted'));
                } else {
                    print_r(json_encode($errors));
                }
            } else { print_r(json_encode($errors)); }

        break;

    endswitch;
}