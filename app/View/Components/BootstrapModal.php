<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BootstrapModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public mixed $id;
    public bool $scrollable, $centered;
    public string $title, $body, $type, $text;

    public function __construct(
        $id="exampleModal",
        $title="Modal title",
        $body="Modal body",
        $type="primary",
        $text="Save changes",
        $scrollable=false,
        $centered=false,
        )
    {
        //
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->type = $type;
        $this->text = $text;
        $this->scrollable = $scrollable;
        $this->centered = $centered;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.bootstrap-modal');
    }
}
