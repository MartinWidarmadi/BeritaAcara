<form method="post" action="">
    <div class="form-group">
        <label for="id" class="form-label">NIP</label>
        <input type="text" name="txtNIP" placeholder="NIP" autofocus required
               id="dosenID" class="form-control">
    </div>
    <div class="form-group">
        <label for="name" class="form-label">Dosen Name</label>
        <input type="text" name="txtName" placeholder="Dosen Name"required
               id="dosenNameID" class="form-control">
    </div>
    <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="txtEmail" placeholder="Email" required
               id="dosenEmailID" class="form-control">
    </div>
    <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="txtPassword" placeholder="Password" required
               id="dosenPasswordID" class="form-control">
    </div>
    <br>
    <div class="form-group">
        <input type="submit" value="Submit Data" name="btnSubmit" class="btn btn-primary">
    </div>
    <br>
</form>
<table class="table" id="example">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
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
