@extends('layouts.app')
@section('content')

    <div class="container mt-5">
        
        <table class="table table-striped w-80 m-auto">
            <thead>
            <tr>
                <th scope="col" width="3%">#</th>
                <th scope="col" width="20%">Name</th>
                <th scope="col" width="15%">Short Url</th>
                <th scope="col" width="30%">Long Url</th>
                <th scope="col" width="5%">Total Clicks</th>


            </tr>
            </thead>
            <tbody>
                @foreach($websites as $website)
                    <tr>
                        <th scope="row">{{ $website->id }}</th>
                        <td>{{ $website->user->name ?? '' }}</td> 
                        <td>{{ $website->short_url }}</td> 
                        <td>{{ $website->long_url }}</td> 
                        <td>{{ $website->total_clicks ?? 0}}</td> 

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex">
        </div>
    </div>
@endsection
