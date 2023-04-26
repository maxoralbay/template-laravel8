@extends('layouts.backoffice')


@section('content')


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Créer une catégorie</h5>
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
                    <h3 class="card-title">Créer une catégorie</h3>
                    <div class="card-toolbar">

                    </div>
                </div>
                <!--begin::Form-->
                <form method="post" action="{{ route('challenge-categories.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nom</label>
                            <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Entrez votre nom" value="{{ $category->name ?? '' }}" required />
                            @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Couleur</label>
                            <span class="text-danger">*</span></label>
                            <input type="text" name="color" class="form-control" placeholder="Entrez votre couleur" value="{{ $category->color ?? '' }}" required />
                            @error('color')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Image</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                                    <div class="image-input-wrapper" style="background-image: url({{ asset($category->image ?? 'images/avatar.png') }})"></div>
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="image_remove" />
                                    </label>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                @error('image')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Image checked</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                                    <div class="image-input-wrapper" style="background-image: url({{ asset($category->image_checked ?? 'images/avatar.png') }})"></div>
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="image_checked" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="image_checked_remove" />
                                    </label>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                @error('image_checked')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Soumettre</button>
                        <a href="{{ route('challenge-categories.index') }}" class="btn btn-secondary">Annuler</a>
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