using System;
using System.Web.UI.HtmlControls;
using Service;
using Model;
using System.Web.UI.WebControls;
using System.Web.UI;
using System.Web.Services;
using System.Web;
using System.Collections.Generic;
using helpers;

public partial class store_webstore : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        System.Diagnostics.Debug.WriteLine("Page_Load()");
        if (IsPostBack)
            handlePostBackRequest();
        else
            handleNonPostBackRequest();
        handleUserPanelView();
    }

    protected void initItemsView()
    {
        string idSubcategoryStr = Request["sc"];

        System.Diagnostics.Debug.WriteLine("idSubcategory: " + idSubcategoryStr);

        int idSubcategory = 2;
        if (idSubcategoryStr != null)
        {
            try
            {
                idSubcategory = int.Parse(idSubcategoryStr);
            }
            catch (Exception)
            {
                titleHolder.InnerHtml = "<span style=\"color: red;\">Request error</span>";
            }
        }

        var dbContext = new StockDbDataContext();
        var fetchService = new FetchService(dbContext);

        var itemsData = fetchService.fetchItemsBySubcategory(idSubcategory);
        Session["items"] = itemsData;
        itemsRepeater.DataSource = itemsData;
        itemsRepeater.DataBind();
    }

    protected void handlePostBackRequest()
    {
        System.Diagnostics.Debug.WriteLine("handling postback req");
    }

    protected void handleNonPostBackRequest()
    {
        System.Diagnostics.Debug.WriteLine("handling NON postback req");
        initItemsView();
    }

    protected void handleUserPanelView()
    {
        System.Diagnostics.Debug.WriteLine("handleUserPanelView()");
        User user = Session["user"] as User;
        var userPanel = Master.FindControl("userPanel") as HtmlContainerControl;
        UserPanelInitializer.handleUserPanel(user, userPanel, handleLogoutClick);
    }

    protected void handleLogoutClick(object sender, EventArgs e)
    {
        System.Diagnostics.Debug.WriteLine("handleLogoutClick()");
        Session.Remove("user");
        UserPanelInitializer.handleUserPanelForNotLoggedUser(Master.FindControl("userPanel") as HtmlContainerControl);
    }

    [WebMethod(EnableSession = true)]
    public static string addToCart(int itemId, int quantity)
    {
        System.Diagnostics.Debug.WriteLine("addToCart(): itemId=" + itemId + " ; quantity=" + quantity);
        var user = HttpContext.Current.Session["user"] as User;
        if (user == null)
            return "Please login first";
        System.Diagnostics.Debug.WriteLine("addToCart(): user name=" + user.Name);
        var items = HttpContext.Current.Session["items"] as List<Item>;
        var item = items.Find(x => x.Id == itemId);
        System.Diagnostics.Debug.WriteLine("item: id=" + item.Id + " ; name=" + item.Name);
        var cartItem = new CartItem(item, quantity);
        user.ShoppingCart.addToCart(cartItem);
        return "Item added to your cart";
    }
}