<?php
namespace Kirill\VK;

use Guzzle\Http\Client;

class Api{
  protected $client;
  protected $version;
  protected $access_token;
  
  public function __construct(Client $client, $access_token = '', $version = '5.11') {
    $this->client = $client;
    $this->client->setBaseUrl('https://api.vk.com/method/');
    $this->version = $version;
    $this->access_token = $access_token;
  }
  
  public function call($method, $params){
    $params['v'] = $this->version;
    $params['access_token'] = $this->access_token;
    $params['lang'] = 'ru';
    
    $query = http_build_query($params);
    
    $response = $this->client->get("$method?$query")->send();
    $json = $response->json();
    if(isset($json['error'])){
      $error = $json['error'];
      $e = new \Exception($error['error_msg'], $error['error_code']);
      throw $e;
    }
    $r = $json['response'];
    
    return $r;
  }
}

