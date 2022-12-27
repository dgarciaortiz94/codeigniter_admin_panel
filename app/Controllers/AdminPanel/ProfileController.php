<?php

namespace App\Controllers\AdminPanel;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function edit()
    {
        $user = session()->get('user');

        if ($this->request->getMethod() == 'post') {
            $user = new User();
            $user->fill($this->request->getPost());

            if ($this->request->getPost('plainPassword')) $user->password = password_hash($this->request->getPost('plainPassword'), PASSWORD_DEFAULT);

            $userModel = new UserModel();
            $userModel->update($user->id, $user);

            return $this->response->redirect(base_url() . route_to('admin_panel_user_index'));
        }

        return view('client/templates/header')
            .view('adminPanel/profile/edit', ["user" => $user])
            .view('client/templates/footer');
    }
}
