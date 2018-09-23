<?php $_SESSION['REDIRECT_ROUTE'] = $_SERVER['REQUEST_URI']; ?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="/css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="/css/skins/_all-skins.min.css">

    <?php if (config('debug_mode')) {
        echo Core\DebugbarRenderer::renderHead();
    }?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<title><?= $data['title'] ?? 'PHP No Framework'; ?> - PHP No Framework by ferdie</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php if (isset($_SESSION['isLoggedIn'])): ?>
          <header class="main-header">
            <!-- Logo -->
            <a href="/" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><b>PHP</b>NOFW</span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><b>PHP</b>No Framework</span>
          </a>
          <!-- Header Navbar: style can be found in header.less -->
          <nav class="navbar navbar-static-top">
              <!-- Sidebar toggle button-->
              <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <img src="/img/avatars/default.png" class="user-image" alt="User Image">
                          <span class="hidden-xs"><?= $_SESSION['USER_NAME'] ?></span>
                      </a>
                      <ul class="dropdown-menu">
                          <!-- User image -->
                          <li class="user-header">
                            <img src="/img/avatars/default.png" class="img-circle" alt="User Image">
                            <p>
                                <?= $_SESSION['USER_NAME'] ?>
                                <small>Member since <?= date_format(date_create($_SESSION['USER_CREATED_AT']), 'F j, Y'); ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                              <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                          <a href="/user/<?= $_SESSION['USER_ID']; ?>/edit" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                          <a href="javascript:void()" class="btn btn-default btn-flat" onclick="document.querySelector('#logout-form').submit();">Sign out</a>
                          <form id="logout-form" method="POST" action="/logout" style="display: none;"><?= csrf_token(); ?></form>
                      </div>
                  </li>
              </ul>
          </li>
      </ul>
  </div>
</nav>
</header>

<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
        </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-files-o"></i>
        <span>Layout Options</span>
        <span class="pull-right-container">
          <span class="label label-primary pull-right">4</span>
      </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
    <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
    <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
    <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
</ul>
</li>
</ul>
</section>
<!-- /.sidebar -->
</aside>
<!-- =============================================== -->
<?php endif; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <?php include VIEW_PATH . 'sections/message.php'; ?>
        </section>
        <section class="content-header">
            <!-- Content Header (Page header) -->
            <h1>
                Pace page
                <small>Loading example</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Pace page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= $data['title']; ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
          </div>
          <div class="box-body">
