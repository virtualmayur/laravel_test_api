<!-- resources/views/countries.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Countries</h1>
        <div id="messages"></div>
        <div class="row">
            <div class="col-md-8">
            <label for="filter">Filter by:</label>
    <select class="form-control" id="filter_type" name="filter">
      <option value="country_code">Code</option>
      <option value="country_name">Name</option>
      <option value="dialing_code">Dialing Code</option>
    </select>
                <div class="form-group">
                    <label for="filter">Filter by Name:</label>
                    <input type="text" class="form-control" id="filter" name="filter">
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Country Code</th>
                            <th>Country Name</th>
                            <th>Dialing Code</th>
                        </tr>
                    </thead>
                    <tbody id="countries-table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/countries.js') }}"></script>
@endsection