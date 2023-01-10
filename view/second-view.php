<style>
    * {
        box-sizing: border-box;
    }

    .autocomplete {
        position: relative;
        display: inline-block;
    }

    input {
        border: 1px solid transparent;
        background-color: #f1f1f1;
        padding: 10px;
        font-size: 16px;
    }

    input[type=text] {
        background-color: #f1f1f1;
        width: 100%;
    }

    input[type=submit] {
        background-color: DodgerBlue;
        color: #fff;
        cursor: pointer;
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }
/* 
 {
        background-color: DodgerBlue !important;
        color: #ffffff;
    } */
</style>
<div class="container-fluid p-3">
    <form method="POST" enctype="multipart/form-data" autocomplete="off">
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
            <input type="number" min="1" name="jumlahMahasiswa" id="jumlahMahasiswa" class="form-control form-second">
        </div>

        <div class="mb-3">
            <label for="materi" class="form-label">Masukkan Materi Pokok Bahasan</label>
            <input type="text" name="materi" id="materi" class="form-control form-second">
        </div>

        <div class="mb-3">
            <label for="pbm" class="form-label">Masukkan Keterangan PBM Online</label>
            <textarea name="pbm" id="pbm" cols="30" rows="2" class="form-control form-second"></textarea>
        </div>

        <!-- <div class="mb-3">
          <label for="materi" class="form-label">Masukkan Materi Pokok Bahasan</label>
          <input type="text" name="materi" id="materi" class="form-control form-second">
        </div> -->
        <div class="mb-3">
            <div class="col-3">
                <input type="checkbox" name="check" id="check" class="form-check-label">
                <label for="check" class="form-label">Tekan Jika Ada Asdos 1</label>
                <div class="d-flex justify-content">
                    <label for="check" class="form-label">Nama Asdos</label>
                </div>

                <div class="d-flex justify-content autocomplete">
                    <input type="text" name="asdos1" id="myInput1" class="kolom-asdos form-control me-3 form-second">
                </div>
                <div class="d-flex justify-content">
                    <label for="check" class="form-label">Waktu Asdos</label>
                </div>
                <div class="d-flex justify-content">
                    <input type="text" name="time1" id="timeInput1" class="kolom-asdos form-control me-3 form-second">
                </div>

            </div>


        </div>

        <div class="mb-3">
            <div class="col-3">
                <input type="checkbox" name="check" id="check2" class="form-check-label">
                <label for="check" class="form-label">Tekan Jika Ada Asdos 2</label>
                <div class="d-flex justify-content">
                    <label for="check" class="form-label">Nama Asdos</label>
                </div>
                <div class="d-flex justify-content autocomplete">
                    <input type="text" name="asdos2" id="myInput2" class="kolom-asdos form-control me-3 form-second">
                </div>
                <div class="d-flex justify-content">
                    <label for="check" class="form-label">Waktu Asdos</label>
                </div>
                <div class="d-flex justify-content">
                    <input type="text" name="time2" id="timeInput2" class="kolom-asdos form-control me-3 form-second">
                </div>
            </div>


        </div>

        <div class="mb-3">
            <div class="col-3">
                <input type="checkbox" name="check" id="check3" class="form-check-label">
                <label for="check" class="form-label">Tekan Jika Ada Asdos 3</label>
                <div class="d-flex justify-content">
                    <label for="check" class="form-label">Nama Asdos</label>
                </div>
                <div class="d-flex justify-content autocomplete">
                    <input type="text" name="asdos3" id="myInput3" class="kolom-asdos form-control me-3 form-second ">
                </div>
                <div class="d-flex justify-content">
                    <label for="check" class="form-label">Waktu Asdos</label>
                </div>
                <div class="d-flex justify-content">
                    <input type="text" name="time3" id="timeInput3" class="kolom-asdos form-control me-3 form-second">
                </div>
            </div>


        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Masukkan Foto Bukti Dokumentasi</label>
            <input type="file" name="photoFile" id="foto" class="form-control form-second" accept="image/jpeg, image/png">
        </div>

        <div class="mb-3">
            <input type="submit" value="Previous" class="btn btn-primary" name="btnPrev">
            <input type="submit" value="Submit" class="btn btn-primary btnSubmit" name="btnSubmit">
        </div>
    </form>
</div>

<script>

    function autocomplete(inp, arr) {
        var currentFocus;
        inp.addEventListener("input", function (e) {
            var a, b, i, val = this.value;
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            this.parentNode.appendChild(a);
            for (i = 0; i < arr.length; i++) {
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    b = document.createElement("DIV");
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    b.addEventListener("click", function (e) {
                        inp.value = this.getElementsByTagName("input")[0].value;
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        inp.addEventListener("keydown", function (e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                currentFocus++;
                addActive(x);
            } else if (e.keyCode == 38) { //up
                currentFocus--;
                addActive(x);
            } else if (e.keyCode == 13) {
                e.preventDefault();
                if (currentFocus > -1) {
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            if (!x) return false;
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }

        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }

    var data = [];

    $.ajax({
        type: "GET",
        url: "ajax.php",
    }).then((asdos)=>{
        asdos.forEach((a)=>{
            data.push(a.Nama + " - " + a.NRP);
        });
    });
    
    autocomplete(document.getElementById("myInput1"), data);
    autocomplete(document.getElementById("myInput2"), data);
    autocomplete(document.getElementById("myInput3"), data);

    const date = document.querySelector('#calendar');
    const jamMulai = document.querySelector('#timeStart');
    const jamAkhir = document.querySelector('#timeEnd');
    const jmlMahasiswa = document.querySelector('#jumlahMahasiswa');
    const materi = document.querySelector('#materi');
    const pbm = document.querySelector('#pbm');
    const check = document.querySelector('#check');
    const check2 = document.querySelector('#check2');
    const check3 = document.querySelector('#check3');
    const kolomAsdos = document.querySelectorAll('.kolom-asdos');
    const foto = document.querySelector('#foto');
    const btnSubmit = document.querySelector('.btnSubmit');

    const empty = (str) => (str.toString().trim().length == 0);

    kolomAsdos.forEach((element) => {
        element.disabled = true;
    })
    let isChecked = false;
    check.addEventListener('click', function () {
            if (check.checked) {
                document.getElementById("myInput1").disabled = false;
                document.getElementById("timeInput1").disabled = false;
                isChecked = true;
            } else {
                document.getElementById("myInput1").disabled = true;
                document.getElementById("timeInput1").disabled = true;
                isChecked = false;
            }
    });

    let isChecked2 = false;
    check2.addEventListener('click', function () {
        if (check2.checked) {
            document.getElementById("myInput2").disabled = false;
            document.getElementById("timeInput2").disabled = false;
            isChecked2 = true;
        } else {
            document.getElementById("myInput2").disabled = true;
            document.getElementById("timeInput2").disabled = true;
            isChecked2 = false;
        }
    });

    let isChecked3 = false;
    check3.addEventListener('click', function () {
        if (check3.checked) {
            document.getElementById("myInput3").disabled = false;
            document.getElementById("timeInput3").disabled = false;
            isChecked3 = true;
        } else {
            document.getElementById("myInput3").disabled = true;
            document.getElementById("timeInput3").disabled = true;
            isChecked3 = false;
        }
    });

    const formCheck = document.querySelectorAll('.form-second');

    btnSubmit.disabled = true;
    document.addEventListener('change', function () {
        if (!empty(date.value) && !empty(jamMulai) && !empty(jamAkhir) && !empty(jmlMahasiswa) && !empty(materi) && !empty(pbm) && !empty(foto.value)) {
            // if (check.checked) {
            //    if(!empty())
            // }
            btnSubmit.disabled = false;
        } else {
            btnSubmit.disabled = true;
        }
    })
    // btnSubmit.addEventListener('click', function() {
    //   empty(jamAkhir);
    // })
</script>