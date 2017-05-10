<?php 
namespace App\Library;
use App\Config\Facebook;

class FacebookAuth {
    private $fb;

    public function __construct() {
        $this->fb = Facebook::getInstance();
    }

    /**
     * @return AccessToken object
     */
    public function getAccessToken() {
        if (!isset($_SESSION['facebook_access_token'])) {
            // Try to get access token
            try {
                $helper = $this->getRedirectLoginHelper();
                $accessToken = $helper->getAccessToken();
                if (!empty($accessToken)){
                    if (! $accessToken->isLongLived()) {
                        // Exchanges a short-lived access token for a long-lived one
                        $accessToken = $this->getLongLivedAccessToken($accessToken);
                    }
                    $_SESSION['facebook_access_token'] = (string) $accessToken;
                    $this->fb->setDefaultAccessToken((string) $_SESSION['facebook_access_token']);
                    return $_SESSION['facebook_access_token'];
                }
            } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                error_log('Graph returned an error: '. $e->getMessage());
    		    echo 'Graph returned an error: ' . $e->getMessage();
    		    exit;
    		} catch(\Facebook\Exceptions\FacebookSDKException $e) {
                error_log('Facebook SDK returned an error: '. $e->getMessage());
    		    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    		    exit;
    		}
        } else {
            return $_SESSION['facebook_access_token'];
        }
        return null;
    }

    /**
     * @param  AccessToken $accessToken
     * @return AccessToken object
     */
    public function getLongLivedAccessToken($accessToken) {
        try {
            // OAuth 2.0 client handler helps to manage access tokens
            $oAuth2Client = $this->fb->getOAuth2Client();
            return $oAuth2Client->getLongLivedAccessToken($accessToken);
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            error_log('Facebook SDK returned an error: '. $e->getMessage());
            $this->logout('Something is wrong. Please try to login again.');
            exit;
        }
    }

    /**
     * @return array
     */
    public function getUserProfile() {
        try {
            $profileRequest = $this->fb->get('/me?fields=name,first_name,last_name,email,picture', $this->getAccessToken());
            $user_data = $profileRequest->getGraphNode()->asArray();
            $user_data['status'] = true;
            $user_data['access_token'] = $this->getAccessToken();
            return $user_data;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            error_log('Facebook SDK returned an error: '. $e->getMessage());
            $this->logout('Something is wrong. Please try to login again.');
            exit;
        }
    }

    /**
     * @return FacebookRedirectLoginHelper
     */
    public function getRedirectLoginHelper() {
        return $this->fb->getRedirectLoginHelper();
    }

    /**
     * @return string
     */
    public function getCustomLoginUrl() {
        return Facebook::getCustomLoginUrl();
    }

    /**
     * @param  string
     */
    public function logout($message="") {
        unset($_SESSION['facebook_access_token']);
        header("Location:index.php?message=$message");
    }

    /**
     * @param  string $input
     * @return string
     */
    public function base64_url_decode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * @param  string $signed_request
     * @return array|null
     */
    public function parseSignedRequest($signed_request) {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        // decode the data
        $sig = $this->base64_url_decode($encoded_sig);
        $data = json_decode($this->base64_url_decode($payload), true);

        // confirm the signature
        $expected_sig = hash_hmac('sha256', $payload, Facebook::getAppSecret(), $raw = true);
        if ($sig !== $expected_sig) {
          error_log('Bad Signed JSON signature!');
          return null;
        }
        return $data;
    }
}
