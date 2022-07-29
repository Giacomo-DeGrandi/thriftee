<?php


ob_start();


if(isset($chunks)){
    $userInfos = $chunks[0];
    $stateListings = $chunks[1];
    $catName = $chunks[2];
    $shipName = $chunks[3];
    $subCat = $chunks[4];
    $allCond = $chunks[5];
    $stateListings = array_merge(...array_values($stateListings));
    $catName = array_merge(...array_values($catName));
    $shipName = array_merge(...array_values($shipName));
    $subCat = array_merge(...array_values($subCat));
    $allCond = array_merge(...array_values($allCond));

    if(!empty($stateListings) && count($stateListings)>0 &&
        !empty($catName) && count($catName)>0 &&
        !empty($shipName) && count($shipName)>0 &&
        !empty($subCat) && count($subCat)>0 &&
        !empty($allCond) && count($allCond)>0 ){

        for($j = 0 ;$j <=isset($stateListings[$j]); $j++){
            for($k = 0 ; $k <= isset($catName[$k]); $k++){          // ----------> REPLACE CATNAMES
                if($stateListings[$j]['id_categories'] === $catName[$k]['id']){
                    $stateListings[$j]['id_categories'] = $catName[$k]['name'];
                }
            }
            for($k = 0 ; $k <= isset($shipName[$k]); $k++){          // ----------> REPLACE SHIPMETHOD
                if($stateListings[$j]['shipping'] === $shipName[$k]['id']){
                    $stateListings[$j]['shipping'] = $shipName[$k]['name'];
                }
            }
            for($k = 0 ; $k <= isset($subCat[$k]); $k++){          // ----------> REPLACE SUBCATS
                if($stateListings[$j]['id_subcategories'] === $subCat[$k]['id']){
                    $stateListings[$j]['id_subcategories'] = $subCat[$k]['name'];
                }
            }
            for($k = 0 ; $k <= isset($allCond[$k]); $k++){          // ----------> REPLACE COND
                if($stateListings[$j]['obj_condition'] === $allCond[$k]['id']){
                    $stateListings[$j]['obj_condition'] = $allCond[$k]['name'];
                }
            }

        }
    }

}

/*
function replace_arr_val_onedim(array $arr_to_replace, array $arr_with_values, string $search, string $select, string $replace){
    for( $j = 0 ; $j <= isset($arr_to_replace[$j]) ; $j++){
        for( $k = 0 ; $k <= isset($arr_with_values[$k]); $k++){
            if( $arr_to_replace[$j][$search] === $arr_with_values[$k][$select] ){
                $arr_to_replace[$j][$search] = $arr_with_values[$k][$replace];
            }
        }
    }
}

replace_arr_val_onedim($stateListings, $catName,'id_categories','id','name');
replace_arr_val_onedim($stateListings, $shipName,'shipping','id','name');

*/


?>
<div class="container">

    <!-- CRUMBLES  -->
    <div class="d-flex flex-row p-2 flex-wrap">
        <form method="get" action="index?" class="text-start">
            <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoPersonal">Personal Information</button>
            <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoPassword">Password</button>
            <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoAddress">Address</button>
            <button type="submit" class="h5 p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoListings">Listings</button>
            <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoProfile">Public Profile</button>
        </form>
    </div>

    <hr>

    <div class="d-flex flex-row p-2 flex-wrap">
        <form method="get" action="index?" class="text-start">
            <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoListings">All Listings</button>
            <button type="submit" class="h5 p-1 px-4 bg-white blue-font rounded-pill border border-0" name="myListings" value="1">Actives</button>
            <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="myListings"  value="2">Sold</button>
            <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="myListings"  value="3">Ended</button>
            <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border-blue ms-5 float-end" name="addNewListing">Add new listing</button>
        </form>
    </div>

    <hr>
</div>
    <div class="rounded-3 p-3">

        <p class="h2 p-4 blue-font">Your Active Listings</p>

        <div class="d-flex d-flex-column-mobile p-1 container">

            <?php if(isset($stateListings) && !empty($stateListings)): ?>

                <?php for($i = 0; $i <= isset($stateListings[$i]); $i++):  ?>

                    <div class="rounded-3 bg-white mb-3 shadow-sm text-black col-xl-3">

                        <div class="p-1">

                            <a href="index?ListingPage=<?= $stateListings[$i]['id']?>" class="d-flex flex-column text-black d-flex-column-mobile">

                                <div class="img-wrap-img d-flex flex-column align-items-center justify-content-center">
                                    <div class=" rounded-1 img-wrapper">
                                        <img src="<?= $stateListings[$i]['img_url_1'] ?>" class="img-card"  >
                                    </div>
                                </div>


                                    <div class="container row ">
                                        <div class="h3 p-1 rounded-1 ">
                                            <?= substr(ucfirst($stateListings[$i]['title']),0,14).'<small class="fw-lighter">...</small>' ?>
                                        </div>
                                        <div class="h3 fw-bold p-1 cond-font rounded-1 ">
                                            <small class="h6 fw-lighter">price:</small> €  <?= $stateListings[$i]['price'] ?>
                                        </div>
                                    </div>


                                    <div class="row p-1">
                                        <div class="">
                                            <div class="flex-nowrap">
                                                <small class="small">category:</small>
                                                <b class="me-1"><?= $stateListings[$i]['id_categories'] ?></b>
                                                <small class="small"> > </small>
                                                <b class="me-1"> <?= $stateListings[$i]['id_subcategories'] ?></b>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-1">
                                        <small class="small">condition: </small>
                                        <b class="me-1">
                                            <?= ucfirst($stateListings[$i]['obj_condition']) ?>
                                        </b>
                                    </div>


                            </a>

                        </div>

                    </div>

                <?php endfor; ?>
            <?php else:  ?>
                <div class="p-5">
                    <div class="container h4">
                        <form method="get" action="index?" class="text-start row">
                            <div class="lead"> There are no Active Listings yet!
                                <button type="submit" class="h5  px-4 bg-white border border-0 blue-font ms-5 float-end" name="addNewListing">Add new listing here</button>
                            </div>
                        </form>
                    </div>
                </div>
             <?php endif;  ?>

        </div>

    </div>
<?php

$content = ob_get_clean();



















