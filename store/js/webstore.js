function increaseItemQuantity(triggeringObject)
{
    var quantityBlock = triggeringObject.parentNode.childNodes[1];
    var currentQuantityString = quantityBlock.value;
    var currentQuantityInt = parseInt(currentQuantityString);
    if(currentQuantityString === "")
        currentQuantityInt = 0;
    quantityBlock.value = currentQuantityInt + 1;;
}

function decreaseItemQuantity(triggeringObject)
{
    var quantityBlock = triggeringObject.parentNode.childNodes[1];
    var currentQuantityString = quantityBlock.value;
    var currentQuantityInt = parseInt(currentQuantityString);
    if(currentQuantityString === "")
        currentQuantityInt = 0;
    quantityBlock.value = currentQuantityInt - 1 < 0 ? 0 : currentQuantityInt - 1;
}

function updateTotalPrice(triggeringObject)
{
    var quantityBlock = triggeringObject.parentNode.childNodes[1];
    var currentQuantityString = quantityBlock.value;
    var currentQuantityInt = parseInt(currentQuantityString);
    if(currentQuantityString === "")
        currentQuantityInt = 0;

    var priceBlock = triggeringObject.parentNode.parentNode.childNodes[0].childNodes[0];
    var currentPriceString = priceBlock.innerText;
    currentPriceString = currentPriceString.split(' ')[0];
    var currentPriceFloat = parseFloat(currentPriceString);
    if(currentPriceString === "")
        currentPriceFloat = 0.00;

    var totalPriceBlock = triggeringObject.parentNode.parentNode.childNodes[2].childNodes[0];
    var totalPrice = currentQuantityInt * currentPriceFloat;
    totalPriceBlock.innerText = totalPrice + ' $';
}

function addToCart(triggeringObject, itemId, quantity)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === XMLHttpRequest.DONE)
        {
            if (xmlhttp.status === 200)  // successful with response
            {
                var cartQuantity = document.getElementById("cartQuantity");
                cartQuantity.innerText = parseInt(cartQuantity.innerText) + quantity;
                alert(xmlhttp.responseText);
            }
            else if (xmlhttp.status === 400)
            {
                alert('There was an error 400');
            }
            else
            {
                alert('something else other than 200 was returned');
            }
        }
    };
    xmlhttp.open("GET", "add-to-cart.php?id=" + itemId + "&q=" + quantity, true);
    xmlhttp.send();
}

function addOneToCart(triggeringObject, itemId)
{
    addToCart(triggeringObject, itemId, 1);
    increaseItemQuantity(triggeringObject);
    updateTotalPrice(triggeringObject)
}

function addMultipleToCart(triggeringObject, itemId)
{
    var quantityBlock = triggeringObject.parentNode.parentNode.childNodes[1].childNodes[1];
    var quantityString = quantityBlock.value;
    if(!isInteger(quantityString) || !isInteger(itemId))
    {
        alert("'id' and 'q' must be integers");
        return;
    }
    var quantity = parseInt(quantityString);
    if(quantityString === "")
        quantity = 0;

    if (quantity <= 0)
    {
        alert("Quantity must be positive integer");
        return;
    }

    addToCart(triggeringObject, itemId, quantity);
}

function isInteger(str) {
    var n = Math.floor(Number(str));
    return String(n) === str || Number.isInteger(str);
}
