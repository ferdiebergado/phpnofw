<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<?php include VIEW_PATH . 'sections/footerjs.php'; ?>
<?php if (config('debug_mode')) {
    echo Core\DebugbarRenderer::render();
}?>
</body>
</html>
