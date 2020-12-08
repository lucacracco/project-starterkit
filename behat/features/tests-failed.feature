@api @no-success
Feature: Test account menu links

  Scenario: Make sure that logged in users see the account menu
    Given I am logged in as a user with the "authenticated" role
    And I am on "/"
    Then I should see the link "Log in"

  Scenario: Make sure that anonymous users see the account menu
    Given I am not logged in
    And I am on "/"
    Then I should see the link "My account"
    And I should see the link "Log out"