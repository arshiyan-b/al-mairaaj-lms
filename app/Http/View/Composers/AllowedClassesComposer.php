<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\AllowedClass;

class AllowedClassesComposer
{
    public function compose(View $view)
    {
        $classes = collect();

        if (Auth::check()) {
            $classes = AllowedClass::where('teacher_id', Auth::user()->teacher_id)->get();
        }

        $view->with('classes', $classes);
    }
}
