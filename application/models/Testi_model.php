<?php
/**
 *
 */
class Testi_model extends CI_model
{
  function get_testi($id){
    $this->db->select('*');
    $this->db->from('testi');
    if($id !== NULL) {
      $this->db->where('id_testi',$id);
    }
    return $this->db->get()->result_array();
  }
  function add_testi($add_data){
    $this->db->insert('testi',$add_data);
    if($this->db->insert_id()!==NULL){
      return $this->db->insert_id(); 
    }
    else {
      return FALSE;
    }  
  }
  function update_testi($id, $update_data){
    $this->db->where('id_testi',$id);
    $this->db->update('testi',$update_data);
    if($this->db->affected_rows()>0){
      return TRUE; 
    }
    else {
      return FALSE;
    }
  }

  function delete_testi($id){
    $this->db->where('id_testi',$id);
    $this->db->delete('testi');
    if($this->db->affected_rows()>0){
      return TRUE; 
    }
    else {
      return FALSE;
    }
  }


}
