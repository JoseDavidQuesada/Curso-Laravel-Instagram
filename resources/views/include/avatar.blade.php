@if (Auth::user()->image)
    <div class="container-avatar">
        <img src="{{ route('user.avatar',['filename' => Auth::user()->image ]) }}" class="avatar" /> <!-- Envia el parametro de img a la ruta -->
    </div>
@endif