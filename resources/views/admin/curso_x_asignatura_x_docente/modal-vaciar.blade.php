<!-- delete Modal-->
<div class="modal fade" id="vaciarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro(a) de vaciar esta tabla?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">Selecciona Aceptar si estás seguro(a). </div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
    
        
        <a href="{{route('admin.curso_x_asignatura_x_docente.vaciar')}}" class="btn btn-danger" role="button" aria-pressed="true">Aceptar</a>
        
        </div>
    </div>
    </div>
</div>
{{-- onclick="$(this).closest('form').submit();" --}}