<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EquipmentCategoryCreateRequest;
use App\Http\Requests\EquipmentCategoryUpdateRequest;
use App\Http\Resources\EquipmentCategoryResource;
use App\Http\Resources\System\ErrorResource;
use App\Http\Resources\System\EntityNotFoundResource;
use App\Http\Resources\System\EntityDeletedSuccessfullyResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\EquipmentCategory;
use App\Services\FileService;


class EquipmentCategoryController extends Controller
{
    public $fileSerivce;

    public function __construct()
    {
        $this->fileSerivce = new FileService('categories');
    }

    /**
     * Display a listing of the resource.
     *
     * @return EquipmentCategoryResource
     */
    public function index()
    {
        return EquipmentCategoryResource::collection(
            EquipmentCategory::paginate(20)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EquipmentCategoryCreateRequest  $request
     * @return JsonResource
     */
    public function create(EquipmentCategoryCreateRequest $request)
    {
        if (!$imagePath = $this->fileSerivce->uploadFile($request->file('image'))) {
            return new ErrorResource('Le fichier n\'a pas été chargé');
        }

        return new EquipmentCategoryResource(
            EquipmentCategory::create([
                'name' => $request->validated()['name'],
                'image' => $imagePath,
            ])
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function show($id)
    {
        if (!$category = EquipmentCategory::find($id)) {
            return new EntityNotFoundResource(null);
        }

        return new EquipmentCategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EquipmentCategoryUpdateRequest  $request
     * @param  int  $id
     * @return JsonResource
     */
    public function update(EquipmentCategoryUpdateRequest $request, $id)
    {
        $data = $request->validated();

        if (!$category = EquipmentCategory::find($id)) {
            return new EntityNotFoundResource(null);
        }

        if ($file = $request->file('image')) {
            if (!$data['image'] = $this->fileSerivce->uploadFile($file)) {
                return new ErrorResource('Le fichier n\'a pas été chargé');
            }
        }

        if (!$category->update($data)) {
            return new ErrorResource('Catégorie non mise à jour');
        }

        return new EquipmentCategoryResource(
            EquipmentCategory::find($id)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function destroy($id)
    {
        if (!$category = EquipmentCategory::find($id)) {
            return new EntityNotFoundResource(null);
        }

        if ($category->image && file_exists($category->image)) {
            unlink($category->image);
        }

        $category->delete();

        return new EntityDeletedSuccessfullyResource(null);
    }
}
