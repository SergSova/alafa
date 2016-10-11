<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *   Model class
 * @author Ageev Alexey
 * @copyright  2012
 */

class model_bills extends CI_Model {
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
 function load_Order_satuses()   {
        // query performing 
        $query = "
            SELECT * FROM `oreders_statuses`
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
                     'name'   => $row['name-rus']
                   ); 
             }
        }
         return $data;             
    }   
    //*******************************************************************
function Get_Orders_All_New()  {

       
        // query performing
        $query = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM `orders_base`
            WHERE `order_status`  NOT IN (4,5)
            ORDER BY `id` DESC
          
         ";

        $dbres = $this->db->query($query);
      $data = array();
         if ($dbres->num_rows() >= 1) {

            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];

            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                $data['orders'][] = $row;
                    /* $data['orders'][] = array(
                     'id'                 => $row['id'],
                     'date'               => $row['date_order'],
                     'name'               => $row['name'],
                     'surname'            => $row['surname'],  
                     'id_user'            => $row['id_user'],
                     'user_group'         =>  $row['user_group'],
                     'total_sum'          => $row['total_sum'], 
                     'total_sum_to_pay'   => $row['total_sum_to_pay'], 
                     'email'              => $row['email'],
                     'payment_type'       => $row['payment_type'],
                     'privatbank_status'    => $row['privatbank_status'],
                     'privatbank_transaction_id'    => $row['privatbank_transaction_id'],
                     'privatbank_sender_phone'    => $row['privatbank_sender_phone'],
                     'privatbank_pay_way'    => $row['privatbank_pay_way'],
                     'payment_method'     => $row['payment_method'], 
                     'payment_status'     => $row['payment_status'],  
                     'order_status'       => $row['order_status']
                   );   */           
            }
        }
        return $data;
    } 
//********************************************************************************
    //*******************************************************************
function Get_Orders_All_Archive()  {

       
        // query performing
        $query = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM `orders_base`
            WHERE `order_status` IN (4,5)
            ORDER BY `id` DESC
          
         ";

        $dbres = $this->db->query($query);
      $data = array();
         if ($dbres->num_rows() >= 1) {

            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];

            $rows = $dbres->result_array();
            foreach ($rows as $row) {
$data['orders'][] = $row;
                    /* $data['orders'][] =array(
                     'id'                 => $row['id'],
                     'date'                => $row['date_order'],
                     'name'               => $row['name'],
                     'surname'              => $row['surname'],  
                     'id_user'              => $row['id_user'],
                     'user_group'          =>  $row['user_group'],
                     'total_sum'          => $row['total_sum'],
                     'email'              => $row['email'],
                     'payment_type'          => $row['payment_type'],
                     'privatbank_status'    => $row['privatbank_status'],
                     'privatbank_transaction_id'    => $row['privatbank_transaction_id'],
                     'privatbank_sender_phone'    => $row['privatbank_sender_phone'],
                     'privatbank_pay_way'    => $row['privatbank_pay_way'],
                     'payment_method'          => $row['payment_method'], 
                     'payment_status'          => $row['payment_status'],  
                     'order_status'          => $row['order_status']
                   );   
                   */          //'count'    => $this->count_same_specs($row['id']),
                                  // 'pic'    => $this->loadThumbsToAlbum($row['id'])
            }
        }
        return $data;
    } 
//********************************************************************************
function update_order_status($id_user, $order_id, $order_status)   {
         // query performing 
    
    
    
         
         $mysql_update = "
           UPDATE `orders_base` SET 
          `order_status` = $order_status 
           WHERE `id`=  ".$order_id."
            "; 
       //   echo $mysql_update; exit(); 
        $this->db->query($mysql_update);  
        $query = "
            SELECT `id`, `email` FROM `customers_users`
            WHERE `id`=  ".$id_user." 
         "; 
          $dbres = $this->db->query($query);
         $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data = $row ;
             }
        }
      ///////
         
    }  
//*******************************************************************
function delete_order_fn($id){
    
      $offers_return =  $this->update_order_items_quantity($id);
      $this->update_offer_quantity($offers_return);
      
  //    echo "<pre>"; print_r($offers_return);exit();    
       $sql="DELETE FROM `orders_base` WHERE id=$id";
        if (!mysql_query($sql)) {
            return false;
        }
        return true;
    } 
    
//*******************************************************************  
  //**********************************************************  
function edit_order_one($data){
     
                     
    
    
         $id = $data['id_ed'];
        $mysql_update = "UPDATE `orders_base` SET           
                     `name`       = '".$data['name']."',    
                     `surname`     = '".$data['surname']."',    
                     `byfather`      = '".$data['byfather']."',    
                     `country`       = '".$data['country']."',    
                     `town`        = '".$data['town']."',   
                     `email`      = '".$data['email']."',    
                     `phone`      = '".$data['phone']."',     
                     `note`      = '".$data['note']."',    
                     `tour`     = '".$data['tour']."',    
                     `tour_date`     = '".$data['tour_date']."',    
                     `equipment`    = '".$data['equipment']."',    
                     `size`     = '".$data['size']."'         
        
          WHERE `id`=$id
            "; 
            //`delivery_service`    = '".$data['delivery_service']."', 
            // `delivery_sklad`     = '".$data['delivery_sklad']."',  
            
       //   echo $mysql_update; exit();    
        $res = $this->db->query($mysql_update);
        return $this->db->affected_rows();   
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
                     'u_region'   => $this -> loadRegionName($row['region']), //
                     'u_town'   => $this -> loadTownName($row['town']),
                     'u_adres'   => $row['adres'],
                     'postindex'   => $row['postindex'], 
                     'status'   => $this ->loadStatus_Info( $row['status']),
                     'phone'   => $row['phone'],
                     'contacts'   => $row['contacts'],
                     'active'   => $row['active'],
                     'date_reg'   => $row['date_reg']
                   ); 
              }
        }

         return $data;             
    }
//******************************************************************    
function loadStatus_Info($id)   {
          $query = "
            SELECT *
               FROM `oreders_statuses`
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
//************************************************************************       
  function load_Order_List($id)
    {
        
         // $this-> db-> query('SET NAMES utf8');   
        $query = " SELECT *
                 FROM `orders_base`
                 WHERE `id`= $id
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
                     'id_user'      => $row['id_user'], 
                     'date_order'   => $row['date_order'],
                     'name'         => $row['name'],
                     'surname'     => $row['surname'],
                     'byfather'      => $row['byfather'],
                     'region'      => $row['region'],
                     'town'        => $row['town'],
                     'adres'       => $row['adres'],
                     'postindex'      => $row['postindex'],
                     'email'      => $row['email'],
                     'phone'      => $row['phone'],
                     'contacts'      => $row['contacts'],
                     'note'      => $row['note'],
                     'total_sum'    => $row['total_sum'],
                     'total_sum_to_pay'    => $row['total_sum_to_pay'],
                     'cdp_discont_percent'    => $row['cdp_discont_percent'],
                     'cdp_skidka'    => $row['cdp_skidka'],
                     'user_group'    => $row['user_group'],
                     'delivery_to'    => $row['delivery_to'],
                     'delivery_method'    => $row['delivery_method'],
                     'delivery_service'    =>   $row['delivery_service'],
                     'delivery_sklad'    => $row['delivery_sklad'],
                     'delivery_cost'    => $row['delivery_cost'],
                     'bank'              => $this->load_bank_fl($row['bank_id']),
                     'payment_type'    => $row['payment_type'],
                     'privatbank_status'    => $row['privatbank_status'],
                     'privatbank_transaction_id'    => $row['privatbank_transaction_id'],
                     'privatbank_sender_phone'    => $row['privatbank_sender_phone'],
                     'privatbank_pay_way'    => $row['privatbank_pay_way'],
                     'payment_method'    => $row['payment_method'],
                     'order_items'    => $this->load_Order_Items( $row['id'])
                   ); 
                   //$this->load_Delivery_Service_one(
                  // '#privatbank_status#',  
                  //           '#privatbank_transaction_id#',
                  //           '#privatbank_sender_phone#',
                  //           '#privatbank_pay_way#',      
            }
        }
       // print_r($data); exit;
        return $data;             
    }                                                                       
  //************************************************************************************
  function load_Order_Items($id_order)   {
          $query = "
            SELECT *
               FROM `orders_items`
            WHERE `id_order` = '".$id_order."'
        ";
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
  //************************************************************************************
  function load_Order_one($id)
    {
         // query performing
         // $this-> db-> query('SET NAMES utf8');   
        $query = " SELECT *
                 FROM `orders_base`
                 WHERE `id`= $id
                 LIMIT 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 $data[] = $row ; 
                
            }
        }
       // print_r($data); exit;
        return $data;             
    }                    
    //*******************************************************************
    
//************************************************************************************ 
function load_tours()    {
        // query performing 
        $query = "
            SELECT * FROM `goods_info`
            WHERE `buggy` = 1
            AND `visible` = 1
             ORDER BY `number`
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
                     'menu_name'      => $row['menu_name-rus']
                      );    
             }
        }
         return $data;             
    } 
    //*********************************************************************
    function Delete_offer_Item_From_Cart($order_id, $offer_id){
    
         $query = "
            SELECT `model_id`, `model_quantity`
            FROM `orders_items`
            WHERE `id_order` = '".$order_id."'
            AND   `model_id` = '".$offer_id."'
          ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data_upd = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data_upd = $row;
             }
        }
        $this->update_offer_quantity_one($data_upd);
        
        $sql="DELETE FROM `orders_items` 
        WHERE `model_id` = '".$offer_id."'
        AND `id_order` = '".$order_id."' ";
        if (!mysql_query($sql)) {
            return false;
        }
      ////////////////////  
        
      ///////////////////  
        return true;
    }
  //******************************************************************* 
      
//*******************************************************************
function update_offer_quantity_one($offers_return)   {
    //  echo "<pre>"; print_r($offers_return);exit();           
      
     $quantity = $offers_return['model_quantity'];
        $mysql_update = "
           UPDATE `goods_info` SET 
           quantity = quantity + $quantity   
           WHERE `id`=  ".$offers_return['model_id']."
            "; 
        //    echo $mysql_update."<br>";                           
      $this->db->query($mysql_update); 
     
   //  exit();
    return true;    
    } 
//*******************************************************************       
 //*******************************************************************       
 //*******************************************************************       
 //*******************************************************************       
 //*******************************************************************                  
  //***************************************************  
      function Get_Filtered_offers_for_add_cart($searchdata)  {                      
     
      
        // query performing        
          if($searchdata['category'] !== '' && $searchdata['category'] !== 'all'){ 
             $wherecategory = " AND `parent_category` = '".$searchdata['category']."' ";
       }else{$wherecategory = '';}
      /*  if($searchdata['catalog'] !== '' && $searchdata['catalog'] !== 'all'){ 
             $wherecatalog = " AND `parent_catalog` = '".$searchdata['catalog']."' ";
       }else{$wherecatalog = '';} */
        if($searchdata['word'] !== '' && $searchdata['word'] !== 'nsw'){ 
             $whereword = $searchdata['word'];
       }else{$whereword = '';}
        
        
                
        $query = "
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM `goods_info`
            WHERE ( `menu_name-rus` LIKE '%".$whereword."%'
            OR `h1-rus` LIKE '%".$whereword."%'
            OR `articul` LIKE '%".$whereword."%')
            $wherecategory      
            AND `price` != ''    
            ORDER BY `menu_name-rus` ASC
           
         ";
         //  $wherecatalog  
        // AND `quantity` != 0
        //    AND `quantity` != ''  
        // echo $query; exit();
        //  
         $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
           
            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];
           // print_r( $data['total']); exit();
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
           
                     $data['offerslist'][] =array(
                     'id'                 => $row['id'],     
                     'brand'              => $row['brand'], 
                     'articul'            => $row['articul'],
                     'menu_name'          => $row['menu_name-rus'], 
                     'cost'               => $row['cost'],
                     'price'              => $row['price'],
                     'wholesale'          => $row['wholesale'], 
                     'wholesale_qty'      => $row['wholesale_qty'],  
                     'quantity'           => $row['quantity'],
                     'formula'            => $row['formula'],
                     'new_good'           => $row['new_good'],
                     'hit'                => $row['hit'],
                     'show'               => $row['show'],  
                     'promotional'        => $row['promotional'],
                     'promotional_price'  => $row['promotional_price'], 
                     'parent_category'    => $row['parent_category'], 
                     'number'             => $row['number'],
                     'visible'            => $row['visible'] 
                   );             
            }
        } 
       //  echo "<pre>";
       //     print_r( $data); exit(); 
        return $data;            
    } 
 //**********************************************************  
 function Get_Prod_Info_For_Add_Cart($id_offer)  {                      
   
        // query performing                
        $query = "
            SELECT  * 
            FROM `goods_info`
            WHERE  `id` = '".$id_offer."' 
           ";
     
        $dbres = $this->db->query($query);
      $data = array();
         if ($dbres->num_rows() >= 1) {
           $rows = $dbres->result_array();
            foreach ($rows as $row) {
           
                     $data = array(
                     'articul'            => $row['articul'],
                     'id'                 => $row['id'],          
                     'menu_name'          => $row['menu_name-rus'], 
                     'price'              => $row['price'],
                     'promotional'        => $row['promotional'],
                     'promotional_price'  => $row['promotional_price'],
                     'quantity'           => $row['quantity']
                   );              
        }       
             
    }
     return $data;      
  }
  //**********************************************************  
 function Add_offer_Item_To_Cart($order_id, $id_offer)  {                      
   //////////
     
    $quantity = 1;
        $mysql_update = "
           UPDATE `goods_info` SET 
           quantity = quantity - $quantity   
           WHERE `id`=  ".$id_offer."
            "; 
        //    echo $mysql_update."<br>";                           
      $this->db->query($mysql_update);  
     
   ////////////  
   $percent_pdp = $this->load_Discont_data_for_order($order_id);
   //echo $percent_pdp; exit(); 
        // query performing                
        $query = "
            SELECT  * 
            FROM `goods_info`
            WHERE  `id` = '".$id_offer."' 
           ";
     
        $dbres = $this->db->query($query);
      $sp = array();
         if ($dbres->num_rows() >= 1) {
           $rows = $dbres->result_array();
            foreach ($rows as $row) {
           
                     $sp = array(
                     'model_articul'      => $row['articul'],
                     'model_id'           => $row['id'],
                     'parent_offer'     => $row['id'],         
                     'model_name'         => $row['menu_name-rus'], 
                     'model_price'        => $row['price'],
                     'promotional'        => $row['promotional'],
                     'promotional_price'  => $row['promotional_price'],
                     'quantity'           => $row['quantity']
                   );              
        }       
             
    }
 if($percent_pdp!='0' && $sp['promotional']!='1'){
 $count_percent = 1- ($percent_pdp/100);
 $sp['model_price'] = $sp['model_price']*$count_percent; 
 }
 if($sp['promotional']=='1'){ $sp['model_price'] = $sp['promotional_price'] ; }
 $sp['model_parent'] = $sp['model_id'] ;
 
 $sp['model_quantity'] = 1 ;
   
     $mysql_insert_item = "INSERT INTO `orders_items` (
           `id_order`,
           `model_articul`,
           `model_name`,
           `model_price`,
           `model_quantity`,
           `model_id`,      
           `model_parent`,
           `model_promo`
            )
               VALUES (
               ".db_quote($order_id)." ,
               ".db_quote($sp['model_articul'])." ,
               ".db_quote($sp['model_name'])." ,
               ".db_quote($sp['model_price'])." ,
               ".db_quote($sp['model_quantity'])." ,
               ".db_quote($sp['model_id'])." ,    
               ".db_quote($sp['model_parent']).",
               ".db_quote($sp['promotional'])."
               )";
        //   echo $mysql_insert;
              $this->db->query($mysql_insert_item); 
    
     return $this->db->affected_rows();        
  }                                          
  //***************************************************                                          
  //***************************************************
   //***************************************************
      function Update_offer_Item_From_Cart($dataupdate){
         // $dataupdate = $dataupdate['cart'];
        //   echo "<pre>";
        //     print_r($dataupdate); exit();
    
      foreach ($dataupdate['cart'] as $upd) :                                  
         $mysql_update = "UPDATE `orders_items` SET  
         `model_quantity` = ".db_quote($upd['quantity'])."
           WHERE `model_id`='".$upd['model_id']."'
           AND `id_order` = '".$dataupdate['order_id']."' 
            "; 
            $this->db->query($mysql_update);
        
            
          endforeach;  
         return $this->db->affected_rows(); 
     } 
     
  //***************************************************  
function Generate_New_Order($data){
     // echo "  <br><pre>";
     //  print_r($data); exit();
   $order_id = $data['order_id'];
        $query = " SELECT *
                 FROM `orders_base`
                 WHERE `id`= $order_id
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $DataOldOrder = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 //  $data[] = $row ; 
                  $DataOldOrder = array(
                     'id'        => $row['id'],
                     'id_user'      => $row['id_user'], 
                     'date_order'   => $row['date_order'],
                     'name'         => $row['name'],
                     'surname'     => $row['surname'],
                     'byfather'      => $row['byfather'],
                     'town'        => $row['town'],
                     'adres'       => $row['adres'],
                     'postindex'      => $row['postindex'],
                     'email'      => $row['email'],
                     'phone'      => $row['phone'],
                     'contacts'      => $row['contacts'],
                     'note'      => $row['note'],
                     'total_sum'    => $row['total_sum'],
                     'total_sum_to_pay'    => $row['total_sum_to_pay'],
                     'cdp_discont_percent'    => $row['cdp_discont_percent'],
                     'cdp_skidka'    => $row['cdp_skidka'],
                     'user_group'    => $row['user_group'],
                     'delivery_to'    => $row['delivery_to'],
                     'delivery_method'    => $row['delivery_method'],
                     'delivery_service'    =>   $row['delivery_service'],   
                     'delivery_cost'    => $row['delivery_cost'],
                     'bank'              => $row['bank_id'], 
                     'payment_type'    => $row['payment_type'],
                     'payment_method'    => $row['payment_method'],
                     'payment_status'    => $row['payment_status'],
                     'order_status'    => $row['order_status'],
                     'sended'    => $row['sended'] 
                   ); 
                   
            }
        }
       $mysql_update_order = "
           UPDATE `orders_base` SET 
          `order_status` = 5 
           WHERE `id`=  ".$order_id."
            ";                           
        $this->db->query($mysql_update_order);     
        
         /* --------------  FOR All other customers - begin $price_promo */  
           $price_promo = 0;
           foreach($data['cart'] as $tovar):
                if($tovar['promo']=='1'){
                    $price_promo = $price_promo + $tovar['model_price']*$tovar['quantity'];    
                }
            endforeach; 
                                     
             /* --------------  FOR All other customers - begin */
        
                $price_notpromo = 0;
                foreach($data['cart'] as $tovar):
                if($tovar['promo']!='1'){
                $price_notpromo = $price_notpromo + $tovar['model_price']*$tovar['quantity'];    
                }
                endforeach;
          /* --------------- FOR All other customers - end */
         $summa = $price_promo + $price_notpromo;
                $summa_za_tovar = $summa;
        
      $cdp_skidka = '';  
     if($DataOldOrder['user_group']==2){
         foreach ($data['cart'] as $upd) :
         //////////
           //  echo "percents CDP<br>";
        $cdp_discont_percent = $this->Get_CDP_Discont($price_notpromo);
            if($cdp_discont_percent!='0'){
            $cdp_discont = 1- ($cdp_discont_percent/100);   
            $cdp_discont_percent = $cdp_discont_percent;
                                                                               
         $summa = $price_promo + $price_notpromo*$cdp_discont;
         
         $cdp_skidka = $summa - $summa_za_tovar;
        // echo $cdp_skidka;  exit();
       // $summa = $summa*$data['cdp_discont'];
            }
       ///////////////
         endforeach;           
     }
   //   print_r($data);   exit();

   // $DataOldOrder['delivery_cost']
     
     if ($DataOldOrder['delivery_cost']!=''){
      $summa = $summa + $DataOldOrder['delivery_cost'];
     }
      
     if (!isset($cdp_discont_percent)){
        $cdp_discont_percent = 0;}  
   //  if (!isset($data['cdp_discont_percent'])){$cdp_discont_percent = 0;};
    // if (!isset($data['cdp_skidka'])){$cdp_skidka = 0;};  
     
                     
     $mysql_insert = "INSERT INTO `orders_base` (
     `id_user`,
     `date_order`,
     `name`,
     `surname`,
     `byfather`,  
     `town`,
     `adres`,
     `postindex`,
     `email`,
     `phone`,
     `contacts`,
     `note`,
     `total_sum`,
     `total_sum_to_pay`,
     `cdp_discont_percent`,
     `cdp_skidka`,
     `user_group`,
     `delivery_to`,
     `delivery_method`,
     `delivery_service`,
     `delivery_cost`,
     `bank_id`,
     `payment_type`,
     `payment_method`,
     `payment_status`,
     `order_status`,
     `sended`
      )
         VALUES (
         ".db_quote($DataOldOrder['id_user'])." ,
         ".db_quote(date("Y.m.d")).",
         ".db_quote($DataOldOrder['name'])." ,
         ".db_quote($DataOldOrder['surname'])." ,
         ".db_quote($DataOldOrder['byfather'])." ,  
         ".db_quote($DataOldOrder['town'])." ,
         ".db_quote($DataOldOrder['adres'])." ,
         ".db_quote($DataOldOrder['postindex'])." ,
         ".db_quote($DataOldOrder['email'])." ,
         ".db_quote($DataOldOrder['phone'])." ,
         ".db_quote($DataOldOrder['contacts'])." ,
         ".db_quote($DataOldOrder['note'])." ,
         ".db_quote($summa_za_tovar)." ,
         ".db_quote($summa)." ,
         ".db_quote($cdp_discont_percent)." ,
         ".db_quote($cdp_skidka)." ,
         ".db_quote($DataOldOrder['user_group'])." ,
         ".db_quote($DataOldOrder['delivery_to'])." ,
         ".db_quote($DataOldOrder['delivery_method'])." ,
         ".db_quote($DataOldOrder['delivery_service'])." ,   
         ".db_quote($DataOldOrder['delivery_cost'])." ,
         ".db_quote($DataOldOrder['bank'])." ,
         ".db_quote($DataOldOrder['payment_type'])." ,   
         ".db_quote($DataOldOrder['payment_method'])." ,     
         ".db_quote($DataOldOrder['payment_status']).",
         ".db_quote($DataOldOrder['order_status']).",
         ".db_quote($DataOldOrder['sended'])." 
         )";
   //  echo $mysql_insert;    Квитанция
        $this->db->query($mysql_insert);
        $order_id = $this->db->insert_id();

    /*   -----------------------------  */
          $mysql_update = "UPDATE `orders_items` SET  
          `id_order` = ".db_quote($order_id)."          
           WHERE `id_order` = '".$DataOldOrder['id']."' 
            "; 
            $this->db->query($mysql_update);
       
    /*  ==================  */
   
     return $order_id;
     }                 
//*******************************************************************
//******************************************************************* 
//******************************************************************* 
 function Get_CDP_Discont($price_notpromo_cdp)  {
              
        $query = "
            SELECT  `percent` 
            FROM `customers_group_cdp`
            WHERE `min_v`<= $price_notpromo_cdp
            AND   `max_v`>= $price_notpromo_cdp
           ";
     
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
  //********************************************************************************* 
//*******************************************************************
//******************************************************************* 
//******************************************************************* 
 function Approve_cdp_User_Dont($user_id)   {
         // query performing 
                 
        $query = "
            SELECT `id`, `email` FROM `customers_users`
            WHERE `id`=  ".$user_id." 
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
      ///////  
                          $to  = $data['email']; 
                          $subject = 'Смена партнёрской программы' ;   
                          $message = " 
                          <html><body><p>
                           
                          Уважаемый пользователь,
                          Вам было отказано в смене партнёрской программы.
                          <br> 
                           Ваша учётная запись не была переведена в группу CDP
                           (Customers Discount Programm).  
                          <br>
                              За подробной информацией обратитесь в администрацию ресурса.
                          <br> 
                          Ссылка для авторизации в магазине - <br>
                           <a href='".base_url()."login/'>Перейти в магазин</a>
                          <br>
                          Благодарим за пользование нашим сервисом.
                          <br>
                          <br>
                          <hr>
                           Это письмо отправлено автоматически и не требует ответа.<br>
                          Багги турыmadbuggy ".base_url()." 
                          </p></body></html>"; 

                      //  $headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
                        $headers  = "Content-type: text/html; charset=utf-8  \r\n";  
                        $headers .= "From: Багги туры madbuggy<sales@alafa.com.ua> \r\n";
                         mail($to, $subject, $message, $headers);      
           
    }   
//*******************************************************************       
//*******************************************************************
//*******************************************************************                                            
//******************************************************************* 
 
//*******************************************************************
                  
         //*********************************************************************
     function Get_Bills_All_For_Filter($start_limit)  {

        $order = "  LIMIT $start_limit, 20";
        // query performing
        $query = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM `orders_base`
            WHERE  1
            ORDER BY `date` ASC
            $order
         ";

        $dbres = $this->db->query($query,$start_limit);
      $data = array();
         if ($dbres->num_rows() >= 1) {

            $qtotal = mysql_query("SELECT FOUND_ROWS() AS `total`", $this->db->conn_id);
            $qtotal = mysql_fetch_assoc($qtotal);
            $data['total'] = $qtotal['total'];

            $rows = $dbres->result_array();
            foreach ($rows as $row) {

                     $data['billslist'][] =array(
                     'id'                 => $row['id'],
                     'date'            => $row['articul'],
                     'name'          => $row['name'],
                     'surname'          => $row['surname'],
                     'user_group'          => $row['user_group'],
                     'total_sum'          => $row['total_sum'],
                     'email'          => $row['email'],
                     'name'          => $row['name'],
                     'count'              => $this->count_same_models($row['id'])
                   );             //'count'    => $this->count_same_specs($row['id']),
                                  // 'pic'    => $this->loadThumbsToAlbum($row['id'])
            }
        }
        return $data;
    }
//*********************************************************************
    function loadCustomer_Group_Name($id)   {
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
//*******************************************************************
function load_Discont_data_for_order($id)
    {
         // query performing
         // $this-> db-> query('SET NAMES utf8');   
        $query = " SELECT `id`, `user_group`
                 FROM `orders_base`
                 WHERE `id`= $id
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
                     'user_group'    => $row['user_group']
                   ); 
                  
            }
        }
       //  print_r($data); exit();
       $percent_pdp = 0; 
       if($data['user_group']=='1'){
        $group_info =  $this->loadCustomer_Group_Name($data['user_group']);
       //   print_r($group_info);
       //   echo $group_info['discount'];
       //    exit();
       $percent_pdp = $group_info['discount'];  
       }
        
        return $percent_pdp;             
    }                    

//*******************************************************************
function load_Order_print($id)
    {
         // query performing
         // $this-> db-> query('SET NAMES utf8');   
        $query = " SELECT *
                 FROM `orders_base`
                 WHERE `id`= $id
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
        $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                 //  $data[] = $row ; 
                  $data[] = array(
                     'id'        => $row['id'],
                     'id_user'      => $row['id_user'], 
                     'date_order'   => $row['date_order'],
                     'name'         => $row['name'],
                     'surname'     => $row['surname'],
                     'byfather'      => $row['byfather'],
                     'region'      => $row['region'],
                     'town'        => $row['town'],
                     'adres'       => $row['adres'],
                     'postindex'      => $row['postindex'],
                     'email'      => $row['email'],
                     'phone'      => $row['phone'],
                     'contacts'      => $row['contacts'],
                     'note'      => $row['note'],
                     'total_sum'    => $row['total_sum'],
                     'total_sum_to_pay'    => $row['total_sum_to_pay'],
                     'cdp_discont_percent'    => $row['cdp_discont_percent'],
                     'cdp_skidka'    => $row['cdp_skidka'],
                     'user_group'    => $row['user_group'],
                     'delivery_to'    => $row['delivery_to'],
                     'delivery_method'    => $row['delivery_method'],
                     'delivery_service'    =>   $row['delivery_service'],
                     'delivery_sklad'    => $row['delivery_sklad'],
                     'delivery_cost'    => $row['delivery_cost'],
                     'payment_type'    => $row['payment_type'],
                     'privatbank_status'    => $row['privatbank_status'],
                     'privatbank_transaction_id'    => $row['privatbank_transaction_id'],
                     'privatbank_sender_phone'    => $row['privatbank_sender_phone'],
                     'privatbank_pay_way'    => $row['privatbank_pay_way'],
                     'payment_method'    => $row['payment_method'],
                     'payment_status'    => $row['payment_status'],
                     'order_status'    => $row['order_status'],
                     'order_items'    => $this->load_Order_Items( $row['id'])
                   ); 
                   //$this->load_Delivery_Service_one(
            }
        }
       // print_r($data); exit;
        return $data;             
    }                    
//*******************************************************************
function load_Order_List_Like_User($id)
    {
         // query performing
         // $this-> db-> query('SET NAMES utf8');   
        $query = " SELECT *
                 FROM `orders_base`
                 WHERE `id`= $id
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
                     'id_user'      => $row['id_user'], 
                     'date_order'   => $row['date_order'],
                     'name'         => $row['name'],
                     'surname'     => $row['surname'],
                     'byfather'      => $row['byfather'],
                     'region'      => $row['region'],
                     'town'        => $row['town'],
                     'adres'       => $row['adres'],
                     'postindex'      => $row['postindex'],
                     'email'      => $row['email'],
                     'phone'      => $row['phone'],
                     'contacts'      => $row['contacts'],
                     'note'      => $row['note'],
                     'total_sum'    => $row['total_sum'],
                     'total_sum_to_pay'    => $row['total_sum_to_pay'],
                     'cdp_discont_percent'    => $row['cdp_discont_percent'],
                     'cdp_skidka'    => $row['cdp_skidka'],
                     'user_group'    => $this->loadCustomer_Group_Name($row['user_group']),
                     'delivery_to'    => $row['delivery_to'],
                     'delivery_method'    => $row['delivery_method'],
                     'delivery_service'    =>   $row['delivery_service'], 
                     'delivery_cost'    => $row['delivery_cost'],                  
                     'payment_type'    => $row['payment_type'],
                     'payment_method'    => $row['payment_method'],
                     'order_items'    => $this->load_Order_Items( $row['id'])
                   ); 
                  
            }
        }
       // print_r($data); exit;
        return $data;             
    }
//******************************************************************* 
function loadOrder_Template()     {                 
        $query = "
            SELECT *
               FROM `orders_options`
            WHERE `id` = 1
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  //   $data = $row;
               $data =array(
                     'id'            => $row['id'],
                     'name'       => $row['name-rus'],
                     'text'       => $row['text-rus']                 
                     ); 
             }
        }
         return $data;             
    }
//******************************************************************* 
 
//**********************************************************    
 function loadOrder_Template_new()     {                 
        $query = "
            SELECT *
               FROM `orders_options`
            WHERE `id` = 2
        ";
       // echo  $query; exit; 
        $dbres = $this->db->query($query);
         $data = array();
         if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                //  $data = $row;
                $data = array(
                     'id'      => $row['id'],
                     'name'   => $row['name-rus'],
                     'text'   => $row['text-rus'] 
                   );
             }
        }
         return $data;             
    }     
//*******************************************************************   
function send_admin_mes_about_success_payment($id_user, $order_id, $order_payment_status)   { 

    //$this->send_admin_mes_about_success_payment($payment['id_user'], $order_id, $order_payment_status);  
    
    $order_data = $this->load_Order_List($order_id);
    
 //===============
      $query = "
            SELECT `value` FROM `settings_email`  WHERE `id` = 5 "; 
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
     
                          $to  = $emails;                
                         // $subject = 'Успешная оплата онлайн на madbuggy' ;
                         $subject = lang('main_user_letter_order_payment_subj')  ; 
                         

                         $site_url = base_url();
                          
                          $search = array (
                             '#order_id#',
                             '#email#',
                             '#name#',  
                             '#surname#',
                             '#total_sum_to_pay#',
                             '#phone#',            
                             '#site_url#'
                             );
                          $replace = array (
                             $order_id,
                             $order_data['email'],
                             $order_data['name'],  
                             $order_data['surname'],
                             $order_data['total_sum_to_pay'],
                             $order_data['phone'],   
                             $site_url
                             );
                          
 $document = lang('main_user_letter_order_payment_subj_success_by_hand');
 $text = str_replace($search, $replace, $document);
 
                          $message = " 
                          <html><body><p>
                          ".$text."
                          <hr>
                          ".lang('main_letter_sign')."
                          </p></body></html>"; 
                     
                      $from = lang('main_user_letter_order_payment_subj');
                      $from = '=?utf-8?B?'.base64_encode($from).'?=';
                      $subject = '=?utf-8?B?'.base64_encode($subject).'?=';   
                      
                      $headers  = "Content-type: text/html; charset=utf8 \r\n"; 
                      $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
                      $headers .= "Reply-To: <m-sale@alafa.com.ua>\r\n";   
                      $headers .= "From: ".$from." <m-sale@alafa.com.ua>\r\n";             
                      $headers .= "Content-type: text/html; charset=utf8  \r\n";
                      mail($to, $subject, $message, $headers);
   //===============   
    
}
//******************************************************************* 
function update_payment_status_automaticly($string, $payment)   {
  //  echo "<pre>"; print_r($payment); exit();
         // query performing 
        // $order_id = 
   $order_payment_status = $payment['order_payment_status'];     
  /*
   echo $string->amount." - amount<br>"; 
   echo $string->currency." - currency<br>"; 
   echo $string->status." - status<br>"; 
   echo $string->code." - code<br>"; 
   echo $string->transaction_id." - transaction_id<br>"; 
   echo $string->pay_way." - pay_way<br>";
   echo $string->sender_phone." - sender_phone<br>";  */
   
/* 
 Примеры статусов
  status="success" - покупка совершена
  status="failure" - покупка отклонена
  status="wait_secure" - платеж находится на проверке 
*/   
   // echo "<pre>"; print_r($payment); exit();        
         $mysql_update = "
           UPDATE `orders_base` SET 
          `payment_status` = '".$payment['order_payment_status']."',
          `privatbank_status` = '".$string->status."',
          `privatbank_code` = '".$string->code."',
          `privatbank_transaction_id` = '".$string->transaction_id."',
          `privatbank_sender_phone` = '".$string->sender_phone."',
          `privatbank_pay_way` = '".$string->pay_way."' 
           WHERE `id`=  ".$payment['order_id']."
           AND `id_user` =  ".$payment['id_user']."
            "; 
       //   echo $mysql_update; exit(); 
        $this->db->query($mysql_update);  
        $query = "
            SELECT `id`, `email` FROM `customers_users`
            WHERE `id`=  ".$payment['id_user']." 
         "; 
          $dbres = $this->db->query($query);
         $data = array();
        if ($dbres->num_rows() >= 1) {
            $rows = $dbres->result_array();
            foreach ($rows as $row) {
                  $data = $row ;
             }
        }
      ///////
      
      $pay_stat = lang('main_user_order_payment_wait_done');      // ---------- на всякий случай покажем статус "обрабатывается" ------
      
  if ( $order_payment_status=='1' && $string->success == 'wait_secure'){    
       $pay_stat = lang('main_user_order_payment_wait_done');
  }
 
 
       if ( $order_payment_status=='1' && $string->success == 'success'){
           
       $pay_stat = lang('main_user_order_payment_done');    // main_user_order_payment_done main_user_letter_order_payment_subj_success
       //$pay_stat = "Paid"; 
       
       $mysql_update = "
           UPDATE `orders_base` SET 
          `order_status` = '3' 
           WHERE `id`=  ".$payment['order_id']."
            "; 
       //   echo $mysql_update; exit(); 
        $this->db->query($mysql_update);    
        //($id_user, $order_id, $order_payment_status)
        //=====
        $mysql_update_ps = "
           UPDATE `orders_base` SET 
          `payment_status` = 1 
           WHERE `id`=  ".$payment['order_id']."
            ";                         
        $this->db->query($mysql_update_ps);  
       
       }
      if ( $order_payment_status=='0'  || $string->success == 'failure'){ // $pay_stat = "Not paid";
       $pay_stat =lang('main_user_order_payment_not_done');
       
        $mysql_update = "
           UPDATE `orders_base` SET 
          `order_status` = '2' 
           WHERE `id`=  ".$payment['order_id']."
            "; 
       
        $this->db->query($mysql_update);
        //=====
        $mysql_update_ps = "
           UPDATE `orders_base` SET 
          `payment_status` = 0 
           WHERE `id`=  ".$payment['order_id']."
            ";                         
        $this->db->query($mysql_update_ps);  
       }     
      /////// 
                          $to  = $data['email']; 
                         // $subject = 'Изменён статус оплаты заказа' ; 
                          $subject =  lang('main_user_letter_order_payment_subj') ; 
                          
                         
                           // main_user_letter_order_payment_subj_success  
                           //  main_user_order_payment_status
                           
                         /* $message = " 
                          <html><body><p>
                           
                           Уважаемый пользователь,  <br> 
                           Ваш заказ под номером  <b>#order_id#</b>     <br> 
                           изменил состояние оплаты на  &quot;#status#&quot; .  <br> 
                           Номер транзакции <b> #privatbank_transaction_id# </b>  <br> 
                           Телефон, который вы указали при оплате <b> #privatbank_sender_phone# </b>  <br>
                          <br>
                          Ссылка для авторизации в магазине - <br>
                           <a href='#site_url#login'>Перейти в магазин</a>
                          <br>
                          Благодарим за пользование нашим сервисом.
                          <br>
                          <br>
                          <hr>
                          Это письмо отправлено автоматически и не требует ответа.<br>
                          Багги туры madbuggy #site_url#
                          </p></body></html>";   */                  
                       
                      
                     //  $subject = 'Изменён статус оплаты заказа' ;
                          
                          $site_url = base_url();
                          $order_id = $payment['order_id'];
                          
                          $search = array (
                             '#order_id#',
                             '#status#',
                             '#privatbank_status#',  
                             '#privatbank_transaction_id#',
                             '#privatbank_sender_phone#',
                             '#privatbank_pay_way#',            
                             '#site_url#'
                             );
                          $replace = array (
                             $order_id,
                             $pay_stat,
                             $string->status,  
                             $string->transaction_id,
                             $string->sender_phone,
                             $string->pay_way,   
                             $site_url
                             );
                          
                     $document = lang('main_user_letter_payment_status_changed_auto_text');
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
                      
                      mail($to, $subject, $message, $headers); 
                      
                      
      $order_id = $payment['order_id']; 
      $this->send_admin_mes_about_success_payment($payment['id_user'], $order_id, $order_payment_status);                
                      
                           
           
    }  
//*******************************************************************   
}
?>