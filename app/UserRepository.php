<?php 
namespace App;
use Doctrine\ORM\EntityRepository;
use App\Contract\UserRepositoryInterface;

class UserRepository extends EntityRepository implements UserRepositoryInterface {
	/**
	 * @param  array
	 */
	public function updateOrCreate(array $user_data=[]) {
		if (empty($user = $this->findOneBy(array('fb_id' => $user_data['id'])))) {
			$user = new User;
			$user->setFirstName($user_data['first_name']);
			$user->setLastName($user_data['last_name']);
			$user->setEmail($user_data['email']);
			$user->setImage($user_data['picture']['url']);
			$user->setFbId($user_data['id']);
			$user->setAccessToken($user_data['access_token']);
			$user->setStatus($user_data['status']);
			$user->setCreated(new \DateTime("now"));
			$this->getEntityManager()->persist($user);
			$this->getEntityManager()->flush();
		} else {
			$this->update($user, $user_data);
		}
    }

    /**
     * @param  User
     * @param  array
     */
    public function update(User $user, array $user_data=[]) {
    	$user->setFirstName($user_data['first_name']);
    	$user->setLastName($user_data['last_name']);
    	$user->setEmail($user_data['email']);
    	$user->setImage($user_data['picture']['url']);
    	$user->setFbId($user_data['id']);
    	$user->setAccessToken($user_data['access_token']);
    	$user->setStatus($user_data['status']);
    	$this->getEntityManager()->flush();
    }

    /**
     * @param  string
     */
    public function deauthUser($fb_id) {
    	$user = $this->findOneBy(array('fb_id' => $fb_id));
    	$user->deauth();
    	$this->getEntityManager()->flush();
    }
}
