<?php
class Dashboard extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
        $this->load->model('model_app');
    }

    function index(){
        $data=array(
            'title'=>'Dashboard',
            'active_dashboard'=>'active',
            'dt_contact'=>$this->model_app->getAllData('tbl_contact'),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_dashboard');
        $this->load->view('element/v_footer');
    }

}
