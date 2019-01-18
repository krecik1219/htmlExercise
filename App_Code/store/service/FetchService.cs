using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

using Model;

namespace Service { 

public class FetchService
{
    public FetchService()
    {
    }

    public List<Item> fetchItemsBySubcategory(int idSubcategory)
    {
        var dbContext = new StockDbDataContext();

        var dbItems =
            from dbItem in dbContext.stocks
            where dbItem.id_subcategory == idSubcategory
            select dbItem;

        var modelItems = new List<Item>();

        foreach (var dbItem in dbItems.ToList())
        {
            modelItems.Add(
                new Item(
                    dbItem.id_item,
                    dbItem.item_name,
                    dbItem.subcategory.subcategory_name,
                    dbItem.subcategory.category.category_name,
                    dbItem.price,
                    dbItem.photo_url,
                    dbItem.description
            ));
        }

        return modelItems;
    }
}
}
