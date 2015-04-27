<?php

class loginController extends BaseController {

    public function index()
    {
        return View::make('index');
    }

    public function login()
    {
        return  View::make('login');
    }
}
