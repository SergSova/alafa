<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Ageev Alexey
 * @copyright  2012
 */

class model_subscribe extends CI_Model {
    /**
     * Model constructor
     */
     function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
        $this->lang->load('main', 'russian');  
    }
//*************************************************************************************************
 
//*************************************************************************************************
        
   
 //**************************************************************************************   
     
//**********************************************************************
function add_subscribe($data){
  
        
     $mysql_insert = "INSERT INTO `subscribes` (
     `name`,   
     `subject`, 
     `text`,
     `from_name`,
     `from_email`,
     `date_create`
      ) 
         VALUES (
         ".db_quote($data['name'])." ,   
         ".db_quote($data['subject'])." ,
         ".db_quote($data['text'])." ,
         ".db_quote($data['from_name'])." ,
         ".db_quote($data['from_email'])." ,    
         now()
         )";
 
        $this->db->query($mysql_insert);
    // return true;  
    return $this->db->insert_id();       
     }
      
 //*********************************************************************
 function delete_subscribe($id){
       $sql="DELETE FROM `subscribes` WHERE id='".$id."'";
        if (!mysql_query($sql)) {
            return false;
        }
    
         return true;
    
    }
   //************************************************************************
   function loadCustomer_one($id)
    {
          $query = "   SELECT * FROM `customers_users` WHERE `id` = '".$id."'  ";
         // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
             $rows = $dbres->result_array();
            foreach ($rows as $row) {
              //    $data[] = $row;
             $data[] =array(
                     'id'      => $row['id'],
                     'email'   => $row['email'],
                     'name'   => $row['name'],    
                     'date_reg'   => $row['date']
                   ); 
              }
        }

         return $data;             
    }
 //*********************************************************************
 function edit_subscribe($data){
       
     //  echo "<pre>";
     //    print_r($data);exit();
       
    $id = $data['id_ed'];                             
    $mysql_update = "UPDATE `subscribes` SET 
   `subject` = ".db_quote($data['subject']).", 
   `text` = ".db_quote($data['text']).", 
   `from_name` = ".db_quote($data['from_name']).", 
   `from_email` = ".db_quote($data['from_email']).", 
   `name` = ".db_quote($data['name'])."
    WHERE `id`='".$id."'
            "; 
      //   echo $mysql_update; exit();   
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    } 
 //*********************************************************************
  
     function loadCustomers()  {                      
        
        // query performing                
        $query = "
            SELECT `email`, `name`
            FROM `customers_users`
            WHERE  1 = 1
            ORDER BY `email` ASC   
         ";
     
        $dbres = $this->db->query($query);
      $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
           
                     $data[] =array(          
                     'email'   => $row['email'],
                     'name'   => $row['name']
                   );            
            }
        }       
        return $data;             
    }
  //***************************************************
  //******************************************************************************************
 
  
 //*********************************************************************
   
 //******************************************************************************************
 
     function Get_Subscrs_All($start_limit)
    {                      
       $order = "  LIMIT $start_limit, 20";   
        // query performing                
        $query = "
            SELECT SQL_CALC_FOUND_ROWS 
            *
            FROM `subscribes`
            WHERE  1 
            ORDER BY `date_create` DESC
            $order
            
         ";
          // ASC
        $dbres = $this->db->query($query,$start_limit);
      $data = array();
         if ($dbres->num_rows() >= 1) {
             
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
             
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
           
                 $data['list'][] = $row;
                   /*  $data['list'][] =array(
                     'id'      => $row['id'],
                     'email'   => $row['email'],
                     'name'   => $row['name'],
                     'surname'   => $row['surname'] 
                     
                   ); */   
            }
        }       
        return $data;             
    }
 //***************************************************  
 //************************************************************************
   function load_Subscribe_for_make($id)
    {
          $query = " SELECT 
          `id`,
          `name`, 
          `subject`,
          `text`,
          `from_name`,
          `from_email` 
           FROM `subscribes` WHERE `id` = '".$id."'  ";
         // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
             $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data = $row;
            /* $data[] =array(
                     'id'      => $row['id'],
                     'email'   => $row['email'],
                     'name'   => $row['name'],    
                     'date_reg'   => $row['date']
                   );     */
              }
        }

         return $data;             
    }
 //*********************************************************************  
 //*********************************************************************
 function do_subscribe($datasend){
   //  echo $datasend['what_base'];
   //  echo "<pre>"; print_r($datasend);  exit();
      
     $this->update_Subscr_done($datasend['id_templ']); 
      if($datasend['what_base']=='shop_base') 
      {
        $query = "
            SELECT 
            `id`,
            `name`,
            `surname`,
            `email` 
            FROM `customers_users`  
            WHERE 1 ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $datausers[] = $row ;
            
             }
        }  
      } 
       if($datasend['what_base']=='external_base') 
       {      
               $this->load->helper('email_parse');
                 if(trim($datasend['external_email_base'])!='')
                 {                                                     
                $data_external_email_base = extract_emails_from($datasend['external_email_base']);
               //  echo "<pre>"; print_r($datausers);  exit();             
                 }
       }
                                  
      if(!empty($datausers)) { // shop base
       //    echo "<pre>"; print_r($datausers);  exit();     
      foreach($datausers as $user) { // --------------------------------
       
 
    
                          $subject = $datasend['subject'];
                                             
                          $search = array (
                             '#email#',
                             '#name#',
                             '#surname#' 
                             );
                          $replace = array (
                             $user['email'],
                             $user['name'],
                             $user['surname'] 
                             );
                          
                        
                         $document = $datasend['text'] ;
                          
                         $text = str_replace($search, $replace, $document); 
                          
                          
               $message = " 
              <html><body><p>    
             ".$text."             
             
              </p></body></html>"; 
              //  ".lang('main_letter_sign')."    

                      $from = $datasend['from_name'];
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                       
                      $headers= "MIME-Version: 1.0\r\n";                        
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <".$datasend['from_email'].">\r\n";   
                      $headers .= "From: ".$from." <".$datasend['from_email'].">\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n";
                    
                   if(!mail($user['email'], $subject, $message, $headers))
                   {
                    return false; 
                   }
                              
      } // for all users foreach -------------------------------------
      }  // shop base  
      
        if(!empty($data_external_email_base)) { // external base
        //   echo "<pre>"; print_r($data_external_email_base);  exit();     
      foreach($data_external_email_base as $email) { // --------------------------------
                            
                         $subject = $datasend['subject'];
                                   
                         $text =   $datasend['text'] ; 
                            
               $message = " 
              <html><body><p>    
             ".$text."                          
              </p></body></html>"; 

                      $from = $datasend['from_name'];
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?='; 
                      
                      $headers= "MIME-Version: 1.0\r\n";                        
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <".$datasend['from_email'].">\r\n";   
                      $headers .= "From: ".$from." <".$datasend['from_email'].">\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n";
                    
                   if(!mail($email, $subject, $message, $headers))
                   {
                    return false; 
                   }
                              
      } // for external users foreach -------------------------------------
      }  // external base  
      
         
 
    return true;
 }
 //*********************************************************************
 //*********************************************************************
 function do_subscribe_res_copy($datasend){
      
     $this->update_Subscr_done($datasend['id_templ']); 
      
        $query = "
            SELECT 
            `id`,
            `name`,
            `surname`,
            `email` 
            FROM `customers_users`  
            WHERE 1 ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);

        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $datausers[] = $row ;
                /*  $dataemails[] = array(
                     'email'       => $row['email']
                   ); */
             }
        }
      // $dataemails = array_values(array_unique($dataemails));
      //$mail_list = array();
      if(!empty($datausers)) {
      foreach($datausers as $user) { // --------------------------------
       
      //  array_push($mail_list, $mail['email']);  
      
     // }  
       
    // echo "<pre>";  print_r(array_values($mail_list));exit();    
    // echo "<pre>"; print_r($dataemails);exit();
    // $name="Уважаемый(-ая) участник(-ца) рассылки!";
     // $name='';  
    
                          $subject = $datasend['subject'];
                                             
                          $search = array (
                             '#email#',
                             '#name#',
                             '#surname#' 
                             );
                          $replace = array (
                             $user['email'],
                             $user['name'],
                             $user['surname'] 
                             );
                          
                         // $document = $this->load_Subscr_Template($datasend['id_templ']);
                         $document = $datasend['text'] ;
                          
                         $text = str_replace($search, $replace, $document); 
                          
                          
               $message = " 
              <html><body><p>    
             ".$text."
              <hr>             
              ".lang('main_letter_sign')." 
              </p></body></html>"; 

                      $from = lang('main_user_order_shop_name');
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers  = "Content-type: text/html; charset=utf8 \r\n"; 
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <m-sale@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <m-sale@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n";
                    
                   if(!mail($user['email'], $subject, $message, $headers))
                   {
                    return false; 
                   }
            
      } // for all users foreach -------------------------------------
      }
  
    return true;
 }
 //*********************************************************************
   //************************************************************************************
  function load_Subscr_Template($id)     {                 
        "
          SELECT * FROM `subscribes` WHERE `id` = '".$id."' 
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
  //************************************************************************************    
   //*********************************************************************
 function update_Subscr_done($id){  
 //$now = date("Y-m-d H:m:i"); 
 //'".$now."'                            
    $mysql_update = "UPDATE `subscribes` SET  
   `date_send` = now()
    WHERE `id`='".$id."'
            "; 
      //   echo $mysql_update; exit();   
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    } 
 //*********************************************************************
 //*********************************************************************
 //*********************************************************************
 //************************************************************************        
//************************************************************************************
}
?>