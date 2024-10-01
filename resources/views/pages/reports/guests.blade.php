
@extends("{$x}.layouts.index")
<style>
    @media print {
        #print_Button {
            display: none;
        }
    }

</style>
@section('dashboard')

<div class="page-content">
    {{-- @dd($guests) --}}

<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">

            <div class="card-header pb-0 mb-3" >
                <h6 class="card-title">Guests Filter </h6>
                <form action="{{route("{$x}_filter_guest")}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-sm-2 mt-3">
                            <div class="mb-3">
                              <label class="form-label">Hotel Name</label>
                              <select name="hotel_id" class="js-example-basic-single form-select" data-width="50%">
                                <option value="0" selected>Selected</option>
                                @foreach ($hotels as $hotel)
                                <option value="{{$hotel->id}}">{{$hotel->trade_name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                            <div class="col-sm-2 mt-3">
                              <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" >
                              </div>
                            </div>
                            <div class="col-sm-2 mt-3">
                              <div class="mb-3">
                                <label class="form-label">Second Name</label>
                                <input type="text" name="second_name" class="form-control" placeholder="Enter Second Name" >
                              </div>
                            </div>
                            <div class="col-sm-2 mt-3">
                              <div class="mb-3">
                                <label class="form-label">Third Name</label>
                                <input type="text" name="third_name" class="form-control" placeholder="Enter Third Name" >
                              </div>
                            </div>
                            <div class="col-sm-2 mt-3">
                              <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" >
                              </div>
                            </div>
                            <div class="col-sm-2 mt-3">
                              <div class="mb-3">
                                <label class="form-label">Identity</label>
                                <input type="text" name="identity_number" class="form-control" placeholder="Enter Identity" >
                              </div>
                            </div>
                          <div class="col-sm-2 mt-3">
                            <div class="mb-3">
                              <label class="form-label">Sex</label>
                              <select name="is_male" class="js-example-basic-single form-select" data-width="50%">
                                <option value="0" selected>All</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-2 mt-3">
                            <div class="mb-3">
                              <label class="form-label">Country</label>
                              <select class="js-example-basic-single form-select" placeholder="Country" id="country" class="block mt-1 w-full" name="country">
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
                            </div>
                          </div>
                          <div class="col-sm-2 mt-3">
                            <div class="mb-3">
                              <label class="form-label">Firearm</label>
                              <select name="is_firearm" class="js-example-basic-single form-select" data-width="50%">
                                <option value="0" selected>all</option>
                                <option value="1">Owns Firearm</option>
                                <option value="2">No Firearm</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-2 mt-3">
                            <div class="mb-3">
                              <label class="form-label">Type Guests</label>
                              <select name="is_escort_with" class="js-example-basic-single form-select" data-width="50%">
                                <option value="0" selected>all</option>
                                <option value="1">Guest</option>
                                <option value="2">Escort</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-2 mt-3">
                            <div class="mb-3">
                              <label class="form-label">Foreigner</label>
                              <select name="is_foreigner" class="js-example-basic-single form-select" data-width="50%">
                                <option value="0" selected>all</option>
                                <option value="1">Foreigner</option>
                                <option value="2">Yemen</option>
                              </select>
                            </div>
                          </div>
                          <div class='col-sm-1 mt-3'>
                            <div class='mb-3'>
                                <label class='form-label'>From</label>
                                <input type='date' name='start_at' class='form-control' >
                            </div>
                          </div>
                          <div class='col-sm-1 mt-3'>
                            <div class='mb-3'>
                                <label class='form-label'>To</label>
                                <input type='date' name='end_at' class='form-control' >
                            </div>
                          </div>
                    
                                <button type="submit" class="btn btn-primary btn-block" id="print_Button">Filter</button>
                            {{-- <a href="javascript:;" class="btn btn-outline-primary float-end mt-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a> --}}
                            <button class="btn btn-outline-primary float-end mt-4" id="print_Button" onclick="printDiv()"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</button>
                      </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<!-- row closed -->
<div class="row row-sm mt-3"id="print" >
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-body">
              <div class="container-fluid d-flex justify-content-between">
                <div class="col-lg-3 ps-0">
                  {{-- <a href="#" class="noble-ui-logo logo-light d-block mt-3">Noble<span>UI</span></a>                  --}}
                  <p class="mt-1 mb-1"><b>REPUBLIC OF YEMEN</b></p>
                  <p >Ministry of</p>
                  <p>Tourism And Environment</p>
                  <h5 class="mt-3 mb-2 text-muted"></h5>
                  <p>Number( )<br> Date :</p>
                </div>
                <div class="col-lg-3 pe-0" style="">
                  <h4 class="mt-1 mb-1"><b><center>بسم الله الرحمن الرحيم</center></b></h4>
                  <img style="width: 80%;height: 40%;margin-left: 19px;" src="{{url('backend/assets_/images/others/Emblem_of_Yemen.png')}}" alt="">
                  <img style="width: 80%;height: 30%;margin-left: 19px;" src="{{url('backend/assets_/images/others/IMG-20231023-WA0009.jpg')}}" alt="">

              </div>
                <div class="col-lg-3 pe-0">
                  <h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">الجمهورية اليمنية</h4>
                  <h4 class="text-end mb-1 pb-4">وزارة السياحة</h4>
                </div>
              </div>
              <hr>
                <div class="table-responsive"style="border-top: 2px solid #0162e8 !important;">
                  <table class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">Full Name</th>
                        <th class="border-bottom-0">Hotel Name</th>
												<th class="border-bottom-0">Country</th>
												<th class="border-bottom-0">Place Of Birth</th>
												<th class="border-bottom-0">Date Of Birth</th>
												<th class="border-bottom-0">Sex</th>
												<th class="border-bottom-0">Identity Number</th>
												<th class="border-bottom-0">Identity Type</th>
												<th class="border-bottom-0">Date Of Issue</th>
												<th class="border-bottom-0">Date Of Expiry</th>
												<th class="border-bottom-0">Issuing Authority</th>
											</tr>
										</thead>
										<tbody>
											@foreach($guests as $n => $guest)
											
												<tr>
													<td class="sorting_1">{{$n+1}}</td>
													<td>{{$guest->guest->identity->full_name}}</td>
                          <td>{{$guest->accommodation->room->hotel->trade_name}}</td>
													<td>{{$guest->guest->identity->country}}</td>
													<td>{{$guest->guest->identity->place_of_birth}}</td>
													<td>{{$guest->guest->identity->date_of_birth}}</td>
													<td>{{$guest->guest->identity->sex}}</td>
													<td>{{$guest->guest->identity->identity_number}}</td>
													<td>{{$guest->guest->identity->identity_type}}</td>
													<td>{{$guest->guest->identity->date_of_issue}}</td>
													<td>{{$guest->guest->identity->date_of_expiry}}</td>
													<td>{{$guest->guest->identity->issuing_authority}}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
                </div>
                

            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function printDiv() {
        var printContents = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        // location.reload();
    }

</script>
@endsection
