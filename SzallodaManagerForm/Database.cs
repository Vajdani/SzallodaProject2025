using MySql.Data.MySqlClient;

namespace SzallodaManagerForm
{
    internal class Database : IDisposable
    {
        const string server = "datasource=127.0.0.1;sslmode=none;port=3306;username=root;password=;database=szalloda";

        MySqlConnection conn;
        MySqlCommand cmd;
        MySqlDataReader reader;
        public MySqlDataReader Reader { get => reader; private set => reader = value; }

        public Database(string query)
        {
            conn = new MySqlConnection(server);
            conn.Open();

            cmd = new MySqlCommand(query, conn);
            reader = cmd.ExecuteReader();
        }

        ~Database()
        {
            Close();
        }

        public void Dispose()
        {
            Close();
        }

        public void Close()
        {
            conn.Close();
        }

        public bool Read()
        {
            return reader.Read();
        }

        public string GetString(string key)
        {
            return reader.GetString(key);
        }

        public int GetInt(string key)
        {
            return reader.GetInt32(key);
        }
    }
}
