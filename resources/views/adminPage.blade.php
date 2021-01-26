@extends('layouts.main')

@section('content')
    <div class="container">
        <table class="table">
            @foreach ($report as $day => $data)
            <tr>
                <td class="text-color" colspan="8"><b><font size="+1">{{$day}}</font></b><td>
            </tr>
            @foreach ($data as $member_id => $item)
            <tr>
                <td class="text-color"><b>{{$item->members->firstname . " " . $item->members->lastname}}<b></td>
                <td><a class="" href="report?member_id={{$member_id }}&date={{$day}}" rel="shadowbox,max-width=1500" >{{$item->calls}} Calls</a></td>
                <td><a class="" href="report?member_id={{$member_id }}&date={{$day}}&status=20" rel="shadowbox,max-width=1500">{{$item->shootings }} Shootings</a></td>
                <td><a class="" href="report?member_id={{$member_id }}&date={{$day}}&status=10" rel="shadowbox,max-width=1500">{{$item->wiedervorlagen }} Wiederv.</a></td>
                <td><a class="" href="report?member_id={{$member_id }}&date={{$day}}&status=90,91" rel="shadowbox,max-width=1500">{{$item->kickouts }} Kickouts</a></td>
                <td class="text-color">{{round(($item->getCallDuration($day,$member_id)/60),2) }} Minuten</td>
                <td class="text-color">{{round(($item->calls/($item->getCallDuration($day,$member_id)/3600)),2) }} CpH</td>
                <td class="text-color"><b>{{round(($item->shootings/($item->getCallDuration($day,$member_id)/3600)),2) }} SpH</b></td>
            </tr>
            @endforeach
            <tr>
                <td colspan="8"><b><font size="+1">&nbsp;</font></b><td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection