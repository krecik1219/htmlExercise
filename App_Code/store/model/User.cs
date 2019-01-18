using System;

namespace Model {
public class User
{
    private readonly int id;
    private readonly string name;
    private readonly string surname;
    private readonly string email;
    private readonly string mobile;
    private readonly DateTime? birthDate;
    private readonly Cart shoppingCart;

    public User(int id, string name, string surname, string email, string mobile, DateTime? birthDate)
    {
        this.id = id;
        this.name = name;
        this.surname = surname;
        this.email = email;
        this.mobile = mobile;
        this.birthDate = birthDate;
        this.shoppingCart = new Cart();
    }

    public int Id
    {
        get
        {
            return id;
        }
    }

    public string Name
    {
        get
        {
            return name;
        }
    }

    public string Surname
    {
        get
        {
            return surname;
        }
    }

    public string Email
    {
        get
        {
            return email;
        }
    }

    public string Mobile
    {
        get
        {
            return mobile;
        }
    }

    public DateTime? BirthDate
    {
        get
        {
            return birthDate;
        }
    }

    public Cart ShoppingCart
    {
        get
        {
            return shoppingCart;
        }
    }

}
}
