@extends('layouts.main')

@section('content')
    <div class="container">
        <table class="table">
            @foreach ($report as $item)
                <tr>
                    <td><b>{{$item->getImmo->Lastname}}</b></td>
                    <td>{{ $item->getStatus->status }}</td>
                    <td>{{$item->timestamp}}</td>
                    <td>{{ $item->remark }}</td>
                    @if (strlen($item->getImmo->url) < 10)
                        <td align="middle"> {{ $item->getImmo->quelle }}</td>
                    @else    
                        <td align="middle"><a href="{{ $item->getImmo->url }}" rel="shadowbox,max-width=1500">{{__("Org. Advertisement")}}</a></td>
                    @endif
                        <td align="middle"><a style="width:100px" class="btn btn-primary" href="/call/{{ $item->immo_id }}" rel="shadowbox,max-width=1500">{{__("All Data")}}</a></td>
                        <td align="middle"><input style="width:100px" class="btn btn-primary updateBtn" type="button" data-id="{{ $item->immo_id }}" value="Auf Neu" /></td>
                </tr>
                @endforeach
        </table>
    </div>
@endsection
<script defer src="{{asset('js/report.js')}}"></script>
