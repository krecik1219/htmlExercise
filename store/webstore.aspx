<%@ Page Title="" Language="C#" MasterPageFile="~/store/webstore.master" AutoEventWireup="true" CodeFile="webstore.aspx.cs" Inherits="store_webstore" %>

<asp:Content ID="Content1" ContentPlaceHolderID="headPlaceHolder" Runat="Server">
    <link rel="stylesheet" type="text/css" href="css/webstoreMain.css">
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="titlePlaceHolder" Runat="Server">
    Developers Webstore
</asp:Content>
<asp:Content ID="Content3" ContentPlaceHolderID="ContentContainerPlaceHolder" Runat="Server">
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
        <div class="items" id="items" runat="server">
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

