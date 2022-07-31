<?php


ob_start();
?>
<script src="assets/public/js/searchNav.js"></script>
<?php
$script = ob_get_clean();


ob_start();

if(isset($chunks)){

    if(count($chunks) === 10){

        $userInfos = $chunks[0][0][0];
        $listingInfo = $chunks[1][0][0];
        $allListCat = $chunks[2][0];
        $allCats = $chunks[3][0];
        $allSubCat = $chunks[4][0];
        $emailOwner = $chunks[5];
        $allCond = $chunks[6][0];
        $allShip = $chunks[7][0];
        $allPrices = $chunks[8][0];
        $rightsName = $chunks[9][0][0];

    } else {

        $listingInfo = $chunks[0][0][0];
        $allListCat = $chunks[1][0];
        $allCats = $chunks[2][0];
        $allSubCat = $chunks[3][0];
        $emailOwner = $chunks[4][0];
        $allCond = $chunks[5][0];
        $allShip = $chunks[6][0];
        $allPrices = $chunks[7][0];
        $rightsName = $chunks[8][0][0];

    }


    $crumble = [];
    $id = [];

    for( $m = 0; $m <= isset($allSubCat[$m]); $m++){
        for( $k = 0; $k <= isset($allCats[$k]); $k++){
            if($listingInfo['id_categories'] === $allCats[$k]['id']){
                $crumble [] = $allCats[$k]['name'];
                $id [] = $allCats[$k]['id'];
            }
            if($listingInfo['id_subcategories'] === $allSubCat[$m]['id']){
                $crumble [] = $allSubCat[$m]['name'];
                $id [] = $allSubCat[$m]['name'];
            }
            if(count($crumble) === 2){
                break;
            }
        }
    }



} else {
    header('location: index');
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

                    <label for="priceRangeMin" class="p-3">Min price</label>
                    <input type="range" id="priceRangeMin" name="rangeMin" min="<?= $allPrices[0]['price']  ?>" max="<?= end($allPrices)['price'] ?>" step="any" class=" ms-2 rounded-pill" >
                    <label for="priceRangeMax" class="p-3">Max price</label>
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

        <div class="flex-nowrap">
            <?php for( $i = 0 ; $i <= 1; $i++): ?>

                <?php if( $i === 0 ):  ?>
                    <a href="index?Categories=<?= $id[$i] ?>"> <?= $crumble[$i] ?> </a> >
                <?php else : ?>
                    <a href="index?Categories=<?= $id[$i] ?>"> <?= $crumble[$i] ?> </a>
                <?php endif; ?>

            <?php endfor;  ?>
        </div>

            <div class="container d-flex justify-content-evenly d-flex-column-mobile p-4">

                <div class="p-4">

                    <div class="img-wrap-medium d-flex flex-column align-items-center justify-content-center">
                        <a href="<?= $listingInfo['img_url_1'] ?>" class=" rounded-1 img-wrapper-medium">
                            <img src="<?= $listingInfo['img_url_1'] ?>" class="img-card-medium"  >
                        </a>
                    </div>

                    <div class="img-wrap-img d-flex d-flex-column-mobile align-items-center justify-content-center">
                        <a href="<?= $listingInfo['img_url_2'] ?>" class=" rounded-1 img-wrapper-sm">
                            <img src="<?= $listingInfo['img_url_2'] ?>" class="img-card-sm"  >
                        </a>
                        <a href="<?= $listingInfo['img_url_3'] ?>" class=" rounded-1  img-wrapper-sm">
                            <img src="<?= $listingInfo['img_url_3'] ?>" class="img-card-sm"  >
                        </a>
                        <a href="<?= $listingInfo['img_url_4'] ?>" class=" rounded-1  img-wrapper-sm">
                            <img src="<?= $listingInfo['img_url_4'] ?>" class="img-card-sm"  >
                        </a>

                    </div>

                </div>

                <div class=" p-4">

                    <div>

                        <div class="h1 p-3">

                            <?= $listingInfo['title'] ?>

                        </div>

                        <?php if( $listingInfo['offer_state'] === '1' && (isset($_SESSION['id']) && $listingInfo['id_owner'] !== $_SESSION['id']) ) : ?>

                            <div class="p-3 text-end">
                                <a href="index?owner=<?= base64_encode(base64_encode($emailOwner[0][0]['email'].','.$listingInfo['title'])) ?>" class="h6 contact-shop" rel="noopener noreferrer">Contact the Shop directly from your mail<div class="flex-nowrap"><img class="img-email-fx " src="assets/public/icons/email.svg" ></div></a>
                            </div>

                        <?php endif; ?>

                    </div>

                    <br>

                    <div class="h3 p-3">

                        € <?= $listingInfo['price'] ?>

                    </div>

                    <div>

                        <?= $listingInfo['description'] ?>

                    </div>

                </div>

            </div>

        </div>

        <hr>

        <div>

            <div class="h2 p-3">Other items from the same Category</div>
            <div class="d-flex d-flex-column-mobile overflow-scroll justify-content-evenly">

                <?php for ($i = 0 ; $i<=isset($allListCat[$i]); $i++):  ?>
                    <?php if( $allListCat[$i]['offer_state'] === '1') :?>

                        <a href="index?ListingPage=<?= $allListCat[$i]['id'] ?>" class="p-2 rounded-1 border-orange">

                            <div class="h5 p-1"> <?= $allListCat[$i]['title'] ?> </div>
                            <div class="img-wrap-img d-flex flex-column align-items-center justify-content-center">
                                <div class=" rounded-1 img-wrapper">
                                    <img src="<?= $allListCat[$i]['img_url_1'] ?>" class="img-card"  >
                                </div>
                            </div>
                            <hr>

                            <div class="d-flex">
                                <div class="h5 p-1">  € <?= $allListCat[$i]['price'] ?> </div>
                            </div>

                        </a>

                    <?php endif; ?>
                <?php endfor; ?>

            </div>

        </div>

    </div>
<?php $content = ob_get_clean(); ?>

