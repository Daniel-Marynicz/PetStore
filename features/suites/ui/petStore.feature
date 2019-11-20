@ui
Feature:
  In order to test pet store
  I want test  it
  Scenario: I want add a new owner
    When I am on "/pet/store"
    And  I follow "Create new"
    Then I should be on "/pet/store/new"
    And I fill in the following:
      | pet_store_name | Jon |
      | pet_store_surname | Doe |
    And I press "Save"
    Then I should be on "/pet/store/"
    And I should see "Jon"
    And I should see "Doe"

  Scenario: I want to test whether owner name ans surname is unique and app do not allow duplicates
    Given there are following Pet Stores
      | name | surname |
      | Jon  | Doe     |
    And I am on "/pet/store/new"
    And I fill in the following:
      | pet_store_name | Jon |
      | pet_store_surname | Doe |
    And I press "Save"
    Then I should see "Pet store with same name and surname already exists."
  Scenario: I want to add a new pet to my pet store
    Given there are following Pet Stores
      | name | surname |
      | Jon  | Doe     |
    And I am on "/pet/add"
    And I select "Jon Doe" from "pet_add_petStore"
    And I fill in the following:
      | pet_add_pet_name | Kacper |
      | pet_add_pet_species | cat |
    And I press "Add pet"
    Then I should see "PetStore index"
  Scenario: I want to test whether pet name is unique for pet store and app do not allow duplicates
    Given there are following Pet Stores
      | name | surname | pet_name | pet_species |
      | Jon  | Doe     | Kacper   | cat         |
    And I am on "/pet/add"
    And I select "Jon Doe" from "pet_add_petStore"
    And I fill in the following:
      | pet_add_pet_name | Kacper |
      | pet_add_pet_species | cat |
    And I press "Add pet"
    Then I should see "Pet with same name already exists."






