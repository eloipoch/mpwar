Feature: Register a player
  In order to play games
  As a user
  I want to register myself as a player


  Scenario: Register a player with an already used identifier
    Given there are registered players:
      | id                                   | name           |
      | 013f42d2-247a-44e0-be9f-03b9bcf6c6de | Rasmus Lerdorf |
    And I set header "HTTP_ACCEPT" with value "application/json"
    And I set header "CONTENT_TYPE" with value "application/json"
    When I send a POST request to "/players" with body:
    """
      {
        "id":   "013f42d2-247a-44e0-be9f-03b9bcf6c6de",
        "name": "Rich Hickey"
      }
    """
    Then the response code should be 409
    And the response should be:
    """
      {
        "code":    "player_already_exists",
        "message": "Player <013f42d2-247a-44e0-be9f-03b9bcf6c6de> already exists"
      }
    """


  Scenario: Register a player with an invalid identifier
    Given I set header "HTTP_ACCEPT" with value "application/json"
    And I set header "CONTENT_TYPE" with value "application/json"
    When I send a POST request to "/players" with body:
    """
      {
        "id":   "1",
        "name": "Rich Hickey"
      }
    """
    Then the response code should be 400
    And the response should be:
    """
      {
        "code":    "player_identifier_not_valid",
        "message": "Invalid Player Identifier value <1>"
      }
    """


  Scenario: Register a player with an invalid name
    Given I set header "HTTP_ACCEPT" with value "application/json"
    And I set header "CONTENT_TYPE" with value "application/json"
    When I send a POST request to "/players" with body:
    """
      {
        "id":   "f6ac6086-f9be-4050-8acd-4c0ce70bc3c4",
        "name": ""
      }
    """
    Then the response code should be 400
    And the response should be:
    """
      {
        "code":    "player_name_not_valid",
        "message": "Invalid Player name value <>"
      }
    """


  Scenario: Register a player without a name
    Given I set header "HTTP_ACCEPT" with value "application/json"
    And I set header "CONTENT_TYPE" with value "application/json"
    When I send a POST request to "/players" with body:
    """
      {
        "id": "9c0a3a51-10de-446c-b3f5-1cfa32548fc5"
      }
    """
    Then the response code should be 400
    And the response should be:
    """
      {
        "code":    "player_name_not_valid",
        "message": "Invalid Player name value <>"
      }
    """
