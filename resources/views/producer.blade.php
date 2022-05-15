@extends('layouts.dashboard')

@section('content')
<div class="container">
<div class="pull-right">
            <input type="text" name="search" id="searchText" class="form-control" placeholder="Search Producer...">
            <br>
        </div>
    <div class="col-md-12">
            <div class="pull-right">
                <button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="insertProd"><i class="fa fa-plus"></i> Add Producer</button>
            </div>
            <h2>Producers</h2>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="producer">
                        <thead style="background-color:#535E4B; color:white;">
                            <tr>
                                <th>ID</th>
                                <th>Firstame</th>
                                <th>Lastname</th>
                                <th>Age</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="res">
                        </tbody>
                    </table>
                </div>
                <!-- Add Modal for Producers with validations -->
                <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color:#9E9793; color:black;">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Producer</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">First Name:</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="first_name">
                                        <span style="color:blue; font-style: italic;" id="validate_Firstname_Req" class="validate_Firstname_Req">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validate_Firstname_Err" class="validate_Firstname_Err"></span>
                                        <span class="validate_Firstname_Ok" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validate_Firstname_Ok" class=""></span></i></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">Last Name:</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="last_name">
                                        <span style="color:blue; font-style: italic;" id="validate_Lastname_Req" class="validate_Lastname_Req">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validate_Lastname_Err" class="validate_Lastname_Err"></span>
                                        <span class="validate_Lastname_Ok" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validate_Lastname_Ok" class=""></span></i></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">Age:</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="age">
                                        <span style="color:blue; font-style: italic;" id="validate_ActorAge_Req" class="validate_ActorAge_Req">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validate_ActorAge_Err" class="validate_ActorAge_Err"></span>
                                        <span class="validate_ActorAge_Ok" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validate_ActorAge_Ok" class=""></span></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-sm" id="prod_save">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color:#9E9793; color:black;">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Edit Actor</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">ID</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="prod_id" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="fname">
                                        <span style="color:blue; font-style: italic;" id="validatefnameReq" class="validatefnameReq">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validatefnameErr" class="validatefnameErr"></span>
                                        <span class="validatefnameOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validatefnameOk" class=""></span></i></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="lname">
                                        <span style="color:blue; font-style: italic;" id="validatelnameReq" class="validatelnameReq">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validatelnameErr" class="validatelnameErr"></span>
                                        <span class="validatelnameOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validatelnameOk" class=""></span></i></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">Age</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="ages">
                                        <span style="color:blue; font-style: italic;" id="validateAgesReq" class="validateAgesReq">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validateAgesErr" class="validateAgesErr"></span>
                                        <span class="validateAgesOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validateAgesOk" class=""></span></i></span>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-sm" id="prod_update">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $.ajax({
        url: "{{ route('user.getAllProducers') }}",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        method:"post",
        dataType:"json",
        success:function(e){
            var html = '';
            $.each(e, function(key, value) {
                    html += '<tr>';
                    html += '<td>'+value.id+'</td>';
                    html += '<td>'+value.first_name+'</td>';
                    html += '<td>'+value.last_name+'</td>';
                    html += '<td>'+value.age+' years old </td>';
                    html += '<td><button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="prod_edit" data-id="'+value.id+'"><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn btn-danger btn-sm" style="color:white; font-family: century gothic;" id="prod_delete" data-id="'+value.id+'"><i class="fa fa-trash"></i> Remove</button></td>';
                    html += '<tr>';
            })
            $('#producer').append(html);
        },
        error:function(e){
            console.log(e);
        }
    });


        // add modal validation
        $('#first_name').keyup(function(e) {
            e.preventDefault();
            var firstname = $(this).val();
            var minLength = 3;
            if(e.keyCode == 27 || firstname == '') {
                $('.validate_Firstname_Ok').css('display', 'none');
                $('.validate_Firstname_Err').css('display', 'none');
                $('.validate_Firstname_Req').css('display', 'block');
            } else if($(this).val().length < minLength) {
                $('#validate_Firstname_Err').css('display', 'block');
                $('#validate_Firstname_Err').text('Please enter at least minimum of '+ minLength + ' characters')
                $('.validate_Firstname_Ok').css('display', 'none');
                $('.validate_Firstname_Req').css('display', 'none');
            } else {
                $('.validate_Firstname_Ok').css('display', 'block');
                $('#validate_Firstname_Ok').text('Ok')
                $('#validate_Firstname_Err').css('display', 'none');
                $('.validate_Firstname_Req').css('display', 'none');
            }
        });

        $('#last_name').keyup(function(e) {
            e.preventDefault();
            var lastname = $(this).val();
            var minLength = 2;
            if(e.keyCode == 27 || lastname == '') {
                $('.validate_Lastname_Ok').css('display', 'none');
                $('.validate_Lastname_Err').css('display', 'none');
                $('.validate_Lastname_Req').css('display', 'block');
            } else if($(this).val().length < minLength) {
                $('#validate_Lastname_Err').css('display', 'block');
                $('#validate_Lastname_Err').text('Please enter at least minimum of '+ minLength + ' characters')
                $('.validate_Lastname_Ok').css('display', 'none');
                $('.validate_Lastname_Req').css('display', 'none');
            } else {
                $('.validate_Lastname_Ok').css('display', 'block');
                $('#validate_Lastname_Ok').text('Ok')
                $('#validate_Lastname_Err').css('display', 'none');
                $('.validate_Lastname_Req').css('display', 'none');
            }
        });

        $('#age').keyup(function(e) {
            e.preventDefault();
            var age = $(this).val();
            if(e.keyCode == 27 || age == '') {
                $('.validate_ActorAge_Ok').css('display', 'none');
                $('.validate_ActorAge_Err').css('display', 'none');
                $('.validate_ActorAge_Req').css('display', 'block');
            } else if(!$.isNumeric(age)) {
                $('#validate_Lastname_Err').css('display', 'block');
                $('#validate_Lastname_Err').text('Please enter valid age')
                $('.validate_ActorAge_Ok').css('display', 'none');
                $('.validate_ActorAge_Req').css('display', 'none');
            } else {
                $('.validate_ActorAge_Ok').css('display', 'block');
                $('#validate_ActorAge_Ok').text('Ok')
                $('#validate_ActorAge_Err').css('display', 'none');
                $('.validate_ActorAge_Req').css('display', 'none');
            }
        });

        // edit modal validation for specific producer
        $('#fname').keyup(function(e) {
            e.preventDefault();
            var fname = $(this).val();
            var minLength = 3;
            if(e.keyCode == 27 || fname == '') {
                $('.validatefnameOk').css('display', 'none');
                $('.validatefnameErr').css('display', 'none');
                $('.validatefnameReq').css('display', 'block');
            } else if($(this).val().length < minLength) {
                $('#validatefnameErr').css('display', 'block');
                $('#validatefnameErr').text('Please enter at least minimum of '+ minLength + ' characters')
                $('.validatefnameOk').css('display', 'none');
                $('.validatefnameReq').css('display', 'none');
            } else {
                $('.validatefnameOk').css('display', 'block');
                $('#validatefnameOk').text('Ok')
                $('#validatefnameErr').css('display', 'none');
                $('.validatefnameReq').css('display', 'none');
            }
        });

        $('#lname').keyup(function(e) {
            e.preventDefault();
            var lname = $(this).val();
            var minLength = 2;
            if(e.keyCode == 27 || lname == '') {
                $('.validatelnameOk').css('display', 'none');
                $('.validatelnameErr').css('display', 'none');
                $('.validatelnameReq').css('display', 'block');
            } else if($(this).val().length < minLength) {
                $('#validatelnameErr').css('display', 'block');
                $('#validatelnameErr').text('Please enter at least minimum of '+ minLength + ' characters')
                $('.validatelnameOk').css('display', 'none');
                $('.validatelnameReq').css('display', 'none');
            } else {
                $('.validatelnameOk').css('display', 'block');
                $('#validatelnameOk').text('Ok')
                $('#validatelnameErr').css('display', 'none');
                $('.validatelnameReq').css('display', 'none');
            }
        });

        $('#ages').keyup(function(e) {
            e.preventDefault();
            var age = $(this).val();
            if(e.keyCode == 27 || age == '') {
                $('.validateAgesOk').css('display', 'none');
                $('.validateAgesErr').css('display', 'none');
                $('.validateAgesReq').css('display', 'block');
            } else if(!$.isNumeric(age)) {
                $('#validateAgesErr').css('display', 'block');
                $('#validateAgesErr').text('Please enter valid age')
                $('.validateAgesOk').css('display', 'none');
                $('.validateAgesReq').css('display', 'none');
            } else {
                $('.validateAgesOk').css('display', 'block');
                $('#validateAgesOk').text('Ok')
                $('#validateAgesErr').css('display', 'none');
                $('.validateAgesReq').css('display', 'none');
            }
        });
    });

    

    $('#insertProd').on('click', function() {
        $('#insertModal').modal('show');
    });

    // save producer
    $('#prod_save').on('click', function() {
        var fname = $('#first_name').val();
        var lname = $('#last_name').val();
        var age = $('#age').val();

        if(fname == "") {
            alert("First Name cannot be empty!");
            return;
        } else if(fname.length < 3) {
            alert("Please enter at least minimum of 3 characters");
            return;
        }

        if(lname == "") {
            alert("Last Name cannot be empty!");
            return;
        } else if(lname.length < 2) {
            alert("Please enter at least minimum of 2 characters");
            return;
        }

        if(age == "") {
            alert("Age cannot be empty!");
            return;
        } else if(!$.isNumeric(age)) {
            alert('Please enter valid age');
            return;
        }

        $.ajax({
            url: "{{ route('user.prod_save') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                Fname:fname,
                Lname:lname,
                Age:age
            },
            method:"post",
            dataType:"json",
            success:function(e){
                    $('#insertModal').modal('hide');
                    alert("Successfully added new producer!");
                    var html = '';
                    html += '<tr>';
                    html += '<td>'+e.id+'</td>';
                    html += '<td>'+e.first_name+'</td>';
                    html += '<td>'+e.last_name+'</td>';
                    html += '<td>'+e.age+'< yrs old /td>';
                    html += '<td><button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="prod_edit" data-id="'+e.id+'"><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn btn-danger btn-sm" style="color:white; font-family: century gothic;" id="prod_delete" data-id="'+e.id+'"><i class="fa fa-trash"></i> Remove</button></td>'
                    html += '<tr>';
                    $('#producer').prepend(html);
                    location.reload(); 
            },
            error:function(e){
                console.log(e);
            }
        });
    });

    $(document).on('click', '#prod_edit[data-id]', function() {
        $('#editModal').modal('show');
        var id = $(this).data('id');

        $.ajax({
            url: "{{ route('user.prod_edit') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                id:id
            },
            method:"post",
            dataType:"json",
            success:function(e){
                $('#prod_id').val(e.id)
                $('#fname').val(e.first_name);
                $('#lname').val(e.last_name);
                $('#ages').val(e.age);
            },
            error:function(e){
                console.log(e);
            }
        });
    });

    $('#prod_update').on('click', function() {
        var id = $('#prod_id').val();
        var firstname = $('#fname').val();
        var lastname = $('#lname').val();
        var ages = $('#ages').val();

        if(firstname == "") {
            alert("First Name cannot be empty!");
            location.reload();
        } else if(fname.length < 3) {
            alert("Please enter at least minimum of 3 characters");
            return;
        }

        if(lastname == "") {
            alert("Last Name cannot be empty!");
            location.reload();
        } else if(lname.length < 2) {
            alert("Please enter at least minimum of 2 characters");
            return;
        }

        if(ages == "") {
            alert("Age cannot be empty!");
            location.reload();
        } else if(!$.isNumeric(ages)) {
            alert('Please enter valid age');
            return;
        }

        $.ajax({
            url: "{{ route('user.prod_update') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                id:id,
                firstname:firstname,
                lastname:lastname,
                ages:ages
            },
            method:"post",
            dataType:"json",
            success:function(e){          
                    alert("Successfully updated producer!");
                    location.reload();
            },
            error:function(e){
                console.log(e);
            }
        });
    });

  
    $(document).on('click', '#prod_delete[data-id]', function() {
        $.ajax({
            url: "{{ url('producers/delete') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                id: $(this).data('id'),
            },
            method:"post",
            dataType:"json",
            success:function(e){
                alert("Successfully deleted producer!");
                location.reload();
            },
            error:function(e){
                console.log(e);
            }
        });
    });

    //search function
    $('#searchText').keyup(function(e) {
        e.preventDefault();
        var txt = $(this).val();
            if(e.keyCode === 27) {
            $(this).val('');
        }

        $.ajax({
            url: "{{ route('producer.search') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                search: txt,
            },
            method:"post",
            dataType:"json",
            success:function(data){
                $("#res").empty();
                var html = '';
                if(data == '') {
                    var count = 5;
                    html += '<tr>';
                    html += '<td colspan="'+count+'" style="text-align:center;">No producer record found!</td>';
                    html += '<tr>';
                } else {
                    $.each(data, function(key, value) {
                        html += '<tr>';
                        html += '<td>'+value.id+'</td>';
                        html += '<td><span class="badge badge-success" style="font-size: 16px; font-family: century gothic; background-color: rgb(3, 165, 173);">'+value.first_name+'</span></td>';
                        html += '<td><span class="badge badge-success" style="font-size: 16px; font-family: century gothic; background-color: rgb(3, 165, 173);">'+value.last_name+'</span></td>';
                        html += '<td><span class="badge badge-success" style="font-size: 16px; font-family: century gothic; background-color: rgb(3, 165, 173);">'+value.age+' years old</span></td>';
                        html += '<td><button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="prod_edit" data-id="'+value.id+'"><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn btn-danger btn-sm" style="color:white; font-family: century gothic;" id="prod_delete" data-id="'+value.id+'"><i class="fa fa-trash"></i> Remove</button></td>'
                        html += '<tr>';
                    });
                }
                $('#res').append(html);
            },
            error:function(e){
                console.log(e);
            }
        });
    });
</script>
@endsection
