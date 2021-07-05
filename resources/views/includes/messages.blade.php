@if (session('message'))
    <div>

        <x-adminlte-alert theme="success" title="Exito!" dismissable>
            <ul>
                <li>{{ session('message') }}</li>
            </ul>
        </x-adminlte-alert>
    </div>

@endif
