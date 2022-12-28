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
            $user->fill($this->request->getPost());

            //HANDLE IMAGE
            if ($this->request->getFile('image')->getName()) {
                $validationRule = [
                    'userfile' => [
                        'label' => 'Image File',
                        'rules' => 'uploaded[image]'
                            . '|is_image[image]'
                            . '|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                            . '|max_size[image,100000]'
                            . '|max_dims[image,1920,1080]',
                    ],
                ];

                if (! $this->validate($validationRule)) $file = ['errors' => $this->validator->getErrors()];
        
                $img = $this->request->getFile('image');
        
                $name = $img->getRandomName();
                
                if (! $img->hasMoved()) {
                    $img->move(ROOTPATH.'/public/media/users', $name);

                    if ($user->image != "default.jpg" && is_file(ROOTPATH.'public/media/users/'.$user->image)) unlink(ROOTPATH.'public/media/users/'.$user->image);

                    $user->image = $name;
                } else {
                    $file['erorrs'][] = 'The file has already been moved.';
                }
            }
            //-------------------------------------------------------------------

            if ($this->request->getPost('plainPassword')) $user->password = password_hash($this->request->getPost('plainPassword'), PASSWORD_DEFAULT);

            $userModel = new UserModel();
            $userModel->update($user->id, $user);

            $session = Services::session();
            $session->set(['user' => $user]);

            $success = "Su perfil fue actualizado correctamente";
        }

        return view('client/profile/edit', [
            "user" => $user, 
            "file" => isset($file) ? $file : [],
            "error" => isset($file['errors']) ? $file['errors'][0] : [],
            "success" => isset($success) ? $success : [],
        ]);
    }
}
