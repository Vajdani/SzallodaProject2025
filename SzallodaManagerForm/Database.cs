using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;

namespace SzallodaManagerForm
{
    internal class Database
    {
        const string server = "server=linsql.verebely.dc,database=diak72,uid=diak72,password=GUILRN";
        MySqlConnection connection;
        MySqlCommand command;

        public MySqlDataReader Dr;

        public Database(string q)
        {
            connection = new(server);
            command = new MySqlCommand(q, connection);
            Dr = command.ExecuteReader();
        }

        public void CloseConnection()
        {
            connection.Close();
            Dr = null;
        }

        ~Database()
        {
            connection.Close();
        }

    }
}
