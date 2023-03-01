<div>
    {{-- componen rentlog table --}}
    <table class="table text-center justify-content-center align-items-center" style="border: 1px solid black">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Book Code</th>
                <th>Book</th>
                <th>Rent Date</th>
                <th>Return Date</th>
                <th>Actual Return Date</th>
            </tr>
        </thead>

        @foreach ($rentlog as $rentlogs)
            <tbody>
                <tr class="{{ $rentlogs->actual_return_date == null ? '' : ($rentlogs->return_date < $rentlogs->actual_return_date ? 'text-bg-danger' : 'text-bg-success') }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rentlogs->user->username }}</td>
                    <td>{{ $rentlogs->book->book_code }}</td>
                    <td>{{ $rentlogs->book->title }}</td>
                    <td>{{ $rentlogs->rent_date }}</td>
                    <td>{{ $rentlogs->return_date }}</td>
                    <td>{{ $rentlogs->actual_return_date }}</td>
                </tr>
            </tbody>
        @endforeach
    </table>
</div>