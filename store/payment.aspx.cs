using helpers;
using Model;
using System;
using System.Collections.Generic;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;

public partial class store_payment : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        rejcetNotLoggedUsers();
        if (IsPostBack)
            handlePostBackRequest();
        else
            handleNonPostBackRequest();
        handleUserPanel();
    }

    protected void rejcetNotLoggedUsers()
    {
        var user = Session["user"] as User;
        if (user == null)
            Response.Redirect("webstore.aspx");
    }
    protected void handlePostBackRequest()
    {
    }
    protected void handleNonPostBackRequest()
    {
        initPaymentMethods();
        fillTotalPrice();
    }

    protected void initPaymentMethods()
    {
        List<ImgItem> list = new List<ImgItem>();
        list.Add(new ImgItem("card", "img/visa_mastercard.jpg"));
        list.Add(new ImgItem("bankTransfer", "img/bank_transfer.jpg"));
        list.Add(new ImgItem("cash", "img/cash.jpg"));
        paymentList.DataSource = list;
        paymentList.DataBind();
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
        Response.Redirect("webstore.aspx");
    }

    protected void fillTotalPrice()
    {
        var user = Session["user"] as User;
        if (user == null)
            return;
        totalPrice.InnerText = user.ShoppingCart.getTotalPrice() + " $";
    }

    protected void onPaymentClick(object sender, ImageClickEventArgs e)
    {
        var imgBtn = sender as ImageButton;
        System.Diagnostics.Debug.WriteLine("img btn id: " + imgBtn.ClientID);
        var splittedId = imgBtn.ClientID.Split('_');
        var id = splittedId[splittedId.Length - 1];
        System.Diagnostics.Debug.WriteLine("id: " + id);
        switch(id)
        {
            case "card":
                handlePayment("card");
                break;
            case "bankTransfer":
                handlePayment("bankTransfer");
                break;
            case "cash":
                handlePayment("cash");
                break;
        }
    }

    protected void handlePayment(string method)
    {
        Session["paymentMethod"] = method;
        Response.Redirect("after-payment.aspx");
    }
}