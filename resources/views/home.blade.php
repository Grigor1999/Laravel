@extends('layouts.main')

@section('content')
    <form action="{{url('saveImmoData')}}" method="POST"  class="homePageContainer">
    @csrf
<input type="hidden" name="ID" value="{{$immo_list->ID}}" id="">
    <div class="container row justify-content-between mx-auto">
    <div>
        <h2>{{__("Base Data")}}</h2>
        <div class="form-inline d-block">
            <div class="form-group justify-content-between">
                <label for="Anrede">{{__("Salutation")}}</label>
            <input type="text" id="Anrede" name="Anrede" class="form-control mx-sm-3" value="{{$immo_list->Anrede}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="Firstname">{{__("First Name")}}</label>
                <input type="text" id="Firstname" name="Firstname" class="form-control mx-sm-3" value="{{$immo_list->Firstname}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="Lastname">{{__("Last Name")}}</label>
                <input type="text" id="Lastname" name="Lastname" class="form-control mx-sm-3" value="{{$immo_list->Lastname}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="CompanyName">{{__("Firma")}}</label>
                <input type="text" id="CompanyName" name="CompanyName" class="form-control mx-sm-3" value="{{$immo_list->CompanyName}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="Email">{{__("Email")}}</label>
                <input type="text" id="Email" name="Email" class="form-control mx-sm-3" value="{{$immo_list->Email}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="Briefanrede">{{__("Briefanrede")}}</label>
                <input type="text" id="Briefanrede" name="Briefanrede" class="form-control mx-sm-3" value="{{$immo_list->Briefanrede}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="brief_street">{{__("Brief Strasse")}}</label>
                <input type="text" id="brief_street" name="brief_street" class="form-control mx-sm-3" value="{{$immo_list->brief_street}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="brief_City">{{__("Brief PLZ / Ort")}}</label>
                <input type="text" id="brief_City" name="brief_City" class="form-control mx-sm-3" value="{{$immo_list->brief_City}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="Telephone">{{__("Phone")}}</label>
                <input type="text" id="Telephone" name="Telephone" class="form-control mx-sm-3" value="{{$immo_list->Telephone}}">
            </div>
            
            <div class="form-group justify-content-between mt-2">
                <label for="Telephone2">{{__("Phone")}} 2</label>
                <input type="text" id="Telephone2" name="Telephone2" class="form-control mx-sm-3" value="{{$immo_list->Telephone2}}">
            </div>
        </div>
    </div>
    <div>
        <h2>{{__("Object Data")}}</h2>
        <div class="form-inline d-block">
            <div class="form-group justify-content-between">
                <label for="">{{__("Title")}}</label>
                <h3>{{$immo_list->object_title}}</h3>
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="PropertyType">{{__("Property type")}}</label>
                <input type="text" id="PropertyType" name="PropertyType" class="form-control mx-sm-3" value="{{$immo_list->PropertyType}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="api_type">{{__("GoodSales-Typ")}}</label>
                <select name="api_type" id="" class="form-control mx-sm-3" value="{{$immo_list->api_type}}">
                    <option value=""></option>
                    <option value="house_pt" <?= ($immo_list->api_type == 'house_pt' ? 'selected' : '') ?>>Haus</option>
                    <option value="apartment_pt" <?= ($immo_list->api_type == 'apartment_pt' ? 'selected' : '') ?>>Wohnung</option>
                    <option value="property_pt" <?= ($immo_list->api_type == 'property_pt' ? 'selected' : '') ?>>Bauland / Grundstück</option>
                    <option value="parking_pt" <?= ($immo_list->api_type == 'parking_pt' ? 'selected' : '') ?>>Parkplatz / Garage</option>
                    <option value="office_pt" <?= ($immo_list->api_type == 'office_pt' ? 'selected' : '') ?>>Büro</option>
                    <option value="trading_pt" <?= ($immo_list->api_type == 'trading_pt' ? 'selected' : '') ?>>Rendite</option>
                    <option value="agriculture_pt" <?= ($immo_list->api_type == 'agriculture_pt' ? 'selected' : '') ?>>Landwirtschaft</option>
                    <option value="warehouse_pt" <?= ($immo_list->api_type == 'warehouse_pt' ? 'selected' : '') ?>>Lagerhalle / Farbrik</option>
                    <option value="hospitality_pt" <?= ($immo_list->api_type == 'hospitality_pt' ? 'selected' : '') ?>>Restaurant / Hotel</option>
                </select>
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="object_street">{{__("Road")}}</label>
                <input type="text" id="object_street" name="object_street" class="form-control mx-sm-3" value="{{$immo_list->object_street}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="object_zip">{{__("Post code/town")}}</label>
                <input type="text" id="object_zip" name="object_zip" class="form-control mx-sm-3" value="{{$immo_list->object_zip}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="Price">{{__("Price")}}</label>
                <input type="text" id="Price" name="Price" class="form-control mx-sm-3" value="{{$immo_list->Price}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="NumberOfRooms">{{__("Room")}}</label>
                <input type="text" id="NumberOfRooms" name="NumberOfRooms" class="form-control mx-sm-3" value="{{$immo_list->NumberOfRooms}}">
            </div>
            <div class="form-group justify-content-between mt-2">
                <label for="LivingSpace">{{__("Living Space")}}</label>
                <input type="text" id="LivingSpace" name="LivingSpace" class="form-control mx-sm-3" value="{{$immo_list->LivingSpace}}">
            </div>
        </div>  
    </div>
</div>
        <div class="container mt-4">
            <h2>{{__("Call Data")}}</h2>
            <div class="form-inline">
                <div class="form-group justify-content-between mt-2">
                    <label for="object_street">{{__("Follow-Up")}}:</label>
                    <input type="date" class="form-control ml-2" name="next">
                </div>
            </div>
            <div class="form-inline">
                <div class="d-flex flex-wrap" >
                    <label for="object_street">{{__("Shooting")}}:</label>
                    <div class="d-flex flex-wrap">
                        <input type="date" class="form-control mx-sm-3 mt-2 datePicker"  placeholder="{{__("Datum / Zeit")}}" name="meeting_timestamp">
                        <input type="text" placeholder="{{__("Strasse")}}" name="meeting_street" class="form-control mx-sm-3 mt-2" >
                        <input type="text"placeholder="{{__("PLZ")}}" name="meeting_zip" class="form-control mx-sm-3 mt-2">
                        <input type="text" placeholder="{{__("Ort")}}" name="meeting_city" class="form-control mx-sm-3 mt-2">
                    </div>
                </div>
                    <div class="w-100">
                        <textarea class="form-control  w-100 mt-2" id="textRemarks" name="remarks" placeholder="{{__("Remarks")}}" required></textarea>
                        <div class="invalid-feedback">
                        {{__("Please enter a message in the textarea.")}}
                        </div>
                    {{-- <textarea name="" id="textRemarks" class="form-control mt-2 w-100" placeholder="Remarks"></textarea>
                    <span class="errorMessage">This field is a required field</span> --}}
                    <div class="btn-group btn-group w-100 flex-wrap btnGroupContainer mt-2" role="group" aria-label="...">
                        @if($immo_list->Status==8 || $immo_list->Status==9)
                        <button type="button" class="btn btn-secondary statusBtn" value="{{$immo_list->status}}" data-value="noAnsw">{{__("No Answe")}}</button>
                        <button type="button" class="btn btn-secondary" value="{{$immo_list->status}}" onClick="checkWiedervorlageValue(this.value)">{{__("Follow-Up")}}</button>
                        <button type="button" class="btn btn-secondary" value="20" onClick="checkShootingValues(this.valuee)">{{__("New shoot agreed")}}</button>
                        <button type="button" class="btn btn-secondary statusBtn" value="95">{{__("Canceled Appointment")}}</button>
                        @else
                        <button type="button" class="btn btn-secondary statusBtn" value="12" data-value="noAnsw">{{__("No Answer")}}</button>
                        <button type="button" class="btn btn-secondary" value="10" onClick="checkWiedervorlageValue(this.value)">{{__("WV")}}</button>
                        <button type="button" class="btn btn-secondary" value="6" onClick="checkWiedervorlageValue(this.value)">{{__("mail + WV")}}</button>
                        <button typ="button" class="btn btn-secondary" value="7" onClick="checkWiedervorlageValue(this.value)">{{__("Brief + WV")}}</button>
                        <button type="button" class="btn btn-secondary" value="20" onClick="checkShootingValues(this.value)">{{__("Shooting agreed")}}</button>
                        <button type="button" class="btn btn-secondary statusBtn" value="90">{{__("No interest")}}</button>
                        <button type="button" class="btn btn-secondary statusBtn" value="91">{{__("Estate agents")}}</button>
                        <input type="hidden" name="status" value="">
                        <button type="button" class="btn btn-secondary saveForm">{{__("Save")}}</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
           
</form>
@endsection
<script defer src="{{asset('js/home.js')}}"></script>