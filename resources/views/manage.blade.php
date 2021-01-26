@extends('layouts.main')

@section('content')
<div class="container manageContainer">
<form  method="GET" class="form-inline">
        <select name="filteragent" class="form-control filterSelect">
            <option value="">{{__("All Users")}}</option>
            @foreach ($myAgents as $item)
                <option value="{{$item->id}}" {{$item->id==$filteragent ? 'selected' : ''}}>{{$item->firstname . " " . $item->lastname}}</option>
            @endforeach
        </select>
        <select name="status" class="form-control ml-3 filterSelect">
            <option value="">{{__("All")}}</option>
            @foreach ($status as $key => $item)
                <option value="{{$key}}" {{$key==$selectedStatus ? 'selected' : ''}}>{{$item}}</option>
            @endforeach
        </select>
    </form>
    <div>
        @foreach ($shootings as $item)
        <table class="table mt-5">
            <tbody>
                <tr>
                <td rowspan="8" style="background-color:#{{isset($colors[$item->Status]) ? $colors[$item->Status] :''}}" data-id="{{$item->Status}}" width="12">&nbsp;</td>
                    <td colspan="8"><b><a href="{{ $item->UR}}L " rel="shadowbox">{{$item->object_title}}</a><b></td>
                    
                </tr>
                <tr>
                    <td colspan="8">{{__("Person")}}: {{$item->Firstname . " " . $item->Lastname . "," . $item->Telephone . " " . $item->Telephone2}} </td>
                </tr>
                <tr>
                    <td colspan="3"><b>{{__("Objekt")}}:</b> {{$item->object_street . " " . $item->object_zip . " " . $item->object_City}}
                        <a href="http://maps.google.de/maps?q=Kuppenweg 4, 8645 Jona" target="_blank">{{__("Map")}}</a>
                    </td>
                    <td colspan="3"><b>{{__("Meeting")}}:</b> {{$item->meeting_street . " " . $item->meeting_zip . " " . $item->meeting_City}}
                        <a href="http://maps.google.de/maps?q=Kuppenweg 4, 8645 Jona" target="_blank">{{__("Map")}}</a>
                    </td>
                    <td colspan="2" class="text-right">
                        <a href="/details/{{$item->ID}}" class="btn btn-primary" onclick="window.open(this.href,'newwindow','width=700,height=600,left=100,top=100'); return false">Details</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="8"><b>{{__("Object data")}}:</b>
                        {{strlen($item->PropertyType) > 2 ? $item->PropertyType : '' }}
                        {{strlen($item->NumberOfRooms) > 0 ? $item->NumberOfRooms. __("Room") : '' }}
                        {{strlen($item->space) > 1 ? __("Living Space") .$item->space. __("qm") : '' }}
                        {{strlen($item->Price) > 2 ? __("EUR") .$item->Price : '' }}
                        {{strlen($item->Quelle) > 2 ? $item->Quelle : '' }}
                        {{strlen($item->sho_makler) > 2 ? $item->sho_makler : '' }}
                    </td>
                </tr>
                <tr>
                    <td><b>{{__("CC-Agent")}}:</b> {{$item->lastUser->firstname . " " . $item->lastUser->lastname}}</td>
                    <td>
                        <b>{{__("Term")}}:</b>
                    </td>
                    <td class="">
                        <input type="text" size="12" placeholder="Datum / Zeit" name="meeting_timestamp" value="{{ date('d.m.Y H:i',strtotime($item->meeting_timestamp)) }}" class="form-control ml-1">
                    </td>
                    <td>
                        <b>{{__("Agents")}}:</b>
                    </td>
                    <td class="">
                        <select name="meeting_user" size="1" class="form-control ml-1">
                             <option value="0">{{__("unallocated")}}</option>;
                            @foreach($estateAgents as $agent)
                                 <option value="{{$agent->id}}" {{$agent->id == $item->meeting_user ? 'selected' : ''}}>{{$agent->firstname . " " . $agent->lastname}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <b>{{__("Status")}}:</b>
                    </td>
                    <td class="">
                        @if (strtotime($item->meeting_timestamp) > time())
                        <select name="statusManage" size="1" class="form-control ml-1">
                            @if($item->status ==20 || $item->status ==23 )
                                <option value="20">{{__("agreed")}}</option>
                            @endif
                            <option value="21" style="background-color:#{{ $colors[21]}}" {{$item->Status == 21 ? 'selected' : '' }}>{{__("canceled")}}</option>
                            <option value="22" style="background-color:#{{ $colors[22]}}" {{$item->Status == 22 ? 'selected' : '' }}>{{__("approved")}}</option>
                            <option value="23" style="background-color:#{{ $colors[23]}}" {{$item->Status == 23 ? 'selected' : '' }}>{{__("rejected")}}</option>
                        @else
                        <select name="statusManage" size="1" class="form-control ml-1">
                            @if($item->Status <25)
                                <option value="{{$item->status}}">{{__("add")}}!</option>
                            @endif
                            <option value="25" style="background-color:#{{ $colors[25]}}" {{$item->Status == 25 ? 'selected' : '' }}>{{__("Object yes")}}</option>
                            <option value="26" style="background-color:#{{ $colors[26]}}" {{$item->Status == 26 ? 'selected' : '' }}>{{__("Objekt open")}}</option>
                            <option value="27" style="background-color:#{{ $colors[27]}}" {{$item->Status == 27 ? 'selected' : '' }}>{{__("Objekt no")}}</option>

                        @endif
                        @if (Auth::user()->isSuperAdmin)
                        <option value="8" style="background-color:#{{ $colors[8] }}">{{__("Move")}}</option>
                        <option value="9" style="background-color:#{{ $colors[9] }}">{{__("Cancel")}}</option>
                        @endif
                        </select>
                    </td>
                    <td><button class="btn btn-primary save" data-id="{{$item->ID}}">{{__("Save")}}</button></td>
                </tr>
                <tr>
                    <td colspan="8">
                        <textarea placeholder="{{__("Additional comments / reasons")}}" cols="100" rows="6" name="remarks" class="form-control"></textarea>
                    </td>
                </tr>
                <tr>
                    <td valign="top" colspan="8">
					@foreach ($item->history as $history)
						<b>{{ $history->timestamp . "-" . $history->members->firstname . " " . $history->members->lastname . "(" . $history->getStatus->status . ")" }}</b> = 
						{{ $history->remark }}<br />
					@endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="8">&nbsp;<br/></td>
                </tr>
            </tbody>
        </table>
        @endforeach
        {{$shootings->links("pagination::bootstrap-4")}}
    </div>
</div>
@endsection
<script defer src="{{asset('js/manage.js')}}"></script>