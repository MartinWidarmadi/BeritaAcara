<?php
if ($_SESSION['roles'] == "dosen") :
?>
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
    foreach($jadwal as $item) {
        echo '<tr>';
        echo '<td>' . $item->getIdMatkul()->getIdMataKuliah() . '</td>';
//        $date = date_create($item->getTanggalPertemuan());
//        echo '<td>' . date_format($date,"d/m/Y") . '</td>';
        echo '<td>' . $item->getIdMatkul()->getNamaMataKuliah() . '</td>';
        echo '<td>' . $item->getHari() . '</td>';
        echo '<td>' . $item->getType() . '</td>';
        echo '<td>' . $item->getKelas() . '</td>';
        echo '<td>' . $item->getIdSemester()->getNamaSemester() . '</td>';

        echo '<td>' . '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">
            Detail
        </button>'. '</td>';
//        echo '<td>' . $item->getWaktuMulai() . '</td>';
//        echo '<td>' . $item->getWaktuSelesai() . '</td>';

//        echo '<td>' . $item->getRangkuman() . '</td>';
//        echo '<td>' . $item->getJumlahMahasiswa() . '</td>';
//        if ($item->getFotoPresensi() == null || $item->getFotoPresensi() == '') {
//            echo '<td><img src="image/default_cover.svg" alt="Photo" style="max-width: 100px"></td>';
//        }   else {
//            echo '<td><img src="uploads/' . $item->getFotoPresensi() . '" alt="photo" style="max-width: 100px"></td>';
//        }
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
        foreach($jadwals as $item) {
            echo '<tr>';
            echo '<td>' . $item->getIdMatkul()->getIdMataKuliah() . '</td>';
            echo '<td>' . $item->getIdMatkul()->getNamaMataKuliah() . '</td>';
//            $date = date_create($item->getTanggalPertemuan());
//            echo '<td>' . date_format($date,"d/m/Y") . '</td>';
            echo '<td>' . $item->getNipDosen()->getNamaDosen() . '</td>';
            echo '<td>' . $item->getHari() . '</td>';
            echo '<td>' . $item->getType() . '</td>';
            echo '<td>' . $item->getKelas() . '</td>';
            echo '<td>' . $item->getIdSemester()->getNamaSemester() . '</td>';
            echo '<td>' . '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">
            Detail
        </button>'. '</td>';
//            echo '<td>' . $item->getWaktuMulai() . '</td>';
//            echo '<td>' . $item->getWaktuSelesai() . '</td>';

//            echo '<td>' . $item->getRangkuman() . '</td>';
//            echo '<td>' . $item->getJumlahMahasiswa() . '</td>';
//            if ($item->getFotoPresensi() == null || $item->getFotoPresensi() == '') {
//                echo '<td><img src="image/default_cover.svg" alt="Photo" style="max-width: 100px"></td>';
//            }   else {
//                echo '<td><img src="uploads/' . $item->getFotoPresensi() . '" alt="photo" style="max-width: 100px"></td>';
//            }
            echo '<td>'. '</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
        <thead>
        <tr></tr>
        </thead>
        <div class="modal fade" id="jadwal-<?= $index ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Berita Acara</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Continue</button>
                    </div>
                </div>
            </div>
        </div>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    </table>
<?php
endif;
    ?>
