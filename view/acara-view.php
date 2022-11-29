<?php
if ($_SESSION['roles'] == "dosen") :
?>
<div class="mt-3 mx-5">
<table class="table" id="example">
    <thead>
    <tr>
        <th scope="col">Id MK</th>
        <th scope="col">Mata Kuliah</th>
        <th scope="col">Hari</th>
        <th scope="col">Tipe</th>
        <th scope="col">Kelas</th>
        <th scope="col">Semester</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($jadwal as $index => $item) {
        echo '<tr>';
        echo '<td>' . $item->getIdMatkul()->getIdMataKuliah() . '</td>';
        echo '<td>' . $item->getIdMatkul()->getNamaMataKuliah() . '</td>';
        echo '<td>' . $item->getHari() . '</td>';
        echo '<td>' . $item->getType() . '</td>';
        echo '<td>' . $item->getKelas() . '</td>';
        echo '<td>' . $item->getIdSemester()->getNamaSemester() . '</td>';

        echo "<td><button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#jadwals-$index'>Detail</button></td>";
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
</div>
    <?php foreach ($jadwal as $index => $jadwalz) { ?>
    <div class="modal fade" id="jadwals-<?= $index ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Berita Acara</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table class="table" id="example">
                        <thead>
                        <tr>
                            <th scope="col">Pertemuan</th>
                            <th scope="col">Tanggal Pertemuan</th>
                            <th scope="col">Waktu Mulai</th>
                            <th scope="col">Waktu Selesai</th>
                            <th scope="col">Rangkuman</th>
                            <th scope="col">Nama Assisten</th>
                            <th scope="col">Jumlah Jam Assisten</th>
                            <th scope="col">Jumlah Mahasiswa</th>
                            <th scope="col">Foto Presensi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($array_jadwal[$jadwalz->getIdJadwal()] as $index => $item ) {
                            echo '<tr>';
                            echo '<td>' . $item->getPertemuan() . '</td>';
                            $date = date_create($item->getTanggalPertemuan());
                            echo '<td>' . date_format($date,"d/m/Y") . '</td>';

                            echo '<td>' . $item->getWaktuMulai() . '</td>';
                            echo '<td>' . $item->getWaktuSelesai() . '</td>';

                            echo '<td>' . $item->getRangkuman() . '</td>';
                            foreach ($array_assisten[$jadwalz->getIdJadwal()] as $index => $item2) {
                                echo '<td>' . $item2->getNrpMahasiswa()->getNama() . '</td>';
                                echo '<td>' . $item2->getJumlahJam() . " Jam" . '</td>';
                            }
                            echo '<td>' . $item->getJumlahMahasiswa() . '</td>';
                            if ($item->getFotoPresensi() == null || $item->getFotoPresensi() == '') {
                                echo '<td><img src="image/default_cover.svg" alt="Photo" style="max-width: 100px"></td>';
                            }   else {
                                echo '<td><img src="uploads/' . $item->getFotoPresensi() . '" alt="photo" style="max-width: 100px"></td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                        <thead>
                        <tr></tr>
                        </thead>
                    </table>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php
else:
?>
<div class="mt-3 mx-5">
    <table class="table" id="example">
        <thead>
        <tr>
            <th scope="col">Id MK</th>
            <th scope="col">Mata Kuliah</th>
            <th scope="col">Nama Dosen</th>
            <th scope="col">Hari</th>
            <th scope="col">Tipe</th>
            <th scope="col">Kelas</th>
            <th scope="col">Semester</th>
            <th scope="col">Action</th>
<!--            <th scope="col">Waktu Mulai</th>-->
<!--            <th scope="col">Waktu Selesai</th>-->
<!--            <th scope="col">Tipe</th>-->
<!--            <th scope="col">Kelas</th>-->
<!--            <th scope="col">Rangkuman</th>-->
<!--            <th scope="col">Jumlah Mahasiswa</th>-->
<!--            <th scope="col">Foto Presensi</th>-->
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($jadwals as $index => $item) {
            echo '<tr>';
            echo '<td>' . $item->getIdMatkul()->getIdMataKuliah() . '</td>';
            echo '<td>' . $item->getIdMatkul()->getNamaMataKuliah() . '</td>';
            echo '<td>' . $item->getNipDosen()->getNamaDosen() . '</td>';
            echo '<td>' . $item->getHari() . '</td>';
            echo '<td>' . $item->getType() . '</td>';
            echo '<td>' . $item->getKelas() . '</td>';
            echo '<td>' . $item->getIdSemester()->getNamaSemester() . '</td>';
            echo "<td><button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#jadwal-$index'>Detail</button></td>";
            echo '</tr>';
        }
        ?>
        </tbody>
        <thead>
        <tr></tr>
        </thead>
    </table>
</div>
        <?php foreach ($jadwals as $index => $jadwal) { ?>
        <div class="modal fade" id="jadwal-<?= $index ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Berita Acara</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th scope="col">Pertemuan</th>
                                <th scope="col">Tanggal Pertemuan</th>
                                <th scope="col">Waktu Mulai</th>
                                <th scope="col">Waktu Selesai</th>
                                <th scope="col">Rangkuman</th>
                                <th scope="col">Nama Assisten</th>
                                <th scope="col">Jumlah Jam Assisten</th>
                                <th scope="col">Jumlah Mahasiswa</th>
                                <th scope="col">Foto Presensi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($array_jadwals[$index] as $i => $item) {
                                echo '<tr>';
                                echo '<td>' . $item->getPertemuan() . '</td>';
                                $date = date_create($item->getTanggalPertemuan());
                                echo '<td>' . date_format($date,"d/m/Y") . '</td>';

                                echo '<td>' . $item->getWaktuMulai() . '</td>';
                                echo '<td>' . $item->getWaktuSelesai() . '</td>';
                                echo '<td>' . $item->getRangkuman() . '</td>';
                                echo '<td>' . $array_assistens[$index][$i]->getNrpMahasiswa()->getNama() . '</td>';
                                echo '<td>' . $array_assistens[$index][$i]->getJumlahJam() . " Jam" . '</td>';
                                echo '<td>' . $item->getJumlahMahasiswa() . '</td>';
                                if ($item->getFotoPresensi() == null || $item->getFotoPresensi() == '') {
                                    echo '<td><img src="image/default_cover.svg" alt="Photo" style="max-width: 100px"></td>';
                                }   else {
                                    echo '<td><img src="uploads/' . $item->getFotoPresensi() . '" alt="photo" style="max-width: 100px"></td>';
                                }
                                echo '</tr>';
                            }
                            ?>
                            </tbody>
                            <thead>
                            <tr></tr>
                            </thead>
                        </table>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>


<?php
endif;
    ?>
