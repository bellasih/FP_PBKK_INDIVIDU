<?php

namespace ServiceLaundry\Order\Controllers\Web;

use Phalcon\Mvc\Controller;

class AccountController extends Controller
{
    public function showAccountAction()
    {
        $username   = $this->session->get('auth');
        $data_admin = Users::findFirst("username='$username'");

        $this->view->profile_data = $data_admin;
    }

    public function changePasswordAction()
    {
        if(!$this->request->isPost())
        {
            $this->response->redirect('profile');
        }

        $id_admin   = $this->request->getPost('user_id');
        $admin      = Users::findFirst("user_id='$id_admin'");

        if($admin == null)
        {
            $this->flashSession->error('Terjadi error saat pencarian data. Mohon coba ulang kembali');
        }
        else
        {
            $username       = $admin->getUsername();
            $password       = $this->request->getPost('password');
            $name           = $admin->getName();
            $gender         = $admin->getGender();
            $address        = $admin->getAddress();
            $register_date  = $admin->getRegisterDate();
            $role           = $admin->getRole();
            $phone          = $admin->getPhone();
            $email          = $admin->getEmail();

            $admin->construct($username,$password,$name,$gender,$register_date,$role,$phone,$email,$email,$profile_img);
            if($admin->update())
            {
                $this->flashSession->success('Data Profile Admin berhasil diperbarui');
            }
            else
            {
                $this->flashSession->error('Terjadi kesalahan saat memperbarui data profil. Mohon coba ulang kembali');
            }
        }
        $this->response->redirect('profile');
    }

    public function changeImageAction()
    {
        if(!$this->request->isPost())
        {
            $this->response->redirect('profile');
        }

        $id_admin   = $this->request->getPost('user_id');
        $admin      = Users::findFirst("user_id='$id_admin'");
        if($admin == null)
        {
            $this->flashSession->error('Terjadi error saat pencarian data. Mohon coba ulang kembali');
        }
        
        if($admin != null && $this->request->hasFiles() == true)
        {
            $username       = $admin->getUsername();
            $password       = $admin->getPassword();
            $name           = $admin->getName();
            $gender         = $admin->getGender();
            $address        = $admin->getAddress();
            $register_date  = $admin->getRegisterDate();
            $role           = $admin->getRole();
            $phone          = $admin->getPhone();
            $email          = $admin->getEmail();
            $flag           = 0;

            foreach($this->request->getUploadedFiles() as $file)
            {
                $filename_toDB      = "img\\img_profile\\" . $admin->getId() . '.' .$file->getExtension();
                $save_file          = BASE_PATH . '\\public\\img_profile\\' . $filename_toDB;
                $admin->construct($username,$password,$name,$gender,$register_date,$role,$phone,$email,$email,$save_file);
                if($admin->update())
                {
                    $flag = 1;
                }
            }

            if($flag)
            {
                $this->flashSession->success('Foto Profil berhasil diperbarui');
            }
            else
            {
                $this->flashSession->error('Terjadi kesalahan saat menyimpan data. Mohon coba ulang kembali.');
            }
        }

        $this->response->redirect('profile');
    }

    public function editProfileAction()
    {
        if(!$this->request->isPost())
        {
            $this->response->redirect('profile');
        }

        $id_admin   = $this->request->getPost('user_id');
        $admin      = Users::findFirst("user_id='$id_admin'");
        if($admin == null)
        {
            $this->flashSession->error('Terjadi error saat pencarian data. Mohon coba ulang kembali');
        }
        else
        {
            $username       = $admin->getUsername();
            $password       = $admin->getPassword();
            $name           = $this->request->getPost('name');
            $gender         = $this->request->getPost('gender');
            $address        = $this->request->getPost('address');
            $register_date  = $admin->getRegisterDate();
            $role           = $admin->getRole();
            $phone          = $this->request->getPost('phone');
            $email          = $this->request->getPost('email');
            $profile_img    = $admin->getProfileImg();

            $admin->construct($username,$password,$name,$gender,$register_date,$role,$phone,$email,$email,$profile_img);
            if($admin->update())
            {
                $this->flashSession->success('Data Profile Admin berhasil diperbarui');
            }
            else
            {
                $this->flashSession->error('Terjadi kesalahan saat memperbarui data profil. Mohon coba ulang kembali');
            }
        }
        $this->response->redirect('profile');
    }
}