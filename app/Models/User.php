<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'first_name', 'last_name', 'user_name', 'email', 'password', 
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['hashPassword'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function hashPassword(array $data){
        if(!isset($data['data']['password'])) return false;

        $option = array('cost', 12);

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT, $option);

        return $data;
    }

    public function verifyPassword($data){
        $verify = password_verify($data['password'], $data['hash']);

        if($verify){
            return true;
        }
        else{
            return false;
        }
    }

    public function emailExists($data){
        if(isset($data['id'])){
            $cmdtext = "select * from user where email = '".$data['email']."' and id <> ".$data['id'];
        }else{
            $cmdtext = "select * from user where email = '".$data['email']."'";
        }

        $query = $this->db->query($cmdtext);
        if(sizeof($query->getResult()) > 0){
            return true;
        }
        return false;
    }
}
