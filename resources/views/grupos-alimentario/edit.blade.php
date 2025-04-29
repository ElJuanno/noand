@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Grupos Alimentario
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Grupos Alimentario</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('grupos-alimentarios.update', $gruposAlimentario->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('grupos-alimentario.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
