<?php

namespace App\Controllers\Login;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Services;

class LoginController extends BaseController
{
    public function login()
    {
        if (session()->is_logged) return redirect()->route('client_home');

        $data = [];

        if ($this->request->getMethod() == 'post') {
            $userModel = new UserModel();
            $user = $userModel->where('email', $this->request->getPost('email'))->first();

            if ($user && password_verify($this->request->getPost('password'), $user->password)) {
                $session = Services::session();

                $session->set(['user' => $user]);
                $session->set('is_logged', true);

                return json_encode(['success' => 'true']);
            }

            return json_encode(['success' => false, 'errors' => ['Credenciales no válidas']]);
        }

        return view('login/index', $data);
    }

    public function logout()
    {
        $session = Services::session();
        $session->destroy();
        
        return redirect()->route('client_home');
    }

}