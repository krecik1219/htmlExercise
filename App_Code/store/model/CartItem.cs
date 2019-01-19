namespace Model {

public class CartItem
{
    private readonly Item item;
    private int quantity = 0;

    public int Quantity
    {
        get
        {
            return quantity;
        }

        private set
        {
            quantity = value;
        }
    }

    public Item Item
    {
        get
        {
            return item;
        }
    }

    public CartItem(Item item, int quantity)
    {
        this.item = item;
        this.Quantity = quantity;
    }

    public decimal TotalPrice
    {
        get
        {
            return Item.Price * Quantity;
        }
    }

        public int getItemId()
    {
        return Item.Id;
    }

    public void increaseQuantityBy(int extraQuantity)
    {
        Quantity += extraQuantity;
    }
    public void decreaseQuantityBy(int minusQuantity)
    {
        Quantity -= minusQuantity;
    }
}
}
