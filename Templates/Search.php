<?php


ob_start();
?>
    <script src="assets/public/js/searchNav.js"></script>
<?php
$script = ob_get_clean();


ob_start();

if(isset($chunks)) {


    if(count($chunks) === 7){

        $userInfos = $chunks[0][0][0];
        $searchResults = $chunks[1];
        $allCats = $chunks[2][0];
        $allCond = $chunks[3][0];
        $allShip = $chunks[4][0];
        $allPrices = $chunks[5][0];
        $rightsName = $chunks[6][0][0];

    } else {

        $searchResults = $chunks[0];
        $allCats = $chunks[1][0];
        $allCond = $chunks[2][0];
        $allShip = $chunks[3][0];
        $allPrices = $chunks[4][0];
        $rightsName = $chunks[5][0][0];

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
                        <?php for( $i = 0 ; $i <= $allCats[$i]; $i++): ?>
                            <option value="<?= $allCats[$i]['id'] ?>"><?= $allCats[$i]['name'] ?>  </option>
                        <?php endfor; ?>
                    </select>
                    <small id="searchCategorySmall"></small>

                </div>

                <div >

                    <label for="priceRange" class="p-3">Max price</label>
                    <input type="range" id="priceRangeMin" name="rangeMin" min="<?= $allPrices[0]['price']  ?>" max="<?= end($allPrices)['price'] ?>" step="any" class=" ms-2 rounded-pill" >
                    <input type="range" id="priceRangeMax" name="rangeMax" min="<?= $allPrices[0]['price']  ?>" max="<?= end($allPrices)['price'] ?>" step="any" class=" me-2 rounded-pill" >
                    <br>
                    <small id="priceRangeShowMin" class="ms-3">min Price</small>
                    <small id="priceRangeShowMax" class="ms-3">max Price</small>
                    <small id="priceRangeSmall"></small>

                    <div>

                        <label for="condSearch" class="p-2">Conditions</label>
                        <select id="condSearch" class=" w-50 h6 border border-1 rounded-2" name="condSearch">
                            <option value="">select conditions</option>
                            <?php for( $i = 0 ; $i <= $allCond[$i]; $i++): ?>
                                <option value="<?= $allCond[$i]['id'] ?>"><?= $allCond[$i]['name'] ?>  </option>
                            <?php endfor; ?>
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
                            <?php for( $i = 0 ; $i <= $allShip[$i]; $i++): ?>
                                <option value="<?= $allShip[$i]['id'] ?>"><?= $allShip[$i]['name'] ?>  </option>
                            <?php endfor; ?>
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
                <div class="d-flex d-flex-column-mobile overflow-scroll justify-content-evenly">

                    <?php var_dump($searchResults); if(isset($searchResults)):?>
                        <?php  for($i=0;$i<=isset($searchResults[0][$i]);$i++): ?>

                            <div class="rounded-3 bg-white mb-3 shadow-sm text-black col-xl-3">

                                <div class="p-1">

                                    <a href="index?ListingPage=<?= $searchResults[0][$i]['id']?>" class="d-flex flex-column text-black d-flex-column-mobile">

                                        <div class="img-wrap-img d-flex flex-column align-items-center justify-content-center">
                                            <div class=" rounded-1 img-wrapper">
                                                <img src="<?= $searchResults[0][$i]['img_url_1'] ?>" class="img-card"  >
                                            </div>
                                            <div class="h3 fw-bold p-1 cond-font rounded-1 ">
                                                €  <?= $searchResults[0][$i]['price'] ?>
                                            </div>
                                        </div>


                                        <div class="container row ">
                                            <div class="h3 p-1 rounded-1 ">
                                                <?= substr(ucfirst($searchResults[0][$i]['title']),0,14).'<small class="fw-lighter">...</small>' ?>
                                            </div>

                                        </div>


                                        <div class="row p-1">
                                            <div class="">
                                                <div class="flex-nowrap fw-lighter">
                                                    <b class="me-1"><?= $searchResults[0][$i]['id_categories'] ?></b>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-1">
                                            <small class="small">condition: </small>
                                            <b class="me-1">
                                                <?= ucfirst($searchResults[0][$i]['obj_condition']) ?>
                                            </b>
                                            <br>
                                            <small class="small">location: </small>
                                            <b class="me-1 orange-font">
                                                <?= ucfirst($searchResults[0][$i]['city']) ?>
                                                <?= ucfirst($searchResults[0][$i]['zipCode']) ?>
                                            </b>
                                        </div>



                                    </a>

                                </div>

                            </div>

                        <?php  endfor; ?>
                    <?php endif; ?>

                </div>

        </div>
    </div>
<?php $content = ob_get_clean(); ?>

































