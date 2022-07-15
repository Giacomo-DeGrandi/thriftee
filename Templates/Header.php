<?php
ob_start();
?>
    <div class="container-fluid">
        <div class="d-flex flex-row p-4 justify-content-evenly">
            <a href="index" class="cond-font h1 col-2">Thriftee</a>
            <form method="post" action="index.php?search" class="d-flex col-6">
                <input type="text" class="rounded-pill form-control-sm border border-1 w-100 border-secondary" placeholder="Search" aria-label=" Search" aria-describedby="basic-addon2" name="search">
                <button type="submit" class="border border-1 rounded-pill bg-orange">🔎</button>
            </form>
            <a href="index?signup" class="col-2 text-center">Subscribe</a>
            <a href="index?signin" class="col-2 text-center">Sign In</a>
        </div>
    </div>
<?php

$header = ob_get_clean();

