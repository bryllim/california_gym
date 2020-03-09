@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('members') }}"><i class="material-icons">group</i> Members</a></li>
            <li class="active">Edit</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
            <strong>Edit | {{ $member->firstname }} {{ $member->lastname }}</strong>
            </div>
            <div class="body">
            <form method="POST" action="{{ route('member-update') }}">
                @csrf
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="First Name" name="firstname" value="{{ $member->firstname }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Last Name" name="lastname" value="{{ $member->lastname }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Address" name="address" value="{{ $member->address }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control" placeholder="Contact Number" name="contact" value="{{ $member->contact }}" required>
                                </div>
                            </div>
                        </div>
                    </div>                
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="sex">Sex: &nbsp;</label>
                                <select class="selectpicker" id="sex" name="sex" required>
                                    @if($member->sex == "Male")
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                    @else
                                    <option value="Male">Male</option>
                                    <option value="Female" selected>Female</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="type">Membership Type: &nbsp;</label>
                                <select class="selectpicker" id="type" name="type" required>
                                    @if($member->type == "Regular")
                                    <option value="Regular" selected>Regular</option>
                                    <option value="Student">Student</option>
                                    @else
                                    <option value="Regular">Regular</option>
                                    <option value="Student" selected>Student</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm-12">
                        <input type="hidden" name="member_id" value="{{ $member->id }}">
                        <button type="submit" class="btn btn-block btn-lg btn-danger waves-effect"><b>Update</b></button>
                        </div>
                    </div>        
                </form>
            </div>
        </div>
    </div>
</div>
@endsection