<?php
if ($_SESSION['roles'] == "dosen") :
?>
<table class="table" id="example">
    <thead>
    <tr>
        <th scope="col">Code Kelas</th>
        <th scope="col">Mata Kuliah</th>
        <th scope="col">Hari</th>
        <th scope="col">Jam Mulai</th>
        <th scope="col">Jam Selesai</th>
        <th scope="col">Tipe</th>
        <th scope="col">Kelas</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($jadwal as $item) {
        echo '<tr>';
        echo '<td>' . $item->getKodeKelas() . '</td>';
        echo '<td>' . $item->getIdMatkul()->getNamaMataKuliah() . '</td>';
        echo '<td>' . $item->getHari() . '</td>';
        echo '<td>' . $item->getJamAwal() . '</td>';
        echo '<td>' . $item->getJamAkhir() . '</td>';
        echo '<td>' . $item->getType() . '</td>';
        echo '<td>' . $item->getKelas() . '</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
    <thead>
    <tr></tr>
    </thead>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
</table>

<?php
else :
?>
    <form method="post" action="">
        <div class="form-group">
            <label for="Dosen" class="form-label">Nama Dosen</label>
            <select class="form-select" id="dosen" name="dosen" aria-label="Default select example">
                <option selected value="0">Pilih</option>
                <?php foreach($dosen as $item):?>
                    <option><?=  $item->getNamaDosen(); ?></option>
                <?php endforeach; ?>

            </select>
            <label for="Matkul" class="form-label">Mata Kuliah</label>
            <select class="form-select" id="matkul" name="matkul" aria-label="Default select example">
                <option selected value="0">Pilih</option>
                <?php foreach($matkul as $item):?>
                    <option><?=  $item->getNamaMataKuliah(); ?></option>
                <?php endforeach; ?>
            </select>
            <label for="Tipe" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" aria-label="Default select example">
                <option selected value="0">Pilih</option>
                <option value="teori">Teori</option>
                <option value="praktikum">Praktikum</option>
            </select>
            <label for="Kelas" class="form-label">Kelas</label>
            <select class="form-select" id="kelas" name="kelas" aria-label="Default select example">
                <option selected value="0">Pilih</option>
                <option value="a">A</option>
                <option value="b">B</option>
            </select>
        </div>
        <br>
        <div class="form-group">
            <input type="submit" value="Submit Data" name="btnSubmit" class="btn btn-primary">
        </div>
        <br>
    </form>
    <table class="table" id="example">
        <thead>
        <tr>
            <th scope="col">Nama Dosen</th>
            <th scope="col">Code Kelas</th>
            <th scope="col">Mata Kuliah</th>
            <th scope="col">Hari</th>
            <th scope="col">Jam Mulai</th>
            <th scope="col">Jam Selesai</th>
            <th scope="col">Tipe</th>
            <th scope="col">Kelas</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($jadwals as $item) {
            echo '<tr>';
            echo '<td>' . $item->getNipDosen()->getNamaDosen() . '</td>';
            echo '<td>' . $item->getKodeKelas() . '</td>';
            echo '<td>' . $item->getIdMatkul()->getNamaMataKuliah() . '</td>';
            echo '<td>' . $item->getHari() . '</td>';
            echo '<td>' . $item->getJamAwal() . '</td>';
            echo '<td>' . $item->getJamAkhir() . '</td>';
            echo '<td>' . $item->getType() . '</td>';
            echo '<td>' . $item->getKelas() . '</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
        <thead>
        <tr></tr>
        </thead>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    </table>
<?php
endif; ?>