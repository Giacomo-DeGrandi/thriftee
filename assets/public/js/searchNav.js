
document.addEventListener('DOMContentLoaded', function (string) {

    let formNewListing = document.querySelector('#formNewListing');

    let searchTitle = document.querySelector('#searchTitle');
    let searchCategory = document.querySelector('#searchCategory');
    let priceRangeMin = document.querySelector('#priceRangeMin');
    let priceRangeMax = document.querySelector('#priceRangeMax');
    let minNum = document.querySelector('#minNum');
    let maxNum = document.querySelector('#maxNum');
    let condSearch = document.querySelector('#condSearch');
    let yearSearch = document.querySelector('#yearSearch');
    let shipSearch = document.querySelector('#shipSearch');
    let searchNav = document.querySelector('#searchNav');

    let searchTitleSmall = document.querySelector('#searchTitleSmall');
    let searchCategorySmall = document.querySelector('#searchCategorySmall');
    let priceRangeSmall = document.querySelector('#priceRangeSmall');
    let priceRangeShowMin = document.querySelector('#priceRangeShowMin');
    let priceRangeShowMax = document.querySelector('#priceRangeShowMax');
    let minNumSmall = document.querySelector('#minNumSmall');
    let maxNumSmall = document.querySelector('#maxNumSmall');
    let condSearchSmall = document.querySelector('#condSearchSmall');
    let yearSearchSmall = document.querySelector('#yearSearchSmall');
    let shipSearchSmall = document.querySelector('#shipSearchSmall');

    priceRangeMin.value = 0;
    priceRangeMax.value = 100000;

    priceRangeMin.addEventListener('input', function (e){
        priceRangeShowMin.textContent = e.target.value

    })

    priceRangeMax.addEventListener('input', function (e){

        priceRangeShowMax.textContent = e.target.value

    })

})