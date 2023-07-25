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
@app.route('/')
def main():
    return render_template('main.html')

@app.route('/category')
def cathegory():
    return render_template('category.html')


@app.route('/item')
def item():
    return render_template('item.html')

@app.route('/register')
def register():
    return render_template('register.html')

@app.route('/reset')
def reset():
    return render_template('reset.html')

@app.route('/login')
def index():
    # app.logger.info("Login page requsted")
    response = make_response(render_template('login.html'))
    # response.headers['Cache-Control'] = 'public, max-age=3600'
    return response


@app.route('/login', methods=['POST'])
def login():
    data = request.get_json()
    email = data.get('email')
    password = data.get('password')

    cursor = connection.cursor()
    query = "SELECT hashed_password FROM users_info WHERE email = %s"
    cursor.execute(query, (email,))
    result = cursor.fetchone()

    if not result:
        return jsonify({'message': 'User not found'}), 404

    hashed_password = result[0]

    if hashlib.sha512(password.encode('utf8')).hexdigest() != hashed_password:
        return jsonify({'message': "Wrong password"}), 401

    cursor.close()

    return jsonify({'message': "Success!"}), 200

@app.route('/search')
def get_dress():
    # data = request.get_json()
    cursor = connection.cursor()
    queue = "select title, collection, source, price from dresses"
    cursor.execute(queue)
    result = list(cursor.fetchone())
    print(result)
    cursor.close()
    return render_template('search.html')


def get_items_from_db(item_id):
    cursor = connection.cursor()

    query = "SELECT id, title, collection, category, price, description FROM items where id = %s"
    cursor.execute(query, item_id)

    item_data = cursor.fetchall()

    cursor.close()

    return item_data


@app.route('/get_items/<int:item_id>')
def get_items(item_id):
    items_data = get_items_from_db(item_id)
    items_list = []
    for item in items_data:
        item_dict = {
            'id': item[0],
            'title': item[1],
            'collection': item[2],
            'category': item[3],
            'price': item[4],
            'description': item[5]
        }
        items_list.append(item_dict)

    return jsonify({'items': items_list})


if __name__ == '__main__':
    connection = mysql.connector.connect(**db_config)
    app.debug = True
    app.run()
    connection.close()
