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
</div>
@endsection