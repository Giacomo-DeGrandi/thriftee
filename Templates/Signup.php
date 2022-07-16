<?php

ob_start();
?>
    <script src="assets/public/js/signup.js"></script>
<?php
$script = ob_get_clean();



ob_start();
?>
<div class="container-fluid">
    <div class="row flex-wrap">
        <span class="w-15"> </span>
        <div class="col">
            <div class="signup-img col d-none-mobile h-50">
            </div>
            <h1 class="h1 darkgray-font p-3">Support independent creators</h1>
            <p class="lead p-3">There’s no Thriftee warehouse – just millions of people selling the things they love.
                We make the whole process easy, helping you connect directly with makers to find
                something extraordinary.</p>
        </div>
        <div  class="col p-4 me-5">
            <form class="p-4" id="formSignup">
                <p class="p-2 h1 mb-4 darkgray-font">Subscribe</p>

                <div class="row mb-2">
                    <p class="h4 darkgray-font">Details</p>

                    <!-- Firstname input -->
                    <div class="col-md-6 mb-4 ">
                        <input class="form-control" id="name" name="name" type="text">
                        <label class="form-label" for="firstname">First Name</label><br>
                        <small></small>
                    </div>

                    <!-- Lastname input -->
                    <div class="col-md-6 mb-4 ">
                        <input class="form-control" id="lastname" name="lastname" type="text">
                        <label class="form-label" for="lastname">Lastname</label><br>
                        <small></small>
                    </div>

                    <hr>

                </div>

                <p class="h4 darkgray-font">Account</p>

                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control" />
                    <label class="form-label" for="username">Username</label><br>
                    <small></small>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" />
                    <label class="form-label" for="email">Email address</label><br>
                    <small></small>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" />
                    <label class="form-label" for="password">Password</label><br>
                    <small></small>
                </div>

                <!-- Password confirmation -->
                <div class="form-outline mb-4">
                    <input type="password" id="passwordConf" name="passwordConf" class="form-control" />
                    <label class="form-label" for="passwordConf">Password confirmation</label><br>
                    <small></small>
                </div>

                <!-- DOB -->
                <div class="row text-start">
                    <div class="col d-flex flex-column text-start">
                        <input type="date" class="p-2 border border-1 rounded-pill bg-light-d w-75" name="date" id="date">
                        <label class="form-label" for="date">Date of birth</label><br>
                        <small></small>
                    </div>
                    <!-- Terms -->
                    <div class="col d-flex flex-column text-start text-nowrap">
                        <div class="row w-75">
                            <p class="small h6">I've read and I accept<br><a href="../../divers/TERMS.txt" class=" p-2">all the Terms</a>
                                <input type="checkbox" class="p-2 border border-0 bg-cherry-white" name="terms" id="termsBox">
                                <label for="terms" class="py-1 text-cherry">Terms</label><br>
                                <br><small></small>
                            </p>
                        </div>
                    </div>
                </div>



                <!-- Submit button -->
                <div class="p-4">
                    <button type="button" class="btn bg-orange btn-block mb-4" name="subscribe" id="subscribe">Subscribe</button>
                </div>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Already a member? <a href="index?signin">Sign in</a></p>
                </div>


            </form>
        </div>
    </div>
</div>
<?php

$content = ob_get_clean();