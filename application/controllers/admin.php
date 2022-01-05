<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller

{
  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -
   *    http://example.com/index.php/welcome/index
   *  - or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see https://codeigniter.com/user_guide/general/urls.html
   */
  function __construct()
  {
                parent::__construct();
                $this->load->helper('url');
                $this->load->model('admin/authentication_model');
                $this->load->model('admin/product_model');
                $this->load->model('admin/admin_common_model');
                $this->load->library(array('form_validation','session')); 
                error_reporting(0);
                
  }

  public

  function index()
  {
    $this->load->view('admin/index');
  }

  public

  function dashboard()
  {
    $this->load->view('admin/dashboard');
  }

 

  public

  function view_page($page)
  {
     $this->load->view('admin/'.$page);
  }
  

  public

  function go()
  {
    
      $result = $this->authentication_model->admin_login();
      if(!$result) {
        $msg = array(
           'msg' =>'<strong>Error!</strong> Invalid Username and Password. Log in failed.','res' => 0
              );
                             $this->session->set_userdata($msg);
                             redirect('admin');
      }
      else {
        redirect('admin/dashboard', $message);
      }
    
  }  

  

  public function forgot_password()
    {
      $email = $this->input->post('email', TRUE);
      $arr_login = ['email' => $email];

      $login = $this->admin_common_model->fetch_recordbyid('admin', $arr_login);

      if ($login)
      {
        $pass = random_string('alnum', 6);

        $to = $email;
        $subject = "Forgot Password";
        $body = "<div style='max-width: 600px; width: 100%; margin-left: auto; margin-right: auto;'>
        <header style='color: #fff; width: 100%;'>
           <img alt='' src='".base_url('uploads/images/logo.png')."' width ='180' height='120'/>
        </header>
        
        <div style='margin-top: 10px; padding-right: 10px; 
      padding-left: 125px;
      padding-bottom: 20px;'>
          <hr>
          <h3 style='color: #232F3F;'>Hello ".$login->name.",</h3>
          <p>You have requested a new password for your Plannender Admin account.</p>
          <p>Your new password is <span style='background:#2196F3;color:white;padding:0px 5px'>".$pass."</span></p>
          <hr>
          
            <p>Warm Regards<br>Plannender<br>Support Team</p>
            
          </div>
        </div>

    </div>";

       

        $headers = "From: info@mobileappdevelop.co" . "\r\n";
        $headers.= "MIME-Version: 1.0" . "\r\n";
        $headers.= "Content-type:text/html;charset=UTF-8" . "\r\n";



          mail($to, $subject, $body, $headers);


          $this->admin_common_model->update_data('admin',['password'=>$pass],$arr_login);
        
      }
      else
      {
          $msg = array(
           'msg' =>'<strong>Error!</strong> This email is not registered to Plannender.','res' => 0
              );
                             $this->session->set_userdata($msg);
         redirect('admin/view_page/forgotpassword');
      }

        $msg = array(
              'success' =>'<strong>Success!</strong> Your new password has been send your registered email address.'
              );
                             $this->session->set_flashdata($msg);
        redirect('admin');
      
    }



  public function admin_logout(){
        $this->session->unset_userdata('admin');
        return redirect('admin');   
  }

  public function delete_data(){
        $table = $this->input->post('table');
        $id = $this->input->post('id');
        $this->admin_common_model->delete_data($table,['id'=>$id]);
        //echo $this->db->last_query();
  }

   public function create_owner(){
       
       $user_id = $this->input->post('user_id');
       $shop_id = $this->input->post('shop_id');
       if($shop_id!=''){
         $this->admin_common_model->update_data('shop',['user_id'=>$user_id],['id'=>$shop_id]);
       }
       return redirect('admin/view_page/userList');   
  }

  function updateStatus()
  {
      $status = $_POST['status'];
      $id = $_POST['id'];
      $this->admin_common_model->update_data("place_order",['status'=>$status],['id'=>$id]);
      return redirect('admin/view_page/orderList');
  }


function updateStatus1()
  {
       $id = $_POST['id'];

/*
// send notification for ios

			$arr_get1 = ['id' => $id];
			$login1 = $this->admin_common_model->get_where('users', $arr_get1);
			$message = 'Now You member of '.$user_type;
                        $type =  "New Promotion";

			$ios_id = $login1[0]['ios_register_id'];
			$url = 'http://mobileappdevelop.co/LastCall/CertificatesLastcall.php?ios_id='.$ios_id.'&msg='.urlencode($message).'&type='.urlencode($type); 


                 $rCURL = curl_init();
        
                curl_setopt($rCURL, CURLOPT_URL, $url);
                curl_setopt($rCURL, CURLOPT_HEADER, 0);
                curl_setopt($rCURL, CURLOPT_RETURNTRANSFER, 1);
        
                $aData = curl_exec($rCURL);
                curl_close($rCURL);
//echo "grgfdgdf";die;
//print_r($aData);die;
							
// end send notification for ios

// send notification for Andriod
         

            $user_message_apk = array(
                           "message" => array(
                             "result" => "successful",
                             "key" => "New Promotion",
                             "type" => $type,
                             "message" => $message,
                             "date"=> date('Y-m-d h:i:s')
                           )
                         );
                  
                       //print_r($user_message_apk);die;

                        $register_userid = array($login1[0]['register_id']);


                        $this->webservice_model->user_apk_notification($register_userid, $user_message_apk);


// end send notification for Andriod

  */

	        $arr_get1 = ['id' => $id];
			$login1 = $this->admin_common_model->get_where('product', $arr_get1);
			
			$arr_get2 = ['product_id' => $id];
			$login2 = $this->admin_common_model->get_where('ticket_numbers', $arr_get2);
  // echo $this->db->last_query();

$av = $login1[0]['available'];

 $pos = rand(0,$av);

 $win = $login2[$pos]['ticket_number'];

      $this->admin_common_model->update_data("product",['winner_ticket'=>$win],['id'=>$id]);
      return redirect('admin/view_page/drowsList');
  }

public function getProductRecord(){
 $columns = array( 
                            'id', 'product_name', 'start_date', 'end_date', 'first_name', 'user_image', 'category_name', 'image', 'image1', 'image2', 'image3', 'price','address','description'
                        );

    $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this->product_model->allposts_count();
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->product_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->product_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->product_model->posts_search_count($search);
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                
                $nestedData['id'] = $post->id;
                $nestedData['product_name'] = $post->product_name;
                $nestedData['username'] = $post->first_name;
                $nestedData['user_image'] = $post->user_image;
                $nestedData['category_name'] = $post->category_name;
                $nestedData['image'] = $post->image;
                $nestedData['image1'] = $post->image1;
                $nestedData['image2'] = $post->image2;
                $nestedData['image3'] = $post->image3;
                $nestedData['price'] = $post->price;
                $nestedData['address'] = $post->address;
                $nestedData['description'] = $post->description;
                // $nestedData['username'] = substr(strip_tags($post->description),0,50)."...";

                
                $data[] = $nestedData;

            }
        }
        
        $json_data = array(
                    "draw"            => intval($this->input->post('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
        die;
}

public function totalProductRecord()
    {
        $query = $this->db->select("COUNT(*) as num")->get("product");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }


function get_ride_detail()
  {
       $id = $_GET['id'];
      $arr_gets = ['id' => $id];
      $login = $this->admin_common_model->get_where('place_order',$arr_gets);

      $cart_ids = $login[0]['cart_id'];
      
      $aa = (explode(",",$cart_ids));

                        
                   
   ?>
 <table class="table table-user-information" style="width:60%;">
                
    <body style='background-color: #f1f1f1;'>


<section  style='background-color: #fff;
    width:35%;
    margin: 0 auto;'>


<table class='table' style='width: 100%;'>
    <thead style=''>
      <tr>
        <th style='text-align: left;
    font-size: 15px;    color: #000; border-bottom: 1px dotted #bdb7b7;
    padding-bottom: 8px;
    font-family: Arial,Helvetica,sans-serif;'>Product</th>
    <th style='text-align: left;
    font-size: 15px;    color: #000; border-bottom: 1px dotted #bdb7b7;
    padding-bottom: 8px;
    font-family: Arial,Helvetica,sans-serif;'>Ticket Number</th>
        <th style='text-align: right;
    font-size: 15px;    color: #000; border-bottom: 1px dotted #bdb7b7;
    padding-bottom: 8px;    font-family: Arial,Helvetica,sans-serif;
'>Amount</th>
      </tr>
    </thead>
    <tbody>
        
        <?php 
        foreach($aa as $val1)
             {

                        $arr_where = ['id' => $val1];
                        $cart = $this->admin_common_model->get_where('add_to_cart', $arr_where);
                        
                        $arr_where1 = ['id' => $cart[0]['product_id']];
                        $product = $this->admin_common_model->get_where('product', $arr_where1);
                         
                        $arr_where2 = ['cart_id' => $val1];

                        $ticket = $this->admin_common_model->get_where('ticket_numbers', $arr_where2);
                        
                         foreach($ticket as $val11)
             {
                 ?>       
        
      <tr>
        <td style='border-bottom: 1px dotted #bdb7b7;'><?php echo $product[0]['product_name']?> &nbsp;&nbsp;&nbsp;&nbsp;  </td>
       
        <td style='border-bottom: 1px dotted #bdb7b7;'><?php echo $val11['ticket_number']?></td>
        <td style=' border-bottom: 1px dotted #bdb7b7;   padding: 14px 0;    color: #696969;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 16px;
    text-align: right;
   '>R <?php echo $product[0]['price']?> </td>
      </tr>
<?php } } ?>
     
    </tbody>
  </table>



</section>


</body>
</table>

        <?php 

  }



// end class
}