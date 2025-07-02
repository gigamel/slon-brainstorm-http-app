<?php
/** @var \App\Widget\Paginator $paginator */
/** @var \Slon\Http\Router\Contract\RouteInterface $route */
if ($paginator->getPages() > 1):
?>

<div class="pagination">
<?php for ($page = 1; $page <= $paginator->getPages(); $page++): ?>

    <?php if ($page === $paginator->getPage()): ?>
    <span class="btn btn-light"><?= $page; ?></span>
    <?php else: ?>
    <a class="btn btn-secondary" href="<?= $route->generate(['page' => $page]); ?>"><?= $page; ?></a>
    <?php endif; ?>
    
<?php endfor; ?>
</div>

<?php endif; ?>
