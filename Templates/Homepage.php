<?php $title = "ThrifteeX"; ?>


<?php ob_start(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="w-50 p-4">
                <p class="p-4 alt-h1 cond-font darkgray-font">
                    Explore one-of-a-kind finds for one-of-a-kind people.
                </p>
                <p class="lead p-4">Thriftee is a global online marketplace, where people come together to make, sell, buy and collect unique items. We’re also a community pushing for positive change for small businesses, people, and the planet.</p>
                <form method="get" action="index.php?search=" class="p-4 d-flex">
                    <input type="text" class="rounded-pill border w-100 border-1 border-secondary" placeholder="Search" aria-label=" Search" aria-describedby="basic-addon2" name="search">
                    <button type="submit" class="input-group-text rounded-pill bg-white" value="1" id="basic-addon2" name="searchMain">🔎</button>
                </form>
            </div>
            <div class="bg-main-img w-50 p-5 mt-4">
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>

