@extends('frontend.layouts.master')

@section('title', app_name() . ' | Edit Profile')

@section('content')
    <div class="row main-page-container" style="">
        <div class="col-md-12">
            @include("frontend.account.sidebar")

            <div class="col-md-8">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"
                            data-toggle="collapse"
                            data-target="#collapseTwo">
                            Edit Profile
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in show">
                        <div class="panel-body">
                            {{ Form::open(['method' => 'POST','id'=> 'pricerange', 'class' => 'form-horizontal','url' => route('frontend.account.save-edit-profile')]) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{ Form::label('first_name', 'First Name', ['class' => 'col-lg-2 control-label required']) }}

                                            <div class="col-lg-10">
                                                {{ Form::text('first_name', $userData->first_name, ['class' => 'form-control', 'id' => 'edit_profile_first_name', 'placeholder' => 'First Name', 'required' => 'required']) }}
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->
                                        <div class="form-group">
                                            {{ Form::label('last_name', 'Last Name', ['class' => 'col-lg-2 control-label required']) }}

                                            <div class="col-lg-10">
                                                {{ Form::text('last_name', $userData->last_name, ['class' => 'form-control', 'id' => 'edit_profile_last_name', 'placeholder' => 'Last Name', 'required' => 'required']) }}
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->
                                        <div class="form-group">
                                            {{ Form::label('email', 'Email', ['class' => 'col-lg-2 control-label required']) }}

                                            <div class="col-lg-10">
                                                {{ Form::text('email', $userData->email, ['readonly' => 'readonly', 'class' => 'form-control', 'id' => 'edit_profile_email', 'placeholder' => 'email', 'required' => 'required']) }}
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->
                                        <div class="form-group">
                                            <div class="col-lg-10 col-md-offset-2">
                                                <input type="submit" class="btn btn-primary btn-lg" value="Save">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"
                            data-toggle="collapse"
                            data-target="#collapseTwo">
                            My Addresses
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in show">
                        <div class="panel-body">
                            @if(!$addresses->isEmpty())
                                @foreach($addresses as $single)
                                    <div address-id="{{ $single->id }}" class="row address-container">
                                        <div class="col-md-12 text-right">
                                            <a address-id="{{ $single->id }}" href="javascript:void(0);" class="btn btn-primary edit-address">Edit</a>
                                            <a address-id="{{ $single->id }}" href="javascript:void(0);" class="btn btn-danger delete-address">Delete</a>
                                        </div>
                                        <div class="col-md-12">
                                            <b>Type: </b> {{ ucfirst($single->type) }}
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <dl class="dl-horizontal">
                                                    <dt>First Name</dt>
                                                    <dd>{{ $single->first_name }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-6">
                                                <dl class="dl-horizontal">
                                                    <dt>Last Name</dt>
                                                    <dd>{{ $single->last_name }}</dd>
                                                </dl>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <dl class="dl-horizontal">
                                                    <dt>Email</dt>
                                                    <dd>{{ $single->email }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-6">
                                                <dl class="dl-horizontal">
                                                    <dt>Phone Number</dt>
                                                    <dd>{{ $single->phone }}</dd>
                                                </dl>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <dl class="dl-horizontal">
                                                    <dt>Address</dt>
                                                    <dd>{{ $single->address }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-6">
                                                <dl class="dl-horizontal">
                                                    <dt>Street</dt>
                                                    <dd>{{ $single->street }}</dd>
                                                </dl>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <dl class="dl-horizontal">
                                                    <dt>City</dt>
                                                    <dd>{{ $single->city. ', '. $single->postal_code }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-6">
                                                <dl class="dl-horizontal">
                                                    <dt>State</dt>
                                                    <dd>{{ $single->state }}</dd>
                                                </dl>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <hr/>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                No Addresses found.
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- row -->

    <div class="modal" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="editAddressModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['method' => 'POST','id'=> 'editAddress', 'class' => 'form-horizontal','url' => route('frontend.account.save-edit-address')]) }}
                <div class="modal-body">
                    <div class="col-md-12">
                        <input name="id" type="hidden" value="" id="address_id">
                        <div class="form-group">
                            <label for="first_name" class="col-form-label">First Name</label>
                            <input name="first_name" required type="text" class="form-control" id="first_name">
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-form-label">Last Name</label>
                            <input name="last_name" required type="text" class="form-control" id="last_name">
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email</label>
                            <input name="email" required type="text" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-form-label">Phone Number</label>
                            <input name="phone" required type="text" class="form-control" id="phone">
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-form-label">Address</label>
                            <input name="address" required type="text" class="form-control" id="address">
                        </div>
                        <div class="form-group">
                            <label for="street" class="col-form-label">Street</label>
                            <input name="street" required type="text" class="form-control" id="street">
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-form-label">City</label>
                            <input name="city" required type="text" class="form-control" id="city">
                        </div>
                        <div class="form-group">
                            <label for="postal_code" class="col-form-label">Postal Code</label>
                            <input name="postal_code" required type="text" class="form-control" id="postal_code">
                        </div>
                        <div class="form-group">
                            <label for="state" class="col-form-label">State</label>
                            <select name="state" required type="text" class="form-control" id="state">
                                <option value="">Choose...</option>
                                <option value="AK">Alaska</option>
                                <option value="AL">Alabama</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="DC">Washington D.C.</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-address-save">Save</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
<script>
    $(document).ready(function () {
        $(".edit-address").on("click", function (e) {
            var addressId = $(this).attr('address-id');
            e.preventDefault();
            $.ajax({
                url: "<?php echo URL('/').'/account/edit-address/'; ?>" + addressId,
                type: 'GET',
                success: function(data) {
                    $("#address_id").val(data.id);
                    $("#first_name").val(data.first_name);
                    $("#last_name").val(data.last_name);
                    $("#email").val(data.email);
                    $("#phone").val(data.phone);
                    $("#address").val(data.address);
                    $("#street").val(data.street);
                    $("#city").val(data.city);
                    $("#state").val(data.state);
                    $("#postal_code").val(data.postal_code);


                    $("#editAddressModal").modal('show');
                },
                error: function () {
                    alert("Error in deleting Address.");
                }
            });
        });
        
        $(".delete-address").on("click", function (e) {
            var addressId = $(this).attr('address-id');
            e.preventDefault();
            $.ajax({
                url: "<?php echo URL('/').'/account/delete-address/'; ?>" + addressId,
                type: 'GET',
                success: function(data) {
                    if(data.success == true)
                    {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $(this).closest('.address-container').remove();
                    }
                    else
                    {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                error: function () {
                    alert("Error in deleting Address.");
                }
            });
        });
        
        /*$("#editAddress").submit(function (e) {
            e.preventDefault();
            $.ajax({
                url:      $("#editAddress").attr('action'),
                type:     $("#editAddress").attr('method'),
                data:     $("#editAddress").serialize(),
                success: function(data) {
                    
                    if(data.success)
                    {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function () {
                            window.location.reload(true);
                        });
                    }
                    else
                    {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                error: function () {
                    alert("Error in Validating Address");
                }
            });
        })*/
    })
</script>
@endsection