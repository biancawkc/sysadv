 @extends('layouts.master2')
 @section('content')
  {!! Form::open(['route'=>'processo.addProcesso' , 'class'=>'form-horizontal', 'class'=>'cpfForm']) !!}
     <div class="container-custom">
        <h1 class="col-lg-12 well "> Cadastro de Processo <i class="fa fa-file processo" aria-hidden="true"></i>
        </h1>
        <div class="col-lg-12">
        <div class="row" >
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label  class="col-md-3 control-label">Nº do Processo<span class="asterisk">*</span></label>
                            <div class="col-md-9">
                             <ul class="button-inline">
                                 <li> <input type="text" class="form-control" name="numero" data-validation="required"/></li>
                                 <li class="second-li"><button name="submit" class="btn btn-md btn-info">Próximo</button> </li>
                             </ul>
                            </div>
                        </div> 
                        <br>
                        <br>
                        <label for="msg" class="errorMsg red" id="errorMsg" style="padding-left: 160px;">{{ $msg }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
{!! Form::close() !!}
@endsection
@section('content_js')
<script type="text/javascript">
    $(document).ready(function() {
     $('input[name="numero"]').focus(function() {
       
            $('#errorMsg').hide();  
    });
});
</script>

@endsection



