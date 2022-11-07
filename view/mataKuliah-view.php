<table class="table" id="example">
    <thead>
    <tr>
        <th scope="col">ID MK</th>
        <th scope="col">Mata Kuliah</th>
        <th scope="col">SKS</th>
        <th scope="col">Prodi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($mk as $item) {
        echo '<tr>';
        echo '<td>' . $item->getIdMataKuliah() . '</td>';
        echo '<td>' . $item->getNamaMataKuliah() . '</td>';
        echo '<td>' . $item->getSKS() . '</td>';
        echo '<td>' . $item->getIdProdi()->getNamaProdi() . '</td>';
    }
    ?>
    </tbody>
    <thead>
    <tr></tr>
    </thead>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
</table>
<form method="post">
    <div class="form-group">
        <input type="submit" value="Add Mata Kuliah" name="btnSubmit" class="btn btn-primary">
    </div>
</form>

