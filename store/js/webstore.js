function increaseItemQuantity(triggeringObject, increaseBy=1)
{
    var quantityBlock = triggeringObject.parentNode.childNodes[1];
    var currentQuantityString = quantityBlock.value;
    var currentQuantityInt = parseInt(currentQuantityString);
    if(currentQuantityString === "")
        currentQuantityInt = 0;
    quantityBlock.value = currentQuantityInt + increaseBy;
}

function decreaseItemQuantity(triggeringObject, decreaseBy=1)
{
    var quantityBlock = triggeringObject.parentNode.childNodes[1];
    var currentQuantityString = quantityBlock.value;
    var currentQuantityInt = parseInt(currentQuantityString);
    if(currentQuantityString === "")
        currentQuantityInt = 0;
    quantityBlock.value = currentQuantityInt - decreaseBy < 0 ? 0 : currentQuantityInt - decreaseBy;
}

function updateCartItemTotalPrice(triggeringObject)
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
    increaseItemQuantity(triggeringObject, 1);
    updateCartItemTotalPrice(triggeringObject);
    updateTotalPrice();
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

function updateCartItemAfterRemoving(triggeringObject, quantity)
{
    var quantityBlock = triggeringObject.parentNode.childNodes[1];
    var currentQuantityString = quantityBlock.value;
    var currentQuantityInt = parseInt(currentQuantityString);
    if(currentQuantityString === "")
        currentQuantityInt = 0;
    if(currentQuantityInt - quantity > 0)
    {
        decreaseItemQuantity(triggeringObject, quantity);
        updateCartItemTotalPrice(triggeringObject);
    }
    else  // cartItem was removed
    {
        var item = triggeringObject.parentNode.parentNode.parentNode.parentNode;
        item.parentNode.removeChild(item);
    }
}

function updateTotalPrice()
{
    var cartContent = document.getElementById("cartContent");
    var totalPrice = 0;
    for(var i = 1; i < cartContent.childNodes.length - 1; i++)
    {
        var child = cartContent.childNodes[i];
        var priceBlock = child.childNodes[2].childNodes[0].childNodes[2].childNodes[0];
        var price = parseFloat(priceBlock.innerText.split(' ')[0]);
        totalPrice += price;
    }
    var totalPriceBlock = document.getElementById("totalPrice");
    totalPriceBlock.innerText = 'Total price: ' + totalPrice + ' $';
}

function resetCartFront()
{
    var cartContent =document.getElementById("cartContent");
    cartContent.innerHTML = '';
    var totalPrice = document.getElementById("totalPrice");
    totalPrice.innerText = "Total price: 0 $";
}

function removeFromCart(triggeringObject, itemId, quantity)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === XMLHttpRequest.DONE)
        {
            if (xmlhttp.status === 200)  // successful with response
            {
                var cartQuantity = document.getElementById("cartQuantity");
                cartQuantity.innerText = parseInt(cartQuantity.innerText) - quantity;
                updateCartItemAfterRemoving(triggeringObject, quantity);
                updateTotalPrice();
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
    xmlhttp.open("GET", "remove-from-cart.php?id=" + itemId + "&q=" + quantity, true);
    xmlhttp.send();
}

function removeOneFromCart(triggeringObject, itemId)
{
    removeFromCart(triggeringObject, itemId, 1);
}

function resetCart()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === XMLHttpRequest.DONE)
        {
            if (xmlhttp.status === 200)  // successful with response
            {
                var cartQuantity = document.getElementById("cartQuantity");
                cartQuantity.innerText = "0";
                resetCartFront();
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
    xmlhttp.open("GET", "reset-cart.php", true);
    xmlhttp.send();
}

function isInteger(str) {
    var n = Math.floor(Number(str));
    return String(n) === str || Number.isInteger(str);
}
