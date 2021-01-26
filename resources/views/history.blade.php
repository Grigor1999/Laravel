@extends('layouts.main')

@section('content')
<div class="container">
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">{{__("Salutation")}}</th>
        <th scope="col">{{__("First Name")}}</th>
        <th scope="col">{{__("Last Name")}}</th>
        <th scope="col">{{__("Phone")}}</th>
        <th scope="col">{{__("Phone")}} 2</th>
        <th scope="col">{{__("Property type")}}</th>
        <th scope="col">{{__("Price")}}</th>
        <th scope="col">{{__("Object Zip")}}</th>
        <th scope="col">{{__("Object City")}}</th>
        <th scope="col">{{__("Last User")}}</th>
        <th scope="col">{{__("Last Update")}}</th>
        <th scope="col">{{__("Action")}}</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($call_list as $item)

        <tr>
          <th scope="row">{{$item->ID}}</th>
          <td>{{$item->Anrede}}</td>
          <td>{{$item->Firstname}}</td>
          <td>{{$item->Lastname}}</td>
          <td>{{$item->Telephone}}</td>
          <td>{{$item->Telephone2}}</td>
          <td>{{$item->PropertyType}}</td>
          <td>{{$item->Price}}</td>
          <td>{{$item->object_zip}}</td>
          <td>{{$item->object_City}}</td>
          <td>
              @if (!empty($item->lastUser))
                 {{$item->lastUser->firstname." " . $item->lastUser->lastname }}
              @endif
            </td>
          <td>{{$item->last_update}}</td>
          <td>
              <a href="call/{{$item->ID}}" class="btn btn-primary">{{__("Edit")}}</a>
          </td>
          


        </tr>
        @endforeach
    </tbody>
</table>
        <div class="">
            {{$call_list->links("pagination::bootstrap-4")}}
        </div>
</div>

  @endsection