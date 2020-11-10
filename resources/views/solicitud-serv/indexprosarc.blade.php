@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
<span
    style="background-image: linear-gradient(40deg, #fbc2eb, #aa66cc); padding-right:30vw; position:relative; overflow:hidden;">
    Servicios-Solicitudes
    <div
        style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;">
    </div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('adminlte_lang::message.solsertitleindex') }}</h3>
                    @if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
                        @if(isset($Cliente)&&($Cliente->CliStatus=="Autorizado"))
                        <a href="solicitud-servicio/create"
                            class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
                        @else
                        <a href="#" disabled class="btn btn-default pull-right" data-placement="auto" data-trigger="hover"
                            data-html="true" data-toggle="popover" data-delay='{"show": 200}'
                            title="<b>Solicitudes nuevas deshabilitadas</b>"
                            data-content="<p style='width: 50%'> Actualmente se encuentra deshabilitado para realizar nuevas solicitudes de servicio <br>Para más detalles comuníquese con su <b>Asesor Comercial</b> </p>">{{ trans('adminlte_lang::message.create') }}</a>
                        @endif
                    @endif
                </div>
                <div class="box box-info">
                    <div class="box-body">
                        <div id="ModalStatus"></div>
                        <table id="SolicitudservicioTable" class="table table-compact table-bordered table-striped d-none">
                            <thead>
                                <tr>
                                    <th>{{trans('adminlte_lang::message.solsershowdate')}}</th>
                                    <th>{{trans('adminlte_lang::message.solsershowdateRPDA')}}</th>
                                    <th>N°</th>
                                    <th nowrap>Status</th>
                                    <th>{{trans('adminlte_lang::message.clientcliente')}}</th>
                                    <th>Comercial Asignado</th>
                                    <th>{{trans('adminlte_lang::message.solserindextrans')}}</th>
                                    <th>{{trans('adminlte_lang::message.solseraddrescollect')}}</th>
                                    <th>{{trans('adminlte_lang::message.seemore')}}</th>
                                    @if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
                                        <th>{{trans('adminlte_lang::message.solserstatuscertifi')}}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Servicios as $Servicio)
                                <tr style="{{$Servicio->SolSerDelete == 1 ? 'color: red' : ''}}">
                                    <td style="text-align: center;">{{date('Y/m/d', strtotime($Servicio->created_at))}}
                                    </td>
                                    <td style="text-align: center;">
                                        @if($Servicio->recepcion == null)
                                        {{null}}
                                        @else
                                        {{date('Y/m/d', strtotime($Servicio->recepcion))}}
                                        @endif
                                    </td>
                                    <td style="text-align: center;">#{{$Servicio->ID_SolSer}}</td>
                                    @switch($Servicio->SolSerStatus)
                                        @case('Pendiente')
                                        <td class="text-center"><a class='btn fixed_widthbtn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a><br>{{$Servicio->SolSerStatus}}
                                        </td>
                                        @break
                                        @case('Aceptado')
                                        <td class="text-center"><a class='btn fixed_widthbtn btn-info'><i class='fas fa-lg fa-thumbs-up'></i></a><br>{{$Servicio->SolSerStatus}}
                                        </td>
                                        @break
                                        @case('Aprobado')
                                        <td class="text-center"><a class='btn fixed_widthbtn btn-info'><i class='fas fa-lg fa-tasks'></i></a><br>{{$Servicio->SolSerStatus}}</td>
                                        @break
                                        @case('Programado')
                                        <td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-calendar-alt'></i></a><br>{{$Servicio->SolSerStatus}}
                                        </td>
                                        @break
                                        @case('Notificado')
                                        <td class="text-center"><a class='btn fixed_widthbtn btn-primary'><i class='far fa-lg fa-envelope'></i></a><br>{{$Servicio->SolSerStatus}}
                                        </td>
                                        @break
                                        @case('Recibido')
                                        <td class="text-center"><a class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a><br>{{$Servicio->SolSerStatus}}
                                        </td>
                                        @break
                                        @case('Completado')
                                        <td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-truck-loading'></i></a><br>{{$Servicio->SolSerStatus}}
                                        </td>
                                        @break
                                        @case('Conciliado')
                                        <td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-balance-scale'></i></a><br>{{$Servicio->SolSerStatus}}
                                        </td>
                                        @break
                                        @case('No Conciliado')
                                        <td class="text-center"><a class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-balance-scale-right'></i></a><br>{{$Servicio->SolSerStatus}}
                                        </td>
                                        @break
                                        @case('Corregido')
                                        <td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-weight'></i></a><br>{{$Servicio->SolSerStatus}}</td>
                                        @break
                                        @case('Tratado')
                                        <td class="text-center"><a class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-dumpster-fire'></i></a><br>{{$Servicio->SolSerStatus}}
                                        </td>
                                        @break
                                        @case('Certificacion')
                                        <td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fas fa-lg fa-certificate'></i></a><br>{{$Servicio->SolSerStatus}}
                                        </td>
                                        @break
                                        <b></b>
                                        @default
                                        <td class="text-center"><a class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-ban'></i></a><br>{{$Servicio->SolSerStatus}}</td>
                                    @endswitch
                                    <td><a data-placement="auto" data-trigger="hover" data-html="true"
                                            data-toggle="popover" data-delay='{"show": 200}'
                                            title="<b>Persona de Contacto</b>"
                                            data-content="<p>Datos de la persona de Contacto para esta Solicitud de Servicio</p><ul><li>{{$Servicio->PersFirstName}} {{$Servicio->PersLastName}}</li><li>{{$Servicio->PersEmail}}</li><li>{{$Servicio->PersCellphone}}</li></ul><p>Haga click para ver detalles adicionales de este cliente..."
                                            href="/clientes/{{$Servicio->CliSlug}}" target="_blank"><i
                                                class="fas fa-user"></i></a>{{$Servicio->CliName}}</td>
                                    <td>{{$Servicio->ComercialPersFirstName.' '.$Servicio->ComercialPersLastName}}</td>
                                    <td>{{$Servicio->SolSerNameTrans}}</td>
                                    <td>{{$Servicio->SolSerCollectAddress == null ? 'N/A' : $Servicio->SolSerCollectAddress}}
                                    </td>
                                    <td style="text-align: center;"><a
                                            href='/solicitud-servicio/{{$Servicio->SolSerSlug}}' class="btn btn-info"
                                            title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i
                                                class="fas fa-search"></i></a></td>
                                    @if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) ||
                                    in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
                                    @php
                                    $Status = ['Conciliado', 'Tratado'];
                                    @endphp
                                    <td>
                                        <button id="{{'buttonCertStatus'.$Servicio->SolSerSlug}}"
                                            onclick="ModalCertificacion('{{$Servicio->SolSerSlug}}', '{{$Servicio->ID_SolSer}}', '{{in_array($Servicio->SolSerStatus, $Status)}}', 'Certificada', 'certificar')"
                                            {{in_array($Servicio->SolSerStatus, $Status) ? '' :  'disabled'}}
                                            style="text-align: center;"
                                            class="{{'classCertStatus'.$Servicio->SolSerSlug}} btn btn-{{$Servicio->SolSerStatus == 'Certificacion' ? 'default' : 'success'}}"><i
                                                class="fas fa-certificate"></i>
                                            {{trans('adminlte_lang::message.solserstatuscertifi')}}</button>
                                    </td>
                                    @endif
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
@section('NewScript')
<script>
    function ModalCertificacion(slug, id, boolean, value, text){
		if(boolean == 1){
			$('#ModalStatus').empty();
			$('#ModalStatus').append(`
				<div class="modal modal-default fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-body">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
									<i class="fas fa-exclamation-triangle"></i>
									<span style="font-size: 0.3em; color: black;"><p>¿Seguro(a) quiere `+text+` la solicitud <b>N° `+id+`</b>?</p></span>
								</div> 
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No, salir</button>
								<button type="button" id="buttonCertStatusOK`+slug+`" data-dismiss="modal" class='btn btn-success'>Si, acepto</button>
							</div>
						</div>
					</div>
				</div>
			`);
			popover();
			envsubmit();
			$('#myModal').modal();
			$('#buttonCertStatusOK'+slug).on( "click", function() {
				$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
				});
				$.ajax({
				url: "{{url('/certificarservicio')}}/"+slug,
				method: 'GET',
				data:{},
				beforeSend: function(){
					let buttonsubmit = $('.classCertStatus'+slug);
					buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = true;
								$(this).prop('disabled', true);
							});
					buttonsubmit.empty();
					buttonsubmit.append(`<i class="fas fa-sync fa-spin"></i> Actualizando...`);
				},
				success: function(res){
					let buttonsubmit = $('.classCertStatus'+slug);
					switch (res['code']) {
						case 200:
							buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = true;
								$(this).prop('disabled', true);
							});
							buttonsubmit.prop('class', 'btn btn-default');
							buttonsubmit.empty();
							buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificado`);

							toastr.success(res['message']);
							break;
					
						default:
							buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = false;
								$(this).prop('disabled', false);
							});
							buttonsubmit.prop('class', 'btn btn-success classCertStatus'+slug);
							buttonsubmit.empty();
							buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificar`);

							toastr.error(res['error']);
							break;
					}
				},
				error: function(error){
					let buttonsubmit = $('.classCertStatus'+slug);
					switch (error['responseJSON']['code']) {
						case 400:
							buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = true;
								$(this).prop('disabled', true);
							});
							buttonsubmit.prop('class', 'btn btn-default');
							buttonsubmit.empty();
							buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificado`);
							
							break;
					
						default:
							buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = false;
								$(this).prop('disabled', false);
							});
							buttonsubmit.prop('class', 'btn btn-success classCertStatus'+slug);
							buttonsubmit.empty();
							buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificar`);

							break;
					}
					toastr.error(error['responseJSON']['message']);
				},
				complete: function(){
					//
				}
				})
			});;
		}
	}
</script>
@endsection