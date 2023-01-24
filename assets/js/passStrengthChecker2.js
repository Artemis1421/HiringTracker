    // timeout before a callback is called

    let timeout2;

    // traversing the DOM and getting the input and span using their IDs

    let password2 = document.getElementById('PassEntry2')
    let strengthBadge2 = document.getElementById('StrengthDisp2')

    // The strong and weak password2 Regex pattern checker

    let strongPassword2 = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})')
    let mediumPassword2 = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))')

    function StrengthChecker2(PasswordParameter2) {
        // We then change the badge's color and text based on the password2 strength

        if (strongPassword2.test(PasswordParameter2)) {
            strengthBadge2.style.backgroundColor = "green"
            strengthBadge2.textContent = 'Strong'
        } else if (mediumPassword2.test(PasswordParameter2)) {
            strengthBadge2.style.backgroundColor = 'blue'
            strengthBadge2.textContent = 'Medium'
        } else {
            strengthBadge2.style.backgroundColor = 'red'
            strengthBadge2.textContent = 'Weak'
        }
    }

    // Adding an input event listener when a user types to the password2 input 

    password2.addEventListener("input", () => {

        //The badge is hidden by default, so we show it

        strengthBadge2.style.display = 'block'
        clearTimeout(timeout2);

        //We then call the StrengChecker function as a callback then pass the typed password2 to it

        timeout2 = setTimeout(() => StrengthChecker2(password2.value), 500);

        //Incase a user clears the text, the badge is hidden again

        if (password2.value.length !== 0) {
            strengthBadge2.style.display != 'block'
        } else {
            strengthBadge2.style.display = 'none'
        }
    });