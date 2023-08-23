<?php

namespace  Drupal\kindlegate\api;

use Drupal\kindlegate\api\traits\FedexTrait;

class FedexApi extends ClassBaseApi
{

    use FedexTrait;

    public function __construct()
    {
        $this->baseUrl = "https://apis-sandbox.fedex.com";
    }
    public function createOrder()
    {
        return $this->setEndpoint('/ship/v1/shipments')
                    ->setData([])
                    ->post();
    }
    
    // https://apis-sandbox.fedex.com/rate/v1/freight/rates/quotes
    public function getRate()
    {
        return $this->setEndpoint('rate/v1/freight/rates/quotes')
                    ->setData($this->serializeRateData([]))
                    ->post();        
    }
}
