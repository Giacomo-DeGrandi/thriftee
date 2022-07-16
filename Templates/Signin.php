<?php

ob_start();
?>
    <script src="assets/public/js/signin.js"></script>
<?php
$script = ob_get_clean();


ob_start();
?>
    <div class="container-fluid">
        <div class="row flex-wrap">
            <span class="w-15"> </span>
            <div class="signin-img col p-5">
            </div>
            <div  class="col p-4 me-5">
                <form class="p-4 " method="post" id="formSignin">
                    <p class="p-2 h1 mb-4 darkgray-font">Sign In</p>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="emailIn" name="emailIn" class="form-control" />
                        <label class="form-label" for="email">Email address</label>
                        <small></small>
                    </div>

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

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Not a member? <a href="index?signup">Register</a></p>
                    </div>




                </form>
            </div>
        </div>
    </div>
<?php

$content = ob_get_clean();