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
                <button type="submit" class="h5 p-1 px-4 bg-white blue-font rounded-pill border border-0" name="myAllListings">All Listings</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="myActiveListings">Actives</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="mySoldListings">Sold</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border-blue ms-5 float-end" name="addNewListing">Add new listing</button>
            </form>
        </div>

        <hr>

        <div class="d-flex flex-row d-flex-column-mobile align-items-center justify-content-center flex-wrap">
            <div class="col p-2">
                <div class="h2 blue-font">Active</div>
                <div></div>
            </div>
            <div class="col p-2">
                <div class="h2 blue-font">Sold</div>
                <div></div>
            </div>
            <div class="col p-2">
                <div class="h2 blue-font">Ended</div>
                <div></div>
            </div>
            <div class="col p-2">
                <div class="h2 blue-font">Total</div>
                <div></div>
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
