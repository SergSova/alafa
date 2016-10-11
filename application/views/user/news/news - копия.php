
<?php if(!empty($news['list'])) { ?>
 <?php // echo "<pre>"; print_r($news); exit(); ?>
<?php  foreach($news['list'] as $art_list){  ?>
<div class="new_header"><a href="<?=base_url();?><?=lang('main_lang')?>/<?php echo $art_list['url']?>"> <?=$art_list['h1']?> </a></div>
  <div class="new">
        <div class="new_short_right">
  		<div class="new_date"> <?php $date_arr = explode("-", $art_list['date']); ?>
   		<?="<span class='bold'>".$date_arr[2]."/".$date_arr[1]."</span> ".$date_arr[0]?> </div>
        <?php $description = strip_tags(htmlspecialchars_decode($art_list['short_text']), '<i><u><b><strong>'); //<i><u><b><strong><img>
		 	  $description = mb_substr($description ,0,300);   ?> 
       <?php if(!empty($art_list['thumb'])) { ?>
       	<img src="<?php echo base_url().$art_list['thumb'];?>" width="150"  border="0" align="left" /> 
       <?php } ?>
       <div class="new_short_text"> <a href="<?=base_url();?><?=lang('main_lang')?>/<?php echo $art_list['url']?>">  <?=$description?>... </a></div> 
       <div class="more">  <a href="<?=base_url();?><?=lang('main_lang')?>/<?php echo $art_list['url']?>"><?=lang('main_read_more')?></a> </div>
    </div>     
    <br clear="all">
</div>
<?php } ?>

<?php if(isset($pages_code)) echo $pages_code; ?> 

<?php } ?>

</div>
 