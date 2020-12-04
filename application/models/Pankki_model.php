<?php

class Pankki_model extends CI_model
{
    function get_saldo($idAccount){
        $this->db->select('*');
        $this->db->from('Account');
        if($id !== NULL) {
          $this->db->where('idAccount',$idAccount);
        }
        return $this->db->get()->result_array();
}

    function post_nosto($idAccount, $idCard, $Amount){
        $sql = "CAll nosto(".$idAccount.",".$idCard.",".$Amount.");";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result[0];
       }
}