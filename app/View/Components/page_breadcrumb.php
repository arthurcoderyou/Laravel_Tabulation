<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class page_breadcrumb extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $linkTitle,
        public string $linkSubtitle,
        public string $mainTitle
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page_breadcrumb');
    }
}
