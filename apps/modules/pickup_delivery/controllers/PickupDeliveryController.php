<?php

namespace ServiceLaundry\PickupDelivery\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use Phalcon\Mvc\Controller;


class PickupDeliveryController extends SecureController
{
    public function showPickupDeliveryAction()
    {
        $datas = PickupDelivery::find();

        $this->view->pickup_delivery = $datas; 
    }

    public function createPickupDeliveryAction()
    {

    }

    public function storePickupDeliveryAction()
    {

    }

    public function editPickupDeliveryAction()
    {

    }

    public function deletePickupDeliveryAction()
    {
        
    }
}