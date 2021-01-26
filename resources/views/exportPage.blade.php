@extends('layouts.main')

@section('content')
    <div class="container">
        <h2 class="text-color">{{__("Export of the data sets to Excel. date of entry")}}:</h2>
        <form action="{{url('exportXls')}}" method="POST">
            @csrf
            <div class="form-inline text-center mt-5">
            <div class="form-group justify-content-between">
                <label for="object_street">{{__("From")}}:</label>
                <input type="date" class="form-control ml-2" name="from">
            </div>
            <div class="form-group justify-content-between ml-3">
                <label for="object_street">{{__("To")}}:</label>
                <input type="date" class="form-control ml-2" name="to">
            </div>
            <div class="ml-5">
                <button class="btn btn-secondary" type="submit">{{__("Export")}}</button>
            </div>
        </div>
    </form>
    </div>
@endsection