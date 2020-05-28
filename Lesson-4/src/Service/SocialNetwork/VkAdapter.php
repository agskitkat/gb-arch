<?php


namespace Service\SocialNetwork;


use VK\Client\VKApiClient;
use VK\OAuth\Scopes\VKOAuthUserScope;
use VK\OAuth\VKOAuth;
use VK\OAuth\VKOAuthDisplay;
use VK\OAuth\VKOAuthResponseType;

class VkAdapter implements SocialNetwork
{
    /**
     * @var VKApiClient
     */
    private $vk;

    function __construct()
    {
        $this->vk = new VKApiClient();
    }

    public function loginLink()
    {
        $oauth = new VKOAuth();
        $client_id = 1234567;
        $redirect_uri = 'https://example.com/vk';
        $display = VKOAuthDisplay::PAGE;
        $scope = array(VKOAuthUserScope::WALL, VKOAuthUserScope::GROUPS);
        $state = 'secret_state_code';
        $revoke_auth = true;

        $browser_url = $oauth->getAuthorizeUrl(VKOAuthResponseType::TOKEN, $client_id, $redirect_uri, $display, $scope, $state, null, $revoke_auth);

        return '<a href="' . $browser_url . '">Log in with Vk!</a>';
    }

    public function callBackLogin()
    {
        $accessToken = $_GET['access_token'];
        $_SESSION['vk_access_token'] = (string) $accessToken;
    }


}