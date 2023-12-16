<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        echo 'Berhasil Login
<a href="/logout">
    Logout
</a>';
    }
}
