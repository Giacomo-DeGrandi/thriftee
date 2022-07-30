document.addEventListener('DOMContentLoaded', function(){

    // ins log in
    let formLog = document.querySelector('#formSignin');
    let emailLog = document.querySelector('#emailIn' );
    let pwLog = document.querySelector('#passwordIn');
    let submitLog = document.querySelector('#signin');
    let token = document.querySelector('#token');


    pwLog.addEventListener('input',function(){
        testValidEmailLog();
    })

    //_______________ VALIDATION FOR EMAIL IN CONNECTION  ____________// ------------------>
    const testValidEmailLog = () => {
        // initialise my valid condition to false to test the errors
        let isValid = false

        let emailLogVal = emailLog.value.trim();

        // test if required function is valid else give an error
        if (!isRequired(emailLogVal)) {
            showErrors(emailLog, 'Email can\'t be blank')
            // test if the length is at least 8ch and the max is 35ch
        } else {

            let formData = new FormData();

            formData.append('emailExists', emailLogVal);

            fetch("index.php", {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data =>{
                    if (data !== 'exists') {
                        showErrors(emailLog, 'This email is not registered, please subscribe to log in')
                        return false;
                    } else {
                        showValids(emailLog)
                    }
                })

            isValid = true;
        }
        return isValid
    }



    //  FUNCTIONS FOR COOKIES

    function setCookie(name,value,days) {
        let expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }

    // validation TESTS_______________________________-

    // blank
    const isRequired = (value) => {
        if (value === '') {
            return false
        } else {
            return true
        }
    }

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


    submitLog.addEventListener('click', function (event) {

        event.preventDefault()

        let test = testValidEmailLog();
        let pwLogV =  pwLog.value.trim()

        if(test){

            let logData = new FormData();

            logData.append('submitLog', 'true');
            logData.append('emailIn', emailLog.value);
            logData.append('passwordIn', pwLogV);
            logData.append('token', token.value);

            fetch("index.php", {
                method: 'POST',
                body: logData
            })
                .then(r => r.json())
                .then(d => {

                    if(d !== 'Wrong password'){

                        setCookie('connected', 1 , '1');
                        setCookie('id', d , '1');

                        // check address, if empty send to details registration page else send to profile

                        let checkData = new FormData();

                        checkData.append('checkAddress', d);

                        fetch("index.php", {
                            method: 'POST',
                            body: checkData
                        })
                            .then(r => r.json())
                            .then(d => {

                                if(d === 'details'){
                                    window.location = "index?details";
                                } else if(d === 'profile') {
                                    window.location = "index?infoPersonal";
                                } else {
                                    showErrors(pwLog, 'Something went wrong, please contact the administrator')

                                }

                            })

                    } else if(d === 'Wrong password'){

                        testValidEmailLog();
                        showErrors(pwLog, 'This password is wrong')

                    } else if(d === 'Token expired. Please reload form.'){

                        showErrors(pwLog, 'Token expired. Please reload form.')

                    } else {

                        showErrors(pwLog, 'Something went wrong, please contact the administrator')

                    }
                })

        } else {
            testValidEmailLog();
        }
    })


})