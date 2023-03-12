<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Subforumlink extends Component
{

    public $subforum;

    public function __construct($subforum)
    {
        $this->subforum = $subforum;
    }
    public function render(): View
    {
        return view('components.subforumlink');
    }
}
