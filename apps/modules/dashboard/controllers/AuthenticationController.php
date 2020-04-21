<?php

namespace ServiceLaundry\Dashboard\Controllers\Web;

use ServiceLaundry\Dashboard\Forms\Web\LoginForm;
use ServiceLaundry\Dashboard\Models\Web\Users;
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Escaper;
use Phalcon\Flash\Direct;


class AuthenticationController extends Controller
{
    public $message = "";

    public function createLoginAction()
    {
        $escaper    = new Escaper();
        $flash      = new Direct($escaper);

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
            $user_rem = [
                'username' => $_COOKIE['remember']['username'],
                'password' => $_COOKIE['remember']['password']
            ];
        }

        $flash->error("Anda harus memasukkan username dan password untuk masuk");

        $this->view->form       = new LoginForm($user_rem);
        $this->view->flash      = $flash;
        $this->view->pick('views/createLogin');
    }

    public function storeLoginAction()
    {
        echo 'masuk';
        $escaper    = new Escaper();
        $flash      = new Direct($escaper);

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
                return $this->dispatcher->forward(['action'=> 'createLogin']);
            }
        }
        else {
            if($password==="" | $username==="")
            {
                $flash->error("Anda harus memasukkan username dan password untuk masuk");
            }  
            else
            {
                $this->message = "Username dan/atau password salah.";
            }
            return $this->dispatcher->forward(['action'=> 'createLogin']);
            // return $this->response->redirect('/login');
        }
    }

    public function destroyAction()
    {
        unset($this->session->auth);
     	$this->response->redirect('login');   
    }
}