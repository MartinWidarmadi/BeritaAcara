<?php
if ($_SESSION['roles'] == "dosen") :
    ?>
    <div class="mt-3 mx-5">
        <table class="table" id="example">
            <thead>
            <tr>
                <th scope="col">NRP</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">No HP</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($mahasiswa as $item) {
                echo '<tr>';
                echo '<td>' . $item->getNRP() . '</td>';
                echo '<td>' . $item->getNama() . '</td>';
                echo '<td>' . $item->getAlamat() . '</td>';
                echo '<td>' . $item->getNoTlp() . '</td>';
                if ($item->getStatus() == 0){
                    echo '<td>' . "Non Aktif". '</td>';
                } else{
                    echo '<td>' . "Aktif". '</td>';
                }
            }
            ?>
            </tbody>
            <thead>
            </thead>
            <link rel="stylesheet" type="text/css"
                  href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css"/>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
        </table>
    </div>
<?php
else :
    ?>
    <div class="mt-3 mx-5">
        <table class="table" id="example">
            <thead>
            <tr>
                <th scope="col">NRP</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">No HP</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($mahasiswa as $index => $item) {
                echo '<tr>';
                echo '<td>' . $item->getNRP() . '</td>';
                echo '<td>' . $item->getNama() . '</td>';
                echo '<td>' . $item->getAlamat() . '</td>';
                echo '<td>' . $item->getNoTlp() . '</td>';
                if ($item->getStatus() == 0) {
                    echo "<td> <button class='btn btn-success'  data-bs-toggle='modal' data-bs-target='#modaleditMahasiswa-$index'>Edit </button >
<button class='btn btn-primary' onclick = 'activeMahasiswa(" . $item->getNRP() . ",0)' > Non-aktif</button >
<button class='btn btn-danger' onclick = 'deleteMahasiswa(" . $item->getNRP() . ")' > Delete</button >

        </td > ";
                } else {
                    echo "<td> <button class='btn btn-success'  data-bs-toggle='modal' data-bs-target='#modaleditMahasiswa-$index'>Edit </button >
<button class='btn btn-primary' onclick = 'activeMahasiswa(" . $item->getNRP() . ",1)' > Aktif</button >
        
        </td > ";
                }
            }
            ?>
            </tbody>
            <thead>
            </thead>
            <link rel="stylesheet" type="text/css"
                  href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css"/>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
        </table>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Mahasiswa
        </button>
    </div>

    <?php foreach ($mahasiswa as $index => $item) { ?>
    <div class="modal fade" id="modaleditMahasiswa-<?= $index ?>" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaleditLabel">Edit Mahasiswa</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">

                        <div class="form-group mt-3">
                            <label for="nrp" class="form-label">NRP</label>
                            <input class="form-control" type="text" name="nrps" placeholder="NRP" id="nrp"
                                   value="<?php echo $item->getNRP(); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control" type="text" name="namas" placeholder="Nama " id="nama"
                                   value="<?php echo $item->getNama(); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input class="form-control" type="text" name="alamats" placeholder="Alamat" id="alamat"
                                   value="<?php echo $item->getAlamat(); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="no_tlp" class="form-label">No Telepon</label>
                            <input class="form-control" type="text" name="no_tlps" placeholder="No Telepon" id="no_tlp"
                                   value="<?php echo $item->getNoTlp(); ?>" required>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Mahasiswa</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">

                        <div class="row">
                            <div class="form-group">
                                <input class="form-control" type="text" name="nrp" placeholder="NRP">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="nama" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="alamat" placeholder="Alamat">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="notelp" placeholder="No HP">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addMahasiswa">Add Mahasiswa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        const activeMahasiswa = (id, aktif) => {
            let confirmed = confirm('Are you sure deactivate this data ? ');
            if (confirmed) {
                window.location = `index.php?menu=mahasiswa&delcom=1&mid=${id}&aktif=${aktif}`;
            }
        }

        const deleteMahasiswa = (id) => {
            let confirmed = confirm('Are you sure delete this data ? ');
            if (confirmed) {
                window.location = `index.php?menu=mahasiswa&delcom=2&mid=${id}`;
            }
        }

    </script>
<?php
endif; ?>
