<!--================ Content Wrapper===========================================-->
<div class="well">
    <form>
        <label class="control-label">Kode Penjualan</label>
        <div class="controls">
            <input type="text" class="input-xlarge" value="<?php echo $kd_penjualan; ?>" readonly>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>penjualan</th>
                <th>Harga</th>
                <th>Subtotal</th>
                <th class="span3">
                    <a href="#modalAddPenjualanBarang" class="btn btn-inverse btn-block" data-toggle="modal">
                        <i class="icon-th icon-plus-sign icon-white"></i> Tambah Barang
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; $no=1;?>
            <?php foreach($this->cart->contents() as $items): ?>
                <?php echo form_hidden('rowid[]', $items['rowid']); ?>

                <tr class="gradeX">
                    <td><?php echo $no; ?></td>
                    <td><?php echo $items['id']; ?></td>
                    <td><?php echo $items['name']; ?></td>
                    <td><?php echo $items['qty']; ?></td>
                    <td>Rp. <?php echo $this->cart->format_number($items['price']); ?></td>
                    <td>Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
                    <td>
                        <a class="btn btn-mini btn-danger btn-block delbutton" href="#" class="delbutton"
                           id="<?php echo 'tambah/'.$items['rowid'].'/'.$kd_penjualan.'/'.$items['id'].'/'.$items['qty']; ?>">
                            <i class="icon-trash icon-white"></i> Hapus Barang</a>
                    </td>
                </tr>

                <?php $i++; $no++;?>
            <?php endforeach; ?>
            </tbody>
        </table>

    </form>

    <form action="<?php echo site_url('penjualan/simpan_penjualan') ?>" method="post">
        <div class="row-fluid">
            <div class="span8">
                <div class="control-group">
                    <label class="control-label"> <strong>Daftar Pelanggan</strong></label>
                    <div class="controls">
                        <select id="kd_pelanggan" tabindex="5" class="chzn-select" name="kd_pelanggan" data-placeholder="Pilih Pelanggan">
                            <option value=""></option>
                            <?php
                            if(isset($data_pelanggan)){
                                foreach($data_pelanggan as $row){
                                    ?>
                                    <option value="<?php echo $row->kd_pelanggan?>"><?php echo $row->nm_pelanggan?></option>
                                <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div id="detail_pelanggan"></div>
            </div>
            <div class="span4 badge pull-right">
                <div class="control-group">
                    <label class="control-label" style="text-align: center"><h4>Total Harga</h4></label>
                    <div class="controls">
                        <input type="text" class="uneditable-input input-block-level"
                               value="Rp. <?php echo $this->cart->format_number($this->cart->total()); ?>">
                    </div>
                </div>

                <input type="hidden" name="kd_penjualan" value="<?= $kd_penjualan; ?>" readonly>
                <input type="hidden" name="total_harga" value="<?= $this->cart->total()?>">
                <input id="tanggal_penjualan" type="hidden" name="tanggal_penjualan" data-date-format="dd-mm-yyyy" value="<?php echo isset($date) ? $date : date('d-m-Y')?>" data-date="12-02-2012">

            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><i class="icon-ok-sign icon-white"></i> Save</button>
            <a href="<?php echo site_url('penjualan')?>" class="btn"><i class="icon-remove-sign"></i> Cancel</a>
        </div>
    </form>
</div>

<!-- ============ MODAL ADD PENJUALAN BARANG =============== -->
<div id="modalAddPenjualanBarang" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Tambah Barang</h3>
    </div>
    <form id="frm" name="frm"  method="post" action="<?php echo site_url('penjualan/tambah_penjualan_to_cart')?>">
        <div class="modal-body" style="min-height: 200px">
            <div class="control-group">
                <label class="control-label">Daftar Barang</label>
                <div class="controls">
                    <select id="kd_barang" class="chzn-select" name="kd_barang" data-placeholder="Pilih Barang">
                        <option value=""></option>
                        <?php
                        if(isset($data_barang)){
                            foreach($data_barang as $row){
                                ?>
                                <option value="<?php echo $row->kd_barang?>"><?php echo $row->nm_barang?></option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div id="detail_barang"></div>
        </div>

        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button type="submit" class="btn btn-primary" disabled="disabled" id="add" name="add">Simpan</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#kd_barang").change(function(){
            var kd_barang = $("#kd_barang").val();
            $.ajax({
                type: "POST",
                url : "<?php echo base_url('penjualan/get_detail_barang'); ?>",
                data: "kd_barang="+kd_barang,
                cache:false,
                success: function(data){
                    $('#detail_barang').html(data);
                    document.frm.add.disabled=false;
                }
            });
        });

        $("#kd_pelanggan").change(function(){
            var kd_pelanggan = $("#kd_pelanggan").val();
            $.ajax({
                type: "POST",
                url : "<?php echo base_url('penjualan/get_detail_pelanggan'); ?>",
                data: "kd_pelanggan="+kd_pelanggan,
                cache:false,
                success: function(data){
                    $('#detail_pelanggan').html(data);
                }
            });
        });

        $(".delbutton").click(function(){
            var element = $(this);
            var del_id = element.attr("id");
            var info = del_id;
            if(confirm("Anda yakin akan menghapus?"))
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>penjualan/hapus_penjualan",
                    data: "kode="+info,
                    cache: false,
                    success: function(){
                    }
                });
                $(this).parents(".gradeX").animate({ opacity: "hide" }, "slow");
            }
            return false;
        });

    })
</script>