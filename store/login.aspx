<%@ Page Language="C#" AutoEventWireup="true" CodeFile="login.aspx.cs" Inherits="store_login" %>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta charset="UTF-8"/>
    <meta name="keywords" content="programming, languages, store, webstore, e-commerce,
        programming languages, c++, python, c, java, computer science, computing, shop,
        online, buy, payment, developers, IT, books, courses, video, audio, registration" />
    <meta name="description" content="Polyglot webstore registration site" />
    <title>Webstore login page</title>

    <link rel="stylesheet" href="css/logiStyle.css" type="text/css" />
</head>
<body>
<div id="container">
    <header>
        <h3>Login to webstore</h3>
    </header>
    <div id="loginFormContainer">
        <form id="loginForm" name="loginForm" autocomplete="on" runat="server">
            <p id="email">
                <label>Email:<br>
                    <asp:TextBox ID="emailInput" runat="server" placeholder="sample@mail.com" TextMode="Email" autofocus="true"></asp:TextBox>
                </label>
            </p>
            <p id="Password">
                <label>Password:<br>
                    <asp:TextBox ID="passwordInput" runat="server" TextMode="Password"></asp:TextBox>
                </label>
            </p>
            <asp:Button ID="loginSubmit" runat="server" Text="login" />
        </form>
        <br />
        <asp:Label ID="outputLabel" runat="server" Visible="false" ForeColor="Red"></asp:Label>
    </div>
    <p>
        <a href="../index.aspx">Back to home page</a>
    </p>
    <footer id="contactInfo">
        <address>
            Contact mail address:
            <a href="mailto:sample@mail.com">sample@mail.com</a>
        </address>
        <h4><del>&copy;</del> Przemysław Szeliński, no rights at all.</h4>
    </footer>
</div>
</body>
</html>

