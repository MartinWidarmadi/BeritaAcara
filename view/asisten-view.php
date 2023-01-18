<div class="row" style="padding: 50px">
    <div class="col-2">
        <form method="post">
            <h5 class="fw-bold">FILTER</h5>
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
                    <th scope="col">Id Asdos</th>
                    <th scope="col">Nama Asdos</th>
                    <th scope="col">Jumlah Jam</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($asdos as $index => $item) {
                    echo '<tr>';
                    echo '<td>' . $item->getNrpMahasiswa()->getNRP() . '</td>';
                    echo '<td>' . $item->getNrpMahasiswa()->getNama() . '</td>';
                    echo '<td>' . $item->getJumlahJam() . '</td>';
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
</div>

