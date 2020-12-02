<?php

class Pankki_model extends CI_model
{
    public function get_saldo($idCard, $Type)
    {
        $this->db->select('Saldo');
        $this->db->from('Account');
        $this->db->where('idCard', $idCard);
        $this->db->and('Type', $Type);

       $result = $this->db->get()->row('Saldo');
     
        return $result;
    }

    public function nosto($idAccount, $idCard, $Amount)
    {
        $sql = "CALL nosto(".$idAccount",".$idCard","$Amount");";

        $query = $this->db->query($sql);
        $result = $query->row('ret');

        $query->free_result();

        return $result;
    }

    public function get_transacts($idCard, $Type)
    {
        $this->db->select('Date, Amount, Type');
        $this->db->from('Transaction');
        $this->db->join('Account', ,'Account.idCard=Transaction.idCard');
        $this->db->where('idCard', $idCard);
  
        $result = $this->db->get()->result();

        return $result;
    }

    public function check_login($idCard)
    {
        $this->db->select('Pin');
        $this->db->from('Card');
        $this->db->where('idCard',$idCard);
        return $this->db->get()->row('Pin-');
    }
  
}