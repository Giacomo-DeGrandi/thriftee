<?php



ob_start();
?>
    <script src="assets/public/js/newListing.js"></script>
<?php
$script = ob_get_clean();

ob_start();

$infoUser = $chunks[0];
$cat = $chunks[1];
$cat = array_merge(...array_values($cat));
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
                <button type="submit" class="h5 p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoListings">All Listings</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="myListings" value="1">Actives</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="myListings"  value="2">Sold</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="myListings"  value="3">Ended</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border-blue ms-5 float-end" name="addNewListing">Add new listing</button>
            </form>
        </div>

        <hr>


        <!-- MODIFY  -->
        <div class="container row p-4">
            <form method="post" enctype="multipart/form-data" id="formNewListing">

                <table class="table-borderless">
                    <tr>
                        <th class="h3 p-4 blue-font">Main Informations</th>
                    </tr>
                    <tr>
                        <td class="h5 p-4 d-flex d-flex-column-mobile">
                            <div>
                                <label for="title" class="p-2">Title</label>
                                <input type="text" id="title" name="title" class="border border-1" > <br>
                                <small></small>
                            </div>
                            <div>
                                <label for="price" class="p-2">Price</label>
                                <input type="number" step="0.01" class="border border-1" id="price"> <br>
                                <small></small>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td class="h5 p-4 d-flex flex-row">
                            <div>
                                <label for="description" class="p-2">Description</label><br>
                                <textarea id="description" name="description" class="border border-1" ></textarea><br>
                                <small></small>
                            </div>

                        </td>
                    </tr>
                </table>

                <hr>

                <div class="d-flex flex-column p-4">

                    <div class="p-2 h3 blue-font">Add pictures</div><br>

                    <div class="d-flex flex-row d-flex-column-mobile">

                        <div class="col p-1">
                            <label for="add_pic_1"  class="bg-white orange-font p-2 hover-underline-animation">
                                add #1 +
                                <input type="file" id="add_pic_1" class="d-none" name="add_pic_1"/>
                            </label>
                        </div>

                        <div class="col p-1">
                            <label for="add_pic_2"  class="bg-white orange-font p-2 hover-underline-animation">
                                add #2 +
                                <input type="file" id="add_pic_2" class="d-none" name="add_pic_2"/>
                            </label>
                        </div>

                        <div class="col p-1">
                            <label for="add_pic_3"  class="bg-white orange-font p-2 hover-underline-animation">
                                add #3 +
                                <input type="file" id="add_pic_3" class="d-none" name="add_pic_3"/>
                            </label>
                        </div>

                        <div class="col p-1">
                            <label for="add_pic_4"  class="bg-white orange-font p-2 hover-underline-animation">
                                add #4 +
                                <input type="file" id="add_pic_4" class="d-none" name="add_pic_4"/>
                            </label>
                        </div>

                    </div>

                    <div class="d-flex flex-row d-flex-column-mobile">
                        <small class="h6 col" id="imgListSmall1"></small>
                        <small class="h6 col" id="imgListSmall2"></small>
                        <small class="h6 col" id="imgListSmall3"></small>
                        <small class="h6 col" id="imgListSmall4"></small>
                    </div>


                </div>

                <hr>

                <table class="table table-borderless">
                    <tr>
                        <th class="col-4 h3 p-4 blue-font">Categories</th>
                    </tr>
                    <tr>
                        <td class="col-8 h5 p-4">

                            <label for="category" class="h5 p-2">Categories</label>
                            <select id="category" class="h5 p-1 border border-1 rounded-pill mb-2" name="category">
                                <?php  for($l=0;$l<=isset($cat[$l]['name']);$l++){ ?>
                                    <option value="<?=  $cat[$l]['id'];  ?>"> <?= $cat[$l]['name'] ?></option>
                                <?php } ?>
                            </select>
                            <small></small>


                            <label for="subCat" class="h5 p-2">Sub-Categories</label>
                            <select id="subCat" class="h5 p-1 border border-1 rounded-pill mb-2" name="subCat">
                                <!-- Options JS here -->
                            </select>
                            <small></small>

                        </td>
                    </tr>
                </table>



                <hr>

                <table class="table table-borderless">
                    <tr>
                        <th class="h3 p-4 blue-font text-nowrap">About the Listing</th>
                    </tr>
                    <tr>
                        <td class="h5 blue-font">Condition</td>
                    </tr>
                    <tr class="h5 p-2">

                        <td class="d-flex flex-row d-flex-column-mobile">
                            <label for="used" class="p-2">Used
                            <input type="checkbox" class="border border-0 ms-3 p-4" name="used" id="used">
                            </label><br>

                            <label for="good" class="p-2" >Good
                            <input type="checkbox" class="border border-0 ms-3 p-4" name="good" id="good">
                            </label><br>

                            <label for="mint" class="p-2">Mint
                            <input type="checkbox" class="border border-0 ms-3 p-4" name="mint" id="mint">
                            </label><br>

                        </td>

                    </tr>
                    <tr>
                        <td><small id="smCond"></small></td>
                    </tr>
                </table>

                <hr>

                <table class="table table-borderless">

                    <tr>
                        <th class="col-4 h3 p-4 blue-font">Details</th>
                    </tr>

                    <tr>

                        <td class="col-4 h5 p-4 d-flex-column-mobile">
                            <label for="shipping" class="p-2">Shipping Method</label>

                            <div class="row">

                                <div>
                                    <input type="checkbox" class="border border-0 p-2" name="hands" id="hands">
                                    <label for="hands" class="p-2">Hands</label><br>
                                </div>
                                <div>
                                    <input type="checkbox" class="border border-0 p-2" name="delivery" id="delivery">
                                    <label for="delivery" class="p-2">Delivery</label><br>
                                </div>

                            </div>
                            <small id="smShip"></small><br>

                            <label for="year" class="p-2 mt-2">Year</label>
                            <input type="number" class="border border-1" id="year" name="year"><br>
                            <small></small>
                        </td>

                    </tr>

                </table>

                <hr>

                <div class="d-flex align-items-center justify-content-center">
                    <button type="submit" class="bg-blue border p-2 border-0 mt-2 rounded-1" name="saveListing" id="saveListing">Save Listing</button>
                </div>

            </form>
            <small class="h4" id="mainError"></small>

        </div>

        <hr>

        <!--  COMMENTS  -->
        <div class="row p-4"></div>

    </div>

<?php
$content = ob_get_clean();
