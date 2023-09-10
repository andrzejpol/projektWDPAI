<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class DefaultController extends AppController
{
    public function index()
    {
        $this->render('mainPage');
    }

    public function cars()
    {
        $this->render('carsPage');
    }

    public function faq()
    {
        $this->render('faqPage');
    }

    public function contact()
    {
        $this->render('contactPage');
    }
}
