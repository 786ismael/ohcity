<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
define("SITE_URL",'http://webappsol.biz/CotMarket/');

class Homepage extends CI_Controller{

  public function __construct(){
   parent:: __construct();
   $this->load->model('webservice_model');
   $this->load->library(['form_validation','email']);   
   $this->load->helper(['url']);                     
 }


 public function index(){
     
       $this->load->view('support/index');
       
 // $this->load->view('include_pages/header');
 // $data['all_banners'] = $this->webservice_model->get_all('banner');
 // $data['all_categories'] = $this->webservice_model->get_all('category');
 // $data['all_featured_products'] = $this->webservice_model->get_where('product',['type'=>'Featured']);
//  $this->load->view('pages/home',$data);
//  $this->load->view('include_pages/footer');
}

public function support_email(){
 
  $first_name      =  $this->input->post('first_name');
  $last_name       =  $this->input->post('last_name');
  $email_address   =  $this->input->post('email_address');
  $contact_number  =  $this->input->post('contact_number');
  $subject         =  $this->input->post('subject');
  $message         =  $this->input->post('message');

  $data = [
     'first_name'     => $first_name,
     'last_name'      => $last_name,
     'email_address'  => $email_address,
     'contact_number' => $contact_number,
     'message'        => $message,
     'subject'        => $subject,
  ];

  $result = $this->webservice_model->insert_data('support_mails',$data);

  if($result > 0){

      $sub = $subject;
      $msg = $message;
      $to  = $email_address;

      $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.gmail.com',
      'smtp_port' => '465',
      'smtp_user' => 'supporteohcity@gmail.com',
      'smtp_pass' => 'isaac9511',
      'mailtype'  => 'html', 
      'newline'   => "\r\n",
      'charset'   => 'iso-8859-1');
        
      $this->load->library('email');
      $this->email->initialize($config);
      $this->email->from('supporteohcity@gmail.com', 'ohCityzgz');
      $this->email->to('supporteohcity@gmail.com');
      $this->email->subject($sub);
      $template = $this->load->view('support_email',$data,TRUE);
      $this->email->message($template);
    $status =  $this->email->send();
    
       $this->session->set_flashdata('class','success');
       $this->session->set_flashdata('msg','Mail sent successfully !');
       redirect('homepage/index');
  }else{
       $this->session->set_flashdata('class','danger');
       $this->session->set_flashdata('msg','Faild to send mail!');
       redirect('homepage/index');
  }

}

public function signup()
{
  $this->load->view('include_pages/header');
  $this->load->view('pages/signup');
  $this->load->view('include_pages/footer');
}

  // Validate and store registration data in database
public function user_signup() {

// Check validation for user input in SignUp form
  if($this->input->post('submit_signup')){
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run() == FALSE) {
      redirect('homepage/signup');
    } else {
      $arrdata = array(
        'username' => $this->input->post('username'),
        'phone' => $this->input->post('phone'),
        'email' => $this->input->post('email'),
        'password' => base64_encode($this->input->post('password')),
        'code' => '9999'
        );

      $email = $arrdata['email'];
      $phone = $arrdata['phone'];

      $arr_whr = ("(email = '$email' OR phone = '$phone')");


      $checkUser = $this->webservice_model->get_where('users',$arr_whr);
      if (empty($checkUser)) {
        $result = $this->webservice_model->insert_data('users',$arrdata);

        $to = $email;
        $subject = "User Registration";
        $body = "<div style='max-width: 600px; width: 100%; margin-left: auto; margin-right: auto;'>
        <header style='color: #fff; width: 100%;'>
          <img alt='' src='".SITE_URL."uploads/images/logo.png' width ='120' height='120'/>
        </header>

        <div style='margin-top: 10px; padding-right: 10px; 
        padding-left: 125px;
        padding-bottom: 20px;'>
        <hr>
        <h3 style='color: #232F3F;'>Hello ".$arrdata[0]['username'].",</h3>
        <p>You have registered Successfully.Otp Sent to your mobile number.Please Verify your account before try to login.</p>
        
        <hr>

        <p>Warm Regards<br>Support Team</p>

      </div>
    </div>

  </div>";

  $headers = "From: info@mobileappdevelop.co" . "\r\n";
  $headers.= "MIME-Version: 1.0" . "\r\n";
  $headers.= "Content-type:text/html;charset=UTF-8" . "\r\n";

  mail($to, $subject, $body, $headers);




  $this->session->set_flashdata('welcome','Registration Successfully !');
  redirect('homepage/login');
} else {
  $this->session->set_flashdata('welcome','Email Or Phone Number Already exist!');
  redirect('homepage/signup');
}
}
}
}

public function login()
{
  $this->load->view('include_pages/header');
  $this->load->view('pages/login');
  $this->load->view('include_pages/footer');
}



// Check for user login process
public function user_login() {

  if($this->input->post('submit_login')){
    $this->form_validation->set_rules('phone', 'Email Required', 'required');
    $this->form_validation->set_rules('password', 'Password Required', 'required');
    if ($this->form_validation->run() == FALSE) {
      redirect('homepage/login/');
    }
    else
    {

      $arr_data = [
      'phone'=>$this->input->get_post('phone'),
      'password'=>base64_encode($this->input->get_post('password'))
      ];

      $remember = $this->input->get_post('remember');



      $get_user = $this->webservice_model->get_where('users',$arr_data);

      if (!empty($get_user)) { 

        if($get_user[0]['status']=='deactive'){
         $this->session->set_flashdata('welcome', 'User is not activated.you need to activate your account.'); 
         redirect('homepage/otp_verify?phone='.$arr_data['phone']);
       }
       else{
        $this->webservice_model->update_data('users',['last_login'=>date('Y-m-d H:i:s')],['id'=>$get_user[0]['id']]);
        $this->session->set_flashdata('welcome', 'User Login Successfully.');
         // Add user data in session
        $this->session->set_userdata('logged_in', $get_user[0]);

        if(!empty($remember)) {
          setcookie("phone",$arr_data["phone"],time()+ (10 * 365 * 24 * 60 * 60));
          setcookie("password",$arr_data["password"],time()+ (10 * 365 * 24 * 60 * 60));
        } else {
          if(isset($_COOKIE["phone"])) {
            setcookie ("phone","");
          }
          if(isset($_COOKIE["password"])) {
            setcookie ("password","");
          }
        }
        redirect('homepage/');
      }
    }


    else
    {

      $this->session->set_flashdata('welcome', 'Email & Password Is Not Correct.');
      redirect('homepage/login/');
    }
  }
}
}


/***********Submit Otp Form**************/

public function user_otp() {

  if($this->input->post('submit_otp')){
    $this->form_validation->set_rules('phone', 'Email Required', 'required');
    $this->form_validation->set_rules('code', 'Otp Required', 'required');
    if ($this->form_validation->run() == FALSE) {
      redirect('homepage/login/');
    }
    else
    {

      $arr_whr = [
      'phone'=>$this->input->get_post('phone')
      ];

      $code =$this->input->get_post('code');


      



      $get_user = $this->webservice_model->get_where('users',$arr_whr);

      if (!empty($get_user)) { 

        $check_otp = $this->webservice_model->get_where('users',['phone'=>$arr_whr['phone'],'code'=>$code]);

        if(!empty($check_otp)){


          $this->webservice_model->update_data('users',['status'=>'active'],$arr_whr);
          $this->session->set_flashdata('welcome', 'User Activated Successfully Successfully.');

          redirect('homepage/login');
        }
        else
        {
          $this->session->set_flashdata('welcome', 'Otp Is Not Correct.');

          redirect('homepage/otp_verify?phone='.$arr_whr['phone']);
        }
      }


      else
      {

        $this->session->set_flashdata('welcome', 'Phone & Otp Is Not Correct.');
        redirect('homepage/login/');
      }
    }
  }
}





/************* social_login function *************/
public function social_login(){

  $social_data = [
  'username'=>$this->input->get_post('username'),
  'email'=>$this->input->get_post('email'),
  'app_id'=>$this->input->get_post('app_id')
  ];

  $user_image = $this->input->get_post('user_image');

  if($user_image!=""){
    $img = "USER_IMG_" . rand(1, 10000) . ".png";
    @file_put_contents('uploads/images/'.$img, file_get_contents($user_image));
    $social_data['user_image'] = $img;

  }

  $social_get = ['app_id'=>$social_data['app_id']];

  $checkExistUser = $this->home_model->get_where('users',$social_get);

  if ($checkExistUser) {  

    $updateExistUser = $this->home_model->update_data('users',$social_data,$social_get);
    if (!empty($updateExistUser)) { 
      $this->home_model->update_data('users',['last_login'=>date('Y-m-d H:i:s')],['id'=>$checkExistUser[0]['id']]);
      $this->session->set_flashdata('message_display', 'User Login Successfully.');
         // Add user data in session
      $this->session->set_userdata('logged_in', $checkExistUser[0]);
    }

  }else{

        //$arr_data['user_code'] = $this->webservice_model->generateRandomString(4);

    $id = $this->home_model->insert_data('users',$social_data);
    if($id!=''){
      $get_user = $this->home_model->get_where('users',$social_data);

      if (!empty($get_user)) { 
        $this->home_model->update_data('users',['last_login'=>date('Y-m-d H:i:s')],['id'=>$get_user[0]['id']]);
        $this->session->set_flashdata('message_display', 'User Login Successfully.');
         // Add user data in session
        $this->session->set_userdata('logged_in', $get_user[0]);
      }
    }

  }
}

// Logout from admin page
public function logout() {

  $this->session->unset_userdata('logged_in');
  $this->session->set_flashdata('welcome', 'User Successfully Logout.');
  redirect('homepage/');
}

public function forgot()
{
  $this->load->view('include_pages/header');
  $this->load->view('pages/forgot');
  $this->load->view('include_pages/footer');
}

  // Check for user update process
public function forgot_user() {

  if($this->input->post('forgot_submit')){
    $this->form_validation->set_rules('email', 'Password Required', 'required');
    if ($this->form_validation->run() == FALSE) {
      redirect('login/forgot');
    }
    else
    {
      $arr_where = [
      'email'=>$this->input->get_post('email')
      ];

      $get_user = $this->home_model->get_where('users',$arr_where);

      if (!empty($get_user)) { 
        $password = mt_rand(100000, 999999);
        $to = $arr_where['email'];
        $subject = "Forgot Password";
        $body = "<div style='max-width: 600px; width: 100%; margin-left: auto; margin-right: auto;'>
        <header style='color: #fff; width: 100%;'>
          <img alt='' src='".SITE_URL."uploads/images/logo.png' width ='120' height='120'/>
        </header>

        <div style='margin-top: 10px; padding-right: 10px; 
        padding-left: 125px;
        padding-bottom: 20px;'>
        <hr>
        <h3 style='color: #232F3F;'>Hello ".$get_user[0]['username'].",</h3>
        <p>You have requested a new password for your account.</p>
        <p>Your new password is <span style='background:#2196F3;color:white;padding:0px 5px'>".$password."</span></p>
        <hr>

        <p>Warm Regards<br>Support Team</p>

      </div>
    </div>

  </div>";

  $headers = "From: info@technorizen.co.in" . "\r\n";
  $headers.= "MIME-Version: 1.0" . "\r\n";
  $headers.= "Content-type:text/html;charset=UTF-8" . "\r\n";

    //file_get_contents("http://technorizen.co.in/mail.php?to=".urlencode($to)."&subject=".urlencode($subject)."&body=".urlencode($body)."&headers=".urlencode($headers));

  mail($to, $subject, $body, $headers);


  $this->home_model->update_data('users',['password'=>base64_encode($password)],['id'=>$get_user[0]['id']]);
  $this->session->set_flashdata('message_display', 'Forgot Password Successfully.Sent to your email Successfully.');
         // Add user data in session
  redirect('login/');
}
else
{

  $this->session->set_flashdata('msg', 'Email Id is Not Found.');
  redirect('login/forgot');
}
}
}
}

public function otp_verify()
{
  $this->load->view('include_pages/header');
  $this->load->view('pages/otp_verify');
  $this->load->view('include_pages/footer');
}

public function ads()
{

  if(!empty($this->session->userdata['logged_in'])){
  $data['ads_categories'] = $this->webservice_model->get_all('category');
  $this->load->view('include_pages/header');
  $this->load->view('pages/ads',$data);
  $this->load->view('include_pages/footer');
  }
  else
  {
  $this->load->view('include_pages/header');
  $this->load->view('pages/login');
  $this->load->view('include_pages/footer');
  }
}

public function ads_list()
{

  $data['product_lists_count'] = $this->db->query("SELECT COUNT(id) as ads_count FROM product")->row();
  $data['product_lists'] = $this->webservice_model->get_all('product');
  $this->load->view('include_pages/header');
  $this->load->view('pages/ads_list',$data);
  $this->load->view('include_pages/footer');
 
}

public function ads_details()
{

  $product_id = $this->uri->segment(3);
  $arr_whr = ['id'=>$product_id];
  $data['product_detail'] = $this->webservice_model->get_where('product',$arr_whr);
  $data['user_detail'] = $this->webservice_model->get_where('users',['id'=>$data['product_detail'][0]['user_id']]);

  $this->load->view('include_pages/header');
  $this->load->view('pages/ads_details',$data);
  $this->load->view('include_pages/footer');
 
}

public function user_profile() {
  $data['userdata'] = $this->session->userdata('logged_in');
  if (!empty($this->session->userdata('logged_in'))){
    $this->load->view('web/include/header');
    $this->load->view('web/user_profile',$data);
    $this->load->view('web/include/footer');
  } else {
    redirect('login');
  } 

}

  // Check for user update process
public function user_update() {

  if($this->input->post('update')){
    $this->form_validation->set_rules('username', 'Password Required', 'required');
    $this->form_validation->set_rules('mobile', 'Password Required', 'required');
    $this->form_validation->set_rules('wim', 'WIM Required', 'required');
    $this->form_validation->set_rules('location', 'Location Required', 'required');
    $this->form_validation->set_rules('introduction', 'Introduction Required', 'required');
    if ($this->form_validation->run() == FALSE) {
      redirect('login/user_profile');
    }
    else
    {
      $arr_where = [
      'id'=>$this->input->get_post('id')
      ];

      $arr_data = [
      'username'=>$this->input->get_post('username'),
      'mobile'=>$this->input->get_post('mobile'),
      'wim'=>$this->input->get_post('wim'),
      'location'=>$this->input->get_post('location'),
      'locationLat'=>$this->input->get_post('locationLat'),
      'locationLong'=>$this->input->get_post('locationLong'),
      'introduction'=>$this->input->get_post('introduction')
      ];

      $user_image = $row['user_image'];
      if($_FILES['user_image']['name']!=''){

        unlink("uploads/images/" . $user_image);
        $n = rand(0, 100000);
        $img = "USER_IMG" . $n . '.png';
        move_uploaded_file($_FILES['user_image']['tmp_name'], "uploads/images/" . $img);
        $arr_data['user_image'] = $img; 

      }



      $get_user = $this->home_model->get_where('users',$arr_where);

      if (!empty($get_user)) { 
        $this->home_model->update_data('users',$arr_data,['id'=>$get_user[0]['id']]);
        $this->session->set_flashdata('msg', 'User Update Successfully.');
         // Add user data in session
        $this->session->set_userdata('logged_in', $get_user[0]);
        redirect('login/user_profile');
      }
      else
      {

        $this->session->set_flashdata('msg', 'Somethimg Went Wrong.');
        redirect('login/user_profile');
      }
    }
  }
}

// Validate and store registration data in database
public function submit_ads() {

// Check validation for user input in SignUp form
  if($this->input->post('submit_ads')){
    $arrdata = $this->input->post();
    if($arrdata['cat_id']==12){
      unset($arrdata['submit_ads'],$arrdata['position'],$arrdata['salary']);
    }
    else if($arrdata['cat_id']==9){
      unset($arrdata['submit_ads'],$arrdata['services'],$arrdata['contact_details']);
    }
    else
    {
      unset($arrdata['submit_ads']);
    }

    //echo "<pre>";print_r($_FILES['image']);die;

    if (isset($_FILES['image']))
    {

      $n = rand(0, 100000);
      $img = "PRODUCT_IMG_" . $n . '.png';
      move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img);
      $arrdata['image'] = $img;
    }

    if (isset($_FILES['image1']))
    {

      $n = rand(0, 100000);
      $img1 = "PRODUCT1_IMG_" . $n . '.png';
      move_uploaded_file($_FILES['image1']['tmp_name'], "uploads/images/" . $img1);
      $arrdata['image1'] = $img1;
    }

    if (isset($_FILES['image2']))
    {

      $n = rand(0, 100000);
      $img2 = "PRODUCT2_IMG_" . $n . '.png';
      move_uploaded_file($_FILES['image2']['tmp_name'], "uploads/images/" . $img2);
      $arrdata['image2'] = $img2;
    }

    if (isset($_FILES['image3']))
    {

      $n = rand(0, 100000);
      $img3 = "PRODUCT3_IMG_" . $n . '.png';
      move_uploaded_file($_FILES['image3']['tmp_name'], "uploads/images/" . $img3);
      $arrdata['image3'] = $img3;
    }

    

    $result = $this->webservice_model->insert_data('product',$arrdata);

    $this->session->set_flashdata('welcome','Ads Added Successfully !');
    redirect('homepage/');
  }
}

    // end class
}

?>