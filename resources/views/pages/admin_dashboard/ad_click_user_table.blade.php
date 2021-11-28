<div id="adClickUserTableId">
    <div class="table-responsive border-top">
        <table class="table card-table table-striped table-vcenter text-nowrap">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Avatar</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>User Points</th>
                    <th>User Total Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clickedUsers as $user)
                <tr>
                    <td>{{ $user->user->id }}</td>
                    <td>{{ $user->user->name }}</td>
                    <td><img src="{{ empty($user->user->avatar) ? asset('assets/images/sample_avatar.png') : $user->user->avatar }}" alt="profile-user" class="brround  avatar-sm w-32"></td>
                    <td>{{ $user->user->email }}</td>
                    <td>{{ empty($user->user->mobile) ? 'N/A' : $user->user->mobile }}</td>
                    <td>{{ number_format($user->user->points) }}</td>
                    <td>{{ number_format($user->user->total_points) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">
                        {{ $clickedUsers->links('pagination::bootstrap-4') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
