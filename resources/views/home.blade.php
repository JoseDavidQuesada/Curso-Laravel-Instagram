@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('include.message') <!--Incluede del message -->

            @foreach ($images as $image)

                <div class="card pub_image"> <!--Estilo extra para el avatar del card -->
                        <div class="card-header">
                            @if ($image->user->image )
                                <div class="container-avatar">
                                    <img src="{{ route('user.avatar',['filename' => $image->user->image ]) }}" class="avatar" /> <!-- Envia el parametro de img a la ruta -->
                                </div>
                            @endif
                            <div class="data-user">
                                 {{$image->user->name." ".$image->user->surname." | "}}
                                 <span class="nickname">
                                    {{"@".$image->user->nick}}
                                 </span>
                            </div>
                            
                        </div>
        
                        <div class="card-body">
                            <a href="{{ route('image.detail',['id' => $image->id ]) }}"> <!--Ruta para el controlador de detalle -->
                                <div class="image-container">
                                    <img src="{{ route('image.file',['filename' =>  $image->image_path ]) }}" alt="">
                                </div>
                            </a>
                            <div class="description">
                                <span class="nickname"> {{"@".$image->user->nick}}</span>
                                <span class="nickname"> {{" | ". \FormatTime::LongTimeFilter($image->created_at) }}</span> <!-- Utilizando el helper que creamos. -->
                                
                                <p>{{$image->description}}</p>
                            </div>

                            <div class="likes">
                                <!-- Variable para validar -->
                                <?php $user_like = false;?>

                                 <!-- valida si hay algun like asignado a algun usuario -->
                                @foreach ($image->likes as $like)

                                    @if ($like->user->id == Auth::user()->id)
                                        <?php $user_like = true;?> 
                                    @endif

                                @endforeach

                                <!-- valida si es true y le asigna su respectiva imagen black o red -->
                                @if ($user_like) 
                                    <img src="{{asset('img/heart-red.png')}}" data-info="{{$image->id}}" class="btn-dislike"/>
                                @else
                                    <img src="{{asset('img/heart-black.png')}}" data-info="{{$image->id}}" class="btn-like"/>
                                @endif

                                <p> {{count($image->likes)}}</p>
                                
                            </div>

                            <div class="comments">
                                <a href="" class="btn btn-sm btn-warning btn-comments">Comentarios ({{count($image->comments)}})</a>
                            </div>
                        </div>
                    </div>
                
            @endforeach

            <!-- Paginacion -->
            <div class="clearfix"></div>
            <div class="row justify-content-center">
                 {{$images->links()}}  <!-- Crea los link automaticamente -->
            <div>
        </div>
    </div>
</div>
@endsection
