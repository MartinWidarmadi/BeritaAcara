<table class="table" id="example">
        <thead>
        <tr>
            <th scope="col">NIP</th>
            <th scope="col">Dosen Name</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($dosen as $dosens) {
            echo '<tr>';
            echo '<td>' . $dosens->getNIP() . '</td>';
            echo '<td>' . $dosens->getNamaDosen() . '</td>';
        }
        ?>
        </tbody>
        <thead>
        <tr></tr>
        </thead>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    </table>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">
        Add Dosen
    </button>
    <form method="post">
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Dosen</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <p class="text-center">Email & Password</p>
                            <div class="form-group">
                                <input class="form-control" type="Email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="Password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="Password" name="confirmpassword"
                                       placeholder="Confirm Password">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Continue</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Profile Dosen</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="NIP" placeholder="NIP">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="Name" placeholder="Name">
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modal1">Back</button>
                        <button type="submit" name="btnSubmit" class="btn btn-primary">Add Dosen</button>
                    </div>
                </div>
            </div>
        </div>
    </form>