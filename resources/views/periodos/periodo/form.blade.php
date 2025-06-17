<div>
    <label for="inicio" class="block font-medium text-sm text-gray-700">{{ 'Inicio' }}</label>
    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="inicio" name="inicio" type="date" value="{{ isset($periodo->inicio) ? $periodo->inicio : ''}}" >
    {!! $errors->first('inicio', '<p>:message</p>') !!}
</div>
<div>
    <label for="fin" class="block font-medium text-sm text-gray-700">{{ 'Fin' }}</label>
    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="fin" name="fin" type="date" value="{{ isset($periodo->fin) ? $periodo->fin : ''}}" >
    {!! $errors->first('fin', '<p>:message</p>') !!}
</div>


<div class="flex items-center gap-4">
    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        {{ $formMode === 'edit' ? 'Update' : 'Create' }}
    </button>
</div>
