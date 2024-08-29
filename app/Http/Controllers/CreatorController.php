<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreatorRequest;
use App\Http\Requests\UpdateCreatorRequest;
use App\Models\Creator;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $creators = Creator::paginate(5);
        return view('creators.index', compact('creators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('creators.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCreatorRequest $request)
    {
        $request->validate([
            "name" => "required|unique:creators,name",
        ]);
        $creator = Creator::create($request->all());
        return to_route('creators.show', $creator);
    }

    /**
     * Display the specified resource.
     */
    public function show(Creator $creator)
    {
        return view('creators.show', compact('creator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Creator $creator)
    {
        return view("creators.edit", compact('creator'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCreatorRequest $request, Creator $creator)
    {

        $request = request()->all();
        $creator->update($request);
        return to_route('creators.show', $creator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Creator $creator)
    {

        $creator->delete();
        return to_route('creators.index')->with('success', 'Creator deleted successfully');
    }
}
