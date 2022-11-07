<?php
if ($_SESSION['roles'] == "dosen") :
    ?>
    <table class="table" id="example">
        <thead>
        <tr>
            <th scope="col">NRP</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">No HP</th>
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
        }
        ?>
        </tbody>
        <thead>
        <tr></tr>
        </thead>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    </table>
<?php
else :
    ?>
    <table class="table" id="example">
        <thead>
        <tr>
            <th scope="col">NRP</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">No HP</th>
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
        Add Mahasiswa
    </button>
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
<?php
endif; ?>
