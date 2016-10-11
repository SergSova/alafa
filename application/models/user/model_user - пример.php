<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * predmets Model class
 * @author Ageev Alexey
 * @copyright  2011
 */

class model_user extends CI_Model {
    /**
     * Model constructor
     */
     function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//*************************************************************************************************
//*************************************************************************************************
function loadPages()   {
        // query performing 
        $query = "
            SELECT `id`, `module`, `note`, `menu_name`, `url`, `show_top` FROM `pages`
            WHERE `visible` = 1
            AND `parent_page` = 0 
             ORDER BY `number`
        ";
       // echo  $query; exit;
       // AND `id` !=1  
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                $data[] =array(
                     'id'      => $row['id'],
                     'url'                => $row['url'], 
                     'menu_name'   => $row['menu_name'],
                     'module'   => $row['module'],
                     'note'   => $row['note'],
                     'show_top'       => $row['show_top'], 
                     'childs'   => $this->loadPages_sub($row['id'] )
                   ); 
             }
        }
         return $data;             
    }
//*************************************************************************************************
function loadPages_full_tree()   {
        // query performing 
        $query = "
            SELECT `id`, `module`, `note`, `menu_name`, `url` FROM `pages`
            WHERE `visible` = 1
            AND `parent_page` = 0 
             ORDER BY `number`
        ";
       // echo  $query; exit;
       // AND `id` !=1  
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                $data[] =array(
                     'id'      => $row['id'],
                     'url'                => $row['url'], 
                     'menu_name'   => $row['menu_name'],
                     'module'   => $row['module'],
                     'note'   => $row['note'],
                     'childs'   => $this->loadPages_sub_tree($row['id'] )
                   ); 
             }
        }
         return $data;             
    }
 //*****************************************************************************
 function loadPages_sub($id_parent)   {
        // query performing 
        $query = "
            SELECT `id`, `parent_page`, `module`, `url`, `menu_name` FROM `pages`
            WHERE `parent_page` =  ".$id_parent."
            AND `visible` = '1'
            ORDER BY `number`
        ";
       // echo  $query; exit;
       // AND `id` !=1  
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                $data[] =array(
                     'id'            => $row['id'],
                     'parent_page'   => $row['parent_page'], 
                     'menu_name'     => $row['menu_name'],
                     'module'        => $row['module'],
                     'url'           => $row['url']
                   ); 
             }      // 'parent_page'   => $this->loadPage_name($row['parent_page']), 
        }
         return $data;             
    }    
   //*****************************************************************************   
   function loadPages_sub_tree($id_parent)   {
        // query performing 
        $query = "
            SELECT `id`, `parent_page`, `module`, `url`, `menu_name` FROM `pages`
            WHERE `parent_page` =  ".$id_parent."
            AND `visible` = 1
            ORDER BY `number`
        ";
       // echo  $query; exit;
       // AND `id` !=1  
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                $data[] =array(
                     'id'            => $row['id'],   
                     'menu_name'     => $row['menu_name'],
                     'module'        => $row['module'],
                     'url'           => $row['url']
                   ); // 'parent_page'   => $this->loadPage_name($row['parent_page']), 
             }
        }
         return $data;             
    }    
   //*****************************************************************************   
   //************************************************************************  
 function loadPage_name($parent_page)    {
        // query performing 
        $query = "
            SELECT `id`, `menu_name`, `url` FROM `pages`
            WHERE `id` = ".$parent_page."  
            LIMIT 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ;
                 $data =array(
                     'id'             => $row['id'],
                     'menu_name'      => $row['menu_name'] ,
                     'url'      => $row['url']
                     );                    
             }
        }
         return $data;             
    }
 //************************************************************************     
//*************************************************************************************************

 function loadIndexPage()
    {
         // query performing 
        $query = " SELECT * FROM `pages` WHERE `id`= 1  ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data = $row ; 
                 $data =array(
                     'id'      => $row['id'],
                     'title'   => $row['title'],
                     'descr'   => $row['descr'],
                     'kwd'     => $row['kwd'],
                     'h1'      => $row['h1'],
                     'text'    => $row['text'],
                     'module'   => $row['module'],
                     'note'    => $row['note']
                   );  
            }
        }
       // print_r($data); exit;
        return $data;             
    } 
   //*************************************************************************************************
     function loadPage($id)
    {
         // query performing
         // $this-> db-> query('SET NAMES utf8');   
        $query = " SELECT
                *
               FROM `pages`
            WHERE `id`= ".$id."
            LIMIT 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data = $row ; 
                 $data =array(
                     'id'      => $row['id'],
                     'url'   => $row['url'],
                     'title'   => $row['title'],
                     'descr'   => $row['descr'],
                     'kwd'     => $row['kwd'],
                     'menu_name'     => $row['menu_name'],
                     'h1'      => $row['h1'],
                     'text'    => $row['text'],
                     'note'    => $row['note'],
                     'module'   => $row['module'],
                     'parent_page'   => $this->loadPage_name($row['parent_page']),
                     'childs'   => $this->loadPages_sub_tree($row['id'] ) 
                   ); 
            }
        }
        //echo "<pre>"; print_r($data); exit;
        return $data;             
    }
 //*****************************************************************************
 function loadPage_by_module($module)
    {
         // query performing
         // $this-> db-> query('SET NAMES utf8');   
        $query = " SELECT
                *
               FROM `pages`
            WHERE `module` = '".$module."'
            LIMIT 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data = $row ; 
                 $data =array(
                     'id'      => $row['id'],
                     'title'   => $row['title'],
                     'descr'   => $row['descr'],
                     'kwd'     => $row['kwd'],
                     'menu_name'     => $row['menu_name'],
                     'h1'      => $row['h1'],
                     'text'    => $row['text'],
                     'note'    => $row['note'],
                     'module'   => $row['module'] 
                   ); 
            }
        }
       // print_r($data); exit;
        return $data;             
    }
 //*************************************************************************************************
   function loadPage_sub($id)
    {     
        $query = " 
            SELECT
            *
            FROM `pages_sub`
            WHERE `id`= $id
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data = $row ; 
                 $data =array(
                     'id'      => $row['id'],
                     'title'   => $row['title'],
                     'descr'   => $row['descr'],
                     'kwd'     => $row['kwd'],
                     'menu_name'     => $row['menu_name'],
                     'h1'      => $row['h1'],
                     'text'    => $row['text'],
                     'note'    => $row['note'],
                     'module'   => $row['module'] 
                   ); 
            }
        }
       // print_r($data); exit;
        return $data;             
    }
   
        //************************************************************
         
   //*****************************************************************************
 function loadBlocksIndex()
    {
        // query performing 
        $query = "
            SELECT * FROM `blocks`
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                  $data[] =array(
                     'id'                => $row['id'],
                     'menu_name'       => $row['menu_name'],
                     'text'       => $row['text']
                   ); 
             }
        }
         return $data;             
    } 
  //**********************************************************************************       
  
  //**************************************************************************************
       //************************************************************************
 function loadNewsForBlock_index()
    {
         $order = "  LIMIT 2"; 
        // query performing 
        $query = "
            SELECT `id`, `h1`, `date` ,`short_text`, `menu_name`, `url`, `picture` FROM `news`
            WHERE `visible` = 1
            ORDER by `date` DESC
            $order
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
      $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row; 
                     $data[] =array(
                     'id'            => $row['id'],
                     'url'           => $row['url'],
                     'date'          => $row['date'],
                     'h1'            => $row['h1'],
                     'menu_name'     => $row['menu_name'],
                     'short_text'    => $row['short_text'],
                     'picture'       => $row['picture'] 
                   );        
            }
        }    
         return $data;             
    }  
 //***************************************************************************************   
       //************************************************************************
 function loadNewsForBlock()
    {
         $order = "  LIMIT 5"; 
        // query performing 
        $query = "
            SELECT `id`, `h1`, `date` FROM `news`
            WHERE `visible` = 1
            ORDER by `date` DESC
            $order
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
      $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row; 
                     $data[] =array(
                     'id'                => $row['id'],
                     'date'      => $row['date'],
                     'h1'       => $row['h1']
                   );        
            }
        }    
         return $data;             
    }  
 //*************************************************************************************** 
  
 //*****************************************************************************************
  function add_feed_old($dataclient){
      
      
        $query = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 1 ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ;
                  $data =array(
                     'email'       => $row['value']
                   );
             }
        } 
      $datae = explode(",", $data['email']);
      for($i=0; $i<count($datae); $i++){
       //  $email[]   = "'".trim($datae[$i])."',";
       $email[]   = trim($datae[$i]); 
       // $email[]   = '"'.trim($datae[$i]).'"'; 
             }
       $emails = implode("," , $email);
    // echo $emails; exit();  
      ///////// мыльная отправка //////
                 
                          $to  = $emails;                
                          $subject = $dataclient['tema'] ; 
                          $message = " 
                          <html><body><p>
                          Имя - ".$dataclient['fio']." <br>    
                          Телефон  - ".$dataclient['phone']." <br> 
                          Email - ".$dataclient['email']." <br><br> 
                          Сообщение - ".$dataclient['text']." <br>
                          <br>
                          Дата сообщения  - ".date('Y-m-d', time())."
                          <hr>
                          Отправлено автоматически с сайта alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."   
                          </body></html>"; 
                      /*    
                      $headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <feedback@alafa.com.ua>\r\n"; 
                      $headers .= "From: Форма связи LiloСa<feedback@alafa.com.ua> \r\n";
                      $headers .= "Content-type: text/html; charset=windows-1251  \r\n";
                      */
                      
                      $from = 'Форма связи Мебель Taik';
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers  = "Content-type: text/html; charset=utf8 \r\n"; 
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <feedback@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <feedback@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                      
                      mail($to, $subject, $message, $headers); 
                      
                      //$subject = mb_convert_encoding($subject, "windows-1251", "UTF-8");
                      //$message = mb_convert_encoding($message, "windows-1251", "UTF-8");
                      //$headers = mb_convert_encoding($headers, "windows-1251", "UTF-8");
                      
                       
                     //mail($to, "=?utf-8?B?".base64_encode($subject)."?=",$message, $headers );   
/*
 $headers="Content-type: text/html; charset=UTF8  \r\n";
$headers.= "X-Mailer: PHP/".phpversion()."\r\n";
$headers.= "Reply-To: <feedback@alafa.com.ua>\r\n"; 
$headers.= "From: Форма связи LiloСa<feedback@alafa.com.ua> \r\n";
$headers.="Content-type: text/html; charset=UTF8  \r\n";
 */

//$message = convert_cyr_string ($message,w,k);
                     
                      // =?koi8-r?B?8NLP18XSy8E=?=    
                    // mail($to, "=?utf-8?B?".base64_encode($subject)."?=",$message, $headers ); 
                    //mail($to, "=?koi8-r?B?".base64_encode($subject)."?=", $message, $headers );  
                     
      /////// конец мыльной отправки ///////                       
              
//return $this->db->insert_id(); 
  return true; 
 
 }
 //*************************************************************************************** 
 function add_feed($dataclient){
      
     
      $this->write_log_feedback($dataclient);
      
        $query = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 1 ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ;
                  $data =array(
                     'email'       => $row['value']
                   );
             }
        } 
      $datae = explode(",", $data['email']);
      for($i=0; $i<count($datae); $i++){              
       $email[]   = trim($datae[$i]);              
             }
       $emails = implode("," , $email);
    // echo $emails; exit();  
      ///////// мыльная отправка //////
                 
                          $to  = $emails;                
                          $subject = "Форма связи alafa.com.ua"; 
                          $message = " 
                          <html><body><p>
                          Имя - ".$dataclient['fio']." <br>    
                          Телефон  - ".$dataclient['phone']." <br> 
                          Email - ".$dataclient['email']." <br><br> 
                          Тема  - ".$dataclient['subject']." <br>
                          Сообщение - ".$dataclient['text']." <br>
                          <br>
                          Дата сообщения  - ".date('Y-m-d', time())."
                          <hr>
                          Отправлено автоматически с сайта alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."   
                          </body></html>"; 
                 
                      
                      $from = 'Форма связи taik';
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers= "MIME-Version: 1.0\r\n";
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <feedback@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <feedback@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                      
                     mail($to, $subject, $message, $headers); 
                        
  return true; 
 
 }
 //*************************************************************************************** 
  //*************************************************************************************** 
 function add_feed_podzakaz($dataclient){
      
     
      $this->write_log_feedback($dataclient);
      
        $query = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 2 ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ;
                  $data =array(
                     'email'       => $row['value']
                   );
             }
        } 
      $datae = explode(",", $data['email']);
      for($i=0; $i<count($datae); $i++){              
       $email[]   = trim($datae[$i]);              
             }
       $emails = implode("," , $email);
    // echo $emails; exit();  
      ///////// мыльная отправка //////
                 
                          $to  = $emails;                
                          $subject = "Заявка на изготовление с alafa.com.ua"; 
                          $message = " 
                          <html><body><p>
                          Имя - ".$dataclient['fio']." <br>    
                          Телефон  - ".$dataclient['phone']." <br> 
                          Email - ".$dataclient['email']." <br><br> 
                          Товар  - ".$dataclient['subject']." <br>
                          Комментарий - ".$dataclient['text']." <br>
                          <br>
                          Дата сообщения  - ".date('Y-m-d', time())."
                          <hr>
                          Отправлено автоматически с сайта alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."   
                          </body></html>"; 
                 
                      
                      $from = 'Заявка на изготовление Taik';
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers= "MIME-Version: 1.0\r\n";
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <feedback@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <feedback@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                      
                     mail($to, $subject, $message, $headers); 
                        
  return true; 
 
 }
 //*************************************************************************************** 
  function ask_callback($dataclient){
      
      $this->write_log_callback($dataclient);
      
      
        $query = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 2 ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ;
                  $data =array(
                     'email'  => $row['value']
                   );
             }
        } 
      $datae = explode(",", $data['email']);
      for($i=0; $i<count($datae); $i++){              
       $email[]   = trim($datae[$i]);              
             }
       $emails = implode("," , $email);
    // echo $emails; exit();  
      ///////// мыльная отправка //////
                 
                          $to  = $emails;                
                          $subject = 'Запрос обратного звонка' ; 
                          $message = " 
                          <html><body><p>
                          Имя - ".$dataclient['name']." <br>    
                          Телефон  - ".$dataclient['phone']." <br>     
                          <br>
                          Дата сообщения  - ".date('Y-m-d', time())."
                          <hr>
                          Отправлено автоматически с сайта alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."   
                          </body></html>"; 
                 
                      
                      $from = 'Коллбек с Taik';
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers= "MIME-Version: 1.0\r\n";
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <callback_ask@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <callback_ask@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                      
                      mail($to, $subject, $message, $headers); 
                        
  return true; 
 
 }
  //************************************************************************  
 function write_log_callback($data){
  //  print_r($data); exit;        
 
  $mysql_insert="INSERT INTO `log_callback` (   
   `date_add`,        
   `name`, 
   `phone` 
   ) 
         VALUES (                              
         now(),    
         ".db_quote($data['name']).", 
         ".db_quote($data['phone'])." 
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
        
        
                 
return true;
     }
 //******************************************************************* 
       function write_log_feedback($data){
  //  print_r($data); exit;        
 
  $mysql_insert="INSERT INTO `log_feedback` (   
   `date_add`,        
   `name`, 
   `email`, 
   `topic`,
   `text`,
   `phone` 
   ) 
         VALUES (                              
         now(),    
         ".db_quote($data['fio']).", 
         ".db_quote($data['email']).", 
         ".db_quote($data['subject']).", 
         ".db_quote($data['text']).", 
         ".db_quote($data['phone'])." 
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
        
        
                 
return true;
     }
  //************************************************************************  
 function add_ask_card($dataclient){
      
   //  echo "<pre>";  print_r($dataclient);  exit();
      
        $query = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 2 ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ;
                  $data =array(
                     'email'       => $row['value']
                   );
             }
        } 
      $datae = explode(",", $data['email']);
      for($i=0; $i<count($datae); $i++){
      
       $email[]   = trim($datae[$i]);      
             }
       $emails = implode("," , $email);   
      ///////// мыльная отправка //////
        $birthday = $dataclient['birthday_year']."-".$dataclient['birthday_month']."-".$dataclient['birthday_day'];
        
        $date_time = date('Y-m-d H:m', time());
        $promo = "Нет"; $promo_en = 0; 
        $new_arivals = "Нет"; $new_arivals_en = 0; 
        $discount = "Нет";   $discount_en = 0; 
        if(isset($dataclient['promo'])) {$promo = " Да"; $promo_en = 1;}
        if(isset($dataclient['new_arivals'])) {$new_arivals = " Да"; $new_arivals_en = 1;}
        if(isset($dataclient['discount'])) {$discount = "Да"; $discount_en = 1;}
            
                          $to  = $emails;                
                          $subject = 'Запрос на пластиковую карту' ; 
                          $message = " 
                          <html><body><p>
                          Имя - ".$dataclient['name']." <br>
                          Фамилия - ".$dataclient['surname']." <br>   
                          Телефон  - ".$dataclient['phone']." <br> 
                          Email - ".$dataclient['email']." <br> 
                          Город - ".$dataclient['town']." <br> 
                          Адрес - ".$dataclient['adres']." <br>
                          Дата рождения - ".$birthday." <br>
                          
                          <b>Информация, которую хочу получать:</b> <br>
                          <ul>
                              <li> Акции - ".$promo." </li>
                              <li> Новые поступления - ".$new_arivals." </li>
                              <li> Скидки - ".$discount." </li>    
                          </ul>
                          Примечания - ".$dataclient['note']." <br>   
                       <br>
                          Дата запроса  - ".$date_time."
                          <hr>
                          Отправлено автоматически с сайта alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."    
                          </body></html>"; 
                      /*    
                      $headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <feedback@alafa.com.ua>\r\n"; 
                      $headers .= "From: Интернет-магазин Мебель Taik<feedback@alafa.com.ua> \r\n";
                         
                      $subject = mb_convert_encoding($subject, "windows-1251", "UTF-8");
                      $message = mb_convert_encoding($message, "windows-1251", "UTF-8");
                      $headers = mb_convert_encoding($headers, "windows-1251", "UTF-8");           
                      
                      mail($to, $subject, $message, $headers);
                      */
                      
                      $from = 'Интернет-магазин Мебель Taik';
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers  = "Content-type: text/html; charset=utf8 \r\n"; 
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <feedback@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <feedback@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                      
                      mail($to, $subject, $message, $headers); 
                      
      /////// конец мыльной отправки админу /////// 
     
     /////// начало мыльной отправки юзеру ///////  
              $to  = $dataclient['email']; 
              $subject = lang('main_anketa') ;   
              $message = " 
              <html><body><p>
             ".lang('main_anketa_letter')."  
             ".lang('main_letter_sign')."
              </p></body></html>";
              
                      $subject = mb_convert_encoding($subject, "windows-1251", "UTF-8");
                      $message = mb_convert_encoding($message, "windows-1251", "UTF-8");
                      $headers = mb_convert_encoding($headers, "windows-1251", "UTF-8");           
                      mail($to, $subject, $message, $headers);  
      
     /////// конец мыльной отправки юзеру ///////                   
 
 /* добавление заявки в базу */
   $birthday = $dataclient['birthday_year']."-".$dataclient['birthday_month']."-".$dataclient['birthday_day'];
     
           
     $mysql_insert = "INSERT INTO `form_approve_cdp` (
     `email`,  
     `surname`, 
     `name`,       
     `birthday`,  
     `town`,
     `adres`,      
     `phone`,
     `note`,   
     `promo`,  
     `new_arivals`,
     `discount`,   
     `date_form`  
      ) 
         VALUES (
         ".db_quote($dataclient['email'])." ,
         ".db_quote($dataclient['surname'])." ,
         ".db_quote($dataclient['name'])." ,       
         ".db_quote($birthday)." ,                 
         ".db_quote($dataclient['town'])." ,
         ".db_quote($dataclient['adres'])." ,      
         ".db_quote($dataclient['phone'])." ,
         ".db_quote($dataclient['note'])." ,
         ".db_quote($promo_en)." ,
         ".db_quote($new_arivals_en)." ,
         ".db_quote($discount_en)." ,  
         ".db_quote($date_time)." 
         )";
 
        $this->db->query($mysql_insert);
 
 
  return true; 
 
 }     
 //**************************************************************************************
//**************************************************************************************
     
 //**************************************************************************************
    function loadNews($start_limit)
    {
         $order = "  LIMIT $start_limit, 10"; 
        // query performing 
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * FROM `news`
            WHERE `visible` = 1
            ORDER by `date` DESC
            $order
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query,$start_limit);
      $data = array();
         if ($dbres->num_rows() >= 1) {
           
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
            
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row; 
                    $data['list'][] = array( 
                     'id'      => $row['id'],
                     'url'      => $row['url'],   
                     'title'   => $row['title'],
                     'descr'   => $row['descr'],
                     'kwd'     => $row['kwd'],
                     'menu_name'      => $row['menu_name'],
                     'h1'      => $row['h1'],
                     'short_text'    => $row['short_text'],
                     'picture'    => $row['picture'],
                     'text'    => $row['text'],
                     'date'    => $row['date']
                   );      
            }
        }    
         return $data;             
    }
      //**********************
    function count_all_news() 
   { 
   $sql = "SELECT COUNT(*) as `count` FROM `news`";
    $query = $this->db->query($sql);
    $row = $query->result_array();
  //  echo $row[0]['count']; 
 // print_r($row);
 // exit();
    return $row[0]['count'];
     
   } 
  //*****************************************************   
       function loadNew($id)
    {
  
        $query = " SELECT * FROM `news`
            WHERE `id`= ".$id ." 
            AND `visible` = 1
            LIMIT 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data = $row ; 
                 $data = array(
                     'id'      => $row['id'],
                     'url'   => $row['url'],
                     'title'   => $row['title'],
                     'descr'   => $row['descr'],
                     'kwd'     => $row['kwd'],
                     'h1'      => $row['h1'],
                     'menu_name'      => $row['menu_name'],
                     'text'    => $row['text'],
                     'date'    => $row['date']
                   ); 
            }
        }
       // print_r($data); exit;
        return $data;             
    }   
//***************************************************************************   
//***************************************************************************
  
      //**********************
   function loadErrorPage()
    {
         // query performing 
        $query = " SELECT * FROM `pages` WHERE `module`= '404' LIMIT 1 ";
        // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 $data = $row ; 
                /* $data =array(
                     'id'      => $row['id'],
                     'title'   => $row['title-rus'],
                     'descr'   => $row['descr-rus'],
                     'kwd'     => $row['kwd-rus'],
                     'h1'      => $row['h1-rus'],
                     'text'    => $row['text-rus'],
                     'module'  => $row['module'],
                     'note'    => $row['note']
                   );  */
            }
        }
       // print_r($data); exit;
        return $data;             
    } 
//**************************************************************************************
//************************************************************************************** 

 function load_User_Settings()
    {
        //echo "===========load_User_Settings==============";
        $user = $this->session->userdata;
          $query = "
            SELECT * FROM `customers_users`
            WHERE `email`=  ".db_quote($user['email'])." 
            AND  `id`=  ".db_quote($user['user_id'])."  
            LIMIT 1
              ";
       // echo  $query; exit();  
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ; 
                 $data[] =array(
                     'id'      => $row['id'],
                     'email'   => $row['email'],
                     'name'   => $row['name'],
                     'surname'   => $row['surname'],
                     'byfather'   => $row['byfather'], 
                     'gender'   => $row['gender'],
                     'birthday'   => $row['birthday'],
                     'town'   => $row['town'],  
                     'adres'   => $row['adres'],   
                     'phone_mob'   => $row['phone_mob'],
                     'contacts'   => $row['contacts'],
                     'active'   => $row['active'],
                     'subscr'   => $row['subscr'],
                     'bonus'    => $row['bonus'],
                     'date_reg'   => $row['date_reg']
                   );    
                  
            }
        }    
        return $data;            
    } 
   //******************************************************************************
   //******************************************************************************
   function edit_general_settings($data){
          $id = $this->session->userdata('user_id');
          $bd_upd='';
          if(isset($data['birthday_year'])) {
          $birthday = $data['birthday_year']."-".$data['birthday_month']."-".$data['birthday_day'];   
        $bd_upd = "`birthday`   = ".db_quote($birthday).",";  
          }
       $mysql_update = "UPDATE `customers_users` SET 
   `name`       = ".db_quote($data['ed_name']).",
   `surname`    = ".db_quote($data['ed_surname']).",
   `byfather`        = ".db_quote($data['ed_byfather']).",
   $bd_upd
   `gender`    = ".db_quote($data['gender'])."
           WHERE `id`='".$id."'
            ";
          //  echo  $mysql_update; exit();   
         $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    } 
  //******************************************************************************
  function edit_contact_settings($data){
       $id = $this->session->userdata('user_id'); 
       if(!empty($data['contacts'])) {
        foreach($data['contacts'] as $key=>$value) {
             if ( is_array( $value ) && trim($value['datas']) =='' ) {  
                unset( $data['contacts'][$key] );
          
                }
       
      $sorteddata = serialize($data['contacts']); 
       }
       }
        else{$sorteddata='';}   
         $mysql_update = "UPDATE `customers_users` SET 
   `contacts`       = ".db_quote($sorteddata)."
           WHERE `id`= ".$id." 
            ";
          //  echo  $mysql_update; exit();   
         $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
 //******************************************************************************
   function edit_access_email_settings($data){
       $id = $this->session->userdata('user_id');   
       $mysql_update = "UPDATE `customers_users` SET 
   `email`     = ".db_quote($data['ed_email'])."
           WHERE `id`= ".$id." 
            ";
          //  echo  $mysql_update; exit();   
         $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
  //******************************************************************************
   function edit_adres_settings($data){
       $id = $this->session->userdata('user_id');
       
       /*if($data['region']=='0'){
       $region = $data['region_old'];
       }else{$region = $data['region']; }
       if($data['town']=='0'){
       $town = $data['town_old'];
       }else{$town = $data['town']; } */   
        $region='';
       // $town = '';
        $data['postindex']='';
          
       $mysql_update = "UPDATE `customers_users` SET 
       `town`     = ".db_quote($data['town'])." ,
       `phone_mob`     = ".db_quote($data['phone_mob'])." ,  
       `adres`     = ".db_quote($data['adres'])."
           WHERE `id`= ".$id." 
            ";
          // echo  $mysql_update; exit(); 
         //   `region`     = ".db_quote($region)." ,
          // `town`     = ".db_quote($town).",  
         $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }   
  //******************************************************************************
   function edit_access_pass_settings($data){
       $id = $this->session->userdata('user_id');   
       $mysql_update = "UPDATE `customers_users` SET 
   `pass`      = ".db_quote(base64_encode($data['newpass']))."
           WHERE `id`= ".$id." 
            ";
          //  echo  $mysql_update; exit();   
         $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }             
  //***************************************************
  function load_Regions()   {
        // query performing 
        $query = "
            SELECT * FROM `region`
            WHERE 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                $data[] =array(
                     'id'      => $row['id'],
                     'name'   => $row['name']
                   ); 
             }
        }
         return $data;             
    }    
   //*****************************************************************************
     function load_Towns($region_id)   {
        // query performing 
        $query = "
            SELECT `id`, `name` FROM `city`
            WHERE `region_id` =  ".$region_id." 
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                $data[] =array(
                     'id'      => $row['id'],
                     'name'   => $row['name']
                   ); 
             }
        }
         return $data;             
    }
 //************************************************************************
 function loadRegionName($id)   {
        // query performing 
        $query = "
            SELECT `id`, `name` FROM `region`
            WHERE `id` =  ".$id." 
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 $data  = $row ;
              /*  $data[] =array(
                     'id'      => $row['id'],
                     'name'   => $row['name']
                   );    */
             }
        }
         return $data;             
    }    
   //*****************************************************************************
     function loadTownName($id)   {
        // query performing 
        $query = "
            SELECT `id`, `name` FROM `city`
            WHERE `id` =  ".$id." 
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data  = $row ;
                /*  $data[] =array(
                     'id'      => $row['id'],
                     'name'   => $row['name']
                   );    */
             }
        }
         return $data;             
    } 
    
//******************************************************************    
function loadStatus_Info($id)   {
          $query = "
            SELECT *
               FROM `customers_groups`
            WHERE `id_group` =  ".$id." 
            LIMIT 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data = $row;
             }
        }
         return $data;             
    } 
//************************************************************************  
function send_cdp_form($data_cdp_form){
        /* Отправка на почту юзеру уведомленя, что его заявка принята к рассмотрению */
    $id_user = $data_cdp_form['user_id'];  
      $query = "
            SELECT `id`, `email` FROM `customers_users`
            WHERE `id`=  ".$id_user." 
         ";
      //  echo  $query; exit(); 
        $dbres = $this->db->query($query);

        $dataforsend = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $dataforsend = $row ;
             }
        }
      
              $to  = $dataforsend['email']; 
              $subject = 'Смена партнёрской программы' ;   
              $message = " 
              <html><body><p>
               
              Уважаемый пользователь,  <br> 
              Вы получили это сообщение, так как данный ящик был указан при регистрации учётной записи на ресурсе 
              ".base_url().".  <br> 
               Ваш запрос для смены партнёрской программы на 
                CDP (Customers Discount Programm) был отправлен администрации ресурса.<br>  
               О результатах вы будуте извещены в письме.
              <br>
               
              <br>
              Благодарим за пользование нашим сервисом.
              <br>
              <br>
              <hr>
              Магазин ".base_url()." 
              </p></body></html>"; 

          //  $headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
            $headers  = "Content-type: text/html; charset=utf-8  \r\n";  
            $headers .= "From:  Мебель Taik<sales@alafa.com.ua> \r\n";
           //  mail($to, $subject, $message, $headers);
           
           
      // - email to admin from settings - begin     
        $queryadmmail = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 2 ";
        $dbres = $this->db->query($queryadmmail);
        $dataadmmail = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $dataadmmail =array(
                     'email'       => $row['value']
                   );
             }
        } 
      $datae = explode(",", $dataadmmail['email']);
      for($i=0; $i<count($datae); $i++){            
       $email[]   = trim($datae[$i]);               
             }
       $emails = implode("," , $email);
     // - email to admin from settings - end        
           
             
             // $to_admin  = 'elenaolf@mail.ru, kunkanstudio@gmail.com'; 
              $to_admin  = $emails;
              $subject_admin = "Заявка на карту - ".$dataforsend['email'] ;   
              $message_admin = "Новый Запрос на пластиковую карту от  ".$dataforsend['email'];
              mail($to_admin, $subject_admin, $message_admin, $headers);     

    
    
    
    
    /* добавление заявки в базу */
   $birthday = $data_cdp_form['birthday_year']."-".$data_cdp_form['birthday_month']."-".$data_cdp_form['birthday_day'];
     
           
     $mysql_insert = "INSERT INTO `form_approve_cdp` (
     `email`,  
     `surname`, 
     `name`, 
     `byfather`,  
     `birthday`,     
     `region`,
     `town`,
     `adres`,
     `postindex`,
     `phone`,
     `from_know`,   
     `user_id`,  
     `user_main_group`,
     `to_group`,
     `approve`,
     `date_form`  
      ) 
         VALUES (
         ".db_quote($data_cdp_form['email'])." ,
         ".db_quote($data_cdp_form['surname'])." ,
         ".db_quote($data_cdp_form['name'])." ,
         ".db_quote($data_cdp_form['byfather'])." ,
         ".db_quote($birthday)." ,
         ".db_quote($data_cdp_form['region'])." ,
         ".db_quote($data_cdp_form['town'])." ,
         ".db_quote($data_cdp_form['adres'])." ,
         ".db_quote($data_cdp_form['postindex'])." ,
         ".db_quote($data_cdp_form['phone'])." ,
         ".db_quote($data_cdp_form['from_know'])." ,
         ".db_quote($data_cdp_form['user_id'])." ,
         ".db_quote($data_cdp_form['user_main_group'])." ,
         ".db_quote($data_cdp_form['to_group'])." ,
         '0' ,
         now()
         )";
 
        $this->db->query($mysql_insert);
     return true;       
     }
             
//************************************************************************************
 
//************************************************************************************ 
  //*************************************************************************************************  
 function Trafic_Add($data_stat){
  //  print_r($data_stat); exit();  
 /* 
  $cookie = array(
                   'name'   => 'taik_camed_from',
                   'value'  => $data_stat['url_from'],
                   'expire' => '2592000',
                   'domain' => base_url(),
                   'path'   => '/',
                   'prefix' => 'taik_',
               );

set_cookie($cookie); 
*/       
   
$mysql_insert="INSERT INTO `trafic` ( 
           `ip`,
           `user_agent`,
           `to_url`,
           `from_url`,
           `from_domain`,
           `date` 
           ) 
         VALUES (
         ".db_quote($data_stat['ip']).",
         ".db_quote($data_stat['user_agent']).",
         ".db_quote($data_stat['url_to']).",
         ".db_quote($data_stat['url_from']).", 
         ".db_quote($data_stat['domain_from']).",
         now() 
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
                 
return true;
     }    
  //************************************************************************    
  function loadTownNameForSearch ($term)              
    { 
    $term = trim($term);  
       $query = "
            SELECT `name` FROM `city`
            WHERE `name` LIKE '".$term."%'
            GROUP BY `name`
            LIMIT 15
            ";
         $dbres = $this->db->query($query);
        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data[] = $row ;               
            }
         }      
        return $data;           
    }
//************************************************************************************ 
//*************************************************************************************************
function loadSlides()   {
        // query performing 
        $query = "
            SELECT `id`, `text`, `menu_name`,  `preview`, `url` FROM `slides`
            WHERE `visible` = 1   
            ORDER BY `number`
        ";
       // echo  $query; exit;
       // AND `id` !=1  
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                $data[] =array(
                     'id'      => $row['id'],   
                     'menu_name'   => $row['menu_name'],   
                     'text'   => $row['text'],
                     'url'    => $row['url'], 
                     'preview'   => $row['preview'] 
                   ); 
             }                                                      
        }
         return $data;             
    }
  //******************************************************************************
   function edit_subscr_settings( $status ){
       $id = $this->session->userdata('user_id');   
       $mysql_update = "UPDATE `customers_users` SET 
   `subscr`     = ".db_quote($status)."
           WHERE `id`= ".$id." 
            ";
          //  echo  $mysql_update; exit();   
         $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
  //******************************************************************************    
//************************************************************************************************* 
//************************************************************************************  
//************************************************************************************  
//************************************************************************************  
//************************************************************************************  
}
?>