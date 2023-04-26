<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\ChallengeCategory;
use App\Models\UserChallengeLogger;
use App\Http\Resources\ChallengeResource;
use App\Http\Resources\System\EntityUpdatedSuccessfullyResource;
use App\Http\Resources\System\EntityNotFoundResource;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ChallengeResource::collection(
            $this->filter($request)
        );
    }

    public function filter(Request $request)
    {
        $equipmentCategoryIds = auth()->user()->equipments()->pluck('equipment_category_id');

        $challenges = Challenge::with(['category', 'equipmentCategory' => function ($query) use ($equipmentCategoryIds) {
            $query->whereIn('id', $equipmentCategoryIds);
        }]);

        if ($request->has('equipment_category_id')) {
            $challenges = $challenges->where('equipment_category_id', $request->equipment_category_id);
        }

        if ($request->has('challenge_category_id')) {
            $challenges = $challenges->where('challenge_category_id', $request->challenge_category_id);
        }

        if ($request->has('global')) {
            $challenges = Challenge::with(['category', 'equipmentCategory'])->whereNull('equipment_category_id');
        }

        return $challenges->get();
    }

    public function toggleCompleted($id)
    {
        try {
            $challenge = Challenge::find($id);
            auth()->user()->completedChallenges()->toggle([$challenge->id]);

            if (auth()->user()->completedChallenges()->where('challenge_id', $challenge->id)->first()) {
                UserChallengeLogger::create([
                    'user_id' => auth()->user()->id,
                    'challenge_id' => $challenge->id,
                    'completed_at' => date('Y-m-d H:i:s')
                ]);
            }

        } catch (\Exception $e) {
            return new ErrorResource($e->getMessage());
        }

        return new EntityUpdatedSuccessfullyResource(null);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
