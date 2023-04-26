<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EquipmentCategoryCreateRequest;
use App\Http\Requests\EquipmentCategoryUpdateRequest;
use App\Models\EquipmentCategory;
use App\Services\FileService;

class EquipmentCategoryController extends Controller
{
    public $fileSerivce;

    public function __construct()
    {
        $this->fileSerivce = new FileService('equipment-categories');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $request->has('deleted') 
            ? EquipmentCategory::onlyTrashed()->paginate(self::PER_PAGE) 
            : EquipmentCategory::paginate(self::PER_PAGE);

        return view('pages.equipment-categories.index', compact(
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
        return view('pages.equipment-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentCategoryCreateRequest $request)
    {
        if (!$imagePath = $this->fileSerivce->uploadFile($request->file('image'))) {
            $request->session()->flash('msg_error', 'Erreur! Échec du téléchargement du fichier');

            return view('pages.equipment-categories.index');
        }

        $category = EquipmentCategory::create([
            'name' => $request->validated()['name'],
            'image' => $imagePath,
        ]);

        if ($category) {
            $request->session()->flash('msg_success', 'Entrée créée avec succès');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }

        return redirect()->route('equipment-categories.index');
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
        return view('pages.equipment-categories.edit', [
            'category' => EquipmentCategory::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EquipmentCategoryUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentCategoryUpdateRequest $request, $id)
    {
        $category = EquipmentCategory::findOrFail($id);
        $data = $request->validated();

        if ($request->file('image') && !$data['image'] = $this->fileSerivce->uploadFile($request->file('image'))) {
            $request->session()->flash('msg_error', 'Erreur! Échec du téléchargement du fichier');

            return view('pages.equipment-categories.index');
        }

        if ($category->update($data)) {
            $request->session()->flash('msg_success', 'Enregistrement mis à jour avec succès');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }

        return redirect()->route('equipment-categories.index');
    }


    public function restore(Request $request, $id)
    {
        if (!$category = EquipmentCategory::withTrashed()->where('id', $id)->first()) {
            abort(404, 'Catégorie introuvable!');
        }

        if ($category->restore()) {
            $request->session()->flash('msg_success', 'Enregistrement restauré avec succès !');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }


        return redirect()->route('equipment-categories.index', ['deleted' => 1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = EquipmentCategory::findOrFail($id);

        if (file_exists($category->image)) {
            unlink($category->image);
        }

        if ($category->delete()) {
            $request->session()->flash('msg_success', 'Message supprimé avec succès!');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }

        return redirect()->route('equipment-categories.index');
    }
}
