using System.Collections.Generic;

namespace Model {

public class Cart
{
    private readonly Dictionary<int, CartItem> cartItems = new Dictionary<int, CartItem>();

    public Dictionary<int, CartItem> CartItems
    {
        get
        {
            return cartItems;
        }
    }

    public void addToCart(CartItem cartItem)
    {
        if (!CartItems.ContainsKey(cartItem.getItemId()))
        {
            CartItems[cartItem.getItemId()] = cartItem;
        }
        else
        {
            CartItems[cartItem.getItemId()].increaseQuantityBy(cartItem.Quantity);
        }
    }

    public void removeFromCart(int itemId, int quantityToRemove)
    {
        int currentQuantity = CartItems[itemId].Quantity;
        if (currentQuantity - quantityToRemove > 0)
        {
            CartItems[itemId].decreaseQuantityBy(quantityToRemove);
        }
        else
        {
            CartItems.Remove(itemId);
        }
    }

    public decimal getTotalPrice()
    {
        decimal totalPrice = 0;
        foreach (var cartItem in CartItems.Values)
        {
            totalPrice += cartItem.TotalPrice;
        }
        return totalPrice;
    }

    public int getTotalQuantity()
    {
        int totalQuantity = 0;
        foreach (var cartItem in CartItems.Values)
        {
            totalQuantity += cartItem.Quantity;
        }
        return totalQuantity;
    }

    public void resetCart()
    {
        CartItems.Clear();
    }
}
}
