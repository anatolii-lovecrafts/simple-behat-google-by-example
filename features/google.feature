Feature: google
	In order to search for something in Google
	I need to be able to go to http://google.by, enter my search term and see right results

Scenario: Search for cats in google
	Given I am going to "http://google.by/"
	And I type text "cats"
	When I click "Пошук Google"
	Then I should see:
		"""
		Cat - Wikipedia, the free encyclopedia
		Cats the Musical - Official Website & Tickets
		"""
