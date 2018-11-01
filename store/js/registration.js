window.onload = setupPage;

var ratingSelect = null;
var captchaFake = null;
var fontSelect = null;

var inputHelps = {
    "nameInput": "Name must be at least 1 character long without numbers",
    "surnameInput": "Surname must be at least 1 character long without numbers"
};

function setupPage()
{
    var registerForm = document.getElementById("registerForm");
    registerForm.addEventListener("submit", sendRegisterForm);
    registerForm.addEventListener("reset", handleFormReset);
    ratingSelect = document.getElementById("rating");
    ratingSelect.addEventListener("change", handleRatingSelection);
    captchaFake = document.getElementById("captchaFake");
    fontSelect = document.getElementById("fontSelect");
    fontSelect.addEventListener("change", handleFontChange);
    document.addEventListener("mousedown", handleMouseDown);
    document.getElementById("nameInput").addEventListener("focus", handleFormItemFocus);
    document.getElementById("surnameInput").addEventListener("focus", handleFormItemFocus);
    document.getElementById("nameInput").addEventListener("blur", handleFormItemBlur);
    document.getElementById("surnameInput").addEventListener("blur", handleFormItemBlur);
    displayHelp(document.activeElement.id);
}

function sendRegisterForm(e)
{
    disableForms();
    if(confirm("Are you sure you want to send this data?"))
    {
        if(validateRegisterForm())
        {
            window.alert("Registration form sent!");
            enableForms();
            return true;
        }
    }
    else
    {
        e.preventDefault();
        enableForms();
        return false;
    }
}

function handleFormReset(e)
{
    disableForms();
    if(confirm("Reset?"))
    {
        enableForms();
        return true;
    }
    else
    {
        e.preventDefault();
        enableForms();
        return false;
    }
}

function disableForms()
{
    var form = null;
    for(var i = 0; i < document.forms.length; i++)
    {
        form = document.forms[i];
        for(var j = 0; j < form.length; j++)
            form[j].disabled = true;
    }
}

function enableForms()
{
    var form = null;
    for(var i = 0; i < document.forms.length; i++)
    {
        form = document.forms[i];
        for(var j = 0; j < form.length; j++)
            form[j].disabled = false;
    }
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
    var regexp= /^[a-zA-Z]*$/;
    return name.length > 0 && surname.length > 0 && regexp.test(name) && regexp.test(surname);
}

function validateCaptcha()
{
    var answer = parseFloat(captchaFake.value);
    var epsilon = 0.0001;
    return Math.abs(answer * answer - 6.25) < epsilon;
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

function handleFontChange()
{
    var selectedFont = fontSelect.options[fontSelect.selectedIndex].text;
    document.body.setAttribute("style", "font-family: "+ selectedFont + ";");
}

function handleMouseDown(e)
{
    var targetName = e.target.tagName.toLowerCase();
    switch(targetName)
    {
        case "label":
            handleLabelClick(e);
            break;
        case "body":
            handleBodyClick(e);
            break;
    }
}

function handleLabelClick(e)
{
    if(e.ctrlKey)
        setFontColor("#a100ff");
    else if(e.shiftKey)
        setFontColor("#000000");
    else if(e.altKey)
        setFontColor("#007eff");
}

function setFontColor(hexCode)
{
    document.body.style["color"] = hexCode;
}

function handleBodyClick(e)
{
    if(e.ctrlKey)
        setBackgroundColor("#a0ffb8");
    else if(e.shiftKey)
        setBackgroundColor("#efb6ff");
    else if(e.altKey)
        setBackgroundColor("#ffd198");
}

function setBackgroundColor(hexCode)
{
    document.body.style["background-color"] = hexCode;
}

function handleFormItemFocus(e)
{
    switch(e.target.id)
    {
        case "nameInput":
            displayHelp("nameInput");
            break;
        case "surnameInput":
            displayHelp("surnameInput");
            break;
    }
}

function displayHelp(inputName)
{
    if(inputName === null)
        return;
    var help = document.createElement("p");
    help.id = "help";
    help.innerText = inputHelps[inputName];
    help.style['color'] = "#20d1ff";
    help.style['font-size'] = "0.7em";
    var currentNode = document.getElementById(inputName);
    currentNode.parentNode.insertBefore(help, currentNode.nextSibling);
}

function handleFormItemBlur(e)
{
    switch(e.target.id)
    {
        case "nameInput":
        case "surnameInput":
            removeHelp();
            break;
    }
}

function removeHelp()
{
    var help = document.getElementById("help");
    help.parentNode.removeChild(help);
}
