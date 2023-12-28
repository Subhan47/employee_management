<table>
<thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Designation</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($employees as $employee)
        <tr>
            <td>{{ $employee->id }}</td>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->designation->title }}</td>
            <td>
                <a href="{{ route('show-employee', ['id' => $employee->id]) }}" class="action-link"><button class="secondary icon-preview"></button></a>
                <a href="{{ route('edit-employee', ['id' => $employee->id]) }}" class="action-link"><button class="icon-edit"></button></a>
                <form action="{{ route('destroy-employee', ['id' => $employee->id]) }}" method="post" style="display:inline;">
                    @csrf
                    <button type="submit" class="warning icon-trash" onclick="return confirm('Are you sure?')"></button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5">No employees found</td>
        </tr>
    @endforelse
    </tbody>
 </table>

 {{ $employees->links() }}
