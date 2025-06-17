<div>
    <label for="id_especialista" class="block font-medium text-sm text-gray-700">{{ 'Id Especialista' }}</label>
    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="id_especialista" name="id_especialista" type="number" value="{{ isset($asignausuario->id_especialista) ? $asignausuario->id_especialista : ''}}" >
    {!! $errors->first('id_especialista', '<p>:message</p>') !!}
</div>
<div>
    <label for="id_usuario" class="block font-medium text-sm text-gray-700">{{ 'Id Usuario' }}</label>
    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="id_usuario" name="id_usuario" type="number" value="{{ isset($asignausuario->id_usuario) ? $asignausuario->id_usuario : ''}}" >
    {!! $errors->first('id_usuario', '<p>:message</p>') !!}
</div>


<div class="flex items-center gap-4">
    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        {{ $formMode === 'edit' ? 'Update' : 'Create' }}
    </button>
</div>
