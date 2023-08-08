<?php

namespace App\Models;

use CodeIgniter\Model;

class BalitaModel extends Model
{
    protected $table = 'tbl_balita';
    protected $allowedFields = ['nama', 'umur', 'beratbadan', 'tinggibadan', 'status'];

    public function getBalita($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    public function getTotalUsers()
    {
        return $this->countAll();
    }
}
