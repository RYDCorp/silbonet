<!--========================= Content Wrapper ==============================-->
<div class="tabbable tabs-left">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tabBarang" data-toggle="tab"><strong>BARANG</strong></a></li>
        <li><a href="#tabPelanggan" data-toggle="tab"><strong>PELANGGAN</strong></a></li>
        <li><a href="#tabPegawai" data-toggle="tab"><strong>PEGAWAI</strong></a></li>
        <li><a href="#tabContact" data-toggle="tab"><strong>CONTACT</strong></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tabBarang">
            <?php $this->load->view('pages/v_tab_master_barang')?>
        </div>
        <div class="tab-pane" id="tabPelanggan">
            <?php $this->load->view('pages/v_tab_master_pelanggan')?>
        </div>
        <div class="tab-pane" id="tabPegawai">
            <?php $this->load->view('pages/v_tab_master_pegawai')?>
        </div>
        <div class="tab-pane" id="tabContact">
            <?php $this->load->view('pages/v_tab_master_contact')?>
        </div>
    </div>
</div>