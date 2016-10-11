<?php 


 /*
   $len = strlen($_SERVER['REQUEST_URI']); 
if(substr($_SERVER['REQUEST_URI'], -1) != '/'  && $len >= 3 && substr($_SERVER['REQUEST_URI'] , -4, 4) !='html' ){ 
	$newuri = $_SERVER['REQUEST_URI'].'/'; 
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: $newuri");
	exit();
} */
if( strpos( $_SERVER['REQUEST_URI'], 'index.php' ) !== false ) {
 
	 header("HTTP/1.1 404 Not Found"); 
} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php /*  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  */ ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  >
<meta charset="utf-8">
    
 <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon"  >
  
<?php if(isset($rel_prev)) { echo $rel_prev; } ?> 
<?php if(isset($rel_next)) { echo $rel_next; } ?>   

<?php if($_SERVER['REQUEST_URI']=='/ru' || $_SERVER['REQUEST_URI']=='/ru/') { ?>
<link rel="canonical" href="http://alafa.com.ua"/>	
<?php } ?>     

<title><?php

if(isset($page['title']) && !empty($page['title'])){
	$title = $page['title'].lang('main_shop_name') ; // Багги туры Akiv.ua  .lang('main_shop_name')
	}
	else if(isset($page['menu_name'])) {
	$title = $page['menu_name'].lang('main_shop_name') ;	//  | Багги туры alafa.com.ua
	}
	else if(!isset($page['menu_name']) && isset($page['h1']) ) {
	$title = $page['h1'].lang('main_shop_name')  ;// .lang('main_shop_name')	
	}
	else {
	$title = "alafa.com.ua";	
	}
echo $title; 
?></title>
<meta name = "description" content="<?php
if(isset($page['descr'])){
	$descr = $page['descr']."  ";
	}
	else {
	$descr = " ";	
	}
echo $descr;
?>">
<meta name = "keywords" content="<?php
if(isset($page['kwd'])){
	$kwd = $page['kwd'];
	}
	else {
	$kwd = "";	
	}
echo $kwd;
?>">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>media/css/user/style.css" >

<script src="<?php echo base_url();?>js/jquery-1.8.3.min.js" type="text/javascript"></script>  
<script type="text/javascript" src="<?php echo base_url();?>js/script.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.cookie.js"></script> 

<script> 
  function show_p_w(id) {   
	 $(".metka_content").fadeOut(500, 'swing');  
	 $("#metka_content_"+id).fadeIn(500, 'swing');  
	 }
	 
  $(document).click(function(event) {
    if ($(event.target).closest(".metka_content, .metka_point").length) return;
    $(".metka_content").fadeOut(500, 'swing');  
	 
    event.stopPropagation();
  });	 	 
 <?php
 $selected_lang = '';
 $selected_lang = $this->session->userdata('selected_lang');  
 if(isset($selected_lang) && !empty($selected_lang)){ ?>
	// alert('Установлен через сессию язык <?=$selected_lang?>');
 <?php }  ?> 
 
  

  </script>
 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-83908065-1', 'auto');
  ga('send', 'pageview');

</script>
</head> 
<body> 