<script type="text/javascript" src="<?php echo base_url();?>js/jquery.date_input.js"></script>
<script type="text/javascript">
$(function() {
  $("#date_input1").date_input();
  $("#date_input2").date_input();
});
</script>   
<?php $myip = '109.86.137.253';

$searchEngines=array(
'images.google.'=>array('q','prev'),
'bing.com'=>'q',
'.alot.'=>'q',
'a993.com'=>'q1',
'abcsok.'=>'q',
'alltheweb.'=>'q',
'altavista.'=>'q',
'aol.'=>array('q','query','encquery'),
'aolsvc.'=>'query',
'avantfind.com'=>'keywords',
'bonvote.com'=>'search',
'bonweb.com'=>'search',
'comcast.net'=>'q',
'conduit.'=>'q',
'eniro.se'=>'search_word',
'excite.'=>'search',
'google.'=>array('q','as_q'),
'gogo.ru'=>'q',
'yandex.'=>array('text','query'),
'ya.ru'=>'text',
'hotbot.'=>'query',
'icerocket.com'=>'q',
'icq.com'=>'q',
'isheyka.com'=>'q',
'midco.net'=>'q',
'live.com'=>'q',
'msn.'=>'q',
'yahoo.'=>array('p','k'),
'search.'=>'q',
'kvasir.no'=>'q',
'myway.com'=>'searchfor',
'netscape.'=>array('q','query'),
'oceanfree.net'=>'as_q',
'qip.ru'=>'query',
'sweetim.com'=>'q',
'tut.by'=>'query',
'ukr.net'=>'search_query',
'search.oboz.ua'=>'k',
'search.www.infoseek.co.jp'=>'qt',
'.setooz.com'=>'query',
'toile.com'=>'q',
'vinden.nl'=>'q',
'.i.ua'=>'q',
'.mail.ru'=>array('q','tag'),
'.onru.ru'=>'q',
'aport.ru'=>'r',
'find.ru'=>'text',
'gde.ru'=>array('keywords','query','t','search_query','id'),
'go.km.ru'=>'sq',
'meta.ua'=>'q',
'metabot.ru'=>'st',
'nerus.ru'=>'query',
'nigma.ru'=>array('s','pq'),
'nova.rambler.ru'=>'query',
'poisk.ru'=>'text',
'protonet.ru'=>'q',
'rambler.ru'=>'words',
'tyndex.ru'=>'pnam',
'webalta.ru'=>'q',
'exactseek.com'=>array('q','query'),
'lycos.' => 'query',
'ask.' => 'q',
'cnn.' => 'query',
'looksmart.' => 'qt',
'about.' => 'terms',
'mamma.' => 'query',
'gigablast.' => 'q',
'voila.' => 'rdata',
'virgilio.' => 'qs',
'baidu.' => 'wd',
'alice.' => 'qs',
'najdi.' => 'q',
'club-internet.' => 'q',
'mama.' => 'query',
'seznam.' => 'q',
'netsprint.' => 'q',
'szukacz.' => 'q',
'yam.' => 'k',
'pchome.' => 'q',
);

  ?>
<div class="td-caption-top" align="left">Трафик на сайте. <?php if(isset($day_trafic['total'])){echo " Сегодня переходов  &rarr; ".$day_trafic['total'];} ?></div>
<div align="justify" id="content">
 
<form name="filter_stat_form"  id="filter_stat_form" action="<?php echo base_url();?>manage_statistic/trafic_filter" method="post"  enctype="multipart/form-data">
<table width="100%" cellspacing="0" cellpadding="0" align="center" class="filter_header border_rad_5"><!--table-u-b  table_filter -->
   <tr>
    <td width="120" rowspan="2" align="center" class="filterpanel-t"><a href="<?php echo base_url();?>manage_statistic/trafic"  class="tlink_white" >Сегодня</a></td>
    <td class="filterpanel-t" align="center" width="120">Начальная дата</td>  
    <td class="filterpanel-t" align="center" width="120">Конечная дата</td>
    <td width="120" rowspan="2" align="center" class="filterpanel-t">
      <div align="center">
        <input name="btn" class="button" type="submit" value="Фильтровать" />
      </div></td>
    <td class="filterpanel-t"></td>
  </tr>
  <tr>
  <td class="filterpanel-b">
    <div align="center">
      <input name="date_input1" id="date_input1" type="text"  value="<?php if (isset($_POST['date_input1'])) echo $_POST['date_input1']; ?>" size="15"/>
      </div>
  </td>
    <td class="filterpanel-b">
      <div align="center">
        <input name="date_input2" id="date_input2" type="text"  value="<?php if (isset($_POST['date_input2'])) echo $_POST['date_input2']; ?>" size="15"/>
        </div>
    </td>
    <td class="filterpanel-b"> </td>
  </tr>
</table>
</form>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="f_s_11">
 
  <tr>
    <td> 
   <?php if(isset($day_trafic['trafic_list'])){?>
   <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="listtable" >
   <tr>
            <td class="td-caption-h" width="100" align="left">Дата</td>
            <td class="td-caption-h" width="80" align="left">IP </td>
            <td class="td-caption-h" width="100" align="left">Откуда</td>
            <td class="td-caption-h" width="130" align="left">Запрос (для ПС)</td> 
            <td class="td-caption-h" align="left">Откуда(точнее)</td>
            <td class="td-caption-h" align="left">User Agent</td>
            <td class="td-caption-h" width="130" align="left">Куда</td>
   </tr>       
     <?php // print_r($day_trafic['trafic_list']);
	   foreach($day_trafic['trafic_list'] as $trafic){
		   if($trafic['ip']!=$myip) { ?>
           <?php
		   $s_word = '';
		   $color_str = '';
		   if($trafic['from_url']!='n/a'){
			   $tmp = parse_url(urldecode(trim($trafic['from_url'])));
			  // print_r($tmp);
				$site = $tmp['host'];
			//////////////	
				if(isset($tmp['query'])){
					
					$str = $tmp['query'];
					//echo $str."<br>";
					//parse_str($str,$arr);
					parse_str($str,$arr);
				
				foreach ($searchEngines as $key=>$value)
				{
				if(substr_count($site, $key))
				{
				foreach ($arr as $k=>$v)
				{
				if(is_array($value))
				{
				if(in_array ("$k",$value))
				{$s_word = $v; break;}
				}
				elseif("$k" == $value) {$s_word = $v; break;}
				else {$s_word = ""; break;} // none word
				}
				break;
				}
				}
				//if(isset($s_word)) {echo $s_word; $color_str = ' style="background-color: #c4f2c5;"   ';};
				if(isset($s_word) && $s_word!='') { $color_str = ' style="background-color: #c4f2c5;" ';};
			 } ////////////// 
		   }
		   ?>
           <tr>
           <td class="column"><?=$trafic['date']?></td>
           <td class="column"> <?=$trafic['ip']?> </td>
           <td class="column"> <?=$trafic['from_domain']?> </td> 
           <td class="column" align="left"  <?=$color_str?> style="border-left:1px solid #390; border-right:1px solid #390; color:#400000;">
           <?php  if(isset($s_word) && $s_word!='') {echo $s_word;} ?>
           </td>
           <td class="column" style="font-size:9px;"> <?=urldecode($trafic['from_url'])?> </td>
           <?php $color = '';
		   //$pos_google = stripos($trafic['user_agent'], 'google.com/bot');
		    if(strstr($trafic['user_agent'], 'google.com/bot')) { $color = ' style="background-color: #bedfe9;" ';}
		   		// $pos_yandex = stripos($trafic['user_agent'], 'yandex.com/bots');
			if(strstr($trafic['user_agent'], 'yandex.com/bots')) { $color = ' style="background-color: #ffffaa;" ';}
				// $pos_mailru = stripos($trafic['user_agent'], 'Mail.RU/2.0'); 
			if(strstr($trafic['user_agent'], 'Mail.RU/2.0')) { $color = ' style="background-color: #f2f0ca;" ';} 
				// $pos_bingbot = stripos($trafic['user_agent'], 'bingbot'); 
			if(strstr($trafic['user_agent'], 'bingbot')) { $color = ' style="background-color: #ffdfdf;" ';}	
		  //style="font-size:9px;"  ?>
           <td class="column fs_8"  style="font-size:9px;"  <?=$color?>> <?php // echo $color." - - - - - - "; 
           // if( strstr($trafic['user_agent'], 'google.com/bot')) echo "11111"; ?> <?=$trafic['user_agent']?> </td>
           <td class="column" style="font-size:9px;"><?php
		   if($trafic['to_url']!='/'){
		   echo  base_url().ltrim($trafic['to_url'], "/"); 
			  }
			  else{
				  echo  base_url(); 
				  }
			//echo $trafic['to_url'];
			 ?></td>
          </tr>
       <?php 
	  }
	   } ?> 
   </table>
   <?php } else { echo "Записей нет"; } ?>
   <!--  список с подробностями - конец --> 
    
    </td>
    <!--<td width="50%">&nbsp;</td> -->
  </tr>
</table>
 
</div>

 
