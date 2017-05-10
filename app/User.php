<?php 
namespace App;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="UserRepository") @Table(name="users")
 */
class User {
    /**
     * @Id @Column(type="integer") @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $first_name;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $last_name;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $email;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $image;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $fb_id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $access_token;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $status;

    /**
     * @Column(type="datetime")
     * @var DateTime
     */
    protected $created;

    public function getId() {
        return $this->id;
    }
    
    public function getFirstName() {
        return $this->first_name;
    }

    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getFbId() {
        return $this->fb_id;
    }

    public function setFbId($fb_id) {
        $this->fb_id = $fb_id;
    }

    public function getAccessToken() {
        return $this->access_token;
    }

    public function setAccessToken($access_token) {
        $this->access_token = $access_token;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function deauth() {
        $this->status = False;
    }

    public function getCreated() {
        return $this->created;
    }

    public function setCreated(\DateTime $created) {
        $this->created = $created;
    }
}
