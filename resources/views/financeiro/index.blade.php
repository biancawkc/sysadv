 @extends('layouts.master2')
 @section('content')
 <div class="container-custom">
   @include('flash::message')
   <h1 class="col-lg-12 well text-center" > Financeiro <i class="fa fa-money" aria-hidden="true"></i></h1>
   <br>
   <br>
   <div class="col-lg-12">
   <div class="panel panel-default">
   <br>
   <table>
   <tr>
   <td class="col-md-2"></td>
       <td class="col-md-6"> <a href=""><div class="col-lg-2 well text-center" style="height: 120px; width: 200px;"><h3>Despesas</h3></div></a></td>
       <td><a href=""><div class="col-lg-2 well text-center" style="height: 120px; width: 200px;"><h3>Parcelas</h3></div></a></td>
   </tr>

   </table>
</div>
</div>
</div>
<br>
@endsection

@section('content_js')
<script>
 $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@endsection


