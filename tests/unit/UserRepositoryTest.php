<?php
class UserRepositoryTest extends \PHPUnit_Framework_TestCase {
	protected $entityManager;

	public function __construct() {
		require __DIR__.'/../../bootstrap.php';
		$this->entityManager = $entityManager;
    }

	public function testThatWeCanStoreUserData(){
		$user_data = [
						'first_name' => 'jon',
						'last_name' => 'snow',
						'email' => 'jonsnow@gmail.com',
						'picture' => [ 'url' => 'https://scontent.xx.fbcdn.net/v/t1.0-1/c152.4.631.631/s50x50/1451599_1020239' ],
						'id' => '102105340084050006',
						'access_token' => 'EAADE0SCug4UBAEaH4GwgM48fsQRJyeL70tCPYzQzSZB2gmtMtOsbSTIjQCr4u5Dg5BacZBHQpvEWnlpqs',
						'status' => true
						];
		
		// store user data 
		$this->entityManager->getRepository('App\User')->updateOrCreate($user_data);
		
		// retrieve user data
		$user = $this->entityManager->getRepository('App\User')->findOneBy(array('fb_id' => $user_data['id']));
		
		$this->assertEquals($user->getFirstName(), 'jon');
	}
}