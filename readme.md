## About.
A small API which allows the consumers to store, get, edit and delete Clients and Transactions.

## How to build.

Build the application and create the containers,
```
docker-compose build && docker-compose up -d
```
Install dependencies for Laravel,
```
docker-compose exec app composer install 
```
Then make migrations, 
```
docker-compose exec app php artisan migrate --force
```

## How to consume this API.
### Clients:
  - ```(GET)``` Get all -> http://your_server_ip/api/clients
  - ```(GET)``` Get specific Client -> http://your_server_ip/api/clients/{id}
  - ```(POST)``` Create Client -> http://your_server_ip/api/clients/register
  - ```(PUT)``` Modify Client -> http://your_server_ip/api/clients/edit/{id}
  - ```(DELETE)``` Delete Client -> http://your_server_ip/api/clients/delete/{id}

#### JSON Format to Register/Update Client.
```json
{
  "name": "somename",
  "lastname": "somelastname",
  "email": "email@test.com"
}
```

### Transactions:
  - ```(GET)``` Get all -> http://your_server_ip/api/transactions
  - ```(GET)``` Get specific Transaction -> http://your_server_ip/api/transactions/{id}
  - ```(POST)``` Create Transaction -> http://your_server_ip/api/transactions/register
  - ```(PUT)``` Modify Transaction -> http://your_server_ip/api/transactions/edit/{id}
  - ```(DELETE)``` Delete Transaction -> http://your_server_ip/api/transactions/delete/{id}
  
#### JSON Format to Register/Update Transaction.
```json
{
  "client_id": "id",
  "order_amount": "amount",
  "order_date": "yyyy-mm-dd"
}
```

## Helpful Guides.
  - [How To Setup Laravel Nginx and MySQL with Docker Compose - Digital Ocean.](https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose)
  - [The Smart Way to Handle Request Validation in Laravel - Medium.](https://medium.com/@kamerk22/the-smart-way-to-handle-request-validation-in-laravel-5e8886279271)
  - [Disable Validation Redirect in Laravel.](https://paulund.co.uk/disable-validation-redirect-in-laravel)
  - [Tests Laravel Applications - Blog Pusher](https://blog.pusher.com/tests-laravel-applications/)  
  - [Testing - Laravel's Official Documentation](https://laravel.com/docs/5.7/testing)
  - [HTTP Tests- Laravel's Official Documentation](https://laravel.com/docs/5.7/http-tests)  
  - [Database Testing - Laravel's Official Documentation](https://laravel.com/docs/5.7/database-testing)  

## Authors.
  - Luis Guerrero.
  - Luis Mesa.
  - Moisés Escudero. 
