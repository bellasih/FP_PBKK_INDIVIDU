<?php

namespace ServiceLaundry\PickupDelivery\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use ServiceLaundry\PickupDelivery\Forms\Web\PickupDeliveryForm;
use ServiceLaundry\PickupDelivery\Models\Web\PickupDelivery;
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class PickupDeliveryController extends SecureController
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
        $total_row      = count(PickupDelivery::find());
        $total_page     = ceil($total_row/$number_page);

        $sql            = PickupDelivery::find([
                            'limit'     => $number_page,
                            'offset'    => $offset,
                        ]);
        $this->view->page           = $sql;
        $this->view->page_number    = $currentPage;
        $this->view->page_last      = $total_page;
        $this->view->offset         = $offset;
        $this->view->flashSession   = $this->flashSession;
        $this->view->form           = new PickupDeliveryForm();
        $this->view->pick('views/index');
    }

    public function editPickupDeliveryAction()
    {
        $pd_id  = $this->request->getQuery('pd_id');
        $datas  = PickupDelivery::findFirst("pd_id='$pd_id'");

        $this->view->forms = new PickupDeliveryForm($datas);
        $this->view->pd_id  = $pd_id;
        $this->view->pick('views/index');
    }

    public function storePickupDeliveryAction()
    {
        if(!$this->request->isPost())
        {
            return $this->response->redirect('pickup_delivery');
        }

        $form = new PickupDeliveryForm();
        if(!$form->isValid($this->request->getPost()))
        {
            foreach($form->getMessages() as $msg)
            {
                $this->flashSession->error($msg->getMessage());
            }
        }
        $admin_id           = $this->session->has('auth')['id'];
        $order_id           = $this->request->getPost('order_id');
        $pd_status          = $this->request->getPost('pd_status');
        $pd_driver          = $this->request->getPost('pd_driver');
        $pd_type            = $this->request->getPost('pd_type');
        $pd_time_est        = $this->request->getPost('pd_time_est');

        $pd = new PickupDelivery();
        $pd->construct($order_id,$pd_status,$pd_driver,$pd_type,$pd_time_est);

        if($pd->save())
        {
            $this->flashSession->success('Data Pickup Delivery berhasil ditambahkan');
            $this->view->form = new PickupDeliveryForm();
        }
        else
        {
            $this->flashSession->error('Terjadi kesalahan saat menambahkan data. Mohon, coba ulang kembali');
        }
        return $this->response->redirect('pickup_delivery');
    }

    public function updatePickupDeliveryAction()
    {
        if(!$this->request->isPost())
        {
            $this->response->redirect('pickup_delivery');
        }

        $form = new PickupDeliveryForm();
        if(!$form->isValid($this->request->getPost()))
        {
            foreach ($form->getMessages() as $msg)
            {
                $this->flashSession->error($msg->getMessage());
            }
        }

        $pd_id      = $this->request->getPost('pd_id');
        $pd         = PickupDelivery::findFirst("pd_id='$pd_id'");
        if($pd != null)
        {
            $order_id           = $pd->getOrderId();
            $pd_status          = $this->request->getPost('pd_status');
            $pd_driver          = $this->request->getPost('pd_driver');
            $pd_type            = $this->request->getPost('pd_type');
            $pd_time_est        = $this->request->getPost('pd_time_est');

            $pd->construct($order_id,$pd_status,$pd_driver,$pd_type,$pd_time_est);

            if($pd->update())
            {
                $this->flashSession->success('Data Pickup Delivery berhasil diubah');
            }
            else
            {
                $this->flashSession->error('Data Pickup Delivery tidak berhasil diubah. Mohon coba ulang kembali');
            }
        }
        else
        {
            $this->flashSession->error('Data yang dipilih tidak ada. Mohon coba ulang kemabali');
        }
        return $this->response->redirect('pickup_delivery');
    }

    public function deletePickupDeliveryAction()
    {
        if(!$this->request->isPost())
        {
            return $this->response->redirect('pickup_delivery');
        }

        $pd_id_string     = $this->request->getPost('pd_id');
        $pd_id_array      = explode(",", $pd_id_string);

        foreach($pd_id_array as $pd_id){
            if($pd_id != null)
            {
                $pd     = PickupDelivery::findFirst("pd_id='$pd_id'");
                if($pd != null)
                {
                    if($pd->delete())
                    {
                        $this->flashSession->success('Data Pickup Delivery berhasil dihapus');
                    }
                    else
                    {
                        $this->flashSession->error('Data Pickup Delivery tidak berhasil dihapus. Mohon coba ulang kembali');
                    }
                }
                else
                {
                    $this->flashSession->error('Data Pickup Delivery tidak dapat ditemukan. Mohon coba ulang kembali');
                }
            }
        }
        return $this->response->redirect('pickup_delivery');
    }
}