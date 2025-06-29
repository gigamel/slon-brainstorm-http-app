<?= $this->block($this, 'layout/header.php', ['title' => $post->title]); ?>

<h1><?= $post->title; ?></h1>

<div class="contents mb-3"><?= $post->contents; ?></div>

<p>
  <a class="btn btn-primary" href="<?= $backward ?? $this->route('blog_list'); ?>">Backward</a>
</p>
            
<?= $this->block($this, 'layout/footer.php'); ?>
