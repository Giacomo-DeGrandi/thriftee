<?php


ob_start();

$requested= $chunks[0][0][0];
?>
    <div class="container">

        <!-- CRUMBLES  -->
        <div class="d-flex flex-row p-4 flex-wrap">
            <form method="get" action="index?" class="text-start">
                <button type="submit" class="h5 p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoPersonal">Personal Information</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoPassword">Password</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoAddress">Address</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoListings">Listings</button>
                <button type="submit" class="h5 fw-light p-1 px-4 bg-white blue-font rounded-pill border border-0" name="infoPublicProfile">Public Profile</button>
            </form>
        </div>

        <hr>

        <!-- MODIFY  -->
        <div class="container row p-2">
            <form method="post" enctype="multipart/form-data">

                <table class="table">
                    <tr>
                        <th class="col-4 h3 p-1 blue-font">Name</th>
                    </tr>
                    <tr>
                        <td class="col-8 h5 p-4">
                            <label for="name" class="p-2">Name</label>
                            <input type="text" name="name" class="border border-1" value="<?= $requested['name'] ?>"> <br class="d-none-desktop">
                            <label for="name" class="p-2">Lastname</label>
                            <input type="text" name="lastname" class="border border-1" value="<?= $requested['lastname'] ?>">
                        </td>
                    </tr>
                </table>

                <div class="p-2 d-flex-column-mobile">
                    <div class="d-flex flex-row d-flex-column-mobile">

                        <div class="d-flex flex-column">

                            <div class="p-2 h3 blue-font">Profile Picture</div>
                            <a href="<?= $requested['img_profile'] ?>">
                                <img src="<?= $requested['img_profile'] ?>" class="w-50" alt="profilepic">
                            </a>
                            <label for="myFile"  class="bg-white orange-font p-2 hover-underline-animation">
                                change
                                <input type="file" id="myPic" class="d-none" name="myPic"/>
                            </label>

                        </div>

                        <div class="h3 p-4 row">
                            <div class="p-2 h3 blue-font">Bios</div>
                            <textarea id="bios" name="bios" class="border h5 border-1"> <?= $requested['bios'] ?> </textarea>
                        </div>

                    </div>

                </div>

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
