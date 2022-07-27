<?php


ob_start();

$userInfos = $chunks[0];
$stateListings = $chunks[1];
$stateListings = array_merge(...array_values($stateListings));
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

        <p class="h2 p-4 blue-font">Your Sold Listings</p>

        <div class="d-flex p-1 container">

            <?php for($i = 0; $i <= isset($stateListings[$i]); $i++):  ?>

                <div class="rounded-3 bg-white mb-3 shadow-sm text-black col-xl-3">

                    <div class="p-1">

                        <a href="index?Listing=<?= $stateListings[$i]['id']?>" class="d-flex flex-column d-flex-column-mobile p-1">

                            <div class="img-wrap-img d-flex flex-column align-items-center justify-content-center">
                                <div class="p-1 rounded-1 img-wrapper">
                                    <img src="<?= $stateListings[$i]['img_url_1'] ?>" class="img-card"  >
                                </div>
                            </div>

                            <div>

                                <div class="h3 blue-font p-1 cond-font rounded-1 shadow-sm">
                                    <?= ucfirst($stateListings[$i]['title']) ?>
                                </div>

                                <div class="p-1 rounded-1 bg-light text-black shadow-sm">
                                    <small>
                                        <?= substr(ucfirst($stateListings[$i]['description']),0,100).'...' ?>
                                    </small>
                                </div>

                                <div class="row p-1">
                                    <div class="col p-1">
                                        <div class="flex-nowrap"><small>category:</small><?= $stateListings[$i]['id_categories'] ?></div>
                                    </div>

                                    <div class="col p-1">
                                        <div><small>sub-category: </small><?= $stateListings[$i]['id_subcategories'] ?></div>
                                    </div>
                                </div>

                                <div class="p-1">
                                    <?= ucfirst($stateListings[$i]['obj_condition']) ?>
                                </div>

                            </div>

                        </a>

                    </div>

                </div>

            <?php endfor; ?>

        </div>

    </div>
<?php

$content = ob_get_clean();




