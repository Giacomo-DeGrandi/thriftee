<?php



ob_start();

$title = "ThrifteeX";




//var_dump($_SESSION);
//var_dump($_POST);
var_dump($_GET);
//var_dump($_FILES);

if(isset($_SESSION['id'])){
    $userInfos = array_merge(...array_values($chunks[0]));
    $mostViewd = array_merge(...array_values($chunks[1]));
    $allState = array_merge(...array_values($chunks[2]));
    $allCat = array_merge(...array_values($chunks[3]));
    $allSubCat = array_merge(...array_values($chunks[4]));
    $allCond = array_merge(...array_values($chunks[5]));
    $allShip = array_merge(...array_values($chunks[6]));
    $allUsers = array_merge(...array_values($chunks[7]));

} else {
    $mostViewd = array_merge(...array_values($chunks[0]));
    $allState = array_merge(...array_values($chunks[1]));
    $allCat = array_merge(...array_values($chunks[2]));
    $allSubCat = array_merge(...array_values($chunks[3]));
    $allCond = array_merge(...array_values($chunks[4]));
    $allShip = array_merge(...array_values($chunks[5]));
    $allUsers = array_merge(...array_values($chunks[6]));
}




for($j = 0 ;$j <=isset($mostViewd[$j]); $j++){
    for($k = 0 ; $k <= isset($allCat[$k]); $k++){          // ----------> REPLACE CATNAMES
        if($mostViewd[$j]['id_categories'] === $allCat[$k]['id']){
            $mostViewd[$j]['id_categories'] = $allCat[$k]['name'];
        }
    }
    for($k = 0 ; $k <= isset($allShip[$k]); $k++){          // ----------> REPLACE SHIPMETHOD
        if($mostViewd[$j]['shipping'] === $allShip[$k]['id']){
            $mostViewd[$j]['shipping'] = $allShip[$k]['name'];
        }
    }
    for($k = 0 ; $k <= isset($allSubCat[$k]); $k++){          // ----------> REPLACE SUBCATS
        if($mostViewd[$j]['id_subcategories'] === $allSubCat[$k]['id']){
            $mostViewd[$j]['id_subcategories'] = $allSubCat[$k]['name'];
        }
    }
    for($k = 0 ; $k <= isset($allCond[$k]); $k++){          // ----------> REPLACE COND
        if($mostViewd[$j]['obj_condition'] === $allCond[$k]['id']){
            $mostViewd[$j]['obj_condition'] = $allCond[$k]['name'];
        }
    }
    for($k = 0 ; $k <= isset($allUsers[$k]); $k++){          // ----------> USER NAME COND
        if($mostViewd[$j]['id_owner'] === $allUsers[$k]['id']){
            $mostViewd[$j]['id_owner'] = $allUsers[$k]['name'];
            $mostViewd[$j]['city'] = $allUsers[$k]['city'];
            $mostViewd[$j]['zipCode'] = $allUsers[$k]['zip_code'];
        }
    }
}

//var_dump($mostViewd);


?>
    <div class="container-fluid">
        <div class="container">
            <div class="row d-flex-column-mobile">

                <div class="bg-main-img col p-5 mt-4">
                </div>

                <div class="col p-4">

                    <p class="p-4 alt-h1 cond-font darkgray-font">
                        Explore one-of-a-kind finds for one-of-a-kind people.
                    </p>
                    <p class="lead p-4">
                        Thriftee is a global online marketplace, where people come together to make, sell, buy and collect unique items.
                        We’re also a community pushing for positive change for small businesses, people, and the planet.
                    </p>

                    <form method="get" action="index.php?search=" class="p-4 d-flex">
                        <input type="text" class="rounded-pill border p-1 w-100 border-1 border-secondary" placeholder=" Search" aria-label=" Search" aria-describedby="basic-addon2" name="search">
                        <button type="submit" class="input-group-text p-1 rounded-pill bg-orange" value="1" id="basic-addon2" name="searchMain">🔎</button>
                    </form>

                </div>

            </div>


            <div class="h2 p-3">Most View Offers</div>

            <div class="container d-flex align-items-center justify-content-evenly d-flex-column-mobile p-5">

                <?php for($i = 0; $i <= isset($mostViewd[$i]); $i++):  ?>
                    <?php if($mostViewd[$i]['offer_state'] === '1'):  ?>

                        <div class="rounded-3 bg-white mb-3 shadow-sm text-black col-xl-3">

                            <div class="p-1">

                                <a href="index?ListingPage=<?= $mostViewd[$i]['id']?>" class="d-flex flex-column text-black d-flex-column-mobile">

                                    <div class="img-wrap-img d-flex flex-column align-items-center justify-content-center">
                                        <div class=" rounded-1 img-wrapper">
                                            <img src="<?= $mostViewd[$i]['img_url_1'] ?>" class="img-card"  >
                                        </div>
                                        <div class="h3 fw-bold p-1 cond-font rounded-1 ">
                                            €  <?= $mostViewd[$i]['price'] ?>
                                        </div>
                                    </div>


                                    <div class="container row ">
                                        <div class="h3 p-1 rounded-1 ">
                                            <?= substr(ucfirst($mostViewd[$i]['title']),0,14).'<small class="fw-lighter">...</small>' ?>
                                        </div>

                                    </div>


                                    <div class="row p-1">
                                        <div class="">
                                            <div class="flex-nowrap fw-lighter">
                                                <b class="me-1"><?= $mostViewd[$i]['id_categories'] ?></b>
                                                <small class="small"> > </small>
                                                <b class="me-1"> <?= $mostViewd[$i]['id_subcategories'] ?></b>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-1">
                                        <small class="small">condition: </small>
                                        <b class="me-1">
                                            <?= ucfirst($mostViewd[$i]['obj_condition']) ?>
                                        </b>
                                        <br>
                                        <small class="small">location: </small>
                                        <b class="me-1 orange-font">
                                            <?= ucfirst($mostViewd[$i]['city']) ?>
                                            <?= ucfirst($mostViewd[$i]['zipCode']) ?>
                                        </b>
                                    </div>



                                </a>

                            </div>

                        </div>

                    <?php endif; ?>

                <?php endfor; ?>

            </div>

            <div>
                <div class="h2 p-3 orange-font">Discover by Categories</div>

                <div class="row bg-orange d-flex-column-mobile">

                    <?php  for($l = 0; $l <= isset($allCat[$l]); $l++): ?>

                    <div class="bg-white p-4">
                        <div class="border border-1 p-5 rounded-1">
                            <a href="<?= $allCat[$l]['id'] ?>" class=" class h1 p-2"><?= $allCat[$l]['name'] ?></a>
                                <?php  for($k = 0; $k <= isset($allSubCat[$k]); $k++){ ?>
                                    <?php if($allCat[$l]['id'] === $allSubCat[$k]['id_categories'] ){ ?> <!-- check for same name category and extract last 10 most view titles -->
                                        <a href="index?SubCat=<?= $allSubCat[$k]['id'] ?>" class="h5 small border border-1 p-1 rounded-pill shadow-sm" > # <?= $allSubCat[$k]['name'] ?> </a>
                                    <?php } ?>
                                <?php  }  ?>
                        </div>
                    </div>

                    <?php endfor; ?>

                </div>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>

