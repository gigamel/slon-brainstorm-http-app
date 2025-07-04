<?= $this->block($this, 'layout/header.php', ['title' => 'Blog']); ?>

<h1 class="mb-3">Blog</h1>

<?php if (!$posts): ?>
<p>Empty list...</p>
<?php endif; ?>

<?php foreach ($posts as $post): ?>
<hr />
<div class="post mt-3">
  <h3><?= $post->title; ?></h3>
  <p><?= $post->preview; ?></p>
  <p><?= $post->preview; ?></p>
  <p>
    <a
      href="<?= $this->route('blog_post', ['slug' => $post->slug]); ?>?from=<?= $page; ?>"
      class="btn btn-primary"
    >More</a>
  </p>
</div>
<?php endforeach; ?>

<?= $this->pagination($this, 'layout/pagination.php', $paginator, $route); ?>

<?= $this->block($this, 'layout/footer.php'); ?>
