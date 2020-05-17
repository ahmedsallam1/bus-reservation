<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Bus Reservation

The project acts as a fleet management system. 
User can view/book available seats for specific trips.

## System Design

Functional Requirements:

 - User authentication
 - Stations as cities (Cairo, Giza .. etc.)
 - Trips between 2 stations (Cairo-Aswan).
 - Bus for trips.
 - Bus has 12 available seats to be booked by users.
 - User can book a seat if there is an available seat.
 - User can get a list of available seats to be booked for his trip by sending start and end stations.

Non-Functional Requirements:
- Avoid race condition.

High-Level Design
![alt_text](repository_image/bus-reservation.png?raw=true "High-Level Design")

ER Diagram
![alt_text](repository_image/db-diagarm.png?raw=true "ER Diagram")

##Configuration
```
cd /project
edit .env
add mysql credentials
```

##Install
```
$ composer install
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
$ php artisan passport:install

$ php artisan serve
```

##Test
```
$ php artisan test
```

##Usage
####Authorization:
```http
POST /api/register

POST /api/login
```
| Parameter | Type | Description |
| :--- | :--- | :--- |
| `email` | `string` | **Required**. user email |
| `password` | `string` | **Required**. user password |

```
{
  "token" : string
}
```

####Available Seats:
```http
GET /api/trip/seats
```
| Parameter | Type | Description |
| :--- | :--- | :--- |
| `origin` | `integer` | **Required**. station ID |
| `destination` | `integer` | **Required**. station ID |
| `available` | `boolean` | station ID |
```
example: /api/trip/seats?origin=1&destination=8&available=1
```
```
{
    "data : [
        "trip_id": integer,
        "seats": array
    ]
}
```

####Book Seat:
```
POST /api/reservation
```
| Parameter | Type | Description |
| :--- | :--- | :--- |
| `trip_id` | `integer` | **Required**. Trip ID |
| `seat_id` | `integer` | **Required**. Seat ID |

- Route is guarded by Passport and requires `Authorization: Bearer TOKEN`
```
{
    "data": array
}
```