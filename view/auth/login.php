<?= $this->block($this, 'layout/header.php', ['title' => 'Login']); ?>

<h1>Login</h1>

<?= $this->block($this, 'form/login.php', ['form' => $form]); ?>
            
<?= $this->block($this, 'layout/footer.php'); ?>
