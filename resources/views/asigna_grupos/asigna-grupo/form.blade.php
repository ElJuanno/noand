<div>
    <label for="id_grupo" class="block font-medium text-sm text-gray-700">{{ 'Id Grupo' }}</label>
    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="id_grupo" name="id_grupo" type="number" value="{{ isset($asignagrupo->id_grupo) ? $asignagrupo->id_grupo : ''}}" >
    {!! $errors->first('id_grupo', '<p>:message</p>') !!}
</div>
<div>
    <label for="id_alimento" class="block font-medium text-sm text-gray-700">{{ 'Id Alimento' }}</label>
    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="id_alimento" name="id_alimento" type="number" value="{{ isset($asignagrupo->id_alimento) ? $asignagrupo->id_alimento : ''}}" >
    {!! $errors->first('id_alimento', '<p>:message</p>') !!}
</div>


<div class="flex items-center gap-4">
    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        {{ $formMode === 'edit' ? 'Update' : 'Create' }}
    </button>
</div>
