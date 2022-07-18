<?php
ob_start();
?>
    <div class="container-fluid">
        <div class="d-flex flex-row p-4 justify-content-evenly">
            <a href="index" class="cond-font h1 col-2 hover-underline-animation">Thriftee</a>
            <form method="post" action="index.php?search" class="d-flex col-6">
                <input type="text" class="rounded-pill form-control-sm border border-1 w-100 border-secondary" placeholder="Search" aria-label=" Search" aria-describedby="basic-addon2" name="search">
                <button type="submit" class="border border-1 rounded-pill bg-orange">🔎</button>
            </form>
            <div class="col-2 text-center h5">
                <a href="index?signup" class="text-center hover-underline-animation">Subscribe</a>
            </div>
            <div class="col-2 text-center h5">
                <a href="index?signin" class="text-center hover-underline-animation text-nowrap">Sign In</a>
            </div>


        </div>
    </div>
<?php

$header = ob_get_clean();

