<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_persona" class="form-label">{{ __('Id Persona') }}</label>
            <input type="text" name="id_persona" class="form-control @error('id_persona') is-invalid @enderror" value="{{ old('id_persona', $persona?->id_persona) }}" id="id_persona" placeholder="Id Persona">
            {!! $errors->first('id_persona', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $persona?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="apellido_p" class="form-label">{{ __('Apellido P') }}</label>
            <input type="text" name="apellido_p" class="form-control @error('apellido_p') is-invalid @enderror" value="{{ old('apellido_p', $persona?->apellido_p) }}" id="apellido_p" placeholder="Apellido P">
            {!! $errors->first('apellido_p', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="apellido_m" class="form-label">{{ __('Apellido M') }}</label>
            <input type="text" name="apellido_m" class="form-control @error('apellido_m') is-invalid @enderror" value="{{ old('apellido_m', $persona?->apellido_m) }}" id="apellido_m" placeholder="Apellido M">
            {!! $errors->first('apellido_m', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="sexo" class="form-label">{{ __('Sexo') }}</label>
            <input type="text" name="sexo" class="form-control @error('sexo') is-invalid @enderror" value="{{ old('sexo', $persona?->sexo) }}" id="sexo" placeholder="Sexo">
            {!! $errors->first('sexo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="curp" class="form-label">{{ __('Curp') }}</label>
            <input type="text" name="curp" class="form-control @error('curp') is-invalid @enderror" value="{{ old('curp', $persona?->curp) }}" id="curp" placeholder="Curp">
            {!! $errors->first('curp', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="correo" class="form-label">{{ __('Correo') }}</label>
            <input type="text" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo', $persona?->correo) }}" id="correo" placeholder="Correo">
            {!! $errors->first('correo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="contraseña" class="form-label">{{ __('Contraseña') }}</label>
            <input type="text" name="contraseña" class="form-control @error('contraseña') is-invalid @enderror" value="{{ old('contraseña', $persona?->contraseña) }}" id="contraseña" placeholder="Contraseña">
            {!! $errors->first('contraseña', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>