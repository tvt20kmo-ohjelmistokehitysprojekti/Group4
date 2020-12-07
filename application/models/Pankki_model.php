<?php

class Pankki_model extends CI_model
{
    function get_saldo($id){
        $this->db->select('Saldo');
        $this->db->from('Account');
        if($id !== NULL) {
          $this->db->where('idAccount',$id,);
        }
        return $this->db->get()->result_array();
}

    function get_tapahtumat($id){
       $this->db->select('Date,Amount');
       $this->db->from('Transaction');
      if($id !== NULL) {
        $this->db->where('idAccount',$id,);
      }
      return $this->db->get()->result_array();
}
   
    
function nosto($idAccount, $idCard, $Amount){
  $data = array('idAccount'=> $idAccount,'idCard'=> $idCard,'Amount'=> $Amount);
  $this->db->query("call nosto(?,?,?)",$data);
  if($this->db->affected_rows()){
    return TRUE;
  }
  else {
    return FALSE;
  }
}
}