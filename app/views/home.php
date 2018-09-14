<h1>Welcome</h1>
<?php if(isset($content)): ?>
    <?php if (is_array($content)): ?>
        <?php if (count($content) > 1): ?>
            <p><?= $content['name'] ?></p>
            <p><?= $content['email'] ?></p>
            <?php else: ?>
                <?php foreach ($content as $c): ?>
                    <p><?= $c['name'] ?></p>
                    <p><?= $c['email'] ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
