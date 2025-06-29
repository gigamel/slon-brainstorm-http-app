<?= $this->block($this, 'layout/header.php', ['title' => 'Contact']); ?>

<h1>Contact</h1>
<p>This is example of HTTP App built by Slon Framework...</p>

<?= $this->block($this, 'form/contact.php', ['form' => $form]); ?>
            
<?= $this->block($this, 'layout/footer.php'); ?>
