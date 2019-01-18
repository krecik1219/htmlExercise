using helpers;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Service
{
    public class RegistrationService
    {
        private readonly StockDbDataContext dbContext;

        public RegistrationService(StockDbDataContext dbContext)
        {
            this.dbContext = dbContext;
        }

        public Result<DummyResult> registerUser(string name, string surname, string email, string password, string mobileNum, DateTime? birthDate)
        {
            var user = new user
            {
                name = name,
                surname = surname,
                email = email,
                password = password,
                mobile = mobileNum,
                birth_date = birthDate
            };
            try
            {
                dbContext.users.InsertOnSubmit(user);
                dbContext.SubmitChanges();
            } catch(Exception e)
            {
                return new Result<DummyResult>(null, new ResultError("User with such a email already exists!"));
            }
            return new Result<DummyResult>(new DummyResult(), null);
        }
    }
}
