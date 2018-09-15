<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $data['title']; ?></title>

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
    <link rel="stylesheet" type="text/css" href="/css/all.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
                    <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="passwordHelp" required>
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
<script src="/js/jquery-3.3.1.slim.min.js"></script>
<script src="/js/bootstrap.bundle.min.js></script>
</body>
</html>
