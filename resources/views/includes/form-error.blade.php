@if ($errors->any())
    <div>

        <x-adminlte-alert theme="danger" title="Alerta!" dismissable>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-adminlte-alert>
    </div>

@endif
<div>
    <x-adminlte-alert theme="danger" title="Alerta!" dismissable id="errors" style="display: none;">
        <h5><i class="icon fas fa-ban"></i> Alerta!</h5>

        <ul id="vinetas_error">
        </ul>
    </x-adminlte-alert>
</div>
