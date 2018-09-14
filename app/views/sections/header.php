<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->

	<link rel="stylesheet" type="text/css" href="css/bootswatch.pulse.min.css">

    <?php if (empty($_SESSION['isLoggedIn'])): ?>
        <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"> -->
        <link rel="stylesheet" type="text/css" href="css/all.min.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
    <?php endif; ?>

    <?php if (config('debug_mode')) {
        echo $debugbarRenderer->renderHead();
    }?>

    <title>PHP No Framework by ferdie</title>
</head>
<body>
    <?php if (isset($_SESSION['isLoggedIn'])) {
        require VIEW_PATH . 'sections/navbar.php';
    }?>
    <div class="container-fluid mt-5">
        <?php if (isset($_SESSION['isLoggedIn'])) {
            require VIEW_PATH . 'sections/nav.php';
        }?>
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Error</strong>
                <?= $_SESSION['error'] ?? ''; ?>
            </div>
        <?php endif; ?>
