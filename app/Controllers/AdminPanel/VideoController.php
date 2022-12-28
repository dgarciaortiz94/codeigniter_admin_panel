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
        if ($this->request->getMethod() == 'post') {
            $video = new Video();

            $video->fill($this->request->getPost());
            $video->active = true;

            if (is_null($this->request->getFile('video'))) return redirect('admin_panel_video_new');

            if ($this->request->getFile('video')->getName()) {
                $validationRule = [
                    'userfile' => [
                        'label' => 'Video File',
                        'rules' => 'uploaded[video]'
                            . '|mime_in[video,video/mp4]'
                            . '|max_size[video,'.ini_get("upload_max_filesize").']'
                    ],
                ];

                if ($this->validate($validationRule)) {
                    $videoFile = $this->request->getFile('video');

                    $name = $videoFile->getRandomName();
            
                    if (! $videoFile->hasMoved()) {
                        $videoFile->move(ROOTPATH.'/public/media/videos', $name);
    
                        $video->path = $name;
                    }

                    $videoModel = new VideoModel();
                    $videoModel->save($video);

                    return redirect()->route('admin_panel_video_index');
                } 
            }
        }

        return view('adminPanel/video/new', [
            
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
            $video->fill($this->request->getPost());

            if (is_null($this->request->getFile('video'))) return redirect('admin_panel_video_new');

            if ($this->request->getFile('video')->getName()) {
                $validationRule = [
                    'userfile' => [
                        'label' => 'Video File',
                        'rules' => 'uploaded[video]'
                            . '|mime_in[video,video/mp4]'
                            . '|max_size[video,'.ini_get("upload_max_filesize").']'
                    ],
                ];

                if ($this->validate($validationRule)) {
                    $videoFile = $this->request->getFile('video');

                    $name = $videoFile->getRandomName();
            
                    if (! $videoFile->hasMoved()) {
                        $videoFile->move(ROOTPATH.'/public/media/videos', $name);

                        if (is_file(ROOTPATH.'public/media/videos/'.$video->path)) unlink(ROOTPATH.'public/media/videos/'.$video->path); 
                        
                        $video->path = $name;
                    }

                    $videoModel = new VideoModel();
                    $videoModel->update($video->id, $video);

                    return redirect()->route('admin_panel_video_index');
                }
            }
        }

        return view('adminPanel/video/edit', [
            "video" => $video,
            "edit" => true,
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
