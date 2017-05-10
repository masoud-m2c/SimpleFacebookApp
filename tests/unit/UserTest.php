<?php
class UserTest extends \PHPUnit_Framework_TestCase{
	public function testThatWeCanGetFirstName(){
		$user = new App\User;
		$user->setFirstName('masoud');
		$this->assertEquals($user->getFirstName(), 'masoud');
	}
}
