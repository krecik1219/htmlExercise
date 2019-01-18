using Service;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class store_registration : System.Web.UI.Page
{
    readonly float captchaCorrectAnswer = 2.5f;

    protected void Page_Load(object sender, EventArgs e)
    {
        System.Diagnostics.Debug.WriteLine("pageload");
        initValidators();
        if (IsPostBack)
        {
            handleFormPostBackAction();
        }
    }

    protected void initValidators()
    {
        initBirthDateCompareValidator();
    }

    protected void initBirthDateCompareValidator()
    {
        birthDateCompareValidator.ValueToCompare = DateTime.Now.ToShortDateString();
    }

    protected void handleFormPostBackAction()
    {
        System.Diagnostics.Debug.WriteLine("handleFormPostBackAction");
        Validate();
        if(IsValid)
        {
            registerUser();
        }
    }

    protected void registerUser()
    {
        var dbContext = new StockDbDataContext();
        var registrationService = new RegistrationService(dbContext);
        var registrationResult = registrationService.registerUser(
            nameInput.Text,
            surnameInput.Text,
            email.Text,
            password1.Text,
            mobileNum.Text.Length > 0 ? mobileNum.Text : null,
            birthDate.Text.Length > 0 ? (DateTime?)DateTime.Parse(birthDate.Text) : null
        );
        if(registrationResult.isSuccessful())
        {
            System.Diagnostics.Debug.WriteLine("registration successful");
            outputLabel.ForeColor = System.Drawing.Color.Black;
            outputLabel.Text = "Registration successful. <a href=\"login.aspx\">You can now login</a>";
            outputLabel.Visible = true;
        }
        else
        {
            System.Diagnostics.Debug.WriteLine("registration failed");
            outputLabel.Text = registrationResult.Error.Message;
            outputLabel.Visible = true;
        }
    }

    protected void captchaCustomValidatorServerValidate(object source, ServerValidateEventArgs args)
    {
        System.Diagnostics.Debug.WriteLine("captcha");
        try
        {
            var answer = float.Parse(args.Value);
            args.IsValid = (Math.Abs(answer - captchaCorrectAnswer)) < 0.0001;
        }catch
        {
            args.IsValid = false;
        }
    }
}