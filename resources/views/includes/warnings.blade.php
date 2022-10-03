@if (session('warning'))
    <div>

        <x-adminlte-alert theme="warning" title="Atención!" dismissable>
            <ul>
                <li>{{ session('warning') }}</li>
            </ul>
        </x-adminlte-alert>
    </div>

@endif
