<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'user';
    protected $allowedFields = [
        'email', 
        'name', 
        'firstname', 
        'lastname', 
        'password', 
        'role', 
        'image',
    ];
    protected $returnType    = User::class;
    protected $useTimestamps = true;
}