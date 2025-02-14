<?php

namespace App\Http\Controllers;

use App\Models\Upvote;
use App\Http\Requests\StoreUpvoteRequest;
use App\Http\Requests\UpdateUpvoteRequest;
use App\Models\Feature;
use Illuminate\Support\Facades\Auth;

class UpvoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpvoteRequest $request, Feature $feature)
    {
        $data = $request ->validated();
        Upvote::updateOrCreate([
            'user_id' => Auth::id(),
            'feature_id' => $feature->id,
        ], ['upvote' => $data['upvote']]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Upvote $upvote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upvote $upvote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUpvoteRequest $request, Upvote $upvote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upvote $upvote)
    {
        //
    }
}
