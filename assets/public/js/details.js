document.addEventListener('DOMContentLoaded', function(){

    // Seller Buyer box
    let buyer = document.querySelector('#buyerBox');
    let seller = document.querySelector('#sellerBox');

    // file upload
    let file = document.querySelector('#myFile');
    let uploadBtn = document.querySelector('#uploadBtn');

    console.log(file.value);

    file.addEventListener('input', function (e) {
        console.log(e.target.files[0])
    })

        // Bios
    let bios = document.querySelector('#bios');

    // ins log in
    let formDetails = document.querySelector('#formDetails');
    let address = document.querySelector('#address');
    let city = document.querySelector('#city' );
    let zipCode = document.querySelector('#zipCode');
    let saveDetails = document.querySelector('#saveDetails');
    let token = document.querySelector('#token');

    //_________________________________VALIDATION   FUNCTIONS  _______________________________________///

    //______________  VALIDATION FOR Address  ___________//

    const testValidBoxes = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false

        let sellerVal = seller.checked
        let buyerVal = buyer.checked

        // test if required function is valid else give an error
        if (!sellerVal&&!buyerVal) {
            showErrors(seller, 'You have to choose at least one role. ')
        } else if(sellerVal&&buyerVal){
            showErrors(seller,'You can choose at max one role.')
        } else {
            showValids(seller)
            isValid = true;
        }
        return isValid
    }

    const testValidAddress = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false
        // min num of chars
        let min = 3
        // max num of chars
        let max = 50
        // take away spaces
        let addressVal = address.value.trim();

        // test if required function is valid else give an error
        if (!isRequired(addressVal)) {
            showErrors(address, 'Address can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else if (!validateAddress(addressVal) ||!isBetween(addressVal.length, min, max)) {
            showErrors(address, 'Address has to be between 3 and 50 characters')
            // else validate the input
        } else {
            showValids(address)
            isValid = true
        }
        return isValid
    }

    const testValidCity = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false
        // min num of chars
        let min = 3
        // max num of chars
        let max = 50
        // take away spaces
        let cityVal = city.value.trim();

        // test if required function is valid else give an error
        if (!isRequired(cityVal)) {
            showErrors(city, 'City can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else if (!validateCity(cityVal) || !isBetween(cityVal.length, min, max)) {
            showErrors(city, 'City has to be between 3 and 50 characters')
            // else validate the input
        } else {
            showValids(city)
            isValid = true
        }
        return isValid
    }

    const testValidZipCode = () => {

        // initialise my valide condition to false to test the errors
        let isValid = false
        // min num of chars
        let min = 3
        // max num of chars
        let max = 50
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
        let min = 3
        // max num of chars
        let max = 500
        // take away spaces
        let biosVal = bios.value.trim();

        // test if required function is valid else give an error
        if (!isRequired(biosVal)) {
            showErrors(bios, 'Zip code can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else if (!validateBios(biosVal) || !isBetween(biosVal.length, min, max)) {
            showErrors(bios, 'Invalid Zip Code')
            // else validate the input
        } else {
            showValids(bios)
            isValid = true
        }
        return isValid
    }

    formDetails.addEventListener('input', function (e) {})


        const testValidUpload = () => {

        // initialise my valid condition to false to test the errors
        let isValid = false

        // take away spaces
        let fileDetails = file.target.files[0];

        let validExtensions =  ['jpeg','jpg','png','svg','gif']; // These will be the only file extensions allowed

        console.log(fileDetails.type)
        // test if required function is valid else give an error
        if (!isRequired(biosVal)) {
            showErrors(bios, 'Zip code can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else if (!validateBios(biosVal) ||!isBetween(biosVal.length, min, max)) {
            showErrors(bios, 'Invalid Zip Code')
            // else validate the input
        } else {
            showValids(bios)
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

    const validateCity = (city) => {
        const re = /^[a-zA-Z ]*$/
        return re.test(city);
    }

    const validateZipCode = (zip) => {
        const re = /^[a-zA-Z]*$/
        return re.test(zip);
    }

    const validateAddress = (address) => {
        const re = /^[a-zA-Z0-9_ -]*$/
        return re.test(address);
    }

    const validateBios = (bios) => {
        const re = /^[a-zA-Z0-9._ ?!-]*$/
        return re.test(bios);
    }

    // Validation showing function if is valid remove the invalid class and add is_valid
    const showValids = (input) => {
        const myForm = input.parentElement
        console.log(input);
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
            case 'seller':
            case 'buyer':
                testValidBoxes();
                break;
        }

    })


})