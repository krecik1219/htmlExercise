<%@ Page Title="" Language="C#" MasterPageFile="~/store/webstore.master" AutoEventWireup="true" CodeFile="payment.aspx.cs" Inherits="store_payment" %>

<asp:Content ID="Content1" ContentPlaceHolderID="headPlaceHolder" Runat="Server">
    <link rel="stylesheet" type="text/css" href="css/payment.css">
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="titlePlaceHolder" Runat="Server">
    <span id="titleHolder" runat="server">Payment Section</span>
</asp:Content>
<asp:Content ID="Content3" ContentPlaceHolderID="contentContainerPlaceHolder" Runat="Server">
    <div class="paymentMethodsContainer">
        <asp:ListView ID="paymentList" runat="server" ClientIDMode="Predictable" ClientIDRowSuffix="id">
            <ItemTemplate>
                <asp:Panel runat="server" CssClass="paymentItem">
                    <asp:ImageButton id="methodImg" runat="server" ImageUrl='<%# Eval("imageUrl") %>' Height="174px" Width="286px" OnClick="onPaymentClick"/>
                </asp:Panel>
            </ItemTemplate>
        </asp:ListView>
    </div>
    <div class="summary">
        <p id="totalPrice" runat="server">Total price:</p>
    </div>
</asp:Content>

