<?php
/**
 *
 */
class Login_model extends CI_model
{

  function check_login($idCard){
    $this->db->select('Pin');
    $this->db->from('Card');
    $this->db->where('idCard',$idCard);
    return $this->db->get()->row('Pin');
  }

}
