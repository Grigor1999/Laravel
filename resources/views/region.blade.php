@extends('layouts.main')

@section('content')
    <div class="container">
    <form action="{{url('savePlzUser')}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary px-4">Save</button>
        <table class="table mt-4">
            <thead>
                <th><b>Aktiv</b></th>
                <th colspan="2"><b>PLZ Ort</b></th>
                <th><b>Shootings zuweisen an:</b></th>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <input type="hidden" name="plzlist[]" value="{{$item->PLZ}}">
                    <td><input type="checkbox" name="active[{{$item->PLZ}}]" {{ ($item->active) ? ' checked' : ''}}></td>
                    <td>{{$item->PLZ}}</td>
                    <td>{{$item->zipcodes[0]->Ort}}</td>
                    <td>
                        <select  name="agent[{{$item->PLZ}}]">
                            <option value="1"></option>
                            @foreach ($agents as $agent)
                                <option value="{{$agent->id}}" {{$agent->id==$item->sho_member ? "selected" : ""}}>{{$agent->firstname . " " . $agent->lastname}}</option>
                            @endforeach
                        </select>
                </td>
                </tr>
                @endforeach
            </tbody>

        </table>
        {{$data->links("pagination::bootstrap-4")}}
    </form>

    </div>
@endsection