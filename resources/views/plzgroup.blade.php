@extends('layouts.main')

@section('content')
    <div class="container">
    <form action="{{url('savePgMember')}}" method="POST">
        @csrf
            <div class="flex-wrap form-inline">
                <select name="cc_member_id" id="" class="form-control">
                    <option value="">{{__("Please select")}}:</option>
                    @foreach ($cc_users as $item)
                       <option value="{{$item->id}}">{{$item->firstname. " " . $item->lastname}}</option>
                    @endforeach
                </select>
                <select name="cc_pg_name" id="" class="form-control ml-5">
                    <option  value="">{{__("Please select")}}:</option>
                    @foreach ($plz_groups as $item)
                       <option value="{{$item->cc_pg_name}}">{{$item->cc_pg_name}}</option>
                    @endforeach
                </select>
                <button class="btn btn-secondary px-5 ml-5" type="submit">{{__("Save")}}</button>
                <div class="ml-lg-5 ">
                    <button class="btn btn-secondary ml-sm-3 refreshBtn">{{__("Prefer resubmissions")}}</button>
                    <button class="btn btn-secondary ml-lg-3 recoverBtn">{{__("Prefer recover")}}</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-3 d-flex flex-wrap" >
        <div class=" mr-5">
            <table class="table">
                <thead>
              <tr>
                  <th scope="col">{{__("Reg Code")}}</th>
                  <th scope="col">{{__("Reg Desc")}}</th>
                  <th scope="col">{{__("Agent")}}</th>
                  <th scope="col">{{__("Action")}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pg_members as $members)
                @foreach ($members->crossMembers as $item)
                <tr>
                    <td>{{$item->pivot->cc_pg_name}}</td>
                    <td>{{$item->pivot->pivotParent->cc_pg_desc}}</td>
                    <td>{{$item->firstname . " " .$item->lastname}}</td>
                    <td><button class="btn btn-primary delete" data-value="{{$item->pivot->cc_pg_name}}" data-id="{{$item->id}}">{{__("Delete")}}</button></td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    <div class=" ml-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">{{__("Reg code")}}</th>
                    <th scope="col">{{__("New addresses")}}</th>
                    <th scope="col">{{__("Not reached")}}</th>
                    <th scope="col">{{__("Resubmissions")}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($addr_count as $count)
                <tr>
                    <td>{{$count->cc_pg_name}}</td>
                    <td>{{$count->status11Count}}</td>
                    <td>{{$count->status12Count}}</td>
                    <td>{{$count->status10Count}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
                <div class="">
                    {{$addr_count->links("pagination::bootstrap-4")}}
                </div>
    </div>
</div>
@endsection
<script defer src="{{asset('js/plzgroup.js')}}"></script>
