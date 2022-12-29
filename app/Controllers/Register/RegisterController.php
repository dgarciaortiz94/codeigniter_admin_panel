<?php

namespace App\Controllers\Register;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\UserModel;

class RegisterController extends BaseController
{
    public function index()
    {
        if (session()->is_logged) return redirect()->route('client_home');

        $userModel = new UserModel();
        $user = new User();

        if ($this->request->getMethod() == 'post') {
            $validationRule = [
                'email' => [
                    'label' => 'EMAIL',
                    'rules' => 'max_length[100]'
                        . 'required'
                        . '|is_unique[user.email]'
                ],
                'name' => [
                    'label' => 'NAME',
                    'rules' => 'max_length[50]'
                        . 'required'
                ],
                'firstname' => [
                    'label' => 'FIRSTNAME',
                    'rules' => 'max_length[50]'
                        . 'required'
                ],
                'lastname' => [
                    'label' => 'LASTNAME',
                    'rules' => 'max_length[50]'
                ],
                'plainPassword' => [
                    'label' => 'PASSWORD',
                    'rules' => 'required'
                ],
            ];

            if ($this->validate($validationRule)) {
                $user->fill($this->request->getPost());

                $user->image = 'default.jpg';
                $user->password = password_hash($this->request->getPost('plainPassword'), PASSWORD_DEFAULT);
                $user->active = true;
                $user->role = '["ROLE_USER"]';
    
                $userModel->save($user);
    
                return redirect()->route('client_home');
            }

            if (count($this->validator->getErrors()) > 0) $errors = $this->validator->getErrors();
        }

        return view('register/index', [
            'errors' => isset($errors) ? $errors : [],
        ]);
    }

}