<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonLaunchModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public string $type;
    public string $target;
    public string $text;

    public function __construct(
        $type="primary",
        $target="#exampleModal",
        $text="Button trigger modal"
    )
    {
        //
        $this->type = $type;
        $this->target = $target;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-launch-modal');
    }
}
