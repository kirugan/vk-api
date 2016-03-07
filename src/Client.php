<?php
namespace Kirugan\VKApi;

use GuzzleHttp\Client as GuzzleClient;

class Client{
  const BASE_URL = 'https://api.vk.com/method/';

  private $client;
  private $version = '5.45';
  private $lang = 'ru';
  private $accessToken = '';
  
  public function __construct(GuzzleClient $client) {
    $this->client = $client;
  }

  public function setAccessToken($token)
  {
    $this->accessToken = $token;
  }

  public function call($method, array $params = []){
    $query = http_build_query($this->buildParams($params));
    $uri = self::BASE_URL . $method . '?' . $query;

    $json = (string) $this->client->request('GET', $uri)->getBody();
    $data = json_decode($json, true);

    if (isset($data['error'])) {
      $error = $data['error'];
      $exception = new BaseException($error['error_msg'], $error['error_code']);
      $exception->setRequestParams($error['request_params']);
      throw $exception;
    }
    
    return $data['response'];
  }

  private function buildParams(array $params)
  {
    return $params + ['v' => $this->version, 'lang' => $this->lang, 'access_token' => $this->accessToken];
  }
}

