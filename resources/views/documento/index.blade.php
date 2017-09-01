 @extends('layouts.master2')
 @section('content')
 <div class="container">
   @include('flash::message')
   <h1 class="col-lg-12 well" >Documentos Cadastrados <i class="fa fa-file-text doc" aria-hidden="true"></i></h1>
   <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
   <br>
   <a href="{{ URL::to('/documento/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-plus-square" aria-hidden="true"></i></a> 
   <br>
   <br>
   <table class="table table-striped table-bordered text-center tblCadastro" >
    <thead>
        <tr>
          <!--  <th>ID</th> -->
           <th>Nome</th>
           <th>Documento</th>
           <th>Ação</th>
       </tr>
   </thead>
   <tbody>
    @if (!$documentos->isEmpty())
    @foreach($documentos as $key => $value)
    <tr>
        <!-- <td>{!! $value->id_documento !!}</td>
-->        <td>{!! $value->nome_documento !!}</td>
        <td>
        <?php $p =explode('.', $value->documento); ?>
        @if( array_pop($p) == 'pdf'  )
            <a href="{{ asset('documento/'.$value->documento) }}" target="_blank"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a>
        @else
           <a href="{{ asset('documento/'.$value->documento) }}" target="_blank"><i class="fa fa-picture-o fa-2x" aria-hidden="true"></i></a>
        @endif
        </td>
        <td>
          <a href="{{ URL::to('/documento/' . $value->id_documento. '/edit') }}" class="btn btn-md btn-info">Editar</a>
        </td>
    </tr>
    @endforeach
    @else
    <td colspan="3">
        Não há registros
    </td>
    @endif
</tbody>
</table>
<br>
<a href="{{ URL::to('/documento/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-plus-square" aria-hidden="true"></i></a> 

</div>
<br>
@endsection

@section('content_js')

@endsection


