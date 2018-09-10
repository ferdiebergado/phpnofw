<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<?php if (config('env') === 'dev') {
        echo DebugbarRenderer::getInstance()->renderHead();
    }?>
	<title>PHP No Framework by ferdie</title>
</head>
<body>
	<?php
	if (empty($_SESSION['loggedIn'])) {
		require VIEW_PATH . 'login.php';
	} else {
		require VIEW_PATH . 'home.php';
	}
	?>
