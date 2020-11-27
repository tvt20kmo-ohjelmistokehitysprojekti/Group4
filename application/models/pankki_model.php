<?php

class Pankki_model extends CI_model
{
  
    public function Otto($add_data){
        $sql = 'Call otto(?,?,@viesti)';
        $this->db->query($sql, $add_data);
        $query = $this->db->query("Select @viesti as viesti");
        $result = $query->result_array();
        return $result[0]['viesti'];
    }

    public function Saldo($idTili)
    {
            $sql = 'select Saldo from tili where idTili=?';
            $query = $this->db->query($sql,$idTili);
            $result = $query->result_array();
            if (isset( $result[0]['Saldo'])){
              return $result[0]['Saldo'];
            }
            else {
                return 0;
            }
    }
    public function Tapahtumat($idTili)
    {
        $sql = 'select Pvm, Selite, Summa from Tapahtumat where idTili =? order by Pvm desc limit 6';
        $query = $this->db->query($sql,$idTili);
        $result = $query->result_array();
        if (isset($result[0])){
            return $result;
        }
        else{
        
            return 0;
        }

    }
    public function check_login($KorttiID){
        $this->db->select('Tunnusluku');
        $this->db->from('Asiakas');
        $this->db->where('KorttiID',$KorttiID);
        return $this->db->get()->row('Tunnusluku');
    }



    public function fetch_accounts($add_data)
    {   
        $sql = 'SELECT idTili FROM Tili WHERE KorttiID = ? AND Tyyppi = ?';
        $query = $this->db->query($sql,$add_data);
        $result = $query->result_array();
        if (isset($result[0]['idTili'])){
            return $result[0]['idTili'];
        }
        else{
        
            return 0;
        }
    }





    public function update_password($update_data)
    { 
    
        $sql = 'Update Asiakas SET Tunnusluku=? WHERE KorttiID = ?';
        $query = $this->db->query($sql,$update_data);
        
        if($this->db->affected_rows()>0){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

}