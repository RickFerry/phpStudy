<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class SeriesController extends Controller
{
    public function index(): string
    {
        $series = [
            'Grey\'s Anatomy',
            'Lost',
            'Agents of SHIELD'
        ];

        return view('series.index')->with('series', $series);
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('series.create');
    }
}
