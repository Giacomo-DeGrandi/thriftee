<?php



ob_start();

if(isset($chunks)){
    if(count($chunks) === 2){
        $address= $chunks[0][0][0];
        if(isset($chunks[1][0][0])){
            $rightsName = $chunks[1][0][0];
        } else {
            $errors = $chunks[1][0];
        }
    } else {
        $address= $chunks[0][0][0];
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
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoPassword">Password</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoAddress">Address</button>
                <?php  if($rightsName[0] !== 'Buyer'): ?>
                    <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoListings">Listings</button>
                <?php  endif;  ?>
                <button type="submit" class="h5 p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoProfile">Public Profile</button>
            </form>
        </div>

        <hr>

        <!-- MODIFY  -->
        <div class="container row p-2">
            <form method="post" enctype="multipart/form-data">

                <h3>Profile</h3>
            </form>

        </div>

        <hr>

        <!--  COMMENTS  -->
        <div class="row p-4"></div>

    </div>

<?php
$content = ob_get_clean();
