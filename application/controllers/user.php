<?php

defined('BASEPATH') or exit('No direct script access allowed');

class user extends CI_Controller
{

    public function __contruct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('login_model');


        if ($this->session->userdata('level') != "user") {
            redirect('login', 'refresh');
        }
    }
    public function index()
    {
        $this->load->view('mahasiswa/user');
    }
}
