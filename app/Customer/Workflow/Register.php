<?php
namespace Lavender\Customer\Workflow;

use Illuminate\Support\Facades\URL;

use Lavender\Support\Workflow;

class Register extends Workflow
{

    public function states()
    {
        return [

            10 => 'register_now',

            20 => 'register_customer',

        ];
    }

    public function options($state, $params)
    {
        return ['url' => URL::to('customer/post/new_customer/'.$state)];
    }

    public function fields($state, $params)
    {
        if($state == 'register_now') return $this->register_now($params);

        if($state == 'register_customer') return $this->register_customer($params);

        return [];
    }

    protected function register_now($params)
    {
        return [

            'submit' => [
                'type' => 'button',
                'value' => 'Register now!',
                'options' => ['type' => 'submit'],
            ]

        ];
    }


    protected function register_customer($params)
    {
        return [

            'email' => [
                'label' => 'Email',
                'type' => 'text',
                'validate' => ['required', 'email'],
            ],

            'password' => [
                'label' => 'Password',
                'type' => 'password',
                'validate' => ['required'],
                'flash' => false,
            ],

            'password_confirmation' => [
                'label' => 'Confirm Password',
                'type' => 'password',
                'validate' => ['required'],
                'flash' => false,
            ],

            'submit' => [
                'type' => 'button',
                'value' => 'Register',
                'options' => ['type' => 'submit'],
            ]

        ];
    }


}