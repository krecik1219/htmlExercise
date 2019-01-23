<%@ Page Title="" Language="C#" MasterPageFile="~/store/webstore.master" AutoEventWireup="true" CodeFile="webstore.aspx.cs" Inherits="store_webstore" %>
<asp:Content ID="Content1" ContentPlaceHolderID="headPlaceHolder" Runat="Server">
    <link rel="stylesheet" type="text/css" href="css/webstoreMain.css">
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="titlePlaceHolder" Runat="Server">
    <span id="titleHolder" runat="server">Developers Webstore</span>
</asp:Content>
<asp:Content ID="Content3" ContentPlaceHolderID="contentContainerPlaceHolder" Runat="Server">
    <div class="categories">
        <ul>
            <li>Books
                <ul>
                    <li><a href="?sc=2">C++</a></li>
                    <li><a href="?sc=3">C</a></li>
                    <li>Java</li>
                    <li>Python</li>
                </ul>
            </li>
            <li>Videos
                <ul>
                    <li>C++</li>
                    <li>C</li>
                    <li>Java</li>
                    <li>Python</li>
                </ul>
            </li>
            <li>Accessories
                <ul>
                    <li>T-shirts</li>
                    <li>Caps/hats</li>
                    <li>Mugs</li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="mainContent">
        <div class="category">
            Recommended for you
        </div>
        <div id="items" class="items" runat="server">
        <asp:Repeater ID="itemsRepeater" runat="server">
            <ItemTemplate>
                <div class="item">
                    <div class="itemImgBlock">
                        <img class="itemImg" src='<%# Eval("PhotoUrl") %>' alt="item" width="110" height="110">
                    </div>
                    <div class="itemDescr">
                        <p class="itemName"><%# Eval("Name") %></p>
                        <p class="itemDetails"><%# Eval("Description") %></p>
                    </div>
                    <div class="itemCartTools">

                            <div class="priceBlock">
                                <p class="price"><%# Eval("Price") %> $</p>
                            </div>
                            <div class="quantityBlock">
                                <button class="increaseBtn" type="button" onclick="increaseItemQuantity(this)">+</button>
                                <input class="quantity" type="number" title="quantity" value="0">
                                <button class="decreaseBtn" type="button" onclick="decreaseItemQuantity(this)">-</button>
                            </div>
                            <div class="addToCartBlock">
                                <button class="addToCartBtn" type="submit" title="addToCart" onClick="addMultipleToCart(this, '<%# Eval("Id") %>', 'webstore.aspx/addToCart'); return false;">Cart++</button>
                            </div>
                            <div class="floatClearDiv"></div>
                    </div>
                    <div class="floatClearDiv"></div>
                </div>
            </ItemTemplate>
        </asp:Repeater>
        </div>
    </div>
    <div class="bookmarks">
        <ul>
            <li>Programming polyglot</li>
            <li>C++ section</li>
            <li>C section</li>
            <li>Java section</li>
            <li>Python section</li>
        </ul>
    </div>
    <div class="floatClearDiv"></div>
</asp:Content>

