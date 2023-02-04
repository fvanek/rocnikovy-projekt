<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SubforumLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function home()
    {
        return view('home');
    }
}
