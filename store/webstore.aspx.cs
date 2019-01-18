using System;
using System.Web.UI.HtmlControls;
using Service;
using Model;
using System.Web.UI.WebControls;

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
        var fetchService = new FetchService();

        itemsRepeater.DataSource = fetchService.fetchItemsBySubcategory(idSubcategory);
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
        if (user != null)
            handleUserPanelForLoggedUser(user);
            
        else
            handleUserPanelForNotLoggedUser();
    }

    protected void handleUserPanelForLoggedUser(User user)
    {
        System.Diagnostics.Debug.WriteLine("handleUserPanelForLoggedUser()");
        var userPanel = Master.FindControl("userPanel") as HtmlContainerControl;
        userPanel.Controls.Clear();
        var userNameSpan = new HtmlGenericControl("span");
        userNameSpan.Attributes.Add("class", "userName");
        var userPreferencesAnchor = new HtmlAnchor();
        userNameSpan.Controls.Add(userPreferencesAnchor);
        userPreferencesAnchor.HRef = "preferences.aspx";
        userPreferencesAnchor.InnerHtml = user.Name + user.Surname;
        var checkoutAnchor = new HtmlAnchor
        {
            HRef = "checkout.aspx"
        };
        var cartImage = new HtmlImage();
        checkoutAnchor.Controls.Add(cartImage);
        cartImage.ID = "cartImg";
        cartImage.Src = "img/cart.png";
        cartImage.Alt = "Shopping cart";
        var cartQuantitySpan = new HtmlGenericControl("span")
        {
            ID = "cartQuantity",
            InnerHtml = "[" + user.ShoppingCart.getTotalQuantity() + "]"
        };
        var logoutForm = new HtmlForm();
        var logoutBtn = new Button();
        logoutBtn.CssClass = "logoutBtn";
        logoutBtn.Click += handleLogoutClick;
        logoutBtn.Text = "Logout";
        userPanel.Controls.Add(userNameSpan);
        userPanel.Controls.Add(checkoutAnchor);
        userPanel.Controls.Add(cartQuantitySpan);
        userPanel.Controls.Add(logoutBtn);
    }

    protected void handleUserPanelForNotLoggedUser()
    {
        System.Diagnostics.Debug.WriteLine("handleUserPanelForNotLoggedUser()");
        var userPanel = Master.FindControl("userPanel") as HtmlContainerControl;
        userPanel.Controls.Clear();
        var loginBtn = new Button();
        loginBtn.CssClass = "signInBtn";
        loginBtn.OnClientClick = "window.location.href=\'login.aspx\'; return false;";
        loginBtn.Text = "Sign In";

        var registerBtn = new Button();
        registerBtn.CssClass = "signUpBtn";
        registerBtn.OnClientClick = "window.location.href=\'registration.aspx\'; return false;";
        registerBtn.Text = "Sign Up";
        userPanel.Controls.Add(loginBtn);
        userPanel.Controls.Add(registerBtn);
    }

    protected void handleLogoutClick(object sender, EventArgs e)
    {
        System.Diagnostics.Debug.WriteLine("handleLogoutClick()");
        Session.Remove("user");
        handleUserPanelForNotLoggedUser();
    }
}