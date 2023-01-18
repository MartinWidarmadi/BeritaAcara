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
                <th scope="col">Jumlah</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($jadwal as $index => $item) {
                echo '<tr>';
                echo '<td>' . $item->getIdMatkul()->getIdMataKuliah() . '</td>';
                echo '<td>' . $item->getIdMatkul()->getNamaMataKuliah() . '</td>';
                echo '<td>' . $item->getHari() . '</td>';
                echo '<td>' . $item->getType() . '</td>';
                echo '<td>' . $item->getKelas() . '</td>';
                echo '<td>' . $item->getIdSemester()->getNamaSemester() . '</td>';


                echo "<td><button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#jadwals-$index'>Detail</button></td>";
                echo '<td>' . count($array_jadwal[$index]) . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
            <thead>
            <tr></tr>
            </thead>
            <link rel="stylesheet" type="text/css"
                  href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css"/>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
        </table>
    </div>
    <?php foreach ($jadwal as $i => $jadwalz) { ?>
    <div class="modal fade" id="jadwals-<?= $i ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Berita Acara</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table class="table" id="example2">
                        <thead>
                        <tr>
                            <th scope="col">Pertemuan</th>
                            <th scope="col">Tanggal Pertemuan</th>
                            <th scope="col">Waktu Mulai</th>
                            <th scope="col">Waktu Selesai</th>
                            <th scope="col">Rangkuman</th>
                            <th scope="col">Nama Assisten 1 - Jumlah Jam</th>
                            <th scope="col">Nama Assisten 2 - Jumlah Jam</th>
                            <th scope="col">Nama Assisten 3 - Jumlah Jam</th>
                            <th scope="col">Jumlah Mahasiswa</th>
                            <th scope="col">Foto Presensi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($array_jadwal[$i] as $index => $item) {
                            echo '<tr>';
                            echo '<td>' . $item->getPertemuan() . '</td>';
                            $date = date_create($item->getTanggalPertemuan());
                            echo '<td>' . date_format($date, "d M Y") . '</td>';

                            echo '<td>' . $item->getWaktuMulai() . '</td>';
                            echo '<td>' . $item->getWaktuSelesai() . '</td>';

                            echo '<td>' . $item->getRangkuman() . '</td>';
                            if ($item->asisten != null && $item->asisten[0] != null) {
                                echo '<td>' . $item->asisten[0]->getNrpMahasiswa()->getNama() . ' - ' . $item->asisten[0]->getJumlahJam() . ' Jam' . '</td>';
                            } else {
                                echo '<td>' . '' . '</td>';
                            }

                            if ($item->asisten != null && $item->asisten[1] != null) {
                                echo '<td>' . $item->asisten[1]->getNrpMahasiswa()->getNama() . ' - ' . $item->asisten[1]->getJumlahJam() . ' Jam' . '</td>';
                            } else {
                                echo '<td>' . '' . '</td>';
                            }

                            if ($item->asisten != null && $item->asisten[2] != null) {
                                echo '<td>' . $item->asisten[2]->getNrpMahasiswa()->getNama() . ' - ' . $item->asisten[2]->getJumlahJam() . ' Jam' . '</td>';
                            } else {
                                echo '<td>' . '' . '</td>';
                            }

                            echo '<td>' . $item->getJumlahMahasiswa() . '</td>';
                            if ($item->getFotoPresensi() == null || $item->getFotoPresensi() == '') {
                                echo '<td><img src="image/default_cover.svg" alt="Photo" style="max-width: 100px"></td>';
                            } else {
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

    <div class="row" style="padding: 50px">
        <div class="col-2">
            <form method="post">
                <h5 class="fw-bold">FILTER</h5>
                <select class="form-select" id="filterSemester" name="filterSemester"
                        aria-label="Default select example" style="margin: 10px">
                    <?php
                    if (!isset($filSemester)) {
                        echo "<option selected value=>Semua Semester</option>";
                    } else {
                        echo '<option value=>Semua Semester</option>';
                    }
                    ?>
                    <?php foreach ($semester as $smstr):
                        if ($smstr->getIdSemester() == $filSemester){
                            echo"<option selected value='" . $smstr->getIdSemester() . "'>" .  $smstr->getNamaSemester() . "</option>";
                        } else{
                            echo"<option value='" . $smstr->getIdSemester() . "'>" .  $smstr->getNamaSemester() . "</option>";
                        }?>
                    <?php endforeach; ?>
                </select>
                <select class="form-select" id="filterDosen" name="filterDosen" aria-label="Default select example"
                        style="margin: 10px">
                    <?php
                    if (!isset($filDosen)){
                        echo "<option selected value=>Semua Dosen</option>";
                    }else{
                        echo '<option value=>Semua Dosen</option>';
                    }
                    ?>
                    <?php foreach ($dosen as $item):
                        if ($item->getNIP() == $filDosen){
                            echo"<option selected value='" . $item->getNIP() . "'>" .  $item->getNamaDosen() . "</option>";
                        } else{
                            echo"<option value='" . $item->getNIP() . "'>" .  $item->getNamaDosen() . "</option>";
                        }?>
                    <?php endforeach; ?>
                </select>
                <div style="margin: 10px">
                    <h6>FROM</h6>
                    <div style="margin: 10px">
                        <input type="date" name="calendar2" id="calendar2" class="form-control form-second">
                    </div>
                    <h6>UNTIL</h6>
                    <div style="margin: 10px">
                        <input type="date" name="calendar3" id="calendar3" class="form-control form-second">
                    </div>
                </div>

                <button type="submit" name="btnFilter" class="btn btn-success">Submit</button>
            </form>
        </div>
        <div class="col-10">
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
                    <th scope="col">Jumlah</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($jadwals as $index => $item) {
                    echo '<tr>';
                    echo '<td>' . $item->getIdMatkul()->getIdMataKuliah() . '</td>';
                    echo '<td>' . $item->getIdMatkul()->getNamaMataKuliah() . '</td>';
                    echo '<td>' . $item->getNipDosen()->getNamaDosen() . '</td>';
                    echo '<td>' . $item->getHari() . '</td>';
                    echo '<td>' . $item->getType() . '</td>';
                    echo '<td>' . $item->getKelas() . '</td>';
                    echo '<td>' . $item->getIdSemester()->getNamaSemester() . '</td>';
                    echo "<td><button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#jadwal-$index'>Detail</button></td>";
                    echo '<td>' . count($array_jadwals[$index]) . '</td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
                <thead>
                <tr></tr>
                </thead>
            </table>
        </div>
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
                    <table class="table" id="example2">
                        <thead>
                        <tr>
                            <th scope="col">Pertemuan</th>
                            <th scope="col">Tanggal Pertemuan</th>
                            <th scope="col">Waktu Mulai</th>
                            <th scope="col">Waktu Selesai</th>
                            <th scope="col">Rangkuman</th>
                            <th scope="col">Nama Assisten 1 - Jumlah Jam</th>
                            <th scope="col">Nama Assisten 2 - Jumlah Jam</th>
                            <th scope="col">Nama Assisten 3 - Jumlah Jam</th>
                            <th scope="col">Jumlah Mahasiswa</th>
                            <th scope="col">Foto Presensi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($array_jadwals[$index] as $i => $item) {
                            echo '<tr>';
                            echo '<td>' . $item->getPertemuan() . '</td>';
                            $date = date_create($item->getTanggalPertemuan());
                            echo '<td>' . date_format($date, "d M Y") . '</td>';

                            echo '<td>' . $item->getWaktuMulai() . '</td>';
                            echo '<td>' . $item->getWaktuSelesai() . '</td>';
                            echo '<td>' . $item->getRangkuman() . '</td>';
                            if ($item->asisten != null && $item->asisten[0] != null) {
                                echo '<td>' . $item->asisten[0]->getNrpMahasiswa()->getNama() . ' - ' . $item->asisten[0]->getJumlahJam() . ' Jam' . '</td>';
                            } else {
                                echo '<td>' . '' . '</td>';
                            }

                            if ($item->asisten != null && $item->asisten[1] != null) {
                                echo '<td>' . $item->asisten[1]->getNrpMahasiswa()->getNama() . ' - ' . $item->asisten[1]->getJumlahJam() . ' Jam' . '</td>';
                            } else {
                                echo '<td>' . '' . '</td>';
                            }

                            if ($item->asisten != null && $item->asisten[2] != null) {
                                echo '<td>' . $item->asisten[2]->getNrpMahasiswa()->getNama() . ' - ' . $item->asisten[2]->getJumlahJam() . ' Jam' . '</td>';
                            } else {
                                echo '<td>' . '' . '</td>';
                            }
                            echo '<td>' . $item->getJumlahMahasiswa() . '</td>';
                            if ($item->getFotoPresensi() == null || $item->getFotoPresensi() == '') {
                                echo '<td><img src="image/default_cover.svg" alt="Photo" style="max-width: 100px"></td>';
                            } else {
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>


<?php
endif;
?>
