window.addEventListener("load", setupPage);

var tiobe = null;
var moving = false;
var navigation = null;
var navigationChildren = null;
var mainFile = null;
var fileReplace = null;

function setupPage()
{
    var footers = document.getElementsByTagName("footer");
    tiobe = document.getElementById("tiobe");
    tiobe.addEventListener("mousedown", handleMousedown);
    mainFile = document.getElementById("mainFile");
    navigation = document.getElementById("navigation");
    navigationChildren = navigation.childNodes;
    navigation.addEventListener("mouseover", handleMouseover);
    navigation.addEventListener("mouseout", handleMouseout);
    navigation.addEventListener("mousedown", handleNavDown);
    navigation.addEventListener("mouseup", handleNavUp);
    createDivForNamedLinks(footers.item(0));
    putAllNamedLinksTogether();
}

function handleMousedown()
{
    if(!moving)
    {
        moving = true;
        tiobe.style.position = "absolute";
        document.addEventListener("mousemove", handleMousemove);
    }
    else
    {
        moving = false;
        tiobe.style.position = "";
        tiobe.style.left = "";
        tiobe.style.top = "";
        document.removeEventListener("mousemove", handleMousemove);
    }
}

function handleMousemove(e)
{
    tiobe.style.left = (e.pageX - 15) + "px";
    tiobe.style.top = (e.pageY - 15) + "px";
    console.log("tiobe position: " + tiobe.style.left + " ; " + tiobe.style.top);
    console.log("mouse event position: " + e.clientX + " ; " + e.clientY);
}

function handleMouseover(e)
{
    if(e.altKey && e.target.tagName.toLowerCase() === "a")
    {
        e.target.style.color = "#ff3bdb";
    }
}

function handleMouseout(e)
{
    e.target.style.color = "";
}

function handleNavDown(e)
{
    if(e.ctrlKey && mainFile !== null)
    {
        fileReplace = document.createElement("p");
        fileReplace.innerText = "Instead of file you get me :(";
        document.body.replaceChild(fileReplace, mainFile);
        mainFile = null;
    }
}

function handleNavUp(e)
{
    if(e.ctrlKey && fileReplace !== null)
    {
        var dummy = document.createElement("p");
        dummy.innerText = "Now even worse!";
        document.body.replaceChild(dummy, fileReplace);
    }
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
