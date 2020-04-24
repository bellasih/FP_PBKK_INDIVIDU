<?php

namespace ServiceLaundry\Order\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use ServiceLaundry\Order\Models\Web\Orders;
use ServiceLaundry\Order\Models\Web\Item;
use ServiceLaundry\Order\Models\Web\OrderItem;
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Di;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model\Manager;

class OrderController extends SecureController
{
    public function initialize()
    {
        $this->beforeExecutionRouter();
    }
    
    public function indexAction()
    {
        /*
        * Manual pagination
        */ 
        $array_data     = array();
        (!isset($_GET['page'])) ? $currentPage = 1 : $currentPage = (int) $this->request->getQuery('page');
        $number_page    = 3;
        $offset         = ($currentPage-1) * $number_page;
        $total_row      = count(Orders::find());
        $total_page     = ceil($total_row/$number_page);

        $sql            = Orders::find([
                            'limit'     => $number_page,
                            'offset'    => $offset,
                        ]);
        
        /*
        * Get all items for every orders
        */
        $detail_item    = array();
        $i = 0;
        foreach( $sql as $idx)
        {
            $query = $this
                    ->modelsManager
                    ->createQuery('SELECT item_type, item_details FROM ServiceLaundry\Order\Models\Web\Item AS Item , ServiceLaundry\Order\Models\Web\OrderItem AS OrderItem
                                    WHERE Item.item_id = OrderItem.item_id 
                                    AND OrderItem.order_id =' .$idx->getId());
            $temp             = $query->execute();
            $detail_item[$i]  = $temp->toArray();   
            $i++;
        }

        $this->view->page           = $sql;
        $this->view->page_number    = $currentPage;
        $this->view->page_last      = $total_page;
        $this->view->offset         = $offset;
        $this->view->detail_item    = $detail_item;
        $this->view->pick('views/order/index');
    }
}