@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>['funcionario.update', $funcionario->id_funcionario], 'method'=>'put', 'class'=>'form']) !!}
@include('flash::message')
<div class="container-custom">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Editar Funcionário <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
	</h1>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="form-group">
					<label>Nome Completo <span class="asterisk">*</span></label>
					<input type="text" placeholder="" name="nome" class="form-control"  data-validation="required" value="{{$funcionario->nome}}">
				</div>	

				<div class="row">
					<div class="col-sm-4 form-group">
						<label>Data Nasc.<span class="asterisk">*</span></label>
						<div class="input-group add-on col-md-12" >
							<div class="input-group-btn">
								<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
							</div>
							<input name="dt_nasc" type="text" class="form-control date-picker datepicker date" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{date('d/m/Y', strtotime($funcionario->dt_nasc))}}">
						</div>
					</div>

					<div class="col-sm-4 form-group">
						<label>Estado Civil <span class="asterisk">*</span></label>
						<select class="form-control" name="id_estado_civil" data-validation="required" id="estado_civil">
							<option value="">Selecione</option>
							@foreach($civil as $civ)
							<option value="{{$civ->id_estado_civil}}">{{$civ->desc_estado_civil}}</option>
							@endforeach
						</select>
					</div>

					<div class="col-sm-4 form-group">
						<label>CPF <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cpf" class="form-control cpf" value="{{ $funcionario->cpf }}" readonly data-validation="required" id="cpf">
					</div>

				</div>

				<div class="row">

					<div class="col-sm-4 form-group">
						<label>RG <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="rg" class="form-control rg" value="{{$funcionario->rg}}" data-validation="required" id="rg">
					</div>


					<div class="col-sm-2 form-group">
						<label>Órg. Emiss.<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="orgao_exp" class="form-control" value="{{$funcionario->orgao_exp}}" data-validation="required">
					</div>	

				</div>

				<div class="row">
					<div class="col-sm-4 form-group null">
						<label>CTPS</label>
						<input type="text" name="ctps" class="form-control" value="{{$funcionario->ctps}}">
					</div>	

					<div class="col-sm-4 form-group">
						<label>Data de Admissão <span class="asterisk">*</span></label>
						<input type="text" placeholder="dd/mm/aaaa" name="dt_admissao" class="form-control" data-validation=" required" value="{{$funcionario->dt_admissao}}">
					</div>	

					<div class="col-sm-4 form-group">
						<label>Data de Demissão</label>
						<input type="text" placeholder="dd/mm/aaaa" name="dt_demissao" class="form-control" value="{{$funcionario->dt_demissao}}">
					</div>	

				</div>
				
				<div class="form-group">
					<label>Qualificaçōes</label>
					<textarea class="form-control" rows="4" name="qualificacoes"  rows="4" >{{$funcionario->qualificacoes}}</textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
	</div>

	<div class="text-center">
		<a href="{{ URL::to('/funcionario/'.$funcionario->id_funcionario.'/show/') }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
		&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-lg btn-info">Salvar <i class="fa fa-check" aria-hidden="true"></i></button>
	</div>
	<br>
	<br>
</div> 

</form> 
{!! Form::close() !!}
@endsection

@section('content_js')

<script type="text/javascript">
	$est = {{$funcionario->id_estado_civil}}
	$("#estado_civil").val($est);
</script>
@endsection