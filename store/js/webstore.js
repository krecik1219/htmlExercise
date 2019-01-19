function increaseItemQuantity(triggeringObject, increaseBy=1)
{
    var quantityBlock = triggeringObject.parentNode.childNodes[3];
    var currentQuantityString = quantityBlock.value;
    var currentQuantityInt = parseInt(currentQuantityString);
    if(currentQuantityString === "")
        currentQuantityInt = 0;
    quantityBlock.value = currentQuantityInt + increaseBy;
}

function decreaseItemQuantity(triggeringObject, decreaseBy=1)
{
    var quantityBlock = triggeringObject.parentNode.childNodes[3];
    var currentQuantityString = quantityBlock.value;
    var currentQuantityInt = parseInt(currentQuantityString);
    if(currentQuantityString === "")
        currentQuantityInt = 0;
    quantityBlock.value = currentQuantityInt - decreaseBy < 0 ? 0 : currentQuantityInt - decreaseBy;
}

function updateCartItemTotalPrice(triggeringObject)
{
    var quantityBlock = triggeringObject.parentNode.childNodes[3];
    var currentQuantityString = quantityBlock.value;
    var currentQuantityInt = parseInt(currentQuantityString);
    if(currentQuantityString === "")
        currentQuantityInt = 0;

    var priceBlock = triggeringObject.parentNode.parentNode.childNodes[1].childNodes[1];
    var currentPriceString = priceBlock.innerText;
    currentPriceString = currentPriceString.split(' ')[0];
    var currentPriceFloat = parseFloat(currentPriceString);
    if(currentPriceString === "")
        currentPriceFloat = 0.00;

    var totalPriceBlock = triggeringObject.parentNode.parentNode.childNodes[5].childNodes[1];
    var totalPrice = currentQuantityInt * currentPriceFloat;
    totalPriceBlock.innerText = totalPrice + ' $';
}

function addToCart(triggeringObject, itemId, quantity, methodFullName)
{
    var dataValue = { "itemId": itemId, "quantity": quantity };
    $.ajax({
        type: "POST",
        url: methodFullName,
        data: JSON.stringify(dataValue),
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        success: function (result) {
            var cartQuantity = document.getElementById("cartQuantity");
            cartQuantity.innerText = "[" + (parseInt(cartQuantity.innerText.substring(1, cartQuantity.innerText.length - 1)) + quantity) + "]";
            alert("We returned: " + result.d);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Request: " + XMLHttpRequest.toString() + "\n\nStatus: " + textStatus + "\n\nError: " + errorThrown);
        }
    });
}

function addOneToCart(triggeringObject, itemId, methodFullName)
{
    addToCart(triggeringObject, itemId, 1, methodFullName);
    increaseItemQuantity(triggeringObject, 1);
    updateCartItemTotalPrice(triggeringObject);
    updateTotalPrice();
}

function addMultipleToCart(triggeringObject, itemId, methodFullName)
{
    var quantityBlock = triggeringObject.parentNode.parentNode.childNodes[3].childNodes[3];
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

    addToCart(triggeringObject, itemId, quantity, methodFullName);
}

function updateCartItemAfterRemoving(triggeringObject, quantity)
{
    var quantityBlock = triggeringObject.parentNode.childNodes[3];
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
        var item = triggeringObject.parentNode.parentNode.parentNode;
        var nextItemSibling = item.nextSibling;
        item.parentNode.removeChild(nextItemSibling);
        item.parentNode.removeChild(item);
    }
}

function updateTotalPrice()
{
    var cartContent = document.getElementById("contentContainerPlaceHolder_cartContent");
    var totalPriceBlock = document.getElementById("contentContainerPlaceHolder_totalPrice");
    if (cartContent === null)
    {
        totalPriceBlock.innerText = 'Total price: 0 $';
        return;
    }
    var totalPrice = 0;
    for(var i = 1; i < cartContent.childNodes.length - 1; i += 2)
    {
        var child = cartContent.childNodes[i];
        var priceBlock = child.childNodes[5].childNodes[5].childNodes[1];
        var price = parseFloat(priceBlock.innerText.split(' ')[0]);
        totalPrice += price;
    }
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
    var dataValue = { "itemId": itemId, "quantity": quantity };
    $.ajax({
        type: "POST",
        url: "checkout.aspx/removeFromCart",
        data: JSON.stringify(dataValue),
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        success: function (result) {
            var cartQuantity = document.getElementById("cartQuantity");
            cartQuantity.innerText = "[" + (parseInt(cartQuantity.innerText.substring(1, cartQuantity.innerText.length - 1)) - quantity) + "]";
            updateCartItemAfterRemoving(triggeringObject, quantity);
            updateTotalPrice();
            alert("We returned: " + result.d);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Request: " + XMLHttpRequest.toString() + "\n\nStatus: " + textStatus + "\n\nError: " + errorThrown);
        }
    });
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
    xmlhttp.open("GET", "scripts/reset-cart.php", true);
    xmlhttp.send();
}

function isInteger(str) {
    var n = Math.floor(Number(str));
    return String(n) === str || Number.isInteger(str);
}
