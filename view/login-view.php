<div class="container-fluid d-flex justify-content-center align-items-center pt-5">
  <form method="post">

    <div class="form-outline mb-2">
        <label class="form-label" for="userEmail">Email address</label>
      <input type="email" id="userEmail" class="form-control" name="txtEmail" value="<?php if (isset($_COOKIE["txtEmail"])) { echo $_COOKIE["txtEmail"]; }?>"/>
    </div>

    <div class="form-outline mb-2">
        <label class="form-label" for="UserPassword">Password</label>
      <input type="password" id="UserPassword" class="form-control" name="txtPassword" value="<?php if (isset($_COOKIE["txtPassword"])) { echo $_COOKIE["txtPassword"]; }?>"/>
    </div>

    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
      <div class="col d-flex justify-content-center">
        <!-- Checkbox -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="form2Example31" name="remember" checked />
          <label class="form-check-label" for="form2Example31"> Remember me </label>
        </div>
      </div>

      <div class="col">
        <!-- Simple link -->
<!--        <a href="view/forgot-view.php">Forgot password?</a>-->
          <a href="?menu=forgot">Forgot Password</a>
      </div>
    </div>

    <!-- Submit button -->
    <div class="row">
      <button type="submit" class="btn btn-primary btn-block mb-4" name="btnLogin">Login</button>
    </div>
  </form>
</div>