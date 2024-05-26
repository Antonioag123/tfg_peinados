<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class form extends Component
{
    /**
     * Create a new component instance.
     */
    public $users;
    public $title;
    public $services;
    public $route;
    public $booking;
    
    // Por defecto lo pongo vacío porque en el formulario de creación no hace falta pasarle ese parámetro
    public function __construct($users="", $title="", $services="", $route="", $booking="")
    {
        $this->users = $users;
        $this->title = $title;
        $this->services = $services;
        $this->route = $route;
        $this->booking = $booking; 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}
