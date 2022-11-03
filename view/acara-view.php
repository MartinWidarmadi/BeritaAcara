<?php
if ($_SESSION['roles'] == "dosen") :
?>
<table class="table" id="example">
    <thead>
    <tr>
        <th scope="col">Pertemuan</th>
        <th scope="col">Tanggal Pertemuan</th>
        <th scope="col">Code Kelas</th>
        <th scope="col">Mata Kuliah</th>
        <th scope="col">Waktu Mulai</th>
        <th scope="col">Waktu Selesai</th>
        <th scope="col">Tipe</th>
        <th scope="col">Kelas</th>
        <th scope="col">Rangkuman</th>
        <th scope="col">Foto Presensi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($jadwal as $item) {
        echo '<tr>';
        echo '<td>' . $item->getPertemuan() . '</td>';
        echo '<td>' . $item->getTanggalPertemuan() . '</td>';
        echo '<td>' . $item->getKodeKelas() . '</td>';
        echo '<td>' . $item->getIdMatkul()->getNamaMataKuliah() . '</td>';
        echo '<td>' . $item->getWaktuMulai() . '</td>';
        echo '<td>' . $item->getWaktuSelesai() . '</td>';
        echo '<td>' . $item->getType() . '</td>';
        echo '<td>' . $item->getKelas() . '</td>';
        echo '<td>' . $item->getRangkuman() . '</td>';
        if ($item->getFotoPresensi() == null || $item->getFotoPresensi() == '') {
            echo '<td><img src="image/default_cover.svg" alt="Photo" style="max-width: 100px"></td>';
        }   else {
            echo '<td><img src="uploads/' . $item->getFotoPresensi() . '" alt="photo" style="max-width: 100px"></td>';
        }
        echo '<td>'. '</td>';
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
else:
?>
    <table class="table" id="example">
        <thead>
        <tr>
            <th scope="col">Pertemuan</th>
            <th scope="col">Tanggal Pertemuan</th>
            <th scope="col">NIP Dosen</th>
            <th scope="col">Code Kelas</th>
            <th scope="col">Mata Kuliah</th>
            <th scope="col">Waktu Mulai</th>
            <th scope="col">Waktu Selesai</th>
            <th scope="col">Tipe</th>
            <th scope="col">Kelas</th>
            <th scope="col">Rangkuman</th>
            <th scope="col">Foto Presensi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($jadwals as $item) {
            echo '<tr>';
            echo '<td>' . $item->getPertemuan() . '</td>';
            echo '<td>' . $item->getTanggalPertemuan() . '</td>';
            echo '<td>' . $item->getNipDosen()->getNamaDosen() . '</td>';
            echo '<td>' . $item->getKodeKelas() . '</td>';
            echo '<td>' . $item->getIdMatkul()->getNamaMataKuliah() . '</td>';
            echo '<td>' . $item->getWaktuMulai() . '</td>';
            echo '<td>' . $item->getWaktuSelesai() . '</td>';
            echo '<td>' . $item->getType() . '</td>';
            echo '<td>' . $item->getKelas() . '</td>';
            echo '<td>' . $item->getRangkuman() . '</td>';
            if ($item->getFotoPresensi() == null || $item->getFotoPresensi() == '') {
                echo '<td><img src="image/default_cover.svg" alt="Photo" style="max-width: 100px"></td>';
            }   else {
                echo '<td><img src="uploads/' . $item->getFotoPresensi() . '" alt="photo" style="max-width: 100px"></td>';
            }
            echo '<td>'. '</td>';
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
endif;
    ?>
