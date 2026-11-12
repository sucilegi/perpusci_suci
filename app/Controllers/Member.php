<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Member extends BaseController
{
    public function index()
    {
       $data = [
        'title' => 'Manajemen Anggota',
        'totalAnggota' => 75
    ];
       return view('anggota/index', $data);
    }
}
