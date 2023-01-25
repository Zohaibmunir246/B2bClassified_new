<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Google OAuth Library for CodeIgniter 3.x
 *
 * Library for Google+ login. It helps the user to login with their Google account
 * in CodeIgniter application.
 *
 * This library requires the Google API PHP client and it should be placed in third_party folder.
 *
 * It also requires google configuration file and it should be placed in the config directory.
 *
 */
class Google{
    
    public function __construct(){
        
        $CI =& get_instance();
        $CI->config->load('google');
        
        require_once APPPATH.'third_party/src/Google_Client.php';
        require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
        
        $this->client = new Google_Client();
        $this->client->setApplicationName($CI->config->item('application_name', 'demo'));
        $this->client->setClientId($CI->config->item('client_id', '1066237958031-otlpnc06t6run41oas6vm25n50fvdops.apps.googleusercontent.com'));
        $this->client->setClientSecret($CI->config->item('client_secret', 'Fq2MZm4dopcjkq5cm4iIa6fB'));
        $this->client->setRedirectUri($CI->config->item('redirect_uri', 'google'));
        $this->client->setDeveloperKey($CI->config->item('api_key', 'google'));
        $this->client->setScopes($CI->config->item('scopes', 'google'));
        $this->client->setAccessType('online');
        $this->client->setApprovalPrompt('auto');
        $this->oauth2 = new Google_Oauth2Service($this->client);
    }
    
    public function loginURL() {
        return $this->client->createAuthUrl();
    }
    
    public function getAuthenticate() {
        return $this->client->authenticate();
    }
    
    public function getAccessToken() {
        return $this->client->getAccessToken();
    }
    
    public function setAccessToken() {
        return $this->client->setAccessToken();
    }
    
    public function revokeToken() {
        return $this->client->revokeToken();
    }
    
    public function getUserInfo() {
        return $this->oauth2->userinfo->get();
    }
    
}