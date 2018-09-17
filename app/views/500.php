<?php include VIEW_PATH . 'sections/bsheader.php'; ?>
<title>Server Error</title>
</head>
<body>
    <div class="row justify-content-md-center mt-5">
        <div class="jumbotron">
            <h1 class="display-3">Error 500</h1>
            <p class="lead">Server Error</p>
            <hr class="m-y-md">
            <p>Sorry, the server encountered an error.<br> Click on a button below to go to back to the previous page or to the Home page.</p>
            <p class="lead">
                <a class="btn btn-primary" href="javascript:void;" onclick="window.history.back()" role="button">Go back</a>
                <a class="btn btn-primary pull-right" href="/" role="button">Home</a>
            </p>
        </div>
    </div>
<?php include VIEW_PATH . 'sections/bsfooter.php'; ?>
