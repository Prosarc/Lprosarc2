@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientcontact') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.clientcontact') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.MenuContactos') }}</h3>
					<a href="/contactos/create" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.create') }}</a>
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="contactosTable" class="table table-compact table-bordered table-striped">
							<thead>
							<tr>
								<th>{{ trans('adminlte_lang::message.clientcategoría') }}</th>
								<th>{{ trans('adminlte_lang::message.clirazonsoc') }}</th>
								<th>{{ trans('adminlte_lang::message.clientnombrecorto') }}</th>
								<th>{{ trans('adminlte_lang::message.clientNIT') }}</th>
								<th>{{ trans('adminlte_lang::message.seemore') }}</th>
							</tr>
							</thead>
							<tbody onload="renderTable()" id="readyTable">
							@include('layouts.partials.spinner')
							@foreach($Clientes as $Cliente)
							<tr @if($Cliente->CliDelete === 1)
									style="color: red;" 
								@endif
							>
								<td>{{$Cliente->CliCategoria}}</td>
								<td>{{$Cliente->CliName}}</td>
								<td>{{$Cliente->CliShortname}}</td>
								<td>{{$Cliente->CliNit}}</td>
								<td>
									<a method='get' href='/contactos/{{$Cliente->CliSlug}}' class='btn btn-primary btn-block'>{{ trans('adminlte_lang::message.see') }}</a>
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