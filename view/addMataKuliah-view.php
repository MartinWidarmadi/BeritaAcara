<div class="container">
  <form method="POST">
    <div class="mb-3">
      <label for="namaMatkul" class="form-label">Masukkan Nama Matakuliah</label>
      <input type="text" name="namaMatkul" id="namaMatkul" class="form-control">
    </div>

    <div class="mb-3">
    <label for="prodi" class="form-label">Pilih prodi</label>
    <select name="prodi" id="prodi" class="form-select">
      <option selected>Pilih prodi</option>
      <?php 
      foreach ($prodi as $item):
        ?>
      <option value="<? $item->getIdProdi();?>"><?= $item->getNamaProdi(); ?></option>
      <?php endforeach; ?>
    </select>
    </div>
    
    <div class="mb-3">
    <input type="submit" name="btnSubmit" class="btn btn-primary">
    </div>
  </form>
</div>