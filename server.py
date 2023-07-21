import mysql.connector
from flask import Flask, request, jsonify, render_template
import hashlib

app = Flask(__name__)

db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '1029384756',
    'database': 'users',
}


@app.route('/')
def index():
    return render_template("")


# @app.route('/login', methods=['POST'])
# def login():
#     data = request.get_json()
#     email = data.get('email')
#     password = data.get('password')
#
#     cursor = connection.cursor()
#     query = "SELECT id, hash_password FROM users_info WHERE email = %s"
#     cursor.execute(query, email)
#     result = cursor.fetchone()
#
#     if not result:
#         return jsonify({'message': 'User not found'}), 404
#
#     user_id, hash_password = result
#
#     if hashlib.sha512(password).hexdigest() != hash_password:
#         return jsonify({'message': "Wrong password"}), 401
#
#     cursor.close()
#
#     return jsonify({'message': "Success!"}), 200


if __name__ == '__main__':
    connection = mysql.connector.connect(**db_config)
    app.debug = True
    app.run()
    connection.close()

# query = "SELECT * FROM users_info;"
# cursor.execute(query)
#
# result = cursor.fetchall()
#
# for row in result:
#     print(row)
#
# cursor.close()
