@extends('main')
@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>
                    <label for="countries">Select Country</label>
                    <select name="countries" id="countries">
                        <option value="All" selected="selected">All Countries</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Mozambique">Cameroon</option>
                    </select>
                </th>
                <th>
                    <label for="valid">Select Validity</label>
                    <select name="valid" id="valid">
                        <option value="all" selected="selected">All Numbers</option>
                        <option value="yes">Valid</option>
                        <option value="no">Not Valid</option>

                    </select>
                </th>
                <th></th>
                <th></th>

            </tr>
            <tr>
                <th>Country</th>
                <th>Code</th>
                <th>State</th>
                <th>Phone Number</th>
            </tr>
            </thead>
            <tbody id="table-content">

            </tbody>

        </table>
    </div>
<script>

        jQuery.ajax({url: "/api/v1/customer", success: function(result){
                populateResult(result);
            }});

        $("#countries").change(function(){
            var country = $(this).val();
            var valid = $("#valid").val();
            jQuery.ajax({url: "/api/v1/customer?country="+country+"&valid="+valid, success: function(result){
                    populateResult(result);
                }});

        });
        $("#valid").change(function(){
            var valid = $(this).val();
            var country = $("#countries").val();
            jQuery.ajax({url: "/api/v1/customer?country="+country+"&valid="+valid, success: function(result){
                    populateResult(result);
                }});

        });

        function populateResult(result) {
            $("#table-content").empty();
            $.each(result, function(i, item) {
                var $tr = $('<tr>').append(
                    $('<td>').text(item.country),
                    $('<td>').text(item.code),
                    $('<td>').text(item.state),
                    $('<td>').text(item.phone)
                );
                $("#table-content").append($tr);
            });
        }



</script>
@endsection
