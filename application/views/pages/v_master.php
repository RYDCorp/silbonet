
    <!--========================= Content Wrapper ==============================-->
<section class="content">
          <!-- COLOR PALETTE -->
          <div class='box box-default color-palette-box'>
            <div class='box-header with-border'>
              <h3 class='box-title'><i class="fa fa-tag"></i> Master Data</h3>
            </div>

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
        <li class="active"><a href="#tabBarang" data-toggle="tab"><strong>BARANG</strong></a></li>
        <li><a href="#tabPelanggan" data-toggle="tab"><strong>CLIENT</strong></a></li>
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