<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post as PostModel;

class PostComponent extends Component
{
    public PostModel $post;

    public function __construct(PostModel $post)
    {
        //Trazer os dados do Post para blade post-component.blade.php
        $this->post = $post;

    }


    public function render(): View|Closure|string
    {
        return view('components.post-component');
    }
}
