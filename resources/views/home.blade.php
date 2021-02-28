@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [

    'This page',
]])

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
   
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
  
                    @can('isSuperAdmin')
                        <div class="btn btn-success btn-lg">
                          You have Super Admin Access
                        </div>
                    @elsecan('isAdmin')
                        <div class="btn btn-primary btn-lg">
                          You have Admin Access
                        </div>
                    @elsecan('isClusterHead')
                        <div class="btn btn-primary btn-lg">
                          You have Cluster Head Access
                        </div>
                    @elsecan('isECRM')
                        <div class="btn btn-primary btn-lg">
                          You have ECRM Access
                        </div>
                    @elsecan('isBDM')
                        <div class="btn btn-primary btn-lg">
                          You have BDM Access
                        </div>
                    @elsecan('isTeamLeader')
                        <div class="btn btn-primary btn-lg">
                          You have Team Leader Access
                        </div>    
                    @else
                        <div class="btn btn-info btn-lg">
                          You have ACW Access
                        </div>
                    @endcan
  
                </div>
            </div>
        </div>
    </div>
</div>
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$company}}</h3>

                <p>All Company</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('view-company') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <h3>{{$emp}}</h3>

                <p>View Employees</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('view-employee') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$user}}</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('view-user') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ Auth::user()->name }}</h3>

                <p>My Profile</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('add-info-tab') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          
          
</section>

@include('footerimport')
@endsection
