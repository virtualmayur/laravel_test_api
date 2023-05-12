$(document).ready(function() {
    // Showing list of countries
    apiRequest('/api/countries', null, 'GET', function(response) {
        updateTable(response);
    }, function(xhr, textStatus, errorThrown) {
        console.error(xhr, textStatus, errorThrown);
    });

    // Filter Countries
    $('#filter').on('input', function() {
        fetchCountries($(this).val(), $('#filter_type').val());
    });

    // Add new countries
    $('#add-country-form').submit(function(e) {
        e.preventDefault(); 
        // get the form data
        var formData = {
          'country_code': $('#country-code').val(),
          'country_name': $('#country-name').val(),
          'dialing_code': $('#dialing-code').val()
        };
    
        // send the form data to the server using AJAX
        apiRequest('/api/countries', formData, 'POST', function(response) {
            if (response.status !== 200) {
                $('#add-country-form .alert-danger').remove();
                $('#add-country-form').prepend('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.message + 
                '</div>');
            } else {
                window.location.href = '/';
                $('#message .alert-danger').remove();
                $('#message').prepend('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.message + 
                '</div>');
            }
        }, function(xhr, textStatus, errorThrown) {
            $('#add-country-form .alert-danger').remove();
            $('#add-country-form').prepend('<div class="alert alert-danger">' + errorThrown + '</div>');
        });
    });

    // Add Country Validations
    $('#country-code').on('keyup', function() {
        if ($(this).val().length > 0) {
            const regex = /^[a-zA-Z]{1,5}$/;
            if (regex.test($(this).val())) {
                $(this).css('background-color', 'green');
                validateAndEnableSubmitButton();
            } else {
                $(this).css('background-color', 'red');
                $("#submit-form").attr('disabled', 'diabled');
            }
        } else {
            $(this).css('background-color', '');
        }
    });
    $('#country-name').on('keyup', function() {
        console.log($(this).val());
        if ($(this).val().length > 0) {
            const regex = /^[a-zA-Z\s]{3,100}$/;
            if (regex.test($(this).val())) {
                $(this).css('background-color', 'green');
                validateAndEnableSubmitButton();
            } else {
                $(this).css('background-color', 'red');
                $("#submit-form").attr('disabled', 'diabled');
            }
        } else {
            $(this).css('background-color', '');
        }

    });
    $('#dialing-code').on('keyup', function() {
        if ($(this).val().length > 0) {
            const regex = /^\+?\d{1,4}$/;
            if (regex.test($(this).val())) {
                $(this).css('background-color', 'green');
                validateAndEnableSubmitButton();
            } else {
                $(this).css('background-color', 'red');
                $("#submit-form").attr('disabled', 'diabled');
            }
        } else {
            $(this).css('background-color', '');
        }
    });
});

function validateAndEnableSubmitButton()
{
    let code = $('#country-code').val();
    let name = $('#country-name').val();
    let dialing_code = $('#dialing-code').val()
    if (code.length == 0 || name.length == 0 || dialing_code.length == 0) {
        $("#submit-form").attr('disabled', 'diabled');
    } else {
        $("#submit-form").removeAttr('disabled');
    }
}

function fetchCountries(filter, type) {
    let data = {};
    data[type] = filter;
    apiRequest('/api/countries/filter', data, 'POST', function(response) {
        updateTable(response);
    }, function(xhr, textStatus, errorThrown) {
        console.error(xhr, textStatus, errorThrown);
    });
}

function apiRequest(url, data, method, successCallback, errorCallback) {
    $.ajax({
        url: url,
        type: method,
        data: data,
        success: function(response) {
            //console.log(response);
            if (successCallback) {
                successCallback(response);
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            if (errorCallback) {
                errorCallback(xhr, textStatus, errorThrown);
            }
        }
    });
}

function updateTable(response) {
    $('#countries-table').empty();
    let data = response.data;
    $.each(data, function(index, country) {
      var row = $('<tr>');
      row.append($('<td>').text(country.country_code));
      row.append($('<td>').text(country.country_name));
      row.append($('<td>').text(country.dialing_code));
      $('#countries-table').append(row);
    });
}
