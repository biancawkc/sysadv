 @extends('layouts.master2')
 @section('content')
 {!! Form::open(['route'=>['advogado.destroy', $advogado->id_advogado], 'method'=>'post']) !!}
 <div class="container-custom">
    <div class="row">
        <div class="col-md-12">
        <br><br>
            <div class=" well text-center">
                <h3>Deseja excluir todos os dados o(a) advogado(a) <br><br> <b>{{$advogado->nome}}</b>?</h3>
                <h4 class="red">Todos os processos relacionados também serão excluídos!</h4>
                <br>
                <div class="text-center">
                    <a href="{{ URL::to('/advogado/'.$advogado->id_advogado.'/show') }}" class="btn btn-lg btn-info">Não <i class="fa fa-undo" aria-hidden="true"></i></a>
                    &nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-lg btn-danger">Sim <i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
</div> 
{!! Form::close() !!}
@endsection




