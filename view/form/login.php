<?php /** @var \App\Form\Login\LoginForm $form */ ?>

<form action="" name="login" method="POST" autocomplete="off">
  <div class="mb-3">
    <label for="email" class="form-label">E-mail</label>
    <input type="text" class="form-control" name="email" id="email" value="<?= $form->getAccount()->getEmail(); ?>">
  </div>
  <?php if ($form->hasError('email')): ?>
    <p class="text-danger"><?= $form->getError('email'); ?></p>
  <?php endif; ?>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password">
  </div>
  <?php if ($form->hasError('password')): ?>
    <p class="text-danger"><?= $form->getError('password'); ?></p>
  <?php endif; ?>
  <button type="submit" class="btn btn-primary">Send</button>
</form>
