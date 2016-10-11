
<?php if(!empty($docs)) { ?>
 
<?php // echo "<pre>"; print_r($news); exit(); ?>
<?php  foreach($docs as $price_item){ 
$path_info = '';

$file_picture = '/media/images/save.png';
if (isset($price_item['file']) && !empty($price_item['file']) && file_exists($price_item['file']) ){
	
$path_info = pathinfo($price_item['file']);

if(in_array($path_info['extension'], array('jpg', 'png', 'gif', 'bmp', 'tiff') ) ) { /*$file_picture = '/media/images/plakat1.jpg';*/ $file_picture = '/'.$price_item['file']; $width = 260; $click = ''; }
if(in_array($path_info['extension'], array('doc', 'docx', 'rtf', 'odt') ) ) {$file_picture = '/media/images/msword.jpg'; $width = 60;}
if(in_array($path_info['extension'], array('xls', 'xlsx') ) ) {$file_picture = '/media/images/msexcel.jpg'; $width = 60;}
if(in_array($path_info['extension'], array('txt') ) ) {$file_picture = '/media/images/file_txt.png'; $width = 60;}
if(in_array($path_info['extension'], array('pdf') ) ) {$file_picture = '/media/images/pdf.png'; $width = 60;}
}
 ?>

  <div class="prices"> 
       <div class="prices_leftside">   
         <a href="<?=base_url();?><?php echo $price_item['file']?>" target="_blank" title="<?=lang('main_user_nazhmite_dlya_skachivania')?>">
         <img src="<?=$file_picture?>" width="<?=$width?>"  border="0" /> 
         </a>
       </div>
       <div class="prices_rightside">
       <div class="prices_header"><a href="<?=base_url();?><?php echo $price_item['file']?>" target="_blank"> <?=lang('main_user_download')?> <strong>"<?=$price_item['menu_name']?>"</strong> </a></div>
  
         <div class="prices_short_text"> <?=$price_item['text']?> </div> 
         
       </div>
    <!--</div>  -->    
    <br clear="all">
</div>
<?php } ?>
 

<?php } ?>

</div>