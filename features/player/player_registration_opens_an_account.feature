Feature: Register a player opens an account
  In order to play games
  As a user
  I want to register myself as a player


  Scenario: Register a player opens an account with 100 coins
    Given I set header "HTTP_ACCEPT" with value "application/json"
    And I set header "CONTENT_TYPE" with value "application/json"
    When I send a POST request to "/players" with body:
    """
      {
        "id":   "7731eaf8-7a38-4e3b-ae97-a853d8c78ee1",
        "name": "Rich Hickey"
      }
    """
    Then should exists accounts:
      | owner                                | amount | currency |
      | 7731eaf8-7a38-4e3b-ae97-a853d8c78ee1 | 100    | coin     |
