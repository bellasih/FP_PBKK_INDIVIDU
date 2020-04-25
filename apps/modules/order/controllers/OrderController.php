<?php

namespace ServiceLaundry\Order\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use ServiceLaundry\Order\Forms\Web\OrderForm;
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
        $this->setFlashSessionDesign();
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

    public function updateOrderAction()
    {
        if(!$this->request->isPost())
        {
            $this->response->redirect('order');
        }

        $form = new OrderForm();
        if(!$form->isValid($this->request->getPost()))
        {
            foreach ($form->getMessages() as $msg)
            {
                $this->flashSession->error($msg->getMessage());
            }
        }

        $order_id   = $this->request->getPost('order_id');
        $order      = Orders::findFirst("order_id='$order_id'");
        if($order != null)
        {
            $service_id         = $order->getServiceId();
            $user_id            = $order->getUserId();
            $order_total        = $order->getOrderTotal();
            $order_status       = $this->request->getPost('order_status');
            $order_date         = $order->getOrderDate();
            $finish_date        = $this->request->getPost('finish_date');

            $order->construct($service_id,$user_id,$order_total,$order_date,$finish_date,$order_status);
            if($order->update())
            {
                $this->flashSession->success('Data Pesanan berhasil diubah');
            }
            else
            {
                $this->flashSession->error('Data Pesanan tidak berhasil diubah. Mohon coba ulang kembali');
            }
        }
        else
        {
            $this->flashSession->error('Data yang dipilih tidak ada. Mohon coba ulang kemabali');
        }
        return $this->response->redirect('order');
    }
}