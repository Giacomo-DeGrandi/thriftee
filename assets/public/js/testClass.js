

class ValidateNames {

    // to showErrors correctly we need to add <small></small> under the fields for errors to display

    constructor(min, max, input, textRequired, textBetween){
            this.min = min;
            this.max = max;
            this.input = input;
            this.value = input.value.trim();
            this.lenght = this.value.lenght;
    }

    showErrors(input,text){
        const myForm = input.parentElement
        // select the small as containers and insert the error message as content
        const error = myForm.querySelector('small');
        error.textContent = text;
    }

    showValids(input){
        const myForm = input.parentElement
        // select the small as containers and insert the error message as content
        const error = myForm.querySelector('small');
        error.textContent = '';
    }

    isRequired(value){
        if (value === '') {
            return false
        } else {
            return true
        }
    }

    isBetween (length, min, max) {
        if (length < min || length > max) {
            return false
        } else {
            return true
        }
    }

    validate(){

        if (!isRequired(value)) {
            showErrors(input, textRequired)
            // test if the length is at least 8ch and the max is 50ch
        } else if (!validatePassword(value) || !isBetween(value, min, max)) {
            showErrors(password, myval)
            // else validate the input
        } else {
            showValids(password)
            isValid = true
        }
        return isValid

    }


}