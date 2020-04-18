<?php

namespace ServiceLaundry\Order\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use Phalcon\Mvc\Controller;

class OrderController extends SecureController
{
    public function showOrderAction()
    {
        $datas = Orders::find();

        $this->view->orders = $datas;

    }

    public function editOrderAction()
    {

    }

    public function detailItemAction()
    {
        
    }
}