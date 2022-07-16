document.addEventListener('DOMContentLoaded', function(){

    // Seller Buyer box
    let buyer = document.querySelector('#buyerBox');
    let seller = document.querySelector('#sellerBox');

    // file upload
    let file = document.querySelector('#myFile');
    let uploadBtn = document.querySelector('#uploadBtn');

    // ins log in
    let formDetails = document.querySelector('#formDetails');
    let address = document.querySelector('#address');
    let city = document.querySelector('#city' );
    let zipCode = document.querySelector('#zipCode');
    let saveDetails = document.querySelector('#saveDetails');
    let token = document.querySelector('#token');

    //_________________________________VALIDATION   FUNCTIONS  _______________________________________///

    //______________  VALIDATION FOR NAMES  ___________//

    const testValidName = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false
        // min num of chars
        let min = 3
        // max num of chars
        let max = 15
        // take away spaces
        let userVal = name.value.trim();

        // test if required function is valid else give an error
        if (!isRequired(userVal)) {
            showErrors(name, 'Name can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else if (!isBetween(userVal.length, min, max)) {
            showErrors(name, 'Name has to be between 3 and 15 characters')
            // else validate the input
        } else {
            showValids(name)
            isValid = true
        }
        return isValid
    }

    const isRequired = (value) => {
        if (value === '') {
            return false
        } else {
            return true
        }
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

    form.addEventListener('input', function (e) {

        switch (e.target.id) {
            case 'username':
                testValidUsername();
                break;
            case 'name':
                testValidName();
                break;
            case 'lastname':
                testValidLastname();
                break;
            case 'email':
                testValidEmail();
                break;
            case 'termsBox':
                testValidTerms();
                break;
            case 'date':
                testValidDate();
                break;
            case 'password':
                testValidPassword();
                break;
            case 'passwordConf':
                testPasswordConfirmation();
                break;

        }

    })


})