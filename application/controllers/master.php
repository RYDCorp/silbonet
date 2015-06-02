<?php
class Master extends CI_Controller{
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
            'title'=>'Master Data',
            'active_master'=>'active',
            'kd_barang'=>$this->model_app->getKodeBarang(),
            'kd_pelanggan'=>$this->model_app->getKodePelanggan(),
            'kd_pegawai'=>$this->model_app->getKodePegawai(),
            'data_barang'=>$this->model_app->getAllData('tbl_barang'),
            'data_pelanggan'=>$this->model_app->getAllData('tbl_pelanggan'),
            'data_contact'=>$this->model_app->getAllData('tbl_contact'),
            'data_pegawai'=>$this->model_app->getAllData('tbl_pegawai'),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_master');
        $this->load->view('element/v_footer');
    }

//
//    ===================== INSERT =====================
    function tambah_barang(){
        $data=array(
            'kd_barang'=>$this->input->post('kd_barang'),
            'nm_barang'=>$this->input->post('nm_barang'),
            'stok'=>$this->input->post('stok'),
            'harga'=>$this->input->post('harga'),
        );
        $this->model_app->insertData('tbl_barang',$data);
        redirect("master");
    }
    function tambah_pelanggan(){
        $data=array(
            'kd_pelanggan'=> $this->input->post('kd_pelanggan'),
            'nm_pelanggan'=>$this->input->post('nm_pelanggan'),
            'alamat'=>$this->input->post('alamat'),
            'email'=>$this->input->post('email'),
        );
        $this->model_app->insertData('tbl_pelanggan',$data);
        redirect("master");
    }
    function tambah_pegawai(){
        $data=array(
            'kd_pegawai'=> $this->input->post('kd_pegawai'),
            'username'=>$this->input->post('username'),
            'password'=>md5($this->input->post('password')),
            'nama'=> $this->input->post('nama'),
            'level'=>$this->input->post('level'),
        );
        $this->model_app->insertData('tbl_pegawai',$data);
        redirect("master");
    }


//    ======================== EDIT =======================
    function edit_barang(){
        $id['kd_barang'] = $this->input->post('kd_barang');
        $data=array(
            'nm_barang'=>$this->input->post('nm_barang'),
            'stok'=>$this->input->post('stok'),
            'harga'=>$this->input->post('harga'),
        );
        $this->model_app->updateData('tbl_barang',$data,$id);
        redirect("master");
    }
    function edit_pelanggan(){
        $id['kd_pelanggan'] = $this->input->post('kd_pelanggan');
        $data=array(
            'nm_pelanggan'=>$this->input->post('nm_pelanggan'),
            'alamat'=>$this->input->post('alamat'),
            'email'=>$this->input->post('email'),
        );
        $this->model_app->updateData('tbl_pelanggan',$data,$id);
        redirect("master");
    }
    function edit_contact(){
        $id['id'] = 1;
        $data=array(
            'nama'=> $this->input->post('nama'),
            'owner'=>$this->input->post('owner'),
            'alamat'=>$this->input->post('alamat'),
            'telp'=>$this->input->post('telp'),
            'email'=>$this->input->post('email'),
            'website'=>$this->input->post('website'),
            'desc'=>$this->input->post('desc'),
        );
        $this->model_app->updateData('tbl_contact',$data,$id);
        redirect("master");
    }
    function edit_pegawai(){
        $id['kd_pegawai'] = $this->input->post('kd_pegawai');
        $data=array(
            'username'=>$this->input->post('username'),
            'password'=>md5($this->input->post('password')),
            'nama'=> $this->input->post('nama'),
            'level'=>$this->input->post('level'),
        );
        $this->model_app->updateData('tbl_pegawai',$data,$id);
        redirect("master");
    }

//    ========================== DELETE =======================
    function hapus_barang(){
        $id['kd_barang'] = $this->uri->segment(3);
        $this->model_app->deleteData('tbl_barang',$id);
        redirect("master");
    }
    function hapus_pelanggan(){
        $id['kd_pelanggan'] = $this->uri->segment(3);
        $this->model_app->deleteData('tbl_pelanggan',$id);
        redirect("master");
    }
    function hapus_pegawai(){
        $id['kd_pegawai'] = $this->uri->segment(3);
        $this->model_app->deleteData('tbl_pegawai',$id);
        redirect("master");
    }
}


