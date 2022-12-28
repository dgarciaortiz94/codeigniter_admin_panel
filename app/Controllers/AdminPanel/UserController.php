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
        if ($this->request->getMethod() == 'post') {
            $user = new User();

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
                } else {
                    $file = ['errors' => 'The file has already been moved.'];
                }
            } else {
                $user->image = 'default.jpg';
            }
            //-------------------------------------------------------------------

            $user->password = password_hash($this->request->getPost('plainPassword'), PASSWORD_DEFAULT);
            $user->active = true;
            $user->role = '["ROLE_USER"]';

            $userModel = new UserModel();
            $userModel->save($user);

            return redirect()->route('admin_panel_user_index');
        }

        return view('adminPanel/user/new');
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
            $user->fill($this->request->getPost());

            //HANDLE IMAGE
            if ($this->request->getFile('image')) {
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
                    $file = ['errors' => 'The file has already been moved.'];
                }
            }
            //-------------------------------------------------------------------

            if ($this->request->getPost('plainPassword')) $user->password = password_hash($this->request->getPost('plainPassword'), PASSWORD_DEFAULT);

            $userModel = new UserModel();
            $userModel->update($user->id, $user);

            if (session('user')->id == $user->id) {
                $session = Services::session();
                $session->set(['user' => $user]);
            }

            return $this->response->redirect(base_url() . route_to('admin_panel_user_index'));
        }

        return view('adminPanel/user/edit', ["user" => $user]);
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