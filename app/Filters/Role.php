<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Role implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // if ( (!session()->is_logged) || (!in_array(session()->user->role, $arguments)) ) {
        //     return redirect()->to('login');
        // }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}