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

            if (!copy($filepath, $newFilepath )) {  $errors [] = "Can't move file."; } // Copy the file, returns false if failed
            unlink($filepath); // Delete the temp file

            // CHOICE

            if($_POST['seller'] == null && $_POST['buyer'] == null){ $errors [] = 'You have to chose at least a role'; }
            if($_POST['seller'] == true && $_POST['buyer'] == true){ $errors [] = 'You can chose at max one role.'; }

            // DETAILS

            if($_POST['address'])

            if(empty($errors)){

                print_r(json_encode('setted'));

            } else { print_r(json_encode('error')); }

        break;

    endswitch;
}