<?php

namespace App\Controllers\AdminPanel;

use App\Controllers\BaseController;
use App\Entities\Video;
use App\Models\VideoModel;
use DateTime;

class VideoController extends BaseController
{
    public function index()
    {
        $videoModel = new VideoModel();
        $videos = $videoModel->findAll();

        return view('adminPanel/video/index', ['videos' => $videos]);
    }

    public function new()
    {
        $videoModel = new VideoModel();
        $video = new Video();

        if ($this->request->getMethod() == 'post') {
            $validationRule = [
                'title' => [
                    'label' => 'TITLE',
                    'rules' => 'max_length[200]'
                        . 'required'
                ],
                'video' => [
                    'label' => 'VIDEO',
                    'rules' => 'uploaded[video]'
                        . 'required'
                        . '|mime_in[video,video/mp4]'
                        . '|max_size[video,'.ini_get("upload_max_filesize").']'
                ],
            ];

            if ($this->validate($validationRule)) {
                $video->fill($this->request->getPost());

                if (is_null($this->request->getFile('video'))) return redirect('admin_panel_video_new');

                if ($this->request->getFile('video')->getName()) {
                    $videoFile = $this->request->getFile('video');

                    $name = $videoFile->getRandomName();
            
                    if (! $videoFile->hasMoved()) {
                        $videoFile->move(ROOTPATH.'/public/media/videos', $name);

                        $video->path = $name;
                    }
                }

                $videoModel->save($video);

                return redirect()->route('admin_panel_video_index');
            }

            if (count($this->validator->getErrors()) > 0) $errors = $this->validator->getErrors();
        }

        return view('adminPanel/video/new', [
            'errors' => isset($errors) ? $errors : [],
        ]);
    }

    public function show($video)
    {
        $videoModel = new VideoModel();

        return view('adminPanel/video/show', ["video" => $videoModel->find($video)]);
    }

    public function edit($video)
    {
        $videoModel = new VideoModel();
        $video = $videoModel->find($video);

        if ($this->request->getMethod() == 'post') {
            $validationRule = [
                'title' => [
                    'label' => 'TITLE',
                    'rules' => 'max_length[200]'
                ],
            ];

            if ($this->request->getFile('video')->getName()) {
                $validationRule['video'] = [
                    'label' => 'VIDEO',
                    'rules' => 'uploaded[video]'
                        . '|mime_in[video,video/mp4]'
                        . '|max_size[video,'.ini_get("upload_max_filesize").']'
                ];
            }

            if ($this->validate($validationRule)) {
                if (is_null($this->request->getFile('video'))) return redirect('admin_panel_video_new');

                $video->fill($this->request->getPost());

                if ($this->request->getFile('video')->getName()) {
                    $videoFile = $this->request->getFile('video');

                    $name = $videoFile->getRandomName();
            
                    if (! $videoFile->hasMoved()) {
                        $videoFile->move(ROOTPATH.'/public/media/videos', $name);

                        if (is_file(ROOTPATH.'public/media/videos/'.$video->path)) unlink(ROOTPATH.'public/media/videos/'.$video->path); 
                        
                        $video->path = $name;
                    }
                }

                try {
                    $videoModel->update($video->id, $video);
                } catch (\Throwable $th) {
                    return view('adminPanel/video/edit', [
                        "video" => $video,
                        "edit" => true,
                        'errors' => ['error' => 'No se ha actualizado ningún dato'],
                    ]);
                }

                return redirect()->route('admin_panel_video_index');
            }

            if (count($this->validator->getErrors()) > 0) $errors = $this->validator->getErrors();
        }

        return view('adminPanel/video/edit', [
            "video" => $video,
            "edit" => true,
            'errors' => isset($errors) ? $errors : [],
        ]);
    }

    public function delete($video)
    {
        $videoModel = new VideoModel();
        $video = $videoModel->find($video);

        if (is_file(ROOTPATH.'public/media/videos/'.$video->path)) unlink(ROOTPATH.'public/media/videos/'.$video->path); 
        
        $videoModel->delete($video->id);

        return redirect()->route('admin_panel_video_index');
    }
}
