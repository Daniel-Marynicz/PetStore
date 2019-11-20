@ui
Feature:
  In order to test pet reports
  I want test  it
  Background:
    Given there are following Pet Stores
      | name | surname | pet_name | pet_species | pet_name1 | pet_species1 | pet_name2 | pet_species2 | pet_name3 | pet_species3 | pet_name4 | pet_species4 |
      | aaa  | aaa     | aaa      | cat         | bbb       | cat          | ccc       | cat          | ddd       | cat          | eee       | cat          |
      | bbb  | bbb     | aaa      | cat         | bbb       | cat          | ccc       | cat          | ddd       | cat          |           |              |
      | ccc  | ccc     | aaa      | cat         | bbb       | cat          | ccc       | cat          |           |              |           |              |
  Scenario: I want to see the correct report1
    When I am on "/pet/report/1"
    Then I should see a report containing
      | owner name	| pet name  | pet species |
      | aaa	        | aaa       |	cat       |
      | aaa	        | bbb       |	cat       |
      | aaa	        | ccc       |	cat       |
      | aaa	        | ddd       |	cat       |
      | aaa	        | eee       |	cat       |
      | bbb	        | aaa       |	cat       |
      | bbb	        | bbb       |	cat       |
      | bbb	        | ccc       |	cat       |
      | bbb	        | ddd       |	cat       |
      | ccc	        | aaa       |	cat       |
      | ccc	        | bbb       |	cat       |
      | ccc	        | ccc       |	cat       |
  Scenario: I want to see the correct report1
    When I am on "/pet/report/2"
    Then I should see a report containing
      | owner name	| owned pets  |
      | ccc	        | 3           |
      | bbb	        | 4           |
      | aaa	        | 5           |
