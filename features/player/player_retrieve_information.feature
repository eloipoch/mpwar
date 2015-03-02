Feature: Recover player information
  In order know my information
  As a player
  I want to recover my data

  Background:
    Given there are registered players:
      | id                                   | name        |
      | 96ae81a6-a594-45d1-b958-b3c6c9e0b3a4 | Rich Hickey |


  Scenario: Retrieve information of a player
    Given I set header "HTTP_ACCEPT" with value "application/json"
    And I set header "CONTENT_TYPE" with value "application/json"
    When I send a GET request to "/players/96ae81a6-a594-45d1-b958-b3c6c9e0b3a4"
    Then the response code should be 200
    And the response should be:
    """
      {
        "_links": {
            "self": {
                "href": "http://localhost/players/96ae81a6-a594-45d1-b958-b3c6c9e0b3a4"
            }
        },
        "id":                "96ae81a6-a594-45d1-b958-b3c6c9e0b3a4",
        "name":              "Rich Hickey",
        "registration_date": "#date now#"
      }
    """
