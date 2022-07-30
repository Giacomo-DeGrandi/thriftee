<?php
ob_start();
?>
    <div class="container-fluid">
        <div class="d-flex flex-row p-4 justify-content-evenly">
            <a href="index" class="cond-font h1 col-2 hover-underline-animation">Thriftee</a>
            <form method="post" action="index.php?search" class="col-6" >
                <div class="d-flex">
                    <input type="text" class="rounded-pill form-control border border-1 w-100 border-secondary" placeholder="Search" aria-label=" Search" aria-describedby="basic-addon2" name="search">
                    <button type="submit" class="border border-1 rounded-pill bg-orange">🔎</button>
                </div>
            </form>
            <div class="col-2 text-center h5">
                <a href="index?infoPersonal" class="text-center hover-underline-animation">Your Account</a>
            </div>
            <div class="col-2 text-center h5">
                <a href="index?logout" class="text-center hover-underline-animation text-nowrap">Logout</a>
            </div>

        </div>
    </div>
<?php

$header = ob_get_clean();
