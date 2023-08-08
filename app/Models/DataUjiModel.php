<?php

namespace App\Models;

use CodeIgniter\Model;

class DataUjiModel extends Model
{
    protected $table = 'datauji';
    protected $allowedFields = ['nama', 'umur', 'beratbadan', 'tinggibadan'];

    public function getUji($id = false)
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
