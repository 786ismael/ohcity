<?php 
	if (!defined('BASEPATH')) exit('No direct script access allowd');
	class Webservice_model extends CI_Model{

		public function get_where($table,$where){
			$data =	$this->db->where($where)
					 		 ->get($table);

			//echo $this->db->last_query();

	 		if($res = $data->result_array()){
	 			return $res;
			}else{
				return FALSE;
			}

			
		}	
				function update_student_id1($id,$data){
$this->db->where('id', $id);
$this->db->update('users', $data);
}

		public function insert_data($table,$data){
			$this->db->insert($table,$data);
			return $this->db->insert_id();
		}

		public function update_data($table,$data,$where){
			$query = $this->db->where($where)
					 ->update($table,$data);
			if ($query)
			{
				return TRUE;
			}
		  	else
			{
				return FALSE;
			}
		}

		public function get_all($table){
			$data = $this->db->get($table);
			$data = $data->result_array();
			if ($data) {
				return $data;
			}else{
				return FALSE;
			}
		}

		public function humanTiming($time)
		{
			$time = time() - $time; // to get the time since that moment
			$time = ($time < 1) ? 1 : $time;
			$tokens = array(
				31536000 => 'year',
				2592000 => 'month',
				604800 => 'week',
				86400 => 'day',
				3600 => 'hour',
				60 => 'minute',
				1 => 'second'
			);
			foreach($tokens as $unit => $text)
			{
				if ($time < $unit) continue;
				$numberOfUnits = floor($time / $unit);
				return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
			}
		}

		function delete_data($table, $where)
		{
			$del = $this->db->where($where)
					 ->delete($table);
			if ($del)
			{
				return TRUE;
			}
		  	else
			{
				return FALSE;
			}
		}

    function getwhere_num_rows($table, $where)
	{
		$this->db->where($where);
		$data = $this->db->get($table);
		$get = $data->result_array();
		//print_r($get);
		if($get)
		{
                        $num = $data->num_rows();
			return $num;
		}
		else
		{
			 $num = $data->num_rows();
			return $num;
		}
	}
            


function user_apk_notification($registration_ids, $message)
	{
       
	// Set POST variables
//print_r($registration_ids); die;
//	$url = 'https://android.googleapis.com/gcm/send';
    $url = 'https://fcm.googleapis.com/fcm/send';
	$fields = array(
		'registration_ids' => $registration_ids,
		'data' => $message,
	);
	$headers = array(
		'Authorization: key=' . "AAAAUC1FNn4:APA91bFZM_ej0nI31P3o2_eXnWxZyjXjY3EyCFiiKoYpfIvj6WmPIggkJJ0zzeYB5-RZsGWxMqw8IAVV1KNB5ftWXCsk29inzrhhfkT7QwwR0aVTljWJkQ7cmKn6fjlJBMEbNfzpELXzZUFgpfH2bcXGTq3Yw7CNTA",
		'Content-Type: application/json'
	);

	// print_r($headers);
	// Open connection

	$ch = curl_init();

	// Set the url, number of POST vars, POST data

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Disabling SSL Certificate support temporarly

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

	// Execute post

	$result = curl_exec($ch);
	if ($result === FALSE)
		{
		die('Curl failed: ' . curl_error($ch));
		}

	// Close connection

	curl_close($ch);
	

//	echo $result;

	}





function driver_apk_notification($registration_ids, $message)
	{

	// Set POST variables
//print_r($registration_ids); die;
	$url = 'https://android.googleapis.com/gcm/send';
	$fields = array(
		'registration_ids' => $registration_ids,
		'data' => $message,
	);
	$headers = array(
		'Authorization: key=' . "AAAAE5dkgHk:APA91bGL0B-Z4w6_9uoz4NHPJjDdPnWsB5G55giEAva775oJkYB_IksUZkQ3jxLtMcBgTR27RdK2Fa-NkpcFgHe9Ce7-KNM_Hc7nl_WOxJFRvRBroh9FZv9hAW2xDOVpbsdv5iQZhbuI",
		'Content-Type: application/json'
	);

	// print_r($headers);
	// Open connection

	$ch = curl_init();

	// Set the url, number of POST vars, POST data

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Disabling SSL Certificate support temporarly

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

	// Execute post

	$result = curl_exec($ch);
	if ($result === FALSE)
		{
		die('Curl failed: ' . curl_error($ch));
		}

	// Close connection

	curl_close($ch);

	//echo $result;

	}




                function generateRandomString($num) {
                         $length=$num;
                         $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                         $charactersLength = strlen($characters);
                         $randomString = '';
                         for ($i = 0; $i < $length; $i++) {
                             $randomString .= $characters[rand(0, $charactersLength - 1)];
                         }
                         return $randomString;
               }
               
               

               function distance($lat1, $lng1, $lat2, $lng2, $miles = false)
	        {
				$pi80 = M_PI / 180;
				$lat1*= $pi80;
				$lng1*= $pi80;
				$lat2*= $pi80;
				$lng2*= $pi80;
				$r = 6372.797; // mean radius of Earth in km
				$dlat = $lat2 - $lat1;
				$dlng = $lng2 - $lng1;
				$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
				$c = 2 * atan2(sqrt($a) , sqrt(1 - $a));
				$km = $r * $c;
				return ($miles ? ($km * 0.621371192) : $km);
	        }

	        public function update_chat_status($table,$data,$where){
			$query = $this->db->where_in('id',$where)
					 ->update($table,$data);
			if ($query)
			{
				return TRUE;
			}
		  	else
			{
				return FALSE;
			}
		}

        //end class
          function addProductNotification($user_id = null){

        	$data = $this->db->query("SELECT * FROM subscriptions join users on users.id = subscriptions.subscribe_by where subscriptions.subscribe_to = $user_id")->result_array();

        	if($data)
        		return $data;
        	else
        		return false;
        }
	}
?>