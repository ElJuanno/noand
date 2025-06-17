<div>
    <label for="id_persona" class="block font-medium text-sm text-gray-700">{{ 'Id Persona' }}</label>
    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="id_persona" name="id_persona" type="number" value="{{ isset($reportenutricional->id_persona) ? $reportenutricional->id_persona : ''}}" >
    {!! $errors->first('id_persona', '<p>:message</p>') !!}
</div>
<div>
    <label for="observaciones" class="block font-medium text-sm text-gray-700">{{ 'Observaciones' }}</label>
    <textarea id="observaciones" name="observaciones" type="textarea" rows="5" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" >{{ isset($reportenutricional->observaciones) ? $reportenutricional->observaciones : ''}}</textarea>

    {!! $errors->first('observaciones', '<p>:message</p>') !!}
</div>


<div class="flex items-center gap-4">
    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        {{ $formMode === 'edit' ? 'Update' : 'Create' }}
    </button>
</div>
