<?php /** @var \App\Form\Contact\ContactForm $form */ ?>

<form action="" name="contact" method="POST" autocomplete="off">
  <div class="mb-3">
    <label for="email" class="form-label">E-mail</label>
    <input type="text" class="form-control" name="email" id="email" value="<?= $form->getContact()->getEmail(); ?>">
  </div>
  <?php if ($form->hasError('email')): ?>
    <p class="text-danger"><?= $form->getError('email'); ?></p>
  <?php endif; ?>
  <div class="mb-3">
    <label for="message" class="form-label">Message</label>
    <textarea class="form-control" id="message" name="message" rows="3"><?= $form->getContact()->getMessage(); ?></textarea>
  </div>
  <?php if ($form->hasError('message')): ?>
    <p class="text-danger"><?= $form->getError('message'); ?></p>
  <?php endif; ?>
  <button type="submit" class="btn btn-primary">Send</button>
</form>