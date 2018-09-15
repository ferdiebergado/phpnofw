<nav class="navbar sticky-top navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand" href="/"><strong>PHP No Framework Application by ferdie</strong></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= $_SESSION['USER_NAME']; ?>
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="/user/<?= $_SESSION['USER_ID']; ?>/edit">Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="javascript:void()" onclick="document.querySelector('#logoutForm').submit();">Logout</a>
      </div>
  </li>
</ul>
</div>
</nav>
<div>
  <form id="logoutForm" method="POST" action="/logout" style="display: none;"><?= csrf_token(); ?></form>
</div>
