<?php

namespace ServiceLaundry\Order\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use ServiceLaundry\Order\Models\Web\Service;
use ServiceLaundry\Order\Models\Web\Item;
use ServiceLaundry\Order\Models\Web\OrderItem;
use ServiceLaundry\Order\Models\Web\Orders;
use Phalcon\Http\Response;

class UserOrderController extends SecureController
{
    public function initialize()
    {
        $this->memberExecutionRouter();
        $this->setFlashSessionDesign();
    }

    public function createOrderAction()
    {
        $service             = Service::find();
        $this->view->service = $service;
        $this->view->pick('views/order/users');
    }

    public function storeOrderAction()
    {
        $service_id           = $this->request->getPost('pilihan')[0];
        $user_id              = $this->session->get('auth')['id'];
        $order_total          = $this->request->getPost('order_total');
        $order_date           = date('Y-m-d');
        $finish_date          = date('Y-m-d', strtotime(' +4 days'));
        $order_status         = 'Unfinished';
        $items_notes_array    = explode(",", $this->request->getPost('items_notes'));
        $items_type_array     = explode(",", $this->request->getPost('items_types'));

        $order      = new Orders();
        $order->construct($service_id,$user_id,$order_total,$order_date,$finish_date,$order_status);
        
        if($order->save())
        {
            $this->flashSession->success('Pesanan telah dikirim. Terima kasih');
        }
        else
        {
            $this->flashSession->error('Maaf pesanan tidak terkirim. Mohon coba kembali');
            $this->response->redirect('/order/users');
        }

        for($i=0; $i<count($items_notes_array) ; $i++)
        {
            $item       = new Item();
            $item->construct($user_id,$items_notes_array[$i],$items_type_array[$i]);
            $item->save();
            

            $order_item = new OrderItem();
            $order_item->construct($item->getId(),$order->getId());
            $order_item->save();
        }
        $this->response->redirect('/order/users');
    }
}