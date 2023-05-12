<!-- resources/views/countries.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Countries</h1>
        <div class="row">
            <div class="col-md-4">
                <form id="addCountryForm">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="code">Code:</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                    <div class="form-group">
                        <label for="dialing_code">Dialing Code:</label>
                        <input type="text" class="form-control" id="dialing_code" name="dialing_code" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Country</button>
                </form>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="filter">Filter by Name:</label>
                    <input type="text" class="form-control" id="filter" name="filter">
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Dialing Code</th>
                        </tr>
                    </thead>
                    <tbody id="countriesTableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Fetch all countries
//            fetchCountries();

            // Add new country form submission
            $('#addCountryForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '/api/countries',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Clear form inputs
                        $('#addCountryForm')[0].reset();

                        // Refresh country list
                        fetchCountries();
                    }
                });
            });

            // Filter countries
            $('#filter').on('input', function() {
                fetchCountries($(this).val(), $('#filter_type').val());
            });
        });

        function f2etchCountries(filter, type) {
            $.ajax({
                url: '/api/countries' + (filter ? '?filter=' + filter : ''),
                success: function(response) {
                    // Clear table body
                    $('#countriesTableBody').html('');

                    // Add countries to table body
                    $.each(response.data, function(i, country) {
                        $('#countriesTableBody').append(`
                            <tr>
                                <td>${country.name}</td>
                                <td>${country.code}</td>
                                <td>${country.dialing_code}</td>
                            </tr>
                        `);
                    });
                }
            });
        }
    </script>
@endsection
