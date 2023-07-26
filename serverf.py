import importlib
import subprocess




def install_package(package_name):
    try:
        importlib.import_module(package_name)
        print(f"{package_name} is already installed.")
    except ImportError:
        print(f"{package_name} is not installed. Installing...")
        try:
            subprocess.check_call(['pip', 'install', package_name])
            print(f"{package_name} has been successfully installed.")
        except Exception as e:
            print(f"Failed to install {package_name}: {str(e)}")


def create_database_if_not_exists(database_name, host, user, password):
    try:
        connection = mysql.connector.connect(
            host=host,
            user=user,
            password=password
        )

        cursor = connection.cursor()

        cursor.execute(f"SHOW DATABASES LIKE '{database_name}'")
        existing_databases = cursor.fetchall()

        if not existing_databases:
            cursor.execute(f"CREATE DATABASE {database_name}")
            print(f"Database '{database_name}' has been created.")

        cursor.close()
        connection.close()

    except mysql.connector.Error as e:
        print(f"Error: {str(e)}")


def create_table_if_not_exists(database_name, table_name, table_schema, host, user, password):
    try:
        connection = mysql.connector.connect(
            host=host,
            user=user,
            password=password,
            database=database_name
        )

        cursor = connection.cursor()

        # Проверяем существование таблицы
        cursor.execute(f"SHOW TABLES LIKE '{table_name}'")
        existing_tables = cursor.fetchall()

        if not existing_tables:
            # Создаем таблицу, если она не существует
            cursor.execute(f"CREATE TABLE {table_name} ({table_schema})")
            print(f"Table '{table_name}' has been created.")

        cursor.close()
        connection.close()

    except mysql.connector.Error as e:
        print(f"Error: {str(e)}")


mysql = 'mysql-connector-python'
install_package(mysql)
flask = 'flask'
install_package(flask)

import mysql.connector
from mysql.connector.errors import Error as sqlError
from flask import Flask, request, jsonify, render_template, make_response
import hashlib

host = 'localhost'
user = 'root'
password = '1029384756'
users = 'users'
create_database_if_not_exists(users, host, user, password)
users_info = 'users_info'
users_schema = 'id INT PRIMARY KEY AUTO_INCREMENT,\
    admin BOOL,\
    hashed_password VARCHAR(128),\
    email VARCHAR(100) UNIQUE,\
    username VARCHAR(50) NOT NULL,\
    phone_number VARCHAR(15) NOT NULL,\
    first_name VARCHAR(50) NOT NULL,\
    last_name VARCHAR(50) NOT NULL,\
    age INT,\
    sex VARCHAR(15),\
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP'

items = 'items'
items_schema = 'id int primary key auto_increment,\
    title varchar(50),\
    collection varchar(50),\
    category varchar(100),\
    src varchar(500),\
    price float,\
    description varchar(500),\
    created_at timestamp default current_timestamp,\
    sale int'

orders = 'orders'
orders_schema = 'id_order int primary key auto_increment,\
    id_user int,\
    id_items varchar(500),\
    created_at timestamp default current_timestamp,\
    FOREIGN KEY (id_user) REFERENCES users_info(id) ON DELETE CASCADE'

create_table_if_not_exists(users, users_info, users_schema, host, user, password)
create_table_if_not_exists(users, items, items_schema, host, user, password)
create_table_if_not_exists(users, orders, orders_schema, host, user, password)


app = Flask(__name__)

db_config = {
    'host': host,
    'user': user,
    'password': password,
    'database': users,
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
@app.route('/', methods=['GET'])
def main():
    items = []
    cursor = connection.cursor()
    query = "SELECT id, title, price, src, sale FROM items ORDER BY created_at DESC LIMIT 3"
    cursor.execute(query)
    result = cursor.fetchall()
    items.append([{
        'id': items_data[0],
        'title': items_data[1],
        'price': items_data[2],
        'src': items_data[3],
        'sale': items_data[4]
    } for items_data in result])
    print(items)

    query = "SELECT id, title, price, src, sale FROM items ORDER BY sale DESC LIMIT 3"
    cursor.execute(query)
    result = cursor.fetchall()
    items.append([{
        'id': items_data[0],
        'title': items_data[1],
        'price': items_data[2],
        'src': items_data[3],
        'sale': items_data[4]
    } for items_data in result])

    query = "SELECT collection FROM items ORDER BY created_at DESC LIMIT 1"
    cursor.execute(query)
    last_collection = cursor.fetchone()[0]
    query = "SELECT id, title, price, src, sale FROM items WHERE collection = %s"
    cursor.execute(query, (last_collection,))
    # Fetch the results
    result = cursor.fetchall()
    items.append([{
        'id': items_data[0],
        'title': items_data[1],
        'price': items_data[2],
        'src': items_data[3],
        'sale': items_data[4]
    } for items_data in result])
    cursor.close()
    print(items[2])
    return render_template('main.html', items=items)


@app.route('/category')
def category():
    cursor = connection.cursor()
    # Query to fetch the items grouped by collections and get the src of the first item in each collection
    # Query to fetch all collections and their corresponding first item's src
    query = """
            SELECT i1.collection, i1.src
            FROM items i1
            JOIN (
                SELECT MIN(id) as min_id, collection
                FROM items
                GROUP BY collection
            ) i2 ON i1.id = i2.min_id
        """
    cursor.execute(query)

    result = cursor.fetchall()
    items = [{
        'collection': item_data[0],
        'src': item_data[1]
    } for item_data in result]

    cursor.close()
    return render_template('category.html', items=items)


@app.route('/register', methods=['POST'])
def add_user():
    data = request.get_json()
    user_data = {
        'admin': False,
        'hashed_password': hashlib.sha512(data.get('password').encode('utf-8')).hexdigest(),
        'email': data.get('email'),
        'username': data.get('email'),
        'phone_number': data.get('phone_number'),
        'first_name': data.get('first_name'),
        'last_name': data.get('last_name'),
        'age': data.get('age'),
        'sex': 'none'
    }

    cursor = connection.cursor()
    query = '\
        INSERT INTO users_info (admin, hashed_password, email, username, phone_number, first_name, last_name, age, sex)\
        VALUES (%(admin)s, %(hashed_password)s, %(email)s, %(username)s, %(phone_number)s, %(first_name)s, %(last_name)s, %(age)s, %(sex)s);'
    cursor.execute(query, user_data)
    cursor.close()
    return jsonify({'message': f'added {data.get("first_name")}'}), 200


@app.route('/register')
def register():
    return render_template('register.html')


@app.route('/profile')
def profile():
    return render_template('profile.html')


@app.route('/reset')
def reset():
    return render_template('reset.html')


@app.route('/cart')
def cart():
    return render_template('cart.html')


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


@app.route('/search', methods=['GET'])
def get_dress():
    cursor = connection.cursor()
    try:
        search_query = request.args.get('search', '')
        category_query = request.args.get('category', '')

        if search_query is not None and search_query != "":
            query = "SELECT id, title, price, src FROM items WHERE title LIKE %s OR description LIKE %s OR collection LIKE %s"
            cursor.execute(query, (f'%{search_query}%', f'%{search_query}%', f'%{search_query}%'))
        elif category_query is not None and category_query != "":
            query = "SELECT id, title, price, src FROM items WHERE collection LIKE %s"
            cursor.execute(query, (f'%{category_query}%',))
        result = cursor.fetchall()
        items = [{
            'id': items_data[0],
            'title': items_data[1],
            'price': items_data[2],
            'src': items_data[3]
        } for items_data in result]

    except sqlError:
        query = "SELECT id, title, price, src FROM items"
        cursor.execute(query)
        result = cursor.fetchall()
        items = [{
            'id': items_data[0],
            'title': items_data[1],
            'price': items_data[2],
            'src': items_data[3]
        } for items_data in result]
    except Error as e:
        print(e)
    cursor.close()
    return render_template('search.html', items=items)


def get_items_from_db(item_id):
    cursor = connection.cursor()
    query = "SELECT title, collection, category, price, description, src FROM items where id = %s"
    cursor.execute(query, [item_id])
    item_data = cursor.fetchall()
    cursor.close()

    return item_data


@app.route('/item', methods=['GET'])
def get_item():
    try:
        item_id = request.args.get('id', '')
        items_data = get_items_from_db(item_id)[0]
        item_dict = {
            'title': items_data[0],
            'collection': items_data[1],
            'category': items_data[2],
            'price': items_data[3],
            'description': items_data[4],
            'src': items_data[5]
        }
        print(item_dict)
        return render_template("item.html", item=item_dict)
    except:
        return render_template("error.html")


if __name__ == '__main__':
    connection = mysql.connector.connect(**db_config)
    app.debug = True
    app.run()
    connection.close()
