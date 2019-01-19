<%@ Page Title="" Language="C#" MasterPageFile="~/store/webstore.master" AutoEventWireup="true" CodeFile="checkout.aspx.cs" Inherits="store_checkout" %>

<asp:Content ID="Content1" ContentPlaceHolderID="headPlaceHolder" Runat="Server">
    <link rel="stylesheet" type="text/css" href="css/checkout.css">
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="titlePlaceHolder" Runat="Server">
    <span id="titleHolder" runat="server">Checkout</span>
</asp:Content>
<asp:Content ID="Content3" ContentPlaceHolderID="contentContainerPlaceHolder" Runat="Server">
    <div id="cartContent" runat="server">
        <asp:Repeater ID="itemsRepeater" runat="server">
            <ItemTemplate>
                <div class="item">
                    <div class="itemImgBlock">
                        <img class="itemImg" src='<%# Eval("Item.PhotoUrl") %>' alt="item" width="110" height="110">
                        </div>
                        <div class="itemDescr">
                        <p class="itemName"><%# Eval("Item.Name") %></p>
                        <p class="itemDetails"><%# Eval("Item.Description") %></p>
                    </div>
                    <div class="itemCartTools">
                            <div class="priceBlock">
                                <p class="price"><%# Eval("Item.Price") %> $</p>
                            </div>
                            <div class="quantityBlock">
                                <button class="increaseBtn" type="button" onclick="addOneToCart(this, <%# Eval("Item.Id") %>, 'checkout.aspx/addToCart')">+</button>
                                <input class="quantity" type="number" title="quantity" value='<%# Eval("Quantity") %>'>
                                <button class="decreaseBtn" type="button" onclick="removeOneFromCart(this, <%# Eval("Item.Id") %>)">-</button>
                            </div>
                            <div class="priceBlock">
                                <p class="price"><%# Eval("TotalPrice") %> $</p>
                            </div>
                            <div class="floatClearDiv"></div>
                    </div>
                    <div class="floatClearDiv"></div>
                </div>
            </ItemTemplate>
        </asp:Repeater>
    </div>
    <div class="summary">
        <p id="totalPrice" runat="server">Total price:</p>
        <asp:Button ID="resetCartBtn" type="button" OnClick="resetCart" Text="Reset cart" runat="server"/>
        <button type="button" onclick="goWithPayment()">Pay</button>
    </div>
</asp:Content>

