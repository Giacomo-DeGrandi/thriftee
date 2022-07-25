
document.addEventListener('DOMContentLoaded',function() {

    // SELECT my INS
    // ins sign up

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
    let shipping = document.querySelector('#shipping');
    let year = document.querySelector('#year');
    let save = document.querySelector('#saveListing');


    //_______________SCRIPT FOR SUBCATEGORIES _____________________________//

    cat.addEventListener('click',function (e){

        let opCat = e.target.value

        subCat.innerHTML = '';

        if(opCat !== ''){

            subCat.style.display = 'inline-block'

            let subData = new FormData();

            subData.append('subId', opCat);

            fetch("index.php", {
                method: 'POST',
                body: subData
            })
                .then(r => r.json())
                .then(d => {

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

        // test if required function is valid else give an error
        if (!mintV && !goodV && !usedV ) {
            smCond.textContent =  'You have to choose at least one role. '
        } else if( mintV && goodV && usedV || mintV && usedV || usedV && goodV || mintV && goodV){
            smCond.textContent =  'You can choose at max one role.'
        } else {
            smCond.textContent =  'Good choice!'
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
        let titleV = title.value.trim();

        // test if required function is valid else give an error
        if (!isRequired(titleV)) {
            showErrors(title, 'Title can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else if (!validateText(titleV) ||!isBetween(titleV.length, min, max)) {
            showErrors(title, 'Title has to be between 3 and 30 characters')
            // else validate the input
        } else {
            showValids(title)
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
            showErrors(price, 'Price can contain only numbers')
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
        let catV = cat.value.trim();

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

    const testValidZipCode = () => {

        // initialise my valide condition to false to test the errors
        let isValid = false
        // min num of chars
        let min = 2
        // max num of chars
        let max = 7
        // take away spaces
        let zipCodeVal = zipCode.value.trim();

        // test if required function is valid else give an error
        if (!isRequired(zipCodeVal)) {
            showErrors(zipCode, 'Zip code can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else if (!validateZipCode(zipCodeVal) ||!isBetween(zipCodeVal.length, min, max)) {
            showErrors(zipCode, 'Invalid Zip Code')
            // else validate the input
        } else {
            showValids(zipCode)
            isValid = true
        }
        return isValid
    }

    const testValidBios = () => {

        // initialise my valide condition to false to test the errors
        let isValid = false
        // min num of chars
        let min = 0
        // max num of chars
        let max = 500
        // take away spaces
        let biosVal = bios.value.trim();

        // test if required function is valid else give an error
        if (!validateBios(biosVal) || !isBetween(biosVal.length, min, max)) {
            showErrors(bios, 'Bios can have max 500 characters and can contain only  .,_ \'?!-  , without quotes.')
            // else validate the input
        } else {
            showValids(bios)
            isValid = true
        }
        return isValid
    }


    const testValidImage = () => {

        // initialise my valid condition to false to test the errors
        let isValid = false

        let fileDetails = file.files[0];

        // whitelist valid extensions
        let validExtensions = ['jpeg', 'jpg', 'png', 'svg', 'gif'];
        // check for type match
        let imgDef = 'image/';
        const found = fileDetails.type.match(imgDef);
        let fileType = fileDetails.type.replace('image/', '')

        if (!isRequired(fileDetails)) {
            imgSmall.textContent = 'Choose a profile picture please'
            // test if the length is at least 3ch and the max is 15ch
        } else if (!found) {
            imgSmall.textContent = 'Invalid file type'
        } else if (!validExtensions.includes(fileType)) {
            imgSmall.textContent = 'Invalid file extensions, only:  \'jpeg\',\'jpg\',\'png\',\'svg\',\'gif\' are allowed '
        } else if (fileDetails.size === 0 || fileDetails.size > 1000000) {
            imgSmall.textContent = '1MB is the max size allowed per picture'
        } else {
            //uploadBtn.style.pointerEvents = "auto";
            //uploadBtn.style.backgroundColor = "#F1641E";
            imgSmall.textContent = '✔ loaded';

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
        const re = /^[a-zA-Z0-9.-]*$/
        return re.test(bios);
    }

    const validateDesc = (desc) => {
        const re = /^[a-zA-Z0-9.,_ '?!-]*$/
        return re.test(desc);
    }

    const validatePrice = (price) => {
        const re = /^[0-9.,]*$/
        return re.test(price);
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

    formDetails.addEventListener('input', function (e) {

        switch (e.target.id) {
            case 'address':
                testValidAddress();
                break;
            case 'city':
                testValidCity();
                break;
            case 'zipCode':
                testValidZipCode();
                break;
            case 'bios':
                testValidBios();
                break;
            case 'sellerBox':
            case 'buyerBox':
                testValidBoxes();
                break;
            case 'myFile':
                testValidImage();
                break;
        }

    })



    saveDetails.addEventListener('click', function (event) {

        event.preventDefault()

        let addressV = testValidCity(),
            cityV = testValidAddress(),
            zipCodeV = testValidZipCode(),
            biosV = testValidBios(),
            sellerV = testValidBoxes(),
            buyerV = testValidBoxes(),
            myFileV = testValidImage();

        let isFormValid = addressV && cityV && zipCodeV && biosV && (sellerV || buyerV) && myFileV

        let upData = new FormData();

        upData.append('tokenD', token.value);
        upData.append('address', address.value);
        upData.append('city', city.value);
        upData.append('zipCode', zipCode.value);
        upData.append('bios', bios.value);
        upData.append('seller', seller.checked);
        upData.append('buyer', buyer.checked);
        upData.append('upload',file.files[0]);
        upData.append('saveDetails', 'true');

        if(isFormValid){

            fetch("index.php", {
                method: 'POST',
                body: upData
            })
                .then(r => r.json())
                .then(d => {
                    if (d === 'setted') {
                        window.location = "index?profile";
                    } else {
                        console.log(d);
                        let errors = document.querySelector('#errors');
                        errors.textContent = 'Invalid , please reload the page and try again';
                    }
                })
        }



    })


})
