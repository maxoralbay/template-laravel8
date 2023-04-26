@extends('layouts.backoffice')


@section('content')


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Gestion des utilisateurs</h5>
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
                    <h3 class="card-title">Création d'un nouvel utilisateur</h3>
                    <div class="card-toolbar">

                    </div>
                </div>
                <!--begin::Form-->
                <form method="post" action="{{ route('users.store') }}">
                    @csrf @method('POST')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Prénom</label>
                            <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" class="form-control" placeholder="Entrez votre prénom" value="{{ old('first_name') ?? '' }}" required />
                            @error('first_name')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nom</label>
                            <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" class="form-control" placeholder="Entrez votre nom" value="{{ old('last_name') ?? '' }}" required />
                            @error('last_name')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Adresse e-mail</label>
                            <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Entrer l'adresse e-mail" value="{{ old('email') ?? '' }}" required />
                            @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Code postal</label>
                            <span class="text-danger">*</span></label>
                            <input type="text" name="zipcode" class="form-control" placeholder="Entrer le code postal" value="{{ old('zipcode') ?? '' }}" required />
                            @error('zipcode')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Assurance</label>
                            <input type="text" name="garanty" class="form-control" placeholder="Entrez l'assurance" value="{{ old('garanty') ?? '' }}" />
                            @error('garanty')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Les rôles</label>
                            <span class="text-danger">*</span></label>
                            <select name="role_id" class="form-control" id="exampleSelect1" required>
                                @foreach ($roles as $role)
                                    @if(old('role_id') && old('role_id') === $role->id)
                                        <option value="{{ $role->id }}" selected>{{ $role->code }}</option>
                                    @else
                                        <option value="{{ $role->id }}">{{ $role->code }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('role_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mot de passe</label>
                            <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Entrer le mot de passe" required />
                            @error('password')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Confirmation mot de passe</label>
                            <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="Répéter le mot de passe" required />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Soumettre</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
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