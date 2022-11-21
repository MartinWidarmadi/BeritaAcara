<form method="post">
    <div class="form-group mt-3">
        <label for="idMatkul" class="form-label">ID Matakuliah</label>
        <input class="form-control" type="text" name="IDmatkul" placeholder="ID Mata Kuliah" id="idMatkul"
               value="<?= $mk->getIdMataKuliah(); ?>" required>
    </div>
    <div class="form-group">
        <label for="namaMatkul" class="form-label">Nama Matakuliah</label>
        <input class="form-control" type="text" name="namaMatkul" placeholder="Nama Mata Kuliah" id="namaMatkul"
               value="<?= $mk->getNamaMataKuliah(); ?>" required>
    </div>
    <div class="form-group">
        <label for="sks" class="form-label">Sks</label>
        <input class="form-control" type="text" name="sks" placeholder="Jumlah SKS" id="sks"
               value="<?= $mk->getSKS(); ?>" required>
    </div>
    <div class="form-group">
        <label for="prodi" class="form-label">Prodi</label>
        <select name="prodi" id="prodi" class="form-select" required>
            <option value="">Pilih prodi</option>
            <?php
            foreach ($prodis as $item):
                if ($item->getIdProdi() == $mk->getIdProdi()):
                    ?>
                    <option value="<?= $item->getIdProdi(); ?>" selected><?= $item->getNamaProdi(); ?></option>
                <?php else: ?>
                    <option value="<?= $item->getIdProdi(); ?>"><?= $item->getNamaProdi(); ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <button type="submit" name="btnBack" class="btn btn-primary">&larr;</button>
        <button type="submit" name="btnSubmit" class="btn btn-primary">Update</button>
    </div>
</form>