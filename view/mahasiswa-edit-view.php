<form method="post">
    <div class="form-group mt-3">
        <label for="NRP" class="form-label">NRP</label>
        <input class="form-control" type="text" name="nrp" placeholder="NRP" id="nrp"
               value="<?php $mahasiswa->getNRP(); ?>" required>
    </div>
    <div class="form-group">
        <label for="nama" class="form-label">Nama</label>
        <input class="form-control" type="text" name="nama" placeholder="Nama " id="nama"
               value="<?php $mahasiswa->getNama(); ?>" required>
    </div>
    <div class="form-group">
        <label for="alamat" class="form-label">Alamat</label>
        <input class="form-control" type="text" name="alamat" placeholder="Alamat" id="alamat"
               value="<?php $mahasiswa->getAlamat(); ?>" required>
    </div>
    <div class="form-group">
        <label for="no_tlp" class="form-label">No Telepon</label>
        <input class="form-control" type="text" name="no_tlp" placeholder="No Telepon" id="no_tlp"
               value="<?php $mahasiswa->getNoTlp(); ?>" required>
    </div>
    <div class="form-group">
        <button type="submit" name="btnBack" class="btn btn-primary">&larr;</button>
        <button type="submit" name="btnSubmit" class="btn btn-primary">Update</button>
    </div>
</form>