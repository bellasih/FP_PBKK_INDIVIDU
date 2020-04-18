<?php

namespace ServiceLaundry\Order\Forms\Web;
namespace ServiceLaundry\Common\Forms;

use ServiceLaundry\Common\Forms\BaseForm;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;

use Phalcon\Tag;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

class PaymentForm extends BaseForm
{
    public function initialize()
    {
        $payment_status = new Text('payment_status', [
            'placeholder'   => 'Masukkan Status Pembayaran',
            'class'         => 'form-control'
        ]);
        $payment_status->setLabel('Status Pembayaran');
        $payment_status->addValidator(new PresenceOf(['message'=>'Status Pembayaran belum diisi']));

        $submit = new Submit ('Simpan',
        [
            'name' => 'Simpan',
            "class" => "btn btn-success"
        ]);

        $this->add($payment_status);
        $this->add($submit);
    }
}