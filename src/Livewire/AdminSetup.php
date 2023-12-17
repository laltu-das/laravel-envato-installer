<?php

namespace Laltu\LaravelEnvato\Livewire;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class AdminSetup extends Component
{
    /**
     * Render the component.
     */
    public function render(): Renderable
    {
        return view('laravel-envato::livewire.admin-setup')->extends('laravel-envato::components.layouts.app');
    }
}
