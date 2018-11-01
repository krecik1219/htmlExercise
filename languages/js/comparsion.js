window.onload = function()
                {
		    langRndBtn = document.getElementById("goToRndLang");
		    langRndBtn.addEventListener("click", handleRndLangBtnClick);
		    var footers = document.getElementsByTagName("footer");
		    createDivForImgsAlt(footers.item(0));
		    putImgsAltTogether();
                };

var langRndBtn = null;

function createDivForImgsAlt(footer)
{
    var imgsAltDiv = document.createElement("div");
    imgsAltDiv.setAttribute("id", "imgsAlt");
    var hr = document.createElement("hr");
    footer.parentNode.insertBefore(imgsAltDiv, footer);
    footer.parentNode.insertBefore(hr, footer);
}

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

function putImgsAltTogether()
{
    var images = document.images;
    var image = images.namedItem("progPol");
    var imgsAltDiv = document.getElementById("imgsAlt");
    var progPoly = document.createElement("p");
    progPoly.innerText = image.alt;
    imgsAltDiv.appendChild(progPoly);
}
