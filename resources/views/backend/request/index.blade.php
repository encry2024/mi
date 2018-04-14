@extends('backend.layouts.app')

@section('title', app_name() . ' | Request Record'))

@section('breadcrumb-links')
    @include('backend.request.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Request Record
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Pulled Out By</th>
                            <th>Item Name</th>
                            <th>Item Size</th>
                            <th>Requested Quantity</th>
                            <th>Requested By</th>
                            <th>Date Requested</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($requests))
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>{{ $request->user->full_name }}</td>
                                        <td>{{ ucfirst($request->inventory->name) }}</td>
                                        <td>{{ ucfirst($request->inventory->size_quantity) }} {{ ucfirst($request->inventory->size->type) }}</td>
                                        <td>{{ $request->quantity }}</td>
                                        <td>{{ ucfirst($request->requested_by) }}</td>
                                        <td>{{ date('F d, Y', strtotime($request->date_requested)) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5"><p class="text-center">No body has made a Request</p></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $requests->total() !!} {{ trans_choice('labels.backend.requests.table.total', $requests->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $requests->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
