using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class store_webstore : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        var dbContext = new StockDbDataContext();

        var dbItems =
            from dbItem in dbContext.stocks
            where dbItem.id_item == 6
            select dbItem;

        System.Diagnostics.Debug.WriteLine("page load after linq query");

        String html = "";
        
        foreach (var dbItem in dbItems.ToList())
        {
            html += dbItem.item_name + " ; ";
        }
        System.Diagnostics.Debug.WriteLine("html: " + html);
        items.InnerHtml = html;

    }
}