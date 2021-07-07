@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create link') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('shortlink.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Url') }}</label>

                                <div class="col-md-6">
                                    <input id="url" type="url" class="form-control @error('url') is-invalid @enderror"
                                        name="url" value="{{ old('url') }}" required autocomplete="url" autofocus>

                                    @error('url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mt-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
