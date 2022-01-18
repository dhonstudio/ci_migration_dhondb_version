<?php

class Migrate extends CI_Controller
{
    public function index()
    {
        $this->load->library('dhondb');
        $this->dhondb->version = 20220118000703;
        $this->dhondb->migrate('users');
    }
}