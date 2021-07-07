@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Shortlinks') }}</div>

                    <div class="card-body">


                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Shortlink</th>
                                    <th>Url</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($shortlinks)
                                    @foreach ($shortlinks as $link)
                                        <tr>
                                            <td>{{ $link->id }} </td>
                                            <td>{{ $link->url }} </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
