<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
      <div class="container">
        <a class="navbar-brand" href="/">SlonFramework</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?= $this->route('blog_list'); ?>">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $this->route('contact'); ?>">Contact</a>
            </li>
          </ul>
        </div>
        <div class="d-flex">
          <a href="<?= $this->route('login'); ?>" class="btn btn-outline-primary">Login</a></div>
        </div>
      </div>
    </nav>
    <main>
      <div class="container">
        <div class="row">
          <div class="col-12">
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
                  href="<?= $this->route('blog_post', ['slug' => $post->slug]); ?>"
                  class="btn btn-primary"
                >More</a>
              </p>
            </div>
            <?php endforeach; ?>
            
          </div>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>
