@extends('layouts.base')
@section('title', 'Advertisers')

@section('breadcrumb')
    <h1 class="page-title">Advertisers</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Advertiser Manager</a></li>
        <li class="breadcrumb-item active" aria-current="page">Advertisers</li>
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
                    <h3 class="card-title">Advertiser List</h3>
                </div>
                <div class="grid-margin">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>Serial No</th>
                                    <th>Brand Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Approve Status</th>
                                    <th>Active Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($users) > 0)
                                    @foreach ($users as $key => $item)
                                        <tr>
                                            <td>{{ $users->firstItem() + $key }}</td>
                                            <td>{{ $item->business_name}}</td>
                                            <td>{{ $item->email }}</td>
                                            <td> {{ $item->getRole() ?? '' }} </td>
                                            <td>
                                                <span class="{{ $item->is_approved ? 'statusNormal' : 'statusDanger'}}">
                                                    {{  $item->is_approved ? 'Approved' : 'Disapproved' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="{{ $item->is_active ? 'statusNormal' : 'statusDanger'}}">
                                                    {{  $item->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>

                                            <td>
                                                <div class="btn-group align-top">
                                                    <button class="btn btn-sm btn-primary badge"  type="button" onclick="location.href='{{ route('users.edit', $item->id) }}'">Edit</button>

                                                    <button class="btn btn-sm btn-info badge" type="button" onclick="location.href='{{ route('users.show', $item->id) }}'"><i class="fa fa-eye"></i></button>

                                                    <button class="btn btn-sm btn-danger badge" type="button" onclick="deleteData('{{ route('users.delete', ['id' => $item->id]) }}')"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p>No data found</p>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $users->links('layouts.pagination') }}
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-2 CLOSED -->
</section>
<!-- CONTAINER CLOSED -->
@endsection

