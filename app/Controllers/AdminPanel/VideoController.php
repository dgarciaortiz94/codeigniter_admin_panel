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

            //HANDLE VIDEO
            $validationRule = [
                'userfile' => [
                    'label' => 'Video File',
                    'rules' => 'uploaded[video]'
                        . '|is_image[video]'
                        . '|mime_in[video,video/mp4]'
                        . '|max_size[video,300000]'
                ],
            ];

            if (! $this->validate($validationRule)) $file = ['errors' => $this->validator->getErrors()];
    
            $videoFile = $this->request->getFile('video');

            $name = $videoFile->getRandomName();
    
            if (! $videoFile->hasMoved()) {
                $videoFile->move(ROOTPATH.'/public/media/videos', $name);

                $video->path = $name;
            } else {
                $file = ['errors' => 'The file has already been moved.'];
            }
            //-------------------------------------------------------------------

            $videoModel = new VideoModel();
            $videoModel->save($video);

            return redirect()->route('admin_panel_video_index');
        }

        return view('adminPanel/video/new');
    }

    public function show($video)
    {
        $videoModel = new VideoModel();

        return view('adminPanel/video/show', ["video" => $videoModel->find($video)]);
    }

    public function edit($video)
    {
        $videoModel = new VideoModel();

        if ($this->request->getMethod() == 'post') {
            $video = new Video();
            $video->fill($this->request->getPost());

            $videoModel = new VideoModel();
            $videoModel->update($video->id, $video);

            return redirect()->route('admin_panel_video_index');
        }

        return view('adminPanel/video/edit', ["video" => $videoModel->find($video)]);
    }

    public function delete()
    {
        $videoModel = new VideoModel();
        $video = $videoModel->find(4);

        $videoModel->delete($video->id);

        return redirect()->route('admin_panel_video_index');
    }
}
