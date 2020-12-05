<?php
/**
 *
 */
class Login_model extends CI_model
{

  function login($idCard){
    $this->db->select('Pin');
    $this->db->from('Card');
    $this->db->where('idCard',$idCard);
    return $this->db->get()->row('Pin');
  }

  function update_Card($id, $update_data){
    $this->db->where('idCard',$id);
    $this->db->update('Card',$update_data);
    if($this->db->affected_rows()>0){
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
}

