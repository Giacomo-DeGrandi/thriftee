<?php



ob_start();

if(isset($chunks)){
    if(count($chunks) === 2){
        $requested= $chunks[0][0][0];
        if(isset($chunks[1][0][0])){
            $rightsName = $chunks[1][0][0];
        } else {
            $errors = $chunks[1][0];
        }
    } else {
        $requested= $chunks[0][0][0];
        if(isset($chunks[1][0][0])){
            $errors = $chunks[1][0][0];
        } else {
            $errors = $chunks[1][0];
        }
        $rightsName = $chunks[2][0][0];
    }
}


?>
    <div class="container">

        <!-- CRUMBLES  -->
        <div class="d-flex flex-row p-4 flex-wrap">
            <form method="get" action="index?" class="text-start">
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoPersonal">Personal Information</button>
                <button type="submit" class="h5 p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoPassword">Password</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoAddress">Address</button>
                <?php  if($rightsName[0] !== 'Buyer'): ?>
                    <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoListings">Listings</button>
                <?php  endif;  ?>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoProfile">Public Profile</button>
            </form>
        </div>

        <hr>

        <!-- ERRORS  -->

        <div class="d-flex align-items-center justify-content-center h5 orange-font p-1"><?php if(isset($errors) && !empty($errors)){ for($i=0;$i<=isset($errors[$i]);$i++){ echo $errors[$i]; }  } ?></div>


        <!-- MODIFY  -->
        <div class="container row p-1">
            <form method="post" enctype="multipart/form-data" action="index?updatePassword">

                <table class="table">
                    <tr>
                        <th class="col-4 h3 p-4 blue-font">Password</th>
                    </tr>
                    <tr>
                        <td class="col-8 h5 p-4">
                            <label for="name" class="p-2">Password</label>
                            <input type="password" name="password" class="border border-1" > <br class="d-none-desktop">
                            <label for="name" class="p-2">Password Confirmation</label>
                            <input type="password" name="passwordConf" class="border border-1" >
                        </td>
                    </tr>
                </table>

                <hr>

                <!-- CSRF Token  -->
                <input type="hidden" name="token" id="token" value="<?= $_SESSION["token"] ?>"/>



                <div class="d-flex align-items-center justify-content-center">
                    <button type="submit" class="bg-blue border border-0 rounded-1" name="infoPass">Save</button>
                </div>
            </form>

        </div>

        <hr>

        <!--  COMMENTS  -->
        <div class="row p-4"></div>

    </div>

<?php
$content = ob_get_clean();
