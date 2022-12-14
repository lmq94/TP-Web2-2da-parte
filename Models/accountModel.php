<?php


require_once "./models/MainModel.php";

class AccountModel extends Model {

    public function __construct() {
        parent::__construct();
    }


    public function getAllAccountsbyClient($id_client) {
        $query = $this->db->prepare("SELECT * FROM  account where account.id_client = ?");
        $query->execute([$id_client]);
        $Accounts = $query->fetchall(PDO::FETCH_OBJ); 
        
        return $Accounts;
    }

    public function getAccountById($id){
        $query = $this->db->prepare("SELECT* FROM account WHERE account.id_account =?");
        $query->execute([$id]);
        $account = $query->fetch(PDO::FETCH_OBJ);
        
        return $account;
    }

    public function accountsByOrdenAsc($col){
        $query = $this->db->prepare("SELECT * FROM account ORDER BY $col ASC");
        $query->execute();
        $accounts = $query->fetchall(PDO::FETCH_OBJ);
        return $accounts;
    }
    

    public function accountsByOrdenDesc($col){
        $query = $this->db->prepare("SELECT * FROM account ORDER BY $col DESC");
        $query->execute();
        $accounts = $query->fetchall(PDO::FETCH_OBJ);
        return $accounts;
    }



    public function insertAccount( $id_client, $amount, $type_account, $coin) {
        $query = $this->db->prepare("INSERT INTO account (id_client, amount, type_account, coin) VALUES (?, ?, ?, ?)");
        $query->execute([$id_client, $amount, $type_account, $coin]);

        return $this->db->lastInsertId();
    }

    function updateAccount($id_account, $coin, $amount, $type_account){
        $query = $this->db->prepare('UPDATE account SET coin=? , amount=?, type_account=?  WHERE id_account = ?');
        $query->execute([$coin, $amount, $type_account,$id_account]);
    }


    function deleteAccount($id) {
        $query = $this->db->prepare('DELETE FROM account WHERE id_account = ?');
        $query->execute([$id]);
    }

}   