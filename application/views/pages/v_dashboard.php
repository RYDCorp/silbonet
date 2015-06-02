<!--========================= Content Wrapper ==============================-->
    <link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css')?>"/>
<section class="content">
          <!-- COLOR PALETTE -->
          <div class='box box-default color-palette-box'>
            <div class='box-header with-border'>
              <h3 class='box-title'><i class="fa fa-tag"></i> <?php echo $title?></h3>
            </div>
 <div class='box-body'>
              <div class='row'>
                <div class='col-sm-4 col-md-2'>
     <h1 class="text-info" style="text-align: center">Sistem Informasi Logistik</h1>
    <br/>
<?php if(isset($dt_contact)){
foreach($dt_contact as $row){
?>
    <div class="row well" style="text-align: center">
        <h3><?php echo $row->nama?></h3>
        <h4><?php echo $row->desc?></h4>
        <h5 class="muted"><?php echo $row->alamat?></h5>
        <h5 class="muted"><?php echo $row->email?> || <?php echo $row->telp?> || <?php echo $row->website?></h5>
</div>
</div>
    </div>
<?php }
}
?>
</div>


