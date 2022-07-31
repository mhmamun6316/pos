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
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
@endsection

@section('main_content')

 <div class="card">
    <div class="card-header border-bottom">
      <h4 class="card-title">Profile Details</h4>
    </div>
    <div class="card-body py-2 my-25">
      <!-- header section -->
      <div class="d-flex">
        <a href="#" class="me-25">
          <img src="{{ (!empty(Auth::user()->photo))?url(Auth::user()->photo):url('uploads/aavatar-1.jpg') }}" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100">
        </a>
        <!-- upload and reset button -->
        <div class="d-flex align-items-end mt-75 ms-1">
          <div>
            <a href="{{ route('password.change') }}" for="account-upload" class="btn  btn-primary me-75 waves-effect waves-float waves-light">Change Password</a>
          </div>
        </div>
        {{-- <!--/ upload and reset button --> --}}
      </div>
      <!--/ header section -->

      <!-- form -->
      <form class="validate-form mt-2 pt-50" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" novalidate="novalidate">
        @csrf
        <div class="row">
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="accountFirstName">Name</label>
            <input type="text" class="form-control" id="accountFirstName" name="name" placeholder="Please enter first name" value="{{ Auth::user()->name }}" data-msg="Please enter first name">
          </div>
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="accountEmail">Email</label>
            <input type="email" class="form-control" id="accountEmail" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="accountOrganization">Phone</label>
            <input type="text" class="form-control" id="accountOrganization" name="phone" placeholder="Organization name" value="{{ Auth::user()->phone }}">
          </div>
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="accountPhoneNumber">Address</label>
            <input type="text" class="form-control account-number-mask" id="accountPhoneNumber" name="address" placeholder="Phone Number" value="{{ Auth::user()->address }}">
          </div>
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="accountAddress">Nid</label>
            <input type="text" class="form-control" placeholder="NID" name="nid" value="{{ Auth::user()->nid }}">
          </div>
          <div class="col-12 col-sm-6 mb-1">
            <label class="form-label" for="accountState">Date of Birth</label>
            <input type="date" class="form-control" id="accountState" name="dob" value="{{ Auth::user()->dob }}">
          </div>
          <div class="col-12 col-sm-6 mb-1">
                <label>Gender:&nbsp;&nbsp;</label><br>
                <div class="form-check form-check-inline" style="float: left;margin-right:40px">
                    <input class="gender form-check-input" type="radio"
                        name="gender" id="inlineRadio1" value="male" {{ ( Auth::user()->gender=="male")? "checked" : "" }}>
                    <label class="form-check-label" for="inlineRadio1">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="gender form-check-input" type="radio"
                        name="gender" id="inlineRadio2" value="female" {{ ( Auth::user()->gender=="female")? "checked" : "" }}>
                    <label class="form-check-label"
                        for="inlineRadio2">Female</label>
                </div>
          </div>
          <div class="col-12 col-sm-6 mb-1">
            <div class="mb-4">
                <label class="form-label" for="basic-icon-default-salary">Image</label>
                <input type="file" id="image" name="image" class="form-control dt-salary">
            </div>

            <div class="mb-1">
                <img src="{{ (!empty(Auth::user()->photo))?url(Auth::user()->photo):url('uploads/avatar-1.jpg') }}" id="preview_img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100">
            </div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary mt-1 me-1 waves-effect waves-float waves-light">Update</button>
            <button type="reset" class="btn btn-outline-secondary mt-1 waves-effect">Clear</button>
          </div>
        </div>
      </form>
      <!--/ form -->
    </div>
  </div>

  @endsection

@section('script')
<script>

       //code for preview image on edit
       $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
       });

</script>

@endsection
