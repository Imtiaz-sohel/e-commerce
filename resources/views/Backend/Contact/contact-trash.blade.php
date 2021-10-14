@extends('Backend.master')
@section('contact')
    active
@endsection
@section('title')
    {{ 'Contact Trash' }}
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('contact') }}">Contact</a>
          <span class="breadcrumb-item active">All Contact Trash</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="br-section-wrapper">
             <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Trash Message ({{ $tContactCount }})</h6>
             <div class="bd bd-gray-300 rounded table-responsive">
               <table class="table mg-b-0">
                 <thead>
                   <tr>
                     <th>SL</th>
                     <th>Name</th>
                     <th>Subject</th>
                     <th>Action</th>
                   </tr>
                 </thead>
                 <tbody>
                     @foreach($tContacts as $key => $tContact)                         
                     <tr>
                         <td>{{ $tContacts->firstItem()+$key }}</td>
                         <td>{{ $tContact->name }}</td>
                         <td>{{ $tContact->subject }}</td>
                         <td>
                             <a class="btn btn-outline-success" href="{{ route('contactRestore',$tContact->id) }}">Restore</a>
                             <a class="btn btn-outline-danger" href="{{ route('contactPerDelete',$tContact->id) }}">Delete Forever</a>
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