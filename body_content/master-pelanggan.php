<div id="formPelanggan" style="display:none;">
    <div  class="card" style="margin-bottom:2em;">
        <form onsubmit="return submitFormPelanggan()">
            <input type="hidden" id="id_pelanggan" name="id_pelanggan">
            <div class="card-header">Form Pelanggan</div>
            <div class="card-body">
                <div class="row">
                    <div class="col form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="username" readonly>
                    </div>
                    <div class="col form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <label for="noalat">No.Alat</label>
                        <input type="text" class="form-control" id="noalat" name="noalat" placeholder="No Alat" readonly>
                    </div>
                    <div class="col form-group">
                        <label for="daya">Daya</label>
                        <select  class="form-control" id="daya" name="daya">
                            <?php foreach ($getTarif as $row) { ?>
                                <option value="<?=$row['id_tarif']?>"><?=$row['daya']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" readonly>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col"><span class="btn btn-outline-danger btn-block" onclick="clearFormPelanggan()">Tutup</span></div>
                    <div class="col"><button class="btn btn-outline-success btn-block">Submit</button></div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include_once('body_content/component/table-list.php'); ?>