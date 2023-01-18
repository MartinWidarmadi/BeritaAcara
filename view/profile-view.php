<div class="container d-flex flex-column align-items-center p-5">
  <h1 class="mb-3">Profile</h1>
  <table class="table w-50">
    <tr>
      <th>
        <h3>NIP</h3>
      </th>
      <td>
        <h3><?= $dosen->getNIP(); ?></h3>
      </td>
    </tr>
    <tr>
      <th>
        <h3>Nama</h3>
      </th>
      <td>
        <h3><?= $dosen->getNamaDosen(); ?></h3>
      </td>
    </tr>
    <tr>
      <th>
        <h3>Email</h3>
      </th>
      <td>
        <h3><?= $user->getEmail(); ?></h3>
      </td>
    </tr>
  </table>
  <div class="">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePwModal" >Change Password</button>
    <button type="button" name="btnLogout" class="btn btn-danger" id="btnLogOut">Log out</button>
  </div>
</div>

<!-- modal change password -->
<div class="modal fade" id="changePwModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">
        <div class="modal-body">
          <p class="text-center">Enter your new password</p>
          <div class="form-group">
              <input class="form-control" type="Password" name="oldPassword" placeholder="Old Password" required>
          </div>
          <div class="form-group">
              <input class="form-control" type="Password" name="newPassword" placeholder="New Password" required>
          </div>
          <div class="form-group">
              <input class="form-control" type="Password" name="confirmPassword" placeholder="Confirm Password" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="btnCheck" id="checkPw" onclick="changePw('<?= $_SESSION['user_id'];?>')">Update Password</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const btnLogout = document.querySelector('#btnLogOut');
  btnLogout.addEventListener('click', (e) => {
    let confirmation = confirm('Are you sure want to logout?');

    if (confirmation) window.location = `index.php?menu=logout`;
  })

  const changePw = (id) => {
    window.location = `index.php?&updatePass&uid=${id}`;
  }

  // const checkPw = document.querySelector('#checkPw');
  // checkPw.addEventListener('click', (e) => {
  //   console.log(`index.php?menu=profile&id=<?= $user->getIdUser();?>`);
  //   // window.location = `index.php?menu=profile&id=<?= $user->getIdUser();?>`;
  // })
</script>


