<?php

namespace ServiceLaundry\Order\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class OrderController extends SecureController
{
    public function showOrderAction()
    {
        $datas = Orders::find();
        $currentPage = (int) $_GET['page'];
        $paginator = new PaginatorModel(
            [
                'data'  => $datas,
                'limit' => 10,
                'page'  => $currentPage,
            ]
        );
        $page = $paginator->getPaginate();
        $this->view->page = $page; 
    }

    public function editOrderAction()
    {

    }

    public function detailItemAction()
    {
        
    }
}