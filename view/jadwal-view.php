<?php
if ($_SESSION['roles'] == "dosen") :
?>
<table class="table" id="example">
    <thead>
    <tr>
        <th scope="col">ID MK</th>
        <th scope="col">Mata Kuliah</th>
        <th scope="col">Hari</th>
        <th scope="col">Jam Mulai</th>
        <th scope="col">Jam Selesai</th>
        <th scope="col">Tipe</th>
        <th scope="col">Kelas</th>
        <th scope="col">Semester</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($jadwal as $item) {
        echo '<tr>';
        echo '<td>' . $item->getIdMatkul()->getIdMataKuliah() . '</td>';
        echo '<td>' . $item->getIdMatkul()->getNamaMataKuliah() . '</td>';
        echo '<td>' . $item->getHari() . '</td>';
        echo '<td>' . $item->getJamAwal() . '</td>';
        echo '<td>' . $item->getJamAkhir() . '</td>';
        echo '<td>' . $item->getType() . '</td>';
        echo '<td>' . $item->getKelas() . '</td>';
        echo '<td>' . $item->getIdSemester()->getNamaSemester() . '</td>';
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
                    <option value="<?= $item->getNIP();?>"><?=  $item->getNamaDosen(); ?></option>
                <?php endforeach; ?>

            </select>
            <label for="Matkul" class="form-label">Mata Kuliah</label>
            <select class="form-select" id="matkul" name="matkul" aria-label="Default select example">
                <option selected value="0">Pilih</option>
                <?php foreach($matkul as $item):?>
                    <option value="<?= $item->getIdMataKuliah();?>"><?=  $item->getNamaMataKuliah(); ?></option>
                <?php endforeach; ?>
            </select>
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" aria-label="Default select example">
                <option selected value="0">Pilih</option>
                <option value="Teori">Teori</option>
                <option value="Praktikum">Praktikum</option>
            </select>
            <label for="kelas" class="form-label">Kelas</label>
            <select class="form-select" id="kelas" name="kelas" aria-label="Default select example">
                <option selected value="0">Pilih</option>
                <option value="A">A</option>
                <option value="B">B</option>
            </select>

            <label for="hari" class="form-label">Hari</label>
            <select name="hari" id="hari" class="form-select">
                <option value="0" selected>Pilih</option>
                <option value="Senin" >Senin</option>
                <option value="Selasa" >Selasa</option>
                <option value="Rabu" >Rabu</option>
                <option value="Kamis" >Kamis</option>
                <option value="Jumat" >Jumat</option>
            </select>

            <label for="jamMulai" class="form-label">Jam Mulai dan Jam Selesai</label>
            <div class="d-flex ">
                    <input type="time" name="jamMulai" id="jamMulai" class="form-control w-100">

                    <input type="time" name="jamSelesai" id="jamSelesai" class="form-control">
            </div>

            <label for="semester" class="form-label">Semester</label>
            <select name="semester" id="semester" class="form-select">
                <option value="0" selected>Pilih</option>
                <?php 
                foreach ($semester as $item):
                ?>
                <option value="<?= $item->getIdSemester();?>"><?= $item->getNamaSemester(); ?></option>
                <?php endforeach; ?>
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
            <th scope="col">Id MK</th>
            <th scope="col">Mata Kuliah</th>
            <th scope="col">Hari</th>
            <th scope="col">Jam Mulai</th>
            <th scope="col">Jam Selesai</th>
            <th scope="col">Tipe</th>
            <th scope="col">Kelas</th>
            <th scope="col">Semester</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($jadwals as $item) {
            echo '<tr>';
            echo '<td>' . $item->getNipDosen()->getNamaDosen() . '</td>';
            echo '<td>' . $item->getIdMatkul()->getIdMataKuliah() . '</td>';
            echo '<td>' . $item->getIdMatkul()->getNamaMataKuliah() . '</td>';
            echo '<td>' . $item->getHari() . '</td>';
            echo '<td>' . $item->getJamAwal() . '</td>';
            echo '<td>' . $item->getJamAkhir() . '</td>';
            echo '<td>' . $item->getType() . '</td>';
            echo '<td>' . $item->getKelas() . '</td>';
            echo '<td>' . $item->getIdSemester()->getNamaSemester() . '</td>';
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
    <form method="post">
        <div class="form-group">
            <input type="submit" value="Add Jadwal" name="btnSubmit" class="btn btn-primary">
        </div>
    </form>
<?php
endif; ?>