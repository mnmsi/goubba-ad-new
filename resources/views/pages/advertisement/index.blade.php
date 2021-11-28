@extends('layouts.base')
@section('title', 'Campaigns')

@section('breadcrumb')
    <h1 class="page-title">Campaigns</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Campaign Mamagement</a></li>
        <li class="breadcrumb-item active" aria-current="page">Campaigns</li>
    </ol>
@endsection

@section('content')
<!--app-content open-->
<section>
    <!-- ROW-2 -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-0">
                    <h3 class="card-title">Campaign List</h3>
                </div>
                <div class="grid-margin">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>SL#</th>
                                    <th>Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Budget</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($campaignLists) > 0)
                                    @foreach ($campaignLists as $key => $campaign)
                                        @php($advertisement = $campaign->advertisement->first())
                                        <tr>
                                            {{--  <td>{{ $loop->iteration }}</td>  --}}
                                            <td>{{ $campaignLists->firstItem() + $key }}</td>
                                            <td>{{ $campaign->campaign_name }}</td>
                                            <td>{{ $advertisement->start_date }}</td>
                                            <td>{{ $advertisement->end_date }}</td>
                                            <td>{{ $advertisement->budget }}</td>
                                            <td>
                                                <span class="{{ $advertisement->is_active == 'publish' ? 'alert-publish' : 'alert-unpublish' }}">
                                                    {{ $advertisement->is_active }}
                                                </span>
                                            </td>

                                            <td>
                                                <div class="btn-group align-top">
                                                    <button class="btn btn-sm btn-primary badge"  type="button" onclick="location.href='{{ route('adv.edit', ['slug' => $campaign->id]) }}'">Edit</button>

                                                    <button class="btn btn-sm btn-info badge" type="button" onclick="location.href='{{ route('adv.view', ['slug' => $campaign->id]) }}'"><i class="fa fa-eye"></i></button>

                                                    <button class="btn btn-sm btn-danger badge" type="button" onclick="deleteData('{{ route('adv.delete', ['slug' => $campaign->id]) }}')"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" style="text-align: center">No data found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $campaignLists->links('layouts.pagination') }}
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-2 CLOSED -->
</section>
<!-- CONTAINER CLOSED -->
@endsection
