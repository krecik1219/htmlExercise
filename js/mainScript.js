window.addEventListener("load", setupPage);

function setupPage()
{
    var contactInfoBtn = document.getElementById("contactLI");
    contactInfoBtn.addEventListener("click", onContactBtnClick);
}

function onContactBtnClick()
{
    window.prompt("This is cyber robbery, don't move and provide your bank account password!!!");
}