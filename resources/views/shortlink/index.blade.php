@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1 class="card-header">{{ __('Shortlinks') }}</h1>

                    @if (isset($max_limit))
                        <p class="text-danger">{{ $max_limit }}</p>
                    @endif
                    <div class="card-body">


                        @php
                            $shortlinks = auth()
                                ->user()
                                ->shortlinks()
                                ->get();

                            $shortlinksTrashed = auth()
                                ->user()
                                ->shortlinks()
                                ->onlyTrashed()
                                ->get();
                        @endphp
                        @if ($shortlinks->count() > 0)

                            <h2>Active Shortlink</h2>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($shortlinks as $shortlink)
                                        <tr class="d-flex flex-wrap border">
                                            <td><button class="btn btn-primary clipboard"
                                                    data-mdb-clipboard-target="#copy-link-{{ $shortlink->id }}">
                                                    Copy Url
                                                </button>
                                                <div id="copy-link-{{ $shortlink->id }}"
                                                    data-mdb-clipboard-text="{{ config('app.url') }}/goto/{{ $shortlink->id }}"
                                                    class="mt-2">
                                                </div>
                                            </td>
                                            <form method="POST"
                                                action="{{ route('shortlink.update', ['shortlink' => $shortlink]) }}">
                                                @csrf
                                                @method('put')

                                                <td><input name="url" value="{{ $shortlink->url }}"
                                                        data-mdb-toggle="tooltip" title="{{ $shortlink->url }}" /></td>
                                                <td>
                                                    <button data-mdb-toggle="tooltip" title="Update Shortlink"
                                                        class="btn btn-success" type="submit"><i
                                                            class="fas fa-edit"></i></button>
                                                </td>
                                            </form>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('shortlink.delete', ['shortlink' => $shortlink]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-mdb-toggle="tooltip" title="Disable Shortlink"
                                                        class="btn btn-warning" type="submit"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('shortlink.destroy', ['id' => $shortlink->id]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-mdb-toggle="tooltip" title="Delete Shortlink"
                                                        class="btn btn-danger" type="submit"><i
                                                            class="fas fa-minus-circle"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <div class="container">
                                <p>No active shortlinks. </p>
                                <a href={{ route('shortlink.create') }} class="btn btn-primary">Add Shortlink</a>
                            </div>

                        @endif

                        <h2 class="mt-5">Disabled Shortlinks</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($shortlinksTrashed as $shortlink)
                                    <tr class="d-flex">

                                        <td>{{ \Illuminate\Support\Str::limit($shortlink->url, $limit = 30, $end = '...') }}
                                        </td>
                                        <td>
                                            <form method="POST"
                                                action="{{ route('shortlink.restore', ['id' => $shortlink->id]) }}">
                                                @csrf
                                                <button data-mdb-toggle="tooltip" title="Restore Shortlink"
                                                    class="btn btn-success" type="submit"><i
                                                        class="fas fa-plus-square"></i></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST"
                                                action="{{ route('shortlink.destroy', ['id' => $shortlink->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button data-mdb-toggle="tooltip" title="Delete Shortlink"
                                                    class="btn btn-danger" type="submit"><i
                                                        class="fas fa-minus-circle"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
