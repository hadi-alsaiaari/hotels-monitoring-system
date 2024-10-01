
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
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">

            <div class="card-header pb-0 mb-3" >
                <h6 class="card-title">Accommodations Filter</h6>
                <form action="{{route("{$x}_filter_accommodation")}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3 mt-3">
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
                        <div class="col-sm-3 mt-3">
                            <div class="mb-3">
                              <label class="form-label">Residential Permit</label>
                              <select name="is_residential_permit" class="js-example-basic-single form-select" data-width="50%">
                                <option value="0" selected>All</option>
                                <option value="1">Residential Permit</option>
                                <option value="2">Without Residential Permit</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-3 mt-3">
                            <div class="mb-3">
                              <label class="form-label">Price Min</label>
                              <input type="text" name="price_min" class="form-control" placeholder="Enter Price Min" >
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('price_min')" />
                          </div>
                          <div class="col-sm-3 mt-3">
                            <div class="mb-3">
                              <label class="form-label">Price Max</label>
                              <input type="text" name="price_max" class="form-control" placeholder="Enter Price Max" >
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('price_max')" />
                          </div>
                          <div class='col-sm-6'>
                            <div class='mb-3'>
                                <label class='form-label'>From</label>
                                <input type='date' name='start_at' class='form-control' >
                            </div>
                                <x-input-error class='mt-2' :messages="$errors->get('start_at')" />
                          </div>
                          <div class='col-sm-6'>
                            <div class='mb-3'>
                                <label class='form-label'>To</label>
                                <input type='date' name='end_at' class='form-control' >
                            </div>
                                <x-input-error class='mt-2' :messages="$errors->get('end_at')" />
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
<div class="row row-sm mt-3" id="print">
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
                                <th class="border-bottom-0">ID</th>
                                <th class="border-bottom-0">Hotel Name</th>
                                <th class="border-bottom-0">price</th>
                                <th class="border-bottom-0">Arrival At</th>
                                <th class="border-bottom-0">Departure At</th>
                                <th class="border-bottom-0">Expected Departure Time</th>
                                <th class="border-bottom-0">Created At</th>
                                <th class="border-bottom-0">Notice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accommodations as $n => $accommodation)
                                <tr>
                                    <td class="sorting_1">{{$accommodation->number_accommodation}}</td>
                                    <td>{{$accommodation->room->hotel->trade_name}}</td>
                                    <td>{{$accommodation->price}}</td>
                                    <td>{{$accommodation->arrival_at}}</td>
                                    <td>{{$accommodation->departure_at}}</td>
                                    <td>{{$accommodation->expected_departure_time}}</td>
                                    <td>{{$accommodation->created_at}}</td>
                                    <td>{{$accommodation->notice}}</td>
    
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
{{-- <div class="page-content" id="print">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Special pages</a></li>
						<li class="breadcrumb-item active" aria-current="page">Invoice</li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="container-fluid d-flex justify-content-between">
                  <div class="col-lg-3 ps-0">
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
                <div class="container-fluid d-flex justify-content-between">
                  <div class="col-lg-3 ps-0">

                  </div>
                  <div class="col-lg-9 ps-0">
                    <p class="mt-1 mb-1"><b>استمارة رسوم الإقامة للمنشآت الفندقية السياحية</b></p>
                    <p ><center>عن شهر ..... لسنة : 202</center></p>
                    <p><center>اسم المنشأة: ........ الدرجة:........</center></p>
                    <p><center>اسم صاحب المنشأة: ........ العنوان:........</center></p>
                  </div>
                </div>
                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                  <div class="table-responsive w-100">
                      <table class="table table-bordered">
                        <thead>
                          <tr>

                            <th colspan="2" rowspan="3"><center>الإجمالي</center></th>
                            <th colspan="2" ><center>شقق</center></th>
                            <th colspan="2" ><center>أجنحة</center></th>
                            <th colspan="6" ><center>غرف</center></th>
                            <th rowspan="3"><center>مكونات الإيواء</center></th>
                            <th rowspan="3">#</th>
                              </tr>
                              <tr>
                            
                            <th rowspan="2"><center>ب</center></th>
                            <th rowspan="2"><center>أ</center></th>
                            <th rowspan="2"><center>ب</center></th>
                            <th rowspan="2"><center>أ</center></th>
                            <th colspan="2"><center>3 اسرة</center></th>
                            <th colspan="2"><center>مزدوجة</center></th>
                            <th colspan="2">مفردة</th>
                              </tr>
                              <tr>
                            <th><center>أ</center></th>
                            <th ><center>ب</center></th>
                            <th ><center>أ</center></th>
                            <th ><center>ب</center></th>
                            <th ><center>أ</center></th>
                            <th ><center>ب</center></th>
                            
                              </tr>
                        </thead>
                        <tbody>
                          <tr class="text-end">
                            <td colspan="2"><center></center></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-start"><center>إجمالي مكونات الإيواء</center></td>
                            <td class="text-start">1</td>
                            </tr>
                            <tr class="text-end">
                              <td colspan="2"><center></center></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td class="text-start"><center>عدد الأشغال الشهري</center></td>
                              <td class="text-start">2</td>
                              </tr>
                              <tr class="text-end">
                                <td colspan="2"><center></center></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-start"><center>سعر وحدة الإيواء</center></td>
                                <td class="text-start">3</td>
                                </tr>
                                <tr class="text-end">
                                  <td colspan="2"><center></center></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td class="text-start"><center>اجمالي الدخل الشهري للإيواء</center></td>
                                  <td class="text-start">4</td>
                                  </tr>
                                  <tr class="text-end">
                                    <td colspan="2"><center></center></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-start"><center> (%...)الرسم المستحق قانونا بواقع</center></td>
                                    <td class="text-start">5</td>
                                    </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
                <div class="container-fluid w-100">
                  <a href="javascript:;" class="btn btn-primary float-end mt-4 ms-2"><i data-feather="send" class="me-3 icon-md"></i>Send Invoice</a>
                  <a href="javascript:;" class="btn btn-outline-primary float-end mt-4"><i data-feather="printer" class="me-2 icon-md"></i>Print</a>
                </div>
              </div>
            </div>
					</div>
				</div>
			</div> --}}

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
