using System;
using System.Collections;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace WebChatIS
{
    public partial class WebForm1 : System.Web.UI.Page
    {
        
        ArrayList users = new ArrayList();
        
        protected void Page_Load(object sender, EventArgs e)
        {
            if ((string)Session["LogedIn"] != "True" || Session["LogedIn"]==null)
            {
                Response.Redirect("Login.aspx");
            }

        }

        protected void B_Poslji_Click(object sender, EventArgs e)
        {
            AddToMessages(TB_Sporocilo.Text);
        }
        protected void FillData()
        {
            LB_Pogovor.Items.Clear();
            DataView dv = (DataView)MessageDataSource.Select(DataSourceSelectArguments.Empty);
            foreach (DataRowView row in dv)
            {
                String user = row.Row["username"].ToString();
                String besedilo = row.Row["besedilo"].ToString();
                LB_Pogovor.Items.Add(user + ":" + besedilo);
            }
            LB_Uporabniki.Items.Clear();
            users = (ArrayList)Application["Uporabniki"];
            foreach (String usr in users)
            {
                LB_Uporabniki.Items.Add(usr);
            }
        }

        protected void B_Osvezi_Click(object sender, EventArgs e)
        {

           
        }

        protected void AddToMessages(String message)
        {
            string connectionString = "Data Source=(LocalDB)\\MSSQLLocalDB;AttachDbFilename=E:\\Projects\\WebProjects\\WebChatIS\\WebChatIS\\App_Data\\63140120_VR42X_IRC.mdf;Integrated Security=True";
            using (SqlConnection connection = new SqlConnection(connectionString))
            {
                SqlCommand cmd = new SqlCommand("INSERT INTO Pogovor (username, besedilo) VALUES (@username, @besedilo)");
                cmd.CommandType = CommandType.Text;
                cmd.Connection = connection;
                cmd.Parameters.AddWithValue("@username", "Miha");
                cmd.Parameters.AddWithValue("@besedilo", message);
                connection.Open();
                cmd.ExecuteNonQuery();
            }
            TB_Sporocilo.Text = String.Empty;
            TB_Sporocilo.Focus();
            FillData();
        }

        protected void B_Izpis_Click(object sender, EventArgs e)
        {
            Session["LogedIn"] = "False";
            users.Remove(Session["username"]);
            Application["Uporabniki"] = users;
        }
    }
}