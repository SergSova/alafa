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
  <h1><?php  echo $page['h1']; ?></h1> 

<div align="justify" >
	<meta itemprop="datePublished" content="<?php  echo $page['date']; ?>"/>
    <div class="new_date_read"><?php 
    $date_n_arr = explode("-", $page['date']);
     //echo $page['date']; ?>
     <?=$date_n_arr[2]?> <?=$month[$date_n_arr[1]]?> <?=$date_n_arr[0]?>
     </div>
    <?php if (!empty($page)){ ?>
   <div align="justify" > <?php  echo htmlspecialchars_decode($page['text']); ?></div>
    <?php } ?>
</div>
 