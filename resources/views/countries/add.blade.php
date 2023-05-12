<!-- resources/views/countries.blade.php -->

@extends('layouts.app')

@section('content')
<!-- HTML form for adding a country -->
<form id="add-country-form" class="needs-validation" novalidate>
  <div class="form-group">
    <label for="country-code">Country Code</label>
    <input type="text" class="form-control country-code" id="country-code" name="country_code" required data-rule-pattern="[a-zA-Z]+">

    <div class="invalid-feedback">Please enter a valid country code (only alphabets allowed).</div>
  </div>
  <div class="form-group">
    <label for="country-name">Country Name</label>
    <input type="text" class="form-control country-name" id="country-name" name="country_name" required
        pattern="[a-zA-Z]*">
    <div class="invalid-feedback">Please enter a valid country name (only alphabets allowed).</div>
  </div>
  <div class="form-group">
    <label for="dialing-code">Dialing Code</label>
    <input type="text" class="form-control dialing-code" id="dialing-code" name="dialing_code" required pattern="^[+0-9-]*$">

    <div class="invalid-feedback">Please enter a valid dialing code (only +, -, and numbers allowed).</div>
  </div>
  <button type="submit" id="submit-form" class="btn btn-primary" disabled="disabled">Submit</button>
  <button type="reset" class="btn btn-secondary" onClick="window.location.reload()">Reset</button>
</form>
<script src="{{ asset('js/countries.js') }}"></script>
@endsection