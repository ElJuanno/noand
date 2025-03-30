<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_direccion" class="form-label">{{ __('Id Direccion') }}</label>
            <input type="text" name="id_direccion" class="form-control @error('id_direccion') is-invalid @enderror" value="{{ old('id_direccion', $direccione?->id_direccion) }}" id="id_direccion" placeholder="Id Direccion">
            {!! $errors->first('id_direccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $direccione?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="cp" class="form-label">{{ __('Cp') }}</label>
            <input type="text" name="cp" class="form-control @error('cp') is-invalid @enderror" value="{{ old('cp', $direccione?->cp) }}" id="cp" placeholder="Cp">
            {!! $errors->first('cp', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="referencia" class="form-label">{{ __('Referencia') }}</label>
            <input type="text" name="referencia" class="form-control @error('referencia') is-invalid @enderror" value="{{ old('referencia', $direccione?->referencia) }}" id="referencia" placeholder="Referencia">
            {!! $errors->first('referencia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>