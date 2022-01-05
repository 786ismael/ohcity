<?php
class Product_model  extends CI_Model {
	public function __construct()
	{
	$this->load->database();
	}
	


    function allposts_count()
    {   
        $query = $this->db->get('v_product_info');
    
        return $query->num_rows();  

    }
    
    function allposts($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('v_product_info');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
   
    function posts_search($limit,$start,$search,$col,$dir)
    {
        $query = $this
                ->db
                ->like('id',$search)
                ->or_like('product_name',$search)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('v_product_info');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function posts_search_count($search)
    {
        $query = $this
                ->db
                
                ->like('id',$search)
                ->or_like('product_name',$search)
                ->get('v_product_info');
    
        return $query->num_rows();
    } 

}  