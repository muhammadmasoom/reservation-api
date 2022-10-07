# Reservation System API

## Install
```bash
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

## How to use

Example - GET reservation: GET /v1/reservation/{id}

Response:
```json
{
  "id":3,
  "passport":"2347658",
  "departureTime":"2022-12-30T16:00:00+00:00",
  "seatNumber":12,
  "departureAirport":"ARN",
  "destinationAirport":"FGH",
  "isActive":true
 }
``` 


Example - Create reservation: POST v1/reservation
```json
{
    "data": {
        "departure_time": "2022-12-30 16:00:00",
        "departure_airport": "ARN",
        "destination_airport": "DOH",
        "passport": "23423423"
    }
}
``` 


Example - Change seat : PUT v1/reservation/changeseat/{id}

JSON (any other field will be ignored):
```json
{
    "data": {
        "seat_number": 21
    }
}

``` 

Example - Cancel researvation: PUT v1/reservation/cancel/{id}



# END
