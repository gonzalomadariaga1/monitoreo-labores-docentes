<?php 
use Illuminate\Support\Facades\DB;
use App\Sucursal;
use App\User;
use App\Perfil;
use App\AsignarPerfil;   
    
    $id_user_logeado = Auth::user()->id;
    $id_perfil_user_logeado = DB::table('sucursal_user')
    ->join('perfil_user','perfil_user.sucursal_user_id','=','sucursal_user.id')
    ->select('*')
    ->where('user_id',$id_user_logeado)
    ->get();

    
    
?>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: white">×</button>
        <h4><i class="icon fa fa-ban"></i>ERROR</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error}} <a href="{{URL::action('AsignarPerfilController@edit',$id_perfil_user_logeado[0]->id)}}" class="btn btn-success-violet" role="button" >SI</a></li>               
            @endforeach
        </ul>

        
    </div>
  @endif


  