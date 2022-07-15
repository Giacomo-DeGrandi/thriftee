<?php

ob_start();
?>
    <div class="container-fluid">
        <div class="bg-main-img w-100">
            <h1 class="p-4">
                Interesting Title
            </h1>
            <p class="h4 p-4">Interesting subtitle</p>
            <form method="post" action="search.php" class="p-5 d-flex">
                <input type="text" class="rounded-pill w-75 border border-1 border-secondary" placeholder="Search" aria-label=" Search" aria-describedby="basic-addon2" name="search">
                <span class="input-group-text rounded-pill bg-white" id="basic-addon2">🔎</span>
            </form>
        </div>
    </div>
<?php $footer = ob_get_clean(); ?>

