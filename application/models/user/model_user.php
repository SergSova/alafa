<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  Model class
 * @author Ageev Alexey
 * @copyright  2016
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
function lang()
    {
        return "-" . lang('main_lang_ident'); // ".$this->lang()."
    }

//*************************************************************************************************
function loadPages()   {
        // query performing 
        $query = "
            SELECT `id`, `module`, `note`, `url`,  `show_top`, `menu_name" . $this->lang() . "`  FROM `pages`
            WHERE `visible` = '1'   
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
                     'url'   => $row['url'],
                     'menu_name'   => $row['menu_name' . $this->lang()],
                     'show_top'   => $row['show_top'],
                     'module'   => $row['module'],
                     'note'   => $row['note'] 
                   ); 
             } 
        }
         return $data;             
    }

//*************************************************************************************************
function loadSlides()   {
        // query performing 
        $query = "
            SELECT `id`, `menu_name".$this->lang()."` as `menu_name`,  `preview`, `thumb` FROM `slides`
            WHERE `visible` = 1   
            ORDER BY `number`
        ";
    //   echo  $query; exit;
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
                     'thumb'    => $row['thumb'], 
                     'preview'   => $row['preview'] 
                   ); 
             }                                                      
        }
       // echo " 99999999999999 <pre>";  print_r($data); exit();         
         return $data;             
    }
  //******************************************************************************
 
 //*************************************************************  
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
                     'title'   => $row['title'.$this->lang()],
                     'descr'   => $row['descr'.$this->lang()],
                     'kwd'     => $row['kwd'.$this->lang()],
                     'h1'      => $row['h1'.$this->lang()],
                     'text'    => $row['text'.$this->lang()],
                     'module'   => $row['module'],
                     'note'    => $row['note']
                   );  
            }
        }
       // print_r($data); exit;
        return $data;             
    } 
   //*************************************************************************************************
   
   function loadErrorPage()
    {
         // query performing 
        $query = " SELECT * FROM `pages` WHERE `module`= '404'  ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data = $row ; 
                 $data =array(
                     'id'      => $row['id'],
                     'title'   => $row['title'.$this->lang()],
                     'descr'   => $row['descr'.$this->lang()],
                     'kwd'     => $row['kwd'.$this->lang()],
                     'h1'      => $row['h1'.$this->lang()],
                     'text'    => $row['text'.$this->lang()],
                     'module'   => $row['module'],
                     'note'    => $row['note']
                   );  
            }
        }
       // print_r($data); exit;
        return $data;             
    } 
   //*************************************************************************************************
     function loadPage($id)  // $id
    {
      // query performing                           
        $query = " 
            SELECT
            *
            FROM `pages`
            WHERE `id` = ".$id."
          
        "; //   AND `visible`= 1
       
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data = $row ; 
                 $data =array(
                     'id'      => $row['id'],
                     'title'   => $row['title'.$this->lang()],
                     'descr'   => $row['descr'.$this->lang()],
                     'kwd'     => $row['kwd'.$this->lang()],
                     'h1'      => $row['h1'.$this->lang()],
                     'text'    => $row['text'.$this->lang()],
                     'menu_name'     => $row['menu_name'.$this->lang()], 
                     'note'    => $row['note'],
                     'module'  => $row['module'] 
                         
                   ); 
                   // 'style'   => $this->load_dog_icon($row['style'])    
            }
        }
       // print_r($data); exit;
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
            WHERE `module` =  '".$module."' 
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
                     'title'   => $row['title'.$this->lang()],
                     'descr'   => $row['descr'.$this->lang()],
                     'kwd'     => $row['kwd'.$this->lang()],
                     'h1'      => $row['h1'.$this->lang()],
                     'text'    => $row['text'.$this->lang()],
                     'menu_name'     => $row['menu_name'.$this->lang()],  
                     'note'    => $row['note'],
                     'module'   => $row['module']  
                           
                   ); 
            } // 'style'   => $this->load_dog_icon($row['style'])  
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
                     'title'   => $row['title'.$this->lang()],
                     'descr'   => $row['descr'.$this->lang()],
                     'kwd'     => $row['kwd'.$this->lang()],
                     'h1'      => $row['h1'.$this->lang()],
                     'text'    => $row['text'.$this->lang()],
                     'menu_name'     => $row['menu_name'.$this->lang()], 
                     'note'    => $row['note'],
                     'module'   => $row['module'] 
                   ); 
            }
        }
       // print_r($data); exit;
        return $data;             
    }
 //*****************************************************************************
 function loadPages_sub($id_parent)   {
        // query performing 
        $query = "
            SELECT `id`, `parent_page`, `module`, `note`, `menu_name".$this->lang()."` as `menu_name` FROM `pages_sub`
            WHERE `parent_page` =   ".$id_parent." 
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
                     'id'      => $row['id'],
                     'parent_page'      => $row['parent_page'],
                     'menu_name'   => $row['menu_name'],
                     'module'   => $row['module'],
                     'note'   => $row['note']
                   ); 
             }
        }
         return $data;             
    }    
   //*****************************************************************************     
        //************************************************************
       //************************************************************************
 function loadNewsForBlock_index()
    {
         $order = "  LIMIT 3"; 
        // query performing 
        $query = "
            SELECT `id`,  `h1".$this->lang()."` as `h1`, `date` , `short_text".$this->lang()."` as `short_text`, `menu_name".$this->lang()."` as `menu_name`, `url` FROM `news`
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
                     'short_text'    => $row['short_text']
                   );        
            }
        }    
         return $data;             
    }  
 //***************************************************************************************           
   //*****************************************************************************
 function loadBlocksIndex()
    {
        // query performing 
        $query = "
            SELECT * FROM `blocks`
            ORDER BY `id` ASC
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
                     'text'    => $row['text'.$this->lang()],
                     'menu_name'     => $row['menu_name'.$this->lang()], 
                   ); 
             }
        }
         return $data;             
    } 
  //**********************************************************************************       
  
  //**************************************************************************************
  
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
  function add_feed($dataclient){
      
      
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
        
        $emails = $data['email'];
    /*  $datae = explode(",", $data['email']);
      for($i=0; $i<count($datae); $i++){              
       $email[]   = trim($datae[$i]);              
             }
       $emails = implode("," , $email);*/
    // echo $emails; exit();  
      ///////// мыльная отправка //////
                 
                          $to  = $emails;                
                          $subject = $dataclient['tema'] ; 
                          $message = " 
                          <html><body><p>
                          Имя - ".$dataclient['fio']." <br>    
                          Телефон  - ".$dataclient['phone']." <br> 
                          Email - ".$dataclient['email']." <br><br> 
                          Тема сообщения - <b>".$dataclient['tema']."</b> <br>
                          Сообщение - ".$dataclient['text']." <br>
                          <br>
                          Дата сообщения  - ".date('Y-m-d', time())."
                          <hr>
                          Отправлено автоматически с сайта alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."   
                          </body></html>"; 
                 
                      
                      $from = 'Форма связи madbuggy';
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
 
 //*****************************************************************************************
  function add_zapros_vivoda($dataclient){
   //echo "<pre>"; print_r($dataclient); exit;   
   $order_id = $this->write_log_zaros_vivoda($dataclient);  
   $user_id = $this->session->userdata('user_id');
    
        $query = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 3 ";
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
        
        $emails = $data['email'];
                 
                          $to  = $emails;                
                          $subject = "Коммиссия  #".$order_id." | этап ".$dataclient['target']." | уровень ".$dataclient['from_level'] ; 
                          $message = " 
                          <html><body><p>
                          Тема сообщения - Запрос #".$order_id."</b> <br><br>
                          Запрос #".$order_id."<br>
                          Имя - ".$dataclient['user_info']['name']." <br>    
                          Телефон  - ".$dataclient['user_info']['phone']." <br> 
                          Email - ".$dataclient['user_info']['email']." <br><br> 
                          
                          Персональный реферальный код - ".$user_id." <br><br> 
                          Ваш ИНН - ".$dataclient['user_info']['inn']." <br><br> 
                          Этап, с которого производить вывод - ".$dataclient['target']." <br><br> 
                          Уровень рефералов, с которого производить вывод - ".$dataclient['from_level']." <br><br> 
                          Сумма  - ".$dataclient['summa']." <br><br> 
                          ADV Cash кошелек - ".$dataclient['user_info']['adv_uid']." <br><br>  
                          
                          
                          Комментарий пользователя - ".$dataclient['text']." <br>
                          <br>
                          Дата сообщения  - ".date('Y-m-d', time())."
                          <hr>
                          Отправлено автоматически с сайта alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."   
                          </body></html>"; 
                  
                      $from = 'Запрос комиссии';
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers= "MIME-Version: 1.0\r\n";
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <komissia@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <komissia@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                      
                      mail($to, $subject, $message, $headers); 
                        
  return true; 
 
 }
 //*************************************************************************************** 
 //******************************************************************* 
       function write_log_zaros_vivoda($data){
 // echo "<pre>";  print_r($data); exit;        
 $user_id = $this->session->userdata('user_id');
 //if($data['target']==$data['id']) { $data['target'] = 0;}
 $time = time();   
 
 if($data['user_info']['referal'] == $user_id) { $data['user_info']['referal'] = 0;}
 
  $mysql_insert="INSERT INTO `orders_vivod` (   
   `datetime_create`,        
   `user_id`, 
   `referal_id`,
   `inn`, 
   `target`,
   `from_level`,
   `price`,
   `email`,
   `adv_uid`, 
   `ip_payer`,
   `comment`, 
   `phone`  
   ) 
         VALUES (                              
         ".$time.",    
         ".db_quote($user_id).", 
         ".db_quote($data['user_info']['referal']).", 
         ".db_quote($data['user_info']['inn']).", 
         ".db_quote($data['target']).", 
         ".db_quote($data['from_level']).", 
         ".db_quote($data['summa']).", 
         ".db_quote($data['user_info']['email']).",  
         ".db_quote($data['user_info']['adv_uid']).", 
         ".db_quote($_SERVER['REMOTE_ADDR']).", 
         ".db_quote($data['text']).", 
         ".db_quote($data['user_info']['phone'])."  
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
        
      $order_id = $this->db->insert_id();  
                 
return $order_id;
     }
  //************************************************************************  
 //*****************************************************************************************
  function add_partners_feed($dataclient){
      
      
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
        
        $emails = $data['email'];
 
                 
                          $to  = $emails;                
                          $subject = 'Заявка партнерства с MadMax' ; 
                          $message = " 
                          <html><body><p>
                          Имя - ".$dataclient['fio']." <br>    
                          Телефон  - ".$dataclient['phone']." <br> 
                          Email - ".$dataclient['email']." <br><br> 
                          Организация - <b>".$dataclient['company']."</b> <br>
                          Сообщение - ".$dataclient['text']." <br>
                          <br>
                          Дата сообщения  - ".date('Y-m-d', time())."
                          <hr>
                          Отправлено автоматически с сайта alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."   
                          </body></html>"; 
                 
                      
                      $from = 'Форма партнерства madbuggy';
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
                 
                      
                      $from = 'Коллбек с madbuggy';
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
            AND `type` = 'new'
            ORDER by `date` DESC, `number` ASC
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
                     'title'   => $row['title'.$this->lang()],
                     'descr'   => $row['descr'.$this->lang()],
                     'kwd'     => $row['kwd'.$this->lang()],
                     'h1'      => $row['h1'.$this->lang()],
                     'text'    => $row['text'.$this->lang()],
                     'menu_name'     => $row['menu_name'.$this->lang()],                      
                     'short_text'    => $row['short_text'.$this->lang()], 
                     'date'    => $row['date'] ,
                     'thumb'    => $row['thumb']
                   );      
            }
        }    
         return $data;             
    }
//********************************************************************************************
function loadNews_all_list()
    {                                            
        // query performing 
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * FROM `news`
            WHERE `visible` = 1
            ORDER by `date` DESC, `number` ASC  
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
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
                     'title'   => $row['title'.$this->lang()],
                     'descr'   => $row['descr'.$this->lang()],
                     'kwd'     => $row['kwd'.$this->lang()],
                     'h1'      => $row['h1'.$this->lang()],
                     'text'    => $row['text'.$this->lang()],
                     'menu_name'     => $row['menu_name'.$this->lang()],  
                     'short_text'    => $row['short_text'.$this->lang()], 
                     'date'    => $row['date'] ,
                     'thumb'    => $row['thumb']
                   );      
            }
        }    
         return $data;             
    }
//********************************************************************************************
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
//********************************************************************************************
     
 //**************************************************************************************
    function loadreviews($start_limit)
    {
         $order = "  LIMIT $start_limit, 10"; 
        // query performing 
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * FROM `news`
            WHERE `visible` = 1
            AND `type` = 'review'
            ORDER by `date` DESC, `number` ASC
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
                     'title'   => $row['title'.$this->lang()],
                     'descr'   => $row['descr'.$this->lang()],
                     'kwd'     => $row['kwd'.$this->lang()],
                     'h1'      => $row['h1'.$this->lang()],
                     'text'    => $row['text'.$this->lang()],
                     'menu_name'     => $row['menu_name'.$this->lang()],  
                     'short_text'    => $row['short_text'.$this->lang()], 
                     'date'    => $row['date'] ,
                     'thumb'    => $row['thumb']
                   );      
            }
        }    
         return $data;             
    }
//********************************************************************************************
    function count_now_users() 
   { 
   $sql = "SELECT COUNT(*) as `count` FROM `customers_users` ";
    $query = $this->db->query($sql);
    $row = $query->result_array();
 
    return $row[0]['count'];
     
   }    
  //*******************************************************************************************   
       function loadNew($id)
    {
  
        $query = " SELECT * FROM `news`
            WHERE `id`= ".$id ." 
            AND `visible` = 1
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
                     'title'   => $row['title'.$this->lang()],
                     'descr'   => $row['descr'.$this->lang()],
                     'kwd'     => $row['kwd'.$this->lang()],
                     'h1'      => $row['h1'.$this->lang()],
                     'text'    => $row['text'.$this->lang()],
                     'date'    => $row['date'] 
                   ); 
            } // 'offers'      => $this->load_offers_To_New($row['id']) 
        }
       // print_r($data); exit;
        return $data;             
    }   
//***************************************************************************   
 //******************************************************************
 function load_offers_To_New($id)   
    {
        // query performing 
        $query = "
           SELECT * 
            FROM `goods_info`
            WHERE `id` IN (
                SELECT `good_id` FROM `news_good_links`
                WHERE `new_id` =  ".$id."  )  
            AND `visible` = 1 
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
               //   $data[] = $row ;
                 $data[] = array(
                     'articul'            => $row['articul'],
                     'id'                 => $row['id'], 
                     'url'            => $row['url'],     
                     'menu_name'          => $row['menu_name-rus'],   
                     'price'              => $row['wholesale'],   
                     'new_good'           => $row['new_good'],
                     'hit'                => $row['hit'],            
                     'promotional'        => $row['promotional'],
                     'promotional_price'  => $row['promotional_price'], 
                     'brand'              => $row['brand'],                                   
                     'number'             => $row['number'],
                     'visible'            => $row['visible'],
                     'picture'        => $this->loadThumbsTooffer($row['id']),
                     'brand'              => $this->loadBrand_by_Id($row['brand']), 
                     'parent_category'    => $this->loadCategoryName($row['parent_category']),    
                      
                   );              
        }  
                      
        }           
         return $data;             
    }
  // ******************************************************************************** 
    //************************************************************************************  
  function loadThumbsTooffer($id)    {
        // query performing 
        $query = "
            SELECT * FROM `goods_images`
            WHERE `parent_offer` = '".$id."'
            AND `visible` = 1                  
            ORDER BY `number`
            LIMIT 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ;
                 $data = array(
                     'id'      => $row['id'],                        
                     'thumb'     => $row['thumb'] 
                   ); 
             }
        }
         return $data;             
    }    
//************************************************************************************ 
//**************************************************************************************
//*************************************************************************************************

 function load_User_Settings()
    {
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
                     'phone'   => $row['phone'],
                     'contacts'   => $row['contacts'],
                     'active'   => $row['active'],
                     'date_reg'   => $row['date_reg'],
                     'subscr'   => $row['subscr'] ,
                     'urik_edrpou'   => $row['urik_edrpou'] ,
                     'urik_name'   => $row['urik_name'] ,
                     'urik_vid_sobs'   => $row['urik_vid_sobs'] ,
                     'urik_ur_adres'   => $row['urik_ur_adres'] ,
                     'urik_nalog_sys'   => $row['urik_nalog_sys'] ,
                     'urik_yn'   => $row['urik_yn']   
                   );    
                   // 'status'   => $this -> loadStatus_Info($row['status']),
                   //'u_region'   => $this -> loadRegionName($row['region']), //
                   //  'u_town'   => $this -> loadTownName($row['town']), 
                   // 'postindex'   => $row['postindex'],
            }
        }    
        return $data;            
    } 
   //******************************************************************************
   
 function load_User_Anketa()
    {
        $user = $this->session->userdata;
          $query = "
            SELECT `cu`.*   
            FROM `customers_users` `cu` 
            WHERE `cu`.`id`=  ".db_quote($user['user_id'])."  
            LIMIT 1 
              ";
            
       // echo  $query; exit();  
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ; 
                 $data = array(
                     'id'      => $row['id'], 
                     'referal'      => $row['referal'], 
                     'email'   => $row['email'],
                     'name'   => $row['name'],
                     'surname'   => $row['surname'],
                     'byfather'   => $row['byfather'],  
                     'country'   => $row['country'],  
                     'town'   => $row['town'],  
                     'inn'   => $row['inn'],  
                     'adres'   => $row['adres'],  
                     'phone'   => $row['phone'],
                     'adv_uid'   => $row['adv_uid'] 
                   );     
            }    
                    /* 'bank'   => $row['bank'] ,
                     'bank_card'   => $row['bank_card'] */
        }    
        return $data;            
    } 
   //******************************************************************************

 function load_User_Cabinet()
    {
        $user = $this->session->userdata;
          $query = "
            SELECT `cu`.*   
            FROM `customers_users` `cu` 
            WHERE `cu`.`id`=  ".db_quote($user['user_id'])."  
            LIMIT 1 
              ";
              /*
              `pay`.`pay_status` as `first_pay`,
            `pay`.`type_pay` as `first_pay_type`
            LEFT JOIN `payments` `pay` ON `pay`.`user_id` = `cu`.`id`
            */
            
            // `email`=  ".db_quote($user['email'])." 
           // AND  
       // echo  $query; exit();  
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ; 
                 $data = array(
                     'id'      => $row['id'], 
                     'email'   => $row['email'],
                     'name'   => $row['name'],
                     'surname'   => $row['surname'],
                     'byfather'   => $row['byfather'],   
                     'gender'   => $row['gender'],
                     'birthday'   => $row['birthday'],
                     'country'   => $row['country'],  
                     'town'   => $row['town'],  
                     'inn'   => $row['inn'],  
                     'adres'   => $row['adres'],  
                     'phone'   => $row['phone'],
                     'contacts'   => $row['contacts'],
                     'active'   => $row['active'],
                     'date_reg'   => $row['date_reg'],
                     'main_etaps'   => $row['main_etaps'] ,
                     'main_levels'   => $row['main_levels'] ,
                     'my_level'   => $row['my_level'] ,
                     'referal'   => $row['referal'] ,
                     'my_actual_levels_usd'   => $this -> load_my_actual_levels($row['id'], "USD"), 
                     'my_actual_levels_uah'   => $this -> load_my_actual_levels($row['id'], "UAH"), 
                     'first_pay'   => $this -> load_my_first_pay($row['id']), 
                     'adv_uid'   => $row['adv_uid'] 
                   );     
                   /*
                   'bank'   => $row['bank'] ,
                     'bank_card'   => $row['bank_card'] ,
                     'bank_mfo'   => $row['bank_mfo'] ,
                     'bank_okpo'   => $row['bank_okpo'] 
                     */
            }
        }    
        return $data;            
    } 
   //******************************************************************************
    function load_my_first_pay($user_id)
    { 
          $query = "
            SELECT `pay_status`, `type_pay` FROM `payments`
            WHERE `user_id`= ".$user_id." 
            AND `type_pay` = '2'
            AND `pay_status` = '1'
            LIMIT 1 
              ";  
        // echo  $query; exit();  
        $dbres = $this->db->query($query); 
        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data = $row ;  
            }
        }    
        return $data;            
    } 
 //*************************************************************************************************

 function load_User_info_short_by_id($user_id)
    {
       
          $query = "
            SELECT * FROM `customers_users`
            WHERE `id`= ".$user_id." 
            LIMIT 1 
              ";
            // `email`=  ".db_quote($user['email'])." 
           // AND  
       // echo  $query; exit();  
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data = $row ; 
                 
            }
        }    
        return $data;            
    } 
   //******************************************************************************
   
 function load_my_actual_levels($id_user, $curr = "UAH")
    {
         // $user = $this->session->userdata;
          $query = "
            SELECT 
            `target`,  
            `pay_status`,  
            `datetime_create`,  
            `datetime_pay_done`
            FROM `payments`
            WHERE `user_id`= ".$id_user."
            AND `pay_status` = 1
            AND `currency` = '".$curr."'
            GROUP BY `target`
            
              ";
              // AND `target` != 10
            // `email`=  ".db_quote($user['email'])." 
            // AND  
        // echo  "<br>".$id_user." - ".$query; // exit();  
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
    //******************************************************************************
   function edit_subscr_settings( $status ){
       $id = $this->session->userdata('user_id');   
       $mysql_update = "UPDATE `customers_users` SET 
   `subscr`     = ".db_quote($status)."
           WHERE `id`='".$id."'
            ";
          //  echo  $mysql_update; exit();   
         $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }
  //******************************************************************************
   //******************************************************************************
   function edit_general_settings($data){
      // echo "<pre>"; print_r($data); exit;
       $id = $this->session->userdata('user_id');
       
      // $data['ed_town'] = ''; 
      $ands = '';
    //  if(isset($data['inn'])) { $ands .= ",`inn` = ".db_quote($data['inn'])." "; }
     // if(isset($data['bank'])) { $ands .= ",`bank` = ".db_quote($data['bank'])." "; }
     // if(isset($data['bank_card'])) { $ands .= ",`bank_card` = ".db_quote($data['bank_card'])." "; }
     // if(isset($data['bank_mfo'])) { $ands .= ",`bank_mfo` = ".db_quote($data['bank_mfo'])." "; }
     // if(isset($data['bank_okpo'])) { $ands .= ",`bank_okpo` = ".db_quote($data['bank_okpo'])." "; }
      if(isset($data['adv_uid'])) { $ands .= ",`adv_uid` = ".db_quote($data['adv_uid'])." "; }
      if(isset($data['country'])) { $ands .= ",`country` = ".db_quote($data['country'])." "; }
      if(isset($data['town'])) { $ands .= ",`town` = ".db_quote($data['town'])." "; }
      if(isset($data['adres'])) { $ands .= ",`adres` = ".db_quote($data['adres'])." "; }
      
      $mysql_update = "UPDATE `customers_users` SET 
       `name`       = ".db_quote($data['ed_name']).",
       `surname`    = ".db_quote($data['ed_surname']).",
       `byfather`    = ".db_quote($data['ed_byfather']).",
       `phone`      = ".db_quote($data['ed_phone'])." 
       $ands
        WHERE `id` = ".$id." 
        LIMIT 1
       ";
       /* 
       ,
       `bank`      = ".db_quote($data['bank']).",
       `bank_card`      = ".db_quote($data['bank_card']).",
       `bank_mfo`      = ".db_quote($data['bank_mfo']).",
       `bank_okpo`      = ".db_quote($data['bank_okpo']).",
       `country`      = ".db_quote($data['country']).", 
       `town`       = ".db_quote($data['town'])." ,
       `adres`       = ".db_quote($data['adres'])." 
       */
          //   echo  $mysql_update; exit();   
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
           WHERE `id`='".$id."'
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
           WHERE `id`='".$id."'
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
       `phone`     = ".db_quote($data['ed_phone'])." ,  
       `adres`     = ".db_quote($data['adres'])."
           WHERE `id`='".$id."'
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
           WHERE `id`='".$id."'
            ";
          //  echo  $mysql_update; exit();   
         $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }             
  //*************************************************** 
//************************************************************************************
 
//************************************************************************************ 
  //*************************************************************************************************  
 function Trafic_Add($data_stat){
  //  print_r($data_stat); exit();         
   
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
 function loadPage_Id_by_url($url) 
   { 
   $sql = "SELECT `id` 
   FROM `pages`
   WHERE `url` = '".trim($url)."'
   ";             
    $query = $this->db->query($sql);
    $row = $query->result_array(); 
     if(isset($row[0]['id'])){ 
    return $row[0]['id']; 
    }
    else {
     return false;
    }    
   } 
//************************************************************************************
 function loadNew_Id_by_url($url) 
   { 
   $sql = "SELECT `id` 
   FROM `news`
   WHERE `url` = '".trim($url)."'
   ";             
    $query = $this->db->query($sql);
    $row = $query->result_array(); 
     if(isset($row[0]['id'])){ 
    return $row[0]['id']; 
    }
    else {
     return false;
    }    
   }   
//************************************************************************************  
//*************************************************************************************************
function loadSlides_00()   {
        // query performing 
        $query = "
            SELECT `id`, `text-rus`, `menu_name-rus`, `preview`, `url` FROM `slides`
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
                     'menu_name'   => $row['menu_name-rus'],
                     'text'   => $row['text-rus'],
                     'url'   => $row['url'],
                     'preview'   => $row['preview'] 
                   ); 
             }                                                      
        }
         return $data;             
    }
//*************************************************************************************************
function ask_req_form_to($dataclient){
      
      
        $query = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 7 ";
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
                          $subject = "Запрос на alafa.com.ua" ; 
                          $message = " 
                          <html><body><p>
                          Имя - ".$dataclient['name']." <br>    
                          Телефон  - ".$dataclient['phone']." <br> 
                          Email - ".$dataclient['email']." <br><br> 
                          Сообщение - ".$dataclient['text']." <br>
                          <br>
                          Дата сообщения  - ".date('Y-m-d', time())."
                          <hr>
                          Отправлено автоматически с формы запроса на alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."   
                          </body></html>"; 
                 
                      
                      $from = 'Запрос ';
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers= "MIME-Version: 1.0\r\n";
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <request@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <request@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                      
                      mail($to, $subject, $message, $headers); 
                        
  return true; 
 
 }
 //*************************************************************************************************
function ask_miss_form_to($dataclient){
      
      
        $query = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 8 ";
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
                          $subject = "Найдена ошибка на alafa.com.ua" ; 
                          $message = " 
                          <html><body><p>
                          Кто нашел - ".$dataclient['name']." <br>    
                          Телефон  - ".$dataclient['phone']." <br> 
                          Email - ".$dataclient['email']." <br><br> 
                          Что за ошибка - ".$dataclient['text']." <br>
                          <br>
                          Дата сообщения  - ".date('Y-m-d', time())."
                          <hr>
                          Отправлено автоматически с формы уведомления об ошибке на alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."   
                          </body></html>"; 
                 
                      
                      $from = 'Ошибка на сайте ';
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers= "MIME-Version: 1.0\r\n";
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <request@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <request@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                      
                      mail($to, $subject, $message, $headers); 
                        
  return true; 
 
 }
 //*************************************************************************************** 
 //*************************************************************************************************
  
       
 
//***************************************************************************   
function loaddocs()
    {                                             
        // query performing 
        $query = "
            SELECT *
            FROM `docs`
            WHERE `visible` = 1
            ORDER BY `number`
            
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
           
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
              
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
               //  $data[] = $row ; 
               $data[] =array(
                     'id'             => $row['id'], 
                     'menu_name'      => $row['menu_name-rus'],
                     'text'           => $row['text-rus'], 
                     'file'           => $row['file'] 
                     );     
             }
        }
         return $data;             
    }    
 //************************************************************************************
    
function loadThumbsToObject($id)    {
        // query performing 
        $query = "
            SELECT `id`, `thumb`, `preview` FROM `object_images`
            WHERE `object` =  ".$id." 
            AND `visible` = 1
             ORDER BY `number`
             LIMIT 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ;
                 $data = array(
                     'id'      => $row['id'], 
                     'thumb'     => $row['thumb'],
                     'preview'     => $row['preview'] 
                   ); 
             }
        }
         return $data;             
    }    
//*************************************************************************************************     
 
 //******************************************************************************
  function count_My_Referals_all( ) 
   { 
    $user_id = $this->session->userdata('user_id');   
   $sql = "SELECT COUNT(*) as `count` 
   FROM `customers_users`  
   WHERE `referal` = ".$user_id." 
    "; 
   //  $sql = "SELECT COUNT(*) as `count` FROM `customers_users` WHERE `referal` = ".$user_id." "; //  AND `pay_status`= 1
    $query = $this->db->query($sql);
    $row = $query->result_array();
    if(isset($row[0]['count'])){
    return $row[0]['count'] ; 
    } else {  return 0;}
   }      
 //********************************************************************************   
 function count_My_Referals_all_active( ) 
   { 
   $user_id = $this->session->userdata('user_id');   
   $sql = "SELECT COUNT(*) as `count` 
   FROM `payments` `pay` 
   WHERE `pay`.`referal_id` = ".$user_id."
   AND `pay`.`pay_status`= 1
   AND `pay`.`type_pay`= 2 
    "; 
   // echo $sql;
    // `pay`.`user_id`  GROUP BY `pay`.`user_id`
   //  $sql = "SELECT COUNT(*) as `count` FROM `customers_users` WHERE `referal` = ".$user_id." "; //  AND `pay_status`= 1
    $query = $this->db->query($sql);
    $row = $query->result_array();
    if(isset($row[0]['count'])){
    return $row[0]['count'] ; 
    } else {  return 0;}
   }     
 //********************************************************************************   
 function count_My_Referals_all_active_usd( ) 
   { 
   $user_id = $this->session->userdata('user_id');   
   /*
   $sql = "SELECT COUNT(*) as `count` 
   FROM `customers_users` `cu`
   INNER JOIN `payments` `pay` ON `pay`.`user_id` = `cu`.`id`
   WHERE `cu`.`referal` = ".$user_id."
   AND `pay`.`pay_status`= 1
   AND `pay`.`currency` = 'USD'
   GROUP BY `pay`.`user_id`
    "; 
    */
    
$sql = "SELECT COUNT(DISTINCT `user_id`) as `count` 
   FROM `payments` `pay` 
   WHERE `pay`.`referal_id` = ".$user_id."
   AND `pay`.`pay_status`= 1
   AND `pay`.`type_pay`= 1
   AND `pay`.`currency` = 'USD'
   
    "; // GROUP BY `pay`.`user_id`
   //  $sql = "SELECT COUNT(*) as `count` FROM `customers_users` WHERE `referal` = ".$user_id." "; //  AND `pay_status`= 1
    $query = $this->db->query($sql);
    $row = $query->result_array();
    if(isset($row[0]['count'])){
    return $row[0]['count'] ; 
    } else {  return 0;}
   }                                         
 //********************************************************************************   
 function count_My_Referals_all_active_uah( ) 
   { 
   $user_id = $this->session->userdata('user_id');   
   
  /* $sql = "SELECT COUNT(*) as `count` 
   FROM `customers_users` `cu`
   INNER JOIN `payments` `pay` ON `pay`.`user_id` = `cu`.`id`
   WHERE `cu`.`referal` = ".$user_id."
   AND `pay`.`pay_status`= 1
   AND `pay`.`currency` = 'UAH'
   GROUP BY `pay`.`user_id`
   ";*/ 
   $sql = "SELECT COUNT(DISTINCT `user_id`) as `count` 
   FROM `payments` `pay` 
   WHERE `pay`.`referal_id` = ".$user_id."
   AND `pay`.`pay_status`= 1
   AND `pay`.`type_pay`= 1
   AND `pay`.`currency` = 'UAH'
   
    ";
   // GROUP BY `pay`.`user_id`
   /*$sql = "SELECT COUNT(*) as `count` 
   FROM `customers_users` `cu`
   INNER JOIN `payments` `pay` ON `pay`.`user_id` = `cu`.`id`
   WHERE `cu`.`referal` = ".$user_id."
   AND `pay`.`pay_status`= 1
   AND `pay`.`currency` = 'UAH'
   GROUP BY `pay`.`user_id`
   "; */
   //  $sql = "SELECT COUNT(*) as `count` FROM `customers_users` WHERE `referal` = ".$user_id." "; //  AND `pay_status`= 1
    $query = $this->db->query($sql);
    $row = $query->result_array();
    if(isset($row[0]['count'])){
    return $row[0]['count'] ; 
    } else {  return 0;}
   }                                                                                       
//*******************************************************************   
 function count_payed_targets($main_level = 0, $id_user, $curr="UAH") 
   { 
       if($main_level==NULL){
           return 0;
       } else {
   $sql = "SELECT COUNT(*) as `count` FROM `payments` 
   WHERE `target` = ".$main_level." 
   AND `user_id` = ".$id_user." 
   AND `currency` = '".$curr."' 
   AND `pay_status` = 1 ";
    $query = $this->db->query($sql);
    $row = $query->result_array(); 
    return $row[0]['count']; 
       }
   }                                                                                 
//*******************************************************************   
 function count_my_this_referals($main_level, $id_user, $curr = "UAH") 
   { 
   $sql = "SELECT COUNT(*) as `count` FROM `payments` 
   WHERE `target` = ".$main_level." 
   AND `referal_id` = ".$id_user." 
   AND `currency` = '".$curr."' 
   AND `pay_status` = 1 ";
    $query = $this->db->query($sql);
    $row = $query->result_array(); 
    return $row[0]['count']; 
   }         
 //*****************************************************************************
 function count_my_this_referals_not_payed_yet($main_level, $id_user) 
   { 
   $sql = "SELECT COUNT(*) as `count` FROM `payments` 
   WHERE `target` = ".$main_level." 
   AND `referal_id` = ".$id_user." 
   AND `pay_status` = 0 ";
    $query = $this->db->query($sql);
    $row = $query->result_array(); 
    return $row[0]['count']; 
   } 
   // count_visit_v_zaprose     
 //*****************************************************************************
 function count_visit_v_zaprose_payet($main_level, $id_user, $curr = "UAH") 
   { 
   $sql = "SELECT COUNT(*) as `count`  
   FROM `orders_vivod`  
   WHERE `target` = ".$main_level." 
   AND `user_id` = ".$id_user." 
   AND `currency` = '".$curr."'
   AND `pay_status` = 1 ";
   // referal_id
    $query = $this->db->query($sql);
    $row = $query->result_array(); 
    return $row[0]['count']; 
   }   
 //*****************************************************************************
 function count_visit_v_zaprose_by_levels($main_level, $id_user, $curr = "UAH") 
   { 
   $answer=array();
   
   $sql_1 = "SELECT COUNT(*) as `count` 
       FROM `orders_vivod` 
       WHERE `target` = ".$main_level." 
       AND `user_id` = ".$id_user." 
       AND `currency` = '".$curr."'
       AND `from_level` = 1 
       AND `pay_status` = 1 ";
    $query_1 = $this->db->query($sql_1);
    $row_1 = $query_1->result_array(); 
    
   $sql_11 = "SELECT COUNT(*) as `count` 
       FROM `orders_vivod` 
       WHERE `target` = ".$main_level." 
       AND `user_id` = ".$id_user." 
       AND `currency` = '".$curr."'
       AND `from_level` = 1 
       AND `pay_status` = 0 ";
    $query_11 = $this->db->query($sql_11);
    $row_11 = $query_11->result_array(); 
 
    //========
    $sql_2 = "SELECT COUNT(*) as `count` 
       FROM `orders_vivod` 
       WHERE `target` = ".$main_level." 
       AND `user_id` = ".$id_user." 
       AND `currency` = '".$curr."'
       AND `from_level` = 2 
       AND `pay_status` = 1 ";
    $query_2 = $this->db->query($sql_2);
    $row_2 = $query_2->result_array();
    
    $sql_22 = "SELECT COUNT(*) as `count` 
       FROM `orders_vivod` 
       WHERE `target` = ".$main_level." 
       AND `user_id` = ".$id_user." 
       AND `currency` = '".$curr."'
       AND `from_level` = 2 
       AND `pay_status` = 0 ";
    $query_22 = $this->db->query($sql_22);
    $row_22 = $query_22->result_array();
    //========
    $sql_3 = "SELECT COUNT(*) as `count` 
       FROM `orders_vivod` 
       WHERE `target` = ".$main_level." 
       AND `user_id` = ".$id_user." 
       AND `currency` = '".$curr."'
       AND `from_level` = 3 
       AND `pay_status` = 1 ";
    $query_3 = $this->db->query($sql_3);    
    $row_3 = $query_3->result_array();
    
    $sql_33 = "SELECT COUNT(*) as `count` 
       FROM `orders_vivod` 
       WHERE `target` = ".$main_level." 
       AND `user_id` = ".$id_user." 
       AND `currency` = '".$curr."'
       AND `from_level` = 3 
       AND `pay_status` = 0 "; 
    $query_33 = $this->db->query($sql_33);
    $row_33 = $query_33->result_array();
    
    $answer['count_payed_l1'] = $row_1[0]['count'];
    $answer['count_notpayed_l1'] = $row_11[0]['count'];
    $answer['count_payed_l2'] = $row_2[0]['count'];
    $answer['count_notpayed_l2'] = $row_22[0]['count'];
    $answer['count_payed_l3'] = $row_3[0]['count'];
    $answer['count_notpayed_l3'] = $row_33[0]['count'];
    
    //print_r($answer); exit;
    return $answer; 
   }   
 //*****************************************************************************
  //*****************************************************************************
 function count_visit_v_zaprose_not_payet($main_level, $id_user , $curr = "UAH") 
   { 
   $sql = "SELECT COUNT(*) as `count` 
   FROM `orders_vivod` 
   WHERE `target` = ".$main_level."
   AND `currency` = '".$curr."'
   AND `user_id` = ".$id_user." 
   AND `pay_status` = 0 
   ";
   // referal_id
    $query = $this->db->query($sql);
    $row = $query->result_array();
    
    return $row[0]['count'];
     
   }   
 //*****************************************************************************
 function count_my_this_referals_zzzzzzzz($main_level, $id_user) 
   { 
   $sql = "SELECT COUNT(*) as `count` FROM `customers_users` WHERE ".$main_level." IN (`main_levels`) AND `referal` = ".$id_user." ";
    $query = $this->db->query($sql);
    $row = $query->result_array();
    
    return $row[0]['count'];
     
   }         
 //*****************************************************************************
 function load_My_Referals()   {
        // query performing 
        $user_id = $this->session->userdata('user_id');   
        
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * FROM `customers_users`
            WHERE `referal` = ".$user_id." 
            
            ORDER BY `id` DESC
        ";
       // echo $query; exit;
       // AND `id` !=1  
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
           
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
            
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data[] = $row ;
                $data['referals_list'][] =array(
                     'id'      => $row['id'],
                     'name'      => $row['name'],
                     'surname'   => $row['surname'],
                     'email'   => $row['email'],
                     'date_reg'   => $row['date_reg']
                   ); 
             }
        }
         return $data;             
    }  
    
  //**********************************************************
  //*****************************************************************************
 function load_My_Referals_Payed()   {
        // query performing 
        $user_id = $this->session->userdata('user_id');   
        
        $query = "
            SELECT DISTINCT `user_id`, `id`, `referal_id`, `target`, `pay_status`, `datetime_create` 
            FROM `payments`
            WHERE `referal_id` = ".$user_id." 
            AND `id` != ".$user_id." 
            ORDER BY `id` DESC
            
        "; 
        // `datetime_create` DESC, , `target` ASC
        // AND `pay_status` = 1
        // echo $query; exit;
        // AND `id` !=1  
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
           
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                // $data[] = $row ; // referals_list'
                   $data[] =array(
                     'id'           => $row['id'],
                     'user_id'      => $row['user_id'],
                     'referal_id'   => $row['referal_id'],
                     'datetime_create'   => $row['datetime_create'],
                     'user'         => $this->load_User_info_short_by_id($row['user_id']) ,
                     'actual_levels'   => $this->load_my_actual_levels($row['user_id']),  
                     'next_referals'   => $this->load_Next_Referals($row['user_id'], 1, ''),  
                     'target'       => $row['target'] 
                   ); 
             }
        }
         return $data;             
    }  
  //****************************************************************************************
 function load_Next_Referals($ref_id = 0, $label_check = 0, $pay_status = '', $curr="UAH")   {
       
        $user_id = $this->session->userdata('user_id');   
        
          // DISTINCT
        $query = "
            SELECT SQL_CALC_FOUND_ROWS `cu`.*,  
            `pay`.`type_pay` as `type_pay`, 
            `pay`.`currency` as `currency`, 
            `pay`.`target` as `target`, 
            `pay`.`price` as `pay_price`, 
            `pay`.`pay_status` as `pay_status`, 
            `pay`.`datetime_create` as `datetime_payment` 
            FROM `customers_users` `cu`
            LEFT JOIN `payments` `pay` ON `pay`.`user_id` = `cu`.`id` 
            WHERE `cu`.`referal` = ".$ref_id." 
            AND  `pay`.`currency` = '".$curr."'             
            GROUP BY `cu`.`id`           
            ORDER BY `cu`.`id` DESC            
        ";  
        // AND `cu`.`id` != ".$user_id." 
         //echo "<br> ID user = ".$ref_id." ------------------------------------------- ".$query; //exit;
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
           
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
               
                     $data['list'][] =array(
                     'id'           => $row['id'],
                     'referal'           => $row['referal'],
                     'email'           => $row['email'],
                     'name'           => $row['name'],
                     'surname'           => $row['surname'],
                     'inn'           => $row['inn'], 
                     'town'           => $row['town'], 
                     'date_reg'   => $row['date_reg'],
                     'currency'       => $row['currency'],
                     'target'       => $row['target'],
                     'pay_price'       => $row['pay_price'],
                     'type_pay'       => $row['type_pay'],
                     'datetime_payment'   => $row['datetime_payment'],      
                     'count_payed_targets' => $this->count_payed_targets($row['target'], $row['id'], $curr) ,
                     'first_pay'   => $this -> load_my_first_pay($row['id']), 
                     'actual_levels'   => $this->load_my_actual_levels($row['id'], $curr),  
                     'next_referals'   => $this->load_Next_Referals2($row['id'], 2, '', $curr)     
                   ); 
                   
             }
        }
        //echo "<pre>";  print_r($data); exit;
         return $data;             
    }  
    
  //**********************************************************  
 function load_Next_Referals2($ref_id = 0, $label_check = 0, $pay_status = '', $curr="UAH")   {
       
        $user_id = $this->session->userdata('user_id');   
        
          // DISTINCT
        $query = "
            SELECT SQL_CALC_FOUND_ROWS `cu`.*,  
            `pay`.`type_pay` as `type_pay`, 
            `pay`.`target` as `target`, 
            `pay`.`currency` as `currency`, 
            `pay`.`price` as `pay_price`, 
            `pay`.`pay_status` as `pay_status`, 
            `pay`.`datetime_create` as `datetime_payment` 
            FROM `customers_users` `cu`
            LEFT JOIN `payments` `pay` ON `pay`.`user_id` = `cu`.`id` 
            WHERE `cu`.`referal` = ".$ref_id." 
            AND  `pay`.`currency` = '".$curr."'                       
            GROUP BY `cu`.`id`           
            ORDER BY `cu`.`id` DESC            
        ";  
        // AND `cu`.`id` != ".$user_id." 
         //echo "<br> ID user = ".$ref_id." ------------------------------------------- ".$query; //exit;
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
           
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
              
                     $data['list'][] =array(
                     'id'           => $row['id'],
                     'referal'           => $row['referal'],
                     'email'           => $row['email'],
                     'name'           => $row['name'],
                     'surname'           => $row['surname'],
                     'inn'           => $row['inn'], 
                     'town'           => $row['town'], 
                     'date_reg'   => $row['date_reg'],
                     'target'       => $row['target'],
                     'currency'       => $row['currency'],
                     'pay_price'       => $row['pay_price'],
                     'type_pay'       => $row['type_pay'],
                     'datetime_payment'   => $row['datetime_payment'],      
                     'count_payed_targets' => $this->count_payed_targets($row['target'], $row['id'], $curr) ,
                     'first_pay'   => $this -> load_my_first_pay($row['id']), 
                     'actual_levels'   => $this->load_my_actual_levels($row['id'], $curr),  
                     'next_referals'   => $this->load_Next_Referals3($row['id'], 3, '', $curr)     
                   ); 
                    
             }
        }
        //echo "<pre>";  print_r($data); exit;
         return $data;             
    }  
    
  //**********************************************************  
 function load_Next_Referals3($ref_id = 0, $label_check = 0, $pay_status = '', $curr="UAH")   {
       
        $user_id = $this->session->userdata('user_id');   
        
          // DISTINCT
        $query = "
            SELECT SQL_CALC_FOUND_ROWS `cu`.*,  
            `pay`.`type_pay` as `type_pay`, 
            `pay`.`target` as `target`, 
            `pay`.`currency` as `currency`, 
            `pay`.`price` as `pay_price`, 
            `pay`.`pay_status` as `pay_status`, 
            `pay`.`datetime_create` as `datetime_payment` 
            FROM `customers_users` `cu`
            LEFT JOIN `payments` `pay` ON `pay`.`user_id` = `cu`.`id` 
            WHERE `cu`.`referal` = ".$ref_id." 
            AND  `pay`.`currency` = '".$curr."'              
            GROUP BY `cu`.`id`           
            ORDER BY `cu`.`id` DESC            
        ";  
        // AND `cu`.`id` != ".$user_id." 
         //echo "<br> ID user = ".$ref_id." ------------------------------------------- ".$query; //exit;
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
           
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 
                       $data['list'][] =array(
                     'id'           => $row['id'],
                     'referal'           => $row['referal'],
                     'email'           => $row['email'],
                     'name'           => $row['name'],
                     'surname'           => $row['surname'],
                     'inn'           => $row['inn'], 
                     'town'           => $row['town'], 
                     'date_reg'   => $row['date_reg'],
                     'target'       => $row['target'],
                     'currency'       => $row['currency'],
                     'pay_price'       => $row['pay_price'],
                     'type_pay'       => $row['type_pay'],
                     'datetime_payment'   => $row['datetime_payment'],  
                     'count_payed_targets' => $this->count_payed_targets($row['target'], $row['id'], $curr) ,
                     'first_pay'   => $this -> load_my_first_pay($row['id']), 
                     'actual_levels'   => $this->load_my_actual_levels($row['id'], $curr),      
                     'next_referals'   => array()  
                     );            
                   
             }
        }
        //echo "<pre>";  print_r($data); exit;
         return $data;             
    }  
    
  //**********************************************************  
 function load_Next_Parents($ref_id = 0, $referal = 0, $label_check = 1, $pay_status = '')   {
        // query performing 
        $user_id = $this->session->userdata('user_id');   
          
          // DISTINCT
        $query = "
            SELECT SQL_CALC_FOUND_ROWS `cu`.*,  
            `pay`.`type_pay` as `type_pay`, 
            `pay`.`target` as `target`, 
            `pay`.`pay_status` as `pay_status`, 
            `pay`.`datetime_create` as `datetime_payment` 
            FROM `customers_users` `cu`
            LEFT JOIN  `payments` `pay` ON `pay`.`user_id` = `cu`.`id` 
            WHERE `cu`.`id` = ".$referal." 
            AND `cu`.`id` != ".$user_id." 
            LIMIT 1    
        ";  
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
             
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                // $data[] = $row ; // referals_list'
                   if($label_check<=3){
                     $label_check++;
                     $data[] =array(
                     'id'           => $row['id'],
                     'referal'           => $row['referal'],
                     'email'           => $row['email'],
                     'name'           => $row['name'],
                     'surname'           => $row['surname'],
                     'inn'           => $row['inn'], 
                     'town'           => $row['town'], 
                     'date_reg'   => $row['date_reg'],
                     'target'       => $row['target'],
                     'type_pay'       => $row['type_pay'],
                     'datetime_payment'   => $row['datetime_payment'],  
                     'actual_levels'   => $this->load_my_actual_levels($row['id']),      
                     'next_referals'   => $this->load_Next_Referals($row['id'], $row['referal'], $label_check, '')     
                   ); 
                   
                   } else {
                       $data[] =array(
                     'id'           => $row['id'],
                     'referal'           => $row['referal'],
                     'email'           => $row['email'],
                     'name'           => $row['name'],
                     'surname'           => $row['surname'],
                     'inn'           => $row['inn'], 
                     'town'           => $row['town'], 
                     'date_reg'   => $row['date_reg'],
                     'target'       => $row['target'],
                     'type_pay'       => $row['type_pay'],
                     'datetime_payment'   => $row['datetime_payment'],  
                     'actual_levels'   => $this->load_my_actual_levels($row['id']),      
                     'next_referals'   => array()  
                     );            
                   }
                   // 'actual_levels'   => $this->load_my_actual_levels($row['user_id']),  
             }
        }
         return $data;             
    }  
    
  //**********************************************************  
  //**********************************************************
     function load_Levels( )
    {
     
          $query = " SELECT * FROM `targets` WHERE  1  ";
         // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
             $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row;
              $data[] =array(
                     'id'        => $row['id'],
                     'etap'      => $row['etap'],
                     'menu_name'   => $row['menu_name-rus'],
                     'level'   => $row['level'],
                     'price'   => $row['price']   
                   ); 
              }    
        }
         return $data;             
    } 
   //*************************************************************************     
    //**********************************************************
     function load_Levels_and_count( $one_target = '', $curr = "UAH" )
    {
        $user_id = $this->session->userdata('user_id');  
        
        $curr = strtolower($curr);    
        
        $and = '';
        if($one_target!='') { $and = " AND `id` = ".$one_target." "; }
       // if($curr!='') { $and = " AND `id` = ".$one_target." "; }
         
        $query = " SELECT `id`, `menu_name-rus`, `level` ,`price_".$curr."` as `price`
        FROM `targets` 
        WHERE `visible` = 1 
         ";
         // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
             $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row;
                 // 'etap'      => $row['etap'],
              $data[] =array(
                     'id'        => $row['id'], 
                     'menu_name'   => $row['menu_name-rus'],
                     'level'   => $row['level'],
                     'price'   => $row['price'],
                     'count_my_this_referals' => $this->count_my_this_referals($row['level'], $user_id, $curr) ,
                     'count_visit_v_zaprose_payet' => $this->count_visit_v_zaprose_payet($row['level'], $user_id, $curr) ,
                     'count_visit_v_zaprose_not_payet' => $this->count_visit_v_zaprose_not_payet($row['level'], $user_id, $curr)  ,
                     'count_visit_v_zaprose_by_levels' => $this->count_visit_v_zaprose_by_levels($row['level'], $user_id, $curr)  
                   );
                   
                   // 'count_my_this_referals' => $this->count_my_this_referals($row['level'], $user_id)    
                   // 'count_my_this_referals_not_payed_yet' => $this->count_my_this_referals_not_payed_yet($row['level'], $user_id)   
              }    
        }
        
      //  echo "<pre>"; print_r($data); exit();  
         
         return $data;             
    } 
  
 //*****************************************************************************************
  function create_order($data ){
    
  //  echo "<pre>"; print_r($data); exit();
   $user_id = $this->session->userdata('user_id');       
     $data['user_id'] = $user_id;
     $time = time();  
        
   // if($data['user_id']==''){         
   // $datanewuser =  $this->add_new_customer_user_from_guest_account($data);
   
   $target_info = $this->load_target_info_by_id($data['level_to'], $data['main_currency']);
   
   $user_info = $this->load_User_info_short_by_id($user_id);
    
   $comment = " New Level ".$target_info['id'];
      
     $mysql_insert = "INSERT INTO `payments` (
     `user_id`,
     `referal_id`,
     `price`,
     `currency`,
     `target`,
     `datetime_create`,
     `ip_payer`, 
     `comment`  
      )
         VALUES (
         ".db_quote($data['user_id'])." ,
         ".db_quote($user_info['referal'])." ,
         ".db_quote($target_info['price'])." ,
         ".db_quote($data['main_currency'])." ,
         ".db_quote($target_info['id'])." ,
         ".db_quote($time)." ,
         ".db_quote($_SERVER['REMOTE_ADDR'])." ,
         ".db_quote($comment)." 
         )";
         //".db_quote($data['payment_type'])." ,
         // ".db_quote(date("Y.m.d")).",      
   //  echo $mysql_insert;    Квитанция
        $this->db->query($mysql_insert);
        $order_id = $this->db->insert_id();
        ////////////////////////////////////////////////////////////////////////
      
        $query = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 9 ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data_email = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ;
                  $data_email = array(
                     'email'       => $row['value']
                   );
             }
        } 
        
        $emails = $data_email['email']; 
         
                 
                          $to  = $emails;                
                          $subject = "Заявка на новый уровень" ; 
                          $message = " 
                          <html><body><p><br> 
                          <b>".$subject."</b><br> <br> 
                          
                           Language of site was: ".lang('main_lang_name')."<br> <br> 
                           
                          <br>
                          Дата заявки  - ".date('Y-m-d', time())."
                          <hr>
                          Отправлено автоматически с сайта alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."   
                          </body></html>"; 
                          
                        $site_url = base_url();  
                           $search = array ( 
                             '#site_url#'
                             );
                          $replace = array ( 
                             $site_url
                             ); 
                          
                          $text = str_replace($search, $replace, $message); 
                 
                      
                      $from = 'Alafa | Levels';
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers= "MIME-Version: 1.0\r\n";
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <perehod@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <perehod@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                      
                    //  mail($to, $subject, $message, $headers); 
  //====================================================
  $to  = $emails;                
                          $subject = "Заявка на новый уровень" ; 
                          $message = " 
                          <html><body><p><br> 
                          <b>".$subject."</b><br> <br> 
                          
                           Language of site was: ".lang('main_lang_name')."<br> <br> 
                           
                          <br>
                          Дата заявки  - ".date('Y-m-d', time())."
                          <hr>
                          Отправлено автоматически с сайта alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."   
                          </body></html>"; 
                          
                        $site_url = base_url();  
                           $search = array ( 
                             '#site_url#'
                             );
                          $replace = array ( 
                             $site_url
                             ); 
                          
                          $text = str_replace($search, $replace, $message); 
                 
                      
                      $from = 'Alafa | Levels';
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers= "MIME-Version: 1.0\r\n";
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <perehod@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <perehod@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                      
                    //  mail($to, $subject, $message, $headers); 
//===============================
                       
  return $order_id;  
 } 
//*******************************************************************  
//*******************************************************************
  function create_order_pay_reg($curr){
    
  //  echo "<pre>"; print_r($data); exit();
   $user_id = $this->session->userdata('user_id');       
     $data['user_id'] = $user_id;
     $time = time();  
        
   // if($data['user_id']==''){         
   // $datanewuser =  $this->add_new_customer_user_from_guest_account($data);
   
    
   $target_info = $this->load_target_info_by_id(10, $curr);
   $user_info = $this->load_User_info_short_by_id($user_id);
    
   $comment = " Pay to first register";
      
     $mysql_insert = "INSERT INTO `payments` (
     `user_id`,
     `type_pay`,
     `referal_id`,
     `currency`,
     `price`,
     `target`,
     `datetime_create`,
     `ip_payer`, 
     `comment`  
      )
         VALUES (
         ".db_quote($user_id)." ,
         '2',
         ".db_quote($user_info['referal'])." ,
         ".db_quote($curr)." ,
         ".db_quote($target_info['price'])." , 
         '10' ,
         ".db_quote($time)." ,
         ".db_quote($_SERVER['REMOTE_ADDR'])." ,
         ".db_quote($comment)." 
         )";
         //".db_quote($data['payment_type'])." ,
         // ".db_quote(date("Y.m.d")).",      
   //  echo $mysql_insert;    Квитанция
        $this->db->query($mysql_insert);
        $order_id = $this->db->insert_id();
        ////////////////////////////////////////////////////////////////////////
      
        $query = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 10 ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data_email = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ;
                  $data_email = array(
                     'email'       => $row['value']
                   );
             }
        } 
        
        $emails = $data_email['email']; 
         
                 
                          $to  = $emails;                
                          $subject = "Оплата регистрации - заявка" ; 
                          $message = " 
                          <html><body><p><br> 
                          <b>".$subject."</b><br> <br> 
                          
                           Language of site was: ".lang('main_lang_name')."<br> <br> 
                           
                          <br>
                          Дата формирования квитанции  - ".date('Y-m-d', time())."
                          <hr>
                          Отправлено автоматически с сайта alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."   
                          </body></html>"; 
                          
                        $site_url = base_url();  
                           $search = array ( 
                             '#site_url#'
                             );
                          $replace = array ( 
                             $site_url
                             ); 
                          
                          $text = str_replace($search, $replace, $message); 
                 
                      
                      $from = 'Alafa';
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers= "MIME-Version: 1.0\r\n";
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <perehod@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <perehod@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                      
                    //  mail($to, $subject, $message, $headers); 
  //====================================================
  $to  = $emails;                
                          $subject = "Заявка регистрации участника через оплату" ; 
                          $message = " 
                          <html><body><p><br> 
                          <b>".$subject."</b><br> <br> 
                          
                           Language of site was: ".lang('main_lang_name')."<br> <br> 
                           
                          <br>
                          Дата заявки  - ".date('Y-m-d', time())."
                          <hr>
                          Отправлено автоматически с сайта alafa.com.ua
                          </p>
                          ".lang('main_letter_sign')."   
                          </body></html>"; 
                          
                        $site_url = base_url();  
                           $search = array ( 
                             '#site_url#'
                             );
                          $replace = array ( 
                             $site_url
                             ); 
                          
                          $text = str_replace($search, $replace, $message); 
                 
                      
                      $from = 'Alafa | Registration Order';
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers= "MIME-Version: 1.0\r\n";
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <perehod@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <perehod@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                      
                    //  mail($to, $subject, $message, $headers); 
//===============================
                       
  return $order_id;  
 } 
//******************************************************************* 
function load_target_info_by_id($id, $curr = "UAH")  {                      
    // echo "id = ".$id;
        // query performing    
        // strtoupper() strtolower () 
        $curr = strtolower($curr);
        
                    
        $query = "
            SELECT 
            `id`,
            `etap`,
            `menu_name-rus` as `menu_name`,
            `level`,
            `price_".$curr."` as `price` 
            FROM `targets`
            WHERE `id` = ".$id."
            LIMIT 1
        "; 
                    $dbres = $this->db->query($query);
                     $data = array();
                      if ($dbres->num_rows() >= 1) {
                        $rows = $dbres->result_array();
                    foreach ($rows as $row) {
                     $data = $row;
                  /* $data = array(
                     'id'      => $row['id'], 
                     'etap'      => $row['etap'], 
                     'menu_name'      => $row['menu_name-rus'], 
                     'level'      => $row['level'], 
                     'otkat'      => $row['otkat'],              
                     'price'      => $row['price']    
                   ); */            
            }
        }       
        return $data;             
    } 
 //*************************************************************    
 //*************************************************************
function load_Order_for_Pay($id)  {                      
     
        // query performing                
        $query = "
            SELECT *
            FROM `payments`
            WHERE `id` = ".$id."
            LIMIT 1
        "; 
                    $dbres = $this->db->query($query);
                     $data = array();
                      if ($dbres->num_rows() >= 1) {
                        $rows = $dbres->result_array();
                    foreach ($rows as $row) {
                   //  $data = $row;
                     $data = array(
                     'id'           => $row['id'],  
                     'price'        => $row['price'], 
                     'currency'     => $row['currency'], 
                     'target'       => $row['target'], 
                     'target_name'  => $this->load_target_info_by_id( $row['target']), 
                     'user_info'    => $this->load_User_Cabinet( $row['user_id']), 
                     'user_id'      => $row['user_id'], 
                     'comment'      => $row['comment']
                   );               
            }
            // 'target_name'  => $this->load_Target_by_id( 10), 
           // echo "<pre>"; print_r($data);
        }       
        return $data;             
    } 
 //***************************************************************************************     
  //*************************************************************************************************

 function load_Target_by_id($id)
    {
        $user = $this->session->userdata;
          $query = "
            SELECT * FROM `targets`
            WHERE `id`= ".$id."
            LIMIT 1 
              ";
            // `email`=  ".db_quote($user['email'])." 
           // AND  
       // echo  $query; exit();  
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 $data = $row ; 
                /* $data = array(
                     'id'      => $row['id'],
                     'email'   => $row['email'],
                     'name'   => $row['name'],
                     'surname'   => $row['surname'],
                     'byfather'   => $row['byfather'],   
                     'gender'   => $row['gender'],
                     'birthday'   => $row['birthday'],
                     'town'   => $row['town'],  
                     'adres'   => $row['adres'],  
                     'phone'   => $row['phone'],
                     'contacts'   => $row['contacts'],
                     'active'   => $row['active'],
                     'date_reg'   => $row['date_reg'],
                     'main_etaps'   => $row['main_etaps'] ,
                     'main_levels'   => $row['main_levels'] ,
                     'my_level'   => $row['my_level'] ,
                     'referal'   => $row['referal'] ,
                     'cur_lev_by_etap1'   => $row['cur_lev_by_etap1'],
                     'cur_lev_by_etap2'   => $row['cur_lev_by_etap2'],
                     'cur_lev_by_etap3'   => $row['cur_lev_by_etap3']
                   );     */
            }
        }    
        return $data;            
    } 
   //******************************************************************************
     //************************************************************************************  
  function load_Order_for_Pay_000($id)
    {
        // // echo  "ID - ".$id; exit();
         // query performing
         // $this-> db-> query('SET NAMES utf8');   
        $query = " SELECT *
                 FROM `payments`
                 WHERE `id`=  ".$id."
                 LIMIT 1 
        ";
       //  // echo   $query; exit(); 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 //  $data[] = $row ; 
                  $data = array(
                     'id'        => $row['id'],
                     'user_id'      => $row['user_id'], 
                     'target'   => $row['target'],
                     'price'         => $row['price'] 
                   );  
            }
        }
       //  // print_r ($data); exit;
        return $data;             
    }     
//************************************************************************ 
//******************************************************************* 
function write_payment_status_automaticly($payment_arr, $get_status='')   {
    
   //$id = $this->session->userdata('user_id');  
   
    
   $time = time();
   // echo "<pre>"; print_r($payment); exit();        
   $fields=array();
   $values=array();
   //$save_status_payment = 0;
   
   foreach ($payment_arr as $key=>$val){
       // echo "<br>".$key." - - - ".$val;
       $fields[]=" `".$key."` ";
       $values[]= db_quote($val)  ;
       if($key=="ac_transaction_status" && $val=="COMPLETED") { 
          // $this->update_payment_status_automaticly();
          $save_status_payment = 1;
          //$save_status_payment_val = $val;
       }
       if($key=="ac_order_id" && $val!="") { 
          $user_id_from_order = $this->get_user_id_by_order_payment($val);
          $ac_order_id = $val;
       }
    }
    if(!empty($fields) && !empty($values) && !empty($user_id_from_order)) {
        
    $fields_write = implode(", ", $fields);
    $values_write = implode(", ", $values);
     
    
    
    $mysql_insert="INSERT INTO `pay_sync` (   
    $fields_write ,
   `answer_time`, 
   `user_id` ,
   `order_id`,
   `type_answer`
   ) 
         VALUES (          
         $values_write ,                   
         ".$time.",      
         ".db_quote($user_id_from_order['user_id'])." ,
         ".db_quote($ac_order_id)." ,
         ".db_quote($get_status)." 
         )";
       //  print_r($mysql_insert); exit();
        $this->db->query($mysql_insert);
        
      $order_id = $this->db->insert_id();  
    
    if(isset($save_status_payment) && !empty($user_id_from_order)) {
         $mysql_update = "
           UPDATE `payments` SET   
          `datetime_pay_done` = '".$time."' ,
          `pay_status` = '".$save_status_payment."' 
           WHERE `id`=  ".$ac_order_id." 
           LIMIT 1
           "; 
           // `privatbank_code` = '".$string->code."',
           // AND `id_user` = ".$payment['id_user']."
       //   echo $mysql_update; exit(); 
        $this->db->query($mysql_update);  
    }           
    
    }
     return true;                 
                           
           
    }  
//*******************************************************************  

//******************************************************************* 
function update_payment_status_automaticly($array_res, $payment)   {
  //  echo "<pre>"; print_r($payment); exit();
   
  
  // $time = time(); 
         $mysql_update = "
           UPDATE `payments` SET  
          `pb_status` = '".$array_res['state']."', 
          `pb_trans_id` = '".$array_res['ref']."',
          `pb_sender_phone` = 'priva24',
          `privatbank_pay_way` = '".$array_res['pay_way']."' ,
          `datetime_pay_done` = '".$fact_private_date."' 
           WHERE `id`=  ".$payment['order_id']." 
           LIMIT 1
           "; 
           // `privatbank_code` = '".$string->code."',
           // AND `id_user` = ".$payment['id_user']."
       //   echo $mysql_update; exit(); 
        $this->db->query($mysql_update);  
                  
     return true;                 
                           
           
    }  
//*******************************************************************   
//******************************************************************* 
function update_payment_status_automaticly_privat24($array_res, $payment)   {
  //  echo "<pre>"; print_r($payment); exit();
  
  $privat_datetime = $array_res['date']; // ddMMyyHHmmss
  $dd = substr($privat_datetime, 0, 1);
  $mm = substr($privat_datetime, 2, 3);
  $yy = substr($privat_datetime, 4, 5);
  $hh = substr($privat_datetime, 6, 7);
  $mm = substr($privat_datetime, 8, 9);
  $ss = substr($privat_datetime, 10, 11);
  
  $fact_private_date = "20".$yy.$mm.$dd.$hh.$mm.$ss;
  
  // $time = time(); 
         $mysql_update = "
           UPDATE `payments` SET  
          `pb_status` = '".$array_res['state']."', 
          `pb_trans_id` = '".$array_res['ref']."',
          `pb_sender_phone` = 'priva24',
          `privatbank_pay_way` = '".$array_res['pay_way']."' ,
          `datetime_pay_done` = '".$fact_private_date."' 
           WHERE `id`=  ".$payment['order_id']." 
           LIMIT 1
           "; 
           // `privatbank_code` = '".$string->code."',
           // AND `id_user` = ".$payment['id_user']."
       //   echo $mysql_update; exit(); 
        $this->db->query($mysql_update);  
                  
     return true;                 
                           
           
    }  
//*******************************************************************   
 //************************************************************************************
  function loadOrder_Template()     {                 
        $query = "
            SELECT *
               FROM `orders_options`
            WHERE `id` = 1
        ";
       //  // echo   $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data = $row;
                $data = array(
                     'id'        => $row['id'],
                     'name'      => $row['name'.$this->lang()], 
                     'text'   => $row['text'.$this->lang()] 
                   );  
             }
        }
         return $data;             
    }
  //************************************************************************************
  // load_Order_List
   //************************************************************************************
  function load_Order_List($id)
    {
       $user_id = $this->session->userdata('user_id');    
        $query = " SELECT *
                 FROM `payments`
                 WHERE `id`= ".$id."
                 AND `user_id` = ".$user_id."
                 LIMIT 1
        ";
       //  // echo   $query; exit(); 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  // $data[] = $row ; 
                  $data = array(
                     'id'      => $row['id'],
                     'user_id'   => $row['user_id'],
                     'referal_id'   => $row['referal_id'],
                     'price'   => $row['price'],
                     'target'   => $row['target'],
                     'actual'   => $row['actual'],
                     'datetime_create'   => $row['datetime_create'],
                     'datetime_pay_done'   => $row['datetime_pay_done'],    
                     'pay_status'   => $row['pay_status'],
                     'ip_payer'   => $row['ip_payer'],
                     'comment'   => $row['comment'], 
                     'datetime_create'   => $row['datetime_create'],
                     'user_info'  => $this->load_User_info_short_by_id( $row['user_id']) 
                     ); 
                    
            }
        }
       //  // print_r ($data); exit;
        return $data;             
    }
    //******************************************************************    
  
 //************************************************************************************
  function check_ismy_order($id) {
      
        $user_id = $this->session->userdata('user_id');       
            
           $query = " SELECT *
                 FROM `payments`
                 WHERE `id`= ".$id." 
                 AND `user_id` = ".$user_id." 
                 LIMIT 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 //  $data[] = $row ; 
                  $data = array(
                     'id'        => $row['id'],
                     'id_user'      => $row['user_id'], 
                     'datetime_create'   => $row['datetime_create'],
                     'target'         => $row['target'],
                     'referal_id'     => $row['referal_id'] 
                   ); 
                  
            }
        }
       // print_r($data); exit;
        return $data;             
    }
 //************************************************************************************ 
  function get_user_id_by_order_payment($id) {
       
           $query = " SELECT `user_id`
                 FROM `payments`
                 WHERE `id`= ".$id."  
                 LIMIT 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                   $data = $row ;  
            }
        }
       // print_r($data); exit;
        return $data;             
    }
 //************************************************************************************ 
  //************************************************************************* 
      function load_Levels_and_count_multi($ref_id = 0) 
    {
        //  $label_check = 1, $pay_status = ''
        $user_id = $this->session->userdata('user_id');   
        $query = " 
        SELECT 
        `tar`.`id` as `target_id`, 
        `tar`.`menu_name-rus`, 
        `tar`.`level` ,
        `tar`.`price` 
        FROM `targets` `tar`        
        WHERE `tar`.`visible` = 1  
        ";
         // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
             $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row; 
                 $data[] =array(
                     'id'        => $row['target_id'], 
                     'menu_name'   => $row['menu_name-rus'],
                     'level'   => $row['level'],
                     'price'   => $row['price'],
                     'count_my_this_referals' => $this->count_my_this_referals($row['target_id'], $user_id) ,
                     'count_visit_v_zaprose_payet' => $this->count_visit_v_zaprose_payet($row['target_id'], $user_id) ,
                     'count_visit_v_zaprose_not_payet' => $this->count_visit_v_zaprose_not_payet($row['target_id'], $user_id)  
                     );
                  
               }    
        }
        
      //  echo "<pre>"; print_r($data); exit();  
         
         return $data;             
    }      
//************************************************************************************ 
 //*******************************************************************************
   
    //******************************************************************    
   //*****************************************************************************      
  // ********************************************************************************
//************************************************************************************  
//************************************************************************************  
}
?>