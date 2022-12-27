<?php

namespace App\Models;

use App\Entities\Video;
use CodeIgniter\Model;

class VideoModel extends Model
{
    protected $table         = 'video';
    protected $allowedFields = [
        'title', 
        'description',
        'path',
    ];
    protected $returnType    = Video::class;
    protected $useTimestamps = true;
}