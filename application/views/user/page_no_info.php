<?php if (!empty($page)){ ?>
<div align="justify" class="content_page"> 
<?php if ($page['h1']!='') { ?><div><h1><?=$page['h1']?></h1></div><?php } ?>
<?php  echo $page['text']; ?>
</div>
<?php } ?>