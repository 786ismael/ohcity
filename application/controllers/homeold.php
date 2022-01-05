
<?php 
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	define("SITE_URL",'http://webappsol.biz/CotMarket/');

	class Home extends CI_Controller{

		public function __construct(){
			parent:: __construct();
			$this->load->model('webservice_model');
			$this->load->library(['form_validation','email']);   
                        $this->load->helper(['url']);                     
		}


		public function index(){
			$this->load->view('home');
		}

		public function view_load($page){
			$this->load->view($page);
		}

              public function user_signup(){
              	//print_r($_POST);die();
		$arr_data = ['username'=>$this->input->post('username'),'phone'=>$this->input->post('phone'),'email'=>$this->input->post('email'),'password'=>base64_encode($this->input->post('password'))];

              $this->form_validation->set_rules('username', 'username', 'required');
              $this->form_validation->set_rules('email', 'email', 'required|is_unique[users.email]');
              $this->form_validation->set_rules('phone', 'phone', 'required|integer');
              $this->form_validation->set_rules('password', 'password', 'required');
              if ($this->form_validation->run() == FALSE)
                {
                  $this->load->view('sign_up');

                }else{


		

		$id = $this->webservice_model->insert_data('users',$arr_data);

		$fetch = $this->webservice_model->get_where('users',['id'=>$id]);
		$this->session->set_userdata('users',$fetch[0]);

		// if(isset($arr_data['type'])){
		// 	$this->session->set_flashdata('welcome','Welcome to Mega, you are successfully registered on mega your request has been send to administrator to verify your detail');
		// }else{
		// 	$this->session->set_flashdata('welcome','Welcome to Mega, you have permission to access our services');
		// }
		$this->session->set_flashdata('welcome','Welcome to Classified, you have Registered successfully');
		redirect('home');
	}

      }
	public function user_login(){
		//$arr_data = $this->input->post();

		$arr_data = ['email'=>$this->input->post('email'),'password'=>base64_encode($this->input->post('password'))];
		//print_r($arr_data);die();
		$fetch = $this->webservice_model->get_where('users',$arr_data);
		if($fetch){
			$this->session->set_userdata('users',$fetch[0]);
			$this->session->set_flashdata('welcome','Welcome to Classified  Shop, you have permission to buy products'); 
			redirect('home');               
		}else{
			$this->session->set_flashdata('welcome','You have enter wrong email or password');
			redirect('home');
		}
		
	}

	public function logout(){
		$this->session->unset_userdata('users');
		$this->session->set_flashdata('welcome','You have logged out successfully');
		redirect('home');
	}

   public function delete_data(){
        $table = $this->input->post('table');
         $id = $this->input->post('id');
        echo $this->webservice_model->delete_data($table,['id'=>$id]);
        //echo $this->db->last_query();
  }

	function editAccount()
    {
    

  $user_id=$this->input->get_post('user_id');
    $username=$this->input->get_post('username');
    $email=$this->input->get_post('email');
  //echo $phone=$this->input->get_post('phone');

// if(isset($_FILES['image']['name']))
//  if (!empty($_FILES['image']['name']))
// {

//   $n = rand(0, 100000);
//   echo $img1 = "USER" . $n . $_FILES['image']['name'];
//   move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img1);
//   $data['image']= $img1;

// }
//echo "<pre>";print_r($data['image']);die;

   $data=[
  "username"=>$username,
  "email"=>$email

   ]; 
//print_r($data);die();
  echo $sid = $this->webservice_model->update_student_id1($user_id,$data);



  if($sid)
  {
    echo "success";
    
  }
  else
  {

    echo "Not success";
    redirect('home/view_load/addsetting');

  }


}

public function editphone(){
    $user_id=$this->input->get_post('user_id');
    $phone=$this->input->get_post('phone');
$data=[
  "phone"=>$phone
   ];

 echo $sid = $this->webservice_model->update_student_id1($user_id,$data);
 if($sid)
  {
    echo "success";
    
  }
  else
  {

    echo "Not success";
    redirect('home/view_load/addsetting');

  }

}
public function social_login(){

    $social_data = [
    'username'=>$this->input->get_post('name'),
    'email'=>$this->input->get_post('email'),
    'social_id'=>$this->input->get_post('social_id')
    ];

    $image = $this->input->get_post('image');

    if($image!=""){
      $img = "USER_IMG_" . rand(1, 10000) . ".png";
      @file_put_contents('uploads/images/'.$img, file_get_contents($image));
      $social_data['image'] = $img;

    }

    $social_get = ['social_id'=>$social_data['social_id']];

    $checkExistUser = $this->webservice_model->get_where('users',$social_get);

    if ($checkExistUser) {  

      $updateExistUser = $this->webservice_model->update_data('users',$social_data,$social_get);
      if (!empty($updateExistUser)) { 
        // $this->home_model->update_data('users',['last_login'=>date('Y-m-d H:i:s')],['id'=>$checkExistUser[0]['id']]);
        $this->session->set_flashdata('welcome', 'User Login Successfully.');
         // Add user data in session
        $this->session->set_userdata('users', $checkExistUser[0]);
      }

    }else{

        //$arr_data['user_code'] = $this->webservice_model->generateRandomString(4);

      $id = $this->webservice_model->insert_data('users',$social_data);
      if($id!=''){
        $get_user = $this->webservice_model->get_where('users',$social_data);

        if (!empty($get_user)) { 
          //$this->home_model->update_data('users',['last_login'=>date('Y-m-d H:i:s')],['id'=>$get_user[0]['id']]);
          $this->session->set_flashdata('welcome', 'User Login Successfully.');
         // Add user data in session
          $this->session->set_userdata('users', $get_user[0]);
        }
      }

    }
  }

  function addpost(){
 $this->form_validation->set_rules('product_name', 'product name', 'required');
  //$this->form_validation->set_rules('image', 'image', 'required');
   $this->form_validation->set_rules('description', 'description', 'required');
   $this->form_validation->set_rules('price', 'price', 'required');
    $this->form_validation->set_rules('address', 'address', 'required');

     if ($this->form_validation->run() == FALSE)
                {
                $this->load->view('addpost');

                }else{


                


    $arr=$this->input->post();
        
         if (!empty($_FILES['image']['name']))
{

  $n = rand(0, 100000);
   $img1 = "USER" . $n . $_FILES['image']['name'];
  move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img1);
  $arr['image']= $img1;

}
//       if (!empty($_FILES['image1']['name']))
// {

//   $n = rand(0, 100000);
//    $img2 = "USER" . $n . $_FILES['image1']['name'];
//   move_uploaded_file($_FILES['image1']['tmp_name'], "uploads/images/" . $img2);
//   $arr['image1']= $img2;

// }

//       if (!empty($_FILES['image2']['name']))
// {

//   $n = rand(0, 100000);
//    $img3 = "USER" . $n . $_FILES['image2']['name'];
//   move_uploaded_file($_FILES['image2']['tmp_name'], "uploads/images/" . $img3);
//   $arr['image2']= $img3;

// }

//       if (!empty($_FILES['image3']['name']))
// {

//   $n = rand(0, 100000);
//    $img4 = "USER" . $n . $_FILES['image3']['name'];
//   move_uploaded_file($_FILES['image3']['tmp_name'], "uploads/images/" . $img4);
//   $arr['image3']= $img4;

// }
 //unset($arr['submit']);

 // print_r($arr);
 // die();

echo $id = $this->webservice_model->insert_data('product',$arr);

if ($id) {
        
      
  // for ($i=0; $i < count($_FILES['product_image']['name']); $i++) { 
  //   $n = rand(0, 100000);
  //   $img1 = "PRODUCT" . $n . $_FILES['product_image']['name'][$i];
  //   move_uploaded_file($_FILES['product_image']['tmp_name'][$i], "uploads/images/" . $img1);
  //   //$data['product_image']= $img1;
  //   $sid = $this->webservice_model->insert_data('products_image',['product_id'=>$id,'product_image'=>$img1]);
  // }
  $this->session->set_flashdata('welcome','You have successfully add product');
  redirect('home/view_load/addsetting');

}else{

$this->session->set_flashdata('welcome','You do not uccessfully add product');
}

  }
}

  public function forgot_password()
{     

 $email=$this->input->post('email');
  $arr_login = ['email' => $email];

  $login = $this->webservice_model->get_where('users', $arr_login);
  if (empty($login)) {
$this->session->set_flashdata('welcome', '<div class="alert alert-success text-center">Email is not exist</div>');
     
redirect('home/view_load/sign-in');

    
  }else{
  foreach ($login as $key => $value) {
    echo $id=$value['id'];
  }
    
  if ($login)
  {
    $status = 'Active';
    $password= random_string('alnum',6);

    $to = $email;
    $subject = "Account varifiction";
    $body = "<div style='max-width: 600px; width: 100%; margin-left: auto; margin-right: auto;'>
    <header style='color: #fff; width: 100%;'>
     <img alt='' src='".SITE_URL."uploads/images/logo123.png' width ='120' height='120'/>
   </header>

   <div style='margin-top: 10px; padding-right: 10px; 
   padding-left: 125px;
   padding-bottom: 20px;'>
   <hr>
      
   <h3 style='color: #232F3F;'>Hello ".$login[0]['email'].",</h3>
        <a href='".SITE_URL."home/view_load/forget/".$id."'>change your password</a>
   
   <p>Warm Regards<br>Plannender<br>Support Team</p>

 </div>
</div>

</div>";

$headers = "From: info@mobileappdevelop.co" . "\r\n";
$headers.= "MIME-Version: 1.0" . "\r\n";
$headers.= "Content-type:text/html;charset=UTF-8" . "\r\n";

//mail($to, $subject, $body, $headers);

file_get_contents("http://technorizen.co.in/mail.php?to=".urlencode($to)."&subject=".urlencode($subject)."&body=".urlencode($body)."&headers=".urlencode($headers));



//$varify=$this->webservice_model->update_data('users',['status'=>$status,'password'=>base64_encode($password)],$arr_login);


 $this->session->set_flashdata('welcome', '<div class="alert alert-success text-center">Your Recive your password in registered mail id</div>');
      
      redirect('home/view_load/sign-in');

 


}

}}

function forgotreset(){
     
$this->form_validation->set_rules('password', 'password', 'required');
$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
if ($this->form_validation->run() == FALSE){
$this->load->view('forget');

}else{

   $pass=$this->input->post('password');
  $id=$this->input->post('user_id');
  //$arr_login['id'=>$id];
  $data=[
  "id"=>$id
   ];
 $change=$this->webservice_model->update_data('users',['password'=>base64_encode($pass)],$data);

if ($change) {
 $this->session->set_flashdata('welcome', '<div class="alert alert-success text-center">Your password changed successfully</div>');
     redirect('home/view_load/sign-in');
 
}else{

 $this->session->set_flashdata('welcome', '<div class="alert alert-success text-center">Your password does not changed </div>');
 redirect('home/view_load/sign-in');
}

}


 
}

public function chat_insert(){

$arr=$this->input->post();



$id = $this->webservice_model->insert_data('kaise_chat_detail',$arr);
if (empty($id)) {
$this->session->set_flashdata('welcome', '<div class="alert alert-success text-center">Your massage not send  </div>');
 redirect('home/view_load/addsetting');
}else{

  $this->session->set_flashdata('welcome', '<div class="alert alert-success text-center">Your Massage send successfully </div>');
 redirect('home/view_load/addsetting');
}
}
    // end class
    }

?>