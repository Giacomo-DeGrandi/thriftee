document.addEventListener('DOMContentLoaded', function() {


    let imgProLoad = document.querySelector('#imgProLoad');
    let pic1 = document.querySelector('#myPic');


    const testValidImage = () => {       // num is used to define the right id


        // initialise my valid condition to false to test the errors
        let isValid = false

        console.log(pic1.files[0])
        let fileDetails1 = pic1.files[0];

        // whitelist valid extensions
        let validExtensions = ['jpeg', 'jpg', 'png', 'svg', 'gif', 'webp'];
        // check for type match
        let imgDef = 'image/';

        const found1 = fileDetails1.type.match(imgDef);
        let fileType1 = fileDetails1.type.replace('image/', '')

        if (!found1) {
            imgProLoad.textContent = 'Invalid file type'

        } else if (!validExtensions.includes(fileType1)) {

            imgProLoad.textContent = 'Invalid file extensions, only:  \'jpeg\',\'jpg\',\'png\',\'svg\',\'gif\',\'webp\' are allowed '

        } else if (fileDetails1.size === 0 || fileDetails1.size > 1000000) {

            imgProLoad.textContent = '1MB is the max size allowed per picture'

        } else {
            //uploadBtn.style.pointerEvents = "auto";
            //uploadBtn.style.backgroundColor = "#F1641E";
            imgProLoad.textContent = '✔ loaded';


            isValid = true
        }

        return isValid

    }


    // Listen to the inputs for callback

    pic1.addEventListener('input', function (e) {

        switch (e.target.id) {

            case 'myPic':
                testValidImage();
                break;
        }

    })

})
