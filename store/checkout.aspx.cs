using helpers;
using Model;
using System;
using System.Collections.Generic;
using System.Web;
using System.Web.Services;
using System.Web.UI.HtmlControls;

public partial class store_checkout : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        rejcetNotLoggedUsers();
        System.Diagnostics.Debug.WriteLine("Page_Load()");
        initItemsView();
        handleUserPanel();
    }

    protected void rejcetNotLoggedUsers()
    {
        var user = Session["user"] as User;
        if (user == null)
            Response.Redirect("webstore.aspx");
    }

    protected void initItemsView()
    {
        System.Diagnostics.Debug.WriteLine("initItemsView()");
        var user = Session["user"] as User;
        if (user == null)
            return;
        itemsRepeater.DataSource = user.ShoppingCart.CartItems.Values;
        itemsRepeater.DataBind();
    }

    protected void handleUserPanel()
    {
        var user = Session["user"] as User;
        if (user == null)
            return;
        var userPanel = Master.FindControl("userPanel") as HtmlContainerControl;
        UserPanelInitializer.handleUserPanel(user, userPanel, handleLogoutClick);
        totalPrice.InnerText = "Total price: " + user.ShoppingCart.getTotalPrice() + "$";
    }

    protected void handleLogoutClick(object sender, EventArgs e)
    {
        System.Diagnostics.Debug.WriteLine("handleLogoutClick()");
        Session.Remove("user");
        Response.Redirect("webstore.aspx");
    }

    protected void resetCart(object sender, EventArgs e)
    {
        System.Diagnostics.Debug.WriteLine("resetCart()");
        var user = Session["user"] as User;
        if (user == null)
            return;
        user.ShoppingCart.resetCart();
        resetCartFront();
    }

    protected void resetCartFront()
    {
        var cartQuantity = Master.FindControl("cartQuantity") as HtmlContainerControl;
        cartQuantity.InnerText = "[0]";
        cartContent.InnerHtml = ""; 
        totalPrice.InnerText = "Total price: 0 $";
    }

    [WebMethod(EnableSession = true)]
    public static string addToCart(int itemId, int quantity)
    {
        System.Diagnostics.Debug.WriteLine("addToCart(): itemId=" + itemId + " ; quantity=" + quantity);
        var user = HttpContext.Current.Session["user"] as User;
        if (user == null)
            return "Please login first";
        System.Diagnostics.Debug.WriteLine("addToCart(): user name=" + user.Name);
        user.ShoppingCart.increaseQuantityBy(itemId, 1);
        return "Item added to your cart";
    }

    [WebMethod(EnableSession = true)]
    public static string removeFromCart(int itemId, int quantity)
    {
        System.Diagnostics.Debug.WriteLine("removeFromCart(): itemId=" + itemId + " ; quantity=" + quantity);
        var user = HttpContext.Current.Session["user"] as User;
        if (user == null)
            return "Please login first";
        System.Diagnostics.Debug.WriteLine("removeFromCart(): user name=" + user.Name);
        user.ShoppingCart.removeFromCart(itemId, quantity);
        return "Item removed from your cart";
    }


    protected void goWithPayment(object sender, EventArgs e)
    {
        var price = totalPrice.InnerText.Split(' ')[2];
        var priceDecimal = decimal.Parse(price.Substring(0, price.Length - 1));
        System.Diagnostics.Debug.WriteLine("goWithPayment total price: " + priceDecimal);
        Session["totalPrice"] = priceDecimal;
        Response.Redirect("payment.aspx");
    }
}