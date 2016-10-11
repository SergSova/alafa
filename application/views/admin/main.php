 
<?php $this->load->view('admin/header');?> 
<?php  $admin = $this->session->userdata;
$power = explode(",", $admin['power']);

if($admin['status']=='manager'){ 

if (in_array("blocks", $power)) $blocks = true;
if (in_array("pages", $power)) $pages = true;
if (in_array("pages_custom", $power)) $pages_custom = true;
if (in_array("slider", $power)) $slider = true;
if (in_array("gallery", $power)) $gallery = true;
if (in_array("news", $power)) $news = true;
 
if (in_array("comments", $power)) $comments = true; 
if (in_array("tabs", $power)) $tabs = true;
 
if (in_array("orders", $power)) $orders = true; 
if (in_array("stat", $power)) $stat = true; 
if (in_array("settings", $power)) $settings = true;



}
 
 if($admin['status']=='admin'){  
 
  $blocks = true;
  $pages = true;
  $pages_custom = true;
  $slider = true;
  $gallery = true;
  $news = true;
 
  $tabs = true;

  $customers = true;
  $orders = true; 
  $stat = true; 
  $settings = true;

 }

$open = $this->session->userdata('open_menu'); 
//echo $open;
 ?>
 <script type="text/javascript">
$(document).ready(function(){

    $(".show_hide_sb").toggle(
      function () {
        $(".menu_sidebar").hide();
		$(".show_hide_sb").text('Показать меню');
      },
      function () {
        $(".menu_sidebar").show();
		$(".show_hide_sb").text('Скрыть меню');
      }  
    );

  });
</script> 
<!--<div class="show_hide_sb">Скрыть меню</div> -->
<table width="99%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
<tr>
  <td width="240" align="center" valign="top" class="menu_sidebar"><div class="admin-logo-bg">
    <img src="<?=base_url()?>media/css/user/img/alafa.jpg" width="50" align="middle">  
    </div>     <!--  bgcolor="#00FF99"  width="240" -->
    <div id="menu_dd">
      <ul>
        <!--<?php if(isset($blocks)){ ?>
               
             <?php }?>    -->
        <li class="menu-header li_1" id="pages" onclick="open_menu('pages');">Страницы  
          <ul <?php  if ($open=='pages') {echo ' style="display:block;" ';}  ?>>
            <?php if(isset($pages)){ ?>
            <li><a href="<?php echo base_url();?>manage_pages/show_pages" title="Главное меню"  class="a_2">Главное меню</a></li> 
            <?php }?>
            
            <?php if(isset($news )){ ?>
            <li><a href="<?php echo base_url();?>manage_news/show_news" title="Новости">Новости</a></li>
            <li><a href="<?php echo base_url();?>manage_news/show_reviews" title="Отзывы">Отзывы</a></li>
            <?php }?>
            <?php if(isset($blocks )){ ?>
            <li><a href="<?php echo base_url();?>manage_blocks/show_blocks" title="Блоки">Блоки</a></li>  
            
            <?php }?>
            
            <?php if(isset($gallery )){ ?>
            <!--<li><a href="<?php echo base_url();?>manage_objects" title="Фотогалерея">Фотогалерея</a></li>-->
            <!--<li><a href="<?php echo base_url();?>manage_objects/show_videos" title="Видео">Видео</a></li>-->
            <!--<li><a href="<?php echo base_url();?>manage_slides" title="Слайдер на главной">Слайдер на главной</a></li>-->
            <?php }?>
            </ul>
          </li>
        
        <?php if(isset($customers)){ ?>
        <li class="menu-header"  id="customers" onclick="open_menu('customers');">Пользователи и оплата
          <ul <?php  if ($open=='customers') {echo ' style="display:block;" ';}  ?>> 
            <li><a href="<?php echo base_url();?>manage_customers/show_customers" title="Клиенты">Список пользователей</a></li>
            <li><a href="<?php echo base_url();?>manage_customers/edit_levels" title="Уровни пользователей">Уровни пользователей и тариф</a></li>
            <li><a href="<?php echo base_url();?>manage_payments/show_payments" title="Оплата">Оплаты онлайн</a></li>
            <li><a href="<?php echo base_url();?>manage_payments/show_order_vivods" title="Запросы вывода">Запросы комиссии</a></li>
            
            </ul>
          </li>
        <?php }?>          
        
        <?php // if($admin['status']=='admin'){
			 	 if(isset($stat)){  ?>
        <li class="menu-header li_1"  id="stats" onclick="open_menu('stats');">Статистика
          <ul <?php  if ($open=='stats') {echo ' style="display:block;" ';}  ?>>
            
            <li><a href="<?php echo base_url();?>manage_statistic/trafic" title="Трафик">Трафик входящий</a></li>
            </ul>
          </li>  
        <?php }   ?>
        
        
        <?php if($admin['status']=='admin'){ ?>
        <li class="menu-header li_1" id="settings" onclick="open_menu('settings');">Настройки
          <ul <?php  if ($open=='settings') {echo ' style="display:block;" ';}  ?>>
            <li><a href="<?php echo base_url();?>manage_settings/settings" title="Администраторы и Почта">Администраторы и Почта</a></li> 
            <li><a href="<?php echo base_url();?>manage_letter_templ/show_letter_templ" title="Блоки">Шаблоны писем</a></li>  
            
            <!--<li><a href="<?php echo base_url();?>manage_converter/scan_url_duplicates" title="Проверить дубли УРЛ" target="_blank">Проверить дубли УРЛ</a></li> -->
            
            <!--<li><a href="<?php echo base_url();?>manage_offer/generate_rss_xml" title="Создать свежий RSS.xml" target="_blank">Создать свежий RSS.xml</a></li> --> 
            
            <!--<li><a href="<?php echo base_url();?>manage_offer/generate_sitemap_xml" title="Создать свежий sitemap.xml" target="_blank">Создать свежий sitemap.xml</a></li>  -->
            
            
            <li><a href="<?php echo base_url();?>manage_settings/show_order_template" title="Шаблон письма при выписке счета для перехода на новый уровень">Шаблон квитанции</a></li> 
            
            <!--<li><a href="<?php echo base_url();?>manage_ban" title="Блокировка доступа">Блокировка доступа</a></li> -->
            </ul>
          </li>
        <?php }?>
        
        
        <!-- 0000000000 -->   
        
        <li class="menu-exit"><a href="<?php echo base_url();?>managment/logout" title="Выйти из панели управления">Выйти</a></li>      
        <!-- 11111111111111 -->   
        </ul>
    </div>
    <!--  <ul id="menu">
</ul> -->
    </td>
  <td align="left" valign="top">
      <div align="justify" class="container"> 
        <?php if (isset($template) && !empty($template)) { //  !empty($template) ?> 
        <?php $this->load->view('admin/'.$template);?> 
        <?php } ?>
        <div class="empty"> &nbsp; </div>
        </div>
    
    </td>
</tr>
  </tbody>
</table>
<?php $this->load->view('admin/footer');?>
<?php $this->session->sess_update_time();  ?>