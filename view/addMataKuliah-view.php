<div class="container">
    <form method="post">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <h2 class="text-center">Add Mata Kuliah</h2>
                <p class="text-center">Mata Kuliah</p>
                <div class="form-group">
                    <input class="form-control" type="text" name="IDmatkul" placeholder="ID Mata Kuliah">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="matkul" placeholder="Nama Mata Kuliah">
                </div>
                <div class="form-group">
                    <select name="prodi" id="prodi" class="form-select">
                        <option selected>Pilih prodi</option>
                        <?php
                        foreach ($prodis as $item):
                            ?>
                            <option><?= $item->getNamaProdi(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input class="form-control button" type="submit" name="addMatkul" value="Add">
                </div>
            </div>
        </div>
    </form>
</div>
</body>
