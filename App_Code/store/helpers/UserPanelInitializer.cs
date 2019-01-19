using Model;
using System;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;

namespace helpers
{

    public class UserPanelInitializer
    {
        public UserPanelInitializer()
        {
        }

        public static void handleUserPanel(User user, HtmlContainerControl userPanel, EventHandler handler)
        {
            if (user != null)
                handleUserPanelForLoggedUser(user, userPanel, handler);
            else
                handleUserPanelForNotLoggedUser(userPanel);
        }

        public static void handleUserPanelForLoggedUser(User user, HtmlContainerControl userPanel, EventHandler handler)
        {
            System.Diagnostics.Debug.WriteLine("handleUserPanelForLoggedUser()");
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
            cartQuantitySpan.Attributes.Add("runat", "server");
            var logoutBtn = new Button();
            logoutBtn.CssClass = "logoutBtn";
            logoutBtn.Click += handler;
            logoutBtn.Text = "Logout";
            userPanel.Controls.Add(userNameSpan);
            userPanel.Controls.Add(checkoutAnchor);
            userPanel.Controls.Add(cartQuantitySpan);
            userPanel.Controls.Add(logoutBtn);
        }

        public static void handleUserPanelForNotLoggedUser(HtmlContainerControl userPanel)
        {
            System.Diagnostics.Debug.WriteLine("handleUserPanelForNotLoggedUser()");
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
    }
}
