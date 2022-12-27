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
    
            if (! $img->hasMoved()) {
                $img->move(ROOTPATH.'/public/media/users', $img->getRandomName());

                $user->image = $img->getName();
            } else {
                $file = ['errors' => 'The file has already been moved.'];
            }
            //-------------------------------------------------------------------

            if ($this->request->getPost('plainPassword')) $user->password = password_hash($this->request->getPost('plainPassword'), PASSWORD_DEFAULT);

            $userModel = new UserModel();
            $userModel->update($user->id, $user);
        }

        return view('client/profile/edit', ["user" => $user, "file" => isset($file) ? $file : []]);
    }
}
