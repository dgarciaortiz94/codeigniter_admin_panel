<?php

namespace App\Controllers\Client\Profile;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\UserModel;
use Config\Services;

class ProfileController extends BaseController
{
    public function edit()
    {
        $userModel = new UserModel();
        $user = $userModel->find(session('user')->id);

        if ($this->request->getMethod() == 'post') {
            $validationRule = [
                'email' => [
                    'label' => 'EMAIL',
                    'rules' => 'max_length[100]'
                        . '|is_unique[user.email, user.email,'.$user->email.']'
                ],
                'name' => [
                    'label' => 'NAME',
                    'rules' => 'max_length[50]'
                ],
                'firstname' => [
                    'label' => 'FIRSTNAME',
                    'rules' => 'max_length[50]'
                ],
                'lastname' => [
                    'label' => 'LASTNAME',
                    'rules' => 'max_length[50]'
                ],
            ];

            if ($this->request->getFile('imageFile')->getName()) {
                $validationRule['imageFile'] = [
                    'label' => 'IMAGE',
                    'rules' => 'uploaded[imageFile]'
                        . '|is_image[imageFile]'
                        . '|mime_in[imageFile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[imageFile,100000]'
                        . '|max_dims[imageFile,1920,1080]',
                ];
            }

            if ($this->validate($validationRule)) {
                $user->fill($this->request->getPost());

                if (is_null($this->request->getFile('imageFile'))) return redirect('admin_panel_video_new');

                if ($this->request->getFile('imageFile')->getName()) {
                    $img = $this->request->getFile('imageFile');
            
                    $name = $img->getRandomName();

                    if (! $img->hasMoved()) {
                        $img->move(ROOTPATH.'/public/media/users', $name);

                        if ($user->image != "default.jpg" && is_file(ROOTPATH.'public/media/users/'.$user->image)) unlink(ROOTPATH.'public/media/users/'.$user->image);

                        $user->image = $name; 
                    }
                }

                if ($this->request->getPost('plainPassword')) $user->password = password_hash($this->request->getPost('plainPassword'), PASSWORD_DEFAULT);

                $userModel = new UserModel();

                try {
                    $userModel->update($user->id, $user);
                } catch (\Throwable $th) {
                    return view('client/profile/edit', [
                        "user" => $user,
                        'errors' => ['error' => 'No se ha actualizado ningún dato'],
                        "successes" => isset($successes) ? $successes : [],
                    ]);
                }

                if (session('user')->id == $user->id) {
                    $session = Services::session();
                    $session->set(['user' => $user]);
                }

                $successes = ["success" => "Su perfil fue actualizado correctamente"];
            }

            if (count($this->validator->getErrors()) > 0) $errors = $this->validator->getErrors();
        }

        return view('client/profile/edit', [
            "user" => $user,
            'errors' => isset($errors) ? $errors : [],
            "successes" => isset($successes) ? $successes : [],
        ]);
    }
}
