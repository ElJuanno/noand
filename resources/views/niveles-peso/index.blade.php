@extends('layouts.app')

@section('template_title')
    Niveles Pesos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Niveles Pesos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('niveles-pesos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Id Nivel P</th>
									<th >Descripcion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nivelesPesos as $nivelesPeso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $nivelesPeso->id_nivel_p }}</td>
										<td >{{ $nivelesPeso->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('niveles-pesos.destroy', $nivelesPeso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('niveles-pesos.show', $nivelesPeso->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('niveles-pesos.edit', $nivelesPeso->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $nivelesPesos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
