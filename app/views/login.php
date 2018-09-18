<?php include VIEW_PATH . 'sections/bsheader.php'; ?>
<link rel="stylesheet" type="text/css" href="/css/login.css">
    <title>Login</title>
    </head>
    <body>
        <div class="clr30"></div>
        <div class="container">
          <div class="row justify-content-md-center">
            <div class="col-md-5">
              <div class="card login" id="login1">
                <div class="card-header"><strong>User Login</strong></div>
                <div class="card-body">
                  <form method="POST" action="/login">
                    <div class="input-group mt-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="email" name="email" class="form-control <?php if(isset($_SESSION['errors']['email'])) { echo 'is-invalid'; } ?>" placeholder="Email" aria-label="Email" value="<?= $_SESSION['email'] ?? ''; ?>" aria-describedby="emailHelp" required autofocus>
                </div>
                <?php if (isset($_SESSION['errors']['email'])): ?>
                  <div><small id="emailHelp" class="text-danger"><?= $_SESSION['errors']['email'] ?></small></div>
                  <?php unset($_SESSION['errors']['email'], $_SESSION['email']); endif; ?>
                  <div class="input-group mt-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="passwordHelp" required autocomplete="off">
                </div>
                <a href="/reset" id="reset"><small>Forgot password?</small></a>
                <?php if (isset($_SESSION['errors']['password'])): ?>
                  <div><p><small id="passwordHelp" class="text-danger"><?= $_SESSION['errors']['password'] ?></small></p></div>
                  <?php unset($_SESSION['errors']['password']); endif; ?>
                  <?= csrf_token(); ?>
                  <div class="pull-right"><button type="submit" class="btn btn-primary mt-3"><strong>Submit</strong></button></div>
              </form>
          </div>
          <div class="card-footer text-center">
            <small>&copy; Copyright 2018 <a href="https://facebook.com/ferdie.bergado">Ferdinand Saporas Bergado</a> MSITc</small>
        </div>
    </div>
</div>
</div>
<?php include VIEW_PATH . 'sections/bsfooter.php'; ?>
