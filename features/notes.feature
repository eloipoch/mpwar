Feature: Handle notes
  In order to handle notes
  As a user
  I want to list and create notes


  Scenario: List notes
    Given I set header "HTTP_ACCEPT" with value "application/json"
    When I send a GET request to "/notes"
    Then the response code should be 200
    And the response should be:
    """
      {
        "notes": [],
        "limit": 5,
        "_links": {
          "self": {
            "href": "http://localhost/notes"
          },
          "note": {
            "href": "http://localhost/notes/{id}",
            "templated": true
          }
        }
      }
    """

  Scenario: Create note
    Given I set header "HTTP_ACCEPT" with value "application/json"
    Given I set header "CONTENT_TYPE" with value "application/json"
    When I send a POST request to "/notes" with body:
    """
      {
        "note" : {
          "message": "hello"
        }
      }
    """
    Then the response code should be 201
    Then the response should be empty
