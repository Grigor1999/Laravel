@extends('layouts.main')

@section('content')
@if(!session('phone') && !session('validate'))
    <div class="container text-center">
    <form action="{{url('checkPhoneNumber')}}" method="POST">
        @csrf
            <h2 class="text-color">{{__("Number check")}}</h2>
            <div class="form-inline mt-3 justify-content-center">
                <label for="tel" class="text-color">{{__("Phone Number")}}</label>
                <input type="text" id="tel" name="tel" class="form-control mx-sm-3" >
                <button class="btn btn-primary">{{__("Check")}}</button>
            </div>
        </form>
    </div>
@else
@if ($errors->any())
    <div class="alert alert-danger container">
        <ul class="validate_error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
</div>
@endif  
<form action="{{url('insertImmoData')}}" method="POST">
    @csrf
<div class="container row justify-content-between mx-auto">
    <div>
        <h2>{{__("Base Data")}}</h2>
        <div class="form-inline d-block">
            <div class="form-group justify-content-between">
                <label for="Anrede">{{__("Salutation")}}</label>
            <input type="text" id="Anrede" name="Anrede" class="form-control mx-sm-3"value="{{old('Anrede')}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="Firstname">{{__("First Name")}}</label>
                <input type="text" id="Firstname" name="Firstname" class="form-control mx-sm-3" value="{{old('Firstname')}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="Lastname">{{__("Last Name")}}</label>
                <input type="text" id="Lastname" name="Lastname" class="form-control mx-sm-3"value="{{old('Lastname')}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="CompanyName">{{__("Firma")}}</label>
                <input type="text" id="CompanyName" name="CompanyName" class="form-control mx-sm-3"value="{{old('CompanyName')}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="Email">{{__("Email")}}</label>
                <input type="text" id="Email" name="Email" class="form-control mx-sm-3" value="{{old('Email')}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="Telephone">{{__("Phone")}}</label>
            <input type="text" id="Telephone" name="Telephone" class="form-control mx-sm-3" value="{{session()->has('phone') ? session('phone') : old('Telephone')}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="Telephone2">{{__("Phone")}} 2</label>
                <input type="text" id="Telephone2" name="Telephone2" class="form-control mx-sm-3" value="{{old('Telephone2')}}">
            </div>
        </div>
    </div>
    <div>
        <h2>{{__("Object Data")}}</h2>
        <div class="form-inline d-block">
            <div class="form-group justify-content-between mt-2">
                <label for="PropertyType">{{__("Property type")}}</label>
                <input type="text" id="PropertyType" name="PropertyType" class="form-control mx-sm-3" value="{{old('PropertyType')}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="object_street">{{__("Road")}}</label>
                <input type="text" id="object_street" name="object_street" class="form-control mx-sm-3" value="{{old('object_street')}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="object_zip">{{__("Post code/town")}}</label>
                <input type="text" id="object_zip" name="object_zip" class="form-control mx-sm-3" value="{{old('object_zip')}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="Price">{{__("Price")}}</label>
                <input type="text" id="Price" name="Price" class="form-control mx-sm-3" value="{{old('Price')}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="NumberOfRooms">{{__("Room")}}</label>
                <input type="text" id="NumberOfRooms" name="NumberOfRooms" class="form-control mx-sm-3" value="{{old('NumberOfRooms')}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="LivingSpace">{{__("Living Space")}}</label>
                <input type="text" id="LivingSpace" name="LivingSpace" class="form-control mx-sm-3" value="{{old('LivingSpace')}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="Quelle">{{__("Quelle")}}</label>
                <input type="text" id="Quelle" name="Quelle" class="form-control mx-sm-3" value="{{old('Quelle')}}">
            </div>
        </div>  
    </div>
    <div class="w-100 mt-5 text-center">
        <textarea class="form-control  w-100 mt-2" id="textRemarks" name="remarks" placeholder="{{__("Remarks")}}" value="{{old('remarks')}}"></textarea>
        <button class="btn btn-secondary mt-3 px-5" type="submit">{{__("Save")}}</button>
    </div>
</div>
</form>
@endif
@endsection