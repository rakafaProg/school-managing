





<div class="ui small test modal transition">
  <h1 class="ui header <?= $messageColor ?>">
      <?= $messageHead ?>
  </h1>
  <div class="content">
    <p class="ui header blue"><?= $messageMain ?></p>
  </div>
  <div class="actions">
    <a class="ui positive button" href="<?= $messageURL ?>">
      <?php if (isset($messageOK)) echo $messageOK; else echo "OK";?>
    </a>

    <a class="ui blue button <?php if (!isset($messageOK)) echo 'invisible' ?> "
      href="<?php if (isset($cancelURL)) echo $cancelURL; ?>">Cancel </a>
  </div>

</div>


<script>

$( document ).ready(function() {

  $('.ui.modal.test')
  .modal('setting', 'closable', false)
  .modal('show')
  ;
});



</script>
