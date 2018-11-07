window.onload = function()
                {
                    langRndBtn = document.getElementById("goToRndLang");
                    langRndBtn.addEventListener("click", handleRndLangBtnClick);
                };

var langRndBtn = null;

function handleRndLangBtnClick()
{
    var langNames = document.getElementsByClassName("langName");
    var randomLang = Math.floor(Math.random() * langNames.length);
    var selectedPage = langNames[randomLang];
    var langPage = selectedPage.innerHTML + ".html";
    langPage = langPage.toLowerCase();
    langPage = langPage.replace("c++", "cpp");

    window.location.href = langPage;
}
