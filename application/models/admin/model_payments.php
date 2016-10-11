<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * predmets Model class
 * @author Ageev Alexey
 * @copyright  2014
 */

class model_payments extends CI_Model {
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
   function count_all_payments() 
   { 
   $sql = "SELECT COUNT(id) as `count` FROM `payments`";
    $query = $this->db->query($sql);
    $row = $query->result_array();
    return $row[0]['count'];
     
   } 
//**********************************************************************************************
  
//******************************************************************************************
  //**********************************************************  
function loadpaymentNameForSearch ($term)              
    { 
    $term = trim($term);  
       $query = "
            SELECT `name`, `surname`, `email` FROM `payments`
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
     function loadpayments($start_limit)
    {                      
       $order = "  LIMIT $start_limit, 20";   
        // query performing                
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM `payments`
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
                     'pay_done'   => $row['pay_done'],
                     'last_ip'   => $row['last_ip'],
                     'datetime_create'   => $row['datetime_create'],
                     'autoreg '   => $row['autoreg']
                   );            
            }
        }       
        return $data;             
    }
  //***************************************************
  //******************************************************************************************
 
     function Get_payments_All_for_filter($start_limit)
    {                      
       $order = "  LIMIT $start_limit, 20";   
        // query performing                
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM `payments`
            WHERE  1 
            ORDER BY `datetime_create` DESC
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
            $data['payments'][] =array(
                     'id'      => $row['id'],
                     'user_id'   => $row['user_id'],
                     'referal_id'   => $row['referal_id'],
                     'price'   => $row['price'],
                     'target'   => $row['target'],
                     'actual'   => $row['actual'],
                     'datetime_create'   => $row['datetime_create'],
                     'datetime_pay_done'   => $row['datetime_pay_done'],    
                     'pb_trans_id'   => $row['pb_trans_id'],
                     'pb_code'   => $row['pb_code'],
                     'pb_sender_phone'   => $row['pb_sender_phone'],  
                     'pb_pay_way'   => $row['pb_pay_way'],
                     'pb_status'   => $row['pb_status'],
                     'pay_status'   => $row['pay_status'],
                     'ip_payer'   => $row['ip_payer'],
                     'comment'   => $row['comment'], 
                     'datetime_create'   => $row['datetime_create'],
                     'user_info'  => $this->load_User_info_short_by_id( $row['user_id']), 
                     'referal_info'  => $this->load_User_info_short_by_id( $row['referal_id']) 
                   ); 
                  // 'total_sum_percents'   =>  $this -> Get_All_History_Sum($row['id']) 
                   /* 'id'      => $row['id'],
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
                     'pay_done'   => $row['pay_done'],
                     'last_ip'   => $row['last_ip'], 
                     'datetime_create'   => $row['datetime_create'],
                     'autoreg'   => $row['autoreg'],
                     'total_sum_amount'   =>  $row['amount'],
                     'total_sum_discount'   =>  $row['discount'] */      
            }
        }       
        return $data;             
    }
      //***************************************************  
   //************************************************************************************ 
      function Get_Filtered_payments($searchdata, $start_limit)  {                      
     
        $order = "  LIMIT $start_limit, 20";   
        
         //////============ ============//////  
         if(trim($searchdata['date_reg_from']) !== 'old' && trim($searchdata['date_reg_to']) !== 'new'){ 
             //strtotime($searchdata['start_date_from']);
                     $date1 = strtotime($searchdata['date_reg_from']);
                     $date2 = strtotime($searchdata['date_reg_to']);
                     $where_datetime_create = " AND `datetime_create` >= ".$date1." AND `datetime_create` <= ".$date2."  ";
                     }
        if(strtotime($searchdata['date_reg_from']) == 'old' && strtotime($searchdata['date_reg_to']) !== 'new'){ 
                     $date1 = strtotime($searchdata['date_reg_from']);
                     $date2 = strtotime($searchdata['date_reg_to']);
                     $where_datetime_create = " AND `datetime_create` <= ".$date2."  ";
                     }
        if(strtotime($searchdata['date_reg_from']) !== 'old' && strtotime($searchdata['date_reg_to']) == 'new'){ 
                     $date1 = strtotime($searchdata['date_reg_from']);
                     $date2 = strtotime($searchdata['date_reg_to']);
                     $where_datetime_create = " AND `datetime_create`  >= ".$date1." ";
                     }
        if(strtotime($searchdata['date_reg_from']) == 'old' && strtotime($searchdata['date_reg_to']) == 'new'){ 
                     $where_datetime_create = "";
                     }                                                          
       
                        
            if(!isset($where_datetime_create)){$where_datetime_create='';} 
        //////============ ============//////   
         //////============ ============//////  
         if(trim($searchdata['pay_done_from']) !== 'old' && trim($searchdata['pay_done_to']) !== 'new'){ 
                     $date1 = strtotime($searchdata['pay_done_from']);
                     $date2 = strtotime($searchdata['pay_done_to']);
                     $where_pay_done = " AND `pay_done` >= '".$date1."' AND `pay_done` <= '".$date2."'  ";
                     }
        if(trim($searchdata['pay_done_from']) == 'old' && trim($searchdata['pay_done_to']) !== 'new'){ 
                     $date1 = strtotime($searchdata['pay_done_from']);
                     $date2 = strtotime($searchdata['pay_done_to']);
                     $where_pay_done = " AND `pay_done` <= '".$date2."'  ";
                     }
        if(trim($searchdata['pay_done_from']) !== 'old' && trim($searchdata['pay_done_to']) == 'new'){ 
                     $date1 = strtotime($searchdata['pay_done_from']);
                     $date2 = strtotime($searchdata['pay_done_to']);
                     $where_pay_done = " AND `pay_done >= '".$date1."' ";
                     }
        if(trim($searchdata['pay_done_from']) == 'old' && trim($searchdata['pay_done_to']) == 'new'){     
                     $where_pay_done = "";
                     }                                                          
                            
            if(!isset($where_pay_done)){$where_pay_done='';} 
            
       //////============ ============//////   
       $where_target = '';
       if(isset($searchdata['target']) && $searchdata['target'] !== '' && $searchdata['target'] !== 'alltargets'){ 
             $where_target = " AND `payments`.`target` =  ".$searchdata['target']."  ";
       } 
       //////============ ============//////  
       $where_pb_status = '';
       if(isset($searchdata['pb_status']) && $searchdata['pb_status'] !== '' && $searchdata['pb_status'] !== 'all_pb_status'){ 
             $where_pb_status = " AND `payments`.`pb_status` =  '".$searchdata['pb_status']."'  ";
       } 
       //////============ ============//////   
       $where_payment_status = '';
       if(isset($searchdata['payment_status']) && $searchdata['payment_status'] !== '' && $searchdata['payment_status'] !== 'allpaystatuses'){ 
             $where_pb_status = " AND `payments`.`pay_status` =  ".$searchdata['payment_status']."  ";
       } 
       //=================================              
         
$whereword = '';
        if($searchdata['word'] != '' && $searchdata['word'] != 'nsw'){ 
            //$whereword = mb_st ("UTF-8", "windows-1251" , $searchdata['word']);
            $whereword = urldecode($searchdata['word'] );
       } 

       
       $sort = 'ORDER BY `id` DESC';  
      
      if($this->session->userdata('sort_paym_result_adm')) {$sort_by = $this->session->userdata('sort_paym_result_adm');    
             $sort_by = " `".$sort_by['sort_name']."` ".$sort_by['sort_type'];    
             $sort = 'ORDER BY '.$sort_by;    
      } 
       // `id` != 0         
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM `payments`
            WHERE 
            (   `pb_sender_phone` LIKE '%".$whereword."%'     
            OR `id`  = '".$whereword."'  
               )  
            $where_target
            $where_payment_status
            $where_pb_status
            $where_datetime_create 
            $where_pay_done 
            
            $sort    
            $order  
         ";
         // OR `email` LIKE '%".$whereword."%' 
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
          //                      
                   // $data['payments'][] = $row;
                   $data['payments'][] =array(
                     'id'      => $row['id'],
                     'user_id'   => $row['user_id'],
                     'referal_id'   => $row['referal_id'],
                     'price'   => $row['price'],
                     'target'   => $row['target'],
                     'actual'   => $row['actual'],
                     'datetime_create'   => $row['datetime_create'],
                     'datetime_pay_done'   => $row['datetime_pay_done'],    
                     'pb_trans_id'   => $row['pb_trans_id'],
                     'pb_code'   => $row['pb_code'],
                     'pb_sender_phone'   => $row['pb_sender_phone'],  
                     'pb_pay_way'   => $row['pb_pay_way'],
                     'pb_status'   => $row['pb_status'],
                     'pay_status'   => $row['pay_status'],
                     'ip_payer'   => $row['ip_payer'],
                     'comment'   => $row['comment'], 
                     'datetime_create'   => $row['datetime_create'],
                     'user_info'  => $this->load_User_info_short_by_id( $row['user_id']), 
                     'referal_info'  => $this->load_User_info_short_by_id( $row['referal_id']) 
                   ); 
                     
            }
        } 
     // echo "<pre>";     print_r( $data); exit(); 
        return $data;            
    } 
 //********************************************************** 
   //************************************************************************************ 
       
 //********************************************************** 
 
 function load_User_info_short_by_id($user_id)
    {
       
          $query = "
            SELECT * FROM `customers_users`
            WHERE `id` = ".$user_id." 
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
  //******************************************************************************************
 
     function Get_order_vivods_All_for_filter($start_limit)
    {                      
       $order = "  LIMIT $start_limit, 20";   
        // query performing                
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM `orders_vivod`
            WHERE  1 
            ORDER BY `datetime_create` DESC
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
            //$data['order_vivods'][] = $row;
            // id     user_id     referal_id     price     target     actual     datetime_create     datetime_pay_done     phone     email     inn     bank_name     bank_edrpou     bank_mfo     card_number     card_shet     pay_status      ip_payer     comment
                    $data['order_vivods'][] =array(
                     'id'      => $row['id'],
                     'user_id'   => $row['user_id'],
                     'referal_id'   => $row['referal_id'],
                     'price'   => $row['price'],
                     'target'   => $row['target'],
                     'from_level'   => $row['from_level'],
                     'actual'   => $row['actual'],
                     'datetime_create'   => $row['datetime_create'],
                     'datetime_update'   => $row['datetime_update'],
                     'datetime_pay_done'   => $row['datetime_pay_done'],  
                     'updated_by'   => $row['updated_by'],  
                     'adv_uid'   => $row['adv_uid'],  
                     'phone'   => $row['phone'],
                     'email'   => $row['email'],
                     'inn'   => $row['inn'],   
                     'ip_payer'   => $row['ip_payer'],
                     'pay_status'   => $row['pay_status'],
                     'comment'   => $row['comment'],   
                     'user_info'  => $this->load_User_info_short_by_id( $row['user_id']), 
                     'referal_info'  => $this->load_User_info_short_by_id( $row['referal_id']) 
                   ); 
                   // 'target_info'  => $this->load_User_info_short_by_id( $row['user_id']), 
                  // 'total_sum_percents'   =>  $this -> Get_All_History_Sum($row['id']) 
                   /* 'id'      => $row['id'],
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
                     'pay_done'   => $row['pay_done'],
                     'last_ip'   => $row['last_ip'], 
                     'datetime_create'   => $row['datetime_create'],
                     'autoreg'   => $row['autoreg'],
                     'total_sum_amount'   =>  $row['amount'],
                     'total_sum_discount'   =>  $row['discount'] */      
            }
        }       
        return $data;             
    }
      //***************************************************  
   //************************************************************************************ 
      function Get_Filtered_order_vivods($searchdata, $start_limit)  {                      
     
        $order = "  LIMIT $start_limit, 20";   
        
         //////============ ============//////  
         if(trim($searchdata['date_reg_from']) !== 'old' && trim($searchdata['date_reg_to']) !== 'new'){ 
             //strtotime($searchdata['start_date_from']);
                     $date1 = strtotime($searchdata['date_reg_from']);
                     $date2 = strtotime($searchdata['date_reg_to']);
                     $where_datetime_create = " AND `datetime_create` >= ".$date1." AND `datetime_create` <= ".$date2."  ";
                     }
        if(strtotime($searchdata['date_reg_from']) == 'old' && strtotime($searchdata['date_reg_to']) !== 'new'){ 
                     $date1 = strtotime($searchdata['date_reg_from']);
                     $date2 = strtotime($searchdata['date_reg_to']);
                     $where_datetime_create = " AND `datetime_create` <= ".$date2."  ";
                     }
        if(strtotime($searchdata['date_reg_from']) !== 'old' && strtotime($searchdata['date_reg_to']) == 'new'){ 
                     $date1 = strtotime($searchdata['date_reg_from']);
                     $date2 = strtotime($searchdata['date_reg_to']);
                     $where_datetime_create = " AND `datetime_create`  >= ".$date1." ";
                     }
        if(strtotime($searchdata['date_reg_from']) == 'old' && strtotime($searchdata['date_reg_to']) == 'new'){ 
                     $where_datetime_create = "";
                     }                                                          
       
                        
            if(!isset($where_datetime_create)){$where_datetime_create='';} 
        //////============ ============//////   
         //////============ ============//////  
         if(trim($searchdata['pay_done_from']) !== 'old' && trim($searchdata['pay_done_to']) !== 'new'){ 
                     $date1 = trim($searchdata['pay_done_from']);
                     $date2 = trim($searchdata['pay_done_to']);
                     $where_pay_done = " AND DATE(`pay_done`) >= '".$date1."' AND DATE(`pay_done`) <= '".$date2."'  ";
                     }
        if(trim($searchdata['pay_done_from']) == 'old' && trim($searchdata['pay_done_to']) !== 'new'){ 
                     $date1 = trim($searchdata['pay_done_from']);
                     $date2 = trim($searchdata['pay_done_to']);
                     $where_pay_done = " AND DATE(`pay_done`) <= '".$date2."'  ";
                     }
        if(trim($searchdata['pay_done_from']) !== 'old' && trim($searchdata['pay_done_to']) == 'new'){ 
                     $date1 = trim($searchdata['pay_done_from']);
                     $date2 = trim($searchdata['pay_done_to']);
                     $where_pay_done = " AND DATE(`pay_done`)  >= '".$date1."' ";
                     }
        if(trim($searchdata['pay_done_from']) == 'old' && trim($searchdata['pay_done_to']) == 'new'){     
                     $where_pay_done = "";
                     }                                                          
                            
            if(!isset($where_pay_done)){$where_pay_done='';} 
            
       //////============ ============//////   
       //////============ ============//////  
         //////============ ============//////   
       $where_target = '';
       if(isset($searchdata['target']) && $searchdata['target'] !== '' && $searchdata['target'] !== 'alltargets'){ 
             $where_target = " AND `orders_vivod`.`target` =  ".$searchdata['target']."  ";
       } 
       //////============ ============//////  
   
       //////============ ============//////   
       $where_payment_status = '';
       if(isset($searchdata['payment_status']) && $searchdata['payment_status'] !== '' && $searchdata['payment_status'] !== 'allpaystatuses'){ 
             $where_pb_status = " AND `orders_vivod`.`pay_status` =  ".$searchdata['payment_status']."  ";
       } 
       //=================================       
       //////============ ============//////   

       //=================================              
        $where_find = '';

        if($searchdata['word'] !== '' && $searchdata['word'] !== 'nsw'){ 
            //$whereword = mb_st ("UTF-8", "windows-1251" , $searchdata['word']);
            $whereword = urldecode($searchdata['word'] );
       }else{$whereword = '';}

       
       $sort = 'ORDER BY `id` DESC';  
      
      if($this->session->userdata('sort_paym_result_adm')) {$sort_by = $this->session->userdata('sort_paym_result_adm');    
             $sort_by = " `".$sort_by['sort_name']."` ".$sort_by['sort_type'];    
             $sort = 'ORDER BY '.$sort_by;    
      } 
                
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM `orders_vivod`
            WHERE (  `email` LIKE '%".$whereword."%' 
            OR `comment` LIKE '%".$whereword."%'     
            OR `id`  = '".$whereword."'  
               )  
          $where_target
          $where_payment_status
            $where_datetime_create 
            $where_pay_done 
            
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
           
                   // $data['order_vivods'][] = $row;
                   $data['order_vivods'][] =array(
                     'id'      => $row['id'],
                     'user_id'   => $row['user_id'],
                     'referal_id'   => $row['referal_id'],
                     'price'   => $row['price'],
                     'target'   => $row['target'],
                     'from_level'   => $row['from_level'],
                     'actual'   => $row['actual'],
                     'datetime_create'   => $row['datetime_create'],
                     'datetime_update'   => $row['datetime_update'],
                     'datetime_pay_done'   => $row['datetime_pay_done'],  
                     'updated_by'   => $row['updated_by'],  
                     'adv_uid'   => $row['adv_uid'],   
                     'phone'   => $row['phone'],
                     'email'   => $row['email'],
                     'inn'   => $row['inn'],  
                     
                     'ip_payer'   => $row['ip_payer'],
                     'pay_status'   => $row['pay_status'],
                     'comment'   => $row['comment'],   
                     'user_info'  => $this->load_User_info_short_by_id( $row['user_id']), 
                     'referal_info'  => $this->load_User_info_short_by_id( $row['referal_id']) 
                   ); 
                     
            }
        } 
     // echo "<pre>";     print_r( $data); exit(); 
        return $data;            
    } 
 //********************************************************** 
  //************************************************************************************ 
      function Get_Filtered_order_vivods_download($searchdata)  {                      
     
        
         //////============ ============//////  
         if(trim($searchdata['date_reg_from']) !== 'old' && trim($searchdata['date_reg_to']) !== 'new'){ 
             //strtotime($searchdata['start_date_from']);
                     $date1 = strtotime($searchdata['date_reg_from']);
                     $date2 = strtotime($searchdata['date_reg_to']);
                     $where_datetime_create = " AND `datetime_create` >= ".$date1." AND `datetime_create` <= ".$date2."  ";
                     }
        if(strtotime($searchdata['date_reg_from']) == 'old' && strtotime($searchdata['date_reg_to']) !== 'new'){ 
                     $date1 = strtotime($searchdata['date_reg_from']);
                     $date2 = strtotime($searchdata['date_reg_to']);
                     $where_datetime_create = " AND `datetime_create` <= ".$date2."  ";
                     }
        if(strtotime($searchdata['date_reg_from']) !== 'old' && strtotime($searchdata['date_reg_to']) == 'new'){ 
                     $date1 = strtotime($searchdata['date_reg_from']);
                     $date2 = strtotime($searchdata['date_reg_to']);
                     $where_datetime_create = " AND `datetime_create`  >= ".$date1." ";
                     }
        if(strtotime($searchdata['date_reg_from']) == 'old' && strtotime($searchdata['date_reg_to']) == 'new'){ 
                     $where_datetime_create = "";
                     }                                                          
       
                        
            if(!isset($where_datetime_create)){$where_datetime_create='';} 
        //////============ ============//////   
         //////============ ============//////  
         if(trim($searchdata['pay_done_from']) !== 'old' && trim($searchdata['pay_done_to']) !== 'new'){ 
                     $date1 = trim($searchdata['pay_done_from']);
                     $date2 = trim($searchdata['pay_done_to']);
                     $where_pay_done = " AND DATE(`pay_done`) >= '".$date1."' AND DATE(`pay_done`) <= '".$date2."'  ";
                     }
        if(trim($searchdata['pay_done_from']) == 'old' && trim($searchdata['pay_done_to']) !== 'new'){ 
                     $date1 = trim($searchdata['pay_done_from']);
                     $date2 = trim($searchdata['pay_done_to']);
                     $where_pay_done = " AND DATE(`pay_done`) <= '".$date2."'  ";
                     }
        if(trim($searchdata['pay_done_from']) !== 'old' && trim($searchdata['pay_done_to']) == 'new'){ 
                     $date1 = trim($searchdata['pay_done_from']);
                     $date2 = trim($searchdata['pay_done_to']);
                     $where_pay_done = " AND DATE(`pay_done`)  >= '".$date1."' ";
                     }
        if(trim($searchdata['pay_done_from']) == 'old' && trim($searchdata['pay_done_to']) == 'new'){     
                     $where_pay_done = "";
                     }                                                          
                            
            if(!isset($where_pay_done)){$where_pay_done='';} 
            
       //////============ ============//////   
       //////============ ============//////  
         //////============ ============//////   
       $where_target = '';
       if(isset($searchdata['target']) && $searchdata['target'] !== '' && $searchdata['target'] !== 'alltargets'){ 
             $where_target = " AND `orders_vivod`.`target` =  ".$searchdata['target']."  ";
       } 
       //////============ ============//////  
   
       //////============ ============//////   
       $where_payment_status = '';
       if(isset($searchdata['payment_status']) && $searchdata['payment_status'] !== '' && $searchdata['payment_status'] !== 'allpaystatuses'){ 
             $where_pb_status = " AND `orders_vivod`.`pay_status` =  ".$searchdata['payment_status']."  ";
       } 
       //=================================       
       //////============ ============//////   

       //=================================              
        $where_find = '';

        if($searchdata['word'] !== '' && $searchdata['word'] !== 'nsw'){ 
            //$whereword = mb_st ("UTF-8", "windows-1251" , $searchdata['word']);
            $whereword = urldecode($searchdata['word'] );
       }else{$whereword = '';}

       
       $sort = 'ORDER BY `id` DESC';  
      
      if($this->session->userdata('sort_paym_result_adm')) {$sort_by = $this->session->userdata('sort_paym_result_adm');    
             $sort_by = " `".$sort_by['sort_name']."` ".$sort_by['sort_type'];    
             $sort = 'ORDER BY '.$sort_by;    
      } 
                
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM `orders_vivod`
            WHERE (  `email` LIKE '%".$whereword."%' 
            OR `comment` LIKE '%".$whereword."%'     
            OR `id`  = '".$whereword."'  
               )  
          $where_target
          $where_payment_status
            $where_datetime_create 
            $where_pay_done 
            
            $sort     
         ";
       // echo $query; exit();
         $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
         
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
           
                   // $data['order_vivods'][] = $row;
                   $data['order_vivods'][] =array(
                     'id'      => $row['id'],
                     'user_id'   => $row['user_id'],
                     'referal_id'   => $row['referal_id'],
                     'price'   => $row['price'],
                     'target'   => $row['target'],
                     'from_level'   => $row['from_level'],
                     'actual'   => $row['actual'],
                     'datetime_create'   => $row['datetime_create'],
                     'datetime_update'   => $row['datetime_update'],
                     'datetime_pay_done'   => $row['datetime_pay_done'],  
                     'updated_by'   => $row['updated_by'],  
                     'adv_uid'   => $row['adv_uid'],  
                     'phone'   => $row['phone'],
                     'email'   => $row['email'],
                     'inn'   => $row['inn'],  
                      
                     'ip_payer'   => $row['ip_payer'],
                     'pay_status'   => $row['pay_status'],
                     'comment'   => $row['comment'],   
                     'user_info'  => $this->load_User_info_short_by_id( $row['user_id']), 
                     'referal_info'  => $this->load_User_info_short_by_id( $row['referal_id']) 
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
            WHERE  `user_id` =  ".$id." 
            LIMIT 1
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
    function z____addpaymentToList($data){
        
     
     
     $birthday = $data['birthday_year']."-".$data['birthday_month']."-".$data['birthday_day'];
     $data['town'] = '';
         
     $mysql_insert = "INSERT INTO `payments` (
     `email`,  
     `pass`,
     `surname`, 
     `name`, 
     `byfather`,  
     `birthday`,  
     `gender`,       
     `town`,
     `adres`,
     `postindex`,   
     `active`,
     `datetime_create`  
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
         ".db_quote($data['postindex'])." ,   
         '1' ,
         now()
         )";
 
        $this->db->query($mysql_insert);
     return true;       
     }
      
//***************************************************************************
function z____delete_payment($id){
       $sql="DELETE FROM `payments` WHERE id='".$id."'";
        if (!mysql_query($sql)) {
            return false;
        }
    
         return true;
    
    }
   //************************************************************************
   function loadpayment_one($id)
    {
          $query = "   SELECT * FROM `payments` WHERE `id` = '".$id."'  ";
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
                     'pay_done'   => $row['pay_done'],
                     'last_ip'   => $row['last_ip'], 
                     'datetime_create'   => $row['datetime_create'] 
                   ); 
                   
              }           
        }

         return $data;             
    }
//******************************************************************    
 
//************************************************************************       
   //**********************************************************
     function loadpaymentforedit($id)
    {
          $query = "   SELECT * FROM `payments` WHERE `id` =  ".$id." LIMIT 1  ";
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
                     'datetime_create'   => $row['datetime_create']
                   ); */
              }    
        }
         return $data;             
    } 
   //*************************************************************************
   function z____edit_payment($data){
       
     //  echo "<pre>";
     //    print_r($data);exit();
       
         $id = $data['id_ed'];
         $birthday = $data['birthday_year']."-".$data['birthday_month']."-".$data['birthday_day'];
  
  
     
       $town = $data['town'];  
         
    $mysql_update = "UPDATE `payments` SET 
   `email` = ".db_quote($data['email']).", 
   `pass` = ".db_quote(base64_encode($data['newpass'])).", 
   `name` = ".db_quote($data['name']).",
   `surname` = ".db_quote($data['surname']).",
   `byfather` = ".db_quote($data['byfather']).",
   `gender` = ".db_quote($data['gender']).",
   `birthday` = ".db_quote($birthday).", 
   `town` = ".db_quote($town).",
   `phone` = ".db_quote($data['phone']).",
   `adres` = ".db_quote($data['adres']).",
   `postindex` = ".db_quote($data['postindex']).",  
   `contacts` = ".db_quote($data['contacts'])."
    WHERE `id`= ".$id." 
            "; 
      //   echo $mysql_update; exit();  
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
    } 
 //*************************************************************************  
 //******************************************************************* 
function update_payment_status_by_admins($string)   {
    //  echo "===========<br><pre>"; print_r($string); exit();
     
   $time = time();
   $pay_status = '';
   
    // echo "<pre>"; print_r($string); exit();  
   if($string['status_p']=='success')  { $pay_status = " `pay_status` = 1, "; $email_user_sended = " `email_user_sended` = 1, ";  }    
   
         $mysql_update = "
           UPDATE `payments` SET  
          `pb_status` = '".$string['status_p']."', 
          `pb_trans_id` = '".$string['payment_id']."', 
           $pay_status
          `datetime_pay_done` = '".$time."' 
           WHERE `id`=  ".$string['order_id']." 
           LIMIT 1
           ";  
       //   echo $mysql_update; exit(); 
        $this->db->query($mysql_update);  
    
    $this->send_this_user_letter_by_pay($string['order_id']);
               
     return true;                 
                           
           
    }  
//******************************************************************* 
//******************************************************************* 
function set_hand_tranz($string)   {
  //  echo "===========<br><pre>"; print_r($string); exit();
     
   $time = time();
  
         $mysql_update = "
           UPDATE `payments` SET  
          `pb_status` = 'hand_tranz_done',  
          `pb_trans_id` = '".$string['tranz_id']."', 
          `pay_status` = '".$string['pay_status']."',
          `datetime_pay_done` = '".$time."' 
           WHERE `id`=  ".$string['id_item']." 
           LIMIT 1
           ";  
       //   echo $mysql_update; exit(); 
        $this->db->query($mysql_update);  
    
    $this->send_this_user_letter_by_pay($string['id_item']);
               
     return true;                 
                           
           
    }  
//******************************************************************* 
//*********************************************************************************
function send_this_user_letter_by_pay($order_id){
    
   $order = $this->load_Order_one_list_full_items_info($order_id);
   
 //  echo "<pre>";   print_r($order); exit();
 
    
    
$document = '  
     Ваша оплата за переход на этап '.$order['target'].' успешно принята. <br>  <br>   
';                                     
  //=-=-=-=-=-=-=-=-=-=-=-=-=-
      $to = $order['user_info']['email'];                                                                                                 
              $subject = "Статус оплаты";
            /*  $site_url = base_url();      
                          $search = array (
                             '#surname#',
                             '#name#',
                             '#id_order#',
                             '#target_name#',
                             '#all_sum_to_pay#',   
                             '#site_url#',
                             '#user_email#' ,
                             '#items#'
                             );
                          $replace = array (
                             $order[0]['surname'],
                             $order[0]['name'],
                             $order_id,
                             $target_name,
                             $order[0]['total_sum_to_pay'],
                             $site_url ,
                             $order[0]['email'] ,
                             $items
                             );
                      */          
                 
                               
                 //  $text = str_replace($search, $replace, $document); 
                //   echo $text; exit();           
                          $message = " 
                          <html><body><p>    
                          ".$document."        
                          ".lang('main_letter_sign')." 
                          </p></body></html>"; 
                  
                      $from = lang('main_user_order_shop_name');
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers= "MIME-Version: 1.0\r\n";                        
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <infobox@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <infobox@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf-8  \r\n"; 
                      // $headers .= "Content-type: text/html; charset=windows-1251  \r\n";  
                      // mail($to, $subject, $message, $headers);
             mail($to, $subject, $message, $headers);
             
  
            return true; 
          
}
    //*******************************************************************     
    //*********************************************************************************
function send_this_user_letter_by_komission($order_id){
    
   $order = $this->load_Vivod_one_list_full_items_info($order_id); // load_Vivod_one_list_full_items_info
   
 //  echo "<pre>";   print_r($order); exit();
 if($order['email_user_sended']!='0') { 
$document = '  
     Ваша комиссия этапа '.$order['target'].' успешно отправлена. <br>  <br>   
';                                     
  //=-=-=-=-=-=-=-=-=-=-=-=-=-
    
      $to = $order['user_info']['email'];                                                                                                 
              $subject = "Статус выплаты комиссии этапа ".$order['target']." ";
                
                          $message = " 
                          <html><body><p>    
                          ".$document."        
                          ".lang('main_letter_sign')." 
                          </p></body></html>"; 
                  
                      $from = lang('main_user_order_shop_name');
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers= "MIME-Version: 1.0\r\n";                        
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <infobox@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <infobox@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf-8  \r\n"; 
                     
       /*     if( mail($to, $subject, $message, $headers)) {
                
               $query1212 = " UPDATE `orders_vivod` SET `email_user_sended` = 1
                 WHERE `id`= ".$order_id."
                 LIMIT 1
        "; 
        $dbres = $this->db->query($query1212); 
                
            }*/
             
             
             
    }      
  
            return true; 
          
}
 //*******************************************************************   
 // load_Vivod_one_list_full_items_info  
 //*******************************************************************
    function load_Vivod_one_list_full_items_info($id)
    {
         // query performing
         // $this-> db-> query('SET NAMES utf8');   
        $query = " SELECT *
                 FROM `orders_vivod`
                 WHERE `id`= ".$id."
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
                     'id'      => $row['id'],
                     'user_id'   => $row['user_id'],
                     'referal_id'   => $row['referal_id'],
                     'email_user_sended'   => $row['email_user_sended'],
                     'price'   => $row['price'],
                     'target'   => $row['target'],
                     'actual'   => $row['actual'],
                     'datetime_create'   => $row['datetime_create'],
                     'datetime_pay_done'   => $row['datetime_pay_done'],   
                     'datetime_create'   => $row['datetime_create'],
                     'user_info'  => $this->load_User_info_short_by_id( $row['user_id'])
                   ); 
                  
            }
        }
       //echo "<pre>"; print_r($data); exit;
        return $data;             
    }                    
    //*******************************************************************
    //*******************************************************************
    function load_Order_one_list_full_items_info($id)
    {
         // query performing
         // $this-> db-> query('SET NAMES utf8');   
        $query = " SELECT *
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
                 //  $data[] = $row ; 
                  $data = array(
                     'id'      => $row['id'],
                     'user_id'   => $row['user_id'],
                     'referal_id'   => $row['referal_id'],
                     'price'   => $row['price'],
                     'target'   => $row['target'],
                     'actual'   => $row['actual'],
                     'datetime_create'   => $row['datetime_create'],
                     'datetime_pay_done'   => $row['datetime_pay_done'],    
                     'pb_trans_id'   => $row['pb_trans_id'],
                     'pb_code'   => $row['pb_code'],
                     'pb_sender_phone'   => $row['pb_sender_phone'],  
                     'pb_pay_way'   => $row['pb_pay_way'],
                     'pb_status'   => $row['pb_status'],
                     'pay_status'   => $row['pay_status'],
                     'ip_payer'   => $row['ip_payer'],
                     'comment'   => $row['comment'], 
                     'datetime_create'   => $row['datetime_create'],
                     'user_info'  => $this->load_User_info_short_by_id( $row['user_id'])
                   ); 
                  
            }
        }
       //echo "<pre>"; print_r($data); exit;
        return $data;             
    }                    
    //*******************************************************************
//******************************************************************* 
function do_komission_setstatus($id_order, $id_status)   {
    
   $time = time();
   $pay_status = '';
   $updated_by = $this->session->userdata('user_id'); 
 
         $mysql_update = "
           UPDATE `orders_vivod` SET   
          `pay_status` = '".$id_status."', 
          `datetime_update` = '".$time."' ,
          `updated_by` = '".$time."' 
           WHERE `id` = ".$id_order." 
           AND `datetime_update` = 0
           LIMIT 1
           ";  
       //   echo $mysql_update; exit(); 
        $this->db->query($mysql_update);  
                     
     return true;                 
                           
           
    }  
//******************************************************************* 
function do_komission_sended($id_order)   {
    
   $time = time();
   $pay_status = '';
 
         $mysql_update = "
           UPDATE `orders_vivod` SET   
            `pay_status` = 1, 
          `datetime_pay_done` = '".$time."' 
           WHERE `id` = ".$id_order." 
           LIMIT 1
           ";  
       //   echo $mysql_update; exit(); 
        $this->db->query($mysql_update);  
        
        
 $this->send_this_user_letter_by_komission($id_order); // send_this_user_letter_by_komission
    
    
 
     // $order_id = $payment['order_id'];               
     return true;                 
                           
           
    }  
//*******************************************************************  
//******************************************************************* 
function do_pay_cash_received($id_order)   {
    
   $time = time();
   $pay_status = '';
 
         $mysql_update = "
           UPDATE `payments` SET   
           `pay_status` = 1, 
           `cash` = 1
          `datetime_pay_done` = '".$time."' 
           WHERE `id` = ".$id_order." 
           LIMIT 1
           ";  
       //   echo $mysql_update; exit(); 
        $this->db->query($mysql_update);  
    
    
 
     // $order_id = $payment['order_id'];               
     return true;                 
                           
           
    }  
//*******************************************************************    
 function load_List_targets()    {
        // query performing 
        $query = "
            SELECT `id`, `menu_name-rus`, `price`, `otkat`  FROM `targets`
            WHERE 1
            ORDER BY `id` ASC
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query); 
        $data = array();
       if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 // $data[] = $row ; 
                 $data[] =array(
                     'id'      => $row['id'],
                     'menu_name'   => $row['menu_name-rus'] ,
                     'price'   => $row['price'] ,
                     'otkat'   => $row['otkat']  
                   ); 
             }
        }
         return $data;             
    } 
 //*************************************************************************
 
 // check_ready_receipts
  //************************************************************************************    
   function check_ready_receipts () {
       
   include_once("resources/LiqPay.php") ;           
 
    $public_key = 'i30240804689';   
    $private_key="mqNjO4eQBYDTS7ymcNPqMMfgVNouc1NjXVIEWj4Y";    
    
    $url="https://liqpay.com/?do=clickNbuy";
 
 ///===================================================
 
$query = "
            SELECT * 
            FROM `payments`
            WHERE `pay_status` = 0
            AND `datetime_create` > UNIX_TIMESTAMP() - 24*60*60*3 
         ";
        //  > NOW() - INTERVAL 72 HOUR 
        //  >= DATE_SUB(NOW(), INTERVAL 3 DAY)
         
      //  echo $query; exit();
         $dbres = $this->db->query($query);
         $payments = array();
         if ($dbres->num_rows() >= 1) {
         
            $rows = $dbres->result_array();
            
             foreach ($rows as $row) {
          //                      
                   // $data['payments'][] = $row;
                   $payments[] =array(
                     'id'      => $row['id'],
                     'user_id'   => $row['user_id'],
                     'referal_id'   => $row['referal_id'],
                     'price'   => $row['price'],
                     'target'   => $row['target'],
                     'actual'   => $row['actual'],
                     'datetime_create'   => $row['datetime_create'],
                     'datetime_pay_done'   => $row['datetime_pay_done'],    
                     'pb_trans_id'   => $row['pb_trans_id'],
                     'pb_code'   => $row['pb_code'],
                     'pb_sender_phone'   => $row['pb_sender_phone'],  
                     'pb_pay_way'   => $row['pb_pay_way'],
                     'pb_status'   => $row['pb_status'],
                     'pay_status'   => $row['pay_status'],
                     'ip_payer'   => $row['ip_payer'],
                     'comment'   => $row['comment'], 
                     'datetime_create'   => $row['datetime_create'] 
                     
                   ); 
                   // 'user_info'  => $this->load_User_info_short_by_id( $row['user_id']), 
                   // 'referal_info'  => $this->load_User_info_short_by_id( $row['referal_id']) 
                   
             }
         }
///============================================
      
   if(!empty($payments)) { 
   foreach($payments as $pay_info){  
       
 $liqpay = new LiqPay($public_key, $private_key);
 $res = $liqpay->api("payment/status", array(
  'version'       => '3',
  'order_id'      => 'ORDER_'.$pay_info['id']
 )); 

if($res->result=='error') {
     $data['status'] = 0;  
     $data['description'] = $res->description;
     $data['message'] = 'Такого платежа в банке не обнаружено или произошла другая ошибка с банком'; 
} else {
 //$order_id = ltrim("ORDER_", $res->order_id)  ;
 
    $data = array(); 
    $data['result'] = $res->result;  
    $data['payment_id'] = $res->payment_id; 
    $data['status_p'] = $res->status; 
    $data['amount'] = $res->amount; 
    $data['currency'] = $res->currency;  
    $data['order_id'] = $pay_info['id']; 
    $data['liqpay_order_id'] = $res->liqpay_order_id; 
    $data['description'] = $res->description; 
    $data['date_done'] = date("Y-m-d");

//===== 
   
 $this->update_payment_status_by_admins($data);
 
}

   } /// foreach($payments as $pay_info)
   } ///if(!empty($payments)) {   
//=====            


  return true;     
     }    
 //******************************************************************* 
  //************************************************************************************    
   function check_ready_receipts_all () {
       
   include_once("resources/LiqPay.php") ;           
 
    $public_key = 'i30240804689';   
    $private_key="mqNjO4eQBYDTS7ymcNPqMMfgVNouc1NjXVIEWj4Y";    
    
    $url="https://liqpay.com/?do=clickNbuy";
 
 ///===================================================
 // hand_tranz_done
$query = "
            SELECT * 
            FROM `payments`
            WHERE `pb_status` != 'hand_tranz_done'
            AND `datetime_create` > UNIX_TIMESTAMP() - 24*60*60*3 
         ";
        //  > NOW() - INTERVAL 72 HOUR 
        //  >= DATE_SUB(NOW(), INTERVAL 3 DAY)
         
      //  echo $query; exit();
         $dbres = $this->db->query($query);
         $payments = array();
         if ($dbres->num_rows() >= 1) {
         
            $rows = $dbres->result_array();
            
             foreach ($rows as $row) {
          //                      
                   // $data['payments'][] = $row;
                   $payments[] =array(
                     'id'      => $row['id'],
                     'user_id'   => $row['user_id'],
                     'referal_id'   => $row['referal_id'],
                     'price'   => $row['price'],
                     'target'   => $row['target'],
                     'actual'   => $row['actual'],
                     'datetime_create'   => $row['datetime_create'],
                     'datetime_pay_done'   => $row['datetime_pay_done'],    
                     'pb_trans_id'   => $row['pb_trans_id'],
                     'pb_code'   => $row['pb_code'],
                     'pb_sender_phone'   => $row['pb_sender_phone'],  
                     'pb_pay_way'   => $row['pb_pay_way'],
                     'pb_status'   => $row['pb_status'],
                     'pay_status'   => $row['pay_status'],
                     'ip_payer'   => $row['ip_payer'],
                     'comment'   => $row['comment'], 
                     'datetime_create'   => $row['datetime_create'] 
                     
                   ); 
                   // 'user_info'  => $this->load_User_info_short_by_id( $row['user_id']), 
                   // 'referal_info'  => $this->load_User_info_short_by_id( $row['referal_id']) 
                   
             }
         }
///============================================
      
   if(!empty($payments)) { 
   foreach($payments as $pay_info){  
       
 $liqpay = new LiqPay($public_key, $private_key);
 $res = $liqpay->api("payment/status", array(
  'version'       => '3',
  'order_id'      => 'ORDER_'.$pay_info['id']
 )); 

if($res->result=='error') {
     $data['status'] = 0;  
     $data['description'] = $res->description;
     $data['message'] = 'Такого платежа в банке не обнаружено или произошла другая ошибка с банком'; 
     echo $pay_info['id']. " в банке не обнаружено <br>";
} else {
 //$order_id = ltrim("ORDER_", $res->order_id)  ;
 
    $data = array(); 
    $data['result'] = $res->result;  
    $data['payment_id'] = $res->payment_id; 
    $data['status_p'] = $res->status; 
    $data['amount'] = $res->amount; 
    $data['currency'] = $res->currency;  
    $data['order_id'] = $pay_info['id']; 
    $data['liqpay_order_id'] = $res->liqpay_order_id; 
    $data['description'] = $res->description; 
    $data['date_done'] = date("Y-m-d");
    
    echo $pay_info['id']. " в банке # ".$data['payment_id'].", статус ".$data['status_p']." <br>";

//===== 
   
 $this->update_payment_status_by_admins($data);
 
}

   } /// foreach($payments as $pay_info)
   } ///if(!empty($payments)) {   
//=====            


  return true;     
     }    
 //******************************************************************* 
   function u_load_my_payin_by_user()
    {
        $user_id = $this->session->userdata('user_id');        
        $query = " SELECT SQL_CALC_FOUND_ROWS `pay`.*,
                 `p_sync`.`ac_transfer` as `transfer_id`,
                 `p_sync`.`ac_transaction_status` as `transaction_status`,
                 `p_sync`.`ac_merchant_currency` as `ac_merchant_currency`
                 FROM `payments` `pay`
                 LEFT JOIN `pay_sync` `p_sync` ON `p_sync`.`order_id` = `pay`. `id`
                 WHERE `pay`.`user_id`= ".$user_id." 
                 ORDER BY `pay`.`id` DESC
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
                 //  $data[] = $row ; 
                  $data['list'][] = array(
                     'id'      => $row['id'], 
                     'price'   => $row['price'],
                     'target'   => $row['target'], 
                     'datetime_create'   => $row['datetime_create'],
                     'datetime_pay_done'   => $row['datetime_pay_done'],    
                     'transfer_id'   => $row['transfer_id'], 
                     'transaction_status'   => $row['transaction_status'], 
                     'ac_merchant_currency'   => $row['ac_merchant_currency'], 
                     'pb_status'   => $row['pb_status'],
                     'pay_status'   => $row['pay_status'],
                     'ip_payer'   => $row['ip_payer'],
                     'comment'   => $row['comment'] 
                   ); 
                  
            }
        }
       //echo "<pre>"; print_r($data); exit;
        return $data;             
    }                 
 //******************************************************************* 
 
   function u_load_payout_by_user()
    {
        $user_id = $this->session->userdata('user_id');        
        $query = " SELECT SQL_CALC_FOUND_ROWS `vivod`.* 
                 FROM `orders_vivod` `vivod` 
                 WHERE `vivod`.`user_id`= ".$user_id." 
                 ORDER BY `vivod`.`id` DESC
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
                 //  $data[] = $row ; 
                  $data['list'][] = array(
                     'id'      => $row['id'], 
                     'price'   => $row['price'],
                     'target'   => $row['target'], 
                     'datetime_create'   => $row['datetime_create'],
                     'datetime_pay_done'   => $row['datetime_pay_done'],     
                     'pay_status'   => $row['pay_status'],
                     'ip_payer'   => $row['ip_payer'],
                     'comment'   => $row['comment'] 
                   ); 
                  
            }
        }
       //echo "<pre>"; print_r($data); exit;
        return $data;             
    }                 
 //************************************************************************    
 
//************************************************************************************   
//*******************************************************************  
 
//******************************************************************* 
    
//******************************************************************* 
//******************************************************************* 
//******************************************************************* 
}
?>