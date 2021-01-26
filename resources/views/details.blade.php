@extends('layouts.main')

@section('content')
    <div class="container detailsContainer">
        <table border="1"  width="600" cellspacing="0" cellpadding="10" class="table">
            @foreach($title as $tit_val => $tit_key) 
            <tr>
                <td><b>{{$tit_key}}</b></td>
                <td>{{$details->$tit_val}}</td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection