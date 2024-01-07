<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class SeriesController extends Controller
{
    public function index(): string
    {
        $series = Series::all();

        return view('series.index')->with('series', $series);
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('series.create');
    }

    public function store(Request $request):
            \Illuminate\Contracts\Foundation\Application|RedirectResponse|Redirector|Application
    {
        $seriesName = $request->request->get('name');

        $series = new Series();
        $series->name = $seriesName;
        $series->save();

        return redirect('/series');
    }
}
