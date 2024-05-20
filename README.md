# Cashir

## About
This project is my attempt at the Cashir Full stack Developer Assessment

## Features
1. User Authentication
    * Registration
    * Login
    * JWT API token
    * Refresh token
    * Logout
2. Payments
    * 2 payment gateways (paystack & flutterwave)
    * Callback url for transaction verification
3. Transactions
    * Get all transactions
    * Get single transaction
4. Statistics
    * transaction stats
        * total amount
        * total count
        * avg amount
        * total fees
    * Charts

## Installation
1. Prerequisites
    * PHP 8.3+
    * Composer
    * Node.js (for frontend)
    * MySQL (or other databases
2. Clone this repository
    ```bash
    git clone https://github.com/michaelthedev/cashir.git
   
   cd cashir
    ```
3. This project is split into backend and frontend

### Backend Installation
You can navigate into the backend folder or copy it somewhere else.
1. IInstall dependencies
    ```bash
    composer install
    ```
2. Set up environment file
    ```bash
    cp .env.example .env
    ```
   Replace the database credentials in the .env file with your own
3. Generate application key
    ```bash
    php artisan key:generate
    ```
4. Run the migrations
    ```bash
    php artisan migrate
    ```
5. Regenerate JWT secret key (for API)
    ```bash
    php artisan jwt:secret
    ```
6. Start the development server
    ```bash
    php artisan serve
    ```
   
### Frontend Installation
1. Install dependencies
    ```bash
    npm install
    ```
2. Set up environment file
    By default, Laravel runs in port 8000. The `.env` file in the `frontend` folder already has the development server url. But if you wish to use another port or url, make sure to update it in the `.env`
3. Finally, use ``npm run dev`` to start vite serve in your `frontend` directory

## API endpoints

### API Documentation
```s
POSTMAN>> https://documenter.getpostman.com/view/10657913/2sA3QngYeo
```

### Routes/Endpoints
<!-- endpoint table -->
| Method | Endpoint                  | Description                                                      |
|--------|---------------------------|------------------------------------------------------------------|
| POST   | `/auth/login`             | Login a user                                                     |
| POST   | `/auth/register`          | Register a user                                                  |
| POST   | `/auth/logout`            | Logout a user (with authorization)                               |
| POST   | `/auth/refresh`           | Refresh a user token (with authorization)                        |
| GET    | `/auth/user`              | Get the authenticated user  (with authorization)                 |
| GET    | `/transactions`           | Get all transactions (with authorization)                        |
| GET    | `/transaction/{trans_id}` | Get a transaction by unique id (`trans_id`) (with authorization) |
| GET    | `/payments/options`       | Set options, gateways available for payment                      |
| POST   | `/payments/initialize`    | Initialize a payment with selected gateway                       |
| GET    | `/stats/transactions`     | Get transaction statistics                                       |

### Demo credentials
Email: admin@test.com
Password: password

## Testing
The backend part of this project uses phpunit for feature tests. Run the following command in the backend folder to run the tests
```bash
php artisan test
```

## Author
Name: [Michael Arawole](https://github.com/michaelthedev).

Email: michael@logad.net
