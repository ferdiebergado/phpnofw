          <form class="form-horizontal" method="POST" action="/user/<?php if (isset($_SESSION['USER_ID'])) { echo $_SESSION['USER_ID']; } ?>">
            <?php include VIEW_PATH . 'user/partial.php'; ?>
