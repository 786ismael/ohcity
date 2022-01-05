<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notification extends CI_Controller

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
                $this->load->model('admin/admin_common_model');
                $this->load->library(array('form_validation','session')); 
                error_reporting(0);
                
  }

  public function index() {
    $this->load->view('admin/notificationList');
  }

  public function sendNotification() {
    $users   = $this->input->get_post('users');
    $title   = $this->input->get_post('title');
    $message = $this->input->get_post('message');

             $this->db->select([ 'device_type','device_token' , 'register_id' ]);
             $this->db->where_in('id' , $users );
   $users =  $this->db->get('users');
   $iosUsersId = array();
   $androidUsersId = array();

   if($users->num_rows() > 0 ){
      foreach($users->result_array() as $user){
             if(!empty($user['device_token']) && !is_null($user['device_token'])){
                 array_push($iosUsersId , $user['device_token']);
             }
             if(!empty($user['register_id']) && !is_null($user['register_id'])){
                 array_push($androidUsersId , $user['register_id']);
             }
      }

    $notify = array(
          "result"  => "successful",
          "title"   => $title,
          "message" => $message,
          "body"    => $message,
          "key" => "admin",
          "date" => date('Y-m-d h:i:s')
    );

              $this->toAndoid($androidUsersId , $notify);
              foreach($iosUsersId as $id){
                $this->ios_notification($id , $title , $message );   
              }
           

   }

   $this->db->insert('notifications' , ['title' => $title , 'message' => $message , 'sender_id' => '1' ]);
   $this->session->set_flashdata('message' , 'Successful send notification');
   return redirect('notification');

  }

 function toAndoid($device_token = array() ,$data = array()){
   
    $message = array(
      "message" => $data
    );
  
    $url = 'https://fcm.googleapis.com/fcm/send';
    
    $fields = array(
    'registration_ids' => $device_token,
    'data' => $message,
    );

    $headers = array(
    'Authorization: key=' . "AAAAUC1FNn4:APA91bFZM_ej0nI31P3o2_eXnWxZyjXjY3EyCFiiKoYpfIvj6WmPIggkJJ0zzeYB5-RZsGWxMqw8IAVV1KNB5ftWXCsk29inzrhhfkT7QwwR0aVTljWJkQ7cmKn6fjlJBMEbNfzpELXzZUFgpfH2bcXGTq3Yw7CNTA",
    'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE)
      {
      die('Curl failed: ' . curl_error($ch));
      }
    curl_close($ch);
    
    }

     function toIos($device_token = array() ,$data = array()){
   
    $message = array(
      "message" => $data
    );
  
    $url = 'https://fcm.googleapis.com/fcm/send';
    
    $fields = array(
    'registration_ids' => $device_token,
    'data' => $message,
    );

    $headers = array(
    'Authorization: key=' . "AAAAMS9GD6E:APA91bGzvIgwjhGaCFam_IkyBuN9UNH3HqMMhlEDoYR07aNcgHvYVSwFryk7OCvIZlaSfs660bCOfB0Anmtkn6TKXeARzxcZKlGkyx6Hhd4iLRXLnzPMW0Kz17YQqYCjXLWtDieI5j6I",
    'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE)
      {
      die('Curl failed: ' . curl_error($ch));
      }
    curl_close($ch);
    }

     // Sends Push notification for iOS users
    public function ios_notification($devicetoken = null , $title = '' , $body = ''){
            $url = "https://fcm.googleapis.com/fcm/send";
            $token = $devicetoken;
          //  $token = 'eEZicIioZeA:APA91bHg1ids0dwhitnreWhZiaxk6mEzbTMQnLZ4HalrcqA2imUUOBOltvTfCTkovRSnIsU7e7Yea2zIRIHMNtcZlXZ8gK7VfchLcE_fZzZE6OSrazL8DpPvzLY-k84kvm5AygR2Y5A6';
            $serverKey = 'AAAAMS9GD6E:APA91bGzvIgwjhGaCFam_IkyBuN9UNH3HqMMhlEDoYR07aNcgHvYVSwFryk7OCvIZlaSfs660bCOfB0Anmtkn6TKXeARzxcZKlGkyx6Hhd4iLRXLnzPMW0Kz17YQqYCjXLWtDieI5j6I';
            $title =$title;
          //  $body = json_encode($data);
         //   $body = $data;
            // $notification = array('title' => $title  ,'body' => $title, 'sound' => 'default', 'badge' => '1' , 'alert_type' => $title  );
            $notification = array('title' => $title  ,'body' => $body, 'message' => $body , 'sound' => 'default', 'badge' => '1' , 'alert_type' => $title );
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

}