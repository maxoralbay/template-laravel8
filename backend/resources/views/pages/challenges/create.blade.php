@extends('layouts.backoffice')


@section('content')


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Créer un défi</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                {{-- <span class="text-muted font-weight-bold mr-4">#XRS-45670</span> --}}
                {{-- <a href="#" class="btn btn-light-warning font-weight-bolder btn-sm">Add New</a> --}}
                <!--end::Actions-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Créer un nouveau défi</h3>
                    <div class="card-toolbar">

                    </div>
                </div>
                <!--begin::Form-->
                <form method="post" action="{{ route('challenges.store') }}" enctype="multipart/form-data">
                    @csrf @method('POST')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Titre</label>
                            <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="Entrez le titre" value="{{ old('title') ?? '' }}" required />
                            @error('title')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Sous-titre</label>
                            <span class="text-danger">*</span></label>
                            <input type="text" name="subtitle" class="form-control" placeholder="Entrer le sous-titre" value="{{ old('subtitle') ?? '' }}" required />
                            @error('subtitle')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="challengeCategorySelect">Catégories de défi</label>
                            <span class="text-danger">*</span></label>
                            <select name="challenge_category_id" class="form-control" id="challengeCategorySelect" required>
                                @foreach ($challengeCategories as $challengeCategory)
                                    @if(old('challenge_category_id') && old('challenge_category_id') === $challengeCategory->id)
                                        <option value="{{ $challengeCategory->id }}" selected>{{ $challengeCategory->name }}</option>
                                    @else
                                        <option value="{{ $challengeCategory->id }}">{{ $challengeCategory->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('challenge_category_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="equipmentCategorySelect">Catégories d'équipement</label>
                            <select name="equipment_category_id" class="form-control" id="equipmentCategorySelect">
                                <option value="">Non</option>
                                @foreach ($equipmentCategories as $equipmentCategory)
                                    @if(old('equipment_category_id') && old('equipment_category_id') === $equipmentCategory->id)
                                        <option value="{{ $equipmentCategory->id }}" selected>{{ $equipmentCategory->name }}</option>
                                    @else
                                        <option value="{{ $equipmentCategory->id }}">{{ $equipmentCategory->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('equipment_category_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="challengeContent">Contenu</label>
                            <textarea id="challengeContent" name="content" cols="30" rows="10" class="form-control">{{ old('content') ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Soumettre</button>
                        <a href="{{ route('challenges.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>


@endsection