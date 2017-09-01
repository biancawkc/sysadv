 @extends('layouts.master2')
 @section('content')
 {!! Form::open(['route'=>['funcionario.destroy', $funcionario->id_funcionario], 'method'=>'post']) !!}
 <div class="container-custom">
    <div class="row">
        <div class="col-md-12">
        <br><br>
            <div class=" well text-center">
                <h3>Deseja excluir o funcionário a seguir?</h3>
                <br>
                <div class="text-center">
                    <a href="{{ URL::to('/funcionario/'.$funcionario->id_funcionario.'/show') }}" class="btn btn-lg btn-info">Não <i class="fa fa-undo" aria-hidden="true"></i></a>
                    &nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-lg btn-danger">Sim <i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>
            </div>


        </div>
    </div>
</div> 
{!! Form::close() !!}
@endsection




