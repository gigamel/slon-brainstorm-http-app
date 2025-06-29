<?= $this->block($this, 'layout/header.php', ['title' => 'Contact']); ?>

<h1>Contact</h1>
<p>This is example of HTTP App built by Slon Framework...</p>
<form action="" name="mailer" method="POST" autocomplete="off">
  <div class="mb-3">
    <label for="email" class="form-label">E-mail</label>
    <input type="email" class="form-control" name="email" id="email">
  </div>
  <div class="mb-3">
    <label for="message" class="form-label">Message</label>
    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Send</button>
</form>
            
<?= $this->block($this, 'layout/footer.php'); ?>
