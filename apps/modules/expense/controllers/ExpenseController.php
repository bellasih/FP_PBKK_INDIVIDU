<?php

namespace ServiceLaundry\Expense\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use Phalcon\Mvc\Controller;

class ExpenseController extends SecureController
{
    public function showExpenseAction()
    {
        $datas = Expense::find();

        $this->view->expense = $datas;
    }

    public function createExpenseAction()
    {

    }

    public function storeExpenseAction()
    {
        if(!$this->request->isPost())
        {
            $this->response->redirect();
        }

        $form = new ExpenseForm();
        if(!$form->isValid($this->request->getPost()))
        {
            foreach($form->getMessages() as $msg)
            {
                $this->message[$msg->getField()] = $msg;
            }
        }

        if($this->request->hasFiles() == true)
        {
            $admin_id         = $this->session->has('auth')['id'];
            $expense_note     = $this->request->getPost('expense_note');
            $expense_total    = $this->request->getPost('expense_total');
            $invoice          = "temp.jpg";

            $expense = new Expense();
            $expense->construct($admin_id,$expense_note,$expense_total,$invoice);

            if($expense->save())
            {
                foreach($this->request->getUploadedFiles() as $file)
                {
                    $filename_toDB  = "img\\img_invoice\\" . $expense_id . '.' .$file->getExtension();
                    $save_file      = BASE_PATH . '\\public\\' . $filename_toDB;
                    $file->moveTo($save_file);
                    $expense->construct($admin_id,$expense_note,$expense_total,$invoice);
                    $expense->update();
                }
                $this->flashSession->success('Data Pengeluaran baru berhasil ditambahkan');
                $this->view->form = new ExpenseForm();
            }
            else
            {
                $this->flashSession->error('Terjadi kesalahan saat menambahkan data. Mohon, coba ulang kembali');
            }
            return $this->response->redirect();
        }
    }

    public function editExpenseAction()
    {
        if(!$this->request->isPost())
        {
            $this->response->redirect('expense');
        }

        $form = new ExpenseForm();
        if(!$form->isValid($this->request->getPost()))
        {
            foreach ($form->getMessages() as $msg)
            {
                $this->messages[$msg->getField()] = $msg;
            }
        }

        if($this->request->hasFiles() == true)
        {
            $expense_id = $this->request->getPost('expense_id');
            $expense    = Expense::findFirst("expense_id='$expense_id'");

            if($expense==null)
            {
                $this->flashSession->error('Terjadi error saat pencarian data. Mohon coba ulang kembali');
            }

            if($expense != null && $this->request->hasFiles() == true)
            {
                $old_file       = BASE_PATH . '\\public\\' .$expense->getInvoice();
                $admin_id       = $this->session->has('auth')['id'];
                $expense_note   = $this->request->getPost('expense_note');
                $expense_total  = $this->request->getPost('expense_total');
                $invoice        = $expense->getInvoice();

                $expense->construct($admin_id,$expense_note,$expense_total,$invoice);
                if($expense->update())
                {
                    if(!unlink($old_file))
                    {
                        $this->flashSession->error('File lama tidak dapat dihapus');
                    }
                    else
                    {
                        foreach($this->request->getUploadedFiles() as $file)
                        {
                            $save_file = BASE_PATH . '\\public\\img\\img_invoicce\\' .$expense->getId(). '.' .$file->getExtension();
                            $file->moveTo($save_file);
                        }
                        $this->flashSession->success('Data Pengeluaran berhasil diperbarui');
                    }
                }
                else
                {
                    $this->flashSession->error('Terjadi kesalahan saat memperbarui data. Mohon coba ulang kembali');
                }
            }    
        }
        $this->response->redirect('expense');
    }

    public function deleteExpenseAction()
    {
        if(!$this->request->isPost())
        {
            return $this->response->redirect('expense');
        }

        $expense_id = $this->request->getPost('expense_id');
        if($expense_id != null)
        {
            $expense = Expense::findFirst("expense_id='$expense_id'");
            if($expense != null)
            {
                $old_file   = BASE_PATH . '\\public\\' .$expense->getInvoice();
                if(!unlink($old_file))
                {
                    $this->flashSession->error('File tidak dapat ditemukan');
                }
                else
                {
                    $this->flashSession->success('Data Pengeluaran berhasil dihapus');
                }
            }
        }

        $this->response->redirect('expense');
    }
}