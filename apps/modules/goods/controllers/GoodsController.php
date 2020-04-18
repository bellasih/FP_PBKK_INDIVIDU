<?php

namespace ServiceLaundry\Expense\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use Phalcon\Mvc\Controller;

class GoodsController extends SecureController
{
    public function showGoodsAction()
    {
        $datas = Goods::find();

        $this->view->goods = $datas;
    }

    public function createGoodsAction()
    {

    }

    public function storeGoodsAction()
    {
        if(!$this->request->isPost())
        {
            $this->response->redirect();
        }

        $form = new GoodsForm();
        if(!$form->isValid($this->request->getPost()))
        {
            foreach($form->getMessages() as $msg)
            {
                $this->message[$msg->getField()] = $msg;
            }
        }
        $admin_id         = $this->session->has('auth')['id'];
        $goods_name       = $this->request->getPost('goods_name');
        $unit_price       = $this->request->getPost('expense_total');
        $good_stock       = $this->request->getPost('good_stock');

        $goods = new Goods();
        $goods->construct($admin_id,$goods_name,$unit_price,$good_stock);

        if($goods->save())
        {
            $this->flashSession->success('Data Barang berhasil ditambahkan');
            $this->view->form = new GoodsForm();
        }
        else
        {
            $this->flashSession->error('Terjadi kesalahan saat menambahkan data. Mohon, coba ulang kembali');
        }
        return $this->response->redirect();
    }

    public function editGoodsAction()
    {

    }

    public function deleteGoodsAction()
    {
        
    }
}