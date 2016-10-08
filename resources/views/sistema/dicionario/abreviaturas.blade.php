@extends('layout.main-admin')
@section('content')
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-title">Abreviaturas</h2>
        <div class="panel panel-default">
          <div class="panel-heading">Descricao de abreviacao</div>
            <div class="panel-body">
              <table id="zctb" class="display table table-striped table-bordered " cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#ID</th>
											<th>Abreviatura</th>
											<th>Descricao</th>
											<th>Acao</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>#ID</th>
											<th>Abreviatura</th>
											<th>Descricao</th>
											<th>Acao</th>
										</tr>
									</tfoot>
									<tbody>
									@foreach($showAbreviaturas as $showabv)
                    <tr>
                    	<td width="10%">{{$showabv->id}}</td>
											<td width="10%"><strong>{{$showabv->abrev}}</strong></td>
											<td width="60%">{{$showabv->desc}}</td>
      								<td width="10%">
											<button  type="button" class="btn btn-warning btn-sm " ><i class="fa fa-edit"></i></button>  
											<button  type="button" class="btn btn-danger btn-sm " ><i class="fa fa-trash"></i></button>  
											</td>
										</tr>
                   @endforeach
									</tbody>
  								</table>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection