<?php


ob_start();
?>
    <script src="assets/public/js/searchNav.js"></script>
<?php
$script = ob_get_clean();


ob_start();

if(isset($chunks)) {


    if(count($chunks) === 10){

        $userInfos = $chunks[0][0][0];
        $searchResults = $chunks[1][0];
        $allCats = $chunks[2][0];
        $allCond = $chunks[3][0];
        $allShip = $chunks[4][0];
        $allPrices = $chunks[5][0];
        $allUsers = $chunks[6][0];
        $allSubCat = $chunks[7][0];
        $mostView = $chunks[8][0];
        $rightsName = $chunks[9][0][0];

    } else {

        $searchResults = $chunks[0][0];
        $allCats = $chunks[1][0];
        $allCond = $chunks[2][0];
        $allShip = $chunks[3][0];
        $allPrices = $chunks[4][0];
        $allUsers = $chunks[5][0];
        $allSubCat = $chunks[6][0];
        $mostView = $chunks[7][0];
        $rightsName = $chunks[8][0][0];
    }


    if(!empty($searchResults)) {

        for ($j = 0; $j <= isset($searchResults[$j]); $j++) {
            for ($k = 0; $k <= isset($allCats[$k]); $k++) {          // ----------> REPLACE CATNAMES
                if ($searchResults[$j]['id_categories'] === $allCats[$k]['id']) {
                    $searchResults[$j]['id_categories'] = $allCats[$k]['name'];
                }
            }
            for ($k = 0; $k <= isset($allShip[$k]); $k++) {          // ----------> REPLACE SHIPMETHOD
                if ($searchResults[$j]['shipping'] === $allShip[$k]['id']) {
                    $searchResults[$j]['shipping'] = $allShip[$k]['name'];
                }
            }
            for ($k = 0; $k <= isset($allSubCat[$k]); $k++) {          // ----------> REPLACE SUBCATS
                if ($searchResults[$j]['id_subcategories'] === $allSubCat[$k]['id']) {
                    $searchResults[$j]['id_subcategories'] = $allSubCat[$k]['name'];
                }
            }
            for ($k = 0; $k <= isset($allCond[$k]); $k++) {          // ----------> REPLACE COND
                if ($searchResults[$j]['obj_condition'] === $allCond[$k]['id']) {
                    $searchResults[$j]['obj_condition'] = $allCond[$k]['name'];
                }
            }
            for ($k = 0; $k <= isset($allUsers[$k]); $k++) {          // ----------> USER NAME COND
                if ($searchResults[$j]['id_owner'] === $allUsers[$k]['id']) {
                    $searchResults[$j]['id_owner'] = $allUsers[$k]['name'];
                    $searchResults[$j]['city'] = $allUsers[$k]['city'];
                    $searchResults[$j]['zipCode'] = $allUsers[$k]['zip_code'];
                }
            }
        }


    }
    if(!empty($mostView)) {

        for ($j = 0; $j <= isset($mostView[$j]); $j++) {
            for ($k = 0; $k <= isset($allCats[$k]); $k++) {          // ----------> REPLACE CATNAMES
                if ($mostView[$j]['id_categories'] === $allCats[$k]['id']) {
                    $mostView[$j]['id_categories'] = $allCats[$k]['name'];
                }
            }
            for ($k = 0; $k <= isset($allShip[$k]); $k++) {          // ----------> REPLACE SHIPMETHOD
                if ($mostView[$j]['shipping'] === $allShip[$k]['id']) {
                    $mostView[$j]['shipping'] = $allShip[$k]['name'];
                }
            }
            for ($k = 0; $k <= isset($allSubCat[$k]); $k++) {          // ----------> REPLACE SUBCATS
                if ($mostView[$j]['id_subcategories'] === $allSubCat[$k]['id']) {
                    $mostView[$j]['id_subcategories'] = $allSubCat[$k]['name'];
                }
            }
            for ($k = 0; $k <= isset($allCond[$k]); $k++) {          // ----------> REPLACE COND
                if ($mostView[$j]['obj_condition'] === $allCond[$k]['id']) {
                    $mostView[$j]['obj_condition'] = $allCond[$k]['name'];
                }
            }
            for ($k = 0; $k <= isset($allUsers[$k]); $k++) {          // ----------> USER NAME COND
                if ($mostView[$j]['id_owner'] === $allUsers[$k]['id']) {
                    $mostView[$j]['id_owner'] = $allUsers[$k]['name'];
                    $mostView[$j]['city'] = $allUsers[$k]['city'];
                    $mostView[$j]['zipCode'] = $allUsers[$k]['zip_code'];
                }
            }
        }


    }

}

?>
    <div class="container">

        <div class="p-2">

            <form action="index?SearchPage" method="get" id="listForm" class="container d-flex justify-content-evenly d-flex-column-mobile">

                <div>

                    <label for="searchTitle" class="p-2"> Search in the offer title </label><br>
                    <input type="text" class="border border-1 rounded-pill mb-4" name="searchTitle" id="searchTitle" placeholder="search in title.."><br>
                    <small id="searchTitleSmall"></small>

                    <label for="searchCategory" class="h6 p-2">Categories</label><br>

                    <select id="searchCategory" class="h6 p-1 border border-1 rounded-2 mb-2" name="searchCategory">
                        <option value="">select category</option>
                        <?php if(isset($allCats)) : ?>
                            <?php  for( $i = 0 ; $i <= $allCats[$i]; $i++): ?>
                                <option value="<?= $allCats[$i]['id'] ?>"><?= $allCats[$i]['name'] ?>  </option>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </select>
                    <small id="searchCategorySmall"></small>

                </div>

                <div >

                    <label for="priceRange" class="p-3">Max price</label>
                    <?php if(isset($allPrices)) : ?>
                    <input type="range" id="priceRangeMin" name="rangeMin" min="<?= $allPrices[0]['price']  ?>" max="<?= end($allPrices)['price'] ?>" step="any" class=" ms-2 rounded-pill" >
                    <input type="range" id="priceRangeMax" name="rangeMax" min="<?= $allPrices[0]['price']  ?>" max="<?= end($allPrices)['price'] ?>" step="any" class=" me-2 rounded-pill" >
                    <br>
                    <?php endif; ?>
                    <small id="priceRangeShowMin" class="ms-3">min Price</small>
                    <small id="priceRangeShowMax" class="ms-3">max Price</small>
                    <small id="priceRangeSmall"></small>

                    <div>

                        <label for="condSearch" class="p-2">Conditions</label>
                        <select id="condSearch" class=" w-50 h6 border border-1 rounded-2" name="condSearch">
                            <option value="">select conditions</option>
                            <?php if(isset($allCond)) : ?>
                            <?php for( $i = 0 ; $i <= $allCond[$i]; $i++): ?>
                                <option value="<?= $allCond[$i]['id'] ?>"><?= $allCond[$i]['name'] ?>  </option>
                            <?php endfor; ?>
                            <?php endif; ?>
                        </select>
                        <small id="condSearchSmall"></small>


                    </div>

                </div>

                <div >

                    <div class="row p-2">
                        <label for="yearSearch" class="p-2">From Year</label>
                        <input type="number" name="yearSearch" id="yearSearch" min="1900" max="2099" step="1" placeholder="year" /> <br>
                        <small id="yearSearchSmall"></small>
                    </div>


                    <div class="mb-2">
                        <label for="shipMethSearch">Shipping Method</label>
                        <select id="shipSearch" class=" w-50 h6 border border-1 rounded-2" name="shipSearch">
                            <option value="">select shipping method</option>
                            <?php if(isset($allShip)) : ?>
                                <?php for( $i = 0 ; $i <= $allShip[$i]; $i++): ?>
                                    <option value="<?= $allShip[$i]['id'] ?>"><?= $allShip[$i]['name'] ?>  </option>
                                <?php endfor; ?>
                            <?php endif; ?>
                        </select>
                        <small id="shipSearchSmall"></small>

                    </div>

                    <div class="mt-3">
                        <button type="submit" class="w-100 border border-0 bg-orange rounded-pill" name="searchNav" id="searchNav" value="searchNav">search</button>
                    </div>

                </div>


            </form>

        </div>

        <hr>

        <div>

            <div class="h2 p-3">Most Pertinent Results</div>
                <div class="d-flex d-flex-column-mobile justify-content-evenly">

                    <?php if(isset($searchResults) && !empty($searchResults)):?>
                        <?php  for($i=0;$i<=isset($searchResults[$i]);$i++): ?>

                            <div class="rounded-3 bg-white mb-3 shadow-sm text-black col-xl-3">

                                <div class="p-1">

                                    <a href="index?ListingPage=<?= $searchResults[$i]['id']?>" class="d-flex flex-column text-black d-flex-column-mobile">

                                        <div class="img-wrap-img d-flex flex-column align-items-center justify-content-center">
                                            <div class=" rounded-1 img-wrapper">
                                                <img src="<?= $searchResults[$i]['img_url_1'] ?>" class="img-card"  >
                                            </div>
                                            <div class="h3 fw-bold p-1 cond-font rounded-1 ">
                                                €  <?= $searchResults[$i]['price'] ?>
                                            </div>
                                        </div>


                                        <div class="container row ">
                                            <div class="h3 p-1 rounded-1 ">
                                                <?= substr(ucfirst($searchResults[$i]['title']),0,14).'<small class="fw-lighter">...</small>' ?>
                                            </div>

                                        </div>


                                        <div class="row p-1">
                                            <div class="">
                                                <div class="flex-nowrap fw-lighter">
                                                    <b class="me-1"><?= $searchResults[$i]['id_categories'] ?></b>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-1">
                                            <small class="small">condition: </small>
                                            <b class="me-1">
                                                <?= ucfirst($searchResults[$i]['obj_condition']) ?>
                                            </b>
                                            <br>
                                            <small class="small">location: </small>
                                            <b class="me-1 orange-font">
                                                <?= ucfirst($searchResults[$i]['city']) ?>
                                                <?= ucfirst($searchResults[$i]['zipCode']) ?>
                                            </b>
                                        </div>



                                    </a>

                                </div>

                            </div>

                        <?php  endfor; ?>
                    <?php else: ?>
                    <div class="d-flex flex-column">
                        <div class="h1">there are no matchings for your research, sorry :(</div>
                        <div class="p-2 h4">Check this offers or search again</div>


                        <div class="d-flex d-flex-column-mobile">
                            <?php if(isset($mostView) && !empty($mostView)):?>
                                <?php  for($i=0;$i<=isset($mostView[$i]);$i++): ?>

                                    <div class="p-4 rounded-3 bg-white mb-3 shadow-sm text-black col-xl-4">

                                        <div class="p-1">

                                            <a href="index?ListingPage=<?= $mostView[$i]['id']?>" class="d-flex flex-column align-items-center text-black d-flex-column-mobile">

                                                <div class="img-wrap-img d-flex flex-column align-items-center justify-content-center">
                                                    <div class=" rounded-1 img-wrapper">
                                                        <img src="<?= $mostView[$i]['img_url_1'] ?>" class="img-card"  >
                                                    </div>
                                                    <div class="h3 fw-bold p-1 cond-font rounded-1 ">
                                                        €  <?= $mostView[$i]['price'] ?>
                                                    </div>
                                                </div>


                                                <div class="container row ">
                                                    <div class="h3 p-1 rounded-1 ">
                                                        <?= substr(ucfirst($mostView[$i]['title']),0,14).'<small class="fw-lighter">...</small>' ?>
                                                    </div>

                                                </div>


                                                <div class="row p-1">
                                                    <div class="">
                                                        <div class="flex-nowrap fw-lighter">
                                                            <b class="me-1"><?= $mostView[$i]['id_categories'] ?></b>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="p-1">
                                                    <small class="small">condition: </small>
                                                    <b class="me-1">
                                                        <?= ucfirst($mostView[$i]['obj_condition']) ?>
                                                    </b>
                                                    <br>
                                                    <small class="small">location: </small>
                                                    <b class="me-1 fw-bolder">
                                                        <?= ucfirst($mostView[$i]['city']) ?>
                                                        <?= ucfirst($mostView[$i]['zipCode']) ?>
                                                    </b>
                                                </div>



                                            </a>

                                        </div>

                                    </div>

                                <?php  endfor; ?>
                            <?php endif; ?>
                        </div>


                    </div>
                    <?php endif; ?>

                </div>

        </div>
    </div>
<?php $content = ob_get_clean(); ?>

































