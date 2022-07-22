<?php



ob_start();
?>
    <div class="container">

        <!-- CRUMBLES  -->
        <div class="d-flex flex-row p-4 flex-wrap">
            <form method="get" action="index?" class="text-start">
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoPersonal">Personal Information</button>
                <button type="submit" class="h5 p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoPassword">Password</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoAddress">Address</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoListings">Listings</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoProfile">Public Profile</button>
            </form>
        </div>

        <hr>

        <!-- MODIFY  -->
        <div class="container row p-4">
            <form method="post" enctype="multipart/form-data">

                <table class="table">
                    <tr>
                        <th class="col-4 h3 p-4 blue-font">Password</th>
                    </tr>
                    <tr>
                        <td class="col-8 h5 p-4">
                            <label for="name" class="p-2">Password</label>
                            <input type="text" name="password" class="border border-1" > <br class="d-none-desktop">
                            <label for="name" class="p-2">Password Confirmation</label>
                            <input type="text" name="passwordConf" class="border border-1" >
                        </td>
                    </tr>
                </table>

                <hr>

                <div class="d-flex align-items-center justify-content-center">
                    <button type="submit" class="bg-blue border border-0 rounded-1" name="info1">Save</button>
                </div>
            </form>

        </div>

        <hr>

        <!--  COMMENTS  -->
        <div class="row p-4"></div>

    </div>

<?php
$content = ob_get_clean();
