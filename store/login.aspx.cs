using Service;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class store_login : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (IsPostBack)
            handleLoginRequest();
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