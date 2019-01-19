using Model;
using Service;
using System;

public partial class store_login : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        rejectAlreadyLoggedUsers();
        if (IsPostBack)
            handleLoginRequest();
    }

    protected void rejectAlreadyLoggedUsers()
    {
        var user = Session["user"] as User;
        if (user != null)
            Response.Redirect("webstore.aspx");
    }

    protected void handleLoginRequest()
    {
        var dbContext = new StockDbDataContext();
        var loginService = new LoginService(dbContext);
        var loginResult = loginService.loginUser(emailInput.Text, passwordInput.Text);
        if (loginResult.isSuccessful())
        {
            Session["user"] = loginResult.Resource;
            Response.Redirect("webstore.aspx");
        }
        else
        {
            System.Diagnostics.Debug.WriteLine("login failed");
            outputLabel.Text = "Wrong credentials";
            outputLabel.Visible = true;
        }
    }
}