<?php

namespace ServiceLaundry\Common\Controllers;

use Phalcon\Mvc\Controller;

class SecureController extends Controller
{
    public function beforeExecutionRouter()
    {
        if(!$this->session->has('auth'))
        {
            return $this->response->redirect("login");
        }
    }
    /*
    * Styling for flasSession
    */
    public function setFlashSessionDesign()
    {
        $this->flashSession->setCssClasses([        
            'error'   => 'alert alert-danger',
            'success' => 'alert alert-success', 
            'notice'  => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ]);
    }

    protected function back()
    {
        return $this->response->redirect($_SERVER['HTTP_REFERER']);
    }
}