window.addEventListener("load", setupPage);

function setupPage()
{
    var footers = document.getElementsByTagName("footer");
    createDivForNamedLinks(footers.item(0));
    putAllNamedLinksTogether();
}

function createDivForNamedLinks(footer)
{
    var linksDiv = document.createElement("div");
    linksDiv.setAttribute("id", "allLinks");
    var hr = document.createElement("hr");
    footer.parentNode.insertBefore(linksDiv, footer);
    footer.parentNode.insertBefore(hr, footer);
}

function putAllNamedLinksTogether()
{
    var allLinks = document.getElementById("allLinks");
    var listOfLinks = document.createElement("ul");
    allLinks.appendChild(listOfLinks);
    var liElem = null;
    var aElem = null;
    var textNode = null;
    var namedLinks = document.anchors;
    for(var i = 0; i < namedLinks.length; i++)
    {
        liElem = document.createElement("li");
        aElem = document.createElement("a");
        aElem.href = namedLinks[i].href;
        textNode = document.createTextNode(namedLinks[i].innerHTML);
        aElem.appendChild(textNode);
        liElem.appendChild(aElem);
        listOfLinks.appendChild(liElem);
    }
}
