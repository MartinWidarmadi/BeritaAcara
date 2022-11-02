<table class="table" id="example">
    <thead>
    <tr>
        <th scope="col">Code Kelas</th>
        <th scope="col">Mata Kuliah</th>
        <th scope="col">Hari</th>
        <th scope="col">Jam Mulai</th>
        <th scope="col">Jam Selesai</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($jadwal as $item) {
        echo '<tr>';
        echo '<td>' . $item->getKodeKelas() . '</td>';
        echo '<td>' . $item->getIdMatkul()->getNamaMataKuliah() . '</td>';
        echo '<td>' . $item->getHari() . '</td>';
        echo '<td>' . $item->getJamAwal() . '</td>';
        echo '<td>' . $item->getJamAkhir() . '</td>';
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
