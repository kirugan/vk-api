<?php
namespace Kirill\VK;

class Helper {
    const API_LAST_VERSION = '5.34';
    
    public static function getAuthorizeURL($client_id, $scope, $redirect_uri, $version = self::API_LAST_VERSION, $state = ''){
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
}