
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
    {{-- @dd($accommodations) --}}
{{-- @if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطا</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">

            <div class="card-header pb-0 mb-3" >
                
                <div class="container-fluid d-flex justify-content-between">
                <div class="col-lg-3 ps-0">
                  <h6 class="card-title">Taxes Filter</h6>
                </div>

                <div class="col-lg-2 pe-0">
                  
                    <a href="{{route('create_EM')}}"  class="btn btn-primary me-4 link-icon btn-xs" ><span style="font-size: 13px;">Monthly Report</span></a>

                </div>
              </div>
                
                <form action="{{route("{$x}_filter_accommodation")}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3 mt-3">
                            <div class="mb-3">
                              <label class="form-label">Hotel Name</label>
                              <select name="hotel_id" class="js-example-basic-single form-select" data-width="50%">
                                <option value="null" selected>Selected</option>
                                @foreach ($hotels as $hotel)
                                <option value="{{$hotel->id}}">{{$hotel->trade_name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class='col-sm-4 mt-3'>
                            <div class='mb-3'>
                                <label class='form-label'>From</label>
                                <input type='date' name='start_at' class='form-control' >
                            </div>
                                <x-input-error class='mt-2' :messages="$errors->get('start_at')" />
                          </div>
                          <div class='col-sm-4 mt-3'>
                            <div class='mb-3'>
                                <label class='form-label'>To</label>
                                <input type='date' name='end_at' class='form-control' >
                            </div>
                                <x-input-error class='mt-2' :messages="$errors->get('end_at')" />
                          </div>
                    
                                <button type="submit" class="btn btn-primary btn-block" id="print_Button">Filter</button>
                            {{-- <a href="javascript:;" class="btn btn-outline-primary float-end mt-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a> --}}
                            {{-- <button class="btn btn-outline-primary float-end mt-4" id="print_Button" onclick="printDiv()"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</button> --}}
                        </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
<div class="row row-sm mt-3" >
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-body">
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
                                <th class="border-bottom-0">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($accommodations as $n => $accommodation)
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
                                @endforeach --}}
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
