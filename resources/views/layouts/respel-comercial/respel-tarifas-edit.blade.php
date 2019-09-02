<div id="tarifa{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div id="rango{{$contadorphp}}Container" class="col-md-12" style="margin-bottom: 0.25em;">
    	@php
    		$x = 0;
    	@endphp
			@foreach($opcion->tarifas as $tarifa)
					<div class="pull-left col-md-3" style="max-height: 2.3em;">
						<label for="expireRange{{$contadorphp}}" style="font-size: 0.9em;">Vencimiento</label>
						<input {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial) ? '' : 'disabled' }} id="expireRange{{$contadorphp}}" name="Opcion[{{$contadorphp}}][TarifaVencimiento]" type="date" class="form-control" value="{{$tarifa->TarifaVencimiento}}">
						@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
					   		<input type="date" hidden name="Opcion[{{$contadorphp}}][TarifaVencimiento]" value="{{$tarifa->TarifaVencimiento}}">
					    @endif
					</div>
					<div class="pull-right col-md-1">
						<label for="addrangeButton{{$contadorphp}}">Más</label>
						<button {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial) ? '' : 'disabled' }} style="cursor: cell;" onclick="AgregarRango({{$contadorphp}})" class="btn btn-primary addrangeButton" id="addrangeButton{{$contadorphp}}"> <i class="fa fa-plus"></i></button>
					</div>
					<div class="pull-left col-md-3">
						<label style="font-size: 0.9em;" data-trigger="hover" data-toggle="popover" title="<b>Frecuencia</b>" data-content="<p> se tomara en cuenta para la aplicación de la tarifa respectiva y el calculo del precio según la frecuencia de la cantidad puesta en planta Prosarc S.A. ESP</p>" for="frecrangeSelect{{$contadorphp}}">Frec.</label>
						<select {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial) ? '' : 'disabled' }} id="frecrangeSelect{{$contadorphp}}" name="Opcion[{{$contadorphp}}][TarifaFrecuencia]">
							<option {{$tarifa->TarifaFrecuencia == 'N/A' ? "selected" : ""}}>N/A</option>
							<option {{$tarifa->TarifaFrecuencia == 'Mensual' ? "selected" : ""}}>Mensual</option>
							<option {{$tarifa->TarifaFrecuencia == 'Servicio' ? "selected" : ""}}>Servicio</option>
						</select>
						@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
					   		<input hidden name="Opcion[{{$contadorphp}}][TarifaFrecuencia]" value="{{$tarifa->TarifaFrecuencia}}">
					    @endif
					</div>
					<div class="pull-left col-md-2">
						<label style="font-size: 0.9em;" for="typerangeSelect{{$contadorphp}}">Tipo</label>
						<select {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial) ? '' : 'disabled' }} id="typerangeSelect{{$contadorphp}}" name="Opcion[{{$contadorphp}}][Tarifatipo]">
							<option {{$tarifa->Tarifatipo == "Kg" ? "selected" : "" }} >Kg</option>
							<option {{$tarifa->Tarifatipo == "Lt" ? "selected" : "" }} >Lt</option>
							<option {{$tarifa->Tarifatipo == "Unid" ? "selected" : "" }} >Unid</option>
						</select>
						@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
					   		<input hidden name="Opcion[{{$contadorphp}}][Tarifatipo]" value="{{$tarifa->Tarifatipo}}">
					    @endif
					</div>
					<script type="text/javaScript">
						    contadorRango[{{$contadorphp}}] = [];
							document.getElementById("addrangeButton{{$contadorphp}}").addEventListener("click", function(event){
							  event.preventDefault()
							});
					</script>
					@if(count($tarifa->rangos) > 0)
						@foreach($tarifa->rangos as $rango)
						<script type="text/javaScript">
								contadorRango[{{$contadorphp}}][{{$last}}] = {{$last}};
						</script>
							@php
							$last = $last+1;
							@endphp
							<div class="col-md-3" id="rango{{$contadorphp}}{{$last}}">
								<label style="font-size: 0.8em;" for="rangopriceinput{{$contadorphp}}{{$last}}">Desde {{$rango->TarifaDesde}} </label>
								@if(($rango->TarifaDesde != 0)&&(in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL)))
								<a onclick="EliminarRango({{$contadorphp}},{{$last}})" id="minusrangeButton{{$contadorphp}}{{$last}}"><i style="color:red; margin: 0; padding: 0; margin-top: 0.25em; cursor: pointer;" class="fa fa-trash-alt pull-right"></i></a>
								@endif
								<input {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial) ? '' : 'disabled' }} id="rangopriceinput{{$contadorphp}}{{$last}}" name="Opcion[{{$contadorphp}}][TarifaPrecio][]" type="number" class="form-control" placeholder="Precio" min="10" value="{{$rango->TarifaPrecio}}">
								<input name="Opcion[{{$contadorphp}}][TarifaDesde][]" hidden value="{{$rango->TarifaDesde}}">
								@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
							   		<input name="Opcion[{{$contadorphp}}][TarifaPrecio][]" hidden value="{{$rango->TarifaPrecio}}">
							    @endif
							</div>
			    		@endforeach
			    	@else
			    		<script type="text/javaScript">
			    				contadorRango[{{$contadorphp}}][{{$last}}] = {{$last}};
			    		</script>
		    			<div class="col-md-3" id="rango{{$contadorphp}}{{$last}}">
		    				<label style="font-size: 0.8em;" for="rangopriceinput{{$contadorphp}}{{$last}}">Desde {{$last}} </label>
		    				<input {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial) ? '' : 'disabled' }} id="rangopriceinput{{$contadorphp}}{{$last}}" name="Opcion[{{$contadorphp}}][TarifaPrecio][]" type="number" class="form-control" placeholder="Precio" min="10">
		    				<input name="Opcion[{{$contadorphp}}][TarifaDesde][]" hidden value="{{$last}}">
	    					@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
	    				   		<input name="Opcion[{{$contadorphp}}][TarifaPrecio][]" hidden>
	    				    @endif
		    			</div>
		    			@php
		    			$last = $last+1;
		    			@endphp
					@endif
	    		@php
	    			$x=$x+1;
	    		@endphp
	    	@endforeach
		
	</div>
</div>