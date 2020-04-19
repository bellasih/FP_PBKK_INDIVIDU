<?php

namespace ServiceLaundry\Dashboard\Controllers\Web;

use ServiceLaundry\Common\Controllers\SecureController;
use ServiceLaundry\Order\Models\Web\Order;
use ServiceLaundry\Dashboard\Forms\Web\UserForm;
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class IndexController extends Controller
{
    public function indexAction()
    {

    }

    public function dashboardAction()
    {
        $completed_order    = Order::count(['condition'=>'Pesanan Telah Selesai']);
        $unprocessed_order  = Order::count(['condition'=>'Pesanan Belum Diproses']);

        $this->view->form               = new UserForm();
        $this->view->completed_order    = $completed_order;
        $this->view->unprocessed_order  = $unprocessed_order;
    }

    public function createAdminAction()
    {

    }

    public function loginAdminAction()
    {

    }

    public function storeAdminAction()
    {
        if(!$this->request->isPost())
        {
            $this->response->redirect();
        }

        $form = new UserForm();
        if($this->request->getPost('gender') == null)
        {
            $this->flashSession->error('Anda harus mengisi jenis kelamin');
        }

        $username = $this->request->getPost('username');
        if(Users::findFirst("username='$username'"))
        {
            $this->flashSession->error('Username sudah digunakan');
            $this->response->redirect();
        }

        if(!$form->isValid($this->request->getPost()))
        {
            foreach($form->getMessages() as $msg)
            {
                $this->message[$msg->getField()] = $msg;
            }
        }

        if($this->request->hasFiles() == true)
        {
            $username       = $this->request->getPost('username');
            $password       = $this->security->hash($this->request->getPost('password'));
            $name           = $this->request->getPost('name');
            $gender         = $this->request->getPost('gender');
            $address        = $this->request->getPost('address');
            $register_date  = date('Y-m-d');
            $role           = 1;
            $phone          = $this->request->getPost('phone');
            $email          = $this->request->getPost('email');
            $profile_img    = "temp.jpg";

            $admin = new Users();
            $admin->construct($username,$password,$name,$gender,$address,$register_date,$role,$phone,$email,$phone,$profile_img);

            if($admin->save())
            {
                foreach($this->request->getUploadedFiles() as $file)
                {
                    $filename_toDB  = "img\\img_profile\\" . $admin->username . '.' .$file->getExtension();
                    $save_file      = BASE_PATH . '\\public\\' . $filename_toDB;
                    $file->moveTo($save_file);
                    $admin->construct($username,$password,$name,$gender,$address,$register_date,$role,$phone,$email,$phone,$profile_img);
                    $admin->update();
                }
                $this->flashSession->success('Admin baru berhasil ditambahkan');
                $this->view->form = new UserForm();
            }
            else
            {
                $this->flashSession->error('Terjadi kesalahan saat menambahkan data. Mohon, coba ulang kembali');
            }
            return $this->response->redirect();
        }
    }
}