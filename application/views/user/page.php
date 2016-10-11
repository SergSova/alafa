<?php if (!empty($page)){ ?>
<div>
<?php if(isset($page['h1']) && !empty($page['h1']) && !isset($index))  { echo "<h1>".$page['h1']."</h1>";} ?>
<?php  echo htmlspecialchars_decode($page['text']); ?>
    <?php // if (isset($form)){  $this->load->view('user/'.$form);}?>
</div>
<?php } ?>

  
 
 
