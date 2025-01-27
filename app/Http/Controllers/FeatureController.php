<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Http\Requests\StoreFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Http\Resources\FeatureResource;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $currentUserId = Auth::id();
        $paginatedFeatures = Feature::withUpVoteCount()->withUserVoteStatus($currentUserId)-> latest()->paginate(10);
        return Inertia::render('Features/Index', [
            'features' => FeatureResource::collection($paginatedFeatures),
        ]);


    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeatureRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeatureRequest $request, Feature $feature)
    {
        //
    }

   
    public function destroy(Feature $feature)
    {
        //
    }
}
