# Bank CRUD API на Laravel та Symfony

## Опис проєкту

Проєкт виконано з предмету **«Основи роботи з PHP фреймворками, використання штучного інтелекту»**.

У роботі реалізовано CRUD API на двох PHP-фреймворках:

- **Laravel**
- **Symfony**

Тема проєкту: **Bank**.

Для реалізації CRUD-операцій створено сутність **BankAccount** банківський рахунок.  
API дозволяє створювати, переглядати, оновлювати та видаляти банківські рахунки.

## Структура проєкту

```text
frameworks/
├── laravel/
│   ├── app/Models/BankAccount.php
│   ├── app/Http/Controllers/BankAccountController.php
│   ├── database/migrations/
│   ├── routes/web.php
│   └── postman/
│       └── laravel-bank-api.postman_collection.json
│
└── symfony/
    ├── src/Entity/BankAccount.php
    ├── src/Repository/BankAccountRepository.php
    ├── src/Controller/BankAccountController.php
    ├── migrations/
    ├── config/packages/security.yaml
    └── postman/
        └── symfony-bank-api.postman_collection.json
```

## Сутність BankAccount

Сутність **BankAccount** містить такі поля:

| Поле | Опис |
|---|---|
| `id` | Унікальний ідентифікатор рахунку |
| `owner_name` | ПІБ власника рахунку |
| `account_number` | Номер банківського рахунку |
| `balance` | Баланс рахунку |
| `currency` | Валюта рахунку |
| `is_active` | Статус активності рахунку |
| `created_at` | Дата створення запису |
| `updated_at` | Дата оновлення запису |

## CRUD endpoints

В обох фреймворках реалізовано однакові CRUD endpoint-и.

### Laravel

Base URL:

```text
http://127.0.0.1:8000
```

| Method | Endpoint | Опис |
|---|---|---|
| GET | `/api/v1/bank-accounts` | Отримати список банківських рахунків |
| GET | `/api/v1/bank-accounts/{id}` | Отримати один банківський рахунок за ID |
| POST | `/api/v1/bank-accounts` | Створити новий банківський рахунок |
| PATCH | `/api/v1/bank-accounts/{id}` | Частково оновити банківський рахунок |
| DELETE | `/api/v1/bank-accounts/{id}` | Видалити банківський рахунок |

### Symfony

Base URL:

```text
http://127.0.0.1:8001
```

| Method | Endpoint | Опис |
|---|---|---|
| GET | `/api/v1/bank-accounts` | Отримати список банківських рахунків |
| GET | `/api/v1/bank-accounts/{id}` | Отримати один банківський рахунок за ID |
| POST | `/api/v1/bank-accounts` | Створити новий банківський рахунок |
| PATCH | `/api/v1/bank-accounts/{id}` | Частково оновити банківський рахунок |
| DELETE | `/api/v1/bank-accounts/{id}` | Видалити банківський рахунок |

## Приклад POST-запиту

```json
{
  "owner_name": "Загоровський Денис Олександрович",
  "account_number": "UA1234567890",
  "balance": 1500.50,
  "currency": "UAH",
  "is_active": true
}
```

## Приклад PATCH-запиту

```json
{
  "balance": 2500.75,
  "is_active": false
}
```

## Postman Collection

Для документації та тестування API створено дві Postman collection у форматі JSON:

```text
laravel/postman/laravel-bank-api.postman_collection.json
symfony/postman/symfony-bank-api.postman_collection.json
```

Ці файли можна імпортувати в Postman:

```text
Postman → Import → Files → вибрати JSON-файл
```

Після імпорту з’являються готові колекції із запитами:

- Get all bank accounts
- Get bank account by id
- Create bank account
- Update bank account
- Delete bank account

## Запуск Laravel

Перейти в папку Laravel:

```powershell
cd D:\Work\frameworks\laravel
```

Встановити залежності:

```powershell
composer install
```

Налаштувати файл `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=frameworks_laravel_bank
DB_USERNAME=root
DB_PASSWORD=
```

Запустити міграції:

```powershell
php artisan migrate
```

Запустити сервер:

```powershell
php artisan serve --port=8000
```

Laravel API буде доступне за адресою:

```text
http://127.0.0.1:8000/api/v1/bank-accounts
```

## Запуск Symfony

Перейти в папку Symfony:

```powershell
cd D:\Work\frameworks\symfony
```

Встановити залежності:

```powershell
composer install
```

Налаштувати файл `.env`:

```env
DATABASE_URL="mysql://root:@127.0.0.1:3306/frameworks_symfony_bank?serverVersion=8.0&charset=utf8mb4"
```

Запустити міграції:

```powershell
php bin/console doctrine:migrations:migrate
```

Запустити сервер:

```powershell
php -S 127.0.0.1:8001 -t public
```

Symfony API буде доступне за адресою:

```text
http://127.0.0.1:8001/api/v1/bank-accounts
```

## Бази даних

У роботі використовуються дві бази даних MySQL:

```text
frameworks_laravel_bank
frameworks_symfony_bank
```

## Перевірка роботи

Для перевірки API було використано Postman.

Перевірялися такі операції:

1. `GET` — отримання списку банківських рахунків.
2. `POST` — створення нового рахунку.
3. `GET /{id}` — отримання одного рахунку.
4. `PATCH /{id}` — оновлення рахунку.
5. `DELETE /{id}` — видалення рахунку.

## Результат

У результаті виконання роботи було реалізовано REST API для теми **Bank** на двох PHP-фреймворках: Laravel та Symfony.  
Було створено CRUD-операції для банківських рахунків, налаштовано маршрути, контролери, моделі/сутності, міграції бази даних, а також підготовлено Postman collection JSON-файли з документацією endpoint-ів.

## Виконав

Загоровський Денис Олександрович  
Група: ЗІПЗ-24-1
