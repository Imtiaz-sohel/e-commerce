@extends('Backend.master')
@section('contact')
    active
@endsection
@section('title')
    Contact
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('contact') }}">Contact</a>
          <span class="breadcrumb-item active">All Contact</span>
        </nav>
    </div>
    <div class="br-pagebody">
       <div class="br-section-wrapper">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Message ({{ $contactCount }})</h6>
            <div class="bd bd-gray-300 rounded table-responsive">
              <table class="table mg-b-0">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $key => $contact)                        
                    <tr>
                      <td>{{ $contacts->firstItem()+$key }}</td>
                      <td>{{ $contact->name }}</td>
                      <td>{{ $contact->email }}</td>
                      <td>{{ $contact->subject }}</td>
                      <td>{{ Str::limit($contact->message,'100') }}</td>
                      <td>
                          <a href="{{ route('contactDelete',$contact->id) }}" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div><!-- bd -->
        </div>
    </div>
    <footer class="br-footer">
        <div class="footer-left">
          <div class="mg-b-2">Copyright © 2017. Bracket. All Rights Reserved.</div>
          <div>Attentively and carefully made by ThemePixels.</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Share:</span>
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/bracket/intro"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Bracket,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/bracket/intro"><i class="fa fa-twitter tx-20"></i></a>
        </div>
    </footer>
</div>
@endsection