<?php

namespace App\Controllers\AdminPanel;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\UserModel;
use Config\Services;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();

        return view('adminPanel/user/index', ['users' => $users]);
    }

    public function new()
    {
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

                if (is_null($this->request->getFile('imageFile'))) return redirect('admin_panel_user_new');

                if ($this->request->getFile('imageFile')->getName()) {
                    $img = $this->request->getFile('imageFile');
            
                    $name = $img->getRandomName();
                    
                    if (! $img->hasMoved()) {
                        $img->move(ROOTPATH.'/public/media/users', $name);

                        $user->image = $name;
                    }
                } else {
                    $user->image = 'default.jpg';
                }

                $user->password = password_hash($this->request->getPost('plainPassword'), PASSWORD_DEFAULT);
                $user->active = true;
                $user->role = '["ROLE_USER"]';
    
                $userModel->save($user);
    
                return redirect()->route('admin_panel_user_index');
            }

            if (count($this->validator->getErrors()) > 0) $errors = $this->validator->getErrors();
        }

        return view('adminPanel/user/new', [
            'errors' => isset($errors) ? $errors : [],
        ]);
    }

    public function show($user)
    {
        $userModel = new UserModel();

        return view('adminPanel/user/show', ["user" => $userModel->find($user)]);
    }

    public function edit($user)
    {
        $userModel = new UserModel();
        $user = $userModel->find($user);

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
                    return view('adminPanel/user/edit', [
                        "user" => $user,
                        "edit" => true,
                        'errors' => ['error' => 'No se ha actualizado ningún dato'],
                    ]);
                }

                if (session('user')->id == $user->id) {
                    $session = Services::session();
                    $session->set(['user' => $user]);
                }

                return $this->response->redirect(base_url() . route_to('admin_panel_user_index'));
            }

            if (count($this->validator->getErrors()) > 0) $errors = $this->validator->getErrors();
        }

        return view('adminPanel/user/edit', [
            "user" => $user,
            "edit" => true,
            'errors' => isset($errors) ? $errors : [],
        ]);
    }

    public function delete($user)
    {
        $userModel = new UserModel();
        $user = $userModel->find($user);

        if ($user->image != "default.jpg" && is_file(ROOTPATH.'public/media/users/'.$user->image) && unlink(ROOTPATH.'public/media/users/'.$user->image)) $userModel->delete($user->id);

        $userModel->delete($user->id);

        return $this->response->redirect(base_url() . route_to('admin_panel_user_index'));
    }

}