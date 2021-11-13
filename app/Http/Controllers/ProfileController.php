<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\ProfileCollection;
use App\Http\Resources\ProfileResource;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ProfileCollection
     */
    public function index(Request $request)
    {
        $profiles = Profile::all();

        return new ProfileCollection($profiles);
    }

    /**
     * @param \App\Http\Requests\ProfileStoreRequest $request
     * @return \App\Http\Resources\ProfileResource
     */
    public function store(ProfileStoreRequest $request)
    {
        $profile = Profile::create($request->validated());

        return new ProfileResource($profile);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \App\Http\Resources\ProfileResource
     */
    public function show(Request $request, Profile $profile)
    {
        return new ProfileResource($profile);
    }

    /**
     * @param \App\Http\Requests\ProfileUpdateRequest $request
     * @param \App\Profile $profile
     * @return \App\Http\Resources\ProfileResource
     */
    public function update(ProfileUpdateRequest $request, Profile $profile)
    {
        $profile->update($request->validated());

        return new ProfileResource($profile);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Profile $profile)
    {
        $profile->delete();

        return response()->noContent();
    }
}
