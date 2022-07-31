<?php ob_start(); ?>
    <footer class="mt-auto">
        <div class="container-fluid mt-5 py-5">
            <nav class="d-flex flex-column justify-content-end align-items-end">
                <div class="d-flex flex-row justify-content-evenly w-100">
                    <a href="index?" class="hover-underline-animation h2 cond-font">Thriftee</a>
                    <a href="https://github.com/Giacomo-DeGrandi" ><img src="assets/public/icons/github.png" alt="" class="logos-octo bg-white rounded-4"></a>
                    <a href="https://laplateforme.io/"><img src="assets/public//icons/logowhite_plat.png" alt="" class="logos-plat bg-orange rounded-4"></a>
                </div>
            </nav>
        </div>
    </footer>
<?php

$footer = ob_get_clean();