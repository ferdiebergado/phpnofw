        <?php if (isset($_SESSION['message']['title'])): ?>
            <div id="divAlert" class="alert alert-<?= $_SESSION['message']['type']; ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><?= ucfirst($_SESSION['message']['type']); ?></strong> <?= $_SESSION['message']['title']; ?>
            </div>
            <?php unset($_SESSION['message']); endif;?>
