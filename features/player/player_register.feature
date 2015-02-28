Feature: Register a player
  In order to play games
  As a user
  I want to register myself as a player


  Scenario: Register a player
    Given I set header "HTTP_ACCEPT" with value "application/json"
    Given I set header "CONTENT_TYPE" with value "application/json"
    When I send a POST request to "/players" with body:
    """
      {
        "id":   "7731eaf8-7a38-4e3b-ae97-a853d8c78ee1",
        "name": "Rich Hickey"
      }
    """
    Then the response code should be 201
    Then the response should be empty
