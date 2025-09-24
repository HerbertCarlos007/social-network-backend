<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateAboutProfileRequest;
use App\Http\Resources\AboutProfileResource;
use App\Models\AboutProfile;

class AboutProfileController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $aboutProfile = AboutProfile::where('user_id', $userId)->first();

        return new AboutProfileResource($aboutProfile);
    }

    public function store(StoreUpdateAboutProfileRequest $request)
    {
        $userId = auth()->id();
        $validated = $request->validated();

        AboutProfile::create([
            'user_id' => $userId,
            'about' => $validated['about'],
            'works_at' => $validated['works_at'],
            'studied_at' => $validated['studied_at'],
            'lives_in' => $validated['lives_in']
        ]);

        return response()->json(['message' => 'Sobre adicionando com sucesso!']);
    }

    public function update(StoreUpdateAboutProfileRequest $request, AboutProfile $aboutProfile)
    {

        if (!$aboutProfile) {
            return response()->json(['message' => 'About-me não encontrado!'], 404);
        }

        $validated = $request->validated();
        $aboutProfile->update([
            'about' => $validated['about'],
            'works_at' => $validated['works_at'],
            'studied_at' => $validated['studied_at'],
            'lives_in' => $validated['lives_in']
        ]);
        return new AboutProfileResource($aboutProfile);
    }
}
