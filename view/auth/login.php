<?= $this->block($this, 'layout/header.php', ['title' => 'Login']); ?>

<h1>Login</h1>
<form action="" name="mailer" method="POST" autocomplete="off">
  <div class="mb-3">
    <label for="email" class="form-label">E-mail</label>
    <input type="email" class="form-control" name="email" id="email">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password">
  </div>
  <button type="submit" class="btn btn-primary">Send</button>
</form>
            
<?= $this->block($this, 'layout/footer.php'); ?>
