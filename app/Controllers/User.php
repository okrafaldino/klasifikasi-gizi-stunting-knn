<?php

namespace App\Controllers;

use App\Models\DataUjiModel;
use App\Models\BalitaModel;

class User extends BaseController
{
    protected $dataUjiModel;
    protected $balitaModel;

    public function __construct()
    {
        $this->dataUjiModel = new DataUjiModel();
        $this->balitaModel = new BalitaModel();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['total_databalita'] = $this->balitaModel->getTotalUsers();
        $data['total_datauji'] = $this->dataUjiModel->getTotalUsers();
        return view('user/index', $data);
    }

    public function profile()
    {
        $data['title'] = 'My profile';
        return view('user/profile', $data);
    }
}
