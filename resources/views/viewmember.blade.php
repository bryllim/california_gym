@extends('layouts.app')

@section('content')
<style>
.html2canvas-container { width: 1250px !important; height: 3000px !important; }
</style>
<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('members') }}"><i class="material-icons">group</i> Members</a></li>
            <li class="active">{{ $member->firstname }} {{ $member->lastname }}</li>
        </ol>
    </div>
</div>
@if($member->status == "Expired")
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger text-center">
            <strong>Important!</strong> This member's membership validity has expired.
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-5">
        <div class="card profile-card" id="membercard">
            <div class="profile-body bg-red">
                <div class="content-area">
                    <br>
                    <h3 style="margin-top:-2px">{{ $member->firstname }} {{ $member->lastname }}</h3>
                </div>
                <a href="javascript:void(0);" class="thumbnail">
                    <img src="{{url('/images/members/'.$member->image)}}" class="img-responsive" style="max-height:300px">
                </a>
            </div>
            <p class="text-center"> Valid until <b>{{ date('F j, Y', strtotime($member->validity)) }}</b></p>
            <div class="profile-footer">
                <ul>
                    <li>
                        <span>Contact Number</span>
                        <span>{{ $member->contact }}</span>
                    </li>
                    <li>
                        <span>Sex</span>
                        <span>{{ $member->sex }}</span>
                    </li>
                    <li>
                        <span>Address</span>
                        <span>{{ $member->address }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card card-about-me">
            <div class="body">
                <ul>
                    <li>
                        <div>
                            Actions: <a href="{{ url('renew') }}/{{ $member->id }}"><b>RENEW</b></a> | <a href="{{ url('edit') }}/{{ $member->id }}"><b>EDIT</b> | <a href="javascript:generateID();" ><b>GENERATE ID</b></a>
                        </div>
                    </li>
                    <li>
                        <div class="title">
                            <i class="material-icons">history</i>
                            History
                        </div>
                        <div class="content" style="color:black">
                        @foreach($transactions as $transaction)
                            <div class="font-12 well" style="border-radius: 5px; padding-left:10px; padding-top:10px; padding-bottom:2px; padding-right:10px; margin-bottom:3px">
                                <p><span class="text-muted" style="float:right"><small><i class="material-icons font-12">access_time</i> {{ date('F j, Y', strtotime($transaction->created_at)) }}</small></span></p>
                                <p style="margin-top: -5px">{{ $transaction->quantity }}x {{ $transaction->name }} - ₱{{ number_format($transaction->price, 2, '.', ',') }}</p>
                            </div>
                        @endforeach
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('/').'/js/html2canvas.js' }}"></script>
<script>
function generateID(){
    var membercard = document.getElementById('membercard');
    html2canvas(membercard).then(function(canvas) {
        var myImage = canvas.toDataURL();
        downloadURI(myImage, "{{ $member->firstname }}_{{ $member->lastname }}");
    });
}

function downloadURI(uri, name) {
    var link = document.createElement("a");

    link.download = name;
    link.href = uri;
    document.body.appendChild(link);
    link.click();
}
</script>
@endsection