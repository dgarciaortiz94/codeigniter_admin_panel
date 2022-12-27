<?php

namespace App\Controllers\Client\Profile;

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

            //HANDLE IMAGE
            

            if ($this->request->getPost('plainPassword')) $user->password = password_hash($this->request->getPost('plainPassword'), PASSWORD_DEFAULT);

            $userModel = new UserModel();
            $userModel->update($user->id, $user);
        }

        return view('client/templates/header')
            .view('client/profile/edit', ["user" => $user])
            .view('client/templates/footer');
    }
}
