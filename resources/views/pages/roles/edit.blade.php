@extends("{$x}.layouts.index")
@section('dashboard')
    <div class="page-content">
        <div class="col-md-14 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create Jobs</h6>
                    <form @if (!empty($role->id)) action="{{ route("{$x}_roles_update.update", $role->id) }}" @endif
                        action="{{ route("{$x}_roles_add.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- @if (!empty($role)) @method('put') @endif --}}

                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">jobsName</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter jobsName"
                                        value="{{ $role->name }}" required>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                            </div>
                            {{-- @dd(app('abilities')) --}}
                            <label class="card-header"><b>Select Abilities</b></label>
                            @php
                                $y = 0;
                            @endphp
                            @Auth('tourist_police')
                                @foreach (app('abilities') as $ability_code => $ability_name)
                                    @php
                                    if (!($ability_code == 'alert')) {
                                        if ($ability_code == 'no_office') {
                                            continue;
                                        }
                                        if ($ability_code == 'no_department') {
                                            continue;
                                        }
                                        if ($ability_code == 'no_police' || $y == 1) {
                                            $y = 1;
                                            continue;
                                        }
                                    } else {

                                    }
                                    @endphp
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            {{ is_callable($ability_name) ? $ability_name() : $ability_name }}
                                        </div>
                                        <div class="col-md-3" class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="abilities[{{ $ability_code }}]"
                                                value="allow" @checked(($role_abilities[$ability_code] ?? '') == 'allow')>
                                            Allow
                                        </div>
                                        <div class="col-md-3" class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="abilities[{{ $ability_code }}]"
                                                value="deny" @checked(($role_abilities[$ability_code] ?? '') == 'deny')>
                                            Deny
                                        </div>
                                    </div>
                                @endforeach
                            @endauth
                            @Auth('tourism_office')
                                @foreach (app('abilities') as $ability_code => $ability_name)
                                    @php
                                        if (!($ability_code == 'alert')) {
                                            if ($ability_code == 'residential-permit.update') {
                                                $y = 0;
                                                continue;
                                            }
                                            if ($ability_code == 'no_police') {
                                            $y = 0;
                                                continue;
                                            }
                                            if ($ability_code == 'no_office' || $y == 1) {
                                            $y = 1;
                                                continue;
                                            }
                                            if ($ability_code == 'messenger.use') {
                                                $y = 1;
                                            }
                                        } else {
                                            
                                        }
                                    @endphp
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            {{ is_callable($ability_name) ? $ability_name() : $ability_name }}
                                        </div>
                                        <div class="col-md-3" class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="abilities[{{ $ability_code }}]"
                                                value="allow" @checked(($role_abilities[$ability_code] ?? '') == 'allow')>
                                            Allow
                                        </div>
                                        <div class="col-md-3" class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="abilities[{{ $ability_code }}]"
                                                value="deny" @checked(($role_abilities[$ability_code] ?? '') == 'deny')>
                                            Deny
                                        </div>
                                    </div>
                                @endforeach
                            @endauth
                            @Auth('security_department_office')
                                @foreach (app('abilities') as $ability_code => $ability_name)
                                    @php
                                        if ($ability_code == 'no_office') {
                                            continue;
                                        }
                                        if ($ability_code == 'no_department' || $y == 1) {
                                            $y = 1;
                                            continue;
                                        }
                                    @endphp
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            {{ is_callable($ability_name) ? $ability_name() : $ability_name }}
                                        </div>
                                        <div class="col-md-3" class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="abilities[{{ $ability_code }}]"
                                                value="allow" @checked(($role_abilities[$ability_code] ?? '') == 'allow')>
                                            Allow
                                        </div>
                                        <div class="col-md-3" class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="abilities[{{ $ability_code }}]"
                                                value="deny" @checked(($role_abilities[$ability_code] ?? '') == 'deny')>
                                            Deny
                                        </div>
                                    </div>
                                @endforeach
                            @endauth
                        </div><!-- Row -->
                        
                        <button type="submit" class="btn btn-primary submit">Submit</button>
                        <a href="{{ route("{$x}_roles_all.index") }}" class="btn btn-danger me-1 link-icon">
                            Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
