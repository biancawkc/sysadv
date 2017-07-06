@extends('layouts.master2')
@section('content')
<div id="cdt" class="container-custom" >
    <h1>Dados Pessoais</h1>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-12">

                <div class="form-group">
                    <label>Nome Completo <span class="asterisk">*</span></label>
                    <input type="text" placeholder="" name="nome" class="form-control" autofocus data-validation="required">
                </div>

                <div class="row">

                    <div class="col-sm-3 form-group">
                        <label>Data Nasc. <span class="asterisk">*</span></label>
                        
                        <input type='text' name="dt_nasc" class="form-control" />

                    </div>


                    <div class="col-sm-4 form-group">
                        <label>Estado Civil <span class="asterisk">*</span></label>
                        <input type='text' name="dt_nasc" class="form-control" />
                    </div>

                </div>


                <div class="row">

                    <div class="col-sm-4 form-group">
                        <label>CPF <span class="asterisk">*</span></label>
                        <input type="text" placeholder="" name="cpf" class="form-control cpf"  readonly data-validation="required" id="cpf">
                    </div>

                    <div class="col-sm-4 form-group">
                        <label>RG <span class="asterisk">*</span></label>
                        <input type="text" placeholder="" name="rg" class="form-control rg" value="" data-validation="required" id="rg">
                    </div>


                    <div class="col-sm-2 form-group">
                        <label>Órg. Emiss.<span class="asterisk">*</span></label>
                        <input type="text" placeholder="" name="orgao_exp" class="form-control" value="" data-validation="required">
                    </div>  

                </div>
            </div>
        </div>
    </div>

    <h1>Second Step</h1>
    <div>Second Content</div>
</div>
@endsection

@section('content_js')
<script>
  var wizard = $("#cdt").steps();
</script>
@endsection