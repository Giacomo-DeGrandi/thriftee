
document.addEventListener('DOMContentLoaded',function() {

    // SELECT my INS
    // ins sign up

    let formNewListing = document.querySelector('#formNewListing');

    let title = document.querySelector('#title');
    let price = document.querySelector('#price');
    let cat = document.querySelector('#category');
    let subCat = document.querySelector('#subCat');
    subCat.style.display = 'none'

    let used = document.querySelector('#used');
    let good = document.querySelector('#good');
    let mint = document.querySelector('#mint');
    let smCond = document.querySelector('#smCond');

    let desc = document.querySelector('#description');

    let pic1 = document.querySelector('#add_pic_1');
    let pic2 = document.querySelector('#add_pic_2');
    let pic3 = document.querySelector('#add_pic_3');
    let pic4 = document.querySelector('#add_pic_4');


    let hands = document.querySelector('#hands');
    let delivery = document.querySelector('#delivery');
    let smShip = document.querySelector('#smShip');

    let year = document.querySelector('#year');
    let save = document.querySelector('#saveListing');


    //_______________SCRIPT FOR SUBCATEGORIES _____________________________//

    cat.addEventListener('click',function (e){

        let opCat = e.target.value

        subCat.innerHTML = '';

        if(opCat !== ''){

            let subData = new FormData();

            subData.append('subId', opCat);

            fetch("index.php", {
                method: 'POST',
                body: subData
            })
                .then(r => r.json())
                .then(d => {

                    subCat.style.display = 'inline-block'

                    for( let i = 0; i < d.length ; i++ )
                    {
                        let options = document.createElement('option')
                            options.setAttribute('class','p-1')
                            options.value = d[i].id
                            options.textContent = d[i].name
                            subCat.appendChild(options);
                    }

                })

        }

    })



    //_________________________________VALIDATION   FUNCTIONS  _______________________________________///

    //______________  VALIDATION FOR Address  ___________//

    const testValidCondition = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false

        let usedV = used.checked
        let goodV = good.checked
        let mintV = mint.checked

        // no more probs like this
        if(usedV||mintV||goodV){
            used.style.pointerEvents = 'none'
            good.style.pointerEvents = 'none'
            mint.style.pointerEvents = 'none'
        }

        // test if required function is valid else give an error
        if (!mintV && !goodV && !usedV ) {
            smCond.innerHTML =  'You have to choose at least one condition for this offer. '
        } else if( mintV && goodV && usedV || mintV && usedV || usedV && goodV || mintV && goodV){
            smCond.innerHTML =  'You can choose at max one condition for this offer.'
        } else {
            smCond.innerHTML =  'Perfect!'
            isValid = true;
        }
        return isValid
    }

    const testValidTitle = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false
        // min num of chars
        let min = 3
        // max num of chars
        let max = 30
        // take away spaces
        let titleV = title.value;

        // test if required function is valid else give an error
        if (!isRequired(titleV)) {
            showErrors(title, 'Title can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else if (!validateText(titleV)) {
            showErrors(title, 'Invalid Title')
            // else validate the input
        } else if (!isBetween(titleV.length, min, max)) {
            showErrors(title, 'Title has to be between 3 and 30 characters')
            // else validate the input
        } else {
            showValids(title)
            isValid = true
        }
        return isValid
    }

    const testValidDesc = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false
        // min num of chars
        let min = 10
        // max num of chars
        let max = 5000
        // take away spaces
        let descV = desc.value.trim();

        // test if required function is valid else give an error
        if (!isRequired(descV)) {
            showErrors(desc, 'Description can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else if (!validateDesc(descV)) {
            showErrors(desc, 'Description can contain only .,_ \'?!- and alphanumeric characters but not newlines')
            // else validate the input
        } else if ( descV.length < min || descV.length > max) {
            showErrors(desc, 'Description has to be between 10 and 5000 characters')
            // else validate the input
        } else {

            showValids(desc)
            isValid = true
        }
        return isValid
    }

    const testValidPrice = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false

        // take away spaces
        let priceV = price.value.trim();

        // test if required function is valid else give an error
        if (!isRequired(priceV)) {
            showErrors(price, 'Price can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else if (!validatePrice(priceV)) {
            showErrors(price, 'Price is invalid')
            // else validate the input
        } else {
            showValids(price)
            isValid = true
        }
        return isValid
    }

    const testValidCategory = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false

        // take away spaces
        let catV = cat.value;

        // test if required function is valid else give an error
        if (!isRequired(catV)) {
            showErrors(cat, 'Category can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else {
            showValids(cat)
            isValid = true
        }
        return isValid
    }

    const testValidSubCategory = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false

        // take away spaces
        let subCatV = subCat.value;

        // test if required function is valid else give an error
        if (!isRequired(subCatV)) {
            showErrors(subCat, 'Sub Category can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else {
            showValids(subCat)
            isValid = true
        }
        return isValid
    }

    const testValidShippingMethod = () => {

        // initialise my valide condition to false to test the errors
        let isValid = false

        let handsV = hands.checked
        let deliveryV = delivery.checked

        if (!handsV && !deliveryV) {
            smShip.textContent =  'You have to choose at least one shipping method. '
        } else if(handsV && deliveryV){
            smShip.textContent =  'You can choose at max one shipping method, you\'ll be able to discuss it later with the seller.'
        } else {
            smShip.textContent =  'Ok!'
            isValid = true;
        }
        return isValid
    }

    const testValidYears = () => {

        // initialise my valide condition to false to test the errors
        let isValid = false

        let yearV = year.value;

        // test if required function is valid else give an error
        if (!validateYear(yearV)) {
            showErrors(year, 'You can\'t have a product that it\'s not out yet!')
            // else validate the input
        } else {
            showValids(year)
            isValid = true
        }
        return isValid
    }


    const testValidImage1 = () => {       // num is used to define the right id


        // initialise my valid condition to false to test the errors
        let isValid = false

        let fileDetails1 = pic1.files[0];

        if(fileDetails1 === undefined){
            imgListSmall1.textContent = 'Choose 4 offer pictures please'
        }

        // whitelist valid extensions
        let validExtensions = ['jpeg', 'jpg', 'png', 'svg', 'gif','webp'];
        // check for type match
        let imgDef = 'image/';

        const found1 = fileDetails1.type.match(imgDef);
        let fileType1 = fileDetails1.type.replace('image/', '')
        let imgListSmall1 = document.querySelector('#imgListSmall1');


        if (!isRequired(fileDetails1)) {
            imgListSmall1.textContent = 'Choose 4 offer pictures please'
            // test if the length is at least 3ch and the max is 15ch

        } else if (!found1) {
            imgListSmall1.textContent = 'Invalid file type'

        } else if (!validExtensions.includes(fileType1)) {

            imgListSmall1.textContent = 'Invalid file extensions, only:  \'jpeg\',\'jpg\',\'png\',\'svg\',\'gif\',\'webp\' are allowed '

        } else if ( fileDetails1.size === 0 || fileDetails1.size > 1000000) {

            imgListSmall1.textContent = '1MB is the max size allowed per picture'

        }  else {
            //uploadBtn.style.pointerEvents = "auto";
            //uploadBtn.style.backgroundColor = "#F1641E";
            imgListSmall1.textContent = '✔ loaded';


            isValid = true
        }

        return isValid

    }


    const testValidImage2 = () => {       // num is used to define the right id


        // initialise my valid condition to false to test the errors
        let isValid = false


        let fileDetails2 = pic2.files[0];

        if(fileDetails2 === undefined){
            imgListSmall2.textContent = 'Choose 4 offer pictures please'
        }

        // whitelist valid extensions
        let validExtensions = ['jpeg', 'jpg', 'png', 'svg', 'gif','webp'];
        // check for type match
        let imgDef = 'image/';


        const found2 = fileDetails2.type.match(imgDef);
        let fileType2 = fileDetails2.type.replace('image/', '')
        let imgListSmall2 = document.querySelector('#imgListSmall2');



        if (!isRequired(fileDetails2)) {
            imgListSmall2.textContent = 'Choose at least 4 offer pictures please'
            // test if the length is at least 3ch and the max is 15ch

        } else if (!found2) {
            imgListSmall2.textContent = 'Invalid file type'

        }  else if (!validExtensions.includes(fileType2)) {

            imgListSmall2.textContent = 'Invalid file extensions, only:  \'jpeg\',\'jpg\',\'png\',\'svg\',\'gif\',\'webp\' are allowed '

        }  else if ( fileDetails2.size === 0 || fileDetails2.size > 1000000) {

            imgListSmall2.textContent = '1MB is the max size allowed per picture'

        }  else {


            imgListSmall2.textContent = '✔ loaded';


            isValid = true
        }

        return isValid

    }

    const testValidImage3 = () => {       // num is used to define the right id


        // initialise my valid condition to false to test the errors
        let isValid = false


        let fileDetails3 = pic3.files[0];

        if(fileDetails3 === undefined){
            imgListSmall3.textContent = 'Choose at least 4 offer pictures please'
        }


        // whitelist valid extensions
        let validExtensions = ['jpeg', 'jpg', 'png', 'svg', 'gif','webp'];
        // check for type match
        let imgDef = 'image/';

        const found3 = fileDetails3.type.match(imgDef);
        let fileType3 = fileDetails3.type.replace('image/', '')
        let imgListSmall3 = document.querySelector('#imgListSmall3');


        if (!isRequired(fileDetails3)) {
            imgListSmall3.textContent = 'Choose at least 4 offer pictures please'
            // test if the length is at least 3ch and the max is 15ch

        } else if (!found3) {
            imgListSmall3.textContent = 'Invalid file type'

        } else if (!validExtensions.includes(fileType3)) {

            imgListSmall3.textContent = 'Invalid file extensions, only:  \'jpeg\',\'jpg\',\'png\',\'svg\',\'gif\',\'webp\' are allowed '

        }  else if ( fileDetails3.size === 0 || fileDetails3.size > 1000000) {

            imgListSmall3.textContent = '1MB is the max size allowed per picture'

        } else {

            imgListSmall3.textContent = '✔ loaded';


            isValid = true
        }

        return isValid

    }

    const testValidImage4 = () => {       // num is used to define the right id


        // initialise my valid condition to false to test the errors
        let isValid = false


        let fileDetails4 = pic4.files[0];

        let imgListSmall4 = document.querySelector('#imgListSmall4');


        if(fileDetails4 === undefined){
            imgListSmall4.textContent = 'Choose at least 4 offer pictures please'
        }


        // whitelist valid extensions
        let validExtensions = ['jpeg', 'jpg', 'png', 'svg', 'gif','webp'];
        // check for type match
        let imgDef = 'image/';


        const found4 = fileDetails4.type.match(imgDef);
        let fileType4 = fileDetails4.type.replace('image/', '')


        if (!isRequired(fileDetails4)) {
            imgListSmall4.textContent = 'Choose 4 offer pictures please'
            // test if the length is at least 3ch and the max is 15ch

        }  else if (!found4) {
            imgListSmall4.textContent = 'Invalid file type'

        } else if (!validExtensions.includes(fileType4)) {

            imgListSmall4.textContent = 'Invalid file extensions, only:  \'jpeg\',\'jpg\',\'png\',\'svg\',\'gif\',\'webp\' are allowed '

        }  else if ( fileDetails4.size === 0 || fileDetails4.size > 1000000) {

            imgListSmall4.textContent = '1MB is the max size allowed per picture'

        } else {

            imgListSmall4.textContent = '✔ loaded';

            isValid = true
        }

        return isValid

    }



    const isRequired = (value) => {
        return value !== '';
    }

    const isBetween = (length, min, max) => {
        return !(length < min || length > max);
    }

    const validateText = (bios) => {
        const re = /^[a-zA-ZÀ-ÿ0-9. -]*$/
        return re.test(bios);
    }

    const validateDesc = (desc) => {
        const re = /^[a-zA-ZÀ-ÿ0-9.,_ '?!-]*$/
        return re.test(desc);
    }

    const validatePrice = (price) => {
        const re = /[0-9]*$/
        if(re.test(price) && price !== '0'){
            return true;
        }
    }


    const validateYear = (year) => {
        const goodYear = new Date();
        const nowY = goodYear.getFullYear();
        return year <= nowY;
    }


    // Validation showing function if is valid remove the invalid class and add is_valid
    const showValids = (input) => {
        const myForm = input.parentElement
        myForm.classList.remove('not_valid')
        myForm.classList.add('is_valid')
        // select the small as containers and insert the error message as content
        const error = myForm.querySelector('small');
        error.textContent = '';
    }

    // Error showing function if is invalid remove the valid class and add not_valid
    const showErrors = (input, value) => {
        const myForm = input.parentElement
        myForm.classList.remove('is_valid')
        myForm.classList.add('not_valid')
        // select the small as containers and insert the error message as content
        const error = myForm.querySelector('small');
        error.textContent = value;
    }

    // ____________ ADD EVENT LISTENER TO ALL THE INPUTS FROM FORM ____________________________________//

    // Listen to the inputs for callback

    formNewListing.addEventListener('input', function (e) {

        switch (e.target.id) {

            case 'title':
                testValidTitle();
                break;

            case 'price':
                testValidPrice();
                break;

            case 'category':
                testValidCategory();
                break

            case 'subCat':
                testValidSubCategory();
                break;

            case 'description':
                testValidDesc();
                break;

            case 'year':
                testValidYears();
                break;

            case 'hands':
            case 'delivery':
                testValidShippingMethod();
                break;

            case 'used':
            case 'good':
            case 'mint':
                testValidCondition();
                break;

            case 'add_pic_1':
                testValidImage1();
                break;
            case 'add_pic_2':
                testValidImage2();
                break;
            case 'add_pic_3':
                testValidImage3();
                break;
            case 'add_pic_4':
                testValidImage4();
                break;

        }

    })


        save.addEventListener('click', function (event) {

        event.preventDefault()

        let titleVal = testValidTitle(),
            priceVal = testValidPrice(),
            catVal = testValidCategory(),
            subCatVal = testValidSubCategory(),
            descVal = testValidDesc(),
            yearVal = testValidYears(),
            shipVal = testValidShippingMethod(),
            imgVal1 = testValidImage1(),
            imgVal2 = testValidImage2(),
            imgVal3 = testValidImage3(),
            imgVal4 = testValidImage4();


        let isListingValid = titleVal && priceVal && catVal && subCatVal
                          && descVal && yearVal && shipVal && imgVal1
                            && imgVal2 && imgVal3 && imgVal4;

        let newListData = new FormData();

        newListData.append('title', title.value);
        newListData.append('price', price.value);
        newListData.append('category', cat.value);
        newListData.append('subCat', subCat.value);
        newListData.append('description', desc.value);
        newListData.append('used', used.checked);
        newListData.append('good', good.checked);
        newListData.append('mint',mint.checked);
        newListData.append('img1', pic1.files[0]);
        newListData.append('img2', pic2.files[0]);
        newListData.append('img3', pic3.files[0]);
        newListData.append('img4', pic4.files[0]);
        newListData.append('hands',hands.checked);
        newListData.append('delivery',delivery.checked)
        newListData.append('year',year.value)
        newListData.append('saveNewListing', 'true');

        if(isListingValid){

            fetch("index.php", {
                method: 'POST',
                body: newListData
            })
                .then(r => r.json())
                .then(d => {

                    let id = Object.values(d)
                    id = id[0]
                    const re = /^[0-9]*$/

                    if(re.test(id.id)){
                        window.location = "index?ListingPage=" + id.id ;

                    } else {

                        let mainError = document.querySelector('#mainError');
                        mainError.innerHTML = d;
                    }
                })
        }



    })


})
