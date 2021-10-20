@extends('Backend.master')
@section('bill')
    active
@endsection
@section('title')
    {{ "All Bill" }}
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('allBill') }}">Billing</a>
          <span class="breadcrumb-item active">All Bill</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-xl-6">
                {{-- search form --}}
                <form action="{{ route('billSearch') }}" method="GET">
                    @csrf
                    <input type="date" name="start" value="{{ $start??'' }}" id="start" placeholder="from">
                    <input type="date" name="end" id="end" value="{{ $end??'' }}" placeholder="to">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            </div>
            <div class="col-xl-6">
                {{-- download form --}}
                <form action="{{ route('billDownload') }}" method="GET" class="text-right">
                    @csrf
                    <input type="date" name="start" value="{{ $start??'' }}" id="start" placeholder="from">
                    <input type="date" name="end" id="end" value="{{ $end??'' }}" placeholder="to">
                    <button class="btn btn-primary" name="execl" value="download_execl" type="submit">Download Execl</button>
                    <button class="btn btn-primary" name="pdf" value="download_pdf" type="submit">Download Pdf</button>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-12">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Bill ({{ $billingCount??$orderSearchCount }})</h6>
                    <div class="bd bd-gray-300 rounded table-responsive">
                      <table class="table mg-b-0">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Full Name</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Pay Type</th>
                            <th>Total Bill</th>
                            <th>Diff. Shipping</th>
                            <th>View</th>
                          </tr>
                        </thead>
                            @isset($orderSearch)
                            <tbody>
                            @foreach($orderSearch as $key => $order)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $order->full_name }}</td>
                                <td>{{ $order->country->name }}</td>
                                <td>{{ $order->state->name }}</td>
                                <td>{{ $order->city->name }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->pay_type }}</td>
                                <td>{{ $order->total_amount }}</td>
                                <td>
                                    @if($order->different_shipping==1)
                                        {{ "No" }}
                                    @else
                                        {{ "Yes" }}    
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('orderByBill',$order->id) }}" class="btn-outline-info"><i class="fa fa-eye"></i></a>
                                    @if($order->different_shipping==2)
                                    <a style="padding: 10px" href="{{ route('shipping',$order->id) }}" class="btn-outline-primary"><i class="fa fa-truck" aria-hidden="true"></i></a>
                                    @endif
                                </td>
                              </tr>  
                            @endforeach
                            </tbody>
                            @else
                            <tbody>
                                @foreach($billings as $key => $billing)                        
                                <tr>
                                  <td>{{ $billings->firstItem() + $key }}</td>
                                  <td>{{ $billing->full_name }}</td>
                                  <td>{{ $billing->country->name }}</td>
                                  <td>{{ $billing->state->name }}</td>
                                  <td>{{ $billing->city->name }}</td>
                                  <td>{{ $billing->address }}</td>
                                  <td>{{ $billing->phone }}</td>
                                  <td>{{ $billing->pay_type }}</td>
                                  <td>{{ $billing->total_amount }}</td>
                                  <td>
                                      @if($billing->different_shipping==1)
                                          {{ "No" }}
                                      @else
                                          {{ "Yes" }}    
                                      @endif
                                  </td>
                                  <td>
                                      <a href="{{ route('orderByBill',$billing->id) }}" class="btn-outline-info"><i class="fa fa-eye"></i></a>
                                      @if($billing->different_shipping==2)
                                      <a style="padding: 10px" href="{{ route('shipping',$billing->id) }}" class="btn-outline-primary"><i class="fa fa-truck" aria-hidden="true"></i></a>
                                      @endif
                                  </td>
                                </tr>
                                @endforeach
                            </tbody>
                            {{ $billings->links() }}
                            @endisset
                      </table>
                    </div><!-- bd -->
                </div>
            </div>
        </div>
    </div>
    <footer class="br-footer">
        <div class="footer-left">
          <div class="mg-b-2">Copyright © 2017. Bracket. All Rights Reserved.</div>
          <div>Attentively and carefully made by Imtiaz Sattar Sohel</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Share:</span>
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/bracket/intro"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Bracket,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/bracket/intro"><i class="fa fa-twitter tx-20"></i></a>
        </div>
    </footer>   
</div>    
@endsection