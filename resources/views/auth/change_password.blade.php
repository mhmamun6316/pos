@extends('layouts.admin_master')

@section('css')

<style>
    .addButton{
        float: right;
    }
    .errorColor{
        color: red;
    }
</style>

@endsection

@section('main_content')


<div class="card">
    <div class="card-header border-bottom">
      <h4 class="card-title">Change Password</h4>
    </div>
    <div class="card-body pt-1">
      <!-- form -->
      <form class="validate-form" action="{{ route('password.update') }}" method="POST" enctype="multipart/form-data" novalidate="novalidate">
        @csrf
        <div class="row">
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="account-old-password">Current password</label>
            <div class="input-group form-password-toggle input-group-merge">
              <input type="password" class="form-control" id="account-old-password" name="old_password" placeholder="Enter current password" data-msg="Please current password">
              <div class="input-group-text cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
              </div>
            </div>
            @if(Session::has('fail'))
                <span class="text-danger">{{ Session::get('fail') }}</span>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="account-new-password">New Password</label>
            <div class="input-group form-password-toggle input-group-merge">
              <input type="password" id="account-new-password" name="password" class="form-control" placeholder="Enter new password">
              <div class="input-group-text cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
              </div>
            </div>
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="account-retype-new-password">Retype New Password</label>
            <div class="input-group form-password-toggle input-group-merge">
              <input type="password" class="form-control" id="account-retype-new-password" name="password_confirmation" placeholder="Confirm your new password">
              <div class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></div>
            </div>
          </div>
          <div class="col-12">
            <p class="fw-bolder">Password requirements:</p>
            <ul class="ps-1 ms-25">
              <li class="mb-50">Minimum 8 characters long - the more, the better</li>
            </ul>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary me-1 mt-1 waves-effect waves-float waves-light">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary mt-1 waves-effect">Discard</button>
          </div>
        </div>
      </form>
      <!--/ form -->
    </div>
  </div>

@endsection
