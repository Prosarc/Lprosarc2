@foreach ($Requerimientos as $Requerimiento)
    
<div class=" requirements-component form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fotos</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <div class="">
            <label>
                @if ($Requerimiento->ReqFotoCargue === 1)
                <input type="checkbox" class="fotoswitch" name="ReqFotoCargue" checked/> Cargue
                @else
                <input type="checkbox" class="fotoswitch" name="ReqFotoCargue" value="True"/> Cargue  
                @endif
            </label>
          </div>
          <script>
              var checkbox = document.getElementById('ReqFotoCargue');
                checkbox.addEventListener("change", validaCheckbox, false);

                function validaCheckbox(){
  var checked = checkbox.checked;
  if(checked){
    alert('checkbox esta seleccionado');
  }
}
            </script>
          <div class="">
            <label>
                @if ($Requerimiento->ReqFotoDescargue === 1)   
                <input type="checkbox" class="fotoswitch" name="ReqFotoDescargue" value="1" checked/> Descargue
                @else         
                <input type="checkbox" class="fotoswitch" name="ReqFotoDescargue" value="1" /> Descargue
                @endif
            </label>
          </div>
          <div class="">
            <label>
                @if ($Requerimiento->ReqFotoPesaje === 1)   
                <input type="checkbox" class="fotoswitch" name="ReqFotoPesaje" value="1" checked/> Pesaje
                @else  
                <input type="checkbox" class="fotoswitch" name="ReqFotoPesaje" value="1" /> Pesaje
                @endif
            </label>
          </div>
          <div class="">
            <label>
                @if ($Requerimiento->ReqFotoReempacado === 1)   
                <input type="checkbox" class="fotoswitch" name="ReqFotoReempacado" value="1" checked/> Reempacado
                @else                       
                <input type="checkbox" class="fotoswitch" name="ReqFotoReempacado" value="1" /> Reempacado
                @endif
               </label>
          </div>
          <div class="">
            <label>
                @if ($Requerimiento->ReqFotoMezclado === 1)   
                <input type="checkbox" class="fotoswitch" name="ReqFotoMezclado" value="1" checked/> Mezclado
                @else                       
                <input type="checkbox" class="fotoswitch" name="ReqFotoMezclado" value="1" /> Mezclado
                @endif
            </label>
          </div>
          <div class="">
            <label>
                @if ($Requerimiento->ReqFotoDestruccion === 1)   
                <input type="checkbox" class="fotoswitch" name="ReqFotoDestruccion" value="1" checked/> Destruccion
                @else                       
                <input type="checkbox" class="fotoswitch" name="ReqFotoDestruccion" value="1" /> Destruccion
                @endif
            </label>
          </div>
        </div>
      </div>
      
@endforeach