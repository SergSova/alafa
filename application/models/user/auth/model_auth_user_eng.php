<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/** Model class
 * @author Ageev Alexey
 * @copyright  2011
 */

class model_auth_user_eng extends CI_Model {
    /**
     * Model constructor
     */
     function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//*************************************************************************************************

 function load_User_info($data)
    {
          $query = "
            SELECT * FROM `customers_users`
            WHERE `email`=  ".db_quote($data['username'])." 
            AND  `pass`=  ".db_quote(md5($data['pword']))."
            AND  `active`=  1
           
        ";
     //   echo  $query; exit();  
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
             //     $data = $row ; 
             $data = array(
                     'id'      => $row['id'],
                     'email'   => $row['email'],
                     'name'   => $row['name'],
                     'surname'   => $row['surname'],
                     'status'   =>   $row['status'] ,
                     'active'   => $row['active'],
                     'total_sum_amount'   =>  $row['amount'],
                     'total_sum_discount'   =>  $row['discount']
                   );    
            }          // 'status'   => $this->loadStatus_Info( $row['status']), 
        }   
      //  echo "<br>";
      //  print_r($data);
      //  exit(); 
        return $data;            
    } 
 
//*************************************************************************************************
function load_User_remind_pass($email)
    {
          $query = "
            SELECT `id`, `email` FROM `customers_users`
            WHERE `email` =  ".db_quote($email)." 
         ";
      //  echo  $query; exit();  
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
 
  //*************************************************************************************************
              
 function adduser($data){
     
    
   //  echo "<pre>";
   //   print_r($data); exit(); 
             //.$addz."-uid-".trim(md5($data['email']).rand()).
          $query = "
            SELECT `id` FROM `customers_groups`
            WHERE `default`=  1 
          ";
      //  echo  $query; exit(); 
        $dbres = $this->db->query($query);

        $datagroup = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $datagroup = $row ;
             }
        }          
  /////////////////////////////           
             
             
  $active_code =  (md5($data['email']).rand());
   
  $mysql_insert="INSERT INTO `customers_users` ( 
  `email`, 
  `name`,
  `surname`,
  `pass`,
  `status`,  
  `date_reg`,
  `act_code`) 
         VALUES 
         (
        ".db_quote($data['email']).",
        ".db_quote($data['name']).",
        ".db_quote($data['surname']).",
        ".db_quote(md5($data['pword'])).",
        ".db_quote($datagroup['id']).",
        ".db_quote(date("Y.m.d")).",
        ".db_quote($active_code)."
        )";
           
      //   print_r($mysql_insert); exit;
        $this->db->query($mysql_insert);
      
        $addz = $this->db->insert_id();

                         // $to  = "<alex.veider@gmail.com>" ; 
                          $to  = $data['email']; 
                         // $subject = 'Активация аккаунта на AccountBook -' .$addz ;
                          $subject = lang('main_user_letter_register_account') ;
                          
                          $date = date('Y-m-d H:m:i', time());  
                          $search = array (
                             '#email#',
                             '#date#',
                             '#pass#',
                             '#name#',
                             '#surname#',
                             '#addz#' ,
                             '#active_code#'
                             );
                          $replace = array (
                             $data['email'],
                             $date,
                             $data['pword'],
                             $data['name'],
                             $data['surname'],
                             $addz,
                             $active_code);
                          
                          $document = lang('main_user_letter_register_account_text');
                          
                          $text = str_replace($search, $replace, $document);   
                          $message = " 
                          <html><body><p>
                          ".$text." 
                          </p>
                          ".lang('main_letter_sign')." 
                          </body></html>"; 
                    
                      
                      $from = lang('main_user_order_shop_name');
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers  = "Content-type: text/html; charset=utf8 \r\n"; 
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <accounts@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <accounts@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                       

                        mail($to, $subject, $message, $headers);     
      /////// конец мыльной отправки /////// 
      
      $query = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 6 "; 
        $dbres = $this->db->query($query);
        $data_admin = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {         
                  $data_admin =array(
                     'email'       => $row['value']
                   );
             }
        } 
      $datae = explode(",", $data_admin['email']);
      for($i=0; $i<count($datae); $i++){
       $email[]   = trim($datae[$i]); 
             }
       $emails = implode("," , $email); 
     
                          $to  = $emails;                
                          $subject = 'Новый пользователь на alafa.com.ua' ; 
                          $message = " 
                          <html><body><p>
                           На сайте зарегистрировался новый пользователь. <br> <br>  
                          Имя  - ".$data['name']." ".$data['surname']." <br> 
                         
                          Почта  - ".$data['email']." <br> 
                          
                       <br>
                          Дата регистрации - ".$date."
                          <hr>
                          Отправлено автоматически с сайта ".base_url()."
                          </p></body></html>";                   
                
                      $from = lang('main_user_order_shop_name');
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers  = "Content-type: text/html; charset=utf8 \r\n"; 
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <accounts@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <accounts@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n";
                      
                      mail($to, $subject, $message, $headers);
   //===============
                            
              
return $this->db->insert_id(); 
   
 
 } 
//*************************************************************************************************
  //*************************************************************************************************
              
 function remind_user_pass($id){
     
 /////////    
      $query = "
            SELECT `id`, `email` FROM `customers_users`
            WHERE `id` =  ".db_quote($id)." 
         ";
      //  echo  $query; exit();  
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data = $row ;     
            }
        }     
///////////     

 /* $active_code =  (md5($data['email']).rand());
  $hash =  (md5($data['email']));  */
  $id_user =  ($data['id']);
  
  //////////////////////
  
 $arr = array('a','b','c','d','e','f',
                 'g','h','i','j','k','l',
                 'm','n','o','p','r','s',
                 't','u','v','x','y','z',
                 'A','B','C','D','E','F',
                 'G','H','I','J','K','L',
                 'M','N','O','P','R','S',
                 'T','U','V','X','Y','Z',
                 '1','2','3','4','5','6',
                 '7','8','9','0');
    // Генерируем пароль
    $pass = "";
    for($i = 6;  $i < 10; $i++)
    {
      // Вычисляем случайный индекс массива
      $index = rand(0, count($arr) - 1);
      $pass .= $arr[$index]; 
    }
  
 ////////////////////// 
 
   $mysql_update = "UPDATE `customers_users` SET 
   `pass`    = ".db_quote(md5($pass))."
    WHERE `id`='".$id_user."'    ";
    $this->db->query($mysql_update);  
      
      

                         // $to  = "<alex.veider@gmail.com>" ; 
                          $to  = $data['email']; 
                      
                          $subject = lang('main_user_letter_remind_pas_header') ;   
                         
                          $date = date('Y-m-d H:m', time());
                          $search = array (
                             '#email#',
                             '#date#',
                             '#pass#'
                             );
                          $replace = array (
                             $data['email'],
                             $date,
                             $pass
                             );
                          
                          $document = lang('main_user_letter_remind_pas_text');
                          
                          $text = str_replace($search, $replace, $document); 
                         
                         
                          $message = " 
                          <html><body><p>
                          ".$text."
                          <hr>
                         
                          
                          ".lang('main_letter_sign')."
                          
                          </p></body></html>"; 
                    /* $headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
                     $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                     $headers .= "Reply-To: <feedback@alafa.com.ua>\r\n"; 
                      $headers .= "From: Форма связи LiloСa<feedback@alafa.com.ua> \r\n";   
                      $subject = mb_convert_encoding($subject, "windows-1251", "UTF-8");
                      $message = mb_convert_encoding($message, "windows-1251", "UTF-8");
                      $headers = mb_convert_encoding($headers, "windows-1251", "UTF-8"); */
                      
                      $from = 'Интернет-магазин Taik';
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers  = "Content-type: text/html; charset=utf8 \r\n"; 
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <feedback@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <feedback@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                      
                     
                        mail($to, $subject, $message, $headers);     
      /////// конец мыльной отправки ///////                       
              
return $this->db->insert_id(); 
   
 
 } 
//*************************************************************************************************    
//*************************************************************************************************

 function ActivateAccount($user_id, $user_act_code)   {
         // query performing 
        $query = "
            SELECT * FROM `customers_users`
            WHERE `id`=  ".$user_id." 
            AND  `act_code`=  ".$user_act_code."
         ";
      //  echo  $query; exit(); 
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data = $row ;
             }
        }
      //  print_r($data); exit();  
        ////////////////////////////////////
        if(!empty($data))  {
          //  echo "Щас обновим..."; exit(); 
        $mysql_update = "
           UPDATE `customers_users` SET 
          `active` = 1 
           WHERE `id`=  ".$user_id."
            "; 
       //   echo $mysql_update; exit(); 
        $res = $this->db->query($mysql_update);
         // echo $res; exit();
        }
        ////////////////////////////////////
      //   print_r($data); exit();
     if(!empty($data) && $res == '1')  { 
        return $data;
     }  
     else{
         $empty = array();
        return  $empty;
     }         
    } 
 //******************************************************************************************
 function Remind_Pass_Account($user_id, $user_remind_code)
    {
         // query performing 
        $query = "
            SELECT * FROM `customers_users`
            WHERE `id`=  ".$user_id." 
            AND  `remind_pass_code`=  ".$user_remind_code."
         ";
      //  echo  $query; exit(); 
        $dbres = $this->db->query($query);

        $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data = $row ;
             }
        }
         ////////////////////////////////////
           if(!empty($data) && $res == '1')  { 
        return $data;
     }  
     else{
         $empty = array();
        return  $empty;
     }         
    }  
//*************************************************************************************************
function loadStatus_Info($id)   {
          $query = "
            SELECT *
               FROM `customers_groups`
            WHERE `id` = '".$id."'
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
//************************************************************
function load_Cdp_Datas()
    {                      
   //    $order = "  LIMIT $start_limit, 20";   
        // query performing                
        $query = "
            SELECT  * 
            FROM `customers_group_cdp`
            WHERE  1
            ORDER BY `percent` ASC
           ";
     
        $dbres = $this->db->query($query);
      $data = array();
         if ($dbres->num_rows() >= 1) {
              
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 $data[] = $row; 
                  
            }
        }       
        return $data;             
    }   
//************************************************************
function update_User_activity_info($data){
  
   $id = $this->session->userdata('user_id');   
       $mysql_update = "UPDATE `customers_users` SET 
   `last_ip`      = ".db_quote($data['ip'])." ,
   `last_visit`      = now()
           WHERE `id`='".$id."'
            ";
          //  echo  $mysql_update; exit();   
         $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    }    
//************************************************************
 function check_email($email){


////////////////////////////////////////////////////////////////////////     
     // $data['email']             $email
          $query = "
            SELECT `id` FROM `customers_users`
            WHERE `email`=  ".db_quote($email)."
          ";
      //  echo  $query; exit();
        $dbres = $this->db->query($query);

        $datacheckemail = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $datacheckemail = $row ;
             }
        }
        
        if(empty($datacheckemail)){ $ans = 0; }
        if(!empty($datacheckemail)){ $ans = 1; } 
        
        return $ans;
 }
//************************************************************
 
//************************************************************     
    /**
     * EmptyTemplateModel
     * @return {void}
     * @param  {void} $param
     */
/*  function some_func() {
        
        //----------------------------------------------------------------------------
        return true;
    }
*/
//************************************************************************************
}
?>