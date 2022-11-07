<table class="table" id="example">
    <thead>
    <tr>
        <th scope="col">ID MK</th>
        <th scope="col">Mata Kuliah</th>
        <th scope="col">SKS</th>
        <th scope="col">Prodi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($mk as $item) {
        echo '<tr>';
        echo '<td>' . $item->getIdMataKuliah() . '</td>';
        echo '<td>' . $item->getNamaMataKuliah() . '</td>';
        echo '<td>' . $item->getSKS() . '</td>';
        echo '<td>' . $item->getIdProdi()->getNamaProdi() . '</td>';
    }
    ?>
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
                                    <option><?= $item->getNamaProdi(); ?></option>
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

