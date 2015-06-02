<?php
class B_keluar extends CI_Controller{
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
            'title'=>'Barang Keluar',
            'active_b_keluar'=>'active',
            'data_penjualan'=>$this->model_app->getAllDataPenjualan(),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/view_b_keluar');
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
    }

//    GET DATA
    function tambah_barang_keluar(){
        $data=array(
            'title'=>'Tambah Barang Keluar',
            'active_b_keluar'=>'active',
            'kd_barang_keluar'=>$this->model_app->getKodePenjualan(),
            'data_barang'=>$this->model_app->getBarangJual(),
            'data_pelanggan'=>$this->model_app->getAllData('tbl_pelanggan'),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_tambah_barang_keluar');
        $this->load->view('element/v_footer');
    }

    function detail_penjualan(){
        $id= $this->uri->segment(3);
        $data=array(
            'title'=>'Detail Barang Keluar',
            'active_b_keluar'=>'active',
            'dt_penjualan'=>$this->model_app->getDataPenjualan($id),
            'barang_jual'=>$this->model_app->getBarangPenjualan($id),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_detail_penjualan');
        $this->load->view('element/v_footer');
    }

    function get_detail_barang(){
        $id['kd_barang']=$this->input->post('kd_barang');
        $data=array(
            'detail_barang'=>$this->model_app->getSelectedData('tbl_barang',$id)->result(),
        );
        $this->load->view('pages/ajax_detail_barang',$data);
    }

    function get_detail_pelanggan(){
        $id['kd_pelanggan']=$this->input->post('kd_pelanggan');
        $data=array(
            'detail_pelanggan'=>$this->model_app->getSelectedData('tbl_pelanggan',$id)->result(),
        );
        $this->load->view('pages/ajax_detail_pelanggan',$data);
    }

//    INSERT DATA
    function tambah_penjualan_to_cart(){
        $data = array(
            'id'    => $this->input->post('kd_barang'),
            'qty'   => $this->input->post('qty'),
            'price' => $this->input->post('harga'),
            'name'  => $this->input->post('nm_barang'),
        );
        $this->cart->insert($data);
        redirect('b_keluar/tambah_barang_keluar');
    }

    function simpan_barang_keluar(){
        $data = array(
            'kd_barang_keluar'=>$this->input->post('kd_barang_keluar'),
            'kd_pelanggan'=>$this->input->post('kd_pelanggan'),
            'total_harga'=>$this->input->post('total_harga'),
            'tanggal_penjualan'=>date("Y-m-d",strtotime($this->input->post('tanggal_penjualan'))),
            'kd_pegawai'=>$this->session->userdata('ID'),
        );
        $this->model_app->insertData("tbl_penjualan_header",$data);

        foreach($this->cart->contents() as $items){
            $kd_barang = $items['id'];
            $qty = $items['qty'];
            $data_detail = array(
                'kd_barang_keluar' => $this->input->post('kd_barang_keluar'),
                'kd_barang'=> $kd_barang,
                'qty'=>$qty,
            );
            $this->model_app->insertData("tbl_penjualan_detail",$data_detail);

            $update['stok'] = $this->model_app->getKurangStok($kd_barang,$qty);
            $key['kd_barang'] = $kd_barang;
            $this->model_app->updateData("tbl_barang",$update,$key);
        }
        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
        redirect('b_keluar');
    }


//    DELETE
    function hapus_barang(){
        $id= $this->uri->segment(3);
        $bc=$this->model_app->getSelectedData("tbl_penjualan_header",$id);
        foreach($bc->result() as $dph){
            $sess_data['kd_barang_keluar'] = $dph->kd_barang_keluar;
            $this->session->set_userdata($sess_data);
        }

        $kode = explode("/",$_GET['kode']);
        if($kode[0]=="tambah")
        {
            $data = array(
                'rowid' => $kode[1],
                'qty'   => 0
            );
            $this->cart->update($data);
        }
        else if($kode[0]=="edit")
        {
            $data = array(
                'rowid' => $kode[1],
                'qty'   => 0
            );
            $this->cart->update($data);
            $hps['kd_barang_keluar'] = $kode[2];
            $hps['kd_barang'] = $kode[3];
            $this->model_app->deleteData("tbl_penjualan_detail",$hps);

            $key_barang['kd_barang'] = $hps['kd_barang'];
            $d_u['stok'] = $kode[4]+$kode[5];
            $this->model_app->updateData("tbl_barang",$d_u,$key_barang);
        }
        redirect('b_keluar/pages_edit/'.$this->session->userdata('kd_barang_keluar'));
    }

    function hapus(){
        $hapus['kd_barang_keluar'] = $this->uri->segment(3);
        $q = $this->model_app->getSelectedData("tbl_penjualan_detail",$hapus);
        foreach($q->result() as $d){
            $d_u['stok'] = $this->model_app->getTambahStok($d->kd_barang,$d->qty);
            $key['kd_barang'] = $d->kd_barang;
            $this->model_app->updateData("tbl_barang",$d_u,$key);
        }
        $this->model_app->deleteData("tbl_penjualan_header",$hapus);
        $this->model_app->deleteData("tbl_penjualan_detail",$hapus);
        redirect('b_keluar');
    }
}
