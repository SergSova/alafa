 <?php if (!empty($pages)): ?>
  <?php  $count_pages = count($pages);  ?> 
  <table id="menu" cellpadding="0" cellspacing="0"> 
  <tr> 
    <?php for($i=0; $i<$count_pages; $i++){
		if($pages[$i]['note']!='parnters') {
		$new_bg = '';
                  $url = lang('main_lang')."/".$pages[$i]['url']; 
                  if($pages[$i]['id']=='1'){$url = '';} 
                  if($pages[$i]['module']=='news'){$url = lang('main_lang').'/news';}  
				  if($pages[$i]['module']=='bonus'){$url = lang('main_lang').'/bonuses';}
                  ?> 
    <td class="menu <?php echo $new_bg;  if (isset($current_page) && $current_page==$pages[$i]['id']) {echo 'current';} ?>" > 
      <a href="<?php echo base_url();?><?=$url?>"  <?php // if (isset($current_page) && $current_page==$pages[$i]['id']) {echo 'class="current"';} ?> > 
        <?=$pages[$i]['menu_name']?> 
        </a>  
      </td>
    <?php } } ?> 
  </tr>  	
  </table>
  <?php endif ?>