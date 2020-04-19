<?php

namespace ServiceLaundry\Dashboard\Controllers\Web;

use ServiceLaundry\Dashboard\Forms\Web\LoginForm;
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class AuthenticationController extends Controller
{
    private $message = "";

    public function createLoginAction()
    {
        $user_rem = null;
        $remCookies = $this->cookies->get('remember');
        $remCookies = $remCookies->getValue();

        if($remCookies){
            $user_rem = [
                'username' => $remCookies['username'],
                'password' => $remCookies['password']
            ];
        }
        
        if(isset($_COOKIE['remember'])){
            die();
            $user_rem = [
                'username' => $_COOKIE['remember']['username'],
                'password' => $_COOKIE['remember']['password']
            ];
        }

        $this->view->form = new LoginForm($user_rem);
    }

    public function storeLoginAction()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        $user = Users::findFirst("username='$username'");
        if($user)
        {
            if($this->security->checkHash($password, $user->password))
        	{
        		$this->session->set('auth',
        			[
                        'username' => $username,
                        'id' => $user->getId(),
                        'remember' => $remember
        			]
                );
                
                if($remember==1){
                    $this->cookies->set("remember",
                        [
                            'username' => $username,
                            'password' => $password,
                        ],
                        time() + 15 * 86400
                    );
                    $this->cookies->send();
                    setcookie("remember", ['username'=> $username, 'password'=>$password], (86400 * 15), '/');
                }
        		(new Response())->redirect()->send();
            }
            else{
                $this->security->hash(rand());
                $this->message = "Password salah";
                $this->dispatcher->forward(['action'=> 'create']);
            }
        }
        else {
            if($password==="" | $username==="")
            {
                $this->message = "Anda harus memasukkan username dan password untuk masuk";
            }  
            else
            {
                $this->message = "Username dan/atau password salah.";
            }
            $this->dispatcher->forward(['action'=> 'create']);
        }
    }
}