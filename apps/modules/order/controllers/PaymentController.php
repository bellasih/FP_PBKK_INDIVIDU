<?php

namespace ServiceLaundry\Order\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use ServiceLaundry\Order\Models\Web\Payment;
use ServiceLaundry\Order\Forms\Web\PaymentForm;
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Di;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model\Manager;

class PaymentController extends SecureController
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
        $total_row      = count(Payment::find());
        $total_page     = ceil($total_row/$number_page);

        $sql            = Payment::find([
                            'limit'     => $number_page,
                            'offset'    => $offset,
                        ]);
        
        $this->view->page           = $sql;
        $this->view->page_number    = $currentPage;
        $this->view->page_last      = $total_page;
        $this->view->offset         = $offset;
        $this->view->form           = new PaymentForm();
        $this->view->pick('views/payment/index');
    }

    public function storePaymentAction()
    {
        if(!$this->request->isPost())
        {
            return $this->response->redirect('payment');
        }

        $form = new PaymentForm();
        if(!$form->isValid($this->request->getPost()))
        {
            foreach($form->getMessages() as $msg)
            {
                $this->flashSession->error([$msg->getField()]);
            }
        }
        $admin_id       = $this->session->has('auth')['id'];
        $order_id       = $this->request->getPost('order_id');
        $payment_status = $this->request->getPost('payment_status');
        $payment_time   = date();

        $payment = new Payment();
        $payment->construct($admin_id,$Payment_status,$unit_price,$payment_stock);

        if($payment->save())
        {
            $this->flashSession->success('Data Pembayaran berhasil ditambahkan');
            $this->view->form = new PaymentForm();
        }
        else
        {
            $this->flashSession->error('Terjadi kesalahan saat menambahkan data. Mohon, coba ulang kembali');
        }
        return $this->response->redirect('payment');
    }

    public function updatePaymentAction()
    {
        if(!$this->request->isPost())
        {
            $this->response->redirect('Payment');
        }

        $form = new PaymentForm();
        if(!$form->isValid($this->request->getPost()))
        {
            foreach ($form->getMessages() as $msg)
            {
                $this->flashSession([$msg->getField()]);
            }
        }

        $payment_id   = $this->request->getPost('payment_id');
        $payment      = Payment::findFirst("payment_id='$payment_id'");
        if($payment != null)
        {
            $admin_id           = $this->session->has('auth')['id'];
            $order_id           = $this->request->getPost('order_id');
            $payment_status     = $this->request->getPost('payment_status');
            $payment_time       = date();

            $payment->construct($admin_id,$order_id,$payment_status,$payment_time);
            if($payment->update())
            {
                $this->flashSession->success('Data Pembayaran berhasil diubah');
            }
            else
            {
                $this->flashSession->error('Data Pembayaran tidak berhasil diubah. Mohon coba ulang kembali');
            }
        }
        else
        {
            $this->flashSession->error('Data yang dipilih tidak ada. Mohon coba ulang kemabali');
        }
        return $this->response->redirect('payment');
    }

    public function deletePaymentAction()
    {
        if(!$this->request->isPost())
        {
            return $this->response->redirect('payment');
        }

        $payment_id_string     = $this->request->getPost('payment_id');
        $payment_id_array      = explode(",", $payment_id_string);

        foreach($payment_id_array as $payment_id){
            if($payment_id != null)
            {
                $payment     = Payment::findFirst("payment_id='$payment_id'");
                if($payment != null)
                {
                    if($payment->delete())
                    {
                        $this->flashSession->success('Data Pembayaran berhasil dihapus');
                    }
                    else
                    {
                        $this->flashSession->error('Data Pembayaran tidak berhasil dihapus. Mohon coba ulang kembali');
                    }
                }
                else
                {
                    $this->flashSession->error('Data Pembayaran tidak dapat ditemukan. Mohon coba ulang kembali');
                }
            }
            return $this->response->redirect('payment');
        }
    }
}