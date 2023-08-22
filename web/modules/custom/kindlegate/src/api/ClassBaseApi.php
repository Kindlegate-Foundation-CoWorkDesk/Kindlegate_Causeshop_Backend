<?php

use Drupal\http_client\HttpClient;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\DependencySerializationTrait;
class ClassBaseApi
{
    use DependencySerializationTrait;

    protected $httpClient;
    public $baseUrl;
    public $endpoint;
    public $data;


    public function __construct(HttpClient $http_client)
    {
        $this->httpClient = $http_client;
    }
    
    public static function create(ContainerInterface $container) {
        return new static(
          $container->get('http_client')
        );
    }

    public function setMethod()
    {
        
    }

    public function setData($data)
    {
        $this->data  = $data;
        return $this;
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function post()
    {
        $response = $this->httpClient->post($this->baseUrl.$this->endpoint, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => $this->data,
          ]);
      
          $responseData = $response->getBody();
        
    }

    public function get()
    {

        $response = $this->httpClient->get('https://api.example.com/data');
        $data = $response->getBody();
        
    }

}
