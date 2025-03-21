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

        public static List<T> ReadAll<T>(string query)
        {
            List<T> list = [];
            using Database db = new(query);
            while (db.Read())
            {
                list.Add((T)Activator.CreateInstance(typeof(T), db)!);
            }

            return list;
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
            if (Convert.IsDBNull(reader[key])) { return ""; }

            return reader.GetString(key);
        }

        public int GetInt(string key)
        {
            if (Convert.IsDBNull(reader[key])) { return int.MinValue; }

            return reader.GetInt32(key);
        }

        public TimeSpan GetTimeSpan(string key)
        {
            if (Convert.IsDBNull(reader[key])) { return TimeSpan.MinValue; }

            return reader.GetTimeSpan(key);
        }

        public DateTime GetDateTime(string key)
        {
            if (Convert.IsDBNull(reader[key])) { return DateTime.MinValue; }

            return reader.GetDateTime(key);
        }
    }
}
