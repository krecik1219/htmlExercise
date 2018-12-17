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
        if(IsPostBack)
        {
            handleFormPostBackAction();
        }
    }

    protected void handleFormPostBackAction()
    {
        System.Diagnostics.Debug.WriteLine("handleFormPostBackAction");
        Validate();
        if(IsValid)
        {
            displaySentDataInLabel();
        }
    }

    protected void displaySentDataInLabel()
    {
        System.Diagnostics.Debug.WriteLine("displaySentDataInLabel");
        var nameOutput = string.Empty;
        var surnameOutput = string.Empty;
        var emailOutput = string.Empty;
        var mobileOutput = string.Empty;
        var birthDateOutput = string.Empty;
        var themeColorOutput = string.Empty;
        var ratingOutput = string.Empty;
        if (!string.IsNullOrEmpty(nameInput.Text))
            nameOutput = "<br />Name: " + nameInput.Text;
        if (!string.IsNullOrEmpty(surnameInput.Text))
            surnameOutput = "<br />Surname: " + surnameInput.Text;
        if (!string.IsNullOrEmpty(email.Text))
            emailOutput = "<br />Email: " + email.Text;
        if (!string.IsNullOrEmpty(mobileNum.Text))
            mobileOutput = "<br />Mobile: " + mobileNum.Text;
        if (!string.IsNullOrEmpty(birthDate.Text))
            birthDateOutput = "<br />Birth date: " + birthDate.Text;
        if (!string.IsNullOrEmpty(themeColor.Text))
            themeColorOutput = "<br />Theme color: <span style=\"color: " + themeColor.Text + ";\">" + themeColor.Text + "</span>";
        if (!string.IsNullOrEmpty(rating.Text))
            ratingOutput = "<br />Rating: " + rating.Text;
        var stringBuilder = new StringBuilder();
        stringBuilder.Append(nameOutput).Append(surnameOutput).
            Append(emailOutput).Append(mobileOutput).
            Append(birthDateOutput).Append(themeColorOutput).
            Append(ratingOutput);
        outputLabel.Text = stringBuilder.ToString();
        outputLabel.Visible = true;
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