@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Subir nueva imagen</div>

                <div class="card-body">

                        <form method="POST" action="{{ route('image.save')}}" enctype="multipart/form-data"> <!-- primordial para subir archivos enctype="multipart/form-data" -->
                             @csrf
        
                            <div class="form-group row">
                                <label for="image_path" class="col-md-3 col-form-label text-md-right">{{ __('Imagen') }}</label>
        
                                <div class="col-md-7">
        
                                    <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path" required/>
                                    @error('image_path')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                </div>
                            </div>

                            <div class="form-group row">
                                    <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Descripción') }}</label>
            
                                    <div class="col-md-7">
            
                                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required></textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                    </div>
                            </div>
                            <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Subir imagen') }}
                                        </button>
                                    </div>
                                </div>
        
                        </form>
        
                    </div>

            </div>

        </div>
    </div>
</div>
@endsection