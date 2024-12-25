<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\PlantRecommendation;

class PlantRecommendationsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $plant_recommendations = PlantRecommendation::all();

            return response()->json($plant_recommendations);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Plant recommendations not found', 'message' => $e->getMessage()], 404);
        }
    }

    public function create(Request $request)
    {
        try {
            $season = Season::find($request->season_id);

            if (!$season) {
                return response()->json(['error' => 'Season not found'], 404);
            }

            $plant_recommendation = $season->plant_recommendations()->create([
                'name' => $request->name,
                'imageUrl' => $request->imageUrl,
            ]);

            return response()->json($plant_recommendation, 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Plant recommendation not created', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $plant_recommendation = PlantRecommendation::find($id);

            if (!$plant_recommendation) {
                return response()->json(['error' => 'Plant recommendation not found'], 404);
            }

            $plant_recommendation->name = $request->name;
            $plant_recommendation->imageUrl = $request->imageUrl;
            $plant_recommendation->save();

            return response()->json($plant_recommendation);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Plant recommendation not updated', 'message' => $e->getMessage()], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $plant_recommendation = PlantRecommendation::find($id);

            if (!$plant_recommendation) {
                return response()->json(['error' => 'Plant recommendation not found'], 404);
            }

            $plant_recommendation->delete();

            return response()->json(['message' => 'Plant recommendation deleted']);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Plant recommendation not deleted', 'message' => $e->getMessage()], 500);
        }
    }

    public function getBySeason(Request $request, $season_id)
    {
        try {
            $season = Season::find($season_id);

            if (!$season) {
                return response()->json(['error' => 'Season not found'], 404);
            }

            $plant_recommendations = $season->plant_recommendations()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

            return response()->json($plant_recommendations);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Plant recommendations not found', 'message' => $e->getMessage()], 404);
        }
    }
}
