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
