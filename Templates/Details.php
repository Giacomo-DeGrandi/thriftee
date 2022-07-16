<?php


/* AN INTRODUCTION TO SECURITY FILE UPLOAD

Security information
First of all, the most important thing I want to tell you, the $_FILES variable in PHP (except tmp_name) can be modified.
That means, do not check e.g. the filesize with $_FILES['myFile']['size'], because this can be modified by the uploader
in case of an attack. In other words, when you validate the upload with this method, attackers can pretend that their
file has another file size or type.

As you can see, there is a lot we need to take care of. Maybe it's worth considering to use an already existing service.
With Uploadcare you can upload and manage files quickly and easily via their PHP integration.



*/

ob_start();
?>
<div class="container-fluid">
    <div class="d-flex flex-column align-items-center justify-content-center">

        <h1 class="p-3">Account Details</h1>

        <form method="post" action="index?profile" class="form w-100 p-4" enctype="multipart/form-data">

            <!-- Email input -->
            <div class="form-outline mb-4 d-flex align-items-center justify-content-evenly">

                <p class="h4">*Register as: </p>

                <input type="checkbox" class="border border-0 ms-3" name="buyer" id="termsBox">
                <label for="terms" class="h3">Buyer 🛍️</label><br>

                <input type="checkbox" class="border border-0 ms-3" name="buyer" id="termsBox">
                <label for="terms" class="h3">Shop 🏢</label><br>

            </div>

            <!-- BUYER EXPLANATION  -->
            <p class="h5 mb-3">As a <b class="orange-font">Buyer</b> you will be able to find your treasures thrifts,
            to contact other buyers and sellers and to give them feedback after your purchases</p>

            <!-- SELLER EXPLANATION  -->
            <p class="h5 mb-3">As a <b class="orange-font">Shop</b> you will be able to sell your thrifts,
                to contact other buyers and sellers, to manage your offers before selling them</p>

            <p class="h6 mb-3"><i>*You will not be able to change after sign up validation.</i></p>

            <hr>

            <div class="form-outline mt-4 mb-5 d-flex align-items-center justify-content-evenly">

                <div class="col">
                    <h4>Your profile picture </h4>
                    <div class="w-25 h-50 border border-light"></div>
                </div>

                <div class="col">
                    <label for="myFile"  class="bg-white orange-font p-2 hover-underline-animation">
                        <input type="file" id="myFile" class="d-none" name="myFile"/>
                        Choose a picture
                    </label>
                    <button type="submit" class="btn btn-block bg-orange" value="upload">upload</button>
                </div>


            </div>

            <hr>

            <div class="form-outline mt-4 mb-5 d-flex flex-column align-items-center justify-content-evenly">

                <div class="col-4">
                    <h4>Your Bios </h4>
                    <div class="w-25 h-50 border border-light"></div>
                </div>

            </div>

            <hr>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="passwordIn" name="passwordIn" class="form-control" />
                <label class="form-label" for="password">Password</label>
                <small></small>
            </div>

            <!-- Submit button -->
            <div class="p-4">
                <button type="button" class="btn bg-orange btn-block mb-4" name="singin" id="signin">Sign In</button>
            </div>

            <!-- CSRF Token  -->
            <input type="hidden" name="token" id="token" value="<?= $_SESSION["token"] ?>"/>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();