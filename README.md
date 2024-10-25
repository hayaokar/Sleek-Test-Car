
# Car Service

This service is responsible for managing CRUD operations related to cars. It is protected by the Authentication Service, meaning that only authenticated users with valid tokens can access the car-related endpoints.

## Features
- Create, Read, Update, and Delete (CRUD) operations for cars
- Real-time notifications on car creation, update, or deletion using **Pusher**
- Protected endpoints requiring token validation from the Authentication Service

## Prerequisites
Before running the Car Service, ensure that you have the following installed:
- PHP 8.x
- Composer
- MySQL or any other supported database
- Pusher account (for real-time notifications)

## Installation

1. Clone the repository:
    ```bash
    git clone <repository-url>
    cd car-service
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Set up environment variables by copying the `.env.example` file:
    ```bash
    cp .env.example .env
    ```

4. Update the `.env` file with your database, Pusher, and other configurations (set AUTHENTICATION_URL to the running url for the Authentication Service):
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

    PUSHER_APP_ID=your_pusher_app_id
    PUSHER_APP_KEY=your_pusher_app_key
    PUSHER_APP_SECRET=your_pusher_app_secret
    PUSHER_APP_CLUSTER=your_pusher_cluster
    ```

5. Generate an application key:
    ```bash
    php artisan key:generate
    ```

6. Run database migrations:
    ```bash
    php artisan migrate
    ```

## Running the Project

To serve the application, run:
```bash
php artisan serve
```


## Real-Time Updates

This service uses **Pusher** for real-time updates. When a car is created or updated, a notification is broadcasted via WebSocket to all subscribed clients.

To test the real-time updates, you can subscribe to the `cars` channel and listen for the `CarUpdated` event.

## Testing

To test the API, you can use Postman or any other API testing tool. Make sure you have a valid token from the Authentication Service.


