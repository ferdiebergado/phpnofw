<?php require CONTROLLER_PATH . 'LoginController.php'; ?>
<div class="global-container">
  <div class="card login-form">
    <div class="card-body">
      <h3 class="card-title text-center">Log in to the System</h3>
      <div class="card-text">
      <?php if (!empty($emailErr) || !empty($passwordErr)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div>
      <?php endif; ?>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group <?= isset($emailErr) ? 'has-danger' : ''; ?>">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Email" value="<?= $email ?>" required autofocus>
          <?php if (isset($emailErr)): ?>
            <div class="invalid-feedback">
              <?= $emailErr ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <!-- <a href="#" style="float:right;font-size:12px;">Forgot password?</a> -->
          <input type="password" class="form-control form-control-sm" id="exampleInputPassword1" name="password" placeholder="Password" required>
        </div>
        <?php csrf_token(); ?>
        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
      </form>
    </div>
  </div>
</div>
</div>
