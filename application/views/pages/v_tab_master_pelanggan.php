<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Kode Pelanggan</th>
        <th>Nama Pelanggan</th>
        <th>Alamat</th>
        <th>Email</th>
        <th class="span2">
            <a href="#modalAddPelanggan" class="btn btn-mini btn-block btn-inverse" data-toggle="modal">
                <i class="icon-plus-sign icon-white"></i> Tambah Data
            </a>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    $no=1;
    if(isset($data_pelanggan)){
        foreach($data_pelanggan as $row){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row->kd_pelanggan; ?></td>
                <td><?php echo $row->nm_pelanggan; ?></td>
                <td><?php echo $row->alamat; ?></td>
                <td><?php echo $row->email; ?></td>
                <td>
                    <a class="btn btn-mini" href="#modalEditPelanggan<?php echo $row->kd_pelanggan?>" data-toggle="modal"><i class="icon-pencil"></i> Edit</a>
                    <a class="btn btn-mini" href="<?php echo site_url('master/hapus_pelanggan/'.$row->kd_pelanggan);?>"
                       onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a>
                </td>
            </tr>

        <?php }
    }
    ?>

    </tbody>
</table>

<!-- ============ MODAL ADD PELANGGAN =============== -->
<div id="modalAddPelanggan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Tambah Data Pelanggan</h3>
    </div>
    <form class="form-horizontal" method="post" action="<?php echo site_url('master/tambah_pelanggan')?>">
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label">Kode Pelanggan</label>
                <div class="controls">
                    <input name="kd_pelanggan" type="text" value="<?php echo $kd_pelanggan; ?>" readonly>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >Nama Pelanggan</label>
                <div class="controls">
                    <input name="nm_pelanggan" type="text" placeholder="Input Nama Pelanggan...">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >Alamat</label>
                <div class="controls">
                    <input name="alamat" type="text" placeholder="Input Alamat...">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                    <input name="email" type="email" placeholder="Input Email..." >
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>

<!-- ============ MODAL EDIT PELANGGAN =============== -->
<?php
if(isset($data_pelanggan)){
    foreach($data_pelanggan as $row){
        ?>
        <div id="modalEditPelanggan<?php echo $row->kd_pelanggan?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit Data Pelanggan</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('master/edit_pelanggan')?>">
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label">Kode Pelanggan</label>
                        <div class="controls">
                            <input name="kd_pelanggan" type="text" value="<?php echo $row->kd_pelanggan; ?>" readonly>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >Nama Pelanggan</label>
                        <div class="controls">
                            <input name="nm_pelanggan" type="text" value="<?php echo $row->nm_pelanggan; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >Alamat</label>
                        <div class="controls">
                            <input name="alamat" type="text" value="<?php echo $row->alamat; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="email" type="email" value="<?php echo $row->email; ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    <?php }
}
?>