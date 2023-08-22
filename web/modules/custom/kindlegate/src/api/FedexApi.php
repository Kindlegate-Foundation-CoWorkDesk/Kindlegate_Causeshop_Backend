<?php

namespace  Drupal\kindlegate\api;

use Drupal\kindlegate\api\traits\FedexTrait;

class FedexApi extends ClassBaseApi
{

    use FedexTrait;
    public function createOrder()
    {
        return $this->setEndpoint('/ship/v1/shipments')
                    ->setData([])
                    ->post();
    }    
}
