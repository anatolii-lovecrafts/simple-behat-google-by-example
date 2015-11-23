<?php

use Behat\Behat\Context\BehatContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Driver\GoutteDriver;
use Behat\Mink\Session;

/**
 * Features context.
 */
class FeatureContext extends BehatContext {

	private $driver;

	private $session;

	public function __construct() {
		$this->driver = new GoutteDriver();
		$this->session = new Session($this->driver);
		$this->session->start();
	}

	/**
	 * @Given /^I am going to "([^"]*)"$/
	 */
	public function iAmGoingTo($url) {
		$this->session->visit($url);
	}

	/**
	 * @Given /^I type text "([^"]*)"$/
	 */
	public function iTypeText($arg1) {
		$page = $this->session->getPage();
		$field = $page->find('css', 'input[title="Пошук Google"]');
		$field->setValue($arg1);
	}

	/**
	 * @When /^I click "([^"]*)"$/
	 */
	public function iClick($arg1) {
		$page = $this->session->getPage();
		$button = $page->find('css', 'input[value="' . $arg1 . '"]');
		$button->click();
	}

	/**
	 * @Then /^I should see:$/
	 */
	public function iShouldSee(PyStringNode $string) {

		$page = $this->session->getPage();
		$html = $page->getText();
		$lines = $string->getLines();
		foreach ($lines as $line) {
			if (strpos($html, $line) === false) {
				throw new Exception($line . ' not found on page');
			}
		}
	}

}
