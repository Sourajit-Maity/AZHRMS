@extends('adminlte::page')


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'My Profile' => '#',
    
 
]])
<div class="container">
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')">Basic</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Personal</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Education</button>
  <button class="tablinks" onclick="openCity(event, 'Kolkata')">Team Info</button>
  <button class="tablinks" onclick="openCity(event, 'Patna')">Remuneration</button>
  <button class="tablinks" onclick="openCity(event, 'Durgapur')">Skills</button>
  <button class="tablinks" onclick="openCity(event, 'Berlin')">Bank Info</button>
  <button class="tablinks" onclick="openCity(event, 'Amritsar')">Promotion</button>
  <button class="tablinks" onclick="openCity(event, 'Dhaka')">My Leave</button>
  <button class="tablinks" onclick="openCity(event, 'Delhi')">Assets</button>
  
  
 
</div>

<div id="London" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employee Id') }} - {{ $myprofile->emp_code }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('my-info-tab-update') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="emp_firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="emp_firstname" type="text" class="form-control @error('emp_firstname') is-invalid @enderror" name="emp_firstname" value="{{ $myprofile->emp_firstname }}" required autocomplete="emp_firstname" autofocus readonly>

                                @error('emp_firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="emp_middle_name" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                            <div class="col-md-6">
                                <input id="emp_middle_name" type="text" class="form-control" name="emp_middle_name" value="{{ $myprofile->emp_middle_name }}" required autocomplete="emp_middle_name" autofocus readonly>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="emp_lastname" type="text" class="form-control @error('emp_lastname') is-invalid @enderror" name="emp_lastname" value="{{ $myprofile->emp_lastname }}" required autocomplete="emp_lastname" autofocus readonly>

                                @error('emp_lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_nick_name" class="col-md-4 col-form-label text-md-right">{{ __('Nick Name') }}</label>

                            <div class="col-md-6">
                                <input id="emp_nick_name" type="text" class="form-control @error('emp_nick_name') is-invalid @enderror" name="emp_nick_name" value="{{ Auth::user()->name }}" required autocomplete="emp_nick_name" autofocus readonly>

                                @error('emp_nick_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="emp_street1" value="{{ $myprofile->emp_street1 }}" required autocomplete="address" readonly>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_work_email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="emp_work_email" type="email" class="form-control @error('emp_work_email') is-invalid @enderror" name="emp_work_email" value="{{ Auth::user()->email }}" required autocomplete="emp_work_email" readonly>

                                @error('emp_work_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_mobile" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="emp_mobile" type="number" class="form-control @error('emp_mobile') is-invalid @enderror" name="emp_mobile" value="{{ $myprofile->emp_mobile }}" required autocomplete="emp_mobile" readonly>

                                @error('emp_mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_pan_num" class="col-md-4 col-form-label text-md-right">{{ __('PAN No') }}</label>

                            <div class="col-md-6">
                                <input id="emp_pan_num" type="text" class="form-control @error('emp_pan_num') is-invalid @enderror" name="emp_pan_num" value="{{ $myprofile->emp_pan_num }}" required autocomplete="emp_pan_num" readonly>

                                @error('emp_pan_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_img" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                             
                            <img src="{{url('images')}}/{{$myprofile->emp_img}}" width="100" class="img-circle img-left">
                                
                                @error('emp_img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
             </div>
             
            </div>
        </div>
    </div>
</div>

<div id="Paris" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{ __('Employee Id') }} - {{ $myprofile->emp_code }}</div>

                <div class="card-body">
                <div class="form-group row">
                            <label for="emp_oth_email" class="col-md-4 col-form-label text-md-right">{{ __('Personal E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="emp_oth_email" type="email" class="form-control @error('emp_oth_email') is-invalid @enderror" name="emp_oth_email" value="{{ $myprofile->emp_oth_email }}" required autocomplete="emp_oth_email" readonly>

                                @error('emp_oth_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_mobile" class="col-md-4 col-form-label text-md-right">{{ __('Personal Number') }}</label>

                            <div class="col-md-6">
                                <input id="emp_mobile" type="number" class="form-control @error('emp_mobile') is-invalid @enderror" name="emp_mobile" value="{{ $myprofile->emp_mobile }}" required autocomplete="emp_mobile" readonly>

                                @error('emp_mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                
                       
                        <div class="form-group row">
                            <label for="emp_birthday" class="col-md-4 col-form-label text-md-right">{{ __('Employee Birthday') }}</label>

                            <div class="col-md-6">
                                <input id="emp_birthday" type="date" class="form-control @error('emp_birthday') is-invalid @enderror" name="emp_birthday" value="{{ $myprofile->emp_birthday }}" required autocomplete="emp_birthday" autofocus readonly> 

                                @error('emp_birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_bloodgroup" class="col-md-4 col-form-label text-md-right">{{ __('Employee Blood Group') }}</label>

                            <div class="col-md-6">
                                <input id="emp_bloodgroup" type="text" class="form-control @error('emp_bloodgroup') is-invalid @enderror" name="emp_bloodgroup" value="{{ $myprofile->emp_bloodgroup }}" required autocomplete="emp_bloodgroup" autofocus readonly>

                                @error('emp_bloodgroup')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_hm_telephone" class="col-md-4 col-form-label text-md-right">{{ __('Emergency Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="emp_hm_telephone" type="number" class="form-control @error('emp_hm_telephone') is-invalid @enderror" name="emp_hm_telephone" value="{{ $myprofile->emp_hm_telephone }}" required autocomplete="emp_hm_telephone" readonly>

                                @error('emp_hm_telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="relation_person" class="col-md-4 col-form-label text-md-right">{{ __('Relation with the Person') }}</label>

                            <div class="col-md-6">
                                <input id="relation_person" type="text" class="form-control @error('relation_person') is-invalid @enderror" name="relation_person" value="{{ $myprofile->emp_street1 }}" required autocomplete="relation_person" autofocus readonly>

                                @error('relation_person')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_aadhar_num" class="col-md-4 col-form-label text-md-right">{{ __('Adhaar Number') }}</label>

                            <div class="col-md-6">
                                <input id="emp_aadhar_num" type="text" class="form-control @error('emp_aadhar_num') is-invalid @enderror" name="emp_aadhar_num" value="{{ $myprofile->emp_aadhar_num }}" required autocomplete="emp_aadhar_num" autofocus readonly>

                                @error('emp_aadhar_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                              
                                <select  name="emp_gender" id="emp_gender" class="form-control @error('emp_gender') is-invalid @enderror" name="emp_gender" value="{{ $myprofile->emp_gender }}" required autocomplete="emp_gender" readonly>
                                <option value="{{ $myprofile->emp_gender }}">{{ $myprofile->emp_gender }}</option> 
                                                                                                 
                                <input id="emp_nick_name" type="text" class="form-control @error('emp_nick_name') is-invalid @enderror" name="emp_nick_name" value="{{ Auth::user()->name }}" required autocomplete="emp_nick_name" autofocus readonly>                    
                                 </select>
                                @error('emp_gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_marital_status" class="col-md-4 col-form-label text-md-right">{{ __('Maritial Status') }}</label>

                            <div class="col-md-6">
                            <select  name="emp_marital_status" id="emp_marital_status" class="form-control @error('emp_marital_status') is-invalid @enderror" name="emp_marital_status" value="{{ $myprofile->emp_marital_status }}" required autocomplete="emp_marital_status" readonly>
                            <option value="{{ $myprofile->emp_marital_status }}">{{ $myprofile->emp_marital_status }}</option>                                            
                                                     
                                                    </select>
                                @error('emp_marital_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="emp_religion_id" class="col-md-4 col-form-label text-md-right">{{ __('Religion') }}</label>

                            <div class="col-md-6">
                              
                                <select  name="emp_religion_id" id="emp_religion_id" class="form-control @error('emp_religion_id') is-invalid @enderror" name="emp_religion_id" value="{{ $myprofile->emp_religion_id }}" required autocomplete="emp_religion_id" readonly>
                                 
                                    @foreach($religion as $religions)
                                        <option value="{{$religions->emp_religion}}">{{$religions->reli_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('emp_religion_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_nationality_id" class="col-md-4 col-form-label text-md-right">{{ __('Nationality') }}</label>

                            <div class="col-md-6">
                             
                                <select  name="emp_nationality_id" id="emp_nationality_id" class="form-control @error('emp_nationality_id') is-invalid @enderror"  value="{{ $myprofile->emp_nationality_id }}" required autocomplete="emp_nationality_id" readonly>
                                 
                                    @foreach($nationality as $nationalitys)
                                        <option value="{{$nationalitys->emp_nationality}}">{{$nationalitys->nation_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('emp_nationality_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                       
                        
                        <div class="form-group row">
                            <label for="emp_language" class="col-md-4 col-form-label text-md-right">{{ __('Languages') }}</label>

                            <div class="col-md-6">

                                <select  name="emp_language" id="emp_language" class="form-control @error('language') is-invalid @enderror"  value="{{ $myprofile->emp_language }}" required autocomplete="emp_language" readonly>
                               
                                    @foreach($language as $languages)
                                        <option value="{{$languages->emp_lng_id}}">{{$languages->lang_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('emp_language')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_food_habit" class="col-md-4 col-form-label text-md-right">{{ __('Food Habit') }}</label>

                            <div class="col-md-6">

                                <select  name="emp_food_habit" id="emp_food_habit" class="form-control @error('emp_food_habit') is-invalid @enderror"   required autocomplete="emp_food_habit" readonly>
                                <option value="{{ $myprofile->emp_food_habit }}">{{ $myprofile->emp_food_habit }}</option>
                                                                                         
                                                     
                                 </select>
                                @error('emp_food_habit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                </div>
            </div>
        </div>
    </div>
</div>

<div id="Tokyo" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              
            <div class="card-header">{{ __('Employee Id') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">
                    
               
                <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Education</h2>
            </div>
            
            
        </div>
            <div class="table-responsive">
           
        
               
            <table id="myTable" class="table table-bordered table-striped {{ count($educationemployee) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th>Degree Type</th>
                        <th>Institute Name</th>
                        <th> Degree</th>
                        <th>Grade</th>
                        <th>Passing year</th>
                        
                        
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($educationemployee) > 0)
                        @foreach ($educationemployee as $education)
                        
                            <tr data-entry-id="{{ $education->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $education->name }}</td>
                                <td>{{ $education->ins_name }}</td>
                                <td>{{ $education->degree }}</td>
                                <td>{{ $education->grade }}</td>
                                <td>{{ $education->year }}</td>

                                
                            
                            </tr>
                        
                            @endforeach
                    @else
                        <tr>
                            <td colspan="7">No entries in table</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="Kolkata" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
            <div class="card-header">{{ __('Employee Id') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">
                   

                <div class="form-group row">
                            <label for="operational_company_id" class="col-md-4 col-form-label text-md-right">{{ __('Operational Company') }}</label>

                            <div class="col-md-6">
                             
                            <select  name="operational_company_id" id="operational_company_id" 
     class="form-control @error('operational_company_id') is-invalid @enderror" 
   name="operational_company_id" value="{{ $myprofile->operational_company_id }}" required autocomplete="operational_company_id" readonly>
                           
                            @foreach ($company as $companys)
                               
                            <option value="{{$companys->operational_company}}">{{$companys->company_name}}</option>
                                @endforeach                                            
                                                     
                             </select>
                                @error('operational_company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="operational_company_location_id" class="col-md-4 col-form-label text-md-right">{{ __('Operational Location') }}</label>

                            <div class="col-md-6">
                               
                            <select  name="operational_company_location_id" id="operational_company_location_id" class="form-control @error('operational_company_location_id') is-invalid @enderror"  value="{{ $myprofile->operational_company_location_id }}" required autocomplete="operational_company_location_id" readonly>
                            @foreach ($companylocation as $companylocations)
                               
                               <option value="{{$companylocations->operational_company_loc}}">{{$companylocations->location_name}}</option>
                                   @endforeach 
                                                                            
                                                     
                             </select>
                                @error('operational_company_location_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="operational_company_loc_dept_id" class="col-md-4 col-form-label text-md-right">{{ __('Operational  Department') }}</label>

                            <div class="col-md-6">   
                            <select  name="operational_company_loc_dept_id" id="operational_company_loc_dept_id" class="form-control @error('operational_company_loc_dept_id') is-invalid @enderror" value="{{ $myprofile->operational_company_loc_dept_id }}" required autocomplete="operational_company_loc_dept_id" readonly>
                            @foreach ($locationdepartment as $locationdepartments)
                               
                               <option value="{{$locationdepartments->operational_company_loc_dept}}">{{$locationdepartments->dept_name}}</option>
                                   @endforeach 
                                                                            
                                                     
                             </select>
                                @error('operational_company_loc_dept_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reporting_to" class="col-md-4 col-form-label text-md-right">{{ __('Reporting To') }}</label>

                            <div class="col-md-6">
                            @foreach($reporting as $reportings)
                               
                            <input id="reporting_to" type="text" class="form-control @error('reporting_to') is-invalid @enderror" name="reporting_to" value="{{ $reportings->user_name }}" required autocomplete="reporting_to" readonly>

                                @endforeach 
                              
                                @error('reporting_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shift" class="col-md-4 col-form-label text-md-right">{{ __('Shift') }}</label>

                            <div class="col-md-6">

                            <select  name="shift" id="shift" class="form-control @error('shift') is-invalid @enderror" name="shift" value="{{ $myprofile->shift }}" required autocomplete="shift" readonly>
                                
                                    @foreach($shift as $shifts)
                                        <option value="{{$shifts->shift_id}}">{{$shifts->work_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('shift')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="joined_date" class="col-md-4 col-form-label text-md-right">{{ __('Joining Date') }}</label>

                            <div class="col-md-6">
                                <input id="joined_date" type="date" class="form-control @error('joined_date') is-invalid @enderror" name="joined_date" value="{{ $myprofile->joined_date }}" required autocomplete="joined_date" readonly>

                                @error('joined_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_status" class="col-md-4 col-form-label text-md-right">{{ __('Employee Status') }}</label>

                            <div class="col-md-6">

                            <select  name="emp_status" id="emp_status" class="form-control @error('emp_status') is-invalid @enderror" name="emp_status" value="{{ $myprofile->emp_status }}" required autocomplete="emp_status" readonly>
                                
                            
                                    @foreach($type as $types)
                                        <option value="{{$types->emp_status_id}}">{{$types->emp_type_name_name}}</option>
                                    @endforeach 
                                                                                       
                                                     
                                 </select>
                                @error('emp_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="org_age" class="col-md-4 col-form-label text-md-right">{{ __('Organization Age') }}</label>

                            <div class="col-md-6">
                                <input id="org_age" type="date" class="form-control @error('org_age') is-invalid @enderror" name="org_age" value="{{ $myprofile->org_age }}" required autocomplete="org_age" readonly>

                                @error('org_age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="designation" class="col-md-4 col-form-label text-md-right">{{ __('Designation') }}</label>

                            <div class="col-md-6">
                             
                            <select  name="designation" id="designation" 
                    class="form-control @error('designation') is-invalid @enderror" 
                    value="{{ $myprofile->designation }}" required autocomplete="designation" readonly>
                           
                           @foreach($roles as $role)
                                        <option value="{{$role->designation_id}}">{{$role->role_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="job_role" class="col-md-4 col-form-label text-md-right">{{ __('Job Role') }}</label>

                            <div class="col-md-6">
                               
                            <select  name="job_role" id="job_role" class="form-control @error('job_role') is-invalid @enderror" name="job_role" value="{{ $myprofile->job_role }}" required autocomplete="job_role" readonly>
                           
                            @foreach($rolecategory as $rolecategorys)
                                        <option value="{{$rolecategorys->job_role_id}}">{{$rolecategorys->respname_name}}</option>
                                    @endforeach  
                                                                            
                                                     
                             </select>
                                @error('job_role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="Patna" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{ __('Employee Id') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">

                        <div class="form-group row">
                            <label for="committed_amount" class="col-md-4 col-form-label text-md-right">{{ __('Committed Amount') }}</label>

                            <div class="col-md-6">
                                <input id="committed_amount" type="text" class="form-control @error('committed_amount') is-invalid @enderror" name="committed_amount" value="{{ $myprofile->committed_amount }}" required autocomplete="committed_amount" autofocus readonly>
                                
                                @error('committed_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="ctc_per_month" class="col-md-4 col-form-label text-md-right">{{ __('CTC Per Month') }}</label>

                            <div class="col-md-6">
                                <input id="ctc_per_month" type="text" class="form-control @error('ctc_per_month') is-invalid @enderror" name="ctc_per_month" value="{{ $myprofile->ctc_per_month }}" required autocomplete="ctc_per_month" autofocus readonly>

                                @error('ctc_per_month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="esi_number" class="col-md-4 col-form-label text-md-right">{{ __('ESI Number') }}</label>

                            <div class="col-md-6">
                                <input id="esi_number" type="text" class="form-control @error('esi_number') is-invalid @enderror" name="esi_number" value="{{ $myprofile->esi_number }}" required autocomplete="esi_number" autofocus readonly>

                                @error('esi_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pf_uan_no" class="col-md-4 col-form-label text-md-right">{{ __('Pf UAN Number') }}</label>

                            <div class="col-md-6">
                                <input id="pf_uan_no" type="text" class="form-control @error('pf_uan_no') is-invalid @enderror" name="pf_uan_no" value="{{ $myprofile->pf_uan_no }}" required autocomplete="pf_uan_no" readonly>

                                @error('pf_uan_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pf_no" class="col-md-4 col-form-label text-md-right">{{ __('PF Number') }}</label>

                            <div class="col-md-6">
                                <input id="pf_no" type="text" class="form-control @error('pf_no') is-invalid @enderror" name="pf_no" value="{{ $myprofile->pf_no }}" required autocomplete="pf_no" readonly>

                                @error('pf_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ctc_per_annum" class="col-md-4 col-form-label text-md-right">{{ __('CTC Per Annum') }}</label>

                            <div class="col-md-6">
                                <input id="ctc_per_annum" type="text" class="form-control @error('ctc_per_annum') is-invalid @enderror" name="ctc_per_annum" value="{{ $myprofile->ctc_per_annum }}" required autocomplete="ctc_per_annum" readonly>

                                @error('ctc_per_annum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payroll_org" class="col-md-4 col-form-label text-md-right">{{ __('Pyaroll Organization') }}</label>

                            <div class="col-md-6">
                                <input id="payroll_org" type="text" class="form-control @error('payroll_org') is-invalid @enderror" name="payroll_org" value="{{ $myprofile->payroll_org }}" required autocomplete="payroll_org" readonly>

                                @error('payroll_org')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pf_effective_date" class="col-md-4 col-form-label text-md-right">{{ __('Pf Effective Date') }}</label>

                            <div class="col-md-6">
                                <input id="pf_effective_date" type="date" class="form-control @error('pf_effective_date') is-invalid @enderror" name="pf_effective_date" value="{{ $myprofile->pf_effective_date }}" required autocomplete="pf_effective_date" readonly>

                                @error('pf_effective_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                 </div>
            </div>
        </div>
    </div>
</div>
<div id="Durgapur" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{ __('Employee Id') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">

             
                        
                <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Skills</h2>
            </div>
            
           
        </div>
            <div class="table-responsive">
           
        
               
            <table id="myTable" class="table table-bordered table-striped {{ count($skillemployee) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th>Employee Skill</th>
                        <th>Skill Grade</th>

                        
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($skillemployee) > 0)
                        @foreach ($skillemployee as $education)
                        
                            <tr data-entry-id="{{ $education->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $education->name }}</td>
                                <td>{{ $education->skill_grade }}</td>
                                

                                
                             
                            </tr>
                        
                            @endforeach
                    @else
                        <tr>
                            <td colspan="7">No entries in table</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="Berlin" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{ __('Employee Id') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">
                   

                        <div class="form-group row">
                            <label for="acnt_holder_name" class="col-md-4 col-form-label text-md-right">{{ __('Account Holder Name') }}</label>

                            <div class="col-md-6">
                                <input id="acnt_holder_name" type="text" class="form-control @error('acnt_holder_name') is-invalid @enderror" name="acnt_holder_name" value="{{ $myprofile->acnt_holder_name }}" required autocomplete="acnt_holder_name" autofocus readonly>

                                @error('acnt_holder_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>

                            <div class="col-md-6">
                                <input id="bank_name" type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" value="{{ $myprofile->bank_name }}" required autocomplete="bank_name" readonly>

                                @error('bank_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="branch_name" class="col-md-4 col-form-label text-md-right">{{ __('Branch Name') }}</label>

                            <div class="col-md-6">
                                <input id="branch_name" type="text" class="form-control @error('branch_name') is-invalid @enderror" name="branch_name" value="{{ $myprofile->branch_name }}" required autocomplete="branch_name" readonly>

                                @error('branch_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>

                            <div class="col-md-6">
                                <input id="account_number" type="number" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ $myprofile->account_number }}" required autocomplete="account_number" readonly>

                                @error('account_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="neft_code" class="col-md-4 col-form-label text-md-right">{{ __('Neft Code') }}</label>

                            <div class="col-md-6">
                                <input id="neft_code" type="text" class="form-control @error('neft_code') is-invalid @enderror" name="neft_code" value="{{ $myprofile->neft_code }}" required autocomplete="neft_code" readonly>

                                @error('neft_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ifsc_code" class="col-md-4 col-form-label text-md-right">{{ __('Ifsc Code') }}</label>

                            <div class="col-md-6">
                                <input id="ifsc_code" type="text" class="form-control @error('ifsc_code') is-invalid @enderror" name="ifsc_code" value="{{ $myprofile->ifsc_code }}" required autocomplete="ifsc_code" readonly>

                                @error('ifsc_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

             </div>
            </div>
        </div>
    </div>
</div>  
<div id="Amritsar" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
            <div class="card-header">{{ __('Employee Id') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">
                   

                <div class="form-group row">
                            <label for="promotion_date" class="col-md-4 col-form-label text-md-right">{{ __('Promotion Date') }}</label>

                            <div class="col-md-6">
                                <input id="promotion_date" type="date" class="form-control @error('promotion_date') is-invalid @enderror" name="promotion_date" value="{{ $myprofile->promotion_date }}" required autocomplete="promotion_date" autofocus readonly>

                                @error('promotion_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="effective_from" class="col-md-4 col-form-label text-md-right">{{ __('Effective From') }}</label>

                            <div class="col-md-6">
                                <input id="effective_from" type="date" class="form-control @error('effective_from') is-invalid @enderror" name="effective_from" value="{{ $myprofile->effective_from }}" required autocomplete="effective_from" autofocus readonly>

                                @error('effective_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_designation" class="col-md-4 col-form-label text-md-right">{{ __('Last Designation') }}</label>

                            <div class="col-md-6">
                                <input id="last_designation" type="text" class="form-control @error('last_designation') is-invalid @enderror" name="last_designation" value="{{ $myprofile->last_designation }}" required autocomplete="last_designation" autofocus readonly>

                                @error('last_designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_salary" class="col-md-4 col-form-label text-md-right">{{ __('Last Salary') }}</label>

                            <div class="col-md-6">
                                <input id="last_salary" type="text" class="form-control @error('last_salary') is-invalid @enderror" name="last_salary" value="{{ $myprofile->last_salary }}" required autocomplete="last_salary" autofocus readonly>

                                @error('last_salary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                       
                </div>
            </div>
        </div>
    </div>
</div>  
<div id="Dhaka" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{ __('Employee Id') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">

             
                        
                <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>My Leave</h2>
            </div>
            
           
        </div>
            <div class="table-responsive">
           
        
               
            <table id="myTable" class="table table-bordered table-striped {{ count($allleave) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th>Leave type</th>
                        <th>Date from</th>
                        <th>Date to</th>
                        <th>No. of days</th>
                        <th>Total Days</th>
                        <th>Remaining</th>
                        <th>Reason</th>
                       

                        
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($allleave) > 0)
                        @foreach ($allleave as $allleaves)
                        
                            <tr data-entry-id="{{ $allleaves->id }}">
                                <!-- <td></td> -->
                                
                               
                                <td>{{$allleaves->name}}</td>
                                <td>{{$allleaves->date_from}}</td>
                                <td>{{$allleaves->date_to}}</td>
                                <td>{{$allleaves->days}}</td>
                                <td>{{$allleaves->no_of_days}}</td>
                                <td>{{ $allleaves->no_of_days - $allleaves->days }}</td>
                                <td>{{$allleaves->reason}}</td>
                                

                                
                             
                            </tr>
                        
                            @endforeach
                    @else
                        <tr>
                            <td colspan="7">No entries in table</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="Delhi" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              
            <div class="card-header">{{ __('Employee Id') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">
                  
                <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Assets</h2>
            </div>
           
            
        </div>
            <div class="table-responsive">
           
        
               
            <table id="myTable" class="table table-bordered table-striped {{ count($assets) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th> Property Name</th>
                        <th>Property Details</th>
                        <th> Giving Date</th>
                        <th>Return Date</th>
                        <th>Return property Condition</th>
                        
                     
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($assets) > 0)
                        @foreach ($assets as $employee)
                        
                            <tr data-entry-id="{{ $employee->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $employee->assets_name }}</td>
                                <td>{{ $employee->assets_details }}</td>
                                <td>{{ $employee->giving_date }}</td>
                                <td>{{ $employee->return_date }}</td>
                                <td>{{ $employee->return_property_conditions }}</td>

                                
                            
                            </tr>
                        
                            @endforeach
                    @else
                        <tr>
                            <td colspan="7">No entries in table</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
                  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@include('footerimport')
@endsection
<script>
             $(document).ready(function() { 
$(".selectpicker").select2({
    tags: true,
    tokenSeparators: [',', ' ']   

})
});
    </script>
    <script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="designation"]').on('change',function(){
               var desigID = jQuery(this).val();
               if(desigID)
               {
                  jQuery.ajax({
                     url : 'add-employee/getrole/' +desigID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="job_role"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="job_role"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="job_role"]').empty();
               }
            });
    });
    </script>
<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="operational_company_id"]').on('change',function(){
               var countryID = jQuery(this).val();
               if(countryID)
               {
                  jQuery.ajax({
                     url : 'add-employee/getlocation/' +countryID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="operational_company_location_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="operational_company_location_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="operational_company_location_id"]').empty();
               }
            });
    });
    </script>

<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="operational_company_location_id"]').on('change',function(){
               var deptID = jQuery(this).val();
               if(deptID)
               {
                  jQuery.ajax({
                     url : 'getlocation/getunit/' +deptID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="operational_company_loc_dept_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="operational_company_loc_dept_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="operational_company_loc_dept_id"]').empty();
               }
            });
    });
    </script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').selectpicker();
    });
</script>
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #066fcc;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}


/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
.tight-gutter {
        padding: 0 2px;
    }

</style>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

