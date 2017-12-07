@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All urls</div>

                    <div class="panel-body">

                        <table id="table1" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Full link</th>
                                <th>Short link</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($urls as $url)
                                <tr>
                                    <td>{{$url->user->name}}</td>
                                    <td>{{$url->origin}}</td>
                                    <td>
                                        <a href="{{URL::to('/'.$url->short)}}">
                                            {{URL::to('/'.$url->short)}}
                                        </a>
                                    </td>
                                    <td>{{$url->count}}</td>
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

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#table1').DataTable();
        } );
    </script>
@endsection
