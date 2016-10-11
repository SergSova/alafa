<?php      $user = $this->session->userdata;
  // echo "<pre>";
  // print_r($user); 
   // ====================================
     if ( isset($user['user_id']) && !empty($user['user_id']) && !isset($user['status']) && isset($user['email'])  ) {
      
       echo '<div align="center">
<div align="center" style=" padding:20px; border: 1px solid #09004f; background-color:#09004f; color: #ffffff; width: 500px; border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px; -webkit-border-radius: 5px 5px 5px 5px;"> На данный момент в этом браузере вы авторизированы как пользователь. <br> Для входа в панель управления необходимо воспользоваться другим браузером <br> или завершить сеанс пользователя и войти в панель управления
 </div>
</div>';
       exit();
     }
    // ==================================== 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

 <title>Администратор | alafa.com.ua</title>
 
<link href="<?php echo base_url();?>media/images/user-password.png" rel="icon" type="image/x-icon"> 
<link href="<?php echo base_url();?>media/css/admin/style_admin.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>js/jquery-1.5.1.min.js" type="text/javascript"></script>
<!-- jquery-ui.min.js   jquery-ui-1.8.9.custom.min.js  -->
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.min.js"></script> 
<link type="text/css" href="<?php echo base_url();?>css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" /> 
 <!-- ui-lightness blitzer  -->	
 

<!--<script src="<?php echo base_url();?>js/jquery.accordion.js" type="text/javascript"></script> -->
<script src="<?php echo base_url();?>js/jquery.jgrowl_minimized.js" type="text/javascript"></script>
<link href="<?php echo base_url();?>js/jquery.jgrowl.css" rel="stylesheet" type="text/css">
 
<script type="text/javascript" src="<?php echo base_url();?>js/colorpicker/colorpicker.js"></script>
 <link rel="stylesheet" href="<?php echo base_url();?>js/colorpicker/colorpicker.css" type="text/css" />
 <script>
$(document).ready(function(){ 



$('#colorpickerField').ColorPicker({
  onSubmit: function(hsb, hex, rgb) {
    $('#colorpickerField').val(hex);
  },
  onBeforeShow: function () {
    $(this).ColorPickerSetColor(this.value);
  }
 })
.bind('keyup', function(){
  $(this).ColorPickerSetColor(this.value);
});

  
});
</script>

<!-- PopUp   -->
<script type="text/javascript">
function toggle_show(id) {
        document.getElementById(id).style.display = document.getElementById(id).style.display == 'none' ? 'block' : 'none';
}


function open_menu(id) {
	var qas = document.getElementById(id).getElementsByTagName('ul');
	//qas[0].style.display = qas[0].style.display == 'none' ? 'block' : 'none';
	qas[0].style.display = qas[0].style.display == 'block' ? 'none' : 'block';
 }
</script>
    
<script type="text/javascript">
$(document).ready(
  function()
  {
  	$(".listtable tr").mouseover(function() {
  		$(this).addClass("over");
  	});
  
  	$(".listtable tr").mouseout(function() {
  		$(this).removeClass("over");
  	});
  	
  	$(".listtable tr:even").addClass("alt");
  }
);
</script>
<script type="text/javascript">
$(document).ready(
  function()
  {
  	$("#sortable li").mouseover(function() {
  		$(this).addClass("over");
  	});
  	$("#sortable li").mouseout(function() {
  		$(this).removeClass("over");
  	});
  	$("#sortable li:even").addClass("alt");
  }
);

 
$(document).ready(
  function()
  { 
  	$("#sortable_photo li").mouseover(function() {
  		$(this).addClass("over");
  	});
  	$("#sortable_photo li").mouseout(function() {
  		$(this).removeClass("over");
  	});
  	$("#sortable_photo li:even").addClass("alt");
	///// 
  } 
);
</script>

<script type='text/javascript'>
 
 
</script>
	<script type="text/javascript">
	jQuery().ready(function(){
		$.jGrowl.defaults.closer = false;
		
		jQuery('#languages').accordion({
			autoheight: false
		});

	});
	 
(function($) {
$(function() {

	$('ul.tabs').delegate('li:not(.current)', 'click', function() {
		$(this).addClass('current').siblings().removeClass('current')
			.parents('div.section').find('div.box').hide().eq($(this).index()).fadeIn(150);
	})

})
})(jQuery)




	</script>

</head>
<body>
<div align="center" class="gen_block">