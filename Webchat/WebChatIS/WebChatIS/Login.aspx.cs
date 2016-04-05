using System;
using System.Collections;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace WebChatIS
{
    public partial class WebForm2 : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void B_Login_Click(object sender, EventArgs e)
        {
            //Miracle
            Session["LogedIn"] = "True";
            Response.Redirect("Default.aspx");
            Session["username"] = "Miha";
            ArrayList users = new ArrayList();
            users.Add("MIHA");
        }
    }
}