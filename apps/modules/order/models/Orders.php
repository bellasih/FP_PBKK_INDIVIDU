<?php

namespace ServiceLaundry\Order\Models\Web;

use Phalcon\Mvc\Model;

class Orders extends Model
{
    private $order_id;
    private $service_id;
    private $user_id;
    private $order_total;
    private $order_date;
    private $finish_date;
    private $order_status;

    public function initialize()
    {
        $this->setSource('Orders');
    }

    public function construct($service_id,$user_id,$order_total,$order_date,$finish_date,$order_status)
    {
        $this->service_id       = $service_id;
        $this->user_id          = $user_id;
        $this->order_total      = $order_total;
        $this->order_date       = $order_date;
        $this->finish_date      = $finish_date;
        $this->order_status     = $order_status;
    }

    public function getId()
    {
        return $this->service_id;
    }

    public function getFinishDate()
    {
        return $this->finish_date;
    }

    public function getOrderStatus()
    {
        return $this->order_status;
    }
}