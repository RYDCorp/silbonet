<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Kode Pegawai</th>
        <th>User ID</th>
        <th>Nama Pegawai</th>
        <th>Level</th>
        <th class="span2">
            <a href="#modalAddPegawai" class="btn btn-mini btn-block btn-inverse" data-toggle="modal">
                <i class="icon-plus-sign icon-white"></i> Tambah Data
            </a>

<!--            <a href="#" class="btn btn-mini btn-block btn-inverse disabled" data-toggle="modal">-->
<!--                <i class="icon-plus-sign icon-white"></i> Tambah Data-->
<!--            </a>-->
        </th>
    </tr>
    </thead>
    <tbody>

    <?php
    $no=1;
    if(isset($data_pegawai)){
        foreach($data_pegawai as $row){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row->kd_pegawai; ?></td>
                <td><?php echo $row->username; ?></td>
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->level; ?></td>

                <td>
                    <a class="btn btn-mini" href="#modalEditPegawai<?php echo $row->kd_pegawai?>" data-toggle="modal"><i class="icon-pencil"></i> Edit</a>
                    <a class="btn btn-mini" href="<?php echo site_url('master/hapus_pegawai/'.$row->kd_pegawai);?>"
                       onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a>

<!--                    <a class="btn btn-mini disabled" href="#" data-toggle="modal"><i class="icon-pencil"></i> Edit</a>-->
<!--                    <a class="btn btn-mini disabled" href="#"> <i class="icon-remove"></i> Hapus</a>-->
                </td>

            </tr>

        <?php }
    }
    ?>

    </tbody>
</table>

<!-- ============ MODAL ADD PEGAWAI =============== -->
<div id="modalAddPegawai" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Tambah Data Pegawai</h3>
    </div>
    <form class="form-horizontal" method="post" action="<?php echo site_url('master/tambah_pegawai')?>">
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label">Kode Pegawai</label>
                <div class="controls">
                    <input name="kd_pegawai" type="text" value="<?php echo $kd_pegawai; ?>" readonly>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >User ID</label>
                <div class="controls">
                    <input name="username" type="text" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >Password</label>
                <div class="controls">
                    <input name="password" type="password" required>
                </div>
            </div>

            <hr/>

            <div class="control-group">
                <label class="control-label">Nama Pegawai</label>
                <div class="controls">
                    <input name="nama" type="text">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Level</label>
                <div class="controls">
                    <select name="level" id="level">
                        <option value=""> = Pilih Level Akses = </option>
                        <option value="pegawai">Pegawai</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>


<!-- ============ MODAL EDIT PEGAWAI =============== -->
<?php
if (isset($data_pegawai)){
    foreach($data_pegawai as $row){
        ?>
        <div id="modalEditPegawai<?php echo $row->kd_pegawai?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit Data Pegawai</h3>
            </div>

            <form class="form-horizontal" method="post" action="<?php echo site_url('master/edit_pegawai')?>">
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label">Kode Pegawai</label>
                        <div class="controls">
                            <input name="kd_pegawai" type="text" value="<?php echo $row->kd_pegawai; ?>" class="uneditable-input" readonly="true">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >User ID</label>
                        <div class="controls">
                            <input name="username" type="text" value="<?php echo $row->username?>" required>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >Password</label>
                        <div class="controls">
                            <input name="password" type="password" required>
                        </div>
                    </div>

                    <hr/>

                    <div class="control-group">
                        <label class="control-label">Nama Pegawai</label>
                        <div class="controls">
                            <input name="nama" type="text" value="<?php echo $row->nama?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Level</label>
                        <div class="controls">
                            <select name="level" id="level">
                                <?php if($row->level == 'admin'){?>
                                    <option value="admin" selected="selected">Admin</option>
                                <?php }else{ ?>
                                    <option value="pegawai">Pegawai</option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    <?php }
}
?>