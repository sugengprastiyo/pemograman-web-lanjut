<?php

defined('BASEPATH') or exit('No direct script access allowed');

class mahasiswa extends CI_Controller
{

    public function __contruct()
    {
        parent::__construct();
        $this->load->model('mahasiswa_model');
        $this->load->library('form_validation');

        if ($this->session->userdata('level') != "admin") {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {

        // $this->load->database();
        $data['title'] = 'List Mahasiswa';
        $this->load->model('mahasiswa_model');
        $data['mahasiswa'] = $this->mahasiswa_model->getAllmahasiswa();
        if ($this->input->post('keyword')) {
            $data['mahasiswa'] = $this->mahasiswa_model->cariDataMahasiswa();
        }
        $this->load->view('template/header', $data);
        $this->load->view('mahasiswa/index', $data);
        $this->load->view('template/footer');
    }
    public function tambah()
    {
        $data['title'] = 'Form Menambahkan Data Mahasiswa';
        $data['jurusan'] = ['Teknik Informatika', 'Teknik Kimia', 'Teknik Industri', 'Teknik Mesin'];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'Nim', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('mahasiswa/tambah', $data);
            $this->load->view('template/footer');
        } else {
            // echo "data berhasil ditambah";
            $this->load->model('mahasiswa_model');
            $this->mahasiswa_model->tambahdatamhs();
            $this->session->set_flashdata('flash-data', 'ditambahkan');
            redirect('mahasiswa', 'refresh');
        }
    }
    public function hapus($id)
    {
        $this->load->model('mahasiswa_model');
        $this->mahasiswa_model->hapusdatamhs($id);
        $this->session->set_flashdata('flash-data', 'dihapus');
        redirect('mahasiswa', 'refresh');
    }
    public function detail($id)
    {
        $data['title'] = 'Detail Mahasiswa';
        $this->load->model('mahasiswa_model');
        $data['mahasiswa'] = $this->mahasiswa_model->getmahasiswaByID($id);
        $this->load->view('template/header', $data);
        $this->load->view('mahasiswa/detail', $data);
        $this->load->view('template/footer');
    }
    public function edit($id)
    {
        $data['title'] = 'Form Edit Data Mahasiswa';
        $this->load->model('mahasiswa_model');
        $data['mahasiswa'] = $this->mahasiswa_model->getmahasiswaByID($id);
        $data['jurusan'] = ['Teknik Informatika', 'Teknik Kimia', 'Teknik Industri', 'Teknik Mesin'];

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'Nim', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('mahasiswa/edit', $data);
            $this->load->view('template/footer');
        } else {
            // echo "data berhasil ditambah";
            $this->load->model('mahasiswa_model');
            $this->mahasiswa_model->ubahdatamhs();
            $this->session->set_flashdata('flash-data', 'diedit');
            redirect('mahasiswa', 'refresh');
        }
    }
}
    
    /* End of file Controllername.php */
