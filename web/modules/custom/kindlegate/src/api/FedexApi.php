<?php



class FedexApi extends ClassBaseApi
{
    public function createOrder()
    {
        return $this->setEndpoint('/ship/v1/shipments')
                    ->setData([])
                    ->post();
    }    
}
