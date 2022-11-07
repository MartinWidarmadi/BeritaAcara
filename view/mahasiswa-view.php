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
    foreach($mahasiswa as $item) {
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
</table>
<form method="post">
    <div class="form-group">
        <input type="submit" value="Add Mahasiswa" name="btnSubmit" class="btn btn-primary">
    </div>
</form>

