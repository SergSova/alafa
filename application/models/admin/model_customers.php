<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * predmets Model class
 * @author Ageev Alexey
 * @copyright  2014
 */

class model_customers extends CI_Model {
    /**
     * Model constructor
     */
     function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//*************************************************************************************************
    
 //*******************************************************************************  
  
//**************************************************************************
   function count_all_customers() 
   { 
   $sql = "SELECT COUNT(id) as `count` FROM `customers_users`";
    $query = $this->db->query($sql);
    $row = $query->result_array();
    return $row[0]['count'];
     
   } 
//**********************************************************************************************
  
//******************************************************************************************
  //**********************************************************  
function loadCustomerNameForSearch ($term)              
    { 
    $term = trim($term);  
       $query = "
            SELECT `name`, `surname`, `email` FROM `customers_users`
            WHERE `name` LIKE '%".$term."%'
            OR `surname` LIKE '%".$term."%'
            OR `email` LIKE '%".$term."%'
          
            LIMIT 15
            ";    //  OR   `surname` LIKE '%".$term."%'   
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
    //**************************************************************************************
     function loadCustomers($start_limit)
    {                      
       $order = "  LIMIT $start_limit, 20";   
        // query performing                
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM `customers_users`
            WHERE  1 = 1
            ORDER BY `region` ASC
            $order
            
         ";
     
        $dbres = $this->db->query($query,$start_limit);
      $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
           
                     $data[] =array(
                     'id'      => $row['id'],
                     'email'   => $row['email'],
                     'name'   => $row['name'],
                     'surname'   => $row['surname'],
                     'byfather'   => $row['byfather'],
                     'nic'   => $row['nic'],
                     'gender'   => $row['gender'],
                     'birthday'   => $row['birthday'], 
                     'u_adres'   => $row['adres'], 
                     'status'   => $row['status'],
                     'phone'   => $row['phone'],
                     'contacts'   => $row['contacts'],
                     'active'   => $row['active'],
                     'last_visit'   => $row['last_visit'],
                     'last_ip'   => $row['last_ip'],
                     'date_reg'   => $row['date_reg'],
                     'autoreg '   => $row['autoreg']
                   );            
            }
        }       
        return $data;             
    }
  //*****************************************************************************************
  //******************************************************************************************
 
     function Get_Customers_All_for_filter($start_limit)
    {                      
       $order = "  LIMIT $start_limit, 40";   
        // query performing                
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM `customers_users`
            WHERE  1 
            ORDER BY `date_reg` DESC
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
           
                     $data['customers'][] =array(
                     'id'      => $row['id'],
                     'email'   => $row['email'],
                     'name'   => $row['name'],
                     'surname'   => $row['surname'],
                     'byfather'   => $row['byfather'],
                     'nic'   => $row['nic'],
                     'gender'   => $row['gender'],
                     'birthday'   => $row['birthday'],
                     'u_region'   => $row['region'], 
                     'town'   => $row['town'],     
                     'u_adres'   => $row['adres'], 
                     'status'   => $row['status'],
                     'phone'   => $row['phone'],
                     'contacts'   => $row['contacts'],
                     'active'   => $row['active'],
                     'last_visit'   => $row['last_visit'],
                     'last_ip'   => $row['last_ip'], 
                     'date_reg'   => $row['date_reg'],
                     'autoreg'   => $row['autoreg'],
                     'total_sum_amount'   =>  $row['amount'],
                     'total_sum_discount'   =>  $row['discount'],
                     'count_of_referals' =>  $this -> count_my_this_referals($row['id'])  ,
                     'my_actual_levels'   => $this -> load_my_actual_levels($row['id']),
                     'urik_edrpou'   => $row['urik_edrpou'] ,
                     'urik_name'   => $row['urik_name'] ,
                     'urik_vid_sobs'   => $row['urik_vid_sobs'] ,
                     'urik_ur_adres'   => $row['urik_ur_adres'] ,
                     'urik_nalog_sys'   => $row['urik_nalog_sys'] ,
                     'urik_yn'   => $row['urik_yn'] 
                   );      // 'total_sum_percents'   =>  $this -> Get_All_History_Sum($row['id'])       
            }
        }       
        return $data;             
    }
 //*****************************************************************************************  
  //******************************************************************************
   
 function load_my_actual_levels($id_user)
    {
          $user = $this->session->userdata;
          $query = "
            SELECT * FROM `payments`
            WHERE `user_id`= ".$id_user."
            AND `pay_status` = 1
              ";
            // `email`=  ".db_quote($user['email'])." 
            // AND  
       // echo  $query; exit();  
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
 //**************************************************************************************   
 function count_my_this_referals_by_level($main_level, $id_user) 
   { 
   $sql = "SELECT COUNT(*) as `count` FROM `payments` WHERE `target` = ".$main_level." AND `referal_id` = ".$id_user." AND `pay_status` = 1 ";
    $query = $this->db->query($sql);
    $row = $query->result_array();
    
    return $row[0]['count'];
     
   }         
 //*************************************************************************************** 
  //**************************************************************************************   
 function count_my_this_referals( $id_user) 
   { 
   $sql = "SELECT COUNT(*) as `count` FROM `payments` WHERE `referal_id` = ".$id_user." AND `pay_status` = 1 ";
    $query = $this->db->query($sql);
    $row = $query->result_array();
    
    return $row[0]['count'];
     
   }         
 //*****************************************************************************
   //************************************************************************************ 
      function Get_Filtered_customers($searchdata, $start_limit)  {                      
     
        $order = "  LIMIT $start_limit, 40";   
        
         //////============ ============//////  
         if(trim($searchdata['date_reg_from']) !== 'old' && trim($searchdata['date_reg_to']) !== 'new'){ 
                     $date1 = trim($searchdata['date_reg_from']);
                     $date2 = trim($searchdata['date_reg_to']);
                     $where_date_reg = " AND DATE(`date_reg`) >= '".$date1."' AND DATE(`date_reg`) <= '".$date2."'  ";
                     }
        if(trim($searchdata['date_reg_from']) == 'old' && trim($searchdata['date_reg_to']) !== 'new'){ 
                     $date1 = trim($searchdata['date_reg_from']);
                     $date2 = trim($searchdata['date_reg_to']);
                     $where_date_reg = " AND DATE(`date_reg`) <= '".$date2."'  ";
                     }
        if(trim($searchdata['date_reg_from']) !== 'old' && trim($searchdata['date_reg_to']) == 'new'){ 
                     $date1 = trim($searchdata['date_reg_from']);
                     $date2 = trim($searchdata['date_reg_to']);
                     $where_date_reg = " AND DATE(`date_reg`)  >= '".$date1."' ";
                     }
        if(trim($searchdata['date_reg_from']) == 'old' && trim($searchdata['date_reg_to']) == 'new'){ 
                     $where_date_reg = "";
                     }                                                          
       
                        
            if(!isset($where_date_reg)){$where_date_reg='';} 
        //////============ ============//////   
         //////============ ============//////  
         if(trim($searchdata['last_visit_from']) !== 'old' && trim($searchdata['last_visit_to']) !== 'new'){ 
                     $date1 = trim($searchdata['last_visit_from']);
                     $date2 = trim($searchdata['last_visit_to']);
                     $where_last_visit = " AND DATE(`last_visit`) >= '".$date1."' AND DATE(`last_visit`) <= '".$date2."'  ";
                     }
        if(trim($searchdata['last_visit_from']) == 'old' && trim($searchdata['last_visit_to']) !== 'new'){ 
                     $date1 = trim($searchdata['last_visit_from']);
                     $date2 = trim($searchdata['last_visit_to']);
                     $where_last_visit = " AND DATE(`last_visit`) <= '".$date2."'  ";
                     }
        if(trim($searchdata['last_visit_from']) !== 'old' && trim($searchdata['last_visit_to']) == 'new'){ 
                     $date1 = trim($searchdata['last_visit_from']);
                     $date2 = trim($searchdata['last_visit_to']);
                     $where_last_visit = " AND DATE(`last_visit`)  >= '".$date1."' ";
                     }
        if(trim($searchdata['last_visit_from']) == 'old' && trim($searchdata['last_visit_to']) == 'new'){     
                     $where_last_visit = "";
                     }                                                          
                            
            if(!isset($where_last_visit)){$where_last_visit='';} 
            
        //////============ ============//////   
         //////============ ============//////  
        
        //////============ ============//////   

       //=================================              
        $where_find = '';

        if($searchdata['word'] !== '' && $searchdata['word'] !== 'nsw'){   
            $whereword = urldecode($searchdata['word'] );
       }else{$whereword = '';}

       
       $sort = 'ORDER BY `id` DESC';  
      
      if($this->session->userdata('sort_cust_result_adm')) {$sort_by = $this->session->userdata('sort_cust_result_adm');    
             $sort_by = " `".$sort_by['sort_name']."` ".$sort_by['sort_type'];    
             $sort = 'ORDER BY '.$sort_by;    
      } 
                
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM `customers_users`
            WHERE ( `name` LIKE '%".$whereword."%'
            OR `surname` LIKE '%".$whereword."%'
            OR `email` LIKE '%".$whereword."%'
            OR `contacts` LIKE '%".$whereword."%'
            OR `town` LIKE '%".$whereword."%'  
            OR `adres` LIKE '%".$whereword."%'  
            OR `phone` LIKE '%".$whereword."%'     
            OR `id`  = '".$whereword."'  
               )  
          
            $where_date_reg 
            $where_last_visit 
            
            $sort    
            $order  
         ";
       // echo $query; exit();
         $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
           
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
           // print_r( $data['total']); exit();
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
           
                   // $data['customers'][] = $row;
                   $data['customers'][] =array(
                     'id'      => $row['id'],
                     'email'   => $row['email'],
                     'name'   => $row['name'],
                     'surname'   => $row['surname'],
                     'byfather'   => $row['byfather'],
                     'nic'   => $row['nic'],
                     'gender'   => $row['gender'],
                     'birthday'   => $row['birthday'],
                     'u_region'   => $row['region'], 
                     'town'   => $row['town'],     
                     'u_adres'   => $row['adres'], 
                     'status'   => $row['status'],
                     'phone'   => $row['phone'],
                     'contacts'   => $row['contacts'],
                     'active'   => $row['active'],
                     'last_visit'   => $row['last_visit'],
                     'last_ip'   => $row['last_ip'], 
                     'date_reg'   => $row['date_reg'],
                     'autoreg'   => $row['autoreg'],
                     'total_sum_amount'   =>  $row['amount'],
                     'total_sum_discount'   =>  $row['discount'],
                     'count_of_referals' =>  $this -> count_my_this_referals($row['id']),
                     'my_actual_levels'   => $this -> load_my_actual_levels($row['id']) ,
                     'urik_edrpou'   => $row['urik_edrpou'] ,
                     'urik_name'   => $row['urik_name'] ,
                     'urik_vid_sobs'   => $row['urik_vid_sobs'] ,
                     'urik_ur_adres'   => $row['urik_ur_adres'] ,
                     'urik_nalog_sys'   => $row['urik_nalog_sys'] ,
                     'urik_yn'   => $row['urik_yn'] 
                     );
            }
        } 
     // echo "<pre>";     print_r( $data); exit(); 
        return $data;            
    } 
 //********************************************************** 
 //********************************************************** 
 function load_User_Online_Info_By_Id($id)  {                      
   
          $query = "
            SELECT `user_id`, `last_activity` 
            FROM `ci_sessions`
            WHERE  `user_id` = '".$id."'
         ";
          $dbres = $this->db->query($query);
        
         $data = array();
         if ($dbres->num_rows() >= 1) {
             
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
           
                     $data = $row;              
        }       
             
    }
   // echo "<pre>"; print_r($data);exit();  
     return $data;      
  }     
  //***************************************************
  
       
//************************************************************************************    
  //*********************************************************************************
    function addCustomerToList($data){
        
     
     
     $birthday = $data['birthday_year']."-".$data['birthday_month']."-".$data['birthday_day'];
     $data['town'] = '';
         
     $mysql_insert = "INSERT INTO `customers_users` (
     `email`,  
     `pass`,
     `surname`, 
     `name`, 
     `byfather`,  
     `birthday`,  
     `gender`,       
     `town`,
     `adres`,
     `adv_uid`,
     `postindex`,   
     `active`,     
     `date_reg`  
      ) 
         VALUES (
         ".db_quote($data['email'])." ,
         ".db_quote(base64_encode($data['newpass'])).",    
         ".db_quote($data['surname'])." ,
         ".db_quote($data['name'])." ,
         ".db_quote($data['byfather'])." ,
         ".db_quote($birthday)." ,
         ".db_quote($data['gender'])." ,   
         ".db_quote($data['town'])." ,
         ".db_quote($data['adres'])." ,
         ".db_quote($data['adv_uid'])." ,
         ".db_quote($data['postindex'])." ,   
         '1' ,
         now()
         )";
 
        $this->db->query($mysql_insert);
     return true;       
     }
      
//***************************************************************************
function delete_customer($id){
       $sql="DELETE FROM `customers_users` WHERE id='".$id."'";
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
                     'surname'   => $row['surname'],
                     'byfather'   => $row['byfather'],
                     'nic'   => $row['nic'],
                     'gender'   => $row['gender'],
                     'birthday'   => $row['birthday'],    
                     'town'   => $row['town'],
                     'u_adres'   => $row['adres'],
                     'postindex'   => $row['postindex'],  
                     'phone'   => $row['phone'],
                     'contacts'   => $row['contacts'],
                     'active'   => $row['active'],
                     'last_visit'   => $row['last_visit'],
                     'last_ip'   => $row['last_ip'], 
                     'date_reg'   => $row['date_reg'] ,
                     'urik_edrpou'   => $row['urik_edrpou'] ,
                     'urik_name'   => $row['urik_name'] ,
                     'urik_vid_sobs'   => $row['urik_vid_sobs'] ,
                     'urik_ur_adres'   => $row['urik_ur_adres'] ,
                     'urik_nalog_sys'   => $row['urik_nalog_sys'] ,
                     'urik_yn'   => $row['urik_yn'] 
                   ); 
                   
              }           
        }

         return $data;             
    }
//******************************************************************    
 
//************************************************************************       
   //**********************************************************
     function loadCustomerforedit($id)
    {
          $query = "   SELECT * FROM `customers_users` WHERE `id` =  ".$id." LIMIT 1  ";
         // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
             $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data[] = $row;
              /*$data[] =array(
                     'id'      => $row['id'],
                     'email'   => $row['email'],
                     'name'   => $row['name'],
                     'surname'   => $row['surname'],
                     'byfather'   => $row['byfather'], 
                     'gender'   => $row['gender'],
                     'birthday'   => $row['birthday'],    
                     'town'   => $row['town'],
                     'u_adres'   => $row['adres'],
                     'postindex'   => $row['postindex'],  
                     'status'   => $row['status'],
                     'phone'   => $row['phone'],
                     'contacts'   => $row['contacts'],
                     'active'   => $row['active'],
                     'date_reg'   => $row['date_reg']
                   ); */
              }    
        }
         return $data;             
    } 
   //*************************************************************************
   function edit_customer($data){
       
     //  echo "<pre>";
     //    print_r($data);exit();
       
         $id = $data['id_ed'];
         $birthday = $data['birthday_year']."-".$data['birthday_month']."-".$data['birthday_day'];
  
   // `gender` = ".db_quote($data['gender']).",
    $mysql_update = "UPDATE `customers_users` SET 
   `email` = ".db_quote($data['email']).", 
   `pass` = ".db_quote(base64_encode($data['newpass'])).", 
   `name` = ".db_quote($data['name']).",
   `surname` = ".db_quote($data['surname']).",
   `byfather` = ".db_quote($data['byfather']).",   
   `birthday` = ".db_quote($birthday).", 
   `country` = ".db_quote($data['country']).",
   `town` = ".db_quote($data['town']).",
   `adv_uid` = ".db_quote($data['adv_uid']).",
  
   `phone` = ".db_quote($data['phone']).",
   `adres` = ".db_quote($data['adres']).",
   `postindex` = ".db_quote($data['postindex']).",  
   `contacts` = ".db_quote($data['contacts'])."
    WHERE `id`= ".$id." 
            "; 
            /*
             `bank` = ".db_quote($data['bank']).",
               `bank_mfo` = ".db_quote($data['bank_mfo']).",
               `bank_okpo` = ".db_quote($data['bank_okpo']).",
               `bank_card` = ".db_quote($data['bank_card']).",
               */
      //   echo $mysql_update; exit();  
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    } 
 //*************************************************************************  
 //*************************************************************************
 //******************************************************************* 
//******************************************************************* 
 //************************************************************************    
  function loadTownNameForSearch ($term)              
    { 
    $term = trim($term);  
       $query = "
            SELECT `name` FROM `city`
            WHERE `name` LIKE '%".$term."%'
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
//*******************************************************************  
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
                  $data[] = $row;
              
              }    
        }
         return $data;             
    } 
   //************************************************************************* 
     //***************************************************
      function edit_levels_done($dataupdate){
           
       
          $levels = $dataupdate['levels'];
            
       // echo "<pre>";     print_r($dataupdate); exit();    
    
      foreach ($levels as $upd) :
 
     
    $mysql_update = "UPDATE `targets` SET 
   `menu_name-rus` = ".db_quote($upd['menu_name-rus']).",  
   `menu_name-ukr` = ".db_quote($upd['menu_name-ukr']).",  
   `menu_name-eng` = ".db_quote($upd['menu_name-eng']).",   
   `level` = ".db_quote($upd['level'])." ,
   `price_uah` = ".db_quote($upd['price_uah']).",
   `price_usd` = ".db_quote($upd['price_usd'])."
     WHERE `id`= ".$upd['id']." 
            "; 
            // `otkat2` = ".db_quote($upd['otkat2'])." 
         //   echo "<br>".$mysql_update;
            $this->db->query($mysql_update); 
            
          endforeach;  
         return $this->db->affected_rows(); 
     } 
     
 //*********************************************************************** 
 
//******************************************************************* 
    
//******************************************************************* 
//******************************************************************* 
//******************************************************************* 
}
?>