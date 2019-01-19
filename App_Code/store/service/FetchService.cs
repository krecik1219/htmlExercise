using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using helpers;
using Model;

namespace Service { 

    public class FetchService
    {
        private readonly StockDbDataContext dbContext;

        public FetchService(StockDbDataContext dbContext)
        {
            this.dbContext = dbContext;
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

        public Result<Item> fetchItemById(int itemId)
        {
            var dbContext = new StockDbDataContext();

            var dbItems =
                from dbItem in dbContext.stocks
                where dbItem.id_item == itemId
                select dbItem;

            try
            {
                var modelItem = dbItems.ToList()[0];

                return new Result<Item>(
                    new Item(
                        modelItem.id_item,
                        modelItem.item_name,
                        modelItem.subcategory.subcategory_name,
                        modelItem.subcategory.category.category_name,
                        modelItem.price,
                        modelItem.photo_url,
                        modelItem.description
                    ), 
                    null);
            }catch(Exception)
            {
                return new Result<Item>(null, new ResultError("Item doesn't exist"));
            }
        }
    }
}
