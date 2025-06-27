<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Http\Requests\CycleStoreRequest;
use App\Http\Requests\CycleUpdateRequest;
use App\Models\Cycle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CycleController extends Controller
{
    public function index(Request $request): Response
    {
        $cycles = Cycle::all();
    }

    public function show(Request $request, Cycle $cycle): Response
    {
        $cycle = Cycle::find($id);
    }

    public function store(CycleStoreRequest $request): Response
    {
        $cycle = Cycle::create($request->validated());
    }

    public function update(CycleUpdateRequest $request, Cycle $cycle): Response
    {
        $cycle = Cycle::find($id);

        $cycle->update($request->validated());
    }

    public function destroy(Request $request, Cycle $cycle): Response
    {
        $cycle = Cycle::find($id);

        $cycle->delete();
    }
}
