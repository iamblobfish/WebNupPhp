import mysql.connector

db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '1029384756',
    'database': 'database_name',
}

connection = mysql.connector.connect(**db_config)

cursor = connection.cursor()

query = "SELECT * FROM table_name;"
cursor.execute(query)

result = cursor.fetchall()

for row in result:
    print(row)

cursor.close()
connection.close()
