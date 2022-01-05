<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
define("SITE_URL",'http://webappsol.biz/CotMarket/');

class Index extends CI_Controller{

  public function __construct(){
   parent:: __construct();
   $this->load->model('webservice_model');
   $this->load->library(['form_validation','email']);   
   $this->load->helper(['url']);                     
 }


 public function index(){
     
       $this->load->view('Home/index');
       
 // $this->load->view('include_pages/header');
 // $data['all_banners'] = $this->webservice_model->get_all('banner');
 // $data['all_categories'] = $this->webservice_model->get_all('category');
 // $data['all_featured_products'] = $this->webservice_model->get_where('product',['type'=>'Featured']);
//  $this->load->view('pages/home',$data);
//  $this->load->view('include_pages/footer');
}

    public function openPlayStore(){
      header('Location: https://play.google.com/store/apps/details?id=com.tech.ohcity&hl=en'); 
    }

}

?>