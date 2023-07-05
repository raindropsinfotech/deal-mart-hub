@extends('layouts.admin-app')

@section('page-header', 'Dashboard')
@section('page-title-header', 'Dashboard')

@section('page-breadcrumbs')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-3 col-md-3 col-3 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title text-center">
          <i class="fa-solid fa-users fa-2xl"></i>
          <span class="d-block fw-semibold">Total Users</span>
        </div>
            <h4 class="card-title mb-1 text-center">15</h4>
          </div>
        </div>
  </div>
@endsection