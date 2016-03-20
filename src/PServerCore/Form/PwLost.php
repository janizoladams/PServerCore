<?php

namespace PServerCore\Form;

use Zend\Captcha\AdapterInterface;
use Zend\Form\Element;
use Zend\Form\Element\Captcha;
use ZfcBase\Form\ProvidesEventsForm;

class PwLost extends ProvidesEventsForm
{

    /**
     * PwLost constructor.
     * @param AdapterInterface $adapterInterface
     */
    public function __construct(AdapterInterface $adapterInterface)
    {
        parent::__construct();

        $this->add([
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'eugzhoe45gh3o49ug2wrtu7gz50'
        ]);

        $this->add([
            'name' => 'username',
            'options' => [
                'label' => 'Username',
            ],
            'attributes' => [
                'class' => 'form-control',
                'type' => 'text',
                'required' => true,
            ],
        ]);

        $captcha = new Captcha('captcha');
        $captcha->setCaptcha($adapterInterface)
            ->setOptions([
                'label' => 'Please verify you are human.',
            ])
            ->setAttributes([
                'class' => 'form-control',
                'type' => 'text',
                'required' => true,
            ]);
        $this->add($captcha);

        $submitElement = new Element\Button('submit');
        $submitElement
            ->setLabel('PwLost')
            ->setAttributes([
                'class' => 'btn btn-default',
                'type' => 'submit',
            ]);

        $this->add($submitElement, [
            'priority' => -100,
        ]);

    }
} 