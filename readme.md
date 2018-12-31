## How to build.

```
docker-compose build && docker-compose up -d
```
Then,
```
docker-compose exec app php artisan migrate --force
```

## How to use this API.
### Clients:
  - (GET) Get all -> http://your_server_ip/api/clients
  - (GET) Get specific Client -> http://your_server_ip/api/clients/{id}
  - (POST) Create Client -> http://your_server_ip/api/clients/register
  - (PUT) Modify Client -> http://your_server_ip/api/clients/edit/{id}
  - (DELETE) Delete Client -> http://your_server_ip/api/clients/delete/{id}

#### JSON Format to Register/Update Client.
```json
{
  "name": "somename",
  "lastname": "somelastname",
  "email": "email@test.com"
}
```

### Transactions:
  - (GET) Get all -> http://your_server_ip/api/transactions
  - (GET) Get specific Transaction -> http://your_server_ip/api/transactions/{id}
  - (POST) Create Transaction -> http://your_server_ip/api/transactions/register
  - (PUT) Modify Transaction -> http://your_server_ip/api/transactions/edit/{id}
  - (DELETE) Delete Transaction -> http://your_server_ip/api/transactions/delete/{id}
  
#### JSON Format to Register/Update Transaction.
```json
{
  "client_id": "id",
  "order_amount": "amount",
  "order_date": "yyyy-mm-dd"
}
```

## Helpful Guides.
  - https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose
  - https://medium.com/@kamerk22/the-smart-way-to-handle-request-validation-in-laravel-5e8886279271
  - https://paulund.co.uk/disable-validation-redirect-in-laravel

## Authors.
  - Luis Guerrero.
  - Luis Mesa.
