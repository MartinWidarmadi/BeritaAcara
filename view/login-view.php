<div class="container-fluid d-flex justify-content-center align-items-center pt-5">
  <form method="post">
    <!-- Email input -->
    <div class="form-outline mb-2">
      <input type="email" id="userEmail" class="form-control" name="txtEmail"/>
      <label class="form-label" for="userEmail">Email address</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-2">
      <input type="password" id="UserPassword" class="form-control" name="txtPassword"/>
      <label class="form-label" for="UserPassword">Password</label>
    </div>

    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
      <div class="col d-flex justify-content-center">
        <!-- Checkbox -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
          <label class="form-check-label" for="form2Example31"> Remember me </label>
        </div>
      </div>

      <div class="col">
        <!-- Simple link -->
        <a href="#!">Forgot password?</a>
      </div>
    </div>

    <!-- Submit button -->
    <div class="row">
      <button type="submit" class="btn btn-primary btn-block mb-4" name="btnLogin">Login</button>
    </div>
  </form>
</div>