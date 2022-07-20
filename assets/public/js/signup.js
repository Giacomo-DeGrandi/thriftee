
document.addEventListener('DOMContentLoaded',function(){

    // SELECT my INS
    // ins sign up

    let name = document.querySelector('#name');   //.textContent
    let lastname = document.querySelector('#lastname');
    let user = document.querySelector('#username');
    let email = document.querySelector('#email');
    let password = document.querySelector('#password');
    let passwordConf = document.querySelector('#passwordConf');
    let date = document.querySelector('#date');
    let termsBox = document.querySelector('#termsBox');
    let submitSub = document.querySelector('#subscribe');
    let form = document.querySelector('#formSignup');


    //_________________________________VALIDATION   FUNCTIONS  _______________________________________///

    //______________  VALIDATION FOR NAMES  ___________//

    const testValidName = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false
        // min num of chars
        let min = 2
        // max num of chars
        let max = 23
        // take away spaces
        let userVal = name.value.trim();

        // test if required function is valid else give an error
        if (!isRequired(userVal)) {
            showErrors(name, 'Name can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else if (!isBetween(userVal.length, min, max)|| !validateName(userVal)) {
            showErrors(name, 'Name has to be between 2 and 23 characters')
            // else validate the input
        } else {
            showValids(name)
            isValid = true
        }
        return isValid
    }

    const testValidLastname = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false
        // min num of chars
        let min = 2
        // max num of chars
        let max = 23
        // take away spaces
        let userVal = lastname.value.trim();

        // test if required function is valid else give an error
        if (!isRequired(userVal)) {
            showErrors(lastname, 'Lastname can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else if (!isBetween(userVal.length, min, max)|| !validateName(userVal)) {
            showErrors(lastname, 'Lastname has to be between 2 and 23 characters')
            // else validate the input
        } else {
            showValids(lastname)
            isValid = true
        }
        return isValid
    }

    const testValidUsername = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false
        // min num of chars
        let min = 2
        // max num of chars
        let max = 30
        // take away spaces
        let userVal = user.value.trim();

        // test if required function is valid else give an error
        if (!isRequired(userVal)) {
            showErrors(user, 'Username can\'t be blank')
            // test if the length is at least 3ch and the max is 15ch
        } else if (!isBetween(userVal.length, min, max)|| !validateName(userVal)) {
            showErrors(user, 'Username has to be between 3 and 30 characters')
            // else validate the input
        } else {
            showValids(user)
            isValid = true
        }
        return isValid
    }

    //_______________ VALIDATION FOR EMAILS ____________//

    const testValidEmail = () => {
        // initialise my valid condition to false to test the errors
        let isValid = false
        // min num of chars
        let min = 8
        // max num of chars
        let max = 35
        // take away spaces
        let emailVal = email.value.trim();

        // test if required function is valid else give an error
        if (!isRequired(emailVal)) {
            showErrors(email, 'Email can\'t be blank')
            // test if the length is at least 8ch and the max is 35ch
        } else if (!validateEmail(emailVal) || !isBetween(emailVal.length, min, max)) {
            showErrors(email, 'Email can\'t contain (!#$%^&*), it has to be at least 8ch and 35ch')
        } else {

            let formData = new FormData();

            formData.append('emailExists', emailVal);

            fetch("index.php", {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data =>{

                    if (data === 'exists') {
                        showErrors(email, 'This email already exists, please choose another one')
                        return false;
                    } else {
                        showValids(email)
                    }
                })

            isValid = true;
        }
        return isValid
    }



    //_______________ VALIDATION FOR PASSWORD ____________//

    const testValidPassword = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false
        // min num of chars
        let min = 8
        // max num of chars
        let max = 50
        // take away spaces
        let passwordVal = password.value.trim();
        // test if required function is valid else give an error
        if (!isRequired(passwordVal)) {
            showErrors(password, 'Password can\'t be blank')
            // test if the length is at least 8ch and the max is 50ch
        } else if (!validatePassword(passwordVal) || !isBetween(passwordVal, min, max)) {
            let myval = 'Password has to be at least 1 lowercase, 1 uppercase, 1 number and has to be between a minimum of 8ch and at max 60ch'
            showErrors(password, myval)
            // else validate the input
        } else {
            showValids(password)
            isValid = true
        }
        return isValid
    }

    //test our values for PASSWORD CONFIRMATION______________________________

    const testPasswordConfirmation = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false

        // take away spaces
        let passwordConfVal = passwordConf.value.trim();        // take away spaces
        let passwordVal = password.value.trim();
        // test if required function is valid else give an error
        if (!isRequired(passwordConfVal)) {
            showErrors(passwordConf, 'Password Confirmation can\'t be blank')
            // test if the length is at least 8ch and the max is 50ch
        } else if (passwordVal !== passwordConfVal) {
            showErrors(passwordConf, 'Password and its confirmation \n have to be identical')
            // else validate the input
        } else {
            showValids(passwordConf)
            isValid = true
        }
        return isValid
    }


    const testValidTerms = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false
        // take away spaces
        let check = termsBox.checked

        // test if required function is valid else give an error
        if (!check) {
            showErrors(termsBox, 'You have to agree to our terms to subscribe. ')
        } else {
            showValids(termsBox)
            isValid = true;
        }
        return isValid

    }


    const testValidDate = () => {
        // initialise my valide condition to false to test the errors
        let isValid = false
        // take away spaces
        let dateVal = date.value

        // test if required function is valid else give an error
        if (!isRequired(dateVal)) {
            showErrors(date, 'Date of birth can\'t be blank')
            // test if the length is at least 8ch and the max is 35ch
        } else if (!validateDate(dateVal)) {
            showErrors(date, 'You need to be at least 18 to subscribe!')
        } else {
            showValids(date)
            isValid = true;
        }
        return isValid
    }


    // _____________________    VALIDATION TESTS INPUTS ________________________//


    // validation TESTS_______________________________-

    // blank
    const isRequired = (value) => {
        if (value === '') {
            return false
        } else {
            return true
        }
    }
    // long
    const isBetween = (length, min, max) => {
        if (length < min || length > max) {
            return false
        } else {
            return true
        }
    }
    // email regex
    const validateEmail = (email) => {
        const re = /^[a-z0-9._-]+[@]+[a-zA-Z0-9._-]+[.]+[a-z]{2,3}$/   //  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/   //     /^[a-z0-9._-]+[@]+[a-zA-Z0-9._-]+[.]+[a-z]{2,3}$/    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    };

    // Name Lastname Username regex
    const validateName = (name) => {
        const re = /^[a-z0-9]*$/
        return re.test(name);
    };



    // password regex
    const validatePassword = (password) => {
        const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
        return re.test(password);
    }

    // date
    const validateDate = (value) => {

        let dateVal = value
        dateVal = dateVal.split('-')
        let y = dateVal[0]
        let m = dateVal[1]
        let d = dateVal[2]
        y = parseInt(y)
        m = parseInt(m)
        d = parseInt(d)

        let testDate = new Date();

        let testY = testDate.getFullYear();
        let testM = testDate.getMonth();
        testM = testM + 1
        let testD = testDate.getDate();

        let check;


        if((testY-18) > y){
            check = 'valid'
        } else if((testY-18) === y){
            if(testM > m){
                check = 'valid'
            } else if(testM === m){
                if(testD > d){
                    check ='valid'
                } else if (testD === d) {
                    check = 'valid'
                } else {
                    check = 'invalid'
                }
            } else {
                check = 'invalid'
            }
        } else {
            check = 'invalid'
        }
        if(check === 'valid'){
            return true
        } else {
            return false
        }

    }


    ///___________________________________________________________________________________________________///

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


    // show Functions __________________________________-

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

    submitSub.addEventListener('click', function (event) {

        event.preventDefault()
        // validate forms
        let nameV = testValidName(),
            lastnameV = testValidLastname(),
            usernameV = testValidUsername(),
            emailV = testValidEmail(),
            passwordV = testValidPassword(),
            confPasswordV = testPasswordConfirmation(),
            dateV = testValidDate(),
            termsV = testValidTerms();

        let isFormValid = nameV && lastnameV && usernameV && termsV && emailV && passwordV && confPasswordV && dateV

        // submit to the server if the form is valid
        if (isFormValid) {

            let submitData = new FormData();

            submitData.append('submitSub', 'true');
            submitData.append('email', email.value);
            submitData.append('username', user.value);
            submitData.append('name', name.value);
            submitData.append('lastname', lastname.value);
            submitData.append('password', password.value);
            submitData.append('passwordConf', passwordConf.value);
            submitData.append('date', date.value);

            fetch("index.php", {
                method: 'POST',
                body: submitData
            })
                .then(r => r.json())
                .then(d => {
                    if (d === 'setted') {
                        window.location = "index?signin";
                    }
                })
        }
    })


})