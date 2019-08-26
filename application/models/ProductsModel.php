<?php
class ProductsModel extends CI_Model{
    
    public function get_products(){
        if(!empty($this->input->get("search"))){
          $this->db->like('name', $this->input->get("search"));
          $this->db->or_like('description', $this->input->get("search")); 
        }
        $query = $this->db->get("products");
        return $query->result();
    }
    public function insert_product()
    {    
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description')
        );
        return $this->db->insert('products', $data);
    }
    public function update_product($id) 
    {
        $data=array(
            'name' => $this->input->post('name'),
            'description'=> $this->input->post('description')
        );
        if($id==0){
            return $this->db->insert('products',$data);
        }else{
            $this->db->where('id',$id);
            return $this->db->update('products',$data);
        }        
    }
}
?>