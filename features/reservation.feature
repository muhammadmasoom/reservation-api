Feature: Book
    Crud (REST) to /v1/books

    Scenario: Library is empty: GET /v1/reservations
        When I run GET on "v1/reservations"
        Then the status code is 200
        And the body is json
        And the count of "data" is 0

  Scenario: Insert a book: POST /v1/reservations
    When I run "POST" on "v1/reservations" with json
"""
{
    "data": {
        "departure_time": "Symfony is awesome",
        "departure_airport": "ARN",
        "destination_airport": "KHI",
        "seat_number": 12
        "is_active": 1
        "passport": "123132123"
    }
}
"""
    Then the status code is 200
    And the body is json
    And the count of "data" is 1
