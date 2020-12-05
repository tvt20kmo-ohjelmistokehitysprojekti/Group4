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
        $sql = "Call nosto(".$idAccount.",".$idCard.",".$Amount.");";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result[0];
       }
}