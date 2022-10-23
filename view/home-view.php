<div class="container p-5">
  <h1>Welcome</h1>
  <?php
  echo '<p>Hello ' . $_SESSION['web_user_full_name'] .' '. '<i class="fa-solid fa-user"></i>'. '</p>';
  ?>
  <form method="POST">
      <div class="mb-4">
        <label for="jadwal">Pilih Jadwal</label>
        <select class="form-select" id="jadwal" aria-label="Default select example">
        <option selected value="0">Pilih</option>
        <?php foreach($jadwal as $item): 
          var_dump($item->getIdMatkul());?>
      <option value="<?= $item->getIdJadwal(); ?>"><?= $item->getIdMatkul()->getIdMataKuliah() . " " . $item->getIdMatkul()->getNamaMataKuliah() . " " . $item->getJamAwal() . " - " . $item->getJamAkhir(); ?></option>
      <?php endforeach; ?>
        </select>
      </div>

    <div class="mb-4">
    <label for="pertemuan">Pilih Pertemuan</label>
    <select class="form-select" id="pertemuan" aria-label="Default select example">
      <option selected value="0">Pilih</option>
      <?php 
      for ($i = 1; $i <= 16; $i++) :
      ?>
      <option value="<?= $i; ?>"><?= $i; ?></option>
      <?php endfor; ?>
      <option value="perbaikan">UJIAN PERBAIKAN</option>
      <option value="susulan">UJIAN SUSULAN</option>
    </select>
    </div>

    <input type="submit" value="Next" id="js-btn-submit"  name="btnNext" class="btn btn-primary mb-4">
    </form>
</div>
  
<script>
  const allInput = document.querySelectorAll('.form-select');
  const btnSubmit = document.querySelector('input[type="submit"]');
  const select = document.querySelector('#pertemuan');
  let empty = true;

  btnSubmit.disabled = true;
  allInput.forEach((el) => {
    el.addEventListener('change', () => {
      if ((allInput[0].value !== '0') && (allInput[1].value !== '0')) {
        btnSubmit.disabled = false;
      } else {
        btnSubmit.disabled = true;
      }
    })
  })
</script>