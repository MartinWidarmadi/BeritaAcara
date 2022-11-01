<div class="container-fluid p-3">
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="calendar" class="form-label">Masukkan tanggal Pertemuan</label>
      <input type="date" name="calendar" id="calendar" class="form-control form-second">
    </div>

    <div class="mb-3">
      <label for="time" class="form-label">Masukkan Jam Mulai dan Jam Selesai</label>
      <div class="d-flex justify-content-start">
        <input type="time" name="timeStart" id="timeStart" class="form-control me-3 form-second">
        <input type="time" name="timeEnd" id="timeEnd" class="form-control form-second">
      </div>
    </div>

    <div class="mb-3">
      <label for="jumlahMahasiswa" class="form-label">Masukkan Jumlah Mahasiswa yang Hadir</label>
      <input type="number" name="jumlahMahasiswa" id="jumlahMahasiswa" class="form-control form-second">
    </div>

    <div class="mb-3">
      <label for="materi" class="form-label">Masukkan Materi Pokok Bahasan</label>
      <input type="text" name="materi" id="materi" class="form-control form-second">
    </div>
    
    <div class="mb-3">
      <label for="pbm" class="form-label">Masukkan Keterangan PBM Online</label>
      <textarea name="pbm" id="pbm" cols="30" rows="2" class="form-control form-second"></textarea>
    </div>

    <div class="mb-3">
      <label for="materi" class="form-label">Masukkan Materi Pokok Bahasan</label>
      <input type="text" name="materi" id="materi" class="form-control form-second">
    </div>

    <div class="mb-3">
      <label for="" class="form-label">Masukkan Asdos (Jika Ada)</label>
      <div class="d-flex justify-content">
        <input type="text" name="asdos1" id="" class="kolom-asdos form-control me-3 form-second">
        <input type="text" name="asdos2" id="" class="kolom-asdos form-control me-3 form-second">
        <input type="text" name="asdos3" id="" class="kolom-asdos form-control form-second ">
      </div>
      <input type="checkbox" name="check" id="check" class="form-check-label">
      <label for="check" class="form-label">Tekan Radio Button Jika Ada Asdos</label>
    </div>

    <div class="mb-3">
      <label for="foto" class="form-label">Masukkan Foto Bukti Dokumentasi</label>
      <input type="file" name="foto" id="foto" class="form-control form-second">
    </div>

    <div class="mb-3">
      <input type="submit" value="Previous" class="btn btn-primary" name="btnPrev">
      <input type="submit" value="Submit" class="btn btn-primary btnSubmit" name="btnSubmit">
    </div>
  </form>
</div>

<script>
  const date = document.querySelector('#calendar');
  const jamMulai = document.querySelector('#timeStart');
  const jamAkhir = document.querySelector('#timeEnd');
  const jmlMahasiswa = document.querySelector('#jumlahMahasiswa');
  const materi = document.querySelector('#materi');
  const pbm = document.querySelector('#pbm');
  const check = document.querySelector('#check');
  const kolomAsdos = document.querySelectorAll('.kolom-asdos');
  const foto = document.querySelector('#foto');
  const btnSubmit = document.querySelector('.btnSubmit');

  const empty = (str) => (str.toString().trim().length == 0 );

  

  kolomAsdos.forEach((element) => {
    element.disabled = true;
  })
  let isChecked = false;
  check.addEventListener('click', function() {
    kolomAsdos.forEach((element) => {
      if (check.checked) {
        element.disabled = false;
        isChecked = true;
      } else {
        element.disabled = true;
        isChecked = false;
      }
    })
  })

  const formCheck = document.querySelectorAll('.form-second');

  btnSubmit.disabled = true;
  document.addEventListener('change', function() {
    if (!empty(date.value) && !empty(jamMulai) && !empty(jamAkhir) && !empty(jmlMahasiswa) && !empty(materi) && !empty(pbm) && !empty(foto.value)) {
      // if (check.checked) {
      //    if(!empty())
      // }
      btnSubmit.disabled = false;
    } else {
      btnSubmit.disabled = true;
    }
  })

  btnSubmit.addEventListener('click', function() {
    empty(jamAkhir);
  })
</script>