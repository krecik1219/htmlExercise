<%@ Page Language="C#" AutoEventWireup="true" CodeFile="registration.aspx.cs" Inherits="store_registration" %>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head runat="server">
    <meta charset="UTF-8" />
    <meta name="keywords" content="programming, languages, store, webstore, e-commerce,
        programming languages, c++, python, c, java, computer science, computing, shop,
        online, buy, payment, developers, IT, books, courses, video, audio, registration" />
    <meta name="description" content="Polyglot webstore registration site" />
    <title>Webstore registartion</title>

    <link rel="stylesheet" href="css/registrationStyle.css" type="text/css" />
    <!-- <script src="js/registration.js" type="text/javascript"></script> -->
    <script type="text/javascript">
        function resetForm() {
            document.getElementById("registerForm").reset();
            var inputs = document.getElementsByTagName("input");
            for (var i = 0; i < inputs.length; i++)
                if(inputs[i].type != "submit")
                    inputs[i].value = "";
        }
    </script>
</head>
<body>
<div id="container">
    <header>
        <h3>Fill up the form and register for free</h3>
    </header>
    <div id="regFormContainer">
        <form id="registerForm" runat="server" autocomplete="on">
            <p id="name">
                <label>Name:
                    <asp:TextBox ID="nameInput" runat="server" placeholder="Name"></asp:TextBox>
                    &nbsp;<asp:RequiredFieldValidator ID="nameInputRequiredValidator" runat="server" ErrorMessage="Please provide name." Display="Dynamic" ControlToValidate="nameInput" ForeColor="Red"></asp:RequiredFieldValidator>
                </label>
            </p>
            <p id="surname">
                <label>Surname:
                    <asp:TextBox ID="surnameInput" runat="server" placeholder="Surname"></asp:TextBox>
                    &nbsp;<asp:RequiredFieldValidator ID="surnameInputRequiredValidator" runat="server" ErrorMessage="Please provide surname." Display="Dynamic" ControlToValidate="surnameInput" ForeColor="Red"></asp:RequiredFieldValidator>
                </label>
            </p>
            <p>
                <label>Email:
                    <asp:TextBox ID="email" runat="server" placeholder="sample@mail.com" TextMode="Email"></asp:TextBox>
                    &nbsp;<asp:RequiredFieldValidator ID="emailRequiredValidator" runat="server" ErrorMessage="Please provide email." Display="Dynamic" ControlToValidate="email" ForeColor="Red"></asp:RequiredFieldValidator>
                     &nbsp;<asp:RegularExpressionValidator ID="emailRegularExpressionValidator" runat="server" ErrorMessage="Invalid email format. " ForeColor="Red" Display="Dynamic" ControlToValidate="email" ValidationExpression="\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*"></asp:RegularExpressionValidator>
                </label>
            </p>
             <p>
                <label>Password:
                    <asp:TextBox ID="password1" runat="server" TextMode="Password"></asp:TextBox>
                    &nbsp;<asp:RequiredFieldValidator ID="password1RequiredValidator" runat="server" ErrorMessage="Please provide password." Display="Dynamic" ControlToValidate="password1" ForeColor="Red"></asp:RequiredFieldValidator>
                </label>
            </p>
            <p>
                <label>Password repeat:
                    <asp:TextBox ID="password2" runat="server" TextMode="Password"></asp:TextBox>
                    &nbsp;<asp:RequiredFieldValidator ID="password2RequiredValidator" runat="server" ErrorMessage="Please repeat password. " Display="Dynamic" ControlToValidate="password2" ForeColor="Red"></asp:RequiredFieldValidator>
                    &nbsp;<asp:CompareValidator ID="passwordCompareValidator" runat="server" ErrorMessage="Passwords must match!" ControlToValidate="password2" ControlToCompare="password1" Display="Dynamic" ForeColor="Red"></asp:CompareValidator>
                </label>
            </p>
            <p>
                <label>Mobile number:
                    <asp:TextBox ID="mobileNum" runat="server" placeholder="+48 723 916 624" TextMode="Phone"></asp:TextBox>
                    &nbsp;<asp:RegularExpressionValidator ID="mobileNumRegularExpressionValidator" runat="server" ErrorMessage="Phone number does not match pattern." ForeColor="Red" Display="Dynamic" ControlToValidate="mobileNum" ValidationExpression="^([\+]?\d{2}\s)?(\d{3}\s\d{3}\s\d{3})$"></asp:RegularExpressionValidator>
                </label>
            </p>
            <p>
                <label>Date of birth:
                    <asp:TextBox ID="birthDate" runat="server" TextMode="Date"></asp:TextBox>
                    <asp:CompareValidator ID="birthDateCompareValidator" Operator="LessThan" type="Date" ControltoValidate="birthDate" ErrorMessage="You were not born yet :/" runat="server" Display="Dynamic" ForeColor="Red"/>
                </label>
            </p>
            <p>
                <label>Theme color:
                    <asp:TextBox ID="themeColor" runat="server" TextMode="Color"></asp:TextBox>
                </label>
            </p>
            <p>
                <label>Rate this site from 1 to 5:
                    <asp:TextBox ID="rating" runat="server"></asp:TextBox>
                    &nbsp;<asp:RangeValidator ID="ratingRangeValidator" runat="server" ErrorMessage="Please vote between 1 and 5." Operator="DataTypeCheck" Type="Integer" ForeColor="Red" Display="Dynamic" ControlToValidate="rating" MaximumValue="5" MinimumValue="1"></asp:RangeValidator>
                </label>
            </p>
            <label>This is CAPTCHA fake. What's square root of 6.25?
                <asp:TextBox ID="captchaFake" runat="server"></asp:TextBox>
                &nbsp;<asp:CustomValidator ID="captchaCustomValidator" runat="server" ErrorMessage="Incorrect!" ForeColor="Red" ControlToValidate="captchaFake" OnServerValidate="captchaCustomValidatorServerValidate" ValidateEmptyText="True"></asp:CustomValidator>
            </label>
            <br>
            <asp:Button ID="registerSubmit" runat="server" Text="Submit" />
            <button id="resetButton" type="button" onclick="resetForm();">Reset</button>
            <br /> <br />
            <asp:Label ID="outputLabel" runat="server" Visible="false" ForeColor="Red"></asp:Label>
        </form>
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
