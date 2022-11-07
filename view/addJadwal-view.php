<div class="container">
    <form method="post">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <h2 class="text-center">Add Jadwal</h2>
                <p class="text-center">Jadwal untuk dosen</p>
                <div class="form-group">
                    <select class="form-select" id="dosen" name="dosen" aria-label="Default select example">
                        <option selected value="0">Pilih Dosen</option>
                        <?php foreach($dosen as $item):?>
                            <option><?=  $item->getNamaDosen(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-select" id="matkul" name="matkul" aria-label="Default select example">
                        <option selected value="0">Pilih Mata Kuliah</option>
                        <?php foreach($matkul as $item):?>
                            <option><?=  $item->getNamaMataKuliah(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-select" id="type" name="type" aria-label="Default select example">
                        <option selected value="0">Pilih Tipe</option>
                        <option value="teori">Teori</option>
                        <option value="praktikum">Praktikum</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-select" id="kelas" name="kelas" aria-label="Default select example">
                        <option selected value="0">Pilih Kelas</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="Add Jadwal" name="btnSubmit" class="btn btn-primary">
                </div>

            </div>
        </div>
    </form>
</div>




