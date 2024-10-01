@extends('hotels.layouts.index')
@section('dashboard')
{{-- @dd($hotel) --}}
<div class="page-content">
    <div class="col-md-14 stretch-card" >
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">Add New Hotel</h6>
            <p><span style="color: red">*Obligatoire</span></p>
                <form id="msform" class="mt-3" method="POST" action="{{ route('store_another_hotel') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('Trade Name')}}<span style="color: red">*</span></label>
                              <input type="text" name="trade_name" class="form-control" placeholder="{{__('Enter Trade Name')}}" required>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('trade_name')" />
                          </div>
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('Situation')}}<span style="color: red">*</span></label>
                              <select name="situation" class="form-control" aria-invalid="false">
                                <option selected="" disabled="">{{__('Select Situation')}}</option>
                                <option value="single">Single</option>
                                <option value="branch">Branch</option>
                                <option value="main_center">Main Center</option>
                            </select>                            
                          </div>
                            <x-input-error class="mt-2" :messages="$errors->get('situation')" />
                          </div>
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('Name of owner building')}}<span style="color: red">*</span></label>
                              <input type="text" name="name_owner_building" class="form-control" placeholder="{{__('Enter Name of owner building')}}" required>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('name_owner_building')" />
                          </div>
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('Operator management')}}<span style="color: red">*</span></label>
                              <input type="text" name="operator_management" class="form-control" placeholder="{{__('Enter Operator management')}}" required>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('operator_management')" />
                          </div>
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('Number of employees')}}<span style="color: red">*</span></label>
                              <input type="number" name="number_of_employees" class="form-control" placeholder="{{__('Enter Number of employees')}}" required>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('number_of_employees')" />
                          </div>
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('Yemeni employee')}}<span style="color: red">*</span></label>
                              <input type="number" name="yemeni_employee" class="form-control" placeholder="{{__('Enter Yemeni employee')}}" required>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('yemeni_employee')" />
                          </div>
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('Governorate')}}<span style="color: red">*</span></label>
                              <select style="display: inline-table; width: 80%;" placeholder="Governorate" id="governorate" class="block mt-1 w-full" name="hotel_governorate">
                                <option value="  " selected>Select a Governorate</option>
                                <option value="Hadramout">Hadramout</option>                                       
                            </select>                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('hotel_governorate')" />
                          </div>
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('Directoration')}}<span style="color: red">*</span></label>
                              <select style="display: inline-table; width: 80%;" placeholder="Directoration" id="directoration" class="block mt-1 w-full" name="hotel_directoration">
                                <option value="  " selected>Select a Directoration</option>
                                <option value="Mukalla">Mukalla</option>
                                <option value="Tarim">Tarim</option>
                                <option value="Seiyun">Seiyun</option>
                                <option value="Sah">Sah</option>
                                <option value="Shibam">Shibam</option>
                                <option value="Cotton">Cotton</option>
                                <option value="Al-Abr">Al-Abr</option>
                                <option value="Hajar">Hajar</option>
                                <option value="Zamkh and Manukh">Zamkh and Manukh</option>
                                <option value="Al-Qaf">Al-Qaf</option>
                                <option value="Thamud">Thamud</option>
                                
                            </select>                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('hotel_directoration')" />
                          </div>
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('City')}}<span style="color: red">*</span></label>
                              <input type="text" name="hotel_city" class="form-control" placeholder="{{__('Enter City')}}" required>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('hotel_city')" />
                          </div>
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('Street Address')}}<span style="color: red">*</span></label>
                              <input type="text" name="hotel_street_address" class="form-control" placeholder="{{__('Enter Street Address')}}" required>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('hotel_street_address')" />
                          </div>
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('Hotel Email')}}<span style="color: red">*</span></label>
                              <input type="email" name="hotel_email" class="form-control" placeholder="{{__('Enter Hotel Email')}}" required>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('hotel_email')" />
                          </div>
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('Website')}}</label>
                              <input type="text" name="website" class="form-control" placeholder="{{__('Enter Website')}}" required>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('website')" />
                          </div>
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('Hotel Phone numbe')}}<span style="color: red">*</span></label>
                              <input type="text" name="hotel_phone_number" class="form-control" placeholder="{{__('Enter Hotel Phone numbe')}}" required>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('hotel_phone_number')" />
                          </div>
                          <div class="col-sm-3">
                            <div class="mb-3">
                              <label class="form-label">{{__('Fax')}}</label>
                              <input type="text" name="fax" class="form-control" placeholder="{{__('Enter Fax')}}" required>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('fax')" />
                          </div>
                          <hr>
                            <div class="col-sm-3">
                                <div class="mb-4">
                                    <label class="fieldlabels">{{__('Commercial record')}}<span style="color: red">*</span></label> 
                                    <input type="file" name="commercial_record" class="form-control" accept="application/pdf"> 
                                    <x-input-error :messages="$errors->get('commercial_record')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="mb-4">
                                    <label class="fieldlabels">{{__('The property of the facility or lease agreement (valid for several years)')}}<span style="color: red">*</span></label> 
                                    <input type="file" name="building_property" class="form-control" accept="application/pdf">
                                    <x-input-error :messages="$errors->get('building_property')" class="mt-2" />
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-4">
                                    <label class="fieldlabels">{{__('Personal or family card of the authorized owner or official ')}}<span style="color: red">*</span></label> 
                                    <input type="file" name="personal_card" class="form-control" accept="application/pdf"> 
                                    <x-input-error :messages="$errors->get('personal_card')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-4">
                                    <label class="fieldlabels">{{__('Personal photo (4×6) of the owner')}}<span style="color: red">*</span></label> 
                                    <input type="file" name="personal_photo" class="form-control" accept="image/*">
                                    <x-input-error :messages="$errors->get('personal_photo')" class="mt-2" />
                                </div>
                            </div>
                        <div class=" items-center justify-end">
                            <button class="action-button btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>

</div>
@endsection