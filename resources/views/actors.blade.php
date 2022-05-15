    
@extends('layouts.dashboard')
@section('content')
<div class="container" >
        <div class="pull-right">
            <input type="text" name="search" id="searchText" class="form-control" placeholder="Search Actors...">
            <br>
        </div>
    <div class="col-md-12">
                 <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="insertActor"><i class="fa fa-plus"></i> Add Actor</button>
                </div>
                
            <h2>Actors</h2>
            <div class="row" >
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="actor">
                        <thead  style="background-color:#535E4B; color:white;">
                            <tr>
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="res">
                            <!-- this will call the actors data thru ajax scripts -->
                        </tbody>
                    </table>
                </div>

                 <!-- Modal form for Actors -->
                <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color: #9E9793; color:black;">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Actor</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="first_name">
                                        <span style="color:blue; font-style: italic;" id="validatefirst_nameReq" class="validatefirst_nameReq">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validatefirst_nameErr" class="validatefirst_nameErr"></span>
                                        <span class="validatefirst_nameOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validatefirst_nameOk" class=""></span></i></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="last_name">
                                        <span style="color:blue; font-style: italic;" id="validatelast_nameReq" class="validatelast_nameReq">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validatelast_nameErr" class="validatelast_nameErr"></span>
                                        <span class="validatelast_nameOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validatelast_nameOk" class=""></span></i></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">Age</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="age">
                                        <span style="color:blue; font-style: italic;" id="validateActor_AgeReq" class="validateActor_AgeReq">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validateActor_AgeErr" class="validateActor_AgeErr"></span>
                                        <span class="validateActor_AgeOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validateActor_AgeOk" class=""></span></i></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">Gender</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="sex">
                                            <option value="">Select Gender...</option>
                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                        </select>
                                        <span style="color:blue; font-style: italic;" id="validateActor_GenderReq" class="validateActor_GenderReq">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validateActor_GenderErr" class="validateActor_GenderErr"></span>
                                        <span class="validateActor_GenderOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validateActor_GenderOk" class=""></span></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-sm" id="actor_save">Save</button>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- end div for add modal form -->

                <!-- Edit Modal for Actor Information-->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color:#9E9793; color:black;">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Edit Actor</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">Actor ID</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="actor_id" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="fname">
                                        <span style="color:blue; font-style: italic; display: none;" id="validateGiven_NameReq" class="validateGiven_NameReq">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validateGiven_NameErr" class="validateGiven_NameErr"></span>
                                        <span class="validateGiven_NameOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validateGiven_NameOk" class=""></span></i></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="lname">
                                        <span style="color:blue; font-style: italic; display: none;" id="validate_SurnameReq" class="validate_SurnameReq">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validate_SurnameErr" class="validate_SurnameErr"></span>
                                        <span class="validate_SurnameOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validate_SurnameOk" class=""></span></i></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">Age</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="ages">
                                        <span style="color:blue; font-style: italic; display: none;" id="validate_YearsReq" class="validate_YearsReq">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validate_YearsErr" class="validate_YearsErr"></span>
                                        <span class="validate_YearsOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validate_YearsOk" class=""></span></i></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">Gender</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="sexuality">
                                            <option value="">Select Gender...</option>
                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                        </select>
                                        <span style="color:blue; font-style: italic; display: none;" id="validateGenderReq" class="validateGenderReq">This field is required</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-sm" id="actor_update">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        //  actor table
        $.ajax({
            url: "{{ route('user.getActors') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            method:"post",
            dataType:"json",
            success:function(e){
                var html = '';
                
                $.each(e, function(key, value) {
                 
                    if(value.gender == 0) {
                        gender = "Male";
                    } else {
                        gender = "Female";
                    }
                    html += '<tr>';
                    html += '<td>'+value.id+'</td>';
                    html += '<td>'+value.firstname+'</td>';
                    html += '<td>'+value.lastname+'</td>';
                    html += '<td>'+gender+'</td>';
                    html += '<td>'+value.age+' years old</td>';
                    html += '<td> <button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="actor_edit" data-id="'+value.id+'"><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn btn-danger btn-sm" style="color:white; font-family: century gothic;" id="actor_delete" data-id="'+value.id+'"><i class="fa fa-trash"></i> Remove</button></td>';
                    html += '<tr>';
                   
                })
                $('#actor').append(html);
                
            },
            error:function(e){
                console.log(e);
            }
        });
    });
</script>
<script>
       // add modal form validation for actor
       $('#first_name').keyup(function(e) {
            e.preventDefault();
            var fname = $(this).val();
            var minLength = 3;
            if(e.keyCode == 27 || fname == '') {
                $('.validatefirst_nameOk').css('display', 'none');
                $('.validatefirst_nameErr').css('display', 'none');
                $('.validatefirst_nameReq').css('display', 'block');
            } else if($(this).val().length < minLength) {
                $('#validatefirst_nameErr').css('display', 'block');
                $('#validatefirst_nameErr').text('Please enter at least minimum of '+ minLength + ' characters')
                $('.validatefirst_nameOk').css('display', 'none');
                $('.validatefirst_nameReq').css('display', 'none');
            } else {
                $('.validatefirst_nameOk').css('display', 'block');
                $('#validatefirst_nameOk').text('Ok')
                $('#validatefirst_nameErr').css('display', 'none');
                $('.validatefirst_nameReq').css('display', 'none');
            }
        });

        $('#last_name').keyup(function(e) {
            e.preventDefault();
            var lname = $(this).val();
            var minLength = 2;
            if(e.keyCode == 27 || lname == '') {
                $('.validatelast_nameOk').css('display', 'none');
                $('.validatelast_nameErr').css('display', 'none');
                $('.validatelast_nameReq').css('display', 'block');
            } else if($(this).val().length < minLength) {
                $('#validatelast_nameErr').css('display', 'block');
                $('#validatelast_nameErr').text('Please enter at least minimum of '+ minLength + ' characters')
                $('.validatelast_nameOk').css('display', 'none');
                $('.validatelast_nameReq').css('display', 'none');
            } else {
                $('.validatelast_nameOk').css('display', 'block');
                $('#validatelast_nameOk').text('Ok')
                $('#validatelast_nameErr').css('display', 'none');
                $('.validatelast_nameReq').css('display', 'none');
            }
        });

        $('#age').keyup(function(e) {
            e.preventDefault();
            var age = $(this).val();
            if(e.keyCode == 27 || age == '') {
                $('.validateActor_AgeOk').css('display', 'none');
                $('.validateActor_AgeErr').css('display', 'none');
                $('.validateActor_AgeReq').css('display', 'block');
            } else if(!$.isNumeric(age)) {
                $('#validateActor_AgeErr').css('display', 'block');
                $('#validateActor_AgeErr').text('Please enter valid age')
                $('.validateActor_AgeOk').css('display', 'none');
                $('.validateActor_AgeReq').css('display', 'none');
            } else {
                $('.validateActor_AgeOk').css('display', 'block');
                $('#validateActor_AgeOk').text('Ok')
                $('#validateActor_AgeErr').css('display', 'none');
                $('.validateActor_AgeReq').css('display', 'none');
            }
        });

        $('#sex').on('change', function(e) {
            // alert($(this).val())
            e.preventDefault();
            var gender = $(this).val();
            if(gender == '') {
                $('.validateActor_GenderOk').css('display', 'none');
                $('.validateActor_GenderErr').css('display', 'none');
                $('.validateActor_GenderReq').css('display', 'block');
            } else {
                $('.validateActor_GenderOk').css('display', 'block');
                $('#validateActor_GenderOk').text('Ok')
                $('#validateActor_GenderErr').css('display', 'none');
                $('.validateActor_GenderReq').css('display', 'none');
            }
        });

        // edit modal validation
        $('#fname').keyup(function(e) {
            e.preventDefault();
            var fname = $(this).val();
            var minLength = 3;
            if(e.keyCode == 27 || fname == '') {
                //if esc is pressed we want to clear the value of search box
                $('.validateGiven_NameOk').css('display', 'none');
                $('.validateGiven_NameErr').css('display', 'none');
                $('.validateGiven_NameReq').css('display', 'block');
            } else if($(this).val().length < minLength) {
                $('#validateGiven_NameErr').css('display', 'block');
                $('#validateGiven_NameErr').text('Please enter at least minimum of '+ minLength + ' characters')
                $('.validateGiven_NameOk').css('display', 'none');
                $('.validateGiven_NameReq').css('display', 'none');
            } else {
                $('.validateGiven_NameOk').css('display', 'block');
                $('#validateGiven_NameOk').text('Ok')
                $('#validateGiven_NameErr').css('display', 'none');
                $('.validateGiven_NameReq').css('display', 'none');
            }
        });

        $('#lname').keyup(function(e) {
            e.preventDefault();
            var lname = $(this).val();
            var minLength = 2;
            if(e.keyCode == 27 || lname == '') {
                //if esc is pressed we want to clear the value of search box
                $('.validate_SurnameOk').css('display', 'none');
                $('.validate_SurnameErr').css('display', 'none');
                $('.validate_SurnameReq').css('display', 'block');
            } else if($(this).val().length < minLength) {
                $('#validate_SurnameErr').css('display', 'block');
                $('#validate_SurnameErr').text('Please enter at least minimum of '+ minLength + ' characters')
                $('.validate_SurnameOk').css('display', 'none');
                $('.validate_SurnameReq').css('display', 'none');
            } else {
                $('.validate_SurnameOk').css('display', 'block');
                $('#validate_SurnameOk').text('Ok')
                $('#validate_SurnameErr').css('display', 'none');
                $('.validate_SurnameReq').css('display', 'none');
            }
        });

        $('#ages').keyup(function(e) {
            e.preventDefault();
            var ages = $(this).val();
            if(e.keyCode == 27 || ages == '') {
                $('.validate_YearsOk').css('display', 'none');
                $('.validate_YearsErr').css('display', 'none');
                $('.validate_YearsReq').css('display', 'block');
            } else if(!$.isNumeric(ages)) {
                $('#validate_YearsErr').css('display', 'block');
                $('#validate_YearsErr').text('Please enter valid age')
                $('.validate_YearsOk').css('display', 'none');
                $('.validate_YearsReq').css('display', 'none');
            } else {
                $('.validate_YearsOk').css('display', 'block');
                $('#validate_YearsOk').text('Ok')
                $('#validate_YearsErr').css('display', 'none');
                $('.validate_YearsReq').css('display', 'none');
            }
        });

        $('#sexuality').on('change', function(e) {
            e.preventDefault();
            var sexuality = $(this).val();
            if(sexuality == '') {
                $('.validateGenderOk').css('display', 'none');
                $('.validateGenderErr').css('display', 'none');
                $('.validateGenderReq').css('display', 'block');
            } else {
                $('.validateGenderOk').css('display', 'block');
                $('#validateGenderOk').text('Ok')
                $('#validateGenderErr').css('display', 'none');
                $('.validateGenderReq').css('display', 'none');
            }
        });
    
    // add actor  modal
    $('#insertActor').on('click', function() {
        $('#insertModal').modal('show');
    });

    // save add actor
    $('#actor_save').on('click', function(e) {
        e.preventDefault();
        var fname = $('#first_name').val();
        var lname = $('#last_name').val();
        var age = $('#age').val();
        var sex = $('#sex').val();

        if(fname == "") {
            alert("First Name cannot be empty!");
            location.reload();
        } else if(fname.length < 3) {
            alert("Please enter at least minimum of 2 characters");
            return;
        }

        if(lname == "") {
            alert("Last Name cannot be empty!");
            location.reload();
        } else if(lname.length < 2) {
            alert("Please enter at least minimum of 2 characters");
            return;
        }

        if(age == "") {
            alert("Age cannot be empty!");
            location.reload();
        } else if(!$.isNumeric(age)) {
            alert('Please enter valid age');
            return;
        }

        if(sex == "") {
            alert("This field is required!");
            return;
        }

        $.ajax({
            url: "{{ route('user.actor_save') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                Fname:fname,
                Lname:lname,
                age:age,
                Gender:sex
            },
            method:"post",
            dataType:"json",
            success:function(e){
                var html = '';
                
                $.each(e, function(key, value) {
                 
                    if(value.gender == 0) {
                        gender = "Male";
                    } else {
                        gender = "Female";
                    }
                    html += '<tr>';
                    html += '<td>'+value.id+'</td>';
                    html += '<td>'+value.firstname+'</td>';
                    html += '<td>'+value.lastname+'</td>';
                    html += '<td>'+gender+'</td>';
                    html += '<td>'+value.age+' years old </td>';
                    html += '<td> <button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="actor_edit" data-id="'+value.id+'"><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn btn-danger btn-sm" style="color:white; font-family: century gothic;" id="actor_delete" data-id="'+value.id+'"><i class="fa fa-trash"></i> Remove</button></td>';
                    html += '<tr>';
                    location.reload(); 
                })
                $('#actor').append(html);
                
            },
            error:function(data){
                console.log(data);
            } 
        });
    });

    $(document).on('click', '#actor_edit[data-id]', function() {
        var id = $(this).data('id');
        $('#editModal').modal('show');

        // get actor details
        $.ajax({
           url: "{{ route('user.actor_edit') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                id:id
            },
            method:"post",
            dataType:"json",
            success:function(data){
                $('#actor_id').val(data.id);
                $('#fname').val(data.firstname);
                $('#lname').val(data.lastname);
                $('#ages').val(data.age);
                $('#sexuality').val(data.gender);
            },
            error:function(data){
                console.log(data);
            } 
        });
    });

    // update actor
    $('#actor_update').on('click', function() {
        var id = $('#actor_id').val();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var ages = $('#ages').val();
        var sexuality = $('#sexuality').val();

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

        if(ages == "") {
            alert("Age cannot be empty!");
            return;
        } else if(!$.isNumeric(ages)) {
            alert('Please enter valid age');
            return;
        }

        if(sexuality== "") {
            alert("This field is required!");
            return;
        }

        $.ajax({
            url: "{{ url('actors/update') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                idActor: $('#actor_id').val(),
                first_name: $('#fname').val(),
                last_name: $('#lname').val(),
                age: $('#ages').val(),
                Gender: $('#sexuality').val()
            },
            method:"post",
            dataType:"json",
            success:function(e){
                alert("Successfully updated the actor!");
                location.reload();
            },
            error:function(e){
                console.log(e);
            }
        });
    });



    $(document).on('click', '#actor_delete[data-id]', function() {
        $.ajax({
            url: "{{ url('actors/delete') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                act_id: $(this).data('id'),
            },
            method:"post",
            dataType:"json",
            success:function(e){
                alert("Successfully deleted actor!");
                location.reload();
            },
            error:function(e){
                console.log(e);
            }
        });
    });
    

    //search function for actors
    $('#searchText').keyup(function(e) {
        e.preventDefault();
        var txt = $(this).val();
        
        if(e.keyCode === 27) {
            $(this).val('');
        }

        $.ajax({
            url: "{{ route('actor.actor_search') }}",
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
                    var count = 6;
                    html += '<tr>';
                    html += '<td colspan="'+count+'" style="text-align:center;">Sorry, No actor record found!</td>';
                    html += '<tr>';
                } else {
                    var gender = '';
                    $.each(data, function(key, value) {
                        if(value.gender == 0) {
                            gender = "Male";
                        } else {
                            gender = "Female";
                        }
                        html += '<tr>';
                        html += '<td>'+value.id+'</td>';
                        html += '<td><span class="badge badge-success" style="font-size: 16px; font-family: century gothic; background-color: rgb(3, 165, 173);">'+value.firstname+'</span></td>';
                        html += '<td><span class="badge badge-success" style="font-size: 16px; font-family: century gothic; background-color: rgb(3, 165, 173);">'+value.lastname+'</span></td>';
                        html += '<td><span class="badge badge-success" style="font-size: 16px; font-family: century gothic; background-color: rgb(3, 165, 173);">'+value.age+' years old</span></td>';
                        html += '<td><span class="badge badge-success" style="font-size: 16px; font-family: century gothic; background-color: rgb(3, 165, 173);">'+gender+'</span></td>';
                        html += '<td><button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="actor_edit" data-id="'+value.id+'"><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn btn-danger btn-sm" style="color:white; font-family: century gothic;" id="actor_delete" data-id="'+value.id+'"><i class="fa fa-trash"></i> Remove</button></td>'
                        html += '<tr>';
                    })
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
