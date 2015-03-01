Feature: Recover player information
  In order know my information
  As a player
  I want to recover my data


  Scenario: Retrieve information of a player with an invalid identifier
    Given I set header "HTTP_ACCEPT" with value "application/json"
    And I set header "CONTENT_TYPE" with value "application/json"
    When I send a GET request to "/players/1"
    Then the response code should be 400
    And the response should be:
    """
      {
        "code":    "player_identifier_not_valid",
        "message": "Invalid Player Identifier value <1>"
      }
    """


  Scenario: Retrieve information of a player that does not exists
    Given I set header "HTTP_ACCEPT" with value "application/json"
    And I set header "CONTENT_TYPE" with value "application/json"
    When I send a GET request to "/players/e943e79b-669d-46bd-9da3-6177f0bee644"
    Then the response code should be 404
    And the response should be empty
