# Farm Products API

Цей проект реалізує RESTful API для управління фермерськими продуктами (назва продукту, кількість, ціна). API створено за допомогою Laravel і використовує базу даних PostgreSQL.

## Вимоги

Для запуску проекту потрібні наступні вимоги:
- PHP >= 8.1
- Composer
- PostgreSQL
- OpenServer або інший локальний веб-сервер

## Установка

1 **Клонування репозиторію**
   ```bash
   git clone https://github.com/Liahera/farm-products.git
   cd farm-products
```

2 **Виконайте команду для встановлення залежностей:**
```bash
composer install
```
3 **Відредагуйте файл .env, вказавши:**

	DB_CONNECTION=pgsql
	DB_HOST=127.0.0.1
	DB_PORT=5432
	DB_DATABASE=farm_products
	DB_USERNAME=postgres
	DB_PASSWORD=
4 **Створіть таблиці в базі даних:**
 ```bash
 php artisan migrate
 ```
5 **Додайте тестові дані:**
```bash
php artisan db:seed
```
6 **Запустіть сервер розробки:**
```bash
php artisan serve
```

## API Endpoint: Отримати продукти

### Параметри запиту:
- `name` (string): **Фільтрувати продукти за назвою**.  
  Приклад: `name=apple`
  
- `min_quantity` (int): **Мінімальна кількість продукту**.  
  Приклад: `min_quantity=5`
  
- `max_quantity` (int): **Максимальна кількість продукту**.  
  Приклад: `max_quantity=100`
  
- `min_price` (float): **Мінімальна ціна продукту**.  
  Приклад: `min_price=10.5`
  
- `max_price` (float): **Максимальна ціна продукту**.  
  Приклад: `max_price=50.0`
  
- `sort_by` (string): **Атрибут для сортування** (наприклад, 'name', 'price', 'quantity').  
  Приклад: `sort_by=price`
  
- `sort_order` (string): **Порядок сортування**.  
  Дозволяє значення 'asc' для зростання або 'desc' для спаду. За замовчуванням - 'asc'.  
  Приклад: `sort_order=desc`

### Приклад запиту:

GET /products?name=apple&min_price=10&sort_by=price&sort_order=desc


### Приклад відповіді:
```json
[
  {
    "id": 1,
    "name": "Apple",
    "price": 15.0,
    "quantity": 20
  },
  {
    "id": 2,
    "name": "Apple Juice",
    "price": 12.0,
    "quantity": 50
  }
]
