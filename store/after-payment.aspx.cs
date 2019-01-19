using helpers;
using Model;
using System;
using System.Web.UI.HtmlControls;

public partial class store_after_payment : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        rejcetNotLoggedUsers();
        initViews();
        handleUserPanel();
        resetCart();
    }

    protected void rejcetNotLoggedUsers()
    {
        var user = Session["user"] as User;
        if (user == null)
            Response.Redirect("webstore.aspx");
    }

    protected void resetCart()
    {
        System.Diagnostics.Debug.WriteLine("resetCart()");
        var user = Session["user"] as User;
        if (user == null)
            return;
        user.ShoppingCart.resetCart();
        var cartQuantity = Master.FindControl("cartQuantity") as HtmlContainerControl;
        cartQuantity.InnerText = "[0]";
    }

    protected void initViews()
    {
        initTotalCost();
        initPaymentImg();
    }

    protected void initTotalCost()
    {
        var user = Session["user"] as User;
        if (user == null)
            return;
        totalPrice.InnerText = "Total purchase cost: " + user.ShoppingCart.getTotalPrice() + " $";
    }

    protected void initPaymentImg()
    {
        var paymentMethod = Session["paymentMethod"] as string;
        string imageUrl = "";
        switch(paymentMethod)
        {
            case "card":
                imageUrl = "img/visa_mastercard.jpg";
                break;
            case "bankTransfer":
                imageUrl = "img/bank_transfer.jpg";
                break;
            case "cash":
                imageUrl = "img/cash.jpg";
                break;
        }
        paymentMethodImg.ImageUrl = imageUrl;
    }

    protected void handleUserPanel()
    {
        var user = Session["user"] as User;
        if (user == null)
            return;
        var userPanel = Master.FindControl("userPanel") as HtmlContainerControl;
        UserPanelInitializer.handleUserPanel(user, userPanel, handleLogoutClick);
    }

    protected void handleLogoutClick(object sender, EventArgs e)
    {
        System.Diagnostics.Debug.WriteLine("handleLogoutClick()");
        Session.Remove("user");
        UserPanelInitializer.handleUserPanelForNotLoggedUser(Master.FindControl("userPanel") as HtmlContainerControl);
    }
}