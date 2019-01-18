namespace Model {

public class Item
{
    private readonly int id;
    private readonly string name;
    private readonly string subcategory;
    private readonly string category;
    private readonly decimal price;
    private readonly string photoUrl;
    private readonly string description;

    public string Description
    {
        get
        {
            return description;
        }
    }

    public string PhotoUrl
    {
        get
        {
            return photoUrl;
        }
    }

    public decimal Price
    {
        get
        {
            return price;
        }
    }

    public string Category
    {
        get
        {
            return category;
        }
    }

    public string Subcategory
    {
        get
        {
            return subcategory;
        }
    }

    public string Name
    {
        get
        {
            return name;
        }
    }

    public int Id
    {
        get
        {
            return id;
        }
    }

    public Item(
                int id,
                string name,
                string subcategory,
                string category,
                decimal price,
                string photoUrl,
                string description
        )
    {
        this.id = id;
        this.name = name;
        this.subcategory = subcategory;
        this.category = category;
        this.price = price;
        this.photoUrl = photoUrl;
        this.description = description;
    }
}
} // namespace Model
