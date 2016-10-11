<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/** Model class
 * @author Ageev Alexey
 * @copyright  2014
 */

class model_auth_user extends CI_Model {
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
        
        //".db_quote(base64_encode($pass)).",    
          $query = "
            SELECT * FROM `customers_users`
            WHERE `email`=  ".db_quote($data['username'])."         
            AND  `pass`=  ".db_quote(base64_encode(trim($data['pword'])))."  
             LIMIT 1       
        ";   // AND  `active`= 1 
     //   echo  $query; exit();  
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
                     'inn'   => $row['inn'],
                     'phone'   => $row['phone'],   
                     'status'   =>   $row['status'] ,
                     'active'   => $row['active'], 
                     'contacts'   => $row['contacts'] 
                   );   */ 
                   // 'total_summa'   =>  $row['total_summa'], 
            }          // 'status'   => $this->loadStatus_Info( $row['status']), 
        }   
      //  echo "<br>";
      //  print_r($data);
      //  exit(); 
        return $data;            
    } 
 //*******************************************************************
function Get_All_History_Sum($user_id, $history_sums)  {

       
        // query performing
        $query = "
            SELECT 
            SUM(`total_sum_to_pay`) as `sum` 
            FROM `orders_base`
            WHERE `order_status` != 6
            AND `id_user` = ".$user_id." 
            LIMIT 1  
         ";

        $dbres = $this->db->query($query);
            $data = array();
         if ($dbres->num_rows() >= 1) {
                                                          
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                     $data = $row;
                    /* $data = array(
                     'id'                 => $row['id'],
                     'id_user'            => $row['id_user'],
                     'user_group'         =>  $row['user_group'],    
                     'total_sum_to_pay'   =>  $row['total_sum_to_pay'],        
                     'total_sum'          => $row['total_sum'] 
                   );*/             
            }
        }
        $total_summa = 0;
        $cdp_percent = 0;
        if(!empty($data)){
            
            $total_summa = $data['sum'];
          /*  foreach($data as $platezh){
                $last_buy = $platezh['total_sum_to_pay']; 
        $total_summa = $total_summa + $last_buy;
            }   */
        }
        $total_summa = $total_summa + $history_sums;  
        
        
        $datacdp['percent'] = $cdp_percent;
        $datacdp['total_summa'] = $total_summa;
       //  echo $cdp_percent;
       // echo "<pre>"; print_r($data);
       //  exit();
        return $datacdp;
    } 
 //**********************************************************  
 function Get_Discont($price_notpromo_cdp)  {


        $query = "
            SELECT  `percent` 
            FROM `customers_group_cdp`
            WHERE `min_v`<= $price_notpromo_cdp
            AND   `max_v`>= $price_notpromo_cdp
           ";
      //      echo $query."<br>";
            //WHERE `min_v`<= '".$price_notpromo_cdp."'
           // AND   `max_v`>= '".$price_notpromo_cdp."'
           // WHERE  `id` = '".$id_model."'  
        $dbres = $this->db->query($query);
    //  $data = array();
    $cdp_discont=0;
         if ($dbres->num_rows() >= 1) {
           $rows = $dbres->result_array();
            foreach ($rows as $row) {
                    $cdp_discont = $row['percent'];
                       
        }       
             
    }
  //  echo $cdp_discont."<br>"; exit();
     return $cdp_discont;
  }   
  //******************************************************************
   
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
     /*     $query = "
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
        }    */      
  /////////////////////////////           
         
 // $user_from = get_cookie('camed_from');           
 // $active_code =  (base64_encode($data['email']).rand());
  
  $gender = '';
  if(isset($data['gender']) && !empty($data['gender'])) {
   // $gender = $data['gender'];
  }
  
  $data['referal'] = ltrim($data['referal'], '0');
  $add_to_fields = '';
  $add_to_values = '';
 
  $mysql_insert="INSERT INTO `customers_users` ( 
  `email`, 
  `referal`,
  `name`,
  `surname`,
  `pass`, 
  `date_reg`,
  `act_code`,
  `active`, 
  $add_to_fields
  `gender`  ) 
         VALUES 
         (
        ".db_quote($data['email']).",
        ".db_quote($data['referal']).",
        ".db_quote($data['name']).",
        '',
        ".db_quote(base64_encode($data['pword'])).",  
        now(),
        0,
        1 , 
        $add_to_values
         ".db_quote($gender)." 
        )";
        // ".db_quote(date("Y-m-d")).",
           
      //   print_r($mysql_insert); exit;
        $this->db->query($mysql_insert);
      
        $addz = $this->db->insert_id();

                         // $to  = "<alex.veider@gmail.com>" ; 
                          $to  = $data['email']; 
                         // $subject = 'Активация аккаунта на AccountBook -' .$addz ;
                          $subject = lang('main_user_letter_register_account') ;
                          
                          $date = date('Y-m-d H:i:s', time());
                          $search = array (
                             '#email#',
                             '#site_url# ',
                             '#date#',
                             '#pass#',
                             '#name#',
                             '#surname#',
                             '#addz#' ,
                             '#site_url#'
                             );
                             // $data['surname']
                          $replace = array (
                             $data['email'],
                             base_url(),
                             $date,
                             $data['pword'],
                             $data['name'],
                             '',
                             $addz,
                             base_url()
                             );
                          
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
                      $headers .= "Reply-To: <register@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <register@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n"; 
                       

                        mail($to, $subject, $message, $headers);     
      /////// конец мыльной отправки ///////                       
  
  
  $query = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 4 "; 
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
     //  ".$data['surname']." 
                          $to  = $emails;                
                          $subject = 'Новый пользователь на alafa.com.ua' ; 
                          $message = " 
                          <html><body><p>
                          На сайте зарегистрировался новый пользователь. <br> <br> 
                          
                          Имя  - ".$data['name']."<br> 
                         
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
                      
                   //   mail($to, $subject, $message, $headers);
   //===============
  
  
  
              
// return $this->db->insert_id(); 
   
   return $addz;
 
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
                 't','u','v','x','y','z' ,
                 '1','2','3','4','5','6',
                 '7','8','9','0');
    // Генерируем пароль
    $pass = "";
   /* for($i = 6;  $i < 10; $i++)
    {
      // Вычисляем случайный индекс массива
      $index = rand(0, count($arr) - 1);
      $pass .= $arr[$index]; 
    }  */
    $aeghad = time();
    $pass = $pass.$aeghad;
  // echo "<br>".$pass."<br>";
 //////////////////////        
   $mysql_update = "UPDATE `customers_users` SET 
   `pass`    = ".db_quote(base64_encode($pass))."              
    WHERE `id`= ".$id_user."  ";
    $this->db->query($mysql_update);  
      
      

                         // $to  = "<alex.veider@gmail.com>" ; 
                          $to  = $data['email']; 
                      
                          $subject = lang('main_user_letter_remind_pas_header') ;   
                         
                          $date = date('Y-m-d H:m', time());
                          $search = array (
                             '#email#',
                             '#date#',
                             '#pass#',
                             '#site_url#'
                             );
                          $replace = array (
                             $data['email'],
                             $date,
                             $pass,
                             base_url()
                             );
                          
                          $document = lang('main_user_letter_remind_pas_text');
                          
                          $text = str_replace($search, $replace, $document); 
                         
                         
                          $message = " 
                          <html><body><p>
                          ".$text."
                           
                              
                          ".lang('main_letter_sign')."
                          
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
            WHERE `id_group` =  ".$id." 
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
           WHERE `id`= ".$id." 
           LIMIT 1
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
            LIMIT 1
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
   //********************************************************************* 
   function check_email_is_reg($id) 
   { 
   $sql = "SELECT COUNT(*) as `count` FROM `customers_users` WHERE `email`=  ".db_quote($email)." ";
    $query = $this->db->query($sql);
    $row = $query->result_array();
    return $row[0]['count'];
     
   }   
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