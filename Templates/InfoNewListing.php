<?php



ob_start();
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
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="myAllListings">All Listings</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="myActiveListings">Actives</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="mySoldListings">Sold</button>
                <button type="submit" class="h5 p-1 px-4 bg-white blue-font rounded-pill border-blue ms-5 float-end" name="addNewListing">Add new listing</button>
            </form>
        </div>


        <!-- MODIFY  -->
        <div class="container row p-4">
            <form method="post" enctype="multipart/form-data">

                <table class="table">
                    <tr>
                        <th class="col-4 h3 p-4 blue-font">Main Informations</th>
                    </tr>
                    <tr>
                        <td class="col-8 h5 p-4">
                            <label for="title" class="p-2">Title</label>
                            <input type="text" name="title" class="border border-1" > <br class="d-none-desktop">
                            <label for="price" class="p-2">Price</label>
                            <input type="number" step="0.01" class="border border-1" id="price">
                        </td>
                    </tr>
                </table>

                <table class="table">
                    <tr>
                        <th class="col-4 h3 p-4 blue-font">Categories</th>
                    </tr>
                    <tr>
                        <td class="col-8 h5 p-4">
                            <label for="category" class="p-2">Category</label>
                            <input type="text" name="category" class="border border-1" > <br class="d-none-desktop">
                            <label for="sub_category" class="p-2">Sub Category</label>
                            <input type="text" name="sub_category" class="border border-1" >
                        </td>
                    </tr>
                </table>


                <table class="table">
                    <tr>
                        <th class="col-4 h3 p-4 blue-font">About the Listing</th>
                    </tr>
                    <tr>
                        <td class="col-8 h5 p-4">
                            <label for="obj_condition" class="p-2">Condition</label>
                            <input type="text" name="obj_condition" class="border border-1" > <br class="d-none-desktop">
                            <label for="description" class="p-2">Description</label>
                            <textarea type="text" name="description" class="border border-1" ></textarea>
                        </td>
                    </tr>
                </table>

                <div class="d-flex flex-column p-4">

                    <div class="p-2 h3 blue-font">Add pictures</div><br>

                    <div class="d-flex flex-row d-flex-column-mobile">

                        <div class="col">
                            <label for="add_pic_1"  class="bg-white orange-font p-2 hover-underline-animation">
                                add pic 1 +
                                <input type="file" id="add_pic_1" class="d-none" name="add_pic_1"/>
                            </label>
                        </div>

                        <div class="col">
                            <label for="add_pic_2"  class="bg-white orange-font p-2 hover-underline-animation">
                                add pic 2 +
                                <input type="file" id="add_pic_2" class="d-none" name="add_pic_2"/>
                            </label>
                        </div>

                        <div class="col">
                            <label for="add_pic_3"  class="bg-white orange-font p-2 hover-underline-animation">
                                add pic 3 +
                                <input type="file" id="add_pic_3" class="d-none" name="add_pic_3"/>
                            </label>
                        </div>

                        <div class="col">
                            <label for="add_pic_4"  class="bg-white orange-font p-2 hover-underline-animation">
                                add pic 4 +
                                <input type="file" id="add_pic_4" class="d-none" name="add_pic_4"/>
                            </label>
                        </div>

                    </div>

                </div>


                <hr>

                <table class="table">
                    <tr>
                        <th class="col-4 h3 p-4 blue-font">Details</th>
                    </tr>
                    <tr>
                        <td class="col-8 h5 p-4">
                            <label for="obj_condition" class="p-2">Shipping Method</label>
                            <input type="text" name="obj_condition" class="border border-1" > <br class="d-none-desktop">
                            <label for="description" class="p-2">Year</label>
                            <input type="number" class="border border-1" id="year" name="year">
                        </td>
                    </tr>
                </table>

                <hr>

                <div class="d-flex align-items-center justify-content-center">
                    <button type="submit" class="bg-blue border border-0 rounded-1" name="saveListing">Save Listing</button>
                </div>

            </form>

        </div>

        <hr>

        <!--  COMMENTS  -->
        <div class="row p-4"></div>

    </div>

<?php
$content = ob_get_clean();
