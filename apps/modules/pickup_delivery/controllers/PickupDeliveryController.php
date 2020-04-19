<?php

namespace ServiceLaundry\PickupDelivery\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use ServiceLaundry\PickupDelivery\Forms\Web\PickupDeliveryForm;
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;


class PickupDeliveryController extends SecureController
{
    public function showPickupDeliveryAction()
    {
        $datas = PickupDelivery::find();
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

    public function createPickupDeliveryAction()
    {

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
                $this->message[$msg->getField()] = $msg;
            }
        }
        $admin_id           = $this->session->has('auth')['id'];
        $order_id           = $this->request->getPost('order_id');
        $pd_status          = $this->request->getPost('pd_status');
        $pd_driver          = $this->request->getPost('pd_driver');
        $pd_type            = $this->request->getPost('pd_type');
        $pd_time_est        = $this->request->getPost('pd_time_est');

        $pd = new PickupDelivery();
        $pd->construct($admin_id,$order_id,$pd_status,$pd_driver,$pd_type,$pd_time_est);

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

    public function editPickupDeliveryAction()
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
                $this->messages[$msg->getField()] = $msg;
            }
        }

        $pd_id      = $this->request->getPost('pd_id');
        $pd         = PickupDelivery::findFirst("pd_id='$pd_id'");
        if($pd != null)
        {
            $admin_id           = $this->session->has('auth')['id'];
            $order_id           = $pd->getOrderId();
            $pd_status          = $this->request->getPost('pd_status');
            $pd_driver          = $this->request->getPost('pd_driver');
            $pd_type            = $this->request->getPost('pd_type');
            $pd_time_est        = $this->request->getPost('pd_time_est');

            $pd->construct($admin_id,$order_id,$pd_status,$pd_driver,$pd_type,$pd_time_est);
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

        $pd_id      = $this->request->getPost('pd_id');
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
        return $this->response->redirect('pickup_delivery');
    }
}