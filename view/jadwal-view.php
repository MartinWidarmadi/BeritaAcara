<?php
if ($_SESSION['roles'] == "dosen") :
    ?>
    <div class="mt-3 mx-5">
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
            foreach ($jadwal as $item) {
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
            <link rel="stylesheet" type="text/css"
                  href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css"/>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
        </table>
    </div>
<?php
else :
    ?>
    <div class="row" style="padding: 50px">
        <div class="col-2">
            <form method="post">
                <h5 class="fw-bold">FILTER</h5>
                <select class="form-select" id="filterSemester" name="filterSemester"
                        aria-label="Default select example" style="margin: 10px">
                    <option selected value=>Pilih Semester</option>
                    <?php foreach ($semester as $smstr): ?>
                        <option value="<?= $smstr->getIdSemester(); ?>"><?= $smstr->getNamaSemester(); ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="form-select" id="filterDosen" name="filterDosen" aria-label="Default select example"
                        style="margin: 10px">
                    <?php
                    if (!isset($filDosen)){
                        echo "<option selected value=>Pilih Dosen</option>";
                    }else{
                        echo '<option value=>Pilih Dosen</option>';
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
                <button type="submit" name="btnFilter" class="btn btn-success">Submit</button>
            </form>
        </div>
    <div class="col-10">
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
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($jadwals as $index => $item):
        ?>
        <tr>
            <td><?= $item->getNipDosen()->getNamaDosen(); ?></td>
            <td><?= $item->getIdMatkul()->getIdMataKuliah(); ?></td>
            <td><?= $item->getIdMatkul()->getNamaMataKuliah(); ?></td>
            <td><?= $item->getHari(); ?></td>
            <td><?= $item->getJamAwal(); ?></td>
            <td><?= $item->getJamAkhir(); ?></td>
            <td><?= $item->getType(); ?></td>
            <td><?= $item->getKelas(); ?></td>
            <td><?= $item->getIdSemester()->getNamaSemester(); ?></td>
            <?php if ($item->getStatus() == 0): ?>
                <td>Aktif</td>
            <?php else: ?>
                <td>Non Aktif</td>
            <?php endif; ?>
            <td>
                <?php if ($item->getStatus() == 0): ?>
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalEditJadwal-<?= $index;?>">Edit</button>               
                    <button class="btn btn-primary" onclick="activeJadwal('<?= $item->getIdMatkul()->getIdMataKuliah();?>', 0)">Aktif/Non Aktif</button>
                <?php else: ?>
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalEditJadwal-<?= $index;?>">Edit</button>               
                    <button class="btn btn-primary" onclick="activeJadwal('<?= $item->getIdMatkul()->getIdMataKuliah();?>', 1)">Aktif/Non Aktif</button>
                    <button class="btn btn-danger" onclick="delJadwal('<?= $item->getIdMatkul()->getIdMataKuliah();?>')">Delete</button>
                <?php endif; ?>
            </td>
        </tr>

        <?php endforeach; ?>

        
        </tbody>
        <thead>
        <tr></tr>
        </thead>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    </table>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Jadwal
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
        Add Batch Jadwal
    </button>
<!--        <div class="mb-3">-->
<!--            <form method="post" enctype="multipart/form-data">-->
<!--                <input type="file" name="jadwalFile" id="jadwalFile" class="form-control form-second" accept=".xls,.xlsx">-->
<!--                <button type="submit" name="btnBatchFile" class="btn btn-primary">Add Batch Jadwal</button>-->
<!--        </div>-->
    </div>
    <!-- modal edit jadwal -->
    <?php foreach ($jadwals as $index => $item) {?>
        <div class="modal fade" id="modalEditJadwal-<?= $index;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <!-- MK readonly -->
                        <div class="form-group mt-3">
                            <label for="idJadwal" class="form-label">Id Jadwal</label>
                            <input type="text" name="idJadwal" id="idJadwal"  class="form-control" value="<?= $item->getIdMatkul()->getIdMataKuliah() . ' ' .$item->getIdMatkul()->getNamaMataKuliah();?>" readonly>
                        </div>

                        <!-- pilih dosen -->
                        <div class="form-group mt-3">
                            <label for="dosen" class="form-label">Dosen</label>
                            <select class="form-select" name="dosen" id="">
                                <option value="<?= $item->getNipDosen()->getNIP(); ?>" selected><?= $item->getNipDosen()->getNamaDosen(); ?></option>
                                <?php foreach($dosen as $d) :
                                    if ($d->getNIP() != $item->getNipDosen()->getNIP()):
                                    ?>
                                    <option value="<?= $d->getNIP(); ?>" ><?= $d->getNamaDosen(); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- pilih hari -->
                        <div class="form-group mt-3">
                            <label for="hari" class="form-label">Hari</label>
                            <select class="form-select" name="hari" id="">
                                <option value="<?= $item->getHari(); ?>" selected><?= $item->getHari(); ?></option>
                                <?php 
                                $hari = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat");
                                foreach($hari as $h):
                                    if ($h != $item->getHari()):
                                ?>
                                <option value="<?= $h; ?>"><?= $h; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- pilih jam mulai dan jam selesai -->
                        <div class="form-group mt-3 d-flex">
                            <div class="w-100">
                                <label for="jamMulai" class="form-label">Jam Mulai</label>
                                <input class="form-control" type="time" name="jamMulai" id="jamMulai" value="<?= $item->getJamAwal(); ?>">
                            </div>
                            <div class="w-100 ms-2">
                                <label for="jamSelesai" class="form-label">Jam Selesai</label>
                                <input class="form-control" type="time" name="jamSelesai" id="jamSelesai" value="<?= $item->getJamAkhir(); ?>">
                            </div>
                        </div>

                        <!-- pilih tipe -->
                        <div class="form-group mt-3">
                            <label for="tipe" class="form-label">Tipe</label>
                            <select class="form-select" name="tipe" id="tipe">
                                <option value="<?= $item->getType(); ?>" selected><?= $item->getType(); ?></option>
                                <?php 
                                $tipe = array("Teori", "Praktikum");
                                foreach($tipe as $t):
                                    if ($t != $item->getType()):
                                ?>
                                <option value="<?= $t; ?>"><?= $t; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- pilih kelas -->
                        <div class="form-group mt-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select" name="kelas" id="kelas">
                                <option value="<?= $item->getKelas(); ?>" selected><?= $item->getKelas(); ?></option>
                                <?php 
                                $kelas = array("A", "B");
                                foreach($kelas as $k):
                                    if ($k != $item->getKelas()):
                                ?>
                                <option value="<?= $k; ?>"><?= $k; ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- pilih semester -->
                        <div class="form-group mt-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select" name="semester" id="semester">
                                <option value="<?= $item->getIdSemester()->getIdSemester(); ?>" selected><?= $item->getIdSemester()->getNamaSemester(); ?></option>
                                <?php 
                                foreach($semester as $s):
                                    if ($s->getIdSemester() != $item->getIdSemester()->getIdSemester()):
                                ?>
                                <option value="<?= $s->getIdSemester(); ?>"><?= $s->getNamaSemester(); ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
                </div>
            </div>
        </div>
    <?php } ?>
    
    
        

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Jadwal</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">

                        <div class="row">
                            <div class="form-group">
                                <select class="form-select" id="dosen" name="dosen" aria-label="Default select example">
                                    <option selected value="0">Pilih Dosen</option>
                                    <?php foreach ($dosen as $item): ?>
                                        <option value="<?= $item->getNIP(); ?>"><?= $item->getNamaDosen(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-select" id="matkul" name="matkul"
                                        aria-label="Default select example">
                                    <option selected value="0">Pilih Mata Kuliah</option>
                                    <?php foreach ($matkul as $item): ?>
                                        <option value="<?= $item->getIdMataKuliah(); ?>"><?= $item->getNamaMataKuliah(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-select" id="hari" name="hari" aria-label="Default select example">
                                    <option selected value="0">Pilih Hari</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jamMulai" class="form-label">Jam Mulai dan Jam Selesai</label>
                                <div class="d-flex ">
                                    <input type="time" name="jamMulai" id="jamMulai" class="form-control w-100">

                                    <input type="time" name="jamSelesai" id="jamSelesai" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-select" id="type" name="type" aria-label="Default select example">
                                    <option selected value="0">Pilih Tipe</option>
                                    <option value="Teori">Teori</option>
                                    <option value="Praktikum">Praktikum</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-select" id="kelas" name="kelas" aria-label="Default select example">
                                    <option selected value="0">Pilih Kelas</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-select" id="semester" name="semester"
                                        aria-label="Default select example">
                                    <option selected value="0">Pilih Semester</option>
                                    <?php foreach ($semester as $item): ?>
                                        <option value="<?= $item->getIdSemester(); ?>"><?= $item->getNamaSemester(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Batch Jadwal</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-select" id="semesters" name="semesters"
                                    aria-label="Default select example">
                                <option selected value="0">Pilih Semester</option>
                                <?php foreach ($semester as $item): ?>
                                    <option value="<?= $item->getIdSemester(); ?>"><?= $item->getNamaSemester(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <h6>Silahkan download template ini terlebih dahulu</h6>
                            <a href="src/TemplateJadwal.xlsx" download>Download link</a>
                        </div>
                        <div class="form-group">
                            <h5 style="color: red">Attention</h5>
                            <h6>Col A : NIP Dosen</h6>
                            <h6>Col B : ID Matakuliah</h6>
                            <h6>Col C : Hari</h6>
                            <h6>Col D : Waktu Awal</h6>
                            <h6>Col E : Waktu Akhir</h6>
                            <h6>Col F : Type</h6>
                            <h6>Col G : Kelas</h6>
                        </div>
                        <div>
                            <input type="file" name="jadwalFile" id="jadwalFile" class="form-control form-second"
                                   accept=".xls,.xlsx">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="btnBatchFile" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
endif; ?>



<script>
    const editJadwal = (id) => {
        window.location = `index.php?menu=editjadwal&jid=%{id}`;
    }

    const activeJadwal = (id, aktif) => {
        let confirmed = confirm('Are you sure deactivate this data?');
        if (confirmed) {
            window.location = `index.php?menu=jadwal&delcom=1&jid=${id}&aktif=${aktif}`;
        }
    }

    const delJadwal = (id) => {
        let confirmed = confirm('Are you sure delete this data?');
        if (confirmed) {
            window.location = `index.php?menu=matkul&delcom=2&mid=${id}`;
        }
    }
</script>