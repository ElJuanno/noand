<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_periodo" class="form-label">{{ __('Id Periodo') }}</label>
            <input type="text" name="id_periodo" class="form-control @error('id_periodo') is-invalid @enderror" value="{{ old('id_periodo', $periodo?->id_periodo) }}" id="id_periodo" placeholder="Id Periodo">
            {!! $errors->first('id_periodo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_i" class="form-label">{{ __('Fecha I') }}</label>
            <input type="text" name="fecha_i" class="form-control @error('fecha_i') is-invalid @enderror" value="{{ old('fecha_i', $periodo?->fecha_i) }}" id="fecha_i" placeholder="Fecha I">
            {!! $errors->first('fecha_i', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_f" class="form-label">{{ __('Fecha F') }}</label>
            <input type="text" name="fecha_f" class="form-control @error('fecha_f') is-invalid @enderror" value="{{ old('fecha_f', $periodo?->fecha_f) }}" id="fecha_f" placeholder="Fecha F">
            {!! $errors->first('fecha_f', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>