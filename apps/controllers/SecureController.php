<?php

namespace ServiceLaundry\Common\Controllers;

use Phalcon\Mvc\Controller;

class SecureController extends Controller
{
    public function beforeExecutionRouter()
    {
        if(!$this->session->has('auth'))
        {
            return $this->response->redirect('login');
        }
    }

    protected function back()
    {
        return $this->response->redirect($_SERVER['HTTP_REFERER']);
    }
}