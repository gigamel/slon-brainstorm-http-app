<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <!--<li class="nav-item">
          <a class="nav-link" target="_blank" href="<?= $this->route('blog_list'); ?>">Blog Manager</a>
        </li>-->
      </ul>
    </div>
    <div class="d-flex">
      <a href="<?= $this->route('home'); ?>" class="btn btn-outline-primary">Site</a></div>
      <a href="<?= $this->route('logout'); ?>" class="btn btn-outline-primary">Logout</a></div>
    </div>
  </div>
</nav>
