using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

using Model;
using helpers;

namespace Service {

    public class LoginService
    {
        private readonly StockDbDataContext dbContext;

        public LoginService(StockDbDataContext dbContext)
        {
            this.dbContext = dbContext;
        }

        public Result<User> loginUser(string email, string passwordHash)
        {
            var dbUsers =
                from dbUser in dbContext.users
                where dbUser.email == email
                select dbUser;

            var queryResult = dbUsers.ToList();

            if(queryResult.Count <= 0)
                return new Result<User>(null, new ResultError("Wrong credentials"));

            var user = queryResult[0];

            if(passwordHash != user.password)
                return new Result<User>(null, new ResultError("Wrong credentials"));

            return new Result<User>(
                new User(
                    user.id,
                    user.name,
                    user.surname,
                    user.email,
                    user.mobile,
                    user.birth_date
                    ),
                null);
        }
    }
}
