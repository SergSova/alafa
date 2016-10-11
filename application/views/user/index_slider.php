 <?php  if (isset($slides) && !empty($slides)){ ?> 
          <div class="slider">
          <ul id="slides1">
          <?php foreach($slides as $slide){ ?>  
          <li link-path="<?php if (trim($slide['url']!='')) {echo $slide['url'];} else { echo "#";}?>" class="slide" style="background:url(<?=$slide['preview']?>) no-repeat center;">
          <div class="slidecontent"><?=$slide['text']?></div>
          </li>
          <?php  } ?> 
          </ul>
          </div>
 <?php  } ?> 