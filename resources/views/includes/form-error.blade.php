@if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        {{-- <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" style="color: white">×</button> --}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
        <h4><i class="icon fa fa-ban"></i>ERROR</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error}}</li>                
            @endforeach
        </ul>
    </div>
  @endif