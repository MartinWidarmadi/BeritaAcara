<div class="mt-3 mx-5">
<table class="table" id="example">
    <thead>
    <tr>
        <th scope="col">ID MK</th>
        <th scope="col">Mata Kuliah</th>
        <th scope="col">SKS</th>
        <th scope="col">Prodi</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($mk as $index => $item):
    ?>
        <tr>
            <td><?= $item->getIdMataKuliah(); ?></td>
            <td><?= $item->getNamaMataKuliah(); ?></td>
            <td><?= $item->getSKS(); ?></td>
            <td><?= $item->getIdProdi()->getNamaProdi(); ?></td>
            <td>
                <button class='btn btn-success' data-bs-toggle='modal' data-bs-target='#modaleditMatkul-<?=$index?>'>Edit </button>
                <button class="btn btn-danger" onclick="delMatkul('<?=$item->getIdMataKuliah();?>')">Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <thead>
    <tr></tr>
    </thead>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
</table>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add Mata Kuliah
</button>
</div>

<?php foreach ($mk as $index => $mk) { ?>
<div class="modal fade" id="modaleditMatkul-<?= $index ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit MataKuliah</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-group mt-3">
                        <label for="idMatkul" class="form-label">ID Matakuliah</label>
                        <input class="form-control" type="text" name="IDmatkul" placeholder="ID Mata Kuliah" id="idMatkul"
                               value="<?= $mk->getIdMataKuliah(); ?>" readonly>
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
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btnSubmit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add MataKuliah</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <input class="form-control" type="text" name="IDmatkul" placeholder="ID Mata Kuliah">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="matkul" placeholder="Nama Mata Kuliah">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="sks" placeholder="Jumlah SKS">
                        </div>
                        <div class="form-group">
                            <select name="prodi" id="prodi" class="form-select">
                                <option selected>Pilih prodi</option>
                                <?php
                                foreach ($prodis as $item):
                                    ?>
                                    <option value="<?= $item->getIdProdi();?>"><?= $item->getNamaProdi(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="addMatkul">Add MataKuliah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const editMatkul = (id) => {
        window.location = `index.php?menu=editmatkul&mid=${id}`;
    }
    
    const delMatkul = (id) => {
        let confirmed = confirm('Are you sure delete this data?');
        if (confirmed) {
            window.location = `index.php?menu=matkul&delcom=1&mid=${id}`;
        }
    }
</script>

