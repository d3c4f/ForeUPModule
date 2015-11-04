<?php

use ForeUP\Marketing\Template;

// TODO: Add more tests... Can never have too many tests.
// TODO: Maybe implement Faker into tests.
// TODO: Less assertions per test, maybe
class TemplatesUnitTests extends PHPUnit_Framework_TestCase {

	public function testInitialValues(){
		$testTemplate = new Template;

		$this->assertEmpty($testTemplate->parameters);
		$this->assertNull($testTemplate->template);
	}

	//TODO: Make this more dynamic
	public function testReturnsCorrectHTMLWithSaneParametersAndTemplate(){
		$testTemplate = new Template;

		$testTemplate->parameters = [
			"customer" => "Brendon Beebe",
			"customer_phone" => "801-555-5555",
			"course_name" => "Valid Test Course",
			"course_number" => "10",
		];
		$testTemplate->template = "<html><head><title></title></head><body>Customer <<customer>> <br/> Customer Phone <<customer_phone>> <br/> Course Name <<course_name>> <br/> Course Number <<course_number>></body></html>";

		$testTemplateMerged = "<html><head><title></title></head><body>Customer Brendon Beebe <br/> Customer Phone 801-555-5555 <br/> Course Name Valid Test Course <br/> Course Number 10</body></html>";

		$this->assertEquals($testTemplateMerged, $testTemplate->RenderHTML());
	}

	//TODO: Make this more dynamic
	public function testReturnsCorrectHTMLWithCrazyParametersAndTemplate(){
		$testTemplate = new Template;

		$testTemplate->parameters = [
			"customer" => "\''#<>&",
			"customer_phone" => "801-555-5555",
			"course_name" => "Valid Test Course",
			"course_number" => "10",
		];
		$testTemplate->template = "<html><head><title></title></head><body>Customer <<customer>> <br/> Customer Phone <<customer_phone>> <br/> Course Name <<course_name>> <br/> Course Number <<course_number>></body></html>";

		$testTemplateMerged = "<html><head><title></title></head><body>Customer \&#039;&#039;#&lt;&gt;&amp; <br/> Customer Phone 801-555-5555 <br/> Course Name Valid Test Course <br/> Course Number 10</body></html>";

		$this->assertEquals($testTemplateMerged, $testTemplate->RenderHTML(), "RENDERED HTML:".$testTemplate->RenderHTML());
	}


}
