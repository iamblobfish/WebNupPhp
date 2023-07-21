import mysql.connector
from flask import Flask, request, jsonify, render_template, make_response
import hashlib
import logging

app = Flask(__name__)

db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '1029384756',
    'database': 'users',
}
# def password_to_hash

# # Настройка логгера
# logging.basicConfig(level=logging.DEBUG,
#                     format='%(asctime)s [%(levelname)s] %(message)s',
#                     filename='app.log',  # Имя файла для записи логов
#                     filemode='a')  # Режим записи (добавление в конец файла)
#
# # Логгер для запросов
# request_logger = logging.getLogger('requests')
# request_logger.setLevel(logging.INFO)
#
# # Логгер для ошибок
# error_logger = logging.getLogger('errors')
# error_logger.setLevel(logging.ERROR)


@app.route('/login')
def index():
    # app.logger.info("Login page requsted")
    response = make_response(render_template('login.html'))
    response.headers['Cache-Control'] = 'public, max-age=3600'
    return response


@app.route('/login', methods=['POST'])
def login():
    data = request.get_json()
    email = data.get('email')
    password = data.get('password')
    print(password)

    cursor = connection.cursor()
    query = "SELECT hashed_password FROM users_info WHERE email = %s"
    cursor.execute(query, (email,))
    result = cursor.fetchone()

    if not result:
        return jsonify({'message': 'User not found'}), 404

    hashed_password = result[0]
    print(hashed_password)
    print(hashlib.sha512(password.encode('utf8')).hexdigest())

    if hashlib.sha512(password.encode('utf8')).hexdigest() != hashed_password:
        return jsonify({'message': "Wrong password"}), 401

    cursor.close()

    return jsonify({'message': "Success!"}), 200


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
