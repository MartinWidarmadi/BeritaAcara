<?php
if ($_SESSION['roles'] == "dosen") :
?>
<table class="table" id="example">
    <thead>
    <tr>
        <th scope="col">NIP</th>
        <th scope="col">Dosen Name</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($dosen as $dosens) {
        echo '<tr>';
        echo '<td>' . $dosens->getNIP() . '</td>';
        echo '<td>' . $dosens->getNamaDosen() . '</td>';
    }
    ?>
    </tbody>
    <thead>
    <tr></tr>
    </thead>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
</table>
<?php
else :
?>
<table class="table" id="example">
    <thead>
    <tr>
        <th scope="col">NIP</th>
        <th scope="col">Dosen Name</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($dosen as $dosens) {
        echo '<tr>';
        echo '<td>' . $dosens->getNIP() . '</td>';
        echo '<td>' . $dosens->getNamaDosen() . '</td>';
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
    <input type="submit" value="Add Dosen" name="btnSubmit" class="btn btn-primary">
</div>
</form>
<?php
endif; ?>