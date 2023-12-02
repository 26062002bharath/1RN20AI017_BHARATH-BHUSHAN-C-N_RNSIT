import mysql.connector
from pymongo import MongoClient

# Connect to MySQL
mysql_conn = mysql.connector.connect(
    host="your_mysql_host",
    user="your_mysql_user",
    password="your_mysql_password",
    database="profile_db"
)
mysql_cursor = mysql_conn.cursor(dictionary=True)

# Connect to MongoDB
mongo_client = MongoClient("mongodb://rahul")
mongo_db = mongo_client["myDB"]

# Fetch data from MySQL and insert into MongoDB
mysql_cursor.execute("SELECT * FROM users")
data = mysql_cursor.fetchall()

mongo_collection = mongo_db["users"]
mongo_collection.insert_many(data)

# Close connections
mysql_cursor.close()
mysql_conn.close()
mongo_client.close()