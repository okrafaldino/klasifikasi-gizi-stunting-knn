<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $data['title'] = 'User List';
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();

        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid,username , email ,name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $builder->get();

        $data['users'] = $query->getResult();

        return view('admin/index', $data);
    }

    public function detail($id = 0)
    {
        $data['title'] = 'User Detail';

        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid,username , email ,fullname,user_image ,name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $builder->where('users.id', $id);
        $query = $builder->get();

        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        return view('admin/detail', $data);
    }
}
