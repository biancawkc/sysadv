 @extends('layouts.master2')
 @section('content')
 {!! Form::open(['route'=>['documento.destroy', $documento->id_documento], 'method'=>'post']) !!}
 <div class="container-custom">
    <div class="row">
        <div class="col-md-12">
        <br><br>
            <div class=" well text-center">
                <h3>Deseja excluir o documento <b>{{$documento->nome_documento}}</b><br><br> do Processo Nº {{$processo}}?</h3>
                <br>
                <div class="text-center">
                    <a href="{{ URL::to('/documento/'.$documento->id_processo) }}" class="btn btn-lg btn-info">Não <i class="fa fa-undo" aria-hidden="true"></i></a>
                    &nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-lg btn-danger">Sim <i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>
            </div>


        </div>
    </div>
</div> 
{!! Form::close() !!}
@endsection




