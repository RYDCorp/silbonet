<?php
class Laporan extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
        $this->load->model('model_app');
        $this->load->helper('currency_format_helper');
    }

    function index(){
        $data=array(
            'title'=>'Laporan Penjualan',
            'active_laporan'=>'active',
            'data_penjualan'=>$this->model_app->getAllDataPenjualan(),
        );
        $this->session->unset_userdata('tgl_awal');
        $this->session->unset_userdata('tgl_akhir');

        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_lap_penjualan');
        $this->load->view('element/v_footer');
    }

    function cari(){
        $tgl_awal= date("Y-m-d",strtotime($this->input->post('tgl_awal')));
        $tgl_akhir= date("Y-m-d",strtotime($this->input->post('tgl_akhir')));
        $sess_data=array(
            'tgl_awal'=>$tgl_awal,
            'tgl_akhir'=>$tgl_akhir
        );
        $this->session->set_userdata($sess_data);
        $data=array(
            'dt_result'=> $this->model_app->getLapPenjualan($tgl_awal,$tgl_akhir),
            'tgl_awal'=>date("d M Y",strtotime($this->session->userdata('tgl_awal'))),
            'tgl_akhir'=>date("d M Y",strtotime($this->session->userdata('tgl_akhir'))),
        );
        $this->load->view('pages/v_result_laporan',$data);
    }
}
