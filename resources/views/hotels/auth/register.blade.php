<x-guest-layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-6 text-center p-0 mt-3 mb-2 ml-2 m">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2 >Sign Up Your Account Data</h2>
                    <p>Fill all form field to go to next step</p>
                    <p><span style="color: red">*Obligatoire</span></p>
                    <form id="msform" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="account"><strong>Hotel</strong></li>
                            <li id="personal"><strong>Hotel Owner</strong></li>
                            <li id="payment"><strong>Document</strong></li>
                            <li id="personal"><strong>Account</strong></li>
                        </ul>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div> <br> <!-- fieldsets -->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Hotel data</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 1 - 4</h2>
                                    </div>
                                </div> 
                                
                                <div>
                                    <label style="color:black;margin-left:33px;">{{__('Trade name ')}}<span style="color: red">*</span></label> 
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Trade Name" id="trade_name" class="block mt-1 w-full" type="text" name="trade_name"/>
                                    <x-input-error :messages="$errors->get('trade_name')" class="mt-2" />
                                </div>
                                <div>
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Select situation ')}}<span style="color: red">*</span></label> 
                                    <select style="display: inline-table; width: 80%;" name="situation" id="situation" class="block mt-1 w-full text-black" aria-invalid="false">
                                        <option selected="" disabled="">Select Situation</option>
                                        <option value="branch">Branch</option>
                                        <option value="main_center">Main center</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('situation')" class="mt-2" />
                                </div>
                                <div >
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Name of owner building ')}}<span style="color: red">*</span></label> 
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Name of owner building" id="name_owner_building" class="block mt-1 w-full" type="text" name="name_owner_building"/>
                                    <x-input-error :messages="$errors->get('name_owner_building')" class="mt-2" />
                                </div>
                                <div >
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Operator management')}}<span style="color: red">*</span></label> 
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Operator management" id="operator_management" class="block mt-1 w-full" type="text" name="operator_management"/>
                                    <x-input-error :messages="$errors->get('operator_management')" class="mt-2" />
                                </div>
                                <div >
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Number of employees')}}<span style="color: red">*</span></label> 
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Number of employees" id="number_of_employees" class="block mt-1 w-full" type="number" name="number_of_employees"/>
                                    <x-input-error :messages="$errors->get('number_of_employees')" class="mt-2" />
                                </div>
                                <div >
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Yemeni employee')}}<span style="color: red">*</span></label> 
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Yemeni employee" id="yemeni_employee" class="block mt-1 w-full" type="number" name="yemeni_employee"/>
                                    <x-input-error :messages="$errors->get('yemeni_employee')" class="mt-2" />
                                </div>
                                <div >
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Governorate')}}<span style="color: red">*</span></label> 
                                    <select style="display: inline-table; width: 80%;" placeholder="Governorate" id="governorate" class="block mt-1 w-full" name="hotel_governorate">
                                        <option value="  " selected>Select a Governorate</option>
                                        <option value="Hadramout">Hadramout</option>                                       
                                    </select>
                                    <x-input-error :messages="$errors->get('hotel_governorate')" class="mt-2" />
                                </div>
                                <div >
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Directoration')}}<span style="color: red">*</span></label> 
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
                                        
                                    </select>
                                    <x-input-error :messages="$errors->get('directoration')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:19px;">{{__('City')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="City" id="city" class="block mt-1 w-full" type="text" name="hotel_city"/>
                                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Street address')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Street Address" id="street_address" class="block mt-1 w-full" type="text" name="hotel_street_address"/>
                                    <x-input-error :messages="$errors->get('street_address')" class="mt-2" />
                                </div>
                                {{-- <div> --}}
                                    {{-- <x-input-label for="name" :value="__('')" /> --}}
                                    {{-- <x-text-input style="display: inline-table; width: 80%;" placeholder="Class" id="class" class="block mt-1 w-full" type="text" name="class"/> --}}
                                    {{-- <select style="display: inline-table; width: 80%;" name="class" id="class" class="block mt-1 w-full text-black" aria-invalid="false">
                                        <option selected="" disabled="">Select class</option>
                                        <option>one</option>
                                        <option>two</option>
                                        <option>three</option>
                                        <option>four</option>
                                        <option>five</option>
                                    </select> --}}
                                    {{-- <x-input-error :messages="$errors->get('class')" class="mt-2" /> --}}
                                {{-- </div> --}}
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:19px;">{{__('Email')}}<span style="color: red">*</span></label> <br/> 
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Email" id="hotel_email" class="block mt-1 w-full" type="email" name="hotel_email"/>
                                    <x-input-error :messages="$errors->get('hotel_email')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:19px;">{{__('Website')}}</label> <br/>
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Website" id="website" class="block mt-1 w-full" type="text" name="website"/>
                                    <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Phone number')}}<span style="color: red">*</span></label> 
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Phone number" id="hotel_phone_number" class="block mt-1 w-full" type="text" name="hotel_phone_number"/>
                                    {{-- <input class="form-control mb-4 mb-md-0" data-inputmask-alias="(+99) 9999-9999" inputmode="text"> --}}
                                    <x-input-error :messages="$errors->get('hotel_phone_number')" class="mt<br/>-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:10px;">{{__('Fax')}}</label> <br />
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Fax" id="fax" class="block mt-1 w-full" type="text" name="fax"/>
                                    {{-- <input class="form-control mb-4 mb-md-0" data-inputmask-alias="(+99) 9999-9999" inputmode="text"> --}}
                                    <x-input-error :messages="$errors->get('fax')" class="mt-2" />
                                </div>
                                

                            </div> <input type="button" name="next" class="next action-button" value="Next"  />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Hotel Owner Information:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 2 - 4</h2>
                                    </div>
                                </div> 
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('First Name')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="First Name" id="first_name" class="block mt-1 w-full" type="text" name="first_name"/>
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Second Name')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Second Name" id="second_name" class="block mt-1 w-full" type="text" name="second_name"/>
                                    <x-input-error :messages="$errors->get('second_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Third Name')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Third Name" id="third_name" class="block mt-1 w-full" type="text" name="third_name"/>
                                    <x-input-error :messages="$errors->get('third_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Last Name')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Last Name" id="last_name" class="block mt-1 w-full" type="text" name="last_name"/>
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>
                                <div style="border: 2px">
                                    <div>
                                        <x-input-label for="name" :value="__('')" />
                                        <label class="mt-2" style="color:black;margin-left:29px;">{{__('Identity Number')}}<span style="color: red">*</span></label> <br />
                                        <x-text-input style="display: inline-table; width: 80%;" placeholder="Identity Number" id="identity_number" class="block mt-1 w-full" type="text" name="identity_number"/>
                                        <x-input-error :messages="$errors->get('identity_number')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="name" :value="__('')" />
                                        <label class="mt-2" style="color:black;margin-left:29px;">{{__('Identity type')}}<span style="color: red">*</span></label> <br />
                                        <x-text-input style="display: inline-table; width: 80%;" placeholder="Identity type" id="identity_type" class="block mt-1 w-full" type="text" name="identity_type"/>
                                        <x-input-error :messages="$errors->get('identity_type')" class="mt-2" />
                                    </div>
                                    <div>
                                        <label class="mt-2" style="color:black;margin-left:29px;">{{__('Date of issue')}}<span style="color: red">*</span></label> <br />
                                        <x-text-input style="display: inline-table; width: 80%;" placeholder="Date of issue" id="date_of_issue" class="block mt-1 w-full" type="date" name="date_of_issue"/>
                                        <x-input-error :messages="$errors->get('date_of_issue')" class="mt-2" />
                                    </div>
                                    <div>
                                        <label class="mt-2" style="color:black;margin-left:29px;">{{__('Date of expiry')}}<span style="color: red">*</span></label> <br />
                                        <x-text-input style="display: inline-table; width: 80%;" placeholder="Date of expiry" id="date_of_expiry" class="block mt-1 w-full" type="date" name="date_of_expiry"/>
                                        <x-input-error :messages="$errors->get('date_of_expiry')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="name" class="mt-1" style="color: white" :value="__('')" />
                                        <label class="mt-2" style="color:black;margin-left:29px;">{{__('Identity issuing authority')}}<span style="color: red">*</span></label> <br />
                                        <x-text-input style="display: inline-table; width: 80%;" placeholder="Identity issuing authority" id="issuing_authority" class="block mt-1 w-full" type="text" name="issuing_authority"/>
                                        <x-input-error :messages="$errors->get('issuing_authority')" class="mt-2" />
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Country')}}<span style="color: red">*</span></label> <br />
                                    <select style="display: inline-table; width: 80%;" placeholder="Country" id="country" class="block mt-1 w-full" name="country">
                                        <option value="  " selected>Select a country</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="AG">Antigua and Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA">Bosnia and Herzegowina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="BN">Brunei Darussalam</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo</option>
                                        <option value="CD">Congo, the Democratic Republic of the</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CI">Cote d'Ivoire</option>
                                        <option value="HR">Croatia (Hrvatska)</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="TP">East Timor</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands (Malvinas)</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="FX">France, Metropolitan</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard and Mc Donald Islands</option>
                                        <option value="VA">Holy See (Vatican City State)</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran (Islamic Republic of)</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KP">Korea, Democratic People's Republic of</option>
                                        <option value="KR">Korea, Republic of</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Lao People's Democratic Republic</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libyan Arab Jamahiriya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macau</option>
                                        <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia, Federated States of</option>
                                        <option value="MD">Moldova, Republic of</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN">Netherlands Antilles</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Reunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russian Federation</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="KN">Saint Kitts and Nevis</option> 
                                        <option value="LC">Saint LUCIA</option>
                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">Sao Tome and Principe</option> 
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SK">Slovakia (Slovak Republic)</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SH">St. Helena</option>
                                        <option value="PM">St. Pierre and Miquelon</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syrian Arab Republic</option>
                                        <option value="TW">Taiwan, Province of China</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania, United Republic of</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="UM">United States Minor Outlying Islands</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Viet Nam</option>
                                        <option value="VG">Virgin Islands (British)</option>
                                        <option value="VI">Virgin Islands (U.S.)</option>
                                        <option value="WF">Wallis and Futuna Islands</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="YU">Yugoslavia</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" class="mt-1" style="color: white" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Place of birth')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Place of birth" id="place_of_birth" class="block mt-1 w-full" type="text" name="place_of_birth"/>
                                    <x-input-error :messages="$errors->get('place_of_birth')" class="mt-2" />
                                </div>
                                <div>
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Date of birth')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Date of birth" id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth"/>
                                    <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Sex')}}<span style="color: red">*</span></label> <br />
                                    <select style="display: inline-table; width: 80%;" name="sex" id="sex" class="block mt-1 w-full text-black" aria-invalid="false">
                                        <option selected="" disabled="">Select Sex</option>
                                        <option>male</option>
                                        <option>female</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('sex')" class="mt-2" />
                                </div>
                                <div >
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Governorate')}}<span style="color: red">*</span></label> <br />
                                    <select style="display: inline-table; width: 80%;" placeholder="Governorate" id="governorate" class="block mt-1 w-full" name="governorate">
                                        <option value="  " selected>Select a Governorate</option>
                                        <option value="Hadramout">Hadramout</option>                                       
                                    </select>
                                    <x-input-error :messages="$errors->get('governorate')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('City')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="City" id="city" class="block mt-1 w-full" type="text" name="city"/>
                                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Street address')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Street Address" id="street_address" class="block mt-1 w-full" type="text" name="street_address"/>
                                    <x-input-error :messages="$errors->get('street_address')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Phone number')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input style="display: inline-table; width: 80%;" placeholder="Phone number" id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"/>
                                    {{-- <input class="form-control mb-4 mb-md-0" data-inputmask-alias="(+99) 9999-9999" inputmode="text"> --}}
                                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                                </div>
                            </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Document Upload:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 3 - 4</h2>
                                    </div>
                                </div> 
                                    <div class="mb-4">
                                        <label class="fieldlabels" style="color:black;">{{__('Commercial record')}}<span style="color: red">*</span></label> 
                                        <input type="file" name="commercial_record" style="display: inline-table; width: 80% ;background-color:rgb(227, 227, 227);" accept="application/pdf"> 
                                        <x-input-error :messages="$errors->get('commercial_record')" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="fieldlabels" style="color:black;">{{__('The property of the facility or lease agreement (valid for several years)')}}<span style="color: red">*</span></label> 
                                        <input type="file" name="building_property" style="display: inline-table; width: 80%;background-color:rgb(223, 223, 223);" accept="application/pdf">
                                        <x-input-error :messages="$errors->get('building_property')" class="mt-2" />
                                    </div> 
                                    <div class="mb-4">
                                        <label class="fieldlabels" style="color:black;">{{__('Personal or family card of the authorized owner or official ')}}<span style="color: red">*</span></label> 
                                        <input type="file" name="personal_card" style="display: inline-table; width: 80%;background-color:rgb(223, 223, 223);" accept="application/pdf"> 
                                        <x-input-error :messages="$errors->get('personal_card')" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="fieldlabels" style="color:black;">{{__('Personal photo (4×6) of the owner')}}<span style="color: red">*</span></label> 
                                        <input type="file" name="personal_photo" style="display: inline-table; width: 80%;background-color:rgb(223, 223, 223);" accept="image/*">
                                        <x-input-error :messages="$errors->get('personal_photo')" class="mt-2" />
                                    </div>
                                    {{-- <div class="mb-4">
                                        <label class="fieldlabels">{{__('Executive Director (Qualifid, Certificate of Expertise, Card)')}}</label> 
                                        <input type="file" name="executive_director" style="display: inline-table; width: 80%;background-color:white;" accept="image/*">
                                        <x-input-error :messages="$errors->get('executive_director')" class="mt-2" />
                                    </div> --}}
                                </div> 
                                    <input type="button" name="next" class="next action-button" value="Next" /> 
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        

                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Account:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 4 - 4</h2>
                                    </div>
                                </div>
                                <!-- Name -->
                                <div>
                                    <x-input-label for="name" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Name')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input placeholder="Name" style="display: inline-table; width: 80%;" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-input-label for="email" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Email')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input placeholder="Email" style="display: inline-table; width: 80%;" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Password')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input placeholder="Password" style="display: inline-table; width: 80%;" id="password" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-input-label for="password_confirmation" :value="__('')" />
                                    <label class="mt-2" style="color:black;margin-left:29px;">{{__('Password Confirmation')}}<span style="color: red">*</span></label> <br />
                                    <x-text-input placeholder="Password Confirmation" style="display: inline-table; width: 80%;" id="password_confirmation" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password_confirmation" required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                            
                            <div class=" items-center justify-end">
                                <button class="action-button">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

    </form>
</x-guest-layout>
