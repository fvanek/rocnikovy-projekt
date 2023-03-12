<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Userlink extends Component
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
    public function render(): View
    {
        return view('components.userlink');
    }
}
