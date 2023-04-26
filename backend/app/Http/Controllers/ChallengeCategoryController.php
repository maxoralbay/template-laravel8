<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChallengeCategoryCreateRequest;
use App\Http\Requests\ChallengeCategoryUpdateRequest;
use App\Models\ChallengeCategory;
use App\Services\FileService;

class ChallengeCategoryController extends Controller
{
    public $fileSerivce;

    public function __construct()
    {
        $this->fileSerivce = new FileService('challenge-categories');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $request->has('deleted') 
            ? ChallengeCategory::onlyTrashed()->paginate(self::PER_PAGE) 
            : ChallengeCategory::paginate(self::PER_PAGE);

        return view('pages.challenge-categories.index', compact(
            'categories'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.challenge-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChallengeCategoryCreateRequest $request)
    {
        if (!$imagePath = $this->fileSerivce->uploadFile($request->file('image'))) {
            $request->session()->flash('msg_error', 'Erreur! Échec du téléchargement du fichier');

            return view('pages.challenge-categories.index');
        }

        if (!$imageCheckedPath = $this->fileSerivce->uploadFile($request->file('image'))) {
            $request->session()->flash('msg_error', 'Erreur! Échec du téléchargement du fichier');

            return view('pages.challenge-categories.index');
        }

        $category = ChallengeCategory::create([
            'name' => $request->validated()['name'],
            'image' => $imagePath,
            'image_checked' => $imageCheckedPath,
        ]);

        if ($category) {
            $request->session()->flash('msg_success', 'Entrée créée avec succès');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }

        return redirect()->route('challenge-categories.index');
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
        return view('pages.challenge-categories.edit', [
            'category' => ChallengeCategory::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ChallengeCategoryUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChallengeCategoryUpdateRequest $request, $id)
    {
        $category = ChallengeCategory::findOrFail($id);
        $data = $request->validated();

        if ($request->file('image') && !$data['image'] = $this->fileSerivce->uploadFile($request->file('image'))) {
            $request->session()->flash('msg_error', 'Erreur! Échec du téléchargement du fichier');

            return view('pages.challenge-categories.index');
        }

        if ($request->file('image_checked') && !$data['image_checked'] = $this->fileSerivce->uploadFile($request->file('image_checked'))) {
            $request->session()->flash('msg_error', 'Erreur! Échec du téléchargement du fichier');

            return view('pages.challenge-categories.index');
        }

        if ($category->update($data)) {
            $request->session()->flash('msg_success', 'Enregistrement mis à jour avec succès');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }

        return redirect()->route('challenge-categories.index');
    }


    public function restore(Request $request, $id)
    {
        if (!$category = ChallengeCategory::withTrashed()->where('id', $id)->first()) {
            abort(404, 'Catégorie introuvable!');
        }

        if ($category->restore()) {
            $request->session()->flash('msg_success', 'Enregistrement restauré avec succès !');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }


        return redirect()->route('challenge-categories.index', ['deleted' => 1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = ChallengeCategory::findOrFail($id);

        if (file_exists($category->image)) {
            unlink($category->image);
        }

        if (file_exists($category->image_checked)) {
            unlink($category->image_checked);
        }

        if ($category->delete()) {
            $request->session()->flash('msg_success', 'Message supprimé avec succès!');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }

        return redirect()->route('challenge-categories.index');
    }
}
