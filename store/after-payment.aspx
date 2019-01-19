<%@ Page Title="" Language="C#" MasterPageFile="~/store/webstore.master" AutoEventWireup="true" CodeFile="after-payment.aspx.cs" Inherits="store_after_payment" %>

<asp:Content ID="Content1" ContentPlaceHolderID="headPlaceHolder" Runat="Server">
    <link rel="stylesheet" type="text/css" href="css/after-payment.css">
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="titlePlaceHolder" Runat="Server">
    <span id="titleHolder" runat="server">Thank you for purchase in our store</span>
</asp:Content>
<asp:Content ID="Content3" ContentPlaceHolderID="contentContainerPlaceHolder" Runat="Server">
    <div id="purchaseSummary">
        <p id ="totalPrice" runat="server">Total purchase cost:</p>
        <p>Selected payment method</p>
        <asp:Image ID ="paymentMethodImg" runat="server" Height="174px" Width="286px"/>
        <p><a href="webstore.aspx">Back to webstore main page</a></p>
    </div>
</asp:Content>

