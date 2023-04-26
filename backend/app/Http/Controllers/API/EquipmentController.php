<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EquipmentCategory;
use App\Models\Equipment;
use App\Http\Resources\EquipmentResource;
use App\Http\Requests\EquipmentCreateRequest;
use App\Http\Requests\EquipmentUpdateRequest;
use App\Http\Requests\EquipmentDocumentRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\System\ErrorResource;
use App\Http\Resources\System\EntityNotFoundResource;
use App\Http\Resources\System\EntityDeletedSuccessfullyResource;
use App\Http\Resources\System\EntityCreatedSuccessfullyResource;
use App\Services\FileService;

class EquipmentController extends Controller
{

    public $fileSerivce;

    public $equipmentsDir = 'equipments/documents/';

    public function __construct()
    {
        $this->fileSerivce = new FileService('equipments/documents/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        return EquipmentResource::collection(
            auth()->user()->equipments()->with('category', 'documents')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EquipmentCreateRequest  $request
     * @return JsonResource
     */
    public function create(EquipmentCreateRequest $request)
    {
        $data = $request->validated();
        $this->fileSerivce->setFileDirectory('equipments/documents/' . auth()->user()->id);

        if (!$equipmentCategory = EquipmentCategory::find($data['equipment_category_id'])) {
            return new EntityNotFoundResource(null);
        }

        if (!$equipment = $equipmentCategory->equipments()->create($data)) {
            return new ErrorResource('Erreur! Entrée non créée');
        }

        if ($documents = $request->file('documents')) {
            foreach ($documents as $document) {
                $equipment->documents()->create([
                    'name' => $document->getClientOriginalName(),
                    'path' => $this->fileSerivce->uploadFile($document)
                ]);
            }
        }

        return new EquipmentResource($equipment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function show($id)
    {
        if (!$equipment = auth()->user()->equipments()->find($id)) {
            return new EntityNotFoundResource(null);
        }

        return new EquipmentResource($equipment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EquipmentUpdateRequest  $request
     * @param  int  $id
     * @return JsonResource
     */
    public function update(EquipmentUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $this->fileSerivce->setFileDirectory('equipments/documents/' . auth()->user()->id);

        if (!$equipment = Equipment::find($id)) {
            return new EntityNotFoundResource(null);
        }

        if (!$equipment->update($data)) {
            return new ErrorResource('Erreur! Message non mis à jour');
        }

        if ($documents = $request->file('documents')) {

            foreach ($documents as $document) {
                $equipment->documents()->create([
                    'name' => $document->getClientOriginalName(),
                    'path' => $this->fileSerivce->uploadFile($document)
                ]);
            }
        }

        return new EquipmentResource(Equipment::find($id));
    }

    public function addDocument(EquipmentDocumentRequest $request, $id)
    {
        $this->fileSerivce->setFileDirectory('equipments/documents/' . auth()->user()->id);

        if (!$equipment = auth()->user()->equipments()->find($id)) {
            return new EntityNotFoundResource(null);
        }

        if ($documents = $request->file('documents')) {
            foreach ($documents as $document) {
                $equipment->documents()->create([
                    'name' => $document->getClientOriginalName(),
                    'path' => $this->fileSerivce->uploadFile($document)
                ]);
            }

            return new EntityCreatedSuccessfullyResource(null);
        }

        return new ErrorResource('Erreur! essayer plus tard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function destroy($id)
    {
        if (!$equipment = Equipment::find($id)) {
            return new EntityNotFoundResource(null);
        }

        $this->deleteDocuments($equipment);

        $equipment->delete();

        return new EntityDeletedSuccessfullyResource(null);
    }

    private function deleteDocuments(Equipment $equipment)
    {
        foreach ($equipment->documents as $document) {
            if (file_exists($document->path)) {
                unlink($document->path);
            }

            $document->delete();
        }
    }
}
