<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\ChallengeCategory;
use App\Models\ChallengeImage;
use App\Models\EquipmentCategory;
use App\Http\Requests\ChallengeCreateRequest;
use App\Http\Requests\ChallengeUpdateRequest;
use App\Services\FileService;

class ChallengeController extends Controller
{
    public $fileSerivce;

    const DEFERRED_BINDING_KEY = 'editor_images';

    public function __construct()
    {
        $this->fileSerivce = new FileService('challenges', true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.challenges.index', [
            'challenges' => Challenge::with(['category', 'equipmentCategory'])->paginate(self::PER_PAGE)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.challenges.create', [
            'challengeCategories' => ChallengeCategory::all(),
            'equipmentCategories' => EquipmentCategory::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChallengeCreateRequest $request)
    {
        if ($challenge = Challenge::create($request->validated())) {
            $deferredImages = $this->getDeferredBindingImages($request);

            if (!empty($deferredImages)) {
                foreach($deferredImages as $deferredImage) {
                    if ($image = ChallengeImage::find($deferredImage)) {
                        $image->update(['challenge_id' => $challenge->id]);
                    }
                }

                $this->clearDeferredBindingImages($request);
            }

            $request->session()->flash('msg_success', 'Entrée créée avec succès');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }

        return redirect()->route('challenges.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.challenges.edit', [
            'challenge' => Challenge::findOrFail($id),
            'challengeCategories' => ChallengeCategory::all(),
            'equipmentCategories' => EquipmentCategory::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChallengeUpdateRequest $request, $id)
    {
        $challenge = Challenge::findOrFail($id);

        if ($challenge->update($request->validated())) {
            $deferredImages = $this->getDeferredBindingImages($request);

            if (!empty($deferredImages)) {
                foreach($deferredImages as $deferredImage) {
                    if ($image = ChallengeImage::find($deferredImage)) {
                        $image->update(['challenge_id' => $challenge->id]);
                    }
                }

                $this->clearDeferredBindingImages($request);
            }

            $request->session()->flash('msg_success', 'Enregistrement mis à jour avec succès');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }

        return redirect()->route('challenges.index');
    }

    public function restore(Request $request, $id)
    {
        if (!$category = Challenge::withTrashed()->where('id', $id)->first()) {
            abort(404, 'Catégorie introuvable!');
        }

        if ($category->restore()) {
            $request->session()->flash('msg_success', 'Enregistrement restauré avec succès !');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }


        return redirect()->route('challenges.index', ['deleted' => 1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $challenge = Challenge::findOrFail($id);

        if ($challenge->delete()) {
            $request->session()->flash('msg_success', 'Message supprimé avec succès!');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }

        return redirect()->route('challenges.index');
    }

    public function uploadImage(Request $request)
    {
        if ($imagePath = $this->fileSerivce->uploadFile($request->file('upload'))) {
            $challengeImage = ChallengeImage::create(['path' => $imagePath]);
            $this->setDeferredBindingImage($request, $challengeImage->id);

            return response()->json([
                'default' => asset($challengeImage->path)
            ]);
        }

        return response()->json(['default' => 'null']);
    }

    private function setDeferredBindingImage(Request $request, $imageId)
    {
        $imageIds = $request->session()->has(self::DEFERRED_BINDING_KEY) 
            ? unserialize($request->session()->get(self::DEFERRED_BINDING_KEY)) : [];
        
        array_push($imageIds, $imageId);

        $request->session()->put(self::DEFERRED_BINDING_KEY, serialize($imageIds));
    }

    private function getDeferredBindingImages(Request $request)
    {
        return $request->session()->has(self::DEFERRED_BINDING_KEY)
            ? unserialize($request->session()->get(self::DEFERRED_BINDING_KEY)) : [];
    }

    private function clearDeferredBindingImages(Request $request)
    {
        $request->session()->forget(self::DEFERRED_BINDING_KEY);
    }
}
