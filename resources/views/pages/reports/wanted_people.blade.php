
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
    {{-- @dd($wanted_peoples) --}}

<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">

            <div class="card-header pb-0 mb-3" >
                <h6 class="card-title">Wanted People Filter</h6>
                
                <form action="{{route("{$x}_filter_wantpeople")}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
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
                              <label class="form-label">Is Detection</label>
                              <select name="is_detection" class="js-example-basic-single form-select" data-width="50%">
                                <option value="0" selected>all</option>
                                <option value="1">Detection</option>
                                <option value="2">Not Detection</option>
                              </select>
                            </div>
                          </div>
                          <div class='col-sm-4 mt-1'>
                            <div class='mb-3'>
                                <label class='form-label'>From</label>
                                <input type='date' name='start_at' class='form-control' >
                            </div>
                          </div>
                          <div class='col-sm-4 mt-1'>
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
<div class="row row-sm mt-3" >
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="table-responsive"style="border-top: 2px solid #0162e8 !important;">
                    <table class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">ID</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Identity Number</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Detection At</th>
                                <th class="border-bottom-0">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wanted_peoples as $n => $wanted_people)
                                <tr>
                                    <td >{{$n+1}}</td>
                                    <td>{{$wanted_people->first_name." ".$wanted_people->second_name." ".$wanted_people->third_name." ".$wanted_people->first_name}}</td>
                                    <td>{{$wanted_people->identity_number}}</td>
                                    <td>@if ($wanted_people->is_detection == 1)
                                        <span class="label text-success d-flex"><div class="dot-label bg-success ml-1"></div><b>Detection</b></span>
                                      @else
                                      <span class="label text-danger d-flex"><div class="dot-label bg-success ml-1"></div>Not Detection</span>
                                      @endif</td>
                                    <td>{{(!empty($wanted_people->sure_at)) ? $wanted_people->sure_at : ''}}</td>
                                    <td>{{$wanted_people->created_at}}</td>
    
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
