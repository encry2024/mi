@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('strings.backend.dashboard.welcome') }} {{ $logged_in_user->name }}!</strong>
                </div><!--card-header-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">
                        Users Activities
                    </h4>
                    <div class="table-responsive">
                        <table id="entries" class="table" style="word-break: break-word;">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Header</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($entries as $key => $entry)
                                    <tr>
                                        <td>{{ $entry->datetime->format('F d, Y (h:i A)') }}</td>
                                        <td>
                                            {!! $entry->header !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <span class="badge badge-default">{{ __('log-viewer::general.empty-logs') }}</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><!--table-responsive-->
                </div><!--card-body-->
            </div>
        </div><!-- col-8 -->
    </div><!--row-->
@endsection
