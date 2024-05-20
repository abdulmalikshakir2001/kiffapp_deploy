<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $xtype="";
    public $xname="";
    public $xlabel="";
    public $xplaceholder="";
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($xtype,$xname, $xlabel = "", $xplaceholder="")
    {
        //
        $this->xtype=$xtype;
        $this->xname=$xname;
        $this->xlabel= $xlabel;
        $this->xplaceholder= $xplaceholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
