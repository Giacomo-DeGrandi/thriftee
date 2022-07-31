<?php



ob_start();

if(isset($chunks)){

    $infoUser = $chunks[0];

    if(count($chunks)>0){

        $listingInfos = $chunks[1];
        $listingInfos = array_merge(...array_values($listingInfos));

        if(count($listingInfos)>0){

            for($i = 0; $i <= isset($listingInfos[$i]); $i++){
                $v= $listingInfos[$i];
                $active = array_filter($listingInfos, function($v) { return str_contains($v['offer_state'], 1); });
                $sold = array_filter($listingInfos, function($v) { return str_contains($v['offer_state'], 2); });
                $ended = array_filter($listingInfos, function($v) { return str_contains($v['offer_state'], 3); });
            }
        }

    }
}


?>
    <div class="container">

        <!-- CRUMBLES  -->
        <div class="d-flex flex-row p-2 flex-wrap">
            <form method="get" action="index?" class="text-start">
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoPersonal">Personal Information</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoPassword">Password</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoAddress">Address</button>
                <?php  if($rightsName[0] !== 'Buyer'): ?>
                    <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoListings">Listings</button>
                <?php  endif;  ?>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoProfile">Public Profile</button>
            </form>
        </div>

        <hr>

        <div class="d-flex flex-row p-2 flex-wrap">
            <form method="get" action="index?" class="text-start">
                <button type="submit" class="h5 p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoListings">All Listings</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="myListings" value="1">Actives</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="myListings"  value="2">Sold</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="myListings"  value="3">Ended</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border-blue ms-5 float-end" name="addNewListing">Add new listing</button>
            </form>
        </div>

        <hr>

        <div class="d-flex flex-row d-flex-column-mobile align-items-center justify-content-center flex-wrap text-center">

            <div class="col p-2">
                <div class="h2 blue-font">Actives</div>
                <div class="border border-0 rounded-pill h1 orange-font p-2 shadow-sm"><?php  if(isset($active)){ echo count($active); }  ?></div>
            </div>

            <div class="col p-2">
                <div class="h2 blue-font">Sold</div>
                <div class="border border-0  rounded-pill h1 orange-font p-2 shadow-sm"><?php  if(isset($sold)){ echo count($sold); } ?></div>
            </div>

            <div class="col p-2">
                <div class="h2 blue-font">Ended</div>
                <div class="border border-0  rounded-pill  h1 orange-font p-2 shadow-sm"><?php  if(isset($ended)){ echo count($ended); } ?></div>
            </div>

            <div class="col p-2">
                <div class="h2 blue-font">Total</div>
                <div class="border border-0 rounded-pill h1 orange-font p-2 shadow-sm"><?php  if(isset($active)&&isset($sold)&&isset($ended)){ echo count($active)+count($sold)+count($ended); }  ?></div>
            </div>
        </div>

        <hr>

        <div class="container row p-4">
            <form method="post" enctype="multipart/form-data">

                <h3>Bumped Listings</h3>
            </form>

        </div>

        <hr>


        <!--  COMMENTS  -->
        <div class="row p-4"></div>

    </div>

<?php
$content = ob_get_clean();
