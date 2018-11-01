window.addEventListener("load", setupPage);

function setupPage()
{
    var contactInfoBtn = document.getElementById("contactLI");
    contactInfoBtn.addEventListener("click", onContactBtnClick);
    putAllLinksTogether();
}

function onContactBtnClick()
{
    window.prompt("This is cyber robbery, don't move and provide your bank account password!!!");
}

function putAllLinksTogether()
{
    var allLinks = document.getElementById("allLinks");
    var listOfLinks = document.createElement("ul");
    allLinks.appendChild(listOfLinks);
    var liElem = null;
    var aElem = null;
    var textNode = null;
    var text = null;
    var tableLinks = getTableLinks();
    for(var i = 0; i < tableLinks.length; i++)
    {
        liElem = document.createElement("li");
        aElem = document.createElement("a");
        aElem.href = tableLinks[i].href;
        text = getLinkText(tableLinks[i]);
        if(text === null)
            text = "Undefined";
        textNode = document.createTextNode(text);
        aElem.appendChild(textNode);
        liElem.appendChild(aElem);
        listOfLinks.appendChild(liElem);
    }
}

function getTableLinks()
{
    var link = null;
    var tableLinks = [];
    for(var i = 0; i < document.links.length; i++)
    {
        link = document.links[i];
        if (link.parentNode.nodeName.toLowerCase() === "ul" ||
            link.parentNode.nodeName.toLowerCase() === "li")
        {
            tableLinks.push(link);
        }
    }
    return tableLinks;
}

function getLinkText(link)
{
    var child = null;
    var text = null;
    for(var i = 0; i < link.childNodes.length; i++)
    {
        child = link.childNodes[i];
        if(child.nodeType === Node.TEXT_NODE)
        {
            text = child.data;
            break;
        }
    }
    return text;
}
