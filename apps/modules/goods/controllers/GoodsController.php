<?php

namespace ServiceLaundry\Goods\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use ServiceLaundry\Goods\Forms\Web\GoodsForm;
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class GoodsController extends SecureController
{
    public function showGoodsAction()
    {
        $datas = Goods::find();
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

    public function createGoodsAction()
    {

    }

    public function storeGoodsAction()
    {
        if(!$this->request->isPost())
        {
            return $this->response->redirect('goods');
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
        $unit_price       = $this->request->getPost('unit_price');
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
        return $this->response->redirect('goods');
    }

    public function editGoodsAction()
    {
        if(!$this->request->isPost())
        {
            $this->response->redirect('goods');
        }

        $form = new GoodsForm();
        if(!$form->isValid($this->request->getPost()))
        {
            foreach ($form->getMessages() as $msg)
            {
                $this->messages[$msg->getField()] = $msg;
            }
        }

        $goods_id   = $this->request->getPost('goods_id');
        $good       = Goods::findFirst("goods_id='$goods_id'");
        if($good != null)
        {
            $admin_id       = $this->session->has('auth')['id'];
            $goods_name     = $this->request->getPost('goods_name');
            $unit_price     = $this->request->getPost('unit_price');
            $good_stock     = $this->request->getPost('good_stock');

            $good->construct($admin_id,$goods_name,$unit_price,$good_stock);
            if($good->update())
            {
                $this->flashSession->success('Data Barang berhasil diubah');
            }
            else
            {
                $this->flashSession->error('Data Barang tidak berhasil diubah. Mohon coba ulang kembali');
            }
        }
        else
        {
            $this->flashSession->error('Data yang dipilih tidak ada. Mohon coba ulang kemabali');
        }
        return $this->response->redirect('goods');

    }

    public function deleteGoodsAction()
    {
        if(!$this->request->isPost())
        {
            return $this->response->redirect('goods');
        }

        $goods_id   = $this->request->getPost('goods_id');
        if($goods_id != null)
        {
            $good     = Goods::findFirst("goods_id='$goods_id'");
            if($good != null)
            {
                if($good->delete())
                {
                    $this->flashSession->success('Data Barang berhasil dihapus');
                }
                else
                {
                    $this->flashSession->error('Data Barang tidak berhasil dihapus. Mohon coba ulang kembali');
                }
            }
            else
            {
                $this->flashSession->error('Data Barang tidak dapat ditemukan. Mohon coba ulang kembali');
            }
        }
        return $this->response->redirect('goods');
    }
}