<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Default.aspx.cs" Inherits="WebChatIS.WebForm1" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Spletni klepet - 63140120</title>
</head>
<body>
    <form id="form1" runat="server">
    <div>
    
        <asp:ListBox ID="LB_Pogovor" runat="server" Height="400px" Width="435px"></asp:ListBox>
        <asp:ListBox ID="LB_Uporabniki" runat="server" Height="400px" Width="170px"></asp:ListBox>
        <br />
        <asp:TextBox ID="TB_Sporocilo" runat="server" Height="56px" Width="429px"></asp:TextBox>
        <asp:Button ID="B_Poslji" runat="server" Height="61px" OnClick="B_Poslji_Click" Text="Pošlji" Width="85px" />
        <asp:Button ID="B_Osvezi" runat="server" Height="61px" OnClick="B_Osvezi_Click" Text="Osveži" Width="85px" />
    
        <asp:Button ID="B_Izpis" runat="server" Height="61px" OnClick="B_Izpis_Click" Text="Izpis" Width="85px" />
    
    </div>
        <asp:SqlDataSource ID="MessageDataSource" runat="server" ConnectionString="<%$ ConnectionStrings:ConnectionString %>" DeleteCommand="DELETE FROM [Pogovor] WHERE [Id] = @Id" InsertCommand="INSERT INTO [Pogovor] ([username], [besedilo]) VALUES (@username, @besedilo)" SelectCommand="SELECT * FROM [Pogovor]" UpdateCommand="UPDATE [Pogovor] SET [username] = @username, [besedilo] = @besedilo WHERE [Id] = @Id">
            <DeleteParameters>
                <asp:Parameter Name="Id" Type="Int32" />
            </DeleteParameters>
            <InsertParameters>
                <asp:Parameter Name="username" Type="String" />
                <asp:Parameter Name="besedilo" Type="String" />
            </InsertParameters>
            <UpdateParameters>
                <asp:Parameter Name="username" Type="String" />
                <asp:Parameter Name="besedilo" Type="String" />
                <asp:Parameter Name="Id" Type="Int32" />
            </UpdateParameters>
        </asp:SqlDataSource>
    </form>
</body>
</html>
