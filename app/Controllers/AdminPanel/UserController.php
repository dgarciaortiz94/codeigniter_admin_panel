<?php

namespace App\Controllers\AdminPanel;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();

        return view('client/templates/header')
            .view('adminPanel/user/index', ['users' => $users])
            .view('client/templates/footer');
    }

    public function new()
    {
        if ($this->request->getMethod() == 'post') {
            $user = new User();

            $user->fill($this->request->getPost());
            $user->password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $user->active = true;
            $user->role = '["ROLE_USER"]';

            $userModel = new UserModel();
            $userModel->save($user);

            return $this->response->redirect('/admin/user/');
        }

        return view('client/templates/header')
            .view('adminPanel/user/new')
            .view('client/templates/footer');
    }

    public function show($user)
    {
        $userModel = new UserModel();

        return view('client/templates/header')
            .view('adminPanel/user/show', ["user" => $userModel->find($user)])
            .view('client/templates/footer');
    }

    public function edit($user)
    {
        $userModel = new UserModel();

        if ($this->request->getMethod() == 'post') {
            $user = new User();
            $user->fill($this->request->getPost());

            if ($this->request->getPost('plainPassword')) $user->password = password_hash($this->request->getPost('plainPassword'), PASSWORD_DEFAULT);

            $userModel = new UserModel();
            $userModel->update($user->id, $user);

            return $this->response->redirect(base_url() . route_to('admin_panel_user_index'));
        }

        return view('client/templates/header')
            .view('adminPanel/user/edit', ["user" => $userModel->find($user)])
            .view('client/templates/footer');
    }

    public function delete()
    {
        $userModel = new UserModel();
        $user = $userModel->find(4);

        $userModel->delete($user->id);

        return $this->response->redirect(base_url() . route_to('admin_panel_user_index'));
    }

}