window.onload = setupPage;

var ratingSelect = null;
var captchaFake = null;

function setupPage()
{
    var submit = document.getElementById("registerSubmit");
    submit.addEventListener("click", sendRegisterForm);
    ratingSelect = document.getElementById("rating");
    ratingSelect.addEventListener("change", handleRatingSelection);
    captchaFake = document.getElementById("captchaFake");
}

function sendRegisterForm()
{
    if(validateRegisterForm())
        window.alert("Registration form sent!");
}

function validateRegisterForm()
{
    var nameSurname = validateNameAndSurname();
    if(!nameSurname)
        window.alert("Please provide real valid name and surname");
    var captcha= validateCaptcha();
    if(!captcha)
        window.alert("Oops, Nope! " + captchaFake.value + " squared is not 6.25");
    return nameSurname && captcha;
}

function validateNameAndSurname()
{
    var nameInput = document.getElementById("nameInput");
    var name = nameInput.value;
    var surnameInput = document.getElementById("surnameInput");
    var surname = surnameInput.value;
    var regexp= /^[^a-zA-Z]*$/;
    return name.length > 0 && surname.length > 0 && regexp.test(name) && regexp.test(surname);
}

function validateCaptcha()
{
    var answer = parseFloat(captchaFake.value);
    var epsilon = 0.001;
    return Math.abs(answer - 6.25) < epsilon;
}

function handleRatingSelection()
{
    var selectedRating = ratingSelect.options[ratingSelect.selectedIndex].text;
    selectedRating = parseInt(selectedRating);
    switch(selectedRating)
    {
        case 1:
            window.alert("Please don't!");
            break;
        case 2:
        case 3:
        case 4:
            window.alert("Give some more!");
            break;
        case 5:
            window.alert("Thank you!");
            break;
    }
}
