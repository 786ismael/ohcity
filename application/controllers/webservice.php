<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
define("SITE_URL", 'https://ohcityzgz.com/');
class Webservice extends CI_Controller
  {

  public

  function __construct()
    {
    parent::__construct();
    $this->load->model('webservice_model');
    $this->load->library(['form_validation', 'email']);
error_reporting(0);
date_default_timezone_set("Europe/Madrid");
    }

  public

  function index()
    {

    // $this->load->view('home');

    }

      /************* login function *************/

    public function login(){


                $email = $this->input->get_post('email', TRUE);
            $password = $this->input->get_post('password', TRUE);
                $register_id = $this->input->get_post('register_id');
                $ios_register_id= $this->input->get_post('ios_register_id');
            $where = "password = '$password' AND email='$email'";
    

      $login = $this->webservice_model->get_where('users',$where);
      if ($login) {

            if($login[0]['verify_status'] == '1'){

                      if($register_id) {  
    
                               $arr_da =   array(
                                     'register_id'=>'',
                                    
                                );
                  

    
                                $arrr_get =   array(
                                     'register_id'=>$register_id
                                );
                        

                                 $arr_chk = "register_id = '".$register_id."'";

         $this->webservice_model->update_data('users',$arr_da,$arr_chk);

                                 $this->webservice_model->update_data('users',$arrr_get,$where);
                       }

                       if($ios_register_id) {  

                       $arrr_get1 =   array(
                                     'ios_register_id'=>$ios_register_id 
                                );
    
                       $arr_da1 =   array(
                                     'ios_register_id'=>'',
                                    
                                );
                                 $arr_chk1 = "ios_register_id = '".$ios_register_id."'";

                           $this->webservice_model->update_data('users',$arr_da1,$arr_chk1);

                               $this->webservice_model->update_data('users',$arrr_get1,$where);
                            }
                               $login3 = $this->webservice_model->get_where('users',$where);
                               $login3[0]['image']=SITE_URL.'uploads/images/'.$login3[0]['image'];
                               $ressult['result']=$login3[0];
                               $ressult['message']='successfull';
                               $ressult['status']='1';
                               $json = $ressult;
                 }else{
                                $ressult['result']='Your account is not verify';
                                $ressult['message']='unsuccessfull';
                                $ressult['status']='0';
                                $json = $ressult;
                 }
                 

                 }else{
                                $ressult['result']='Your have entered wrong email & password';
                                $ressult['message']='unsuccessfull';
                                $ressult['status']='0';
                                $json = $ressult;       
                 }

      header('Content-type:application/json');
      echo json_encode($json);
    }


 
    /************* signup function *************/

    public function signup(){
 
         $arr_data = [
          
            'first_name'=>ucfirst($this->input->get_post('first_name')),
            'email'=>$this->input->get_post('email'),
            'password'=>$this->input->get_post('password'),
            'phone'=>$this->input->get_post('phone'),
            'address'=>$this->input->get_post('address'),
            'last_name'=>ucfirst($this->input->get_post('last_name')),
            'register_id'=>$this->input->get_post('register_id'),
            'ios_register_id'=>$this->input->get_post('ios_register_id')          
        ];


      $arr_get = ['email' => $arr_data['email']];

      $login = $this->webservice_model->get_where('users',$arr_get);
      if ($login) {

        $ressult['result']='Email already exist';
        $ressult['message']='unsuccessfull';
        $ressult['status']='0';
        $json = $ressult;
                               
        header('Content-type:application/json');
        echo json_encode($json);
        die;
      }     

      
      

      if (isset($_FILES['image']))
      {
               $n = rand(0, 100000);
               $img = "USER_IMG_" . $n . '.png';
               move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img);
               $arr_data['image'] = $img;        
      }


      $id = $this->webservice_model->insert_data('users',$arr_data);

      if ($id=="") {
        $json = ['result'=>'unsuccessfull','status'=>0,'message'=>'data not found'];
      }else{
                   
      
        $arr_gets = ['id'=>$id];
        $login = $this->webservice_model->get_where('users',$arr_gets);       
        $login[0]['image']=SITE_URL.'uploads/images/'.$login[0]['image'];
        $ressult['result']=$login[0];
        $ressult['message']='successfull';
        $ressult['status']='1';
        $json = $ressult;
      }

      header('Content-type:application/json');
      echo json_encode($json);

    }




        /************* social_login function *************/

     public function social_login(){

      
         $arr_data = [
           
            'first_name'=>ucfirst($this->input->get_post('first_name')),
            'email'=>$this->input->get_post('email'),
            'last_name'=>ucfirst($this->input->get_post('last_name')),
            'social_id'=>$this->input->get_post('social_id'),
            'lat'=>$this->input->get_post('lat'),
            'lon'=>$this->input->get_post('lon'),
            'register_id'=>$this->input->get_post('register_id')         
            ];

      $image = $this->input->get_post('image');
      
      if($image!=""){
         $img = "USER_IMG_" . rand(1, 10000) . ".jpg";
         file_put_contents('uploads/images/'.$img, file_get_contents($image));
         $arr_data['image'] = $img;

      }

      $arr_get = ['social_id'=>$arr_data['social_id']];

      $login = $this->webservice_model->get_where('users',$arr_get);

      if ($login) {  
     
     
     $arr_data1 = [
           
            'register_id'=>$this->input->get_post('register_id')          
            ];
        $this->webservice_model->update_data('users',$arr_data1,$arr_get);
        $data = $this->webservice_model->get_where('users',$arr_get);
        $data[0]['image']=SITE_URL.'uploads/images/'.$data[0]['image'];
       
          $ressult['result']=$data[0];
          $ressult['message']='successfull';
          $ressult['status']='1';
          $json = $ressult;

      }else{



        //$arr_data['user_code'] = $this->webservice_model->generateRandomString(4);

        $id = $this->webservice_model->insert_data('users',$arr_data);
        $data = $this->webservice_model->get_where('users',['id'=>$id]);        
        $data[0]['image']=SITE_URL.'uploads/images/'.$data[0]['image'];

          $ressult['result']=$data[0];
          $ressult['message']='successfull';
          $ressult['status']='1';
          $json = $ressult;

      }

      header('Content-type: application/json');
      echo json_encode($json);
    }

      /************* get__profile function *************/

     public function get_profile(){

      $arr_get = ['id'=>$this->input->get_post('user_id')];

      $login = $this->webservice_model->get_where('users',$arr_get);
      $arr_get = ['receiver_id'=>$this->input->get_post('user_id'),'is_read'=>'0'];
      $totalUnreadChat  = $this->webservice_model->get_where('kaise_chat_detail',$arr_get);
      if($totalUnreadChat){
          $totalUnreadChat = count($totalUnreadChat);
      }else{
          $totalUnreadChat = 0;
      }
      if ($login) {  
     
        $login[0]['image']=SITE_URL.'uploads/images/'.$login[0]['image'];

          $ressult['result']=$login[0];
          $ressult['message']='successfull';
          $ressult['status']=1;
          $ressult['totalUnreadChat'] = $totalUnreadChat;
          $json = $ressult;

      }else{

        $json = ['result'=>'unsuccessfull','status'=>0,'message'=>'Data Not Found'];

      }

      header('Content-type: application/json');
      echo json_encode($json);
    }      

   

    /************* update_profile function *************/

    public function update_profile(){

      $arr_get = ['id'=>$this->input->get_post('user_id')];

      $login = $this->webservice_model->get_where('users',$arr_get);
      if ($login[0]['id'] == "")
      {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessfull';
                          $ressult['status']='0';
                          $json = $ressult;

                                header('Content-type:application/json');
                                echo json_encode($json);
                                die;
      }



       $arr_data = [
           'first_name'=>$this->input->get_post('first_name'),
            'email'=>$this->input->get_post('email'),
            'password'=>$this->input->get_post('password'),
            'phone'=>$this->input->get_post('phone'),
            'address'=>$this->input->get_post('address'),
            'last_name'=>$this->input->get_post('last_name')
            ];

                        if (isset($_FILES['image']))
      {
                         //  unlink('uploads/images/'.$login[0]['image']);
                           $n = rand(0, 100000);
                           $img = "USER_IMG_" . $n . '.png';
                           move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img);
                           $arr_data['image'] = $img;        
      }


      $res = $this->webservice_model->update_data('users',$arr_data,$arr_get);
      if ($res)
      {
        $data = $this->webservice_model->get_where('users',$arr_get);
        $data[0]['image']=SITE_URL.'uploads/images/'.$data[0]['image'];
      
        $ressult['result']=$data[0];
        $ressult['message']='successfull';
        $ressult['status']='1';
        $json = $ressult;
      }
      else
      {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessfull';
                          $ressult['status']='0';
                          $json = $ressult;
      }

      header('Content-type: application/json');
      echo json_encode($json);

                          

    }



    /*************  category_list *************/
  public

  function category_list()
    {
    $fetch = $this->webservice_model->get_all('category');
    if ($fetch)
      {
      foreach($fetch as $val)
        {

       // $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
        $data[] = $val;
        }

       $ressult['result'] = $data;
       $ressult['message'] = 'successful';
       $ressult['status'] = '1';
       $json = $ressult;
      }
      else
      {
       $ressult['result'] = 'Data Not Found';
       $ressult['message'] = 'unsuccessful';
       $ressult['status'] = '0';
       $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }


    /*************  get_product_list *************/
  public

  function get_product_list()
    {
                   //  $this->db->order_by('end_date','DESC' AND 'date_time','asc');
     $user_id  = $this->input->get_post('user_id');
     $v        = $this->input->get('version');
     $count    = $this->input->get('count');
     $limit    = $this->input->get('limit');
     $search_key    = $this->input->get('search_key');
     
     if($v){
         $offset  = !empty($count) ? $count : '0';
         $limit   = !empty($limit) ? $limit : '40';
         //$limit  = '40';
     }else{
         $offset   = '0';
         $limit    = '50000000000';   
     }
    
     $current_date = date('Y-m-d');
   
    
    
    $date = date('Y-m-d');
    $sql  = "SELECT GROUP_CONCAT(id) as product_id FROM `product` WHERE `delete_status` = 'no' AND `buy_user_id` = '' AND `promoting_status` = 'yes' AND `end_date` >= '$date'";
    $promoted_id = $this->db->query($sql)->result_array();   
    $product_id = 0;
    if(!empty($promoted_id[0])){
        $product_id = $promoted_id[0]['product_id'];
    }
    /*if(!empty($search_key)){
        $sql = "SELECT id, user_id, buy_user_id, cat_id, offer_id, product_name, image, image1, image2, image3, price, lat, lon, address, extra, available, soldout, description, seller_name, contact_details, winner_ticket, reserve_status, status, delete_status, promoting_status, start_date, end_date, date_time, mobile FROM product WHERE product.product_name like '%$search_key%' and product.id IN (".$product_id.")
UNION
SELECT id, user_id, buy_user_id, cat_id, offer_id, product_name, image, image1, image2, image3, price, lat, lon, address, extra, available, soldout, description, seller_name, contact_details, winner_ticket, reserve_status, status, delete_status, promoting_status, start_date, end_date, date_time, mobile FROM product WHERE product.product_name like '%$search_key%' and product.id NOT IN (".$product_id.") limit $offset , $limit";
    }else{
        $sql = "SELECT id, user_id, buy_user_id, cat_id, offer_id, product_name, image, image1, image2, image3, price, lat, lon, address, extra, available, soldout, description, seller_name, contact_details, winner_ticket, reserve_status, status, delete_status, promoting_status, start_date, end_date, date_time, mobile FROM product WHERE product.id IN (".$product_id.")
UNION
SELECT id, user_id, buy_user_id, cat_id, offer_id, product_name, image, image1, image2, image3, price, lat, lon, address, extra, available, soldout, description, seller_name, contact_details, winner_ticket, reserve_status, status, delete_status, promoting_status, start_date, end_date, date_time, mobile FROM product WHERE product.id NOT IN (".$product_id.") limit $offset , $limit";   
    }*/
    if(!empty($search_key)){
        $sql = "SELECT id, user_id, buy_user_id, cat_id, offer_id, product_name, image, image1, image2, image3, price, lat, lon, address, extra, available, soldout, description, seller_name, contact_details, winner_ticket, reserve_status, status, delete_status, promoting_status, start_date, end_date, date_time, mobile FROM product WHERE product.product_name like '%$search_key%' and product.id IN ($product_id) order by date_time desc limit $offset , $limit
";        
    }else{
        if($product_id){
                  $sql = "SELECT id, user_id, buy_user_id, cat_id, offer_id, product_name, image, image1, image2, image3, price, lat, lon, address, extra, available, soldout, description, seller_name, contact_details, winner_ticket, reserve_status, status, delete_status, promoting_status, start_date, end_date, date_time, mobile FROM product WHERE product.id IN ($product_id) order by date_time desc limit $offset , $limit
";
        }
        
    }
    
    if($product_id){
        $fetch1 = $this->db->query($sql)->result_array();
        $promoted_count = count($fetch1);
        $limit = $limit - $promoted_count;        
    }else{
        $fetch1 = array();
        $promoted_count = count($fetch1);
        $limit = $limit - $promoted_count;
    }
    

    $fetch2 = [];
    if($limit > 0){
        if(!empty($search_key)){
            if($product_id){
              $sql = "SELECT id, user_id, buy_user_id, cat_id, offer_id, product_name, image, image1, image2, image3, price, lat, lon, address, extra, available, soldout, description, seller_name, contact_details, winner_ticket, reserve_status, status, delete_status, promoting_status, start_date, end_date, date_time, mobile FROM product WHERE product.product_name like '%$search_key%' and product.id NOT IN ($product_id) and  `delete_status` = 'no' order by date_time desc limit $offset , $limit
";        
            }else{
              $sql = "SELECT id, user_id, buy_user_id, cat_id, offer_id, product_name, image, image1, image2, image3, price, lat, lon, address, extra, available, soldout, description, seller_name, contact_details, winner_ticket, reserve_status, status, delete_status, promoting_status, start_date, end_date, date_time, mobile FROM product WHERE product.product_name like '%$search_key%'  and `buy_user_id` = '' and  `delete_status` = 'no' order by date_time desc limit $offset , $limit
";              
            }
        }else{
            if($product_id){
                $sql = "SELECT id, user_id, buy_user_id, cat_id, offer_id, product_name, image, image1, image2, image3, price, lat, lon, address, extra, available, soldout, description, seller_name, contact_details, winner_ticket, reserve_status, status, delete_status, promoting_status, start_date, end_date, date_time, mobile FROM product WHERE product.id NOT IN ($product_id) and  `delete_status` = 'no' order by date_time desc limit $offset , $limit
";
            }else{
                $sql = "SELECT id, user_id, buy_user_id, cat_id, offer_id, product_name, image, image1, image2, image3, price, lat, lon, address, extra, available, soldout, description, seller_name, contact_details, winner_ticket, reserve_status, status, delete_status, promoting_status, start_date, end_date, date_time, mobile FROM product WHERE  `delete_status` = 'no'  AND `buy_user_id` = '' order by date_time desc limit $offset , $limit
";                 
            }
          
        }
        
        $fetch2 = $this->db->query($sql)->result_array();    
    }
    
    $fetch = array_merge($fetch1,$fetch2);
  
    if ($fetch)
      {
          $product_data = [];
      foreach($fetch as $val)
        {
            
            $val['extra'] = trim($val['extra']) ? trim($val['extra']) :  '' ;

            if($val['extra'] == ','){
              $val['extra'] = '';
            }
            
           if($current_date <= $val['end_date']){
                          $val['promoted'] = 'YES';

           }else{
                          $val['promoted'] = 'NO';

           }
         $get = $this->db->select_avg("rating", "rating")->where(['product_user_id'=>$user_id])->get('rating')->result_array();

         $rating = ($get[0]['rating']=='') ?  0 : $get[0]['rating'];   
     $arr_user = ['id' => $val['user_id']];
   $users = $this->webservice_model->get_where('users', $arr_user);
if($users){
             $users[0]['user_image'] = SITE_URL . 'uploads/images/' . $users[0]['image'];
           $users[0]['rating'] = number_format($rating,1);

           $val['users_details'] = $users[0];

    
}else{
    
               $val['users_details'] = [];

    
}


           $arr_gets = ['product_id' => $val['id'],'user_id' => $user_id];
   $login = $this->webservice_model->get_where('like', $arr_gets);
          if($login){

                  $val['like'] = $login[0]['like'];

                }else{

                  $val['like'] = '0';

                  }
  
  if($val['image']){
    if(file_exists( FCPATH . 'uploads/images/' . $val['image'])){
      $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
    }else{
      $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
    }
  }

  if($val['image1']){
    if(file_exists( FCPATH . 'uploads/thumb/' . $val['image1'])){
      $val['image1'] = SITE_URL . 'uploads/thumb/' . $val['image1'];
    }else{
      $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
    }
  }

  if($val['image2']){
    if(file_exists( FCPATH . 'uploads/thumb/' . $val['image2'])){
      $val['image2'] = SITE_URL . 'uploads/thumb/' . $val['image2'];
    }else{
      $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
    }
  }

  if($val['image3']){
    if(file_exists( FCPATH . 'uploads/thumb/' . $val['image3'])){
      $val['image3'] = SITE_URL . 'uploads/thumb/' . $val['image3'];
    }else{
      $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
    }
  }

/*
if($val['image']){
         if(file_exists( FCPATH . 'uploads/thumb/' . $val['image'])){
            $val['image'] = SITE_URL . 'uploads/thumb/' . $val['image'];
         }else{
            $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
         }
}
if($val['image1']){
         if(file_exists( FCPATH . 'uploads/thumb/' . $val['image1'])){
            $val['image1'] = SITE_URL . 'uploads/thumb/' . $val['image1'];
         }else{
            $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
         }
}
if($val['image2']){
         if(file_exists( FCPATH . 'uploads/thumb/' . $val['image2'])){
            $val['image2'] = SITE_URL . 'uploads/thumb/' . $val['image2'];
         }else{
            $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
         }
}
if($val['image3']){
         if(file_exists( FCPATH . 'uploads/thumb/' . $val['image3'])){
            $val['image3'] = SITE_URL . 'uploads/thumb/' . $val['image3'];
         }else{
            $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
         }
}
*/ 

  if(empty($val['image1']) || is_null($val['image1'])){
     $val['image1'] = null;
  } 

  if(empty($val['image2']) || is_null($val['image2'])){
     $val['image2'] = null;
  } 

  if(empty($val['image3']) || is_null($val['image3'])){
     $val['image3'] = null;
  } 

  if(empty($val['image4']) || is_null($val['image4'])){
     $val['image4'] = null;
  } 

$data[] = $val;

        }

   $dis = array();
                    foreach ($data as $key => $row)
                    {
                 $dis[$key] = $row['promoted'];
                 $dis1[$key] = $row['date_time'];

                    }
                    array_multisort($dis, SORT_DESC,$dis1, SORT_DESC, $data);
                          $ressult['result']=$data;
                          $ressult['message']='successful';
                          $ressult['status']='1';
                          $json = $ressult;

      }
      else
      {
       $ressult['result'] = 'Data Not Found';
       $ressult['message'] = 'unsuccessful';
       $ressult['status'] = '0';
       $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }
    
      function get_product_detail_new()
    {
                   //  $this->db->order_by('end_date','DESC' AND 'date_time','asc');
     $user_id     = $this->input->get_post('user_id');
     $product_id  = $this->input->get('product_id');
     
  $fetch = $this->db->query("SELECT * FROM product where buy_user_id = '' AND delete_status = 'no' AND id = ".$product_id)->result_array();
 

   // $fetch = $this->webservice_model->get_where('product1', $arr_user1);
    if ($fetch)
      {
      foreach($fetch as $val)
        {
           if($current_date <= $val['end_date']){
                          $val['promoted'] = 'YES';

           }else{
                          $val['promoted'] = 'NO';

           }
         $get = $this->db->select_avg("rating", "rating")->where(['product_user_id'=>$user_id])->get('rating')->result_array();

         $rating = ($get[0]['rating']=='') ?  0 : $get[0]['rating'];   
     $arr_user = ['id' => $val['user_id']];
   $users = $this->webservice_model->get_where('users', $arr_user);
if($users){
             $users[0]['user_image'] = SITE_URL . 'uploads/images/' . $users[0]['image'];
           $users[0]['rating'] = number_format($rating,1);

           $val['users_details'] = $users[0];

    
}else{
    
               $val['users_details'] = [];

    
}


           $arr_gets = ['product_id' => $val['id'],'user_id' => $user_id];
   $login = $this->webservice_model->get_where('like', $arr_gets);
          if($login){

                  $val['like'] = $login[0]['like'];

                }else{

                  $val['like'] = '0';

                  }

if($val['image']){
         $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
         
         if(file_exists('uploads/thumb/'.$val['image'])){
            $val['image'] = SITE_URL . 'uploads/thumb/' . $val['image'];
         }
}
if($val['image1']){
         $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
}
if($val['image2']){
         $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
}
if($val['image3']){
         $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
}        $data[] = $val;
        }

   $dis = array();
                    foreach ($data as $key => $row)
                    {
                 $dis[$key] = $row['promoted'];
                 $dis1[$key] = $row['date_time'];

                    }
                    array_multisort($dis, SORT_DESC,$dis1, SORT_DESC, $data);

                          $ressult['result']=$data[0];
                          $ressult['message']='successful';
                          $ressult['status']='1';
                          $json = $ressult;

      }
      else
      {
       $ressult['result'] = 'Data Not Found';
       $ressult['message'] = 'unsuccessful';
       $ressult['status'] = '0';
       $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }
    
          function get_product_detail_new_ios()
    {
                   //  $this->db->order_by('end_date','DESC' AND 'date_time','asc');
     $user_id     = $this->input->get_post('user_id');
     $product_id  = $this->input->get('product_id');
     
  $fetch = $this->db->query("SELECT * FROM product where buy_user_id = '' AND delete_status = 'no' AND id = ".$product_id)->result_array();
 

   // $fetch = $this->webservice_model->get_where('product1', $arr_user1);
    if ($fetch)
      {
      foreach($fetch as $val)
        {
           if($current_date <= $val['end_date']){
                          $val['promoted'] = 'YES';

           }else{
                          $val['promoted'] = 'NO';

           }
         $get = $this->db->select_avg("rating", "rating")->where(['product_user_id'=>$user_id])->get('rating')->result_array();

         $rating = ($get[0]['rating']=='') ?  0 : $get[0]['rating'];   
     $arr_user = ['id' => $val['user_id']];
   $users = $this->webservice_model->get_where('users', $arr_user);
if($users){
             $users[0]['user_image'] = SITE_URL . 'uploads/images/' . $users[0]['image'];
           $users[0]['rating'] = number_format($rating,1);

           $val['users_details'] = $users[0];

    
}else{
    
               $val['users_details'] = [];

    
}


           $arr_gets = ['product_id' => $val['id'],'user_id' => $user_id];
   $login = $this->webservice_model->get_where('like', $arr_gets);
          if($login){

                  $val['like'] = $login[0]['like'];

                }else{

                  $val['like'] = '0';

                  }

if($val['image']){
         $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
         
         if(file_exists('uploads/thumb/'.$val['image'])){
            $val['image'] = SITE_URL . 'uploads/thumb/' . $val['image'];
         }
}
if($val['image1']){
         $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
}
if($val['image2']){
         $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
}
if($val['image3']){
         $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
}        $data[] = $val;
        }

   $dis = array();
                    foreach ($data as $key => $row)
                    {
                 $dis[$key] = $row['promoted'];
                 $dis1[$key] = $row['date_time'];

                    }
                    array_multisort($dis, SORT_DESC,$dis1, SORT_DESC, $data);

                          $ressult['result']=$data;
                          $ressult['message']='successful';
                          $ressult['status']='1';
                          $json = $ressult;

      }
      else
      {
       $ressult['result'] = 'Data Not Found';
       $ressult['message'] = 'unsuccessful';
       $ressult['status'] = '0';
       $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }


 /*************  banner_list *************/
  public

  function banner_list()
    {
    $fetch = $this->webservice_model->get_all('banner');
    if ($fetch)
      {
      foreach($fetch as $val)
        {

         $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
         $data[] = $val;
        }

         $ressult['result'] = $data;
         $ressult['message'] = 'successful';
         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
         $ressult['result'] = 'Data Not Found';
         $ressult['message'] = 'unsuccessful';
         $ressult['status'] = '0';
         $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }
    
    
  
 
 

    /************* add_product function *************/

    function str_random($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 

    public function add_product(){
       $arr_data = [
            'cat_id'=>$this->input->get_post('cat_id'),
            'product_name'=>trim($this->input->get_post('product_name')),
            'description'=>trim($this->input->get_post('description')),
            'price'=>$this->input->get_post('price'),
            'lat'=>$this->input->get_post('lat'),
            'lon'=>$this->input->get_post('lon'),
         //   'date_time'=>$this->input->get_post('date_time'),
            'address'=>$this->input->get_post('address'),
            'extra'=>$this->input->get_post('extra'),
            'user_id' => $this->input->get_post('user_id'),
            'mobile' => $this->input->get_post('mobile'),
       ];
       
    $imageQaulity = 25;
     
        if (isset($_FILES['image']) && !empty($_FILES['image']))
    {

    $n = rand(0, 100000) . $this->str_random('10') ;
    $img = "PRODUCT_IMG_" . $n . '.png';
    $this->compressImage($_FILES['image']['tmp_name'] , 'uploads/thumb/'.$img , $imageQaulity );
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img);
    $arr_data['image'] = $img;
    }

       if (isset($_FILES['image1']) && !empty($_FILES['image1']))
    {

    $n = rand(0, 100000) . $this->str_random('10') ;
    $img = "PRODUCT1_IMG_" . $n . '.png';

    $this->compressImage($_FILES['image1']['tmp_name'] , 'uploads/thumb/'.$img , $imageQaulity );
    move_uploaded_file($_FILES['image1']['tmp_name'], "uploads/images/" . $img);
    $arr_data['image1'] = $img;
    }

       if (isset($_FILES['image2']) && !empty($_FILES['image2']))
    {

    $n = rand(0, 100000) . $this->str_random('10') ;
    $img = "PRODUCT2_IMG_" . $n . '.png';

    $this->compressImage($_FILES['image2']['tmp_name'] , 'uploads/thumb/'.$img , $imageQaulity );
    move_uploaded_file($_FILES['image2']['tmp_name'], "uploads/images/" . $img);
    $arr_data['image2'] = $img;
    }
 
       if (isset($_FILES['image3']) && !empty($_FILES['image3']))
    {

    $n = rand(0, 100000) . $this->str_random('10') ;
    $img = "PRODUCT3_IMG_" . $n . '.png';

    $this->compressImage($_FILES['image3']['tmp_name'] , 'uploads/thumb/'.$img , $imageQaulity );
    move_uploaded_file($_FILES['image3']['tmp_name'], "uploads/images/" . $img);
    $arr_data['image3'] = $img;
    }

                $id = $this->webservice_model->insert_data('product',$arr_data);


      if ($id=="") {

                $json = ['result'=>'unsuccessfull','status'=>0,'message'=>'data not found'];

      }else{


                $arr_gets = ['id' => $id];
                     
        
                $login = $this->webservice_model->get_where('product',$arr_gets);   
                
             
                $login[0]['image']=SITE_URL.'uploads/images/'.$login[0]['image'];       
                $login[0]['image1']=SITE_URL.'uploads/images/'.$login[0]['image1'];       
                $login[0]['image2']=SITE_URL.'uploads/images/'.$login[0]['image2'];       
                $login[0]['image3']=SITE_URL.'uploads/images/'.$login[0]['image3'];
                $ressult['result']=$login[0];
                $ressult['message']='successfull';
                $ressult['status']='1';
                $json = $ressult;
                
                $where = [
                     'id' => $this->input->get_post('user_id')
                    ];
                
                $users = $this->webservice_model->get_where('users', $where );
                
                $user_name = $users[0]['first_name'] .' '. $users[0]['last_name'];
                
                $this->addProductNotification($this->input->get_post('user_id'), $user_name ,$this->input->get_post('product_name'));
      }

      header('Content-type:application/json');
      echo json_encode($json);

    }
    
    
    

    /*************  product_list *************/
  public

  function product_list()
    {
                     $this->db->order_by('id','DESC');

      $user_id = $this->input->get_post('user_id');

    $fetch = $this->webservice_model->get_all('product');
    if ($fetch)
      {
      foreach($fetch as $val)
        {
           $arr_gets = ['product_id' => $val['id'],'user_id' => $user_id];
   $login = $this->webservice_model->get_where('like', $arr_gets);
          if($login){

                  $val['like'] = $login[0]['like'];

                }else{

                  $val['like'] = '0';

                  }
                   
                   
                   $arr_offer = ['id' => $val['offer_id']];
   $offers = $this->webservice_model->get_where('offers', $arr_offer);
if($offers){
             $offers[0]['image'] = SITE_URL . 'uploads/images/' . $offers[0]['image'];

           $val['offer_details'] = $offers[0];

    
}else{
    
               $val['offer_details'] = [];

    
}

 

         
         if(file_exists('uploads/thumb/'.$val['image'])){
            $val['image'] = SITE_URL . 'uploads/thumb/' . $val['image'];
         }else{
            $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
         }
         


         $data[] = $val;
        
        }

         $ressult['result'] = $data;
         $ressult['message'] = 'successful';
         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
         $ressult['result'] = 'Data Not Found';
         $ressult['message'] = 'unsuccessful';
         $ressult['status'] = '0';
         $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }



    /*************  get_product_by_category *************/
  public

  function get_product_by_category()
    {
      
       $cat_id  = $this->input->get_post('cat_id');
       $user_id = $this->input->get_post('user_id');
       $v       = $this->input->get('version');
       $count   = $this->input->get('count');
       $limit   = $this->input->get('limit');
       
       if($v){
         $offset  = !empty($count) ? $count : '0';
         $limit   = !empty($limit) ? $limit : '40';
       }else{
         $offset   = '0';
         $limit    = '5000';   
       }

      $fetch = $this->db->query("select * from product WHERE cat_id = '$cat_id' AND status = 'Pending' AND delete_status = 'no'  ORDER BY id DESC limit $offset , $limit ")->result_array();

      $arr_get1 = ['id' => $cat_id];

      $fetch1 = $this->webservice_model->get_where('category',$arr_get1);

    if ($fetch)
      {
       foreach($fetch as $val)
        {
          $get = $this->db->select_avg("rating", "rating")->where(['product_user_id'=>$user_id])->get('rating')->result_array();

         $rating = ($get[0]['rating']=='') ?  0 : $get[0]['rating'];   
        
     $arr_user = ['id' => $val['user_id']];
   $users = $this->webservice_model->get_where('users', $arr_user);
if($users){
             $users[0]['user_image'] = SITE_URL . 'uploads/images/' . $users[0]['image'];
           $users[0]['rating'] = number_format($rating,1);

           $val['users_details'] = $users[0];

    
}else{
    
               $val['users_details'] = [];

    
}

             $arr_gets = ['product_id' => $val['id'],'user_id' => $user_id];
   $login = $this->webservice_model->get_where('like', $arr_gets);
          if($login){

                  $val['like'] = $login[0]['like'];

                }else{

                  $val['like'] = '0';

                  }


if($val['image']){
         $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
         
         if(file_exists('uploads/thumb/'.$val['image'])){
            $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];  
         }
}
if($val['image1']){
         $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
}
if($val['image2']){
         $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
}
if($val['image3']){
         $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
}
         $data[] = $val;
        }
         $ressult['result'] = $data;
         $ressult['category_name'] = $fetch1[0]['category_name'];

         $ressult['message'] = 'successful';

         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
         $ressult['result'] = 'Data Not Found';
         $ressult['category_name'] = $fetch1[0]['category_name'];

         $ressult['message'] = 'unsuccessful';
         $ressult['status'] = '0';
         $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }



    /*************  get_product_by_user *************/
  public

  function get_product_by_user()
    {
      $user_id = $this->input->get_post('user_id');


      $fetch = $this->db->query("select * from product WHERE user_id = '$user_id' AND delete_status = 'no' ORDER BY id DESC ")->result_array();

    if ($fetch)
      {
       foreach($fetch as $val)
        {
    
     $arr_cat = ['id' => $val['cat_id']];
   $cat = $this->webservice_model->get_where('category', $arr_cat);

  if($val['image']){

     if(file_exists( FCPATH . 'uploads/thumb/' . $val['image'])){
        $val['image'] = SITE_URL . 'uploads/thumb/' . $val['image'];
     }else{
        $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
     }
  }

  if($val['image1']){
    if(file_exists( FCPATH . 'uploads/thumb/' . $val['image1'])){
        $val['image1'] = SITE_URL . 'uploads/thumb/' . $val['image1'];
     }else{
        $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
     }
  }

  if($val['image2']){
     if(file_exists( FCPATH . 'uploads/thumb/' . $val['image2'])){
        $val['image2'] = SITE_URL . 'uploads/thumb/' . $val['image2'];
     }else{
        $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
     }
  }

   if($val['image3']){
     if(file_exists( FCPATH . 'uploads/thumb/' . $val['image3'])){
        $val['image3'] = SITE_URL . 'uploads/thumb/' . $val['image3'];
     }else{
        $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
     }
  }

 /*
if($val['image']){
         $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
}
if($val['image1']){
         $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
}
if($val['image2']){
         $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
}
if($val['image3']){
         $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
}

$val['category_name'] = '';
if(!empty($cat[0])){
    $val['category_name'] = $cat[0]['category_name'];
} */

/************************************************************/
    $arr_user = ['id' => $val['user_id']];
   $users = $this->webservice_model->get_where('users', $arr_user);
if($users){
             $users[0]['user_image'] = SITE_URL . 'uploads/images/' . $users[0]['image'];
           $users[0]['rating'] = number_format($rating,1);

           $val['users_details'] = $users[0];

    
}else{
    
               $val['users_details'] = [];

    
}

           $arr_gets = ['product_id' => $val['id'],'user_id' => $user_id];
   $login = $this->webservice_model->get_where('like', $arr_gets);
          if($login){

                  $val['like'] = $login[0]['like'];

                }else{

                  $val['like'] = '0';

                  }
                  
/************************************************************/

        $date = date('Y-m-d H:i:s',strtotime($val['date_time']));
        $currentDate = date('Y-m-d H:i:s');
        // Create a new DateTime instance
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $date );
        // Modify the date
        $date->modify('+24 hourse');
        // Output
        $ProductDate =  $date->format('Y-m-d H:i:s');

       /* echo '<pre>';
        print_r($val['date_time']);
        echo '<br>';
        print_r($ProductDate);
        echo '<pre>';
        print_r($currentDate);
        die; */

        if(strtotime($currentDate) >= strtotime($ProductDate)){
          $val['is_renew'] = '1';
        }else{
          $val['is_renew'] = '0';
        }

         $data[] = $val;
        }
        
         foreach($data as $key => $value){
             foreach($value as $k =>$v){
                 if(is_null($v)){
                     $data[$key][$k] = '';
                 }
             }

               if(empty($value['image'])){
                $data[$key]['image'] = $value['image'] = null;
                }
                if(empty($value['image1'])){
                $data[$key]['image1'] = $value['image1'] = null;
                }
                if(empty($value['image2'])){
                $data[$key]['image2'] = $value['image2'] = null;
                }
                if(empty($value['image3'])){
                $data[$key]['image3'] = $value['image3'] = null;
                }
         }

         
         $ressult['result'] = $data;

         $ressult['message'] = 'successful';

         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
         $ressult['result'] = 'Data Not Found';

         $ressult['message'] = 'unsuccessful';
         $ressult['status'] = '0';
         $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }



    /*************  get_sold_product_by_user *************/
  public

  function get_sold_product_by_user()
    {
      $user_id = $this->input->get_post('user_id');


      $fetch = $this->db->query("select * from product WHERE user_id = '$user_id' AND buy_user_id != '' ORDER BY id DESC ")->result_array();

    if ($fetch)
      {
       foreach($fetch as $val)
        {
    
     $arr_cat = ['id' => $val['cat_id']];
   $cat = $this->webservice_model->get_where('category', $arr_cat);
    
if($val['image']){
         $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
}
if($val['image1']){
         $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
}
if($val['image2']){
         $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
}
if($val['image3']){
         $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
}


   $arr_rat = ['user_id' => $user_id,'product_id' => $val['id']];
   $rat = $this->webservice_model->get_where('rating', $arr_rat);
   if($rat){
   $val['rating_status'] = '1';
   }else{
   $val['rating_status'] = '0';

   }


$val['category_name'] = $cat[0]['category_name'];
         $data[] = $val;
        }
         $ressult['result'] = $data;

         $ressult['message'] = 'successful';

         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
         $ressult['result'] = 'Data Not Found';

         $ressult['message'] = 'unsuccessful';
         $ressult['status'] = '0';
         $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

 /*************  get_purchased_product_by_user *************/
  public

  function get_purchased_product_by_user()
    {
      $user_id = $this->input->get_post('user_id');


      $fetch = $this->db->query("select * from product WHERE buy_user_id = '$user_id' ORDER BY id DESC ")->result_array();

    if ($fetch)
      {
       foreach($fetch as $val)
        {
    
     $arr_cat = ['id' => $val['cat_id']];
     $cat = $this->webservice_model->get_where('category', $arr_cat);

       $arr_get = ['product_user_id' => $val['user_id'],'product_id' => $val['id']];
       $rating  = $this->webservice_model->get_where('rating', $arr_get);
       if(count($rating) > 0){
         $val['seller_rating'] = '1';
       }else{
         $val['seller_rating'] = '0';
       }

if($val['image']){
         $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
}
if($val['image1']){
         $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
}
if($val['image2']){
         $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
}
if($val['image3']){
         $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
}

$val['category_name'] = $cat[0]['category_name'];


     $arr_rat = ['user_id' => $user_id,'product_id' => $val['id']];
   $rat = $this->webservice_model->get_where('rating', $arr_rat);
   if($rat){
   $val['rating_status'] = '1';
   }else{
   $val['rating_status'] = '0';

   }
         $data[] = $val;
        }
        
        $dis = array();
      foreach($data as $key => $row)
        {
        $dis[$key] = $row['rating_status'];
        }

      array_multisort($dis, SORT_ASC, $data);
         $ressult['result'] = $data;

         $ressult['message'] = 'successful';

         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
         $ressult['result'] = 'Data Not Found';

         $ressult['message'] = 'unsuccessful';
         $ressult['status'] = '0';
         $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }



 /*************  get_final *************/
  public

  function get_final()
    {
      $user_id = $this->input->get_post('user_id');

      $fetch = $this->db->query("select * from product WHERE buy_user_id != '' AND (buy_user_id = '$user_id' OR user_id = '$user_id') ORDER BY id DESC ")->result_array();

    if ($fetch)
      {
       foreach($fetch as $val)
        {

            $buser_user_id  = $val['buy_user_id'];
            $seller_user_id = $val['user_id'];

           $arr_cat = ['id' => $val['cat_id']];
           $cat = $this->webservice_model->get_where('category', $arr_cat);

       $arr_get = ['product_user_id' => $seller_user_id,'product_id' => $val['id']];
       $rating  = $this->webservice_model->get_where('rating', $arr_get);
       
       if(!empty($rating) && !is_null($rating)) {
         $val['seller_rating'] = '1';
       }else{
         $val['seller_rating'] = '0';
       }
    
     $arr_cat = ['id' => $val['cat_id']];
   $cat = $this->webservice_model->get_where('category', $arr_cat);
    
if($val['image']){
         $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
}
if($val['image1']){
         $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
}
if($val['image2']){
         $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
}
if($val['image3']){
         $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
}

$val['category_name'] = $cat[0]['category_name'];


     $arr_rat = ['user_id' => $user_id,'product_id' => $val['id']];
   $rat = $this->webservice_model->get_where('rating', $arr_rat);
   if($rat){
   $val['rating_status'] = '1';
   }else{
   $val['rating_status'] = '0';

   }
   
   if($val['user_id'] == $user_id){
   $val['final_status'] = 'sold';
   }else{
   $val['final_status'] = 'purchased';

   }
   
         $data[] = $val;
        }
        
        $dis = array();
        $rated = [];
        $unrated = [];
      foreach($data as $key => $row)
        {
            if($row['rating_status'] == 1){
                $rated[$key] = $row;
                $dis[$key] = $row['rating_status'];
            }else{
                $unrated[$key] = $row;
            }
        $dis[$key] = $row['rating_status'];
        }
      
      //array_multisort($dis, SORT_ASC, $rated);
     # echo "<pre>";
      #print_r($unrated);
     # echo "<br>==================================================<br>";
        
      #  print_r($rated);
        $data = array_merge($unrated,$rated);
        #echo "<br>==================================================<br>";
      #  print_r($data);
      #die;  
         $ressult['result'] = $data;

         $ressult['message'] = 'successful';

         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
         $ressult['result'] = 'Data Not Found';

         $ressult['message'] = 'unsuccessful';
         $ressult['status'] = '0';
         $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

    /************* update_product function *************/

    public function update_product(){

      $arr_get = ['id'=>$this->input->get_post('product_id')];

      $login = $this->webservice_model->get_where('product',$arr_get);
      if ($login[0]['id'] == "")
      {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessfull';
                          $ressult['status']='0';
                          $json = $ressult;

                                header('Content-type:application/json');
                                echo json_encode($json);
                                die;
      }



        $arr_data = [
            'cat_id'=>$this->input->get_post('cat_id'),
            'product_name'=>$this->input->get_post('product_name'),
            'description'=>$this->input->get_post('description'),
            'price'=>$this->input->get_post('price'),
            'lat'=>$this->input->get_post('lat'),
            'lon'=>$this->input->get_post('lon'),
            'address'=>$this->input->get_post('address'),
            'extra'=>$this->input->get_post('extra'),
            'contact_details'=>$this->input->get_post('contact_details'),
            'mobile' => $this->input->get_post('mobile'),
       ];
     
         if (isset($_FILES['image']))
    {

    $n = rand(0, 100000);
    $img = "PRODUCT_IMG_" . $n . '.png';
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img);
    $arr_data['image'] = $img;
    }

       if (isset($_FILES['image1']))
    {

    $n = rand(0, 100000);
    $img = "PRODUCT1_IMG_" . $n . '.png';
    move_uploaded_file($_FILES['image1']['tmp_name'], "uploads/images/" . $img);
    $arr_data['image1'] = $img;
    }

       if (isset($_FILES['image2']))
    {

    $n = rand(0, 100000);
    $img = "PRODUCT2_IMG_" . $n . '.png';
    move_uploaded_file($_FILES['image2']['tmp_name'], "uploads/images/" . $img);
    $arr_data['image2'] = $img;
    }
 
       if (isset($_FILES['image3']))
    {

    $n = rand(0, 100000);
    $img = "PRODUCT3_IMG_" . $n . '.png';
    move_uploaded_file($_FILES['image3']['tmp_name'], "uploads/images/" . $img);
    $arr_data['image3'] = $img;
    }

      $res = $this->webservice_model->update_data('product',$arr_data,$arr_get);
      if ($res)
      {
        $data = $this->webservice_model->get_where('product',$arr_get);
        $data[0]['image']=SITE_URL.'uploads/images/'.$data[0]['image'];
        $data[0]['image1']=SITE_URL.'uploads/images/'.$data[0]['image1'];
        $data[0]['image2']=SITE_URL.'uploads/images/'.$data[0]['image2'];
        $data[0]['image3']=SITE_URL.'uploads/images/'.$data[0]['image3'];

        $ressult['result']=$data[0];
        $ressult['message']='successfull';
        $ressult['status']='1';
        $json = $ressult;
      }
      else
      {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessfull';
                          $ressult['status']='0';
                          $json = $ressult;
      }

      header('Content-type: application/json');
      echo json_encode($json);

                          

    }
    
    
    
    
    /************* add_interested_product function *************/

    public function add_interested_product(){

                  $arr_data = [
                        'product_id'=>$this->input->get_post('product_id'),
                        'user_id'=>$this->input->get_post('user_id')  
            ];


      $arr_get = "product_id = '".$arr_data['product_id']."' AND user_id = '".$arr_data['user_id']."' ";

      $login = $this->webservice_model->get_where('interested_users',$arr_get);
      if ($login) {
        
        $ressult['result']='already exist';
        $ressult['message']='successfull';
        $ressult['status']='1';
        $json = $ressult;
        header('Content-type:application/json');
        echo json_encode($json);
        die;
      }     

      
      


      $id = $this->webservice_model->insert_data('interested_users',$arr_data);

      if ($id=="") {
        $json = ['result'=>'unsuccessfull','status'=>0,'message'=>'data not found'];
      }else{
                              
        $arr_gets = ['id'=>$id];
        $login = $this->webservice_model->get_where('interested_users',$arr_gets);        
        $ressult['result']=$login[0];
        $ressult['message']='successfull';
        $ressult['status']='1';
        $json = $ressult;
      }

      header('Content-type:application/json');
      echo json_encode($json);

    }




    /*************  get_users_interested *************/
  public

  function get_users_interested()
    {
      $product_id = $this->input->get_post('product_id');


      $fetch = $this->db->query("select * from interested_users WHERE product_id = '$product_id'")->result_array();

  

    if ($fetch)
      {
       foreach($fetch as $val)
        {
         
        
     $arr_user = ['id' => $val['user_id']];
   $users = $this->webservice_model->get_where('users', $arr_user);
if($users){
             $users[0]['image'] = SITE_URL . 'uploads/images/' . $users[0]['image'];

           $val['users_details'] = $users[0];

    
}else{
    
               $val['users_details'] = [];

    
}
         $data[] = $val;
        }
         $ressult['result'] = $data;
         $ressult['message'] = 'successful';
         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
         $ressult['result'] = 'Data Not Found';
         $ressult['message'] = 'unsuccessful';
         $ressult['status'] = '0';
         $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }


    /************* sold_product function *************/

    public function sold_product(){

      $arr_get = ['id'=>$this->input->get_post('product_id')];

      $login = $this->webservice_model->get_where('product',$arr_get);
      if ($login[0]['id'] == "")
      {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessfull';
                          $ressult['status']='0';
                          $json = $ressult;

                                header('Content-type:application/json');
                                echo json_encode($json);
                                die;
      }



        $arr_data = [
            'buy_user_id'=>$this->input->get_post('buy_user_id'),
            'status'=>$this->input->get_post('status')
       ];
     
       

      $res = $this->webservice_model->update_data('product',$arr_data,$arr_get);
      if ($res)
      {
          
  $user_r = $this->webservice_model->get_where('users', ['id' => $arr_data['buy_user_id']]);
  $user_message_apk = array(
    "message"   => array(
      "result"  => "successful",
      "key"     => "product sold",
      "message" => "product sold",
      "date"    => date('Y-m-d h:i:s')
    )
  );
  $register_userid = array(
    $user_r[0]['register_id']
  );
  
//  $this->webservice_model->user_apk_notification($register_userid, $user_message_apk);  
  
  if($user_r[0]['device_type'] == 1){
      if($user_r[0]['device_token']){
          $this->ios_notification($user_r[0]['device_token'],$user_message_apk,'','Un producto que se te vende','product sold'); 
      }
  }else{
        $this->webservice_model->user_apk_notification($register_userid, $user_message_apk);  
  }
  
        $data = $this->webservice_model->get_where('product',$arr_get);
        $ressult['result']='sold successfull';
        $ressult['message']='successfull';
        $ressult['status']='1';
        $json = $ressult;
      }
      else
      {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessfull';
                          $ressult['status']='0';
                          $json = $ressult;
      }

      header('Content-type: application/json');
      echo json_encode($json);

                          

    }
    
    
   

    /*************  get_count *************/
    //number_format($distance,2);
  public

  function get_count()
    {
      $user_id = $this->input->get_post('user_id');
      $login_id = $user_id;

         $fetch = $this->db->query("select * from product WHERE buy_user_id = '$user_id'")->result_array();
         $fetch1 = $this->db->query("select * from product WHERE user_id = '$user_id' AND delete_status = 'no'")->result_array();
         $fetch2 = $this->db->query("select * from product WHERE user_id = '$user_id' AND status = 'Pending'")->result_array();
         $fetch3 = $this->db->query("select * from product WHERE user_id = '$user_id' AND status = 'Sold'")->result_array();

        $productIds = $this->db->query("SELECT GROUP_CONCAT(id) as ids FROM  product where  status = 'sold' AND user_id = '$login_id' || buy_user_id = '$login_id' order by id desc")->result_array();

         $ids = array();
         $productIdsString = array();
         $avgRating        = '0.0';
         if($productIds){
             $ids = explode(',', $productIds[0]['ids']);
             $productIdsString = $productIds[0]['ids'];
         }

         $fetch4 = $this->db->select('*')->where_in('product_id', $ids )->get('rating');
         $fetch4 = $fetch4->result_array();

         $get = $this->db->select_avg("rating", "rating")->where(['product_user_id'=>$user_id])->get('rating')->result_array();

        if($productIdsString){
            $avgRating = $this->db->query("SELECT avg(rating) as rating from rating where product_id in ($productIdsString)")->result_array();
            if($avgRating){
              $avgRating = $avgRating[0]['rating'];
            }        
        }
          
         $rating = ($get[0]['rating']=='') ?  0 : $get[0]['rating'];   

         $ratingCount = 0;
        
         if(count($fetch4) > 0)
         foreach ($fetch4 as $key => $value) {
            if($value['user_id'] == $login_id){
               continue;
            }
            $ratingCount++;
         }

         $ressult['product_buy_count'] = count($fetch);
         $ressult['users_total_product'] = count($fetch1);
         $ressult['users_pending_product'] = count($fetch2);
         $ressult['users_sold_product'] = count($fetch3);
     //    $ressult['review_count'] = count($fetch4);
         $ressult['review_count'] = $ratingCount;
     //  $ressult['rating'] = number_format($rating,1);
         $ressult['rating'] = number_format($avgRating,1);

         $ressult['message'] = 'successful';
         $ressult['status'] = '1';
         $ressult['subscribe_status'] = '0';
         $json = $ressult;
    

    header('Content-type: application/json');
    echo json_encode($json);
    }

 
/************** delete_product_image ****************/
   public function delete_product_image(){

    $position = $this->input->get_post('position', TRUE);

$arr_id = ['id'=>$this->input->get_post('product_id', TRUE)];

$arr_data = [$position=>''];

$res = $this->webservice_model->update_data('product', $arr_data, $arr_id);

       //echo $this->db->last_query();
    if($res){
          
          $ressult['result']="successfuly";
          $ressult['message']='successfull';
          $ressult['status']='1';
          $json = $ressult;
      }else{
          
          $ressult['result']="Data not found";
          $ressult['message']='unsuccessfull';
          $ressult['status']='0';
          $json = $ressult;
   }


 header('Content-type: application/json');
echo json_encode($json);

}





         
/***************add_update_like*****************/
public

function add_update_like()
  {
    
   $arr_login = array(
    'user_id' => $this->input->get_post('user_id', TRUE) ,
    'product_id' => $this->input->get_post('product_id', TRUE)
  ); 
        
       // print_r($arr_login);
   $arr_product = array(
    'product_id' => $this->input->get_post('product_id', TRUE) ,
    'like' => "1"
  );
  $fetch = $this->webservice_model->get_where('like', $arr_login);
  $like = $fetch[0]['like'];
  if ($like == 0)
    {
    $arr_data = array(
      'user_id' => $this->input->get_post('user_id', TRUE) ,
      'product_id' => $this->input->get_post('product_id', TRUE) ,
      'like' => "1"
    );
    }
    else
    {
    $arr_data = array(
      'user_id' => $this->input->get_post('user_id', TRUE) ,
      'product_id' => $this->input->get_post('product_id', TRUE) ,               
      'like' => "0"
    );
    }
         //     print_r($arr_data);
  if ($fetch)
    {
    $res = $this->webservice_model->update_data('like', $arr_data, $arr_login);
                $num_count = $this->webservice_model->getwhere_num_rows('like', $arr_product);
               
               
    $single_data = array(
      'user_id' => $this->input->get_post('user_id', TRUE) ,
      'product_id' => $this->input->get_post('product_id', TRUE)
    );
    }
    else
    {
    $res = $this->webservice_model->insert_data('like', $arr_data);
                $num_count = $this->webservice_model->getwhere_num_rows('like', $arr_product);
               
               
    $single_data = array(
      'id' => $res
    );
    }
               // print_r($single_data);

  if ($res)
    {
    
    $fetch = $this->webservice_model->get_where('like', $single_data);
    $fetch[0]['like_count'] = "$num_count";
    
                $ressult['result']=$fetch[0];
                $ressult['message']='successfull';
                $ressult['status']='1';
                $json = $ressult;

    }

    else
    {
    $json = array(
      "result" => "unsuccessful"
    );
    }  

  header('Content-type: application/json');
  echo json_encode($json);
  die;
   }

   /***************get_product_detail *****************/
  public

  function get_product_detail()
  {

      $user_id = $this->input->get_post('user_id');

  $arr_login = array(
    'id' => $this->input->get_post('product_id', TRUE)
  );

  /*Check Login*/
  $login = $this->webservice_model->get_where('product', $arr_login);

  // print_r($login);

  if ($login) {

         $arr_gets1 = ['product_id' => $login[0]['id'],'user_id' => $user_id];
   $login1 = $this->webservice_model->get_where('like', $arr_gets1);
          if($login1){

                 $login[0]['like'] = $login1[0]['like'];

                }else{

                 $login[0]['like'] = '0';

                  }



if($login[0]['image']){
         $login[0]['image'] = SITE_URL . 'uploads/images/' . $login[0]['image'];
}
if($login[0]['image1']){
         $login[0]['image1'] = SITE_URL . 'uploads/images/' . $login[0]['image1'];
}
if($login[0]['image2']){
         $login[0]['image2'] = SITE_URL . 'uploads/images/' . $login[0]['image2'];
}
if($login[0]['image3']){
         $login[0]['image3'] = SITE_URL . 'uploads/images/' . $login[0]['image3'];
}


    $data['result'] = $login[0];
    $data['message'] = 'successfull';
    $data['status'] = '1';
    $json = $data;
  }
  else {
    $data['result'] = 'unsuccessfull';
    $data['message'] = 'data not found';
    $data['status'] = '0';
    $json = $data;
  }

  header('Content-type: application/json');
  echo json_encode($json);
  }


         
/***************add_to_cart_product*****************/
public

function add_to_cart_product()
  {
    
   $arr_login = array(
    'user_id' => $this->input->get_post('user_id', TRUE) ,
    'product_id' => $this->input->get_post('product_id', TRUE),
    'status' => 'Pending'

  ); 
        
   $arr_product = array(
    'user_id' => $this->input->get_post('user_id', TRUE) ,
    'product_id' => $this->input->get_post('product_id', TRUE) ,
    'quantity' => $this->input->get_post('quantity', TRUE)
  );

  $fetch = $this->webservice_model->get_where('add_to_cart', $arr_login);
  
    
  if ($fetch)
    {
                            $arr_gets = ['id'=>$arr_product['product_id']];
                            $product = $this->webservice_model->get_where('product',$arr_gets);  

                            $available = $product[0]['available'];
                            $soldOut = $product[0]['soldOut'];
                            $rem = $available - $soldOut;
                            
                       if($arr_product['quantity'] != '1' && $rem > $fetch[0]['quantity']){
                           
                            $update_qua = $fetch[0]['quantity'] + $arr_product['quantity'];

                          $res = $this->webservice_model->update_data('add_to_cart',  ['quantity'=>$update_qua], $arr_login);
              
  
                        $ressult['quantity']=$update_qua;

                          $ressult['result']="update cart successfull";
                            $ressult['message']='successfull';
                            $ressult['status']='1';
                            $json = $ressult;
                            header('Content-type: application/json');
                          echo json_encode($json);
                          die;
                           
                           
                       }
                if($rem > $fetch[0]['quantity']){
                

                            $update_qua = $fetch[0]['quantity'] + 1;

                          $res = $this->webservice_model->update_data('add_to_cart',  ['quantity'=>$update_qua], $arr_login);
              
  
                        $ressult['quantity']=$update_qua;

                          $ressult['result']="update cart successfull";
                            $ressult['message']='successfull';
                            $ressult['status']='1';
                            $json = $ressult;
                            header('Content-type: application/json');
                          echo json_encode($json);
                          die;
                                
                            }else{
                                
                            $ressult['result']= "Only ".$rem." product is available";
                            $ressult['message']='unsuccessfull';
                            $ressult['status']='0';
                            $json = $ressult;
                            header('Content-type: application/json');
                          echo json_encode($json);
                          die;    
                                
                            }

  

    }

           else{
    
                $id = $this->webservice_model->insert_data('add_to_cart',$arr_product);

                if($id=="") {
                    $json = ['result'=>'unsuccessfull','status'=>0,'message'=>'data not found'];
                }else{
                        /*    $arr_gets = ['id'=>$arr_product['product_id']];
                            $product = $this->webservice_model->get_where('product',$arr_gets);  

                            $qua = $arr_product['quantity'];
                            $sol = $product[0]['soldOut'];      

                            $up_sol =  $sol + $qua;

                            $arr_qua = array(
                'soldOut' => $up_sol ,
                      );


                         $this->webservice_model->update_data('product',$arr_qua, $arr_gets);  */

                $ressult['quantity']="1";
                $ressult['result']="add to cart successfull";
                $ressult['message']='successfull';
                $ressult['status']='1';
                $json = $ressult;
                header('Content-type: application/json');
          echo json_encode($json);
          die;

                }


               }           
   

          header('Content-type: application/json');
          echo json_encode($json);
          die;
   }


 /*************  get_cart *************/
  public

  function get_cart()
    {
       $arr_login = array(
    'user_id' => $this->input->get_post('user_id', TRUE) ,
    'status' => 'Pending'

  ); 
        
  
  $fetch = $this->webservice_model->get_where('add_to_cart', $arr_login);
  
    
  
    if ($fetch)
      {
       foreach($fetch as $val)

        {
         $where1 = ['id'=>$val['product_id']];
         $fetch1 = $this->webservice_model->get_where('product',$where1);
         $fetch1[0]['image'] = SITE_URL . 'uploads/images/' . $fetch1[0]['image'];
         $val['product_details'] = $fetch1[0];

 $arr_offer = ['id' => $fetch1[0]['offer_id']];
   $offers = $this->webservice_model->get_where('offers', $arr_offer);
if($offers){
             $offers[0]['image'] = SITE_URL . 'uploads/images/' . $offers[0]['image'];

           $val['offer_details'] = $offers[0];

    
}else{
    
               $val['offer_details'] = [];

    
}


         $data[] = $val;
        }

         $ressult['result'] = $data;
         $ressult['message'] = 'successful';
         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
        $ressult['result'] = 'Data Not Found';
        $ressult['message'] = 'unsuccessful';
        $ressult['status'] = '0';
        $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }



                /************* delete_cart_item *************/
    public

    function delete_cart_item()
    {
                  $id = $this->input->get_post('cart_id');
                  $list = $this->webservice_model->get_where('add_to_cart',['id'=>$id]);

      if ($list)
      {
        $this->webservice_model->delete_data('add_to_cart',['id'=>$id]);

                          $ressult['result']="Item delete successfull";
                          $ressult['message']='successful';
                          $ressult['status']='1';
                          $json = $ressult;
      }
        else
      {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessful';
                          $ressult['status']='0';
                          $json = $ressult;                              
        
      }

        
                     
      header('Content-type: application/json');
      echo json_encode($json);
    }


/***************add_to_card_details*****************/
public

function add_to_card_details()
  {
    
    
        
   $arr_product = array(
    'user_id' => $this->input->get_post('user_id', TRUE) ,
    'card_no' => $this->input->get_post('card_no', TRUE) ,
    'exp_date' => $this->input->get_post('exp_date', TRUE) ,
    'cvv' => $this->input->get_post('cvv', TRUE) ,
    'holder_name' => $this->input->get_post('holder_name', TRUE)
  );

  $fetch = $this->webservice_model->insert_data('cart_details', $arr_product);
  
    
  if ($fetch)
    {
  
          $ressult['result']="successfull";
                $ressult['message']='successfull';
                $ressult['status']='1';
                $json = $ressult;
                header('Content-type: application/json');
          echo json_encode($json);
          die;

    }

          
   } 

                 
 
 /*************  get_card_details *************/
  public

  function get_card_details()
    {
      $user_id = $this->input->get_post('user_id');

      $fetch = $this->db->query("select * from cart_details WHERE user_id = '$user_id'")->result_array();

    if ($fetch)
      {
       foreach($fetch as $val)

        {

         $data[] = $val;
        }

         $ressult['result'] = $data;
         $ressult['message'] = 'successful';
         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
        $ressult['result'] = 'Data Not Found';
        $ressult['message'] = 'unsuccessful';
        $ressult['status'] = '0';
        $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }




/************* verify_email function *************/

    public function verify_email(){

      $arr_get = ['id'=>$this->input->get_post('user_id')];

      $login = $this->webservice_model->get_where('users',$arr_get);
      if ($login[0]['id'] == "")
      {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessfull';
                          $ressult['status']='0';
                          $json = $ressult;

                               
      }



       $arr_data = [
            
              'verify_status'=>'1'
            ];

                     

      $res = $this->webservice_model->update_data('users',$arr_data,$arr_get);
      if ($res)
      {
        $this->load->view('admin/verify_email');
        $data = $this->webservice_model->get_where('users',$arr_get);
      
        $ressult['result']='your account verify successfully';
        $ressult['message']='successfull';
        $ressult['status']='1';
        $json = $ressult;
      }
      else
      {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessfull';
                          $ressult['status']='0';
                          $json = $ressult;
      }

     

                          

    }


    /**************************** update_cart ****************************************/
  public

  function update_cart()
  {
    $cart_id = $this->input->get_post('cart_id', TRUE);
    $arr_login = array(
      'id' => $this->input->get_post('cart_id', TRUE)
    );
    
    $arr_data = ['quantity' => $this->input->get_post('quantity')];


    $details = $this->webservice_model->get_where("add_to_cart", $arr_login);
    if($details==false){
      $json = ['result' => 'unsuccessfull', 'status' => 0, 'message' => 'data not found'];
      echo json_encode($json); die; 
    }
    
                        $arr_gets = ['id'=>$details[0]['product_id']];
                            $product = $this->webservice_model->get_where('product',$arr_gets);  

                            $available = $product[0]['available'];
                            $soldOut = $product[0]['soldOut'];
                            $rem = $available - $soldOut;
                            $quantity = $arr_data['quantity'];

                if($rem >= $quantity){
                

                        $update = $this->webservice_model->update_data("add_to_cart",$arr_data, $arr_login);
              
  
                        $ressult['quantity']=$quantity;

                          $ressult['result']="update cart successfull";
                            $ressult['message']='successfull';
                            $ressult['status']='1';
                            $json = $ressult;
                            header('Content-type: application/json');
                          echo json_encode($json);
                          die;
                                
                            }else{
                                
                            $ressult['result']="Only ".$rem." product is available";
                            $ressult['message']='unsuccessfull';
                            $ressult['status']='0';
                            $json = $ressult;
                            header('Content-type: application/json');
                          echo json_encode($json);
                          die;
                                
                            }
     

    header('Content-type: application/json');
    echo json_encode($json);
  }


    /*************  place_order *************/
    public

    function place_order()
    {                     
                          
      $arr_data = array(  

        'user_id'   => $this->input->get_post('user_id'),
        'full_name' => $this->input->get_post('full_name'), 
        'address'   => $this->input->get_post('address'), 
        'mobile'    => $this->input->get_post('mobile'),
        'country'   => $this->input->get_post('country'), 
        'state'     => $this->input->get_post('state'), 
        'city'      => $this->input->get_post('city'),
        'zip_code'  => $this->input->get_post('zip_code')   
                                  
      );
      
  //  $ticket_number = $this->input->get_post('ticket_number', TRUE);

       
      $where = ['user_id'=>$arr_data['user_id']];
      
      $fetch = $this->webservice_model->get_where('user_address',$where);
      $user = $this->webservice_model->get_where('users',['id'=>$arr_data['user_id']]);

      if($fetch){
       
        $this->webservice_model->update_data('user_address',$arr_data,$where);
        $address_id = $fetch[0]['id'];

      }else{

        $address_id = $this->webservice_model->insert_data('user_address', $arr_data);

      }

     $order_id = $this->webservice_model->generateRandomString(8);      

     $arr_ord = array(
      'user_id' => $this->input->get_post('user_id'),
      'cart_id' => $this->input->get_post('cart_id'), 
      'address_id' => $address_id,  
      'order_id' => $order_id                                
     );

     $place_id = $this->webservice_model->insert_data('place_order', $arr_ord);
     
            
      if ($place_id != "") {
          
          
          
            $cart_id = $this->input->get_post('cart_id', TRUE);

                          //$ticket = explode(",",$ticket_number);
                          
                        
                          $single_data = ['id' => $place_id];

                          $fetch_order = $this->webservice_model->get_where('place_order',$single_data); 
                         
                          $json = ['result' => $fetch_order[0], 'status' => 1, 'message' => 'successfull'];                    
                         

      }
      else {
                          $json = ['result' => 'unsuccessfull', 'status' => 0, 'message' => 'unsuccessfull'];
      }

      header('Content-type: application/json');
      echo json_encode($json);
    }

    /*************  payment *************/
    public

    function payment()
    {           
       
        
      $arr_data = array(
        'user_id' => $this->input->get_post('user_id'),
        'order_id' => $this->input->get_post('order_id'), 
        'payment_method' => $this->input->get_post('payment_method'), 
        'token' => $this->input->get_post('token'), 
        'total_amount' => $this->input->get_post('total_amount')                           
      );

                      
      $token = $this->input->get_post('token');
      $currency = $this->input->get_post('currency');
      
  $url = 'https://api.stripe.com/v1/charges';
        $fields = [
            'currency' => $currency,
            'amount' => ($arr_data['total_amount']*100),            
            'source' => $token,            
            'metadata' => ['order_id'=>$arr_data['order_id']]
        ];

        $fields_string = http_build_query($fields);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/charges");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, "sk_test_QM0nW8g8KruPeyya2MloMUHq" . ":" . "");

       $headers = array();
       $headers[] = "Content-Type: application/x-www-form-urlencoded";
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

       $response = curl_exec($ch);  
       $response = json_decode($response);
       
       if (isset($response->error)) {
          $ressult['result']=$response;
          $ressult['message']='unsuccessful';
          $ressult['status']='0';
          $json = $ressult;
          header('Content-type: application/json');
          echo json_encode($json);die;
         
       }

       curl_close ($ch);  
      


      $pay = $this->webservice_model->insert_data('payment', $arr_data);

      $this->webservice_model->update_data('place_order',['status'=>'Complete'],['order_id'=>$arr_data['order_id']]);
                  
      $get_order = $this->webservice_model->get_where('place_order',['order_id'=>$arr_data['order_id']]);
                                                
      $cart_ids = $get_order[0]['cart_id'];
            
      $this->webservice_model->update_data('add_to_cart',['status'=>'Complete'],"id IN($cart_ids)");

      
      if ($pay != "") {


      
$order_id = $arr_data['token'];

$date_time = date('Y-m-d H:i:s');
$method = $arr_data['payment_method'];
$total_amount = $arr_data['total_amount'];


                          $single_data = ['id' => $pay];

                          $fetch_order = $this->webservice_model->get_where('payment',$single_data); 
 
   
$aa = (explode(",",$cart_ids));
foreach($aa as $val1)
             {

                        $arr_where = ['id' => $val1];
                        $this->webservice_model->update_data('add_to_cart', ['status'=>'Complete'], $arr_where);
                        
                            $cart = $this->webservice_model->get_where('add_to_cart',$arr_where);  

                            $arr_pro = ['id'=>$cart[0]['product_id']];
                            $product1 = $this->webservice_model->get_where('product',$arr_pro);  
                        
                            $sold = $cart[0]['quantity'] + $product1[0]['soldOut'];
                            
                              $arr_sold =  ['soldOut'=>$sold]; 
                               
                            
                            $this->webservice_model->update_data('product', $arr_sold, $arr_pro);


                   }
                   
                         $get_order = $this->webservice_model->get_where('place_order',['order_id'=>$arr_data['order_id']]);
                         
            $cart = $get_order[0]['cart_id'];

            $aa1 = (explode(",",$cart));
/*foreach($aa1 as $val11)
             {

                        $arr_where1 = ['cart_id' => $val11];
                        $this->webservice_model->update_data('ticket_numbers', ['status'=>'Pending'], $arr_where1);
                        


                   }*/
                        
            
                          foreach($aa1 as $val)
                   {
                       $zz = $this->webservice_model->get_where('add_to_cart',['id'=>$val]);

                       $zz1 = $this->webservice_model->get_where('ticket_numbers',['product_id'=>$zz[0]['product_id'],'cart_id'=>'']);
                       $qq = $zz[0]['quantity'];
                       if($zz1){
                                $count = 0;
                               foreach($zz1 as $val1)
                      {
                           if($count < $qq){
                                  
                       $arr_ticket = array(
                               'user_id' => $this->input->get_post('user_id'),
                               'cart_id' => $val,
                               'status' => 'Pending' 
                              );
                             $this->webservice_model->update_data('ticket_numbers',$arr_ticket,['id'=>$val1['id']]);

                                  
                                                   
                           }
                     
                              $count++;
                      }
                     
                       }
                   }
                                
                        
                          
                   
                   
                        $arr_where12 = ['order_id' => $fetch_order[0]['order_id']];
                        $this->webservice_model->update_data('place_order', ['status'=>'Pending'], $arr_where12);


                          $users = $this->webservice_model->get_where('users',['id'=>$arr_data['user_id']]);
                          
                          $email = $users[0]['email'];
        $tr= '';   
       
        foreach($aa1 as $val11)
             {

                        $arr_where1 = ['id' => $val11];
                        $get_card =  $this->webservice_model->get_where('add_to_cart', $arr_where1);
                        
                        $arr_where11 = ['id' => $get_card[0]['product_id']];
                        $product =  $this->webservice_model->get_where('product', $arr_where11);
                        $amount = $get_card[0]['quantity'] * $product[0]['price'];
                        $tr .= "<tr><td style='border-bottom: 1px dotted #bdb7b7;'>".$product[0]['product_name']."<span>  x  ".$get_card[0]['quantity']."</span></td>
          <td>AED ".$amount."</td></tr>";

                   }
                        
                          
        $to = $email;
        $subject = "order placed successfully";
        $body = "<body style='background-color: #f1f1f1;'>


<section  style='background-color: #fff;
    padding: 25px 15px;
    width:50%;
    margin: 0 auto;'>
<img src='".SITE_URL."uploads/images/logo.png' style='display: block;
    margin: 0 auto;    width: 39%;'>  
   <h3 style='    font-family: Arial,Helvetica,sans-serif;
    text-align: center;
    font-size: 19px;
    font-weight: 300;
    /* margin: 5px 0; */
    margin-top: 25px;
    margin-bottom: 6px;'>Thank you for your purchase!</h3> 
 <!--   <p style=' font-family: Arial,Helvetica,sans-serif;   text-align: center;
    margin: 0;
    padding: 0;
    font-size: 13px;'>Your prize draw tickets can be viewed in the PDF attached.</p> -->

    <p style='     color: #4a4a4a;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 15px;
    letter-spacing: -.3px;
    line-height: 23px;
    margin-bottom: 30px;
    text-align: center;
    margin-top: 37px;'>BigPaya Enterprises LLC <br>
902, The Maze Tower - Dubai</p>
<p style='text-align: center;'> <span style='    color: #4a4a4a;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 16px;
    letter-spacing: -.3px;
    line-height: 24px;
    margin-bottom: 30px;
    text-align: center;'> Transaction no </span> <br> <span style='    color: #4a4a4a;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 22px;
    font-weight: 700;
    letter-spacing: -.5px;
    line-height: 18px;
    margin-bottom: 30px;
    text-align: center;'>".$order_id."</span></p>

    <p style='    color: #696969;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 11px;
    letter-spacing: -.2px;
    margin-bottom: 20px;
    text-align: center;'>Date : ".$date_time." &nbsp;&nbsp;&nbsp;&nbsp; Payment Method: ".$method."</p>

<table class='table' style='width: 100%;'>
    <thead style=''>
      <tr>
        <th style='text-align: left;
       font-size: 16px;
    color: #000000; border-bottom: 1px dotted #bdb7b7;
    padding-bottom: 8px;
    font-family: Arial,Helvetica,sans-serif;'>Product</th>
    
   
        <th style='text-align: right;
       font-size: 16px;
    color: #000000; border-bottom: 1px dotted #bdb7b7;
    padding-bottom: 8px;    font-family: Arial,Helvetica,sans-serif;
'>Total</th>
      </tr>
    </thead>
    <tbody>
    
       ".$tr."
     

      <tr>
      <td style='    color: #696969;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: -.3px;
    text-align: left;    padding: 17px 0;
 '><strong>Total</strong></td>  
      <td style='    color: #696969;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 16px;
    font-weight: 700;
    letter-spacing: -.3px;
    text-align: right;    padding: 17px 0;
   '><strong>AED ".$total_amount."</strong></td>  
      </tr>

      <tr>
        <td style='color: #696969;

    font-family: Arial,Helvetica,sans-serif;
    font-size: 14px;
    letter-spacing: -.3px;
    text-align: left;border-bottom: 1px dotted #bdb7b7;padding-bottom: 25px;'>Discount(paid in i-Points)</td>
        <td style='    color: #696969;
  
    font-family: Arial,Helvetica,sans-serif;
    font-size: 16px;
    letter-spacing: -.3px;
    text-align: right;border-bottom: 1px dotted #bdb7b7;padding-bottom: 25px;
  '>AED 0.00</td>
      </tr>

      <tr>
        <td style='color: #696969;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 14px;
    letter-spacing: -.3px;
    text-align: left;padding-top: 15px;border-bottom: 1px solid #efefef;'>Total Products</td>
        <td style='color: #696969;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 16px;
    letter-spacing: -.3px;
    text-align: right;padding-top: 15px;  border-bottom: 1px solid #efefef;padding-bottom: 16px;'>1</td>
      </tr>

    




    
    </tbody>
  </table>

<div style=' content: '';
    clear: both;
    display: table;'>
   <ul style='padding: 0px;clear: both;    width: 100%;
    text-align: center;'>
     <li style='list-style: none;display: inline-block;padding-left: 10px;'><a href='#'><img style='    border: 1px solid #7e7e7e;
    border-radius: 100%;' src='f.png'></a></li>
     <li style='list-style: none;display: inline-block;padding-left: 10px;'><a href='#'><img style='    border: 1px solid #7e7e7e;
    border-radius: 100%;' src='t.png'></a></li>
     <li style='list-style: none;display: inline-block;padding-left: 10px;'><a href='#'><img style='    border: 1px solid #7e7e7e;
    border-radius: 100%;' src='li.png'></a></li>
     <li style='list-style: none;display: inline-block;padding-left: 10px;'><a href='#'><img style='    border: 1px solid #7e7e7e;
    border-radius: 100%;' src='is.png'></a></li>
     <li style='list-style: none;display: inline-block;padding-left: 10px;'><a href='#'><img style='    border: 1px solid #7e7e7e;
    border-radius: 100%;' src='pl.png'></a></li>
      </ul>
</div>

<p style='    color: #4a4a4a;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 15px;
    font-weight: 400;
    letter-spacing: -.3px;
    text-align: center;
    margin-top: 25px;'>For the ultimate shopping experience download our app.</p>


<div style='
     margin-top: 41px; content: '';
    clear: both;
    display: table;'>
  <ul style='padding: 0px;clear: both;    width: 100%;
    text-align: center;'>
     <li style='list-style: none;display: inline-block;padding-left: 10px;'><a href='#'><img src='app.jpg'></a></li>
     <li style='list-style: none;display: inline-block;padding-left: 10px;'><a href='#'><img src='google.jpg'></a></li>
 
      </ul>
</div>

</section>


</body>";

        $headers = "From: info@mobileappdevelop.co" . "\r\n";
        $headers.= "MIME-Version: 1.0" . "\r\n";
        $headers.= "Content-type:text/html;charset=UTF-8" . "\r\n";

        mail($to, $subject, $body, $headers);
  
                   
                   

                          $json = ['result' => $response, 'status' => 1, 'message' => 'successfull'];                          
                          
      }
      else {
                          $json = ['result' => 'unsuccessfull', 'status' => 0, 'message' => 'unsuccessfull'];
      }

                         header('Content-type: application/json');
                         echo json_encode($json);
    }





       /************* add_feedback function *************/
  public

  function add_feedback()
    {
    $arr_data = [
   
                      'name' => $this->input->get_post('name') ,
                      'email' => $this->input->get_post('email') ,
                      'message' => $this->input->get_post('message') ,
                      'type' => $this->input->get_post('type') 

              ];


    $id = $this->webservice_model->insert_data('feedback', $arr_data);
    if ($id == "")
      {
      $json = ['result' => 'unsuccessfull', 'status' => 0, 'message' => 'data not found'];
      }
      else
      {


      $arr_gets = ['id' => $id];
      $login = $this->webservice_model->get_where('feedback', $arr_gets);
      

      $ressult['result'] = $login[0];
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }

    header('Content-type:application/json');
    echo json_encode($json);
    }


 /*************  get_user_tickets *************/
  public

  function get_user_tickets()
    {
      $user_id = $this->input->get_post('user_id');

      $fetch = $this->db->query("select * from ticket_numbers WHERE user_id = '$user_id'")->result_array();

    if ($fetch)
      {
       foreach($fetch as $val)

        {
            
         $arr_get = ['id' => $val['cart_id']];

         $login = $this->webservice_model->get_where('add_to_cart',$arr_get);
      
         $arr_get1 = ['id' => $login[0]['product_id']];

         $login1 = $this->webservice_model->get_where('product',$arr_get1);
      
         $arr_get2 = ['id' => $login1[0]['offer_id']];

         $login2 = $this->webservice_model->get_where('offers',$arr_get2);
         
         $arr_get3 = ['id' => $login1[0]['cat_id']];

         $login3 = $this->webservice_model->get_where('category',$arr_get3);
       
         $login2[0]['image']=SITE_URL.'uploads/images/'.$login2[0]['image'];

         $val['category_name']  = $login3[0]['category_name'];
         $val['offer_details'] = $login2[0];
         
         $data[] = $val;
        }

         $ressult['result'] = $data;
         $ressult['message'] = 'successful';
         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
        $ressult['result'] = 'Data Not Found';
        $ressult['message'] = 'unsuccessful';
        $ressult['status'] = '0';
        $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }
    

 /*************  get_tickets *************/
  public

  function get_tickets()
    {
      $order_id = $this->input->get_post('order_id');

      $fetch = $this->db->query("select * from place_order WHERE order_id = '$order_id' AND status = 'Pending'")->result_array();

    if ($fetch)
      {
       
                        
            $cart = $fetch[0]['cart_id'];

            $aa1 = (explode(",",$cart));
            $detail = [];
foreach($aa1 as $val)
             {

                       $arr_where1 = ['cart_id' => $val];
                       $ticket = $this->webservice_model->get_where('ticket_numbers', $arr_where1);
                       
                       
                       

                       
                       
foreach($ticket as $tkt)
             {
                 
               $arr_get = ['id' => $val];

               $login = $this->webservice_model->get_where('add_to_cart',$arr_get);

               $arr_get1 = ['id' => $login[0]['product_id']];

               $login1 = $this->webservice_model->get_where('product',$arr_get1);

               $arr_get2 = ['id' => $login1[0]['offer_id']];

               $login2 = $this->webservice_model->get_where('offers',$arr_get2);
               
              

               
           
                $login2[0]['image']=SITE_URL.'uploads/images/'.$login2[0]['image'];
                       
                  $arr_get3 = ['id' => $login1[0]['cat_id']];
                  $login3 = $this->webservice_model->get_where('category',$arr_get3);
                 $tkt['category_name'] = $login3[0]['category_name'];        

                $tkt['offer_details'] = $login2[0];
                 $detail[] = $tkt;
             }
                        
                       $data[] = $ticket;


                   }  
            
            


         $ressult['result'] = $detail;
         $ressult['message'] = 'successful';
         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
        $ressult['result'] = 'Data Not Found';
        $ressult['message'] = 'unsuccessful';
        $ressult['status'] = '0';
        $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }



  /************* update_reserve_status function *************/
  public

  function update_reserve_status()
    {
    $arr_get = ['id' => $this->input->get_post('product_id') ];
    $login = $this->webservice_model->get_where('product', $arr_get);
    if ($login[0]['id'] == "")
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      header('Content-type:application/json');
      echo json_encode($json);
      die;
      }

    $arr_data = ['reserve_status' => $this->input->get_post('reserve_status')];
    $res = $this->webservice_model->update_data('product', $arr_data, $arr_get);
    if ($res)
      {
      $data = $this->webservice_model->get_where('product', $arr_get);
      $ressult['result'] = $data[0];
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }



      /************* add_review_rating function *************/

    public function add_rating_review(){

       $arr_data = [
            'user_id'=>$this->input->get_post('user_id'),
            'product_user_id'=>$this->input->get_post('product_user_id'),
            'product_id'=>$this->input->get_post('product_id'),
            'rating'=>$this->input->get_post('rating'),
            'review'=>$this->input->get_post('review')        
       ];

    $arr_get = ['user_id' => $arr_data['user_id'],'product_id' => $arr_data['product_id']];
    $login = $this->webservice_model->get_where('rating', $arr_get);
    if ($login)
      {
      $ressult['result'] = 'already exist';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      header('Content-type:application/json');
      echo json_encode($json);
      die;
      }

      $id = $this->webservice_model->insert_data('rating',$arr_data);

      if ($id=="") {
        $json = ['result'=>'unsuccessfull','status'=>0,'message'=>'data not found'];
      }else{
         $arr_gets = ['id'=>$id];
        $login = $this->webservice_model->get_where('rating',$arr_gets); 
        
  $product  = $this->webservice_model->get_where('product', ['id' => $arr_data['product_id']]);

 
  $buser_user_id  = $product[0]['buy_user_id'];
  $seller_user_id = $product[0]['user_id'];
  
  if($arr_data['user_id'] == $seller_user_id){
    $sender_id = $buser_user_id;
  }else{
    $sender_id = $seller_user_id;
  }

  $user_r   = $this->webservice_model->get_where('users', ['id' => $sender_id]);

  $user_message_apk = array(
    "message" => array(
      "result" => "successful",
      "key" => "new rating review",
      "message" => "new rating review",
      "date" => date('Y-m-d h:i:s')
    )
  );


  $register_userid = array(
    $user_r[0]['register_id']
  );

//  $this->webservice_model->user_apk_notification($register_userid, $user_message_apk);
  
  if($user_r[0]['device_type'] == 1){
      if($user_r[0]['device_token']){
          $this->ios_notification($user_r[0]['device_token'],$user_message_apk,'','Tienes nueva valoraci???n y rese???a','new rating review'); 
      }
  }else{
        $this->webservice_model->user_apk_notification($register_userid, $user_message_apk);  
  }

        $ressult['result']=$login[0];
        $ressult['message']='successfull';
        $ressult['status']='1';
        $json = $ressult;
      }

      header('Content-type:application/json');
      echo json_encode($json);

    }


  /***************get_rating_review *****************/
  public

  function get_rating_review()
    {
    
      $product_user_id = $this->input->get_post('product_user_id', TRUE);
      $login_id        = $product_user_id;
  //  $query = "SELECT * FROM rating WHERE product_user_id = '$product_user_id' order by id desc ";
    #echo "select * from rating  WHERE product_user_id = '$product_user_id' or user_id = '$product_user_id' order by id desc";die;
     $productIds = $this->db->query("SELECT GROUP_CONCAT(id) as ids FROM  product where  status = 'sold' AND user_id = '$login_id' || buy_user_id = '$login_id' order by id desc")->result_array();

      if(empty($productIds)){        
         $data['result']['errorMsg'] = 'No Request Found';
        $data['message'] = 'unsuccessfull';
        $data['status'] = '0';
        $json = $data;
        header('Content-type: application/json');
        echo json_encode($json);
      }

      $ids = array();
     if($productIds){
        $ids = explode(',', $productIds[0]['ids']);
     }

     $fetch = $this->db->select('*')->where_in('product_id', $ids )->order_by('date','DESC')->get('rating');
     $fetch = $fetch->result_array();

    if ($fetch )
      {
       foreach($fetch as $val)
        {
         
         $product_id = $val['product_id'];
         $product    = $this->db->query("select * from product WHERE id = '$product_id'")->result_array();
        
         $seller_id = $product[0]['user_id'];
         $buyer_id  = $product[0]['buy_user_id'];

         $val['date'] = date('d-m-Y',strtotime($val['date']));

          if($val['user_id'] == $login_id){
             continue;
          }

          if($seller_id == $login_id){
              $user_id = $buyer_id;
           }

           if($buyer_id == $login_id){
              $user_id = $seller_id;
           }

        $where = ['id' => $user_id];
        $login = $this->webservice_model->get_where('users', $where);
        $login[0]['image'] = SITE_URL.'uploads/images/'.$login[0]['image'];
        $login[0]['user_image'] = $login[0]['image'];
        $login[0]['id'] = (String) $login[0]['id'];
        $login[0]['first_name'] = trim($login[0]['first_name']);
        $login[0]['last_name']  = trim($login[0]['last_name']);

        $val['user_details'] = $login[0];
       
        $where1 = ['id' => $val['product_id']];
        $login1 = $this->webservice_model->get_where('product', $where1);
        $login1[0]['image']=SITE_URL.'uploads/images/'.$login1[0]['image'];
        $val['product_name']  = trim($login1[0]['product_name']);
        
        if($login1[0]['user_id'] == $product_user_id){
       $login1[0]['final_status'] = 'sold';
       }else{
       $login1[0]['final_status'] = 'purchased';
    
       }
        
        $val['product_details'] = $login1[0];
        
        
        
        $ressult1[] = $val;
        }

      $data['result'] = $ressult1;
      $data['message'] = 'successfull';
      $data['status'] = '1';
      $json = $data;
      }
      else
      {
      $data['result']['errorMsg'] = 'No Request Found';
      $data['message'] = 'unsuccessfull';
      $data['status'] = '0';
      $json = $data;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }



 /*************  get_recently_product *************/
  public

  function get_recently_product()
    {
      $user_id = $this->input->get_post('user_id');

      $fetch = $this->db->query("select * from product WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 5 ")->result_array();
    if ($fetch)
      {
      foreach($fetch as $val)
        {

         $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
         $data[] = $val;
        }

         $ressult['result'] = $data;
         $ressult['message'] = 'successful';
         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
         $ressult['result'] = 'Data Not Found';
         $ressult['message'] = 'unsuccessful';
         $ressult['status'] = '0';
         $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }



 /************* user_like_product_list *************/
  public

  function user_like_product_list()
    {
      $user_id = $this->input->get_post('user_id');

      $fetch = $this->db->query("select * from `like` WHERE `user_id` = $user_id AND `like` = 1 ")->result_array();

    if ($fetch)
      {
       foreach($fetch as $val)

        {
            
            
         $where = ['id' => $val['product_id']];
         $login = $this->webservice_model->get_where('product', $where);


  $get = $this->db->select_avg("rating", "rating")->where(['product_user_id'=>$login[0]['user_id']])->get('rating')->result_array();

         $rating = ($get[0]['rating']=='') ?  0 : $get[0]['rating'];   






         $where1 = ['id' => $login[0]['user_id']];
         $login1 = $this->webservice_model->get_where('users', $where1);

         $login1[0]['user_image'] = SITE_URL . 'uploads/images/' . $login1[0]['image'];
         $login[0]['image'] = SITE_URL . 'uploads/images/' . $login[0]['image'];
         $login[0]['like'] = '1';
             $login1[0]['rating'] = number_format($rating,1);

         $login[0]['users_details'] = $login1[0];

         $val['product_details'] = $login[0];

         $data[] = $val;
        }

         $ressult['result'] = $data;
         $ressult['message'] = 'successful';
         $ressult['status'] = '1';
         $json = $ressult;
      }
      else
      {
        $ressult['result'] = 'Data Not Found';
        $ressult['message'] = 'unsuccessful';
        $ressult['status'] = '0';
        $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

    /***************get_product_detail1 *****************/
  public

  function get_product_detail1()
  {
  $arr_login = array(
    'id' => $this->input->get_post('product_id', TRUE)
  );

         $lat = $this->input->get_post('lat');
         $lon = $this->input->get_post('lon');

  /*Check Login*/
  $login = $this->webservice_model->get_where('product', $arr_login);

  // print_r($login);

  if ($login) {
    foreach($login as $val) {
      $where = ['id' => $val['user_id']];
      $fetch = $this->webservice_model->get_where('users', $where);
      if ($fetch) {
        $fetch[0]['image'] = SITE_URL . 'uploads/images/' . $fetch[0]['image'];
        $val['user_detail'] = $fetch[0];
        

           $distance = $this->webservice_model->distance($lat, $lon, $fetch[0]['lat'], $fetch[0]['lon'], $miles = false);



      }
      else {
        $val['user_detail'] = array();
      }
                        $val['distance'] = number_format($distance,2);
                        $val1 = [];
      $val1[] = ['image' => SITE_URL . 'uploads/images/' . $val['image']];
      $val1[] = ['image' => SITE_URL . 'uploads/images/' . $val['image1']];
      $val1[] = ['image' => SITE_URL . 'uploads/images/' . $val['image2']];
      $val1[] = ['image' => SITE_URL . 'uploads/images/' . $val['image3']];
                        $val['product_image'] = $val1;

      $ressult = $val;
      }

    $data['result'] = $ressult;
    $data['message'] = 'successfull';
    $data['status'] = '1';
    $json = $data;
  }
  else {
    $data['result'] = 'unsuccessfull';
    $data['message'] = 'data not found';
    $data['status'] = '0';
    $json = $data;
  }

  header('Content-type: application/json');
  echo json_encode($json);
  }

              /*************  get_filter_product *************/
    public

    function get_filter_product()
    {                     
                          
      $arr_data = array(
        'address' => $this->input->get_post('address'),
        'cat_id' => $this->input->get_post('cat_id'),
        'from_price' => $this->input->get_post('from_price') ,
        'to_price' => $this->input->get_post('to_price')                                
      );

      $get_where = "";

      $lat = $this->input->get_post('lat');
      $lon = $this->input->get_post('lon');
    

      $dist = $this->input->get_post('distance');

      if($arr_data['address']!=''){
         $get_where = "address = '".$arr_data['address']."'";
      }

      if($arr_data['cat_id']!=''){
         if($get_where==''){
           $get_where = "cat_id = '".$arr_data['cat_id']."'";
         }else{
           $get_where = $get_where." AND cat_id = '".$arr_data['cat_id']."'";
         }
      }

      if($arr_data['from_price']!=''){
         if($get_where==''){
           $get_where = "price >= ".$arr_data['from_price']."";
         }else{
           $get_where = $get_where." AND price >= ".$arr_data['from_price']."";
         }
      }

     if($arr_data['to_price']!=''){
         if($get_where==''){
           $get_where = "price <= ".$arr_data['to_price']."";
         }else{
           $get_where = $get_where." AND price <= ".$arr_data['to_price']."";
         }
      }



      
       if($get_where==''){
           $login = $this->webservice_model->get_all('product');
         }else{
           $login = $this->webservice_model->get_where('product', $get_where);
         }
       
      

 
    
   

  // print_r($login);

  if ($login) {
    foreach($login as $val) {
      $where = ['id' => $val['user_id']];
      $fetch = $this->webservice_model->get_where('users', $where);

                        $distance = $this->webservice_model->distance($lat, $lon, $fetch[0]['lat'], $fetch[0]['lon'], $miles = false);


      if ($fetch) {
        $fetch[0]['image'] = SITE_URL . 'uploads/images/' . $fetch[0]['image'];
        $val['user_detail'] = $fetch[0];
      }
      else {
        $val['user_detail'] = array();
      }
      $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
      $val['product_image'] = SITE_URL . 'uploads/images/' . $val['image'];

                        if($dist!=''){
        if($dist >= $distance){
          $ressult[] = $val;
                          }
                        }else{
                          $ressult[] = $val;
                        }
    }
              if(isset($ressult))
                          {
    $data['result'] = $ressult;
    $data['message'] = 'successfull';
    $data['status'] = '1';
    $json = $data;
  }else {
    $data['result'] = 'unsuccessfull';
    $data['message'] = 'data not found';
    $data['status'] = '0';
    $json = $data;
  }
      }
  else {
    $data['result'] = 'unsuccessfull';
    $data['message'] = 'data not found';
    $data['status'] = '0';
    $json = $data;
  }

  header('Content-type: application/json');
  echo json_encode($json);
  }


   /*/////////////////////////start chating module/////////////////////////////////////////*/

/************************ insert chat ************************/

public

function insert_chat()
  {
    
    $arr_data = array(
     'sender_id' => $this->input->get_post('sender_id', TRUE) ,
     'receiver_id' => $this->input->get_post('receiver_id', TRUE) ,
     'product_id' => $this->input->get_post('product_id', TRUE) ,
     'chat_message' => $this->input->get_post('chat_message', TRUE),
     'date' => date('Y-m-d H:i:s')
    );
  
  $where = [
     'product_id' => $arr_data['product_id'],
     'user_id'    => $arr_data['receiver_id'],
     'block_id'   => $arr_data['sender_id'],
    ];

   $isBlocked = $this->webservice_model->get_where('product_block_users' ,$where);

    if(!empty($isBlocked) && !is_null($isBlocked)){
      header('Content-type: application/json');
      echo json_encode(['result' => 'You are blocked']);
      die;
    }
   
   if (isset($_FILES['chat_image'])){
      $user_img = "CHAT_IMG_" . rand(1, 10000) . ".png";
      move_uploaded_file($_FILES['chat_image']['tmp_name'], "uploads/images/" . $user_img);
      $arr_data['chat_image'] = $user_img;
    }

   $res = $this->webservice_model->insert_data('kaise_chat_detail', $arr_data);

   // print_r($arr_data);

   if ($res != ""){
     $single_data = array(
      'id' => $res
    );

                 
  $user = $this->webservice_model->get_where('users', ['id' => $arr_data['receiver_id']]);
  $user_r = $this->webservice_model->get_where('users', ['id' => $arr_data['sender_id']]);
  $product = $this->webservice_model->get_where('product', ['id' => $arr_data['product_id']]);
  
  #print_r($user_r[0]['first_name']);die;
  
  $user_message_apk = array(
    "message" => array(
      "result" => "successful",
      "key" => "You have a new message",
      "message" => $arr_data['chat_message'],
      "chat_image" => $res[0]['chat_image'],
      "userid" => $user_r[0]['id'],
      "name" => $user_r[0]['first_name'] ,
      "product_id" => $product[0]['id'],
      "product_name" => $product[0]['product_name'] ,
      "userimage" => SITE_URL . "uploads/images/" . $user_r[0]['image'],
      "date" => date('Y-m-d h:i:s')
    )
  );
  $register_userid = array(
    $user[0]['register_id']
  );
  
//  $this->webservice_model->user_apk_notification($register_userid, $user_message_apk);
 
 /*
 
  if($user[0]['device_type'] == 1){
      if($user[0]['device_token']){
          $this->ios_notification($user[0]['device_token'],$user_message_apk,$arr_data['chat_message'],"Tienes un nuevo mensaje de ".$user_r[0]['first_name'],'You have a new message'); 
      }
  }else{
        $this->webservice_model->user_apk_notification($register_userid, $user_message_apk);  
  }
  
  */
  
  
  /*********** new chating *****/
     if($user[0]['device_token']){
          $this->ios_notification($user[0]['device_token'],$user_message_apk,$arr_data['chat_message'],"Tienes un nuevo mensaje de ".$user_r[0]['first_name'],'You have a new message'); 
      }
      
      if($register_userid){
        $this->webservice_model->user_apk_notification($register_userid, $user_message_apk);    
      }
      
  /*****************************/
    
    $fetch = $this->webservice_model->get_where('kaise_chat_detail', $single_data);
    $fetch[0]['chat_image'] = SITE_URL . "uploads/images/" . $fetch[0]['chat_image'];
    $fetch[0]['result'] = "successful";
    $json = $fetch[0];
    }
    else
    {
    $json = array(
      "result" => "unsuccessful"
    );
    }

  header('Content-type: application/json');
  echo json_encode($json);
  }

/************* get chat *************/


public

function get_chat()
  {
      //SELECT * FROM (`kaise_chat_detail`) WHERE `product_id` = '2' AND (`sender_id` = '3' or  `receiver_id` = '3' )   AND (`receiver_id` = '2' OR `sender_id` = '2') ORDER BY `id` DESC
  $sender_id = $this->input->get_post('sender_id', TRUE);
  $receiver_id = $this->input->get_post('receiver_id', TRUE);
  $product_id = $this->input->get_post('product_id', TRUE);
  
 /* $this->db->where('sender_id', $sender_id);
  $this->db->where('receiver_id', $receiver_id);
  $this->db->or_where('sender_id', $receiver_id);
  
  $this->db->where('receiver_id', $sender_id);
  $this->db->where('product_id', $product_id);
  $this->db->order_by('id', 'DESC');
  $info = $this->db->get('kaise_chat_detail1');
  $chat = $info->result_array();
  */
         $chat = $this->db->query("SELECT * FROM (`kaise_chat_detail`) WHERE  `product_id` = '$product_id' AND (`sender_id` = '$sender_id' or  `receiver_id` = '$sender_id' )   AND (`receiver_id` = '$receiver_id' OR `sender_id` = '$receiver_id') ORDER BY `id` DESC ")->result_array();

  
  if ($chat)
    {
    $i = 0;
    foreach($chat as $val)
      {
      $sender = $this->webservice_model->get_where('users', ['id' => $val['sender_id']]);
      $receiver = $this->webservice_model->get_where('users', ['id' => $val['receiver_id']]);
      $sender[0]['sender_image'] = SITE_URL . 'uploads/images/' . $sender[0]['image'];
      $receiver[0]['receiver_image'] = SITE_URL . 'uploads/images/' . $receiver[0]['image'];
      $val['chat_image'] = SITE_URL . 'uploads/images/' . $val['chat_image'];
      $val['result'] = "successful";
      $val['date']   = date('Y-m-d H:i A' , strtotime($val['date']));
      $val['sender_detail'] = $sender[0];
      $val['receiver_detail'] = $receiver[0];
      $exp1 = $exp2 = "";
      $clr_id = $val['clear_chat'];
      $exp = explode(',', $clr_id);
      if (isset($exp[0]))
        {
        $exp1 = $exp[0];
        }

      if (isset($exp[1]))
        {
        $exp2 = $exp[1];
        }

      if ($exp1 != $receiver_id && $exp2 != $receiver_id)
        {
        $i++;
        $json[] = $val;
        } //end if
      }

    if ($i == 0)
      {
      $json[] = array(
        "result" => "unsuccessful"
      );
      }

    $arr_where = ['sender_id' => $sender_id, 'receiver_id' => $receiver_id, 'product_id' => $product_id]; //print_r($arr_where);
    $this->webservice_model->update_data('kaise_chat_detail', ['status' => 'SEEN'], $arr_where);
    }
    else
    {
    $json[] = array(
      "result" => "unsuccessful"
    );
    }

  header('Content-type: application/json');
  echo json_encode($json);
  }

/************* get conversation *************/



public

function get_conversation_again()
  {
  $receiver_id = $this->input->get_post('receiver_id', TRUE);
  
  $this->db->where("(receiver_id = '$receiver_id') OR (sender_id = '$receiver_id') ");
  $info = $this->db->get('kaise_chat_detail');
  $chat = $info->result_array();
  $arr = [];
  if ($chat)
    {
    foreach($chat as $val)
      {
      if ($val['sender_id'] == $receiver_id)
        {
        if (in_array($val['receiver_id'], $arr))
          {
          }
          else
          {
          $exp1 = $exp2 = "";
          $clr_id = $val['clear_chat'];
          $exp = explode(',', $clr_id);
          if (isset($exp[0]))
            {
            $exp1 = $exp[0];
            }

          if (isset($exp[1]))
            {
            $exp2 = $exp[1];
            }

          if ($exp1 != $receiver_id && $exp2 != $receiver_id)
            {
            $arr[] = $val['receiver_id'];
            $user = $this->webservice_model->get_where('users', ['id' => $val['receiver_id']]);
            $product = $this->webservice_model->get_where('product', ['id' => $val['product_id']]);
            $user[0]['product_name'] =$product[0]['product_name'];
            $user[0]['product_id'] =$val['product_id'];
            $user[0]['product_image'] = SITE_URL . "uploads/images/" . $product[0]['image'];
            $user[0]['image'] = SITE_URL . "uploads/images/" . $user[0]['image'];
            $json[] = $user[0];
            } //end if
          }
        }
        else
        {
        if (in_array($val['sender_id'], $arr))
          {
          }
          else
          {
          $exp1 = $exp2 = "";
          $clr_id = $val['clear_chat'];
          $exp = explode(',', $clr_id);
          if (isset($exp[0]))
            {
            $exp1 = $exp[0];
            }

          if (isset($exp[1]))
            {
            $exp2 = $exp[1];
            }

          if ($exp1 != $receiver_id && $exp2 != $receiver_id)
            {
            $arr[] = $val['sender_id'];
            $user = $this->webservice_model->get_where('users', ['id' => $val['sender_id']]);
            $product = $this->webservice_model->get_where('product', ['id' => $val['product_id']]);
            $user[0]['product_name'] =$product[0]['product_name'];
            $user[0]['product_id'] =$val['product_id'];
            $user[0]['product_image'] = SITE_URL . "uploads/images/" . $product[0]['image'];
            $user[0]['image'] = SITE_URL . "uploads/images/" . $user[0]['image'];
            $json[] = $user[0];
            } //end if
          }
        }
      } // end foreach
    }
    else
    {
    $json = array(
      "result" => "data not found",
      "message" => "unsuccess",
      "status" => "0"
    );
    header('Content-type: application/json');
    echo json_encode($json);
    die;
    }

  if (!isset($json))
    {
    $json = array(
      "result" => "data not found",
      "message" => "unsuccess",
      "status" => "0"
    );
    header('Content-type: application/json');
    echo json_encode($json);
    die;
    }

  foreach($json as $key)
    {
    $where = "sender_id = '" . $key['id'] . "' AND receiver_id = '" . $receiver_id . "' AND status = 'NOTSEEN' ORDER BY id DESC";
    $msg = $this->webservice_model->get_where('kaise_chat_detail', $where);
    if ($msg)
      {
      $key['no_of_message'] = count($msg);
      }
      else
      {
      $key['no_of_message'] = 0;
      }

    $where1 = "(sender_id = '" . $key['id'] . "' AND receiver_id = '" . $receiver_id . "') OR (receiver_id = '" . $key['id'] . "' AND sender_id = '" . $receiver_id . "') ORDER BY id DESC";
    $msg1 = $this->webservice_model->get_where('kaise_chat_detail', $where1);
    if ($user)
      {

      // $key['no_of_message'] = count($msg);

      $date_time = explode(" ", $msg1[0]['date']);
      $key['last_message'] = $msg1[0]['chat_message'];
      $key['last_image'] = SITE_URL . "uploads/images/" . $msg1[0]['chat_image'];
      $key['date'] = $date_time[0];
      $key['time'] = $date_time[1];
      $key['time_ago'] = $this->webservice_model->humanTiming(strtotime($msg1[0]['date'])) . " ago";
      $key['sender_id'] = $key['id'];
      $key['receiver_id'] = $receiver_id;
      $message[] = $key;
      }
      else
      {

      // $key['no_of_message'] = 0;

      $message[] = $key;
      }
    }

  $data['result'] = $message;
  $data['message'] = "success";
  $data['status'] = 1;
  header('Content-type: application/json');
  echo json_encode($data);
  }


/************* get conversation *************/

function unique_array($my_array, $key) { 
    $result = array(); 
    $i = 0; 
    $key_array = array(); 
    
    foreach($my_array as $val) { 
        if (!in_array($val[$key], $key_array)) { 
            $key_array[$i] = $val[$key]; 
            $result[$i] = $val; 
        } 
        $i++; 
    } 
    return $result; 
}  


public

function get_conversation()
  {
   
  $receiver_id = $this->input->get_post('receiver_id', TRUE);
//  $product_id = $this->input->get_post('product_id', TRUE);

        $this->webservice_model->update_data('kaise_chat_detail', ['is_read' => '1'], ['receiver_id'=>$receiver_id]);

  $this->db->where("(receiver_id = '$receiver_id')");
  $this->db->or_where("(sender_id   = '$receiver_id')");
  $this->db->order_by("id","desc");
  $info = $this->db->get('kaise_chat_detail');
  $chat = $info->result_array();
  
  
  $arr = [];
  if ($chat)
    {
      
      $roomChatIdArr = array();    

    foreach($chat as $val)
      {
          
          if($val['sender_id'] > $val['receiver_id']){
                $roomChatId = $val['product_id'] . $val['receiver_id'] . $val['sender_id']; 
          }else{
                $roomChatId = $val['product_id'] . $val['sender_id'] . $val['receiver_id']; 
          }
          
          if(in_array($roomChatId,$roomChatIdArr)){
             continue;   
          }else{
              array_push($roomChatIdArr,$roomChatId);
          }

          
        $exp1 = $exp2 = "";
        $clr_id = $val['clear_chat'];
        $exp = explode(',', $clr_id);
        
        if (isset($exp[0]))
        {
          $exp1 = $exp[0];
        }
        
        if (isset($exp[1]))
        {
          $exp2 = $exp[1];
        }
        
        // if($val['receiver_id'] == $receiver_id){
        //       $sender_id  = $val['sender_id'];
        // }else{
        //       $sender_id  = $val['receiver_id'];
        // }
        
        // if($receiver_id == $val['receiver_id']){
        //   $val['receiver_id'] = $val['sender_id'];
        // }else{
        //   $val['receiver_id'] = $val['receiver_id'];            
        // }
        
        if(in_array($receiver_id,$exp))
        {  
          continue;
        }
        
    if($receiver_id == $val['receiver_id']){
                $user = $this->webservice_model->get_where('users', ['id' => $val['sender_id']]);
    }else{          
            $user = $this->webservice_model->get_where('users', ['id' => $val['receiver_id']]);
    }
          

            $product = $this->webservice_model->get_where('product', ['id' => $val['product_id']]);
            if($product == ''){
                continue;
            }
            
            $product1 = $this->webservice_model->get_where('product', ['id' => $val['product_id'],'buy_user_id !=' =>'']);
            if(!empty($product1)){
                continue;
            }
            
    if($receiver_id == $val['receiver_id']){
       $user[0]['receiver_id'] =$val['sender_id'];
    }else{          
       $user[0]['receiver_id'] =$val['receiver_id'];
    }
            

            $user[0]['product_name'] =$product[0]['product_name'];
            $user[0]['product_id'] =$val['product_id'];
            $user[0]['product_image'] = SITE_URL . "uploads/images/" . $product[0]['image'];
            $user[0]['image'] = SITE_URL . "uploads/images/" . $user[0]['image'];
                          $where = "receiver_id = '" . $receiver_id . "' AND sender_id =  '" . $val['sender_id'] . "' AND product_id =  '" . $val['product_id'] . "' AND status = 'NOTSEEN' ORDER BY id DESC";
                        $msg = $this->webservice_model->get_where('kaise_chat_detail', $where);
                        
                        if ($msg)
                          {
                          $user[0]['no_of_message'] = count($msg);
                          }
                          else
                          {
                          $user[0]['no_of_message'] = 0;
                          }


            $user[0]['last_message'] =$val['chat_message'];
            $json[] = $user[0];
          
      } // end foreach
    }
    else
    {
    $json = array(
      "result" => "data not found",
      "message" => "unsuccess",
      "status" => "0"
    );
    header('Content-type: application/json');
    echo json_encode($json);
    die;
    }

  if (!isset($json))
    {
    $json = array(
      "result" => "data not found",
      "message" => "unsuccess",
      "status" => "0"
    );
    header('Content-type: application/json');
    echo json_encode($json);
    die;
    }
  
      else
      {

      // $key['no_of_message'] = 0;

      $message = $json;
      }
     
     // $message = $this->unique_key($message,'id');

  $data['result'] = $message;
  $data['message'] = "success";
  $data['status'] = 1;
  header('Content-type: application/json');
  echo json_encode($data);
  }



function unique_key($array,$keyname){

 $new_array = array();
 foreach($array as $key=>$value){

   if(!isset($new_array[$value[$keyname]])){
     $new_array[$value[$keyname]] = $value;
   }

 }
 $new_array = array_values($new_array);
 return $new_array;
}



/*************** clear_conversation *****************/


public

function clear_conversation()
  {
  $sender_id = $this->input->get_post('sender_id', TRUE);
  $receiver_id = $this->input->get_post('receiver_id', TRUE);
  $product_id = $this->input->get_post('product_id', TRUE);
//  $this->db->where('sender_id', $sender_id);
 // $this->db->where('receiver_id', $receiver_id);
  $this->db->where('product_id', $product_id);
  $this->db->or_where('sender_id', $receiver_id);
  $this->db->where('receiver_id', $sender_id);
  $info = $this->db->get('kaise_chat_detail');
  $chat = $info->result_array();
  
  if ($chat)
    {
        
    foreach($chat as $val)
      {
      $exp1 = $exp2 = "";
      $clr_id = $val['clear_chat'];
      $exp = explode(',', $clr_id);
      if (isset($exp[0]))
        {
        $exp1 = $exp[0];
        }

      if (isset($exp[1]))
        {
        $exp2 = $exp[1];
        }

      if ($clr_id == "")
        {
        $arr_where = ['product_id' => $product_id];
        $this->webservice_model->update_data('kaise_chat_detail', ['clear_chat' => $receiver_id], $arr_where);
       // $this->webservice_model->delete_data('kaise_chat_detail', $arr_where);

        }
        else
      if ($exp1 == $receiver_id)
        {
        }
        else
      if ($exp2 == $receiver_id)
        {
        }
        else
        {
        $arr_where = ['product_id' => $product_id];
        $this->webservice_model->update_data('kaise_chat_detail', ['clear_chat' => $exp1 . ',' . $receiver_id], $arr_where);
        }
      }

        $json[] = array(
          "result" => "successful"
        );
        
    }
    else
    {
    $json[] = array(
      "result" => "unsuccessful"
    );
    }

  header('Content-type: application/json');
  echo json_encode($json);
  }

/***************delete_conversation *****************/


public

function delete_conversation()
  {
  $receiver_id = $this->input->get_post('receiver_id', TRUE);
  $product_id = $this->input->get_post('product_id', TRUE);
  $this->db->where('sender_id', $receiver_id);
  $this->db->where('product_id', $product_id);
  $this->db->or_where('receiver_id', $receiver_id);
  $info = $this->db->get('kaise_chat_detail');
  $chat = $info->result_array();
  if ($chat)
    {
    foreach($chat as $val)
      {
      $exp1 = $exp2 = "";
      $clr_id = $val['clear_chat'];
      $exp = explode(',', $clr_id);
      if (isset($exp[0]))
        {
        $exp1 = $exp[0];
        }

      if (isset($exp[1]))
        {
        $exp2 = $exp[1];
        }

      if ($clr_id == "")
        {
        $arr_where = ['id' => $val['id']];
        $this->webservice_model->update_data('kaise_chat_detail', $arr_where, ['clear_chat' => $receiver_id]);
        }
        else
      if ($exp1 == $receiver_id)
        {
        }
        else
      if ($exp2 == $receiver_id)
        {
        }
        else
        {
        $arr_where = ['id' => $val['id']];
        $this->webservice_model->update_data('kaise_chat_detail', $arr_where, ['clear_chat' => $exp1 . ',' . $receiver_id]);
        }
      }

    $json[] = array(
      "result" => "successful"
    );
    }
    else
    {
    $json[] = array(
      "result" => "unsuccessful"
    );
    }

  header('Content-type: application/json');
  echo json_encode($json);
  }

/**************count seen *****************/

public

function get_unseen_count()
  {
  $id = $this->input->get_post('user_id', TRUE);

  //  $data = $this->db->query("SELECT * FROM users WHERE id = '$id'");

  $query = "SELECT * FROM users WHERE id = '$id' ";
  $sql = mysql_query($query);
  $result = mysql_num_rows($sql);
  if ($result != 0)
    {
    while ($val = mysql_fetch_assoc($sql))
      {
      $query4 = "SELECT * FROM `kaise_chat_detail` WHERE receiver_id = '" . $val['id'] . "' AND `status` = 'NOTSEEN' ";
      $que4 = mysql_query($query4);
      $user_fetch4 = mysql_num_rows($que4);
      $val['unseen_count'] = "$user_fetch4";
      $val['result'] = "successful";
      $json = $val;
      }
    }
    else
    {
    $json = array(
      "result" => "unsuccessful"
    );
    }

  header('Content-type: application/json');
  echo json_encode($json);
  die;
  }

/*////////////////////////////end chating module///////////////////////////////*/





  
/************* update_product1 function *************/
public

function update_product1()
  {
  $arr_get = ['id' => $this->input->get_post('product_id') ];
  $login = $this->webservice_model->get_where('product', $arr_get);
  if ($login[0]['id'] == "")
    {
    $ressult['result'] = 'Data Not Found';
    $ressult['message'] = 'unsuccessfull';
    $ressult['status'] = '0';
    $json = $ressult;
    header('Content-type:application/json');
    echo json_encode($json);
    die;
    }

   $arr_data = [
            'product_name'=>$this->input->get_post('product_name'),
            'address'=>$this->input->get_post('address'),
            'category_id'=>$this->input->get_post('category_id'),
            'description'=>$this->input->get_post('description'),
            'price'=>$this->input->get_post('price'),
            'price_type'=>$this->input->get_post('price_type')
       ];

  if (isset($_FILES['product_images']))
        {

                $arr_gets = ['id'=>$login[0]['id']];

                $product_images = $_FILES['product_images']['name'];
 
                $i=0;
               foreach($product_images AS $name){
               
                 $n = rand(0, 100000);
                 $ext = end(explode(".",$name));
                 $img = "PR_IMG_" . date('Ymdhis') . '_' . $n . '.'.$ext;
                 move_uploaded_file($_FILES['product_images']['tmp_name'][$i], "uploads/images/" . $img);
                 if($i==0){
                   $arr_data1 = ['image'=> $img];
                   $res1 = $this->webservice_model->update_data('product', $arr_data1, $arr_gets);                   
                 }
                 $img_data = ['product_id'=>$login[0]['id'],'image'=>$img];
                 $this->webservice_model->insert_data('product_image',$img_data);
                 $i++;

               }
            }

                   $res = $this->webservice_model->update_data('product', $arr_data, $arr_get);                   

  if ($res)
    {
    $data = $this->webservice_model->get_where('product', $arr_get);
    $data[0]['image'] = SITE_URL . 'uploads/images/' . $data[0]['image'];

    $ressult['result'] = $data[0];
    $ressult['message'] = 'successfull';
    $ressult['status'] = '1';
    $json = $ressult;
    }
    else
    {
    $ressult['result'] = 'Data Not Found';
    $ressult['message'] = 'unsuccessfull';
    $ressult['status'] = '0';
    $json = $ressult;
    }

  header('Content-type: application/json');
  echo json_encode($json);
  }




  /***************get_product1 *****************/
  public

  function get_product1()
  {
  $arr_login = array(
    'user_id' => $this->input->get_post('user_id', TRUE)
  );
  /*Check Login*/
  $login = $this->webservice_model->get_where('product', $arr_login);

  // print_r($login);

  if ($login) {
    foreach($login as $val) {
      $where = ['id' => $val['user_id']];
      $fetch = $this->webservice_model->get_where('users', $where);
      if ($fetch) {
        $fetch[0]['image'] = SITE_URL . 'uploads/images/' . $fetch[0]['image'];
        $val['user_detail'] = $fetch[0];
      }
      else {
        $val['user_detail'] = array();
      }

      $image = [];
      $where = ['product_id' => $val['id']];
      $fetch = $this->webservice_model->get_where('product_image', $where);
      if ($fetch) {
        foreach($fetch as $img) {
          $img['image'] = SITE_URL . 'uploads/images/' . $img['image'];
          $image[] = $img;
        }
      }

      $val['product_image'] = $image;
      $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
      $ressult[] = $val;
    }

    $data['result'] = $ressult;
    $data['message'] = 'successfull';
    $data['status'] = '1';
    $json = $data;
  }
  else {
    $data['result'] = 'unsuccessfull';
    $data['message'] = 'data not found';
    $data['status'] = '0';
    $json = $data;
  }

  header('Content-type: application/json');
  echo json_encode($json);
  }


  /***************get_product_detail231 *****************/
  public

  function get_product_detail231()
  {
  $arr_login = array(
    'id' => $this->input->get_post('product_id', TRUE)
  );
  /*Check Login*/
  $login = $this->webservice_model->get_where('product', $arr_login);

  // print_r($login);

  if ($login) {
    foreach($login as $val) {
      $where = ['id' => $val['user_id']];
      $fetch = $this->webservice_model->get_where('users', $where);
      if ($fetch) {
        $fetch[0]['image'] = SITE_URL . 'uploads/images/' . $fetch[0]['image'];
        $val['user_detail'] = $fetch[0];
      }
      else {
        $val['user_detail'] = array();
      }

      $image = [];
      $where = ['product_id' => $val['id']];
      $fetch = $this->webservice_model->get_where('product_image', $where);
      if ($fetch) {
        foreach($fetch as $img) {
          $img['image'] = SITE_URL . 'uploads/images/' . $img['image'];
          $image[] = $img;
        }
      }

      $val['product_image'] = $image;
      $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
      $ressult[] = $val;
    }

    $data['result'] = $ressult;
    $data['message'] = 'successfull';
    $data['status'] = '1';
    $json = $data;
  }
  else {
    $data['result'] = 'unsuccessfull';
    $data['message'] = 'data not found';
    $data['status'] = '0';
    $json = $data;
  }

  header('Content-type: application/json');
  echo json_encode($json);
  }

  /***************get_product_by_category1 *****************/
  public

  function get_product_by_category1()
  {
  $arr_login = array(
    'category_id' => $this->input->get_post('category_id', TRUE),
    'user_id !=' => $this->input->get_post('user_id', TRUE)
  );
  /*Check Login*/
  $login = $this->webservice_model->get_where('product', $arr_login);

  // print_r($login);

  if ($login) {
    foreach($login as $val) {
      $where = ['id' => $val['user_id']];
      $fetch = $this->webservice_model->get_where('users', $where);
      if ($fetch) {
        $fetch[0]['image'] = SITE_URL . 'uploads/images/' . $fetch[0]['image'];
        $val['user_detail'] = $fetch[0];
      }
      else {
        $val['user_detail'] = array();
      }

      $image = [];
      $where = ['product_id' => $val['id']];
      $fetch = $this->webservice_model->get_where('product_image', $where);
      if ($fetch) {
        foreach($fetch as $img) {
          $img['image'] = SITE_URL . 'uploads/images/' . $img['image'];
          $image[] = $img;
        }
      }

      $val['product_image'] = $image;
      $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
      $ressult[] = $val;
    }

    $data['result'] = $ressult;
    $data['message'] = 'successfull';
    $data['status'] = '1';
    $json = $data;
  }
  else {
    $data['result'] = 'unsuccessfull';
    $data['message'] = 'data not found';
    $data['status'] = '0';
    $json = $data;
  }

  header('Content-type: application/json');
  echo json_encode($json);
  }



      /************* add_review_rating function *************/

    public function add_review_rating(){

       $arr_data = [
            'from_id'=>$this->input->get_post('from_id'),
            'to_id'=>$this->input->get_post('to_id'),
            'rating'=>$this->input->get_post('rating'),
            'review'=>$this->input->get_post('review')        
       ];
     

      $id = $this->webservice_model->insert_data('review_rating',$arr_data);

      if ($id=="") {
        $json = ['result'=>'unsuccessfull','status'=>0,'message'=>'data not found'];
      }else{
         $arr_gets = ['id'=>$id];
        
        $login = $this->webservice_model->get_where('review_rating',$arr_gets);       
        $ressult['result']=$login[0];
        $ressult['message']='successfull';
        $ressult['status']='1';
        $json = $ressult;
      }

      header('Content-type:application/json');
      echo json_encode($json);

    }



    /************* get_product_rating1 function *************/

     public function get_product_rating1(){

      $arr_get = ['to_id'=>$this->input->get_post('to_id')];

      $fetch = $this->webservice_model->get_where('review_rating',$arr_get);

     
       if ($fetch) {

                          foreach($fetch as $val)
                          {
                           
      $rat = $this->db->select_avg("rating", "rating")->where(['to_id'=>$val['to_id']])->get('review_rating')->result_array();
      $rating = ($rat[0]['rating']=='') ?  "0" : $rat[0]['rating']; 


                            $arr_gets = ['id'=>$val['from_id']];
                            $login = $this->webservice_model->get_where('users',$arr_gets);       
                            $val['user_name']= $login[0]['username'];    
                            $val['phone']= $login[0]['phone'];    
                            $val['user_image'] = SITE_URL . 'uploads/images/' . $login[0]['image'];



                               
                            $data[] = $val;
        
                          }
                         
                          $ressult['result']=$data;
                          $ressult['avg_rating']=$rating;  
                          $ressult['message']='successful';
                          $ressult['status']='1';
                          $json = $ressult;                      
                         

      }
      else {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessful';
                          $ressult['status']='0';
                          $json = $ressult;
      }

      header('Content-type: application/json');
      echo json_encode($json);

    }

    
     /************* add_contact_us function *************/
  public

  function add_contact_us()
    {
    $arr_data = [
   
                      'from_id' => $this->input->get_post('from_id') ,
                      'to_id' => $this->input->get_post('to_id') ,
                      'product_id' => $this->input->get_post('product_id') 

              ];

    $arr_get = ['from_id' => $arr_data['from_id'],'to_id' => $arr_data['to_id'],'product_id' => $arr_data['product_id']];
    $login = $this->webservice_model->get_where('contact', $arr_get);
    if ($login)
      {
      $ressult['result'] = 'Already Exist';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      header('Content-type:application/json');
      echo json_encode($json);
      die;
      }

    

    $id = $this->webservice_model->insert_data('contact', $arr_data);
    if ($id == "")
      {
      $json = ['result' => 'unsuccessfull', 'status' => 0, 'message' => 'data not found'];
      }
      else
      {


          $arr_data1 = ['user_id'=>$arr_data['to_id'],'message'=>$message];
          $id1 = $this->webservice_model->insert_data('notification_msg', $arr_data1);


      $arr_gets = ['id' => $id];
      $login = $this->webservice_model->get_where('contact', $arr_gets);
      

      $ressult['result'] = $login[0];
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }

    header('Content-type:application/json');
    echo json_encode($json);
    }

     /***************get_contact_us *****************/
  public

  function get_contact_us()
  {
  $arr_login = array(
     'from_id' => $this->input->get_post('from_id') ,
                 'to_id' => $this->input->get_post('to_id') 
  );
  /*Check Login*/
  $login = $this->webservice_model->get_where('contact', $arr_login);

  // print_r($login);

  if ($login) {
    foreach($login as $val) {
      $where = ['id' => $val['product_id']];
      $fetch = $this->webservice_model->get_where('product', $where);
      if ($fetch) {
                              $fetch[0]['image'] = SITE_URL . 'uploads/images/' . $fetch[0]['image'];

        $val1[] = $fetch[0];
      }
      

      
      $ressult = $val1;
    }

    $data['result'] = $ressult;
    $data['message'] = 'successfull';
    $data['status'] = '1';
    $json = $data;
  }
  else {
    $data['result'] = 'unsuccessfull';
    $data['message'] = 'data not found';
    $data['status'] = '0';
    $json = $data;
  }

  header('Content-type: application/json');
  echo json_encode($json);
  }


  /*************  get_product_ac_product_name1 *************/
    public

    function get_product_ac_product_name1()
    {  
           $product_name = $this->input->get_post('product_name', TRUE);

          $arr_login = "product_name LIKE '%$product_name%' OR description LIKE '%$product_name%'";
        
    /*Check Login*/
     $login = $this->webservice_model->get_where('product', $arr_login);

              // print_r($login);
                if ($login) {
    foreach($login as $val) {
      $where = ['id' => $val['user_id']];
      $fetch = $this->webservice_model->get_where('users', $where);
      if ($fetch) {
        $fetch[0]['image'] = SITE_URL . 'uploads/images/' . $fetch[0]['image'];
        $val['user_detail'] = $fetch[0];
      }
      else {
        $val['user_detail'] = array();
      }

      $image = [];
      $where = ['product_id' => $val['id']];
      $fetch = $this->webservice_model->get_where('product_image', $where);
      if ($fetch) {
        foreach($fetch as $img) {
          $img['image'] = SITE_URL . 'uploads/images/' . $img['image'];
          $image[] = $img;
        }
      }

      $val['product_image'] = $image;
      $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
      $ressult[] = $val;
    }

    $data['result'] = $ressult;
    $data['message'] = 'successfull';
    $data['status'] = '1';
    $json = $data;
  }
  else {
    $data['result'] = 'unsuccessfull';
    $data['message'] = 'data not found';
    $data['status'] = '0';
    $json = $data;
  }

  header('Content-type: application/json');
  echo json_encode($json);
  }

   
      /************* add_request function *************/
  public

  function add_request()
    {
    $arr_data = [
   
                      'from_id' => $this->input->get_post('from_id') ,
                      'to_id' => $this->input->get_post('to_id') ,
                      'product_id' => $this->input->get_post('product_id') ,
                      'start_date' => $this->input->get_post('start_date') ,
                      'end_date' => $this->input->get_post('end_date') ,
                      'payment_id' => $this->input->get_post('payment_id') ,
                      'transaction_id' => $this->input->get_post('transaction_id') ,
                      'address' => $this->input->get_post('address') ,
                      'amount' => $this->input->get_post('amount') 

              ];

    $arr_get = ['from_id' => $arr_data['from_id'],'to_id' => $arr_data['to_id'],'product_id' => $arr_data['product_id'],'status'=>'Confirm'];
    $login = $this->webservice_model->get_where('user_request', $arr_get);
    if ($login)
      {
      $ressult['result'] = 'Already Exist';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      header('Content-type:application/json');
      echo json_encode($json);
      die;
      }

    

    $id = $this->webservice_model->insert_data('user_request', $arr_data);
    if ($id == "")
      {
      $json = ['result' => 'unsuccessfull', 'status' => 0, 'message' => 'data not found'];
      }
      else
      {



      $arr_data1 = ['user_id'=>$arr_data['to_id'],'message'=>$message];
          $id1 = $this->webservice_model->insert_data('notification_msg', $arr_data1);



    $arr_get1 = ['from_id' => $arr_data['from_id'],'to_id' => $arr_data['to_id'],'product_id' => $arr_data['product_id']];

      $this->webservice_model->delete_data('contact',$arr_get1);


      $arr_gets = ['id' => $id];
      $login = $this->webservice_model->get_where('user_request', $arr_gets);
      

      $ressult['result'] = $login[0];
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }

    header('Content-type:application/json');
    echo json_encode($json);
    }


    
  /***************get_all_my_request *****************/
  public

  function get_all_my_request()
  {
  $arr_login = array(
    'from_id' => $this->input->get_post('from_id', TRUE)
  );
  /*Check Login*/
  $login = $this->webservice_model->get_where('user_request', $arr_login);

  // print_r($login);

  if ($login) {
    foreach($login as $val) {
      $where = ['id' => $val['product_id']];
      $fetch = $this->webservice_model->get_where('product', $where);
      if ($fetch) {
        $fetch[0]['image'] = SITE_URL . 'uploads/images/' . $fetch[0]['image'];
        $val['product_detail'] = $fetch[0];
      }
      else {
        $val['product_detail'] = array();
      }

      $image = [];
      $where = ['product_id' => $val['product_id']];
      $fetch = $this->webservice_model->get_where('product_image', $where);
      if ($fetch) {
        foreach($fetch as $img) {
          $img['image'] = SITE_URL . 'uploads/images/' . $img['image'];
          $image[] = $img;
        }
      }

      $val['product_image'] = $image;
      //$val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
      $ressult[] = $val;
    }

    $data['result'] = $ressult;
    $data['message'] = 'successfull';
    $data['status'] = '1';
    $json = $data;
  }
  else {
    $data['result'] = 'unsuccessfull';
    $data['message'] = 'data not found';
    $data['status'] = '0';
    $json = $data;
  }

  header('Content-type: application/json');
  echo json_encode($json);
  }

   
  /***************get_all_other_request *****************/
  public

  function get_all_other_request()
  {
  $arr_login = array(
    'to_id' => $this->input->get_post('to_id', TRUE)
  );
  /*Check Login*/
  $login = $this->webservice_model->get_where('user_request', $arr_login);

  // print_r($login);

  if ($login) {
    foreach($login as $val) {
      $where = ['id' => $val['product_id']];
      $fetch = $this->webservice_model->get_where('product', $where);
      if ($fetch) {
        $fetch[0]['image'] = SITE_URL . 'uploads/images/' . $fetch[0]['image'];
        $val['product_detail'] = $fetch[0];
      }
      else {
        $val['product_detail'] = array();
      }

      $image = [];
      $where = ['product_id' => $val['product_id']];
      $fetch = $this->webservice_model->get_where('product_image', $where);
      if ($fetch) {
        foreach($fetch as $img) {
          $img['image'] = SITE_URL . 'uploads/images/' . $img['image'];
          $image[] = $img;
        }
      }

      $val['product_image'] = $image;
      //$val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
      $ressult[] = $val;
    }

    $data['result'] = $ressult;
    $data['message'] = 'successfull';
    $data['status'] = '1';
    $json = $data;
  }
  else {
    $data['result'] = 'unsuccessfull';
    $data['message'] = 'data not found';
    $data['status'] = '0';
    $json = $data;
  }

  header('Content-type: application/json');
  echo json_encode($json);
  }




/***************get_all_user_request *****************/

       function get_token_key() {


     $user_id = $this->input->get_post('user_id', TRUE);
     $product_id = $this->input->get_post('product_id', TRUE);



    $uri = "https://api-3t.sandbox.paypal.com/nvp";

    $fields =  "USER=08henryb-facilitator_api1.gmail.com&PWD=U4TDTUE5ZGEPYSE7&SIGNATURE=ABlLYlJXrwUWDhF71SK.kcrBWPRzAJPQPam8621TKOv0Z5LyqMmojIvV&METHOD=SetExpressCheckout&CANCELURL=http://123.com&RETURNURL=&VERSION=93&PAYMENTREQUEST_0_AMT=1.45&PAYMENTREQUEST_0_PAYMENTACTION=Order&PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID=gaurav.123.business@gmail.com&PAYMENTREQUEST_0_PAYMENTREQUESTID=1&PAYMENTREQUEST_0_CURRENCYCODE=USD";
    
    
  $header =array(
      "cache-control: no-cache",
      "content-type: application/x-www-form-urlencoded"
  );

    
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $uri,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $fields,
    CURLOPT_HTTPHEADER => $header ,
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }


  }

 /************* update_request_status function *************/

    public function update_request_status(){

       $arr_get = ['id'=>$this->input->get_post('request_id')];

      $login = $this->webservice_model->get_where('user_request',$arr_get);
      if ($login[0]['id'] == "")
      {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessfull';
                          $ressult['status']='0';
                          $json = $ressult;

                                header('Content-type:application/json');
                                echo json_encode($json);
                                die;
      }

     
    


       $arr_data = [
            'courier_name'=>$this->input->get_post('courier_name'),
            'estimate_date'=>$this->input->get_post('estimate_date'),
            'tracking_id'=>$this->input->get_post('tracking_id'),

            'status'=>$this->input->get_post('status')
                     
       ];

         
      $res = $this->webservice_model->update_data('user_request',$arr_data,$arr_get);
      if ($res)
      {

         

        $arr_get1 = ['id'=>$this->input->get_post('request_id')];
        $data = $this->webservice_model->get_where('user_request',$arr_get1);


        $ressult['result']=$data[0];
        $ressult['message']='successfull';
        $ressult['status']='1';
        $json = $ressult;
      }
      else
      {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessfull';
                          $ressult['status']='0';
                          $json = $ressult;
      }

      header('Content-type: application/json');
      echo json_encode($json);

                  

    }

      



                /************* delete_product *************/
    public

    function delete_product()
    {
                  $id = $this->input->get_post('product_id');

                  $list = $this->webservice_model->get_where('product',['id'=>$id]);

      if ($list)
      {
          
           $arr_data = [
            'delete_status'=>'yes',
       ];

         
      $res = $this->webservice_model->update_data('product',$arr_data,['id'=>$id]);
      
      
        // $this->webservice_model->delete_data('product',['id'=>$id]);
        // $this->webservice_model->delete_data('interested_users',['product_id'=>$id]);

                         


                          $ressult['result']="Item delete successfull";
                          $ressult['message']='successful';
                          $ressult['status']='1';
                          $json = $ressult;
      }
        else
      {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessful';
                          $ressult['status']='0';
                          $json = $ressult;                              
        
      }

        
                     
      header('Content-type: application/json');
      echo json_encode($json);
    }


    
                /************* delete_product_image *************/
    public

    function delete_product_image123()
    {
                  $id = $this->input->get_post('product_image_id');

                  $list = $this->webservice_model->get_where('product_image',['id'=>$id]);

      if ($list)
      {

         $this->webservice_model->delete_data('product_image',['id'=>$id]);

                         
                          unlink('uploads/images/'.$list[0]['image']);
            
                  

                          $ressult['result']="Item delete successfull";
                          $ressult['message']='successful';
                          $ressult['status']='1';
                          $json = $ressult;
      }
        else
      {
                          $ressult['result']='Data Not Found';
                          $ressult['message']='unsuccessful';
                          $ressult['status']='0';
                          $json = $ressult;                              
        
      }

        
                     
      header('Content-type: application/json');
      echo json_encode($json);
    }


  
/***************get_notification_msg *****************/


    public


  function get_notification_msg()
        {  
           
          $arr_login = array(
      'user_id' => $this->input->get_post('user_id', TRUE) 
      
    );
        
    /*Check Login*/
     $login = $this->webservice_model->get_where('notification_msg', $arr_login);

              // print_r($login);
                 if ($login)
      
                       {
          foreach($login as  $val)
        {
                               
                               
                                $ressult[]=$val;
                                
                               }
                                $data['result']= $ressult;
                                $data['message']='successfull';
                                $data['status']='1';
                                $json = $data;

                      
      }
 
                                
      else
      {
              $data['result']['errorMsg']='No Message Found';
                                $data['message']='unsuccessfull';
                                $data['status']='0';
                                $json = $data; 
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }






  /************* update_location function *************/
  public

  function update_location()
    {
    $arr_get = ['id' => $this->input->get_post('user_id') ];
    $login = $this->webservice_model->get_where('users', $arr_get);
    if ($login[0]['id'] == "")
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      header('Content-type:application/json');
      echo json_encode($json);
      die;
      }

    $arr_data = ['lat' => $this->input->get_post('lat') , 'lon' => $this->input->get_post('lon') ];
    $res = $this->webservice_model->update_data('users', $arr_data, $arr_get);
    if ($res)
      {
      $data = $this->webservice_model->get_where('users', $arr_get);
      $ressult['result'] = $data[0];
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  

  /***************get driver list  nearbuy *****************/
  public

  function get_driver_list_nearbuy()
    {
    $lat = $this->input->get_post('lat', TRUE);
    $lon = $this->input->get_post('lon', TRUE);
    $user_distance = 5; //$this->input->get_post('distance', TRUE);
    $query = "SELECT * FROM users WHERE type = 'driver' AND available_status = 'online'";
    $sql = mysql_query($query);
    $result = mysql_num_rows($sql);
    if ($result != 0)
      {
      while ($val = mysql_fetch_assoc($sql))
        {
        if (!$val['lat'] == "" && !$val['lon'] == "")
          {
          $distance = $this->webservice_model->distance($lat, $lon, $val['lat'], $val['lon'], $miles = false);
          if ($user_distance >= $distance)
            {
            $rat = $this->db->select_avg("rating", "rating")->where(['driver_id' => $val['id']])->get('rating')->result_array();
            $rating = ($rat[0]['rating'] == '') ? 0 : $rat[0]['rating'];
            $val['rating'] = $rating;
            $val['distance'] = number_format($distance, 2, '.', '');
            $val['estimate_time'] = round($distance * 1.5);

            //   $val['result'] = "successful";

            $json[] = $val;
            }
          }
        }

      if (!isset($json))
        {
        $ressult['result'] = 'Data Not Found';
        $ressult['message'] = 'unsuccessful';
        $ressult['status'] = '0';
        $code = $ressult;
        header('Content-type: application/json');
        echo json_encode($code);
        die;
        }
        else
        {
        $ressult['result'] = $json;
        $ressult['message'] = 'successful';
        $ressult['status'] = '1';
        $code = $ressult;
        }
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $code = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($code);
    die;
    }

  /*************  country_mobile_code *************/
  public

  function country_mobile_code()
    {
    $fetch = $this->webservice_model->get_all('qc_country');
    if ($fetch)
      {
      foreach($fetch as $val)
        {

        //  $fetch['mobile_code'] = $fetch[0]['itu-t _telephone_code'];

        $data['country_code'][] = $val['itu-t _telephone_code'];
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* get_country_code function *************/
  public

  function get_country_code()
    {

    // error_reporting(0);

    $lat = $this->input->get_post('lat', TRUE);
    $lon = $this->input->get_post('lon', TRUE);
    $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $lon . '&sensor=false&key=AIzaSyAOsaweruJ1wTisWeanZ5dlxaJtOyZsndQ');
    $output = json_decode($geocode);
    for ($j = 0; $j < count($output->results[0]->address_components); $j++)
      {
      $cn = array(
        $output->results[0]->address_components[$j]->types[0]
      );
      if (in_array("country", $cn))
        {
        $country = $output->results[0]->address_components[$j]->long_name;
        }
      }

    // echo $country;

    $query = "SELECT * FROM qc_country WHERE country = '$country'";
    $sql = mysql_query($query);
    $result = mysql_num_rows($sql);
    if ($result != 0)
      {
      while ($val = mysql_fetch_assoc($sql))
        {
        $arr_gets = ['country_name' => $val['country']];
        $login = $this->webservice_model->get_where('country', $arr_gets);
        $data['country_image'] = SITE_URL . 'uploads/flags/' . $login[0]['images'];
        $data['country_code'] = $val['itu-t _telephone_code'];
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* add_complaint_suggestion *************/
  public

  function add_complaint_suggestion()
    {
    $arr_data = [

               'user_id' => $this->input->get_post('user_id') , 
               'complaint_suggestion' => $this->input->get_post('complaint_suggestion') 
              ];
    $id = $this->webservice_model->insert_data('complaint_suggestion', $arr_data);
    if ($id == "")
      {
      $json = ['result' => 'unsuccessfull', 'status' => 0, 'message' => 'data not found'];
      }
      else
      {
      $arr_gets = ['id' => $id];
      $login = $this->webservice_model->get_where('complaint_suggestion', $arr_gets);
      $ressult['result'] = $login[0];
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }

    header('Content-type:application/json');
    echo json_encode($json);
    }

  /***************request_nearbuy_driver *****************/
  public

  function request_nearbuy_driver()
    {
    $lat = $this->input->get_post('pickup_lat', TRUE);
    $lon = $this->input->get_post('pickup_lon', TRUE);
    $vehicle_type = $this->input->get_post('vehicle_type', TRUE);
    $user_distance = 5; //$this->input->get_post('distance', TRUE);
    $arr_data = ['user_id' => $this->input->get_post('user_id') , 'size_id' => $this->input->get_post('size_id') , 'pickup_lat' => $this->input->get_post('pickup_lat') , 'pickup_lon' => $this->input->get_post('pickup_lon') ];
    $last_id = $this->webservice_model->insert_data('user_request', $arr_data);
    $query = "SELECT * FROM `users` WHERE vehicle_type = '$vehicle_type' AND type = 'driver' AND available_status = 'online' AND id NOT IN(select accept_driver_id from user_request where accept_driver_id != '' and status != 'Reject' AND status != 'Complete')";

    // $query="SELECT * FROM users WHERE type = 'driver' AND available_status = 'online'";

    $sql = mysql_query($query);
    $result = mysql_num_rows($sql);
    if ($result != 0)
      {
      $i = 0;
      $ids = '';
      while ($val = mysql_fetch_assoc($sql))
        {
        if (!$val['lat'] == "" && !$val['lon'] == "")
          {
          $distance = $this->webservice_model->distance($lat, $lon, $val['lat'], $val['lon'], $miles = false);
          if ($user_distance >= $distance)
            {
            if ($ids == '')
              {
              $ids = $val['id'];
              }
              else
              {
              $ids = $ids . ',' . $val['id'];
              $val['result'] = "successful";
              $json[] = $val;
              $i++;

           
              // send notification for Andriod

              $user_message_apk = array(
                "message" => array(
                  "result" => "successful",
                  "key" => "Request for booking",
                  "register_id" => $val['register_id'],
                  "pickup_lat" => $arr_data['pickup_lat'],
                  "pickup_lon" => $arr_data['pickup_lon'],
                  "username" => $login1[0]['username'],
                  "phone" => $login1[0]['phone'],
                  "user_image" => SITE_URL . 'uploads/images/' . $login1[0]['image'],
                  "driver_id" => $val['id'],
                  "request_id" => $last_id,
                  "date" => date('Y-m-d h:i:s')
                )
              );
              $register_userid = array(
                $val['register_id']
              );
              $this->webservice_model->driver_apk_notification($register_userid, $user_message_apk);
              $arr_data2 = ['driver_id' => $val['id'], 'status' => 'Pending', 'user_request_id' => $last_id];
              $ride = $this->webservice_model->insert_data('driver_ride_history', $arr_data2);
              }

            // end send notification for Andriod

            }
          }
        }

      if ($i == '0')
        {
        $ressult['result'] = 'Data Not Found';
        $ressult['message'] = 'unsuccessful';
        $ressult['status'] = '0';
        $code = $ressult;
        $id = $this->webservice_model->delete_data('user_request', ['id' => $last_id]);
        header('Content-type: application/json');
        echo json_encode($code);
        die;
        }
        else
        {
        $arr_data['driver_id'] = $ids;
        $id = $this->webservice_model->update_data('user_request', $arr_data, ['id' => $last_id]);
        if ($id == "")
          {
          $json = ['result' => 'unsuccessfull', 'status' => 0, 'message' => 'data not found'];
          }
          else
          {
          $arr_gets = ['id' => $last_id];
          $login = $this->webservice_model->get_where('user_request', $arr_gets);
          $ressult['result'] = $login[0];
          $ressult['message'] = 'successfull';
          $ressult['status'] = '1';
          $json = $ressult;
          }

        header('Content-type:application/json');
        echo json_encode($json);
        die;
        }
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $code = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($code);
    die;
    }

  /***************get_request *****************/
  public

  function get_request()
    {
    $driver_id = $this->input->get_post('driver_id', TRUE);
    $query = "SELECT * FROM user_request WHERE (driver_id = '$driver_id' OR driver_id LIKE '$driver_id,%' OR driver_id LIKE '%,$driver_id,%' OR driver_id LIKE '%,$driver_id') AND status != 'Accept' AND accept_driver_id != '$driver_id' ";
    $sql = mysql_query($query);
    $result = mysql_num_rows($sql);
    if ($result)
      {
      while ($val = mysql_fetch_assoc($sql))
        {
        $where = ['id' => $val['user_id']];
        $login = $this->webservice_model->get_where('users', $where);
        $val['user_name'] = $login[0]['username'];
        $val['user_phone'] = $login[0]['phone'];
        $val['user_email'] = $login[0]['email'];
        $val['user_image'] = SITE_URL . 'uploads/images/' . $login[0]['image'];
        $ressult1[] = $val;
        }

      $data['result'] = $ressult1;
      $data['message'] = 'successfull';
      $data['status'] = '1';
      $json = $data;
      }
      else
      {
      $data['result']['errorMsg'] = 'No Request Found';
      $data['message'] = 'unsuccessfull';
      $data['status'] = '0';
      $json = $data;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* accept_request function *************/
  public

  function accept_request()
    {
    $arr_get = ['id' => $this->input->get_post('request_id') ];
    $login = $this->webservice_model->get_where('user_request', $arr_get);
    if ($login[0]['id'] == "")
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      header('Content-type:application/json');
      echo json_encode($json);
      die;
      }

    $arr_get1 = ['id' => $this->input->get_post('request_id') , 'accept_driver_id !=' => '', 'status' => 'Accept'];
    $login1 = $this->webservice_model->get_where('user_request', $arr_get1);
    if ($login1)
      {
      $ressult['result'] = 'Already Accepted';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      header('Content-type:application/json');
      echo json_encode($json);
      die;
      }

    $arr_get22 = ['id' => $this->input->get_post('request_id') , 'accept_driver_id !=' => '', 'status' => 'Complete'];
    $login22 = $this->webservice_model->get_where('user_request', $arr_get22);
    if ($login22)
      {
      $ressult['result'] = 'Already Complete';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      header('Content-type:application/json');
      echo json_encode($json);
      die;
      }

    $arr_data = ['accept_driver_id' => $this->input->get_post('accept_driver_id') , 'status' => $this->input->get_post('status') ];
    $arr_get1 = ['id' => $login[0]['user_id']];
    $login1 = $this->webservice_model->get_where('users', $arr_get1);
    $arr_get2 = ['id' => $arr_data['accept_driver_id']];
    $login2 = $this->webservice_model->get_where('users', $arr_get2);

  
    // send notification for Andriod

    $user_message_apk = array(
      "message" => array(
        "result" => "successful",
        "key" => "Request Accepted",
        "register_id" => $login1[0]['register_id'],
        "status" => $arr_data['status'],
        "driver_id" => $arr_data['accept_driver_id'],
        "driver_name" => $login2[0]['first_name'],
        "driver_phone" => $login2[0]['phone'],
        "driver_lat" => $login2[0]['lat'],
        "driver_lon" => $login2[0]['lon'],
        "driver_image" => SITE_URL . 'uploads/images/' . $login2[0]['image'],
        "userid" => $login[0]['user_id'],
        "date" => date('Y-m-d h:i:s')
      )
    );

    // print_r($user_message_apk);die;

    $register_userid = array(
      $login1[0]['register_id']
    );
    
  //  $this->webservice_model->user_apk_notification($register_userid, $user_message_apk);
    
    if($login1[0]['device_type'] == 1){
      if($login1[0]['device_token']){
          $this->ios_notification($login1[0]['device_token'],$user_message_apk,'Request Accepted'); 
      }
  }else{
        $this->webservice_model->user_apk_notification($register_userid, $user_message_apk);  
  }
  

    // end send notification for Andriod

    $res = $this->webservice_model->update_data('user_request', $arr_data, $arr_get);
    if ($res)
      {
      $arr_data2 = ['driver_id' => $this->input->get_post('accept_driver_id') , 'status' => $this->input->get_post('status') , 'user_request_id' => $this->input->get_post('request_id') ];
      $ride = $this->webservice_model->insert_data('driver_ride_history', $arr_data2);
      $arr_get1 = ['id' => $this->input->get_post('request_id') ];
      $data = $this->webservice_model->get_where('user_request', $arr_get1);
      $ressult['result'] = $data[0];
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* change_driver_status function *************/
  public

  function change_driver_status()
    {
    $arr_get = ['id' => $this->input->get_post('request_id') ];
    $login = $this->webservice_model->get_where('user_request', $arr_get);
    if ($login[0]['id'] == "")
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      header('Content-type:application/json');
      echo json_encode($json);
      die;
      }

    $arr_data = ['accept_driver_id' => $this->input->get_post('accept_driver_id') , 'status' => $this->input->get_post('status') ];
    $arr_get1 = ['id' => $login[0]['user_id']];
    $login1 = $this->webservice_model->get_where('users', $arr_get1);
    $arr_get2 = ['id' => $arr_data['accept_driver_id']];
    $login2 = $this->webservice_model->get_where('users', $arr_get2);

 
    // send notification for Andriod

    $user_message_apk = array(
      "message" => array(
        "result" => "successful",
        "key" => "Request completed",
        "register_id" => $login1[0]['register_id'],
        "status" => $arr_data['status'],
        "driver_id" => $arr_data['accept_driver_id'],
        "driver_name" => $login2[0]['first_name'],
        "driver_phone" => $login2[0]['phone'],
        "driver_lat" => $login2[0]['lat'],
        "driver_lon" => $login2[0]['lon'],
        "driver_image" => SITE_URL . 'uploads/images/' . $login2[0]['image'],
        "userid" => $login[0]['user_id'],
        "date" => date('Y-m-d h:i:s')
      )
    );

    // print_r($user_message_apk);die;

    $register_userid = array(
      $login1[0]['register_id']
    );
    
  //  $this->webservice_model->user_apk_notification($register_userid, $user_message_apk);
    
    if($login1[0]['device_type'] == 1){
      if($login1[0]['device_token']){
          $this->ios_notification($login1[0]['device_token'],$user_message_apk,'Request completed'); 
      }
  }else{
        $this->webservice_model->user_apk_notification($register_userid, $user_message_apk);  
  }
    

    // end send notification for Andriod

    $res = $this->webservice_model->update_data('user_request', $arr_data, $arr_get);
    if ($res)
      {
      $arr_data2 = ['driver_id' => $this->input->get_post('accept_driver_id') , 'status' => $this->input->get_post('status') , 'user_request_id' => $this->input->get_post('request_id') ];
      $ride = $this->webservice_model->insert_data('driver_ride_history', $arr_data2);
      $arr_get1 = ['id' => $this->input->get_post('request_id') ];
      $data = $this->webservice_model->get_where('user_request', $arr_get1);
      $ressult['result'] = $data[0];
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /*************update_drdiver_status function *************/
  public

  function update_drdiver_status()
    {
    $arr_get = ['id' => $this->input->get_post('driver_id') ];
    $login = $this->webservice_model->get_where('users', $arr_get);
    if ($login[0]['id'] == "")
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      header('Content-type:application/json');
      echo json_encode($json);
      die;
      }

    $arr_data = ['available_status' => $this->input->get_post('available_status') ];
    $res = $this->webservice_model->update_data('users', $arr_data, $arr_get);
    if ($res)
      {
      $arr_get1 = ['id' => $login[0]['id']];
      $data = $this->webservice_model->get_where('users', $arr_get1);
      $ressult['result'] = 'status update successfull';
      $ressult['available_status'] = $data[0]['available_status'];
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* add_rating *************/
  public

  function add_rating()
    { 
    $arr_data = ['from_id' => $this->input->get_post('from_id') , 'driver_id' => $this->input->get_post('driver_id') , 'rating' => $this->input->get_post('rating') ];
    $id = $this->webservice_model->insert_data('rating', $arr_data);
    if ($id == "")
      {
      $json = ['result' => 'unsuccessfull', 'status' => 0, 'message' => 'data not found'];
      }
      else
      {
      $arr_gets = ['id' => $id];
      $login = $this->webservice_model->get_where('rating', $arr_gets);
      $ressult['result'] = $login[0];
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }

    header('Content-type:application/json');
    echo json_encode($json);
    }

  /*************  get_complete_order_by_user *************/
  public

  function get_complete_order_by_user()
    {
    $arr_get = ['user_id' => $this->input->get_post('user_id') , 'status' => 'Complete'];
    $login = $this->webservice_model->get_where('user_request', $arr_get);
    if ($login)
      {
      foreach($login as $val)
        {
        $where = ['id' => $val['accept_driver_id']];
        $fetch = $this->webservice_model->get_where('users', $where);
        $where2 = ['id' => $val['size_id']];
        $fetch2 = $this->webservice_model->get_where('size', $where2);
        $val['size_price'] = $fetch2[0]['size_price'];
        $val['driver_name'] = $fetch[0]['first_name'];
        $val['driver_phone'] = $fetch[0]['phone'];
        $val['driver_email'] = $fetch[0]['email'];
        $val['vehicle_type'] = $fetch[0]['vehicle_type'];
        $val['driver_image'] = SITE_URL . 'uploads/images/' . $fetch[0]['image'];
        $data[] = $val;
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /*************  get_driver_order_history *************/
  public

  function get_driver_order_history()
    {
    $driver_id = $this->input->get_post('driver_id');
    $arr_get = ['driver_id' => $driver_id];
    $login = $this->webservice_model->get_where('driver_ride_history', $arr_get);
    if ($login)
      {
      $total_order = $this->db->query("select * from `driver_ride_history` where driver_id = '$driver_id' AND status = 'Pending'")->num_rows();
      $total_reject = $this->db->query("select * from `driver_ride_history` where driver_id = '$driver_id' AND status = 'Reject'")->num_rows();
      if ($total_reject != '')
        {
        $total_cancel = ($total_reject * 100) / $total_order;
        }
        else
        {
        $total_cancel = 0;
        }

      $total_rating = $this->db->query("select * from `rating` where driver_id = '$driver_id'")->num_rows();
      $rat = $this->db->select_avg("rating", "rating")->where(['driver_id' => $driver_id])->get('rating')->result_array();
      $rating = ($rat[0]['rating'] == '') ? 0 : $rat[0]['rating'];
      $ressult['result']['tatal_order'] = $total_order;
      $ressult['result']['total_rating'] = $total_rating;
      $ressult['result']['total_cancel'] = $total_cancel;
      $ressult['result']['rating'] = $rating;
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result']['tatal_order'] = '0';
      $ressult['result']['total_rating'] = '0';
      $ressult['result']['total_cancel'] = '0';
      $ressult['result']['rating'] = '0';
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }

    header('Content-type:application/json');
    echo json_encode($json);
    }

  /*************  get_driver_order_payment_history *************/
  public

  function get_driver_order_payment_history()
    {
    $driver_id = $this->input->get_post('driver_id');
    $arr_get = ['driver_id' => $driver_id];
    $login = $this->webservice_model->get_where('driver_ride_history', $arr_get);
    if ($login)
      {
      $total_order = $this->db->query("select * from `driver_ride_history` where driver_id = '$driver_id' AND status = 'Pending'")->num_rows();
      $total_reject = $this->db->query("select * from `driver_ride_history` where driver_id = '$driver_id' AND status = 'Reject'")->num_rows();
      $total_complete = $this->db->query("select * from `driver_ride_history` where driver_id = '$driver_id' AND status = 'Complete'")->num_rows();
      $ressult['result']['tatal_order'] = $total_order;
      $ressult['result']['total_complete'] = $total_complete;
      $ressult['result']['total_cancel'] = $total_reject;
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result']['tatal_order'] = '0';
      $ressult['result']['total_complete'] = '0';
      $ressult['result']['total_cancel'] = '0';
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }

    header('Content-type:application/json');
    echo json_encode($json);
    }

   
  
  /************* add_event function *************/
  public

  function add_event()
    {
    $user_id = $this->input->get_post('user_id');
    $event_name = $this->input->get_post('event_name');
    $description = $this->input->get_post('description');
    $event_date = $this->input->get_post('event_date');
    $event_time = $this->input->get_post('event_time');
    $event_time_arrival = $this->input->get_post('event_time_arrival');
    $lat = $this->input->get_post('lat');
    $lon = $this->input->get_post('lon');
    $location = $this->input->get_post('location');
    $arr_data = ['user_id' => $user_id, 'event_name' => $event_name, 'description' => $description, 'event_time' => $event_time, 'event_time_arrival' => $event_time_arrival, 'lat' => $lat, 'lon' => $lon, 'location' => $location];
    if (isset($_FILES['image']))
      {

      //  unlink('uploads/images/'.$login[0]['image']);

      $n = rand(0, 100000);
      $img = "USER_IMG_" . $n . '.png';
      move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img);
      $arr_data['image'] = $img;
      }

    $inst = $this->webservice_model->insert_data('events', $arr_data);
    $add_date = explode(",", $event_date);
    foreach($add_date as $val)
      {
      $arr_da = ['event_id' => $inst, 'event_date' => $val];
      $this->webservice_model->insert_data('event_date', $arr_da);
      }

    $ressult['result'] = 'add Event successfull';
    $ressult['message'] = 'successfull';
    $ressult['status'] = '1';
    $json = $ressult;
    header('Content-type:application/json');
    echo json_encode($json);
    }

  /***************get_event *****************/
  public

  function get_event()
    {
    $arr_login = array(
      'user_id' => $this->input->get_post('user_id', TRUE)
    );
    /*Check Login*/
    $login = $this->webservice_model->get_where('events', $arr_login);

    // print_r($login);

    if ($login)
      {
      foreach($login as $val)
        {
        $where = ['event_id' => $val['id']];
        $fetch = $this->webservice_model->get_where('event_date', $where);
        if ($fetch)
          {
          $val['event_date'] = $fetch;
          }
          else
          {
          $val['event_date'] = array();
          }

        $ressult[] = $val;
        }

      $data['result'] = $ressult;
      $data['message'] = 'successfull';
      $data['status'] = '1';
      $json = $data;
      }
      else
      {
      $data['result']['errorMsg'] = 'No Event Found';
      $data['message'] = 'unsuccessfull';
      $data['status'] = '0';
      $json = $data;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /***************get_event_detail *****************/
  public

  function get_event_detail()
    {
    $arr_login = array(
      'id' => $this->input->get_post('event_id', TRUE)
    );
    /*Check Login*/
    $login = $this->webservice_model->get_where('events', $arr_login);

    // print_r($login);

    if ($login)
      {
      foreach($login as $val)
        {
        $where = ['event_id' => $val['id']];
        $fetch = $this->webservice_model->get_where('event_date', $where);
        $val['event_date'] = $fetch;
        $ressult[] = $val;
        }

      $data['result'] = $ressult;
      $data['message'] = 'successfull';
      $data['status'] = '1';
      $json = $data;
      }
      else
      {
      $data['result'][errorMsg] = 'No Event Found';
      $data['message'] = 'unsuccessfull';
      $data['status'] = '0';
      $json = $data;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* get_event_acc_date function *************/
  public

  function get_event_acc_date()
    {
    $user_id = $this->input->get_post('user_id');
    $event_date = $this->input->get_post('event_date');
    $fetch = $this->db->query("select * from `events` where user_id = '$user_id'")->result_array();

    // echo $this->db->last_query();

    if ($fetch)
      {

      // print_r($fetch);die;

      foreach($fetch as $val)
        {
        $where = ['event_id' => $val['id']];
        $fet = $this->webservice_model->get_where('event_date', $where);
        $i = 0;
        foreach($fet as $value)
          {
          if ($value['event_date'] == $event_date)
            {
            $i++;
            $val['event_date'] = $value['event_date'];
            }
          }

        if ($i > 0)
          {
          $data[] = $val;
          }
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'no data found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type:application/json');
    echo json_encode($json);
    }

  /************* get_event_acc_week function *************/
  public

  function get_event_acc_week()
    {
    $user_id = $this->input->get_post('user_id');
    $start_date = $this->input->get_post('start_date');
    $end_date = $this->input->get_post('end_date');
    $fetch = $this->db->query("select * from `events` where user_id = '$user_id'")->result_array();

    // echo $this->db->last_query();

    if ($fetch)
      {
      $i = 0;
      foreach($fetch as $val)
        {
        $where = "event_id = '" . $val['id'] . "' and event_date between '" . $start_date . "' and '" . $end_date . "'";
        $event_date = [];
        $fet = $this->webservice_model->get_where('event_date', $where);

        // echo $this->db->last_query();

        if ($fet)
          {
          foreach($fet as $value)
            {
            $i++;
            $event_date[] = $value;
            }

          $val['event_date'] = $event_date;
          $data[] = $val;
          }
        }

      if ($i > 0)
        {
        $ressult['result'] = $data;
        $ressult['message'] = 'successfull';
        $ressult['status'] = '1';
        $json = $ressult;
        }
        else
        {
        $ressult['result'] = 'no data found';
        $ressult['message'] = 'unsuccessfull';
        $ressult['status'] = '0';
        $json = $ressult;
        header('Content-type:application/json');
        echo json_encode($json);
        die;
        }
      }
      else
      {
      $ressult['result'] = 'no data found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type:application/json');
    echo json_encode($json);
    }

  /*************  event_vote *************/
  public

  function event_vote()
    {
    $arr_data = array(
      'event_id' => $this->input->get_post('event_id') ,
      'event_date_id' => $this->input->get_post('event_date_id') ,
      'user_id' => $this->input->get_post('user_id')
    );
    $vote = $this->webservice_model->insert_data('event_vote', $arr_data);
    if ($vote != "")
      {
      $single_data = ['id' => $vote];
      $fetch_order = $this->webservice_model->get_where('event_vote', $single_data);
      $ressult['result'] = $fetch_order[0];
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* update_event function *************/
  public

  function update_event()
    {
    $arr_get = ['id' => $this->input->get_post('event_id') ];
    $login = $this->webservice_model->get_where('events', $arr_get);
    if ($login[0]['id'] == "")
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      header('Content-type:application/json');
      echo json_encode($json);
      die;
      }

    $arr_data = ['event_name' => $this->input->get_post('event_name') , 'description' => $this->input->get_post('description') ,

    // 'event_date'=>$this->input->get_post('event_date'),

    'event_time_arrival' => $this->input->get_post('event_time_arrival') , 'lat' => $this->input->get_post('lat') , 'lon' => $this->input->get_post('lon') , 'location' => $this->input->get_post('location') ];
    if (isset($_FILES['image']))
      {

      //  unlink('uploads/images/'.$login[0]['image']);

      $n = rand(0, 100000);
      $img = "USER_IMG_" . $n . '.png';
      move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img);
      $arr_data['image'] = $img;
      }

    $res = $this->webservice_model->update_data('events', $arr_data, $arr_get);
    if ($res)
      {
      $data = $this->webservice_model->get_where('events', $arr_get);
      $data[0]['image'] = SITE_URL . 'uploads/images/' . $data[0]['image'];
      $ressult['result'] = $data[0];
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************** delete_event product ****************/
  public

  function delete_event()
    {
    $arr_id = ['id' => $this->input->get_post('event_id', TRUE) ];
    $arr_get = ['event_id' => $this->input->get_post('event_id', TRUE) ];
    $res = $this->webservice_model->delete_data('events', $arr_id);
    if ($res)
      {
      $res = $this->webservice_model->delete_data('event_date', $arr_get);
      $ressult['result'] = 'event delete successfully';
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /*************** get_event *****************/
  public

  function get_event_poll()
    {
    $arr_login = array(
      'id' => $this->input->get_post('event_id', TRUE)
    );
    /*Check Login*/
    $fetch = $this->webservice_model->get_where('events', $arr_login);
    if ($fetch)
      {
      $where = ['event_id' => $this->input->get_post('event_id', TRUE) ];
      $get = $this->webservice_model->get_where('event_date', $where);
      if ($get)
        {
        $fetch[0]['event_dates'] = $get;
        }
        else
        {
        $fetch[0]['event_dates'] = array();
        }

      $fetch[0]['image'] = SITE_URL . 'uploads/images/' . $fetch[0]['image'];
      $data['result'] = $fetch[0];
      $data['message'] = 'successfull';
      $data['status'] = '1';
      $json = $data;
      }
      else
      {
      $data['result'] = 'No Event Found';
      $data['message'] = 'unsuccessfull';
      $data['status'] = '0';
      $json = $data;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /*************  invite_to_event *************/
  public

  function invite_to_event()
    {
    $arr_data = array(
      'event_id' => $this->input->get_post('event_id') ,
      'event_date_id' => $this->input->get_post('event_date_id') ,
      'user_id' => $this->input->get_post('user_id')
    );
    $invite = $this->webservice_model->insert_data('invite_to_event', $arr_data);
    if ($invite != "")
      {
      $single_data = ['id' => $invite];
      $fetch = $this->webservice_model->get_where('invite_to_event', $single_data);
      $ressult['result'] = $fetch[0];
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* get_nearest_list *************/
  public

  function get_nearest_list()
    {
    $type = $this->input->get_post('type');
    $lat = $this->input->get_post('lat');
    $lon = $this->input->get_post('lon');
    if ($type == 'restaurant')
      {
      $list = $this->webservice_model->get_all('restaurant');
      }
      else
      {
      $list = $this->webservice_model->get_all('shop');
      }

    if ($list)
      {
      foreach($list as $val)
        {
        $videos = $reviews = array();
        $distance = $this->webservice_model->distance($lat, $lon, $val['lat'], $val['lon'], $miles = false);
        if ($type == 'restaurant')
          {
          $get = $this->db->select_avg("rating", "rating")->where(['restaurant_id' => $val['id']])->get('restaurant_review')->result_array();
          $get_review = $this->db->where(['restaurant_id' => $val['id']])->get('restaurant_review')->result_array();
          }
          else
          {
          $get = $this->db->select_avg("rating", "rating")->where(['shop_id' => $val['id']])->get('shop_review')->result_array();
          $get_review = $this->db->where(['shop_id' => $val['id']])->get('shop_review')->result_array();
          $get_video = $this->db->where(['item_id' => $val['id']])->get('shop_video')->result_array();

          // echo $this->db->last_query(); die;

          foreach($get_video as $vid)
            {
            $vid['video'] = SITE_URL . 'uploads/images/' . $vid['video'];
            $videos[] = $vid;
            }

          $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
          $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
          $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
          $val['image4'] = SITE_URL . 'uploads/images/' . $val['image4'];
          }

        $val['discount_img'] = SITE_URL . 'uploads/images/' . $val['discount_img'];
        foreach($get_review as $rev)
          {
          if ($rev['review'] != '')
            {
            $user_id = $rev['user_id'];
            $users = $this->webservice_model->get_where('users', ['id' => $user_id]);
            $reviews[] = ['username' => $users[0]['username'], 'review' => $rev['review']];
            }
          }

        $rating = ($get[0]['rating'] == '') ? 0 : $get[0]['rating'];
        $val['videos'] = $videos;
        $val['rating'] = $rating;
        $val['review'] = $reviews;
        $val['distance'] = number_format($distance, 2);
        $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
        $data[] = $val;
        }

      $dis = array();
      foreach($data as $key => $row)
        {
        $dis[$key] = $row['distance'];
        }

      array_multisort($dis, SORT_ASC, $data);
      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* restaurant_category *************/
  public

  function restaurant_category()
    {
    $res_id = $this->input->get_post('res_id');
    $list = $this->webservice_model->get_where('restaurant_cat', ['restaurant_id' => $res_id]);

    // print_r($lis);

    if ($list)
      {
      foreach($list as $val)
        {
        $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
        $data[] = $val;
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* restaurant_sub_category *************/
  public

  function restaurant_sub_category()
    {
    $res_id = $this->input->get_post('res_id');
    $res_cat_id = $this->input->get_post('res_cat_id');
    $list = $this->webservice_model->get_where('restaurant_sub_cat', ['restaurant_id' => $res_id, 'restaurant_cat_id' => $res_cat_id]);

    // print_r($lis);

    if ($list)
      {
      foreach($list as $val)
        {
        $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
        $data[] = $val;
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* shop_category *************/
  public

  function shop_category()
    {
    $shop_id = $this->input->get_post('shop_id');
    $list = $this->webservice_model->get_where('shop_cat', ['shop_id' => $shop_id]);

    // print_r($lis);

    if ($list)
      {
      foreach($list as $val)
        {
        $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
        $data[] = $val;
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* shop_sub_category *************/
  public

  function shop_sub_category()
    {
    $shop_id = $this->input->get_post('shop_id');
    $shop_cat_id = $this->input->get_post('shop_cat_id');
    $list = $this->webservice_model->get_where('shop_sub_cat', ['shop_id' => $shop_id, 'shop_cat_id' => $shop_cat_id]);

    // print_r($lis);

    if ($list)
      {
      foreach($list as $val)
        {
        $get_data = $this->db->where('item_id', $val['id'])->get('shop_color')->result_array();
        $val['cours'] = $get_data;
        $get_data = $this->db->where('item_id', $val['id'])->get('shop_size')->result_array();
        $val['size'] = $get_data;
        $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
        $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
        $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
        $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
        $val['image4'] = SITE_URL . 'uploads/images/' . $val['image4'];
        $data[] = $val;
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************** delete_image ****************/
  public

  function delete_image()
    {
    $table = $this->input->get_post('table', TRUE);
    $position = $this->input->get_post('position', TRUE);
    $arr_id = ['id' => $this->input->get_post('id', TRUE) ];
    $list = $this->webservice_model->get_where($table, $arr_id);
    $arr_data = [$position => ''];
    unlink("uploads/images/" . $list[0][$position]);
    $res = $this->webservice_model->update_data($table, $arr_data, $arr_id);

    // echo $this->db->last_query();

    if ($res)
      {
      $message = array(
        "result" => "successful"
      );
      }
      else
      {
      $message = array(
        "result" => "unsuccessful"
      );
      }

    echo json_encode($message);
    }

  /************* add_to_cart function *************/
  public

  function add_to_cart()
    {
    $user_id = $this->input->get_post('user_id');
    $item_id = $this->input->get_post('item_id');
    $quantity = $this->input->get_post('quantity');
    $color = $this->input->get_post('color');
    $size = $this->input->get_post('size');
    $type = $this->input->get_post('type');
    $date = date('Y-m-d');
    $time = date('h:i:s');
    $arr_get = ['user_id' => $user_id, 'item_id' => $item_id, 'status' => 'Pending'];
    $arr_data = ['user_id' => $user_id, 'item_id' => $item_id, 'quantity' => $quantity, 'date' => $date, 'time' => $time, 'color' => $color, 'size' => $size, 'type' => $type];
    $login = $this->webservice_model->get_where('add_to_cart', $arr_get);

    // echo $this->db->last_query();

    if ($login)
      {
      $this->webservice_model->update_data('add_to_cart', $arr_data, $arr_get);
      $ressult['result'] = 'cart update successfull';
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $this->webservice_model->insert_data('add_to_cart', $arr_data);
      $ressult['result'] = 'add to cart successfull';
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }

    header('Content-type:application/json');
    echo json_encode($json);
    }

  /************* get_cart1 function *************/
  public

  function get_cart1()
    {
    $user_id = $this->input->get_post('user_id');
    $arr_get = ['user_id' => $user_id, 'status' => 'Pending'];
    $fetch = $this->webservice_model->get_where('add_to_cart', $arr_get);

    // echo $this->db->last_query();

    if ($fetch)
      {
      foreach($fetch as $val)
        {
        if ($val['type'] == 'shop')
          {
          $get = $this->webservice_model->get_where('shop_sub_cat', ['id' => $val['item_id']]);
          }
          else
          {
          $get = $this->webservice_model->get_where('restaurant_sub_cat', ['id' => $val['item_id']]);
          }

        $total[] = ($get[0]['price'] * $val['quantity']);
        $val['price'] = $get[0]['price'];
        $val['item_name'] = $get[0]['name'];
        $val['image'] = SITE_URL . 'uploads/images/' . $get[0]['image'];
        $data[] = $val;
        }

      $user_address = [];
      $address = $this->webservice_model->get_where('user_address', ['user_id' => $user_id]);
      if ($address)
        {
        $user_address = $address[0];
        }

      $ressult['user_address'] = $user_address;
      $ressult['total'] = array_sum($total);
      $ressult['result'] = $data;
      $ressult['message'] = 'successfull';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'no data found';
      $ressult['message'] = 'unsuccessfull';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type:application/json');
    echo json_encode($json);
    }

  /************* get_filter_list *************/
  public

  function get_filter_list()
    {
    $type = $this->input->get_post('type');
    $lat = $this->input->get_post('lat');
    $lon = $this->input->get_post('lon');
    $nearby = $this->input->get_post('nearby');
    $review = $this->input->get_post('review');
    $price = $this->input->get_post('price');
    if ($type == 'restaurant')
      {
      $list = $this->webservice_model->get_all('restaurant');
      if ($price != '')
        {
        $this->get_restaurant_item($price);
        die;
        }
      }
      else
      {
      $list = $this->webservice_model->get_all('shop');
      if ($price != '')
        {
        $this->get_shop_item($price);
        die;
        }
      }

    if ($list)
      {
      foreach($list as $val)
        {
        $distance = $this->webservice_model->distance($lat, $lon, $val['lat'], $val['lon'], $miles = false);
        if ($type == 'restaurant')
          {
          $get = $this->db->select_avg("rating", "rating")->where(['restaurant_id' => $val['id']])->get('restaurant_review')->result_array();
          $get_review = $this->db->where(['restaurant_id' => $val['id']])->get('restaurant_review')->result_array();
          $review_count = $this->db->where(['restaurant_id' => $val['id']])->get('restaurant_review')->num_rows();
          }
          else
          {
          $get = $this->db->select_avg("rating", "rating")->where(['shop_id' => $val['id'], 'review' => ''])->get('shop_review')->result_array();
          $get_review = $this->db->where(['shop_id' => $val['id']])->get('shop_review')->result_array();
          $review_count = $this->db->where(['shop_id' => $val['id']])->get('shop_review')->num_rows();
          $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
          $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
          $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
          $val['image4'] = SITE_URL . 'uploads/images/' . $val['image4'];
          }

        $reviews = array();
        foreach($get_review as $rev)
          {
          if ($rev['review'] != '')
            {
            $user_id = $rev['user_id'];
            $users = $this->webservice_model->get_where('users', ['id' => $user_id]);
            $reviews[] = ['username' => $users[0]['username'], 'review' => $rev['review']];
            }
          }

        $rating = ($get[0]['rating'] == '') ? 0 : $get[0]['rating'];
        $val['review_count'] = $review_count;
        $val['rating'] = $rating;
        $val['review'] = $reviews;
        $val['distance'] = number_format($distance, 2);
        $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
        if ($nearby == 'filter' && $distance <= 5)
          {
          $data[] = $val;
          }
          else
        if ($review == 'filter')
          {
          $data[] = $val;
          }
        }

      if (!isset($data))
        {
        $ressult['result'] = 'Data Not Found';
        $ressult['message'] = 'unsuccessful';
        $ressult['status'] = '0';
        $json = $ressult;
        header('Content-type: application/json');
        echo json_encode($json);
        die;
        }

      if ($review == 'filter')
        {
        $dis = array();
        foreach($data as $key => $row)
          {
          $dis[$key] = $row['review_count'];
          }

        array_multisort($dis, SORT_DESC, $data);
        }
        else
        {
        $dis = array();
        foreach($data as $key => $row)
          {
          $dis[$key] = $row['distance'];
          }

        array_multisort($dis, SORT_ASC, $data);
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* get_shop_item *************/
  public

  function get_shop_item($price)
    {
    $list = $this->webservice_model->get_where('shop_sub_cat', "price <= $price");

    // echo $this->db->last_query(); die;
    // print_r($lis);

    if ($list)
      {
      foreach($list as $val)
        {
        $get_data = $this->db->where('item_id', $val['id'])->get('shop_color')->result_array();
        $val['cours'] = $get_data;
        $get_data = $this->db->where('item_id', $val['id'])->get('shop_size')->result_array();
        $val['size'] = $get_data;
        $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
        $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
        $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
        $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
        $val['image4'] = SITE_URL . 'uploads/images/' . $val['image4'];
        $data[] = $val;
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* get_restaurant_item *************/
  public

  function get_restaurant_item()
    {
    $list = $this->webservice_model->get_where('restaurant_sub_cat', "price <= $price");

    // print_r($lis);

    if ($list)
      {
      foreach($list as $val)
        {
        $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
        $data[] = $val;
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* delete_cart_item1 *************/
  public

  function delete_cart_item1()
    {
    $id = $this->input->get_post('cart_id');
    $list = $this->webservice_model->get_where('add_to_cart', ['id' => $id]);
    if ($list)
      {
      $this->webservice_model->delete_data('add_to_cart', ['id' => $id]);
      $ressult['result'] = "Item delete successfull";
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /*************  place_order *************/
//  public

//   function place_order1()
//     {
//     $arr_data = array(
//       'user_id' => $this->input->get_post('user_id') ,
//       'full_name' => $this->input->get_post('full_name') ,
//       'address' => $this->input->get_post('address') ,
//       'mobile' => $this->input->get_post('mobile') ,
//       'country' => $this->input->get_post('country') ,
//       'state' => $this->input->get_post('state') ,
//       'city' => $this->input->get_post('city') ,
//       'zip_code' => $this->input->get_post('zip_code')
//     );
//     $where = ['user_id' => $arr_data['user_id']];
//     $fetch = $this->webservice_model->get_where('user_address', $where);
//     if ($fetch)
//       {
//       $this->webservice_model->update_data('user_address', $arr_data, $where);
//       $address_id = $fetch[0]['id'];
//       }
//       else
//       {
//       $address_id = $this->webservice_model->insert_data('user_address', $arr_data);
//       }

//     $order_id = $this->webservice_model->generateRandomString(8);
//     $delivery_date = date('Y-m-d', strtotime("+3 days"));
//     $arr_ord = array(
//       'user_id' => $this->input->get_post('user_id') ,
//       'cart_id' => $this->input->get_post('cart_id') ,
//       'address_id' => $address_id,
//       'order_id' => $order_id,
//       'delivery_date' => $delivery_date
//     );
//     $type = "COD";
//     $cart_ids = explode(",", $arr_ord['cart_id']);
//     foreach($cart_ids as $ids)
//       {
//       $arr_ord['cart_id'] = $ids;
//       $order = $this->webservice_model->insert_data('place_order', $arr_ord);
//       $cart = $this->webservice_model->get_where('add_to_cart', ['id' => $ids]);
//       if ($cart[0]['type'] == 'shop')
//         {
//         $get = $this->webservice_model->get_where('shop_sub_cat', ['id' => $cart[0]['item_id']]);
//         }
//         else
//         {
//         $get = $this->webservice_model->get_where('restaurant_sub_cat', ['id' => $cart[0]['item_id']]);
//         }

//       $admin = $this->webservice_model->get_where('admin', ['id' => $get[0]['user_id']]);
//       $cntry = $this->webservice_model->get_where('country', ['currency' => $get[0]['currancy']]);
//       if ($cntry[0]['country'] != $arr_data['country'])
//         {
//         $type = "PAYBLE";
//         }

//       /* start code for send email */
//       $to = $admin[0]['email'];
//       $subject = "Your product is sell out";
//       $body = "<div style='max-width: 600px; width: 100%; margin-left: auto; margin-right: auto;'>
//         <header style='color: #fff; width: 100%;'><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
//           <img alt='' src='" . SITE_URL . "uploads/images/logo.png' width ='120' height='120'/>
//         </header>
        
//         <div style='margin-top: 10px; padding-right: 10px; 
//       padding-left: 125px;
//       padding-bottom: 20px;'>
//           <hr>
//           <h3 style='color: #232F3F;'>Hello " . $admin[0]['name'] . ",</h3>
//           <p>You product of " . $get[0]['name'] . " is purchase by user " . $arr_data['full_name'] . ".</p>
//           <p>Its mobile number is <span style='background:#2196F3;color:white;padding:0px 5px'>" . $arr_data['mobile'] . "</span></p>
//           <hr>
          
//             <p>Warm Regards<br />SNIFF<br />Support Team</p>
            
//           </div>
//         </div>

//     </div>";
//       $headers = "From: info@123.com" . "\r\n";
//       $headers.= "MIME-Version: 1.0" . "\r\n";
//       $headers.= "Content-type:text/html;charset=UTF-8" . "\r\n";
//       mail($to, $subject, $body, $headers);
//       /* end code for send email */
//       }

//     if ($order != "")
//       {
//       $single_data = ['order_id' => $order_id];
//       $fetch_order = $this->webservice_model->get_where('place_order', $single_data);
//       $ressult['result'] = $fetch_order;
//       $ressult['pay_method'] = $type;
//       $ressult['message'] = 'successful';
//       $ressult['status'] = '1';
//       $json = $ressult;
//       }
//       else
//       {
//       $ressult['result'] = 'Data Not Found';
//       $ressult['message'] = 'unsuccessful';
//       $ressult['status'] = '0';
//       $json = $ressult;
//       }

//     header('Content-type: application/json');
//     echo json_encode($json);
//     }

  /*************  payment1 *************/
  public

  function payment1()
    {
    $arr_data = array(
      'user_id' => $this->input->get_post('user_id') ,
      'order_id' => $this->input->get_post('order_id') ,
      'payment_method' => $this->input->get_post('payment_method') ,
      'total_amount' => $this->input->get_post('total_amount')
    );
    $pay = $this->webservice_model->insert_data('payment', $arr_data);
    $this->webservice_model->update_data('place_order', ['status' => 'Complete'], ['order_id' => $arr_data['order_id']]);
    $get_order = $this->webservice_model->get_where('place_order', ['order_id' => $arr_data['order_id']]);
    $cart_ids = explode(",", $get_order[0]['cart_id']);
    foreach($cart_ids as $ids)
      {
      $this->webservice_model->update_data('add_to_cart', ['status' => 'Complete'], ['id' => $ids]);
      }

    if ($pay != "")
      {
      $single_data = ['id' => $pay];
      $fetch_order = $this->webservice_model->get_where('payment', $single_data);
      $ressult['result'] = $fetch_order[0];
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* get_order *************/
  public

  function get_order()
    {
    $user_id = $this->input->get_post('user_id');
    $list = $this->webservice_model->get_where('place_order', ['user_id' => $user_id]);

    // print_r($lis);

    if ($list)
      {
      foreach($list as $val)
        {
        $item_data = $item = [];
        $cart_ids = explode(",", $val['cart_id']);
        foreach($cart_ids as $ids)
          {
          $fetch = $this->webservice_model->get_where('add_to_cart', ['id' => $ids]);
          if ($fetch[0]['type'] == 'shop')
            {
            $get = $this->webservice_model->get_where('shop_sub_cat', ['id' => $fetch[0]['item_id']]);
            }
            else
            {
            $get = $this->webservice_model->get_where('restaurant_sub_cat', ['id' => $fetch[0]['item_id']]);
            }

          $item['id'] = $ids;
          $item['item_name'] = $get[0]['name'];
          $item['image'] = SITE_URL . 'uploads/images/' . $get[0]['image'];
          $item_data[] = $item;
          }

        $val['item_data'] = $item_data;
        $data[] = $val;
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* get_search_list *************/
  public

  function get_search_list()
    {
    $type = $this->input->get_post('type');
    $lat = $this->input->get_post('lat');
    $lon = $this->input->get_post('lon');
    $search = $this->input->get_post('search');
    $data = array();
    if ($type == 'restaurant')
      {
      $list = $this->webservice_model->get_where('restaurant', "name LIKE '%$search%'");
      $return = $this->get_restaurant_search($search);
      if ($return)
        {
        $data = $return;
        }
      }
      else
      {
      $list = $this->webservice_model->get_where('shop', "name LIKE '%$search%'");
      $return = $this->get_shop_search($search);
      if ($return)
        {
        $data = $return;
        }
      }

    // print_r($data); die;

    if ($list)
      {
      foreach($list as $val)
        {
        $distance = $this->webservice_model->distance($lat, $lon, $val['lat'], $val['lon'], $miles = false);
        $videos = $reviews = array();
        if ($type == 'restaurant')
          {
          $get = $this->db->select_avg("rating", "rating")->where(['restaurant_id' => $val['id']])->get('restaurant_review')->result_array();
          $get_review = $this->db->where(['restaurant_id' => $val['id']])->get('restaurant_review')->result_array();
          }
          else
          {
          $get = $this->db->select_avg("rating", "rating")->where(['shop_id' => $val['id']])->get('shop_review')->result_array();
          $get_review = $this->db->where(['shop_id' => $val['id']])->get('shop_review')->result_array();
          $get_video = $this->db->where(['item_id' => $val['id']])->get('shop_video')->result_array();
          foreach($get_video as $vid)
            {
            $vid['video'] = SITE_URL . 'uploads/images/' . $vid['video'];
            $videos[] = $vid;
            }

          $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
          $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
          $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
          $val['image4'] = SITE_URL . 'uploads/images/' . $val['image4'];
          }

        $val['discount_img'] = SITE_URL . 'uploads/images/' . $val['discount_img'];
        foreach($get_review as $rev)
          {
          if ($rev['review'] != '')
            {
            $user_id = $rev['user_id'];
            $users = $this->webservice_model->get_where('users', ['id' => $user_id]);
            $reviews[] = ['username' => $users[0]['username'], 'review' => $rev['review']];
            }
          }

        $rating = ($get[0]['rating'] == '') ? 0 : $get[0]['rating'];
        $val['videos'] = $videos;
        $val['rating'] = $rating;
        $val['review'] = $reviews;
        $val['distance'] = number_format($distance, 2);
        $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
        $data[] = $val;
        }
      }

    if ($data)
      {
      $arr = [];
      foreach($data as $items)
        {
        if (!in_array($items['id'], $arr))
          {
          $array[] = $items;
          $arr[] = $items['id'];
          }
        }

      $ressult['result'] = $array;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* get_shop_search *************/
  public

  function get_shop_search($search)
    {
    $list = $this->webservice_model->get_where('shop_sub_cat', "name LIKE '%$search%' GROUP BY shop_id");

    // print_r($lis);

    if ($list)
      {
      $ids = "";
      foreach($list as $vals)
        {
        if ($ids == "")
          {
          $ids = $vals['shop_id'];
          }
          else
          {
          $ids = $ids . "," . $vals['shop_id'];
          }
        }

      $shopList = $this->webservice_model->get_where('shop', "id IN($ids)");
      foreach($shopList as $val)
        {
        $videos = $reviews = array();
        $get = $this->db->select_avg("rating", "rating")->where(['shop_id' => $val['id']])->get('shop_review')->result_array();
        $get_review = $this->db->where(['shop_id' => $val['id']])->get('shop_review')->result_array();
        $get_video = $this->db->where(['item_id' => $val['id']])->get('shop_video')->result_array();
        foreach($get_video as $vid)
          {
          $vid['video'] = SITE_URL . 'uploads/images/' . $vid['video'];
          $videos[] = $vid;
          }

        $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
        $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
        $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
        $val['image4'] = SITE_URL . 'uploads/images/' . $val['image4'];
        $val['discount_img'] = SITE_URL . 'uploads/images/' . $val['discount_img'];
        foreach($get_review as $rev)
          {
          if ($rev['review'] != '')
            {
            $user_id = $rev['user_id'];
            $users = $this->webservice_model->get_where('users', ['id' => $user_id]);
            $reviews[] = ['username' => $users[0]['username'], 'review' => $rev['review']];
            }
          }

        $rating = ($get[0]['rating'] == '') ? 0 : $get[0]['rating'];
        $val['videos'] = $videos;
        $val['rating'] = $rating;
        $val['review'] = $reviews;
        $val['distance'] = '';
        $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
        $data[] = $val;
        }

      return $data;
      }
      else
      {
      return false;
      }
    }

  /************* get_restaurant_search *************/
  public

  function get_restaurant_search($search)
    {
    $list = $this->webservice_model->get_where('restaurant_sub_cat', "name LIKE '%$search%' GROUP BY restaurant_id");

    // print_r($lis);

    if ($list)
      {
      $ids = "";
      foreach($list as $vals)
        {
        if ($ids == "")
          {
          $ids = $vals['restaurant_id'];
          }
          else
          {
          $ids = $ids . "," . $vals['restaurant_id'];
          }
        }

      $restaurantList = $this->webservice_model->get_where('restaurant', "id IN($ids)");
      foreach($restaurantList as $val)
        {
        $reviews = array();
        $get = $this->db->select_avg("rating", "rating")->where(['restaurant_id' => $val['id']])->get('restaurant_review')->result_array();
        $get_review = $this->db->where(['restaurant_id' => $val['id']])->get('restaurant_review')->result_array();
        $val['discount_img'] = SITE_URL . 'uploads/images/' . $val['discount_img'];
        foreach($get_review as $rev)
          {
          if ($rev['review'] != '')
            {
            $user_id = $rev['user_id'];
            $users = $this->webservice_model->get_where('users', ['id' => $user_id]);
            $reviews[] = ['username' => $users[0]['username'], 'review' => $rev['review']];
            }
          }

        $rating = ($get[0]['rating'] == '') ? 0 : $get[0]['rating'];
        $val['rating'] = $rating;
        $val['review'] = $reviews;
        $val['distance'] = '';
        $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
        $data[] = $val;
        }

      return $data;
      }
      else
      {
      return false;
      }
    }

  /*************  get_my_order *************/
  public

  function get_my_order()
    {
    $user_id = $this->input->get_post('user_id');
    $where = "(user_id = '$user_id') AND (status = 'Complete' OR status = 'Waiting' OR status = 'Way') ";
    $fetch = $this->webservice_model->get_where('place_order', $where);
    if ($fetch)
      {
      foreach($fetch as $val)
        {
        $cart = $this->webservice_model->get_where('add_to_cart', ['id' => $val['cart_id']]);
        if ($cart[0]['type'] == 'shop')
          {
          $get = $this->webservice_model->get_where('shop_sub_cat', ['id' => $cart[0]['item_id']]);
          $get[0]['image1'] = SITE_URL . 'uploads/images/' . $get[0]['image1'];
          $get[0]['image2'] = SITE_URL . 'uploads/images/' . $get[0]['image2'];
          $get[0]['image3'] = SITE_URL . 'uploads/images/' . $get[0]['image3'];
          $get[0]['image4'] = SITE_URL . 'uploads/images/' . $get[0]['image4'];
          $get_data = $this->db->where('item_id', $cart[0]['item_id'])->get('shop_color')->result_array();
          $val['cours'] = $get_data;
          $get_data = $this->db->where('item_id', $cart[0]['item_id'])->get('shop_size')->result_array();
          $val['size'] = $get_data;
          }
          else
          {
          $get = $this->webservice_model->get_where('restaurant_sub_cat', ['id' => $cart[0]['item_id']]);
          }

        $get[0]['image'] = SITE_URL . 'uploads/images/' . $get[0]['image'];
        $total[] = ($get[0]['price'] * $cart[0]['quantity']);
        $val['product'] = $get[0];
        $val['quantity'] = $cart[0]['quantity'];
        $data[] = $val;
        }

      $ressult['total'] = array_sum($total);
      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /*************  contact_info *************/
  public

  function contact_info()
    {
    $arr_data = array(
      'email' => $this->input->get_post('email') ,
      'message' => $this->input->get_post('message') ,
      'phone' => $this->input->get_post('phone')
    );
    $fetch = $this->webservice_model->insert_data('contact_info', $arr_data);
    if ($fetch != "")
      {
      $single_data = ['id' => $fetch];
      $fetch_order = $this->webservice_model->get_where('contact_info', $single_data);
      $ressult['result'] = $fetch_order[0];
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /*************  country_list *************/
  public

  function country_list()
    {
    $fetch = $this->webservice_model->get_all('country');
    if ($fetch)
      {
      foreach($fetch as $val)
        {
        $data[] = $val;
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  /************* get_offer_list *************/
  public

  function get_offer_list()
    {
    $list = $this->webservice_model->get_where('shop_sub_cat', ['offer' => 'YES']);
    if ($list)
      {
      foreach($list as $val)
        {
        $videos = array();
        $get_video = $this->db->where(['item_id' => $val['id']])->get('shop_video')->result_array();
        foreach($get_video as $vid)
          {
          $vid['video'] = SITE_URL . 'uploads/images/' . $vid['video'];
          $videos[] = $vid;
          }

        $val['image1'] = SITE_URL . 'uploads/images/' . $val['image1'];
        $val['image2'] = SITE_URL . 'uploads/images/' . $val['image2'];
        $val['image3'] = SITE_URL . 'uploads/images/' . $val['image3'];
        $val['image4'] = SITE_URL . 'uploads/images/' . $val['image4'];
        $val['videos'] = $videos;
        $val['distance'] = '';
        $val['image'] = SITE_URL . 'uploads/images/' . $val['image'];
        $data[] = $val;
        }

      $ressult['result'] = $data;
      $ressult['message'] = 'successful';
      $ressult['status'] = '1';
      $json = $ressult;
      }
      else
      {
      $ressult['result'] = 'Data Not Found';
      $ressult['message'] = 'unsuccessful';
      $ressult['status'] = '0';
      $json = $ressult;
      }

    header('Content-type: application/json');
    echo json_encode($json);
    }

  function get_token_key123()
    {
    $uri = "https://api.stripe.com\Stripe\Charge::create(array(
  'amount' => 2000,
  'currency' => 'usd',
  'source' => 'tok_189gKA2eZvKYlo2CfUDZuPeT', 
  'metadata' => array('order_id' => '6735')))";
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $uri
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err)
      {
      echo "cURL Error #:" . $err;
      }
      else
      {
      echo $response;
      }
    }

    public function update_chat_status(){
    $res = array('status' => FALSE, 'message' => 'Input parameter incorrect,please try again!');
      $chat_id = $this->input->get_post('chat_id',TRUE)?$this->input->get_post('chat_id'):"";
      $status = $this->input->get_post('status',TRUE)?$this->input->get_post('status',TRUE):"";
      if(!$chat_id || !$status){
          $res['status'] = FALSE;
          $res['message'] = "Parameter mismatch,please try again!";
      }else{
          $chat_id = explode(",",$chat_id);
          $arr_data['update_chat_status'] = $status;
          $result = $this->webservice_model->update_chat_status('kaise_chat_detail',$arr_data,$chat_id); 
          if($result){
              $res['status'] = TRUE;
              $res['message'] = "Chat status updated successfully!";
          }else{
              $res['status'] = FALSE;
              $res['message'] = "Chat status update failed!";
          }
      }
      
     echo json_encode($res);
     exit;
    }
    
    public function add_device_Token(){
      //  $this->ios_notification();
    $res = array('status' => FALSE, 'message' => 'Input parameter incorrect,please try again!');
      $user_id = $this->input->get_post('user_id',TRUE)?$this->input->get_post('user_id'):"";
      $device_type = $this->input->get_post('device_type',TRUE)?$this->input->get_post('device_type',TRUE):"0";
      $device_token = $this->input->get_post('device_token',TRUE)?$this->input->get_post('device_token',TRUE):"0";
      if(!$user_id || !$device_type || !$device_token){
          $res['status'] = FALSE;
          $res['message'] = "Parameter mismatch,please try again!";
      }else{          
        $arr_get = ['id'=>$this->input->get_post('user_id')];      
       $arr_data = [           
            'device_type'=>$device_type,
            'device_token'=>$device_token
            ];
        $response = $this->webservice_model->update_data('users',$arr_data,$arr_get);
        if($response){
            $res['status'] = TRUE;
            $res['message'] = "Token save successfully!";       
        }else{
          $res['status'] = FALSE;
        $res['message'] = "Token save failed!";         
        }
        
      }
      
     echo json_encode($res);
     exit;
    }
    
     // Sends Push notification for iOS users
    public function ios_notification($devicetoken = null,$data = '',$chat_mesage, $sendername = '', $title = ''){
            $url = "https://fcm.googleapis.com/fcm/send";
            $token = $devicetoken;
          //  $token = 'eEZicIioZeA:APA91bHg1ids0dwhitnreWhZiaxk6mEzbTMQnLZ4HalrcqA2imUUOBOltvTfCTkovRSnIsU7e7Yea2zIRIHMNtcZlXZ8gK7VfchLcE_fZzZE6OSrazL8DpPvzLY-k84kvm5AygR2Y5A6';
            $serverKey = 'AAAAMS9GD6E:APA91bGzvIgwjhGaCFam_IkyBuN9UNH3HqMMhlEDoYR07aNcgHvYVSwFryk7OCvIZlaSfs660bCOfB0Anmtkn6TKXeARzxcZKlGkyx6Hhd4iLRXLnzPMW0Kz17YQqYCjXLWtDieI5j6I';
            $title =$title;
          //  $body = json_encode($data);
            $body = $data;
            // $notification = array('title' => $title  ,'body' => $title, 'sound' => 'default', 'badge' => '1' , 'alert_type' => $title  );
            $notification = array('title' => 'OhCityZgz'  ,'body' => $sendername, 'sound' => 'default', 'badge' => '1' , 'alert_type' => $title , 'nofityData' => $data  );
            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
            $json = json_encode($arrayToSend);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key='. $serverKey;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //Send the request
            $response = curl_exec($ch);
            
            //Close request
            if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
        
            return true;
            
    }
    
     // Sends Push notification for iOS users
    public function ios_bulk_notification($devicetoken = null,$data = '',$chat_mesage, $sendername = '', $title = ''){
            $url = "https://fcm.googleapis.com/fcm/send";
            $token = json_encode([$devicetoken]);
          //  $token = 'eEZicIioZeA:APA91bHg1ids0dwhitnreWhZiaxk6mEzbTMQnLZ4HalrcqA2imUUOBOltvTfCTkovRSnIsU7e7Yea2zIRIHMNtcZlXZ8gK7VfchLcE_fZzZE6OSrazL8DpPvzLY-k84kvm5AygR2Y5A6';
            $serverKey = 'AAAAMS9GD6E:APA91bGzvIgwjhGaCFam_IkyBuN9UNH3HqMMhlEDoYR07aNcgHvYVSwFryk7OCvIZlaSfs660bCOfB0Anmtkn6TKXeARzxcZKlGkyx6Hhd4iLRXLnzPMW0Kz17YQqYCjXLWtDieI5j6I';
            $title =$title;
          //  $body = json_encode($data);
            $body = $data;
            // $notification = array('title' => $title  ,'body' => $title, 'sound' => 'default', 'badge' => '1' , 'alert_type' => $title  );
            $notification = array('title' => 'OhCityZgz'  ,'body' => $sendername, 'sound' => 'default', 'badge' => '1' , 'alert_type' => $title , 'nofityData' => $data  );
            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
            $json = json_encode($arrayToSend);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key='. $serverKey;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
            //Send the request
            $response = curl_exec($ch);
            
            //Close request
            if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
        
            return true;
            
    }
    
    public function test_notification(){
       ini_set('max_execution_time', 600);
        ini_set('memory_limit','16M');
        $url = 'https://gateway.sandbox.push.apple.com:2195';
$cert = base_url().'assets/OhCityCertificate.pem';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSLCERT, $cert);
curl_setopt($ch, CURLOPT_SSLCERTPASSWD, "passphrase@122");
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"device_tokens": ["aa343e95af5d942b4caade8f30ae1c34ed1e7652532b3c1e0c3f053331dd74ad"], "aps": {"alert": "test message one!"}}');

$curl_scraped_page = curl_exec($ch);
print_r($ch);die;
        /*$deviceToken = 'aa343e95af5d942b4caade8f30ae1c34ed1e7652532b3c1e0c3f053331dd74ad';
$passphrase = 'ASDFGREW@@';
$message = 'Test Notification';
$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', base_url().'assets/OhCityCertificate.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
var_dump($fp);die;
$body['aps'] = array('alert' => $message,'sound' => 'default');
$payload = json_encode($body);
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
$result = fwrite($fp, $msg, strlen($msg));
print_r($result);
fclose($fp);*/
        /*$notifyTo = array('token'=>
'aa343e95af5d942b4caade8f30ae1c34ed1e7652532b3c1e0c3f053331dd74ad','sound'=>'default','title'=>'mr','body'=>'Test Notification'
);
$passphrase = '';
        foreach($notifyTo as $key => $activity ){
                    $token = $activity['token']; 
                    $title = $activity['title'];
                    $data = $activity['body'];
                    $sound = $activity['sound'];
                    $notification_type=$activity['notification_type'];
                    $passphrase='';
            $Certificate= $_SERVER["DOCUMENT_ROOT"].'assets/OhCityCertificate.pem';
            #echo $Certificate;die;
                    //config_path('certificate.pem');

                $ctx = stream_context_create();
                stream_context_set_option($ctx, 'ssl', 'local_cert', $Certificate);
                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

            //  $fp =stream_socket_client(
            //          'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

                 $fp =stream_socket_client(
                         'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
                //    var_dump($fp);die;

                if (!$fp)
                    exit("Failed to connect: $err $errstr" . PHP_EOL);

                $body['aps']=[
                    'alert' => $title,
                    'data'  => $data,
                    'sound' => 'default',
                    'notification_type' => $notification_type,
                    //'alert'=>"dsfdsfsdfsdf"
                    'badge' => 1,
                ];

                $payload = json_encode($body);
                $msg=chr(0).pack('n', 32).pack('H*', trim($token)) . pack('n', strlen($payload)).$payload;
                $result=fwrite($fp, $msg, strlen($msg));
                fclose($fp);
                print_r($result);
            }*/
    }
    
    
  // end class
  
    public function get_issueList(){

      $issues = $this->webservice_model->get_all('report_issue_categories');

       header('Content-type: application/json');
       echo json_encode(['status' => true  , 'message' => 'data found' , 'data' => $issues]);
       die;
    }

    public function report_issue(){

      header('Content-type: application/json');
      
      $user_id       = $this->input->get_post('user_id');
      $product_id    = $this->input->get_post('product_id');
      $issue_id      = $this->input->get_post('issue_id');

      if(empty($user_id) || is_null($user_id)){
         echo json_encode(['status' => false , 'message' => 'user id field is required']);
         die;
      }

      if(empty($product_id) || is_null($product_id)){
         echo  json_encode(['status' => false , 'message' => 'product id field is required']);
         die;
      }

      if(empty($issue_id) || is_null($issue_id)){
         echo  json_encode(['status' => false , 'message' => 'issue id field is required']);
         die;
      }

      $where = [
         'user_id'    => $user_id,
         'product_id' => $product_id,
         'issue_id'   => $issue_id
      ];

      $isExist = $this->webservice_model->get_where('product_issues' , $where);
      
      if($isExist){
        echo json_encode(['status' => false  , 'message' => 'Already submited issue']);
        die;
      }
     
      $data = [
          'user_id'    => $user_id,
          'product_id' => $product_id,
          'issue_id'   => $issue_id,
      ];

     $status = $this->webservice_model->insert_data('product_issues' , $data);
    
     if($status > 0 ){
       $response = json_encode(['status' => true  , 'message' => 'Successfully submited issue' , 'data' => $user_id]);
     }else{
       $response = json_encode(['status' => false  , 'message' => 'Failed to submit issue']);
     }

      echo $response;
      die;

    }
    
          public function remove_chat(){

      header('Content-type: application/json');

        try {
          
        $sender_id = $this->input->get_post('sender_id', TRUE);
        $receiver_id = $this->input->get_post('receiver_id', TRUE);
        $product_id = $this->input->get_post('product_id', TRUE);

        if(empty($sender_id) || is_null($sender_id)){
         echo json_encode(['status' => false , 'message' => 'sender id field is required']);
         die;
        }

        if(empty($receiver_id) || is_null($receiver_id)){
         echo json_encode(['status' => false , 'message' => 'receiver id field is required']);
         die;
        }

        if(empty($product_id) || is_null($product_id)){
          echo json_encode(['status' => false , 'message' => 'product id field is required']);
          die;
        }

        $this->db->where('sender_id', $sender_id);
        $this->db->where('receiver_id', $receiver_id);
        $this->db->where('product_id', $product_id);
        $this->db->or_where('sender_id', $receiver_id);
        $this->db->where('receiver_id', $sender_id);
        $info = $this->db->get('kaise_chat_detail');
        $chat = $info->result_array();

        if(!empty($chat) && !is_null($chat)){
           
            foreach($chat as $val)
            {
              $exp1 = $exp2 = "";
              $clr_id = $val['clear_chat'];
              $exp = explode(',', $clr_id);
              if (isset($exp[0])){
                $exp1 = $exp[0];
              }

              if (isset($exp[1])){
                $exp2 = $exp[1];
              }

              if (empty($clr_id) || is_null($clr_id)){
                  $arr_where = ['id' => $val['id']];
                  $this->webservice_model->update_data('kaise_chat_detail', ['clear_chat' => $receiver_id], $arr_where);
             //   $this->webservice_model->delete_data('kaise_chat_detail', $arr_where);
              }else{
                $arr_where = ['id' => $val['id']];
                  if($exp1 == $receiver_id){
                       $exp1 = $sender_id;
                   }
                $this->webservice_model->update_data('kaise_chat_detail', ['clear_chat' => $exp1 . ',' . $receiver_id], $arr_where);
              }
            }

            echo json_encode(['status' => false , 'message' => 'Successfully cleared chat']);
            die;

        }else{
           echo json_encode(['status' => false , 'message' => 'chat not available for delete']);
           die;
        }

        } catch (Exception $e) {
           echo json_encode(['status' => false , 'message' => $e->getMessages()]);
           die;
        }
    }
    
      public function block_user(){

       header('Content-type: application/json');

       try {

          $sender_id   = $this->input->get_post('sender_id', TRUE);
          $receiver_id = $this->input->get_post('receiver_id', TRUE);
          $product_id  = $this->input->get_post('product_id', TRUE);

          if(empty($sender_id) || is_null($sender_id)){
           echo json_encode(['status' => false , 'message' => 'sender id field is required']);
           die;
          }

          if(empty($receiver_id) || is_null($receiver_id)){
           echo json_encode(['status' => false , 'message' => 'receiver id field is required']);
           die;
          }

          if(empty($product_id) || is_null($product_id)){
            echo json_encode(['status' => false , 'message' => 'product id field is required']);
            die;
          }
         
         $data = [
              'product_id' => $product_id,
              'user_id '   => $sender_id,
              'block_id'   => $receiver_id,
          ];
          
         $isBlocked = $this->webservice_model->get_where('product_block_users' ,$data);

         if(!empty($isBlocked) && !is_null($isBlocked)){
           echo json_encode(['status' => false , 'message' => 'This user already blocked']);
           die;
         }

       $status = $this->webservice_model->insert_data('product_block_users' , $data);

       if($status > 0){
           echo json_encode(['status' => true , 'message' => 'Successfully blocked user']);
           die;
         }else{
           echo json_encode(['status' => false , 'message' => 'Failed to block user']);
           die;
         }
         
       } catch (Exception $e) {
           echo json_encode(['status' => false , 'message' => 'Something went wrong , plesae try letter']);
           die;
       }
    }
    
     function subcribe(){

      try {

         header('Content-type: application/json');

          $subscribe_by   = $this->input->get_post('user_id', TRUE);
          $subscribe_to   = $this->input->get_post('subscribe_user_id', TRUE);

          if(empty($subscribe_by) || is_null($subscribe_by)){
           echo json_encode(['status' => false , 'message' => 'user id field is required']);
           die;
          }

          if(empty($subscribe_to) || is_null($subscribe_to)){
           echo json_encode(['status' => false , 'message' => 'subcribe user id field is required']);
           die;
          }

          $data = [
             'subscribe_to' => $subscribe_to,
             'subscribe_by' => $subscribe_by,
             'created_at'   => date('Y-m-d H:i:s'),
          ];

          $where = [
             'subscribe_to' => $subscribe_to,
             'subscribe_by' => $subscribe_by,
          ];

            $login = $this->webservice_model->get_where('subscriptions',$where);

            if(!empty($login) && !is_null($login)){
                $this->webservice_model->delete_data('subscriptions', $where);

                echo json_encode(['status' => false , 'message' => 'Successfully unsubscribed']);
                die;
            }

            $status = $this->webservice_model->insert_data('subscriptions' , $data);

              if($status > 0){
                echo json_encode(['status' => true , 'message' => 'Successfully subscribed']);
                die;
              }else{
                echo json_encode(['status' => false , 'message' => 'Failed to subscribe']);
                die;
              }

        
      } catch (Exception $e) {
         echo json_encode(['status' => false , 'message' => 'Something went wrong,Please try letter']);
         die;
      }
    }

    function get_banner(){

      header('Content-type: application/json');
      
      $data = $this->webservice_model->get_all('banner');
    
        
      echo json_encode(['status' => true , 'message' => 'banner found' , 'url' => SITE_URL . 'uploads/images/' .  $data[0]['image'] ]);
      die;

    }

  
    
     function addProductNotification($user_id = null , $user_name ,$product_name = '??t'){


      header('Content-type: application/json');

      if($user_id){
          
          $data = $this->webservice_model->addProductNotification($user_id);

          if(!empty($data) && !is_null($data)){
                  
                  $user_message_apk = array(
                      "message" => array(
                      "result" => "successful",
                      "key" => "add new product",
                   //   "message" => "nuevo producto " . $product_name,
                        "message" => $user_name . " ha publicado un nuevo anuncio ",
                      "date" => date('Y-m-d h:i:s')
                    )
                  );
                  
             foreach ($data as $key => $value) {
          
               if(!is_null($value['device_token'])){
                  $this->ios_notification($value['device_token'],$user_message_apk,'Add Product', $user_name .'ha publicado un nuevo anuncio'); 
               }

               if(!is_null($value['register_id'])){
                   
                   $this->webservice_model->user_apk_notification([$value['register_id']], $user_message_apk );  
                   
               }

             }
          }
          
              
      }
    }
    
     function subscriptions_status(){

      header('Content-type: application/json');

      $subscribe_by =  $_POST['user_id'];
      $subscribe_to =  $_POST['subscribe_to'];
      
       if(empty($subscribe_by) || is_null($subscribe_by)){
           echo json_encode(['status' => false , 'message' => 'subscriber user id field is required']);
           die;
          }

      if(empty($subscribe_to) || is_null($subscribe_to)){
       echo json_encode(['status' => false , 'message' => 'subscribe user id field is required']);
       die;
      }

      $where = [
        'subscribe_to' => $subscribe_to ,
        'subscribe_by' => $subscribe_by,
      ];
      
      $data = $this->webservice_model->get_where('subscriptions' , $where);
      
      if(!empty($data) && !is_null($data)){
          echo json_encode(['status' => true , 'message' => 'success' , 'subscribe_status' => '1' ]);
          die;
      }

      echo json_encode(['status' => true , 'message' => 'success' , 'subscribe_status' => '0' ]);
      die;

    }
    
    
    
     public

function insert_category_group_chat()
  {
    
  //   date_default_timezone_set('Asia/Kolkata');
     
  $arr_data = array(
    'sender_id' => $this->input->get_post('sender_id', TRUE) ,
   // 'receiver_id' => $this->input->get_post('receiver_id', TRUE) ,
    'category_id' => $this->input->get_post('category_id', TRUE) ,
    'chat_message' => $this->input->get_post('chat_message', TRUE),
    'date' => date('Y-m-d H:i:s')
  );

  if(empty($arr_data['sender_id']) || is_null($arr_data['sender_id'])){
         echo json_encode(['status' => false , 'message' => 'Sender field is required']);
         die;
  }


  if(empty($arr_data['category_id']) || is_null($arr_data['category_id'])){
         echo json_encode(['status' => false , 'message' => ' Categirt field is required']);
         die;
  }

  if(empty($arr_data['chat_message']) || is_null($arr_data['chat_message'])){
         echo json_encode(['status' => false , 'message' => 'Message field is required']);
         die;
  }
  
  $where = [
     'category_id' => $arr_data['category_id'],
     'user_id'    => $arr_data['sender_id'],
    ];

  if (isset($_FILES['chat_image']))
    {
    $user_img = "CHAT_IMG_" . rand(1, 10000) . ".png";
    move_uploaded_file($_FILES['chat_image']['tmp_name'], "uploads/images/" . $user_img);
    $arr_data['chat_image'] = $user_img;
    }

  $res = $this->webservice_model->insert_data('category_group_chats', $arr_data);

  if ($res != "")
    {
    $single_data = array(
      'id' => $res
    );
    
    
    $user_r = $this->webservice_model->get_where('users', ['id' => $arr_data['sender_id']]);
  $category = $this->webservice_model->get_where('category', ['id' => $arr_data['category_id']]);

/*
  $iosUser     = $this->webservice_model->get_where('users', ['device_type' => '1' ]);
  $androidUser = $this->webservice_model->get_where('users', ['device_type' => '0' ]);
  
  $blockNotifyUser = $this->webservice_model->get_where('group_notification_subcriptions', ['group_id' => $arr_data['category_id']]);
  

  $iosUserIds  = array();
  $androidUserIds = array();
  $blockNotifiUsreIds = array();
  
  array_push($blockNotifiUsreIds,$arr_data['sender_id']);
  
  if($blockNotifyUser){
     foreach($blockNotifyUser as $key => $user){
      array_push($blockNotifiUsreIds , $user['user_id']);
     } 
  }
 
 
  foreach($iosUser as $key => $user){
      if(in_array($user['id'] , $blockNotifiUsreIds)){
          array_push($iosUserIds , $user['device_token']);
      }
  }
  

 foreach($androidUser as $key => $user){
    if(in_array($user['id'] , $blockNotifiUsreIds)){
       array_push($androidUserIds , $user['register_id']);
    }
  }
  
  */
  
  $iosTokens     = array();
  $androidTokens = array();
  $tokens        = array();
  
  $this->db->select(['u.device_token' , 'u.register_id']);
  $this->db->from('group_notification_subcriptions as gns');
  $this->db->join('users as u' , 'u.id = gns.user_id');
  $this->db->where('gns.user_id !=' , $arr_data['sender_id']);
  $sql= $this->db->get();
  if($sql->num_rows()>0){
    $userData = $sql->result_array();
    foreach($userData as $value){
        if($value['device_token']){
              array_push($iosTokens , $value['device_token']);            
        }
            
        if($value['register_id']){
           array_push($androidTokens , $value['register_id']);            
        }
    }
     
  }

  $user_message_apk = array(
    "message" => array(
      "result" => "successful",
      "key" => "You have a new group message",
      "message" => $arr_data['chat_message'],
      "chat_image" => $res[0]['chat_image'],
      "userid" => $user_r[0]['id'],
      "name" => $user_r[0]['first_name'] ,
      "category_id" => $category[0]['id'],
      "category_name" => $category[0]['category_name'] ,
      "userimage" => SITE_URL . "uploads/images/" . $user_r[0]['image'],
      "product_id" => "", 
      "date" => date('Y-m-d h:i:s')
    )
  );
  
  $register_userid = array(
    $user[0]['register_id']
  );
  
    $where = [
     'group_id'   => $arr_data['group_id'],
     'user_id'    => $arr_data['sender_id'],
    ];
    
    /*
    if($iosUserIds){
        foreach($iosUserIds as $value){
            
          $this->ios_notification($value,$user_message_apk,$arr_data['chat_message'],"Tienes un nuevo mensaje de ".$user_r[0]['first_name'],'You have a new group message');            
        }
    }
    
    if($androidUserIds){
           $this->webservice_model->user_apk_notification($androidUserIds, $user_message_apk);             
    } */

    
    if($androidTokens){
       $this->webservice_model->user_apk_notification($androidTokens, $user_message_apk);
    }
    
    if($iosTokens){
       
      foreach($iosTokens as $value){
          $this->ios_notification($value,$user_message_apk,$arr_data['chat_message'],"Tienes un nuevo mensaje de ".$user_r[0]['first_name'],'You have a new group message');            
     }
    }
    
    $fetch = $this->webservice_model->get_where('category_group_chats', $single_data);
    $fetch[0]['chat_image'] = SITE_URL . "uploads/images/" . $fetch[0]['chat_image'];
    $fetch[0]['result'] = "successful";
    $json = $fetch[0];
    }
    else
    {
    $json = array(
      "result" => "unsuccessful"
    );
    }

  header('Content-type: application/json');
  echo json_encode($json);
  }
  
  
public

function get_category_group_chat()
  {

  // $sender_id   = $this->input->get_post('sender_id', TRUE);
  $category_id = $this->input->get_post('category_id', TRUE);

  /* if(empty($sender_id) || is_null($sender_id)){
         echo json_encode(['status' => false , 'message' => 'Sender field is required']);
         die;
   } */

 if(empty($category_id) || is_null($category_id)){
         echo json_encode(['status' => false , 'message' => ' Category field is required']);
         die;
  }
  
 $chat = $this->db->query("SELECT * FROM (`category_group_chats`) WHERE  `category_id` = '$category_id' ORDER BY `id` DESC limit 200 ")->result_array();

  if ($chat)
    {
    $i = 0;
    foreach($chat as $val)
      {
      $sender = $this->webservice_model->get_where('users', ['id' => $val['sender_id']]);
      $category = $this->webservice_model->get_where('category', ['id' => $val['category_id']]);

      $sender[0]['sender_image'] = SITE_URL . 'uploads/images/' . $sender[0]['image'];
      
      $category[0]['name'] = $sender[0]['name'];

      $val['chat_image'] = SITE_URL . 'uploads/images/' . $val['chat_image'];
      $val['chat_message'] = trim($val['chat_message']);
      $val['result'] = "successful";
      $val['sender_detail'] = $sender[0];
      $val['category'] = $category[0]['category_name'];
      $date = date('Y-m-d H:i A' , strtotime($val['date']));
     // $date = date('Y-m-d H:i');
      $val['date'] = $date;
        $json[] = $val;
      }

    }
    else
    {
    $json[] = array(
      "result" => "unsuccessful"
    );
    }

  header('Content-type: application/json');
  echo json_encode($json);
  }
  
    function subcribe_group_notification(){

      try {

         header('Content-type: application/json');

          $user_id       = $this->input->get_post('sender_id', TRUE);
          $group_id      = $this->input->get_post('group_id', TRUE);

          if(empty($user_id) || is_null($user_id)){
           echo json_encode(['status' => false , 'message' => 'user id field is required']);
           die;
          }

          if(empty($group_id) || is_null($group_id)){
           echo json_encode(['status' => false , 'message' => 'group id field is required']);
           die;
          }

          $data = [
             'user_id' => $user_id,
             'group_id' => $group_id,
             'created_at'   => date('Y-m-d H:i:s'),
          ];

          $where = [
             'user_id' => $user_id,
             'group_id' => $group_id,
          ];

            $login = $this->webservice_model->get_where('group_notification_subcriptions',$where);

            if(!empty($login) && !is_null($login)){
                $this->webservice_model->delete_data('group_notification_subcriptions', $where);

                echo json_encode(['status' => false , 'message' => 'Successfully unsubscribed']);
                die;
            }

            $status = $this->webservice_model->insert_data('group_notification_subcriptions' , $data);

              if($status > 0){
                echo json_encode(['status' => true , 'message' => 'Successfully subscribed']);
                die;
              }else{
                echo json_encode(['status' => false , 'message' => 'Failed to subscribe']);
                die;
              }

        
      } catch (Exception $e) {
         echo json_encode(['status' => false , 'message' => 'Something went wrong,Please try letter']);
         die;
      }
    }
    
      function group_notification_subscribe_status(){
     
           header('Content-type: application/json');
  
           $sender_id   = $this->input->get_post('sender_id', TRUE);
           $group_id    = $this->input->get_post('group_id', TRUE);

           if(empty($sender_id) || is_null($sender_id)){
            echo json_encode(['status' => false , 'message' => 'user id field is required']);
            die;
           }

           if(empty($group_id) || is_null($group_id)){
             echo json_encode(['status' => false , 'message' => 'group id field is required']);
             die;
           }
         
         $data = [
              'group_id' => $group_id,
              'user_id '   => $sender_id,
          ];
          
         $isBlocked = $this->webservice_model->get_where('group_notification_subcriptions' ,$data);
         
           if(!empty($isBlocked) && !is_null($isBlocked)){
           echo json_encode(['status' => true , 'message' => 'success' , 'subscribe_status' => '1']);
           die;
         }else{
           echo json_encode(['status' => true , 'message' => 'success' , 'subscribe_status' => '0']);
           die;
         }
    }
    
    public function testImage(){
        
        $imageQaulity = 25;
        if (isset($_FILES['image'])){
          $n = rand(0, 100000);
        $img = "PRODUCT_IMG_" . $n . '.png';
        $this->compressImage($_FILES['image']['tmp_name'] , 'uploads/thumbnail/'.$img , $imageQaulity );
        $arr_data['image'] = $img;
       }
       die('hello');
    }
    
    function compressImageBackUp($source_url, $destination_url, $quality) {

    $info = getimagesize($source_url);

        if ($info['mime'] == 'image/jpeg')
              $image = imagecreatefromjpeg($source_url);

        elseif ($info['mime'] == 'image/gif')
              $image = imagecreatefromgif($source_url);

      elseif ($info['mime'] == 'image/png')
              $image = imagecreatefrompng($source_url);

        imagejpeg($image, $destination_url, $quality);

    }
    
         public function compressImage($source_url, $destination_url, $quality) {
  
        $pic = new Imagick($source_url);
        //$exif = exif_read_data($source_url); //parameter should be image path
        $exif['Orientation'] = $pic->getImageOrientation();

        if (isset($exif['Orientation'])) {

                            switch ($exif['Orientation']) {

                                case 3:

                                    $pic->rotateImage("#cccccc", 180);

                                    break;

                                case 6:

                                    $pic->rotateImage("#cccccc", -90);

                                    break;

                                case 8:

                                    $pic->rotateImage("#cccccc", 90);

                                    break;

                            }

        }
        
        $width  = $pic->getImageWidth();
        $height = $pic->getImageHeight();

        // if($width > 1000){
        //   $width = 1000;
        // }

        // Resize the image 
        $pic->resizeImage( $width, $height, Imagick::FILTER_LANCZOS, 1);
        $pic->setCompressionQuality($quality);
        $pic->setImageFormat('png');
        $pic->writeImage($destination_url);                             
        $pic->destroy();
 
 }
    
    
    public function redirectPlayStore(){
      header("Location: https://play.google.com/store/apps/details?id=com.tech.ohcity&hl=en");      
    }
    
    public function redirectAppStore(){
      header("Location: http://www.facebook.com/");      
    }
    
   
   public function  getUserProductRating(){

     $user_id   = $this->input->get('user_id');
     $loginId   = $user_id;

    // $sql  = "SELECT user_id as id , image , first_name , last_name ,CONCAT(first_name , ' ' , last_name) as name , SUM(rating) as rating from rating INNER JOIN users on rating . user_id = users . id GROUP BY (users.id) limit 20
//";
     $sql = "SELECT user_id as id , image , first_name , last_name ,CONCAT(first_name , ' ' , last_name) as name , SUM(rating) as rating FROM `rating` INNER JOIN users on rating . user_id = users . id GROUP BY (rating.user_id) order by (sum(rating)) desc limit 20 ";

     $results = $this->db->query($sql)->result_array();
     
     if(empty($results) || is_null($results)){
       echo json_encode(['status' => false , 'message' => 'Record not found' ]);
       die;
     }
               $pr = array();
               foreach ($results as $key => $row)
               {
                 $pr[$key] = $row['rating'];
               }
               array_multisort($pr, SORT_DESC, $results); 
               
      $i = 0;
     foreach ($results as $key => $result) {
        $results[$key]['user_image'] = SITE_URL.'uploads/images/'.$result['image'];
         $user_id = $result['id'];
        
         $is_liked = $this->db->query("SELECT *  FROM `user_likes` WHERE `liked_user_id` = $user_id AND `user_id` = $loginId")->result_array();
         $buy     = $this->db->query("select * from product WHERE buy_user_id = '$user_id' AND status = 'Sold'")->result_array();
         $sold    = $this->db->query("select * from product WHERE user_id = '$user_id' AND status = 'Sold'")->result_array();
         $likes   = count($is_liked);
         $sold    = count($sold);
         $buy     = count($buy);

        $results[$key]['likes']            = $likes > 0 ? '1' : '0';
        $results[$key]['total_products']   = $sold + $buy; 
        $results[$key]['buy_products']     = $buy;
        $results[$key]['sold_products']    = $sold;
        $c = ++$i;
        $results[$key]['count']            = $c < 10 ? '0' . $c : "$c" ;
        $results[$key]['rating']           = ceil($result['rating']);
     }

     echo json_encode(['status' => true , 'message' => 'Record found' , 'data' => $results ]);
     die;

   }

     public function userLiked(){

      $user_id = $this->input->get('user_id');
      $liked_user_id = $this->input->get('liked_user_id');
      
      if($user_id && $liked_user_id){

      $likes = $this->db->query("select * from user_likes WHERE user_id = '$user_id' AND liked_user_id = '$liked_user_id'")->result_array();

      if(count($likes)){
          $this->db->delete( 'user_likes' , ['user_id' => $user_id , 'liked_user_id' => $liked_user_id ] );
          echo json_encode(['status' => true , 'message' => 'unliked' ]);
          die;            
      }

      $this->db->insert( 'user_likes' , ['user_id' => $user_id , 'liked_user_id' => $liked_user_id ] );
        if($this->db->insert_id()){
        echo json_encode(['status' => true , 'message' => 'liked' ]);
        die;              
        }
      }
        echo json_encode(['status' => false , 'message' => 'failed' ]);
        die;
     }
     
     public function offer_pop_up(){
         
        $fetch  = $this->webservice_model->get_where('config',['key'=> 'app_offer_pop_up' ]);
        $offer_image = $this->webservice_model->get_where('config',['key'=> 'app_offer_image' ]);
        $row    = $fetch[0];
        $offer_image = $offer_image[0]['value'];
        $offer_image = "https://ohcityzgz.com/uploads/images/".$offer_image;
        echo json_encode(['status' => true , 'message' => 'success' , 'offer_pop_up' => $row['value'] , 'offer_pop_up_image' => $offer_image ]);
        die;
     }
     
     public function renew_product(){
        
        $user_id = $this->input->get_post('user_id', TRUE);
        $product_id = $this->input->get_post('product_id', TRUE);
        $fetch = $this->webservice_model->get_where('product',['user_id'=> $user_id , 'id' => $product_id ]);
        
        if($fetch && $user_id && $product_id){
            
          $dateTime = $fetch[0]['date_time'];
          
          $where = ['user_id' => $user_id , 'id' => $product_id];
          $data  = ['date_time' => date('Y-m-d H:i:s')];
          $status = $this->webservice_model->update_data('product',$data,$where);
          if($status){
            echo json_encode(['status' => true , 'message' => 'Successfully renewed product' ]);
            die;              
          }else{
            echo json_encode(['status' => true , 'message' => 'Failed to renew product' ]);
            die;
          }
        }
        echo json_encode(['status' => false , 'message' => 'Product not exist' ]);
        die;
     }
     
     public function uploadImage(){
          
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pic = new Imagick($_FILES['image']['tmp_name']);

// $path = 'uploads/' .date('Y-m');

//   if(!is_dir($path)){
//     mkdir($path);
//   }
  
//   $path = $path 
  
//   if(!is_dir($path)){
//     mkdir($path);
//   }

  // $path = public_path('uploads/'.date('Y-m'));
  // if(!File::isDirectory($path)){
  // File::makeDirectory($path, 0777, true, true);
  // }

  // $path = public_path('uploads/'.date('Y-m').'/'.date('m'));
  // $filePath = '/uploads/' . date('Y-m') . '/' . date('m');
  // if(!File::isDirectory($path)){
  // File::makeDirectory($path, 0777, true, true);
  // }


//$exif = exif_read_data($_FILES['image']['tmp_name']); //parameter should be image path
$exif['Orientation'] = $pic->getImageOrientation();


if (isset($exif['Orientation'])) {

                        switch ($exif['Orientation']) {

                            case 3:

                                $pic->rotateImage("#cccccc", 180);

                                break;

                            case 6:

                                $pic->rotateImage("#cccccc", -90);

                                break;

                            case 8:

                                $pic->rotateImage("#cccccc", 90);

                                break;

                        }

 }

$width  = $pic->getImageWidth();
$height = $pic->getImageHeight();

if($width > 1000){
    $width = 1000;
}

// Resize the image 
$pic->resizeImage( 20, 20, Imagick::FILTER_LANCZOS, 1);
$pic->writeImage('uploads/20200610.jpg');                             
$pic->destroy();

     }

  }

?>