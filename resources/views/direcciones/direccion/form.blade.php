<div>
    <label for="calle" class="block font-medium text-sm text-gray-700">{{ 'Calle' }}</label>
    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="calle" name="calle" type="text" value="{{ isset($direccion->calle) ? $direccion->calle : ''}}" >
    {!! $errors->first('calle', '<p>:message</p>') !!}
</div>
<div>
    <label for="colonia" class="block font-medium text-sm text-gray-700">{{ 'Colonia' }}</label>
    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="colonia" name="colonia" type="text" value="{{ isset($direccion->colonia) ? $direccion->colonia : ''}}" >
    {!! $errors->first('colonia', '<p>:message</p>') !!}
</div>
<div>
    <label for="municipio" class="block font-medium text-sm text-gray-700">{{ 'Municipio' }}</label>
    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="municipio" name="municipio" type="text" value="{{ isset($direccion->municipio) ? $direccion->municipio : ''}}" >
    {!! $errors->first('municipio', '<p>:message</p>') !!}
</div>
<div>
    <label for="estado" class="block font-medium text-sm text-gray-700">{{ 'Estado' }}</label>
    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="estado" name="estado" type="text" value="{{ isset($direccion->estado) ? $direccion->estado : ''}}" >
    {!! $errors->first('estado', '<p>:message</p>') !!}
</div>


<div class="flex items-center gap-4">
    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        {{ $formMode === 'edit' ? 'Update' : 'Create' }}
    </button>
</div>
