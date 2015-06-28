<?php
namespace Kirill\VK;

class Helper {
    public static function getAuthorizeURL($client_id, $scope, $redirect_uri, $version = Core::API_LAST_VERSION, $state = ''){
        $base = 'https://oauth.vk.com/authorize';
        $query = http_build_query([
            'client_id' => $client_id,
            'scope' => $scope,
            'redirect_uri' => $redirect_uri,
            'response_type' => 'code',
            'v' => $version,
            'state' => $state
        ]);
        
        return "{$base}?{$query}";
    }
    
    public static function getAccessTokenURL($client_id, $client_secret, $code, $redirect_uri){
        $base = 'https://oauth.vk.com/access_token';
        $query = http_build_query([
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'code' => $code,
            'redirect_uri' => $redirect_uri
        ]);
        
        return "{$base}?{$query}";
    }
}