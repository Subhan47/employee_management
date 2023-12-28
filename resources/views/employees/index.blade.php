@extends('layouts')

@section('content')
    <div class="container">

        <h1>Employee List</h1>
        <div class="row">
            @include('partials.search')
            <div class="navigationButton columns four">
                <a href="{{ route('create-employee') }}">
                    <button class="icon-addcircle"></button>
                </a>
            </div>

        </div>

        @include('partials.sessionMessages')
        <div id="searchResponse">
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
                            <a href="{{ route('show-employee', ['id' => $employee->id]) }}" class="action-link">
                                <button class="secondary icon-preview"></button>
                            </a>
                            <a href="{{ route('edit-employee', ['id' => $employee->id]) }}" class="action-link">
                                <button class="icon-edit"></button>
                            </a>
                            <form action="{{ route('destroy-employee', ['id' => $employee->id]) }}" method="post"
                                  style="display:inline;">
                                @csrf
                                <button type="submit" class="warning icon-trash"
                                        onclick="return confirm('Are you sure?')"></button>
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
        </div>


    </div>



    <!-- This script is for search -->

    <script>
        let timeout;

        function searchAndPagination(page = 1) {
            const query = $('#search').val();
            const url = '/search';

            $.ajax({
                url: url,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { search: query, page: page },
                success: function (html) {
                    $('#searchResponse').empty().html(html);
                },
                error: function (error) {
                    //
                }
            });
        }

        $(document).ready(function () {
            $('#search').on('input', function () {
                clearTimeout(timeout);
                timeout = setTimeout(searchAndPagination, 1000);
            });

            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                const page = $(this).attr('href').split('page=')[1];
                searchAndPagination(page);
            });
        });
    </script>


    {{--    <script>--}}
{{--        let timeout;--}}
{{--        $('#search').on('input', function () {--}}
{{--            clearTimeout(timeout);--}}
{{--            timeout = setTimeout(function () {--}}
{{--                const query = $('#search').val();--}}
{{--                searchResults(query);--}}
{{--            }, 1000);--}}
{{--        });--}}

{{--        function searchResults(search) {--}}
{{--            $.ajax({--}}
{{--                url: '/search',--}}
{{--                method: 'GET',--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                },--}}
{{--                data: {search: search},--}}
{{--                success: function (html) {--}}
{{--                    $('#searchResponse').empty().html(html);--}}
{{--                },--}}
{{--                error: function (error) {--}}
{{--                    //--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        $(document).on('click', '.pagination a', function (event) {--}}
{{--            event.preventDefault();--}}
{{--            performSearchAndPagination();--}}
{{--        });--}}
{{--    </script>--}}

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $(document).on('click', '.pagination a', function (event) {--}}
{{--                event.preventDefault();--}}
{{--                const url = $(this).attr('href');--}}
{{--                getPaginatedResults(url);--}}
{{--            });--}}
{{--        });--}}

{{--        function getPaginatedResults(url) {--}}
{{--            $.ajax({--}}
{{--                url: url,--}}
{{--                method: 'GET',--}}
{{--                success: function (html) {--}}
{{--                    $('#searchResponse').empty().html(html);--}}
{{--                },--}}
{{--                error: function (error) {--}}
{{--                    //--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}

@endsection
