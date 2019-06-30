@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @include('include.message') <!--Incluede del message -->

                <div class="card pub_image pub_image_detail"> <!--Estilo extra para los comentarios del card -->
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
                            <div class="image-container">
                                 <img src="{{ route('image.file',['filename' =>  $image->image_path ]) }}" alt="">
                            </div>
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

                            <div class="clearfix"></div> <!-- Limpiar flotados -->

                            <div class="comments">
                                <h2>Comentarios ({{count($image->comments)}})</h2>
                                <hr>

                                <form action="{{ route('comment.save')}}" method="post">
                                    @csrf <!--Seguridad al formulario -->

                                    <input type="hidden" name="image_id" value="{{$image->id}}">
                                    <p>
                                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" required></textarea>
                                            @error('content"')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </p>
                                    <button type="submit" class="btn btn-success"> Comentar</button>

                                </form>

                                <hr>
                                @foreach ($image->comments as $comment)
                                    
                                
                                <div class="comment">
                                        <span class="nickname"> {{"@".$comment->user->nick}}</span>
                                        <span class="nickname"> {{" | ". \FormatTime::LongTimeFilter($comment->created_at) }}</span> <!-- Utilizando el helper que creamos. -->
                                        
                                        <div class="col-lg-12">
                                            <div class="col-lg-10" style="float: left;">
                                                <p>{{$comment->content}}</p>
                                            </div>

                                            @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id)) <!--Validar cuando podra eliminar -->
                                                
                                                <div class="col-lg-2 text-right" style="float: left;">
                                                    <a href="{{ route('comment.delete',['id' => $comment->id]) }}">Eliminar</a>
                                                </div>

                                            @endif
                                            
                                        </div>

                                        <div class="clearfix"></div>
                                      
                                </div>

                                

                                @endforeach
                            </div>
                        </div>
                    </div>
                

        </div>
    </div>
</div>
@endsection