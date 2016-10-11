<br /><br />
<?php if(!empty($news['list'])) { ?>
 <?php 
 $month = array(
								"00"=>"00",
								"01"=>lang('main_user_month_1'),
								"02"=>lang('main_user_month_2'),
								"03"=>lang('main_user_month_3'),
								"04"=>lang('main_user_month_4'),
								"05"=>lang('main_user_month_5'),
								"06"=>lang('main_user_month_6'),
								"07"=>lang('main_user_month_7'),
								"08"=>lang('main_user_month_8'),
								"09"=>lang('main_user_month_9'),
								"10"=>lang('main_user_month_10'),
								"11"=>lang('main_user_month_11'),
								"12"=>lang('main_user_month_12')
								);
	  
	  ?>

<?php // echo "<pre>"; print_r($news); exit(); ?>
<?php  foreach($news['list'] as $art_list){ 
$date_n_arr = explode("-", $art_list['date']);
 ?>

  <div class="new">
        <!--<div class="new_short_right"> -->
       <div class="new_leftside">
         <div class="new_date"><?=$date_n_arr[2]?> <?=$month[$date_n_arr[1]]?> <?=$date_n_arr[0]?> </div>
         
         <?php $description = strip_tags(htmlspecialchars_decode($art_list['short_text']), '<i><u><b><strong>'); //<i><u><b><strong><img>
		 	  $description = mb_substr($description ,0,300);   ?> 
         <?php if(!empty($art_list['thumb'])) { ?>
         <img src="<?php echo base_url().$art_list['thumb'];?>" width="230"  border="0" /> 
         <?php } ?>
       </div>
       <div class="new_rightside">
  <div class="new_header"><a href="<?=base_url();?><?=lang('main_lang')?>/<?php echo $art_list['url']?>"> <?=$art_list['h1']?> </a></div>
         <div class="new_short_text">  <?=$description?>...  </div> 
         <div class="more">  <a href="<?=base_url();?><?=lang('main_lang')?>/<?php echo $art_list['url']?>"><?=lang('main_read_more')?></a> </div>
       </div>
    <!--</div>  -->    
    <br clear="all">
</div>
<?php } ?>

<?php if(isset($pages_code)) echo $pages_code; ?> 

<?php } ?>

</div>
 