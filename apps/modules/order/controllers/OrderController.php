<?php

namespace ServiceLaundry\Order\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use ServiceLaundry\Order\Models\Web\Orders;
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model\Manager;

//class OrderController extends SecureController
class OrderController extends Controller
{
    public function indexAction()
    {
        $datas = Orders::find();
        // $currentPage = (int) $_GET['page'];
        // $paginator = new PaginatorModel(
        //     [
        //         'model'  => $datas,
        //         'limit' => 10,
        //         'page'  => $currentPage,
        //     ]
        // );
        // $page = $paginator->paginate();
        // $this->view->page = $page;

        $this->view->datas = $datas;
        $this->view->pick('views/index');
    }

    public function detailItemAction()
    {
        $order_id   = $this->request->getPost('order_id');
        if($order_id != null)
        {
            $sql        = "SELECT l.item_type, l.item_details FROM  Item l JOIN OrderItem m
                        WHERE l.item_id = m.item_id AND m.order_id = $order_id";

            $detailItem = $this->modelManager->createQuery($sql)
                                             ->execute();
            
            $this->view->detailItem = $detailItem;
            $this->view->pick("detail_item/'$order_id'");
        }
    }
}