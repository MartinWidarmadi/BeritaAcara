<div class="mt-3 mx-5">
    <table class="table" id="example">
        <thead>
        <tr>
            <th scope="col">ID Semester</th>
            <th scope="col">Nama Semester</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($semester as $index => $item) {
            echo '<tr>';
            echo '<td>' . $item->getIdSemester() . '</td>';
            echo '<td>' . $item->getNamaSemester() . '</td>';
            echo "<td> <button class='btn btn-success'  data-bs-toggle='modal' data-bs-target='#modaleditSemester-$index'>Edit </button >
                <button class='btn btn-danger' onclick = 'delSemester(\"" . $item->getIdSemester() . "\")' > Delete</button >

            </td > ";
            echo '</tr>';
        }
        ?>
        </tbody>
        <thead>
        <tr></tr>
        </thead>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    </table>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Semester
    </button>
</div>

<?php foreach ($semester as $index => $item) { ?>
    <div class="modal fade" id="modaleditSemester-<?= $index ?>" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaleditLabel">Edit Semester</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">

                        <div class="form-group mt-3">
                            <label for="nrp" class="form-label">ID Semester</label>
                            <input class="form-control" type="text" name="id" placeholder="ID" id="id"
                                   value="<?php echo $item->getIdSemester(); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control" type="text" name="nama" placeholder="Nama " id="nama"
                                   value="<?php echo $item->getNamaSemester(); ?>" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="btnUpdate" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Semester</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">

                    <div class="row">
                        <div class="form-group">
                            <input class="form-control" type="text" name="nama" placeholder="Nama">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="addSemester">Add Semester</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    const delSemester = (id) => {
        let confirmed = confirm('Are you sure delete this data?');
        if (confirmed) {
            window.location = `index.php?menu=semester&delcom=2&sid=${id}`;
        }
    }
</script>
