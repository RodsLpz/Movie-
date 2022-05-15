@extends('layouts.dashboard')
@section('content')
<div class="container">
        <div class="pull-right">
            <input type="text" name="search" id="searchText" class="form-control" placeholder="Search Genre...">
            <br>
        </div>
    <div class="col-md-12">
                <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="insertGen"><i class="fa fa-plus"></i> Add Genre</button>
                </div>
            <h2>Genres</h2> 
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="genre">
                        <thead style="background-color:#535E4B; color:white;">
                            <tr>
                                <th>ID</th>
                                <th>Genre Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="res">
                        </tbody>
                    </table>
                </div>
                <!-- Add Modal for Genre -->
                <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color: #9E9793; color:black;">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Genre</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">Genre Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="genre_name">
                                        <span style="color:blue; font-style: italic;" id="validate_genre_name_Req" class="validate_genre_name_Req">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validate_genre_name_Err" class="validate_genre_name_Err"></span>
                                        <span class="validate_genre_name_Ok" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validate_genre_name_Ok" class=""></span></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-sm" id="genre_save">Save</button>
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
                                        <input type="text" class="form-control" id="genre_id" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-md-3 col-form-label">Genre Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="genre_title">
                                        <span style="color:blue; font-style: italic; display: none;" id="validategenre_titleReq" class="validategenre_titleReq">This field is required</span>
                                        <span style="color:red; font-style: italic;" id="validategenre_titleErr" class="validategenre_titleErr"></span>
                                        <span class="validategenre_titleOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validategenre_titleOk" class=""></span></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-sm" id="genre_update">Save</button>
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
        // add modal validation
        $('#genre_name').keyup(function(e) {
            e.preventDefault();
            var genre_name = $(this).val();
            var minLength = 3;
            if(e.keyCode == 27 || genre_name == '') {
                $('.validate_genre_name_Ok').css('display', 'none');
                $('.validate_genre_name_Err').css('display', 'none');
                $('.validate_genre_name_Req').css('display', 'block');
            } else if($(this).val().length < minLength) {
                $('#validate_genre_name_Err').css('display', 'block');
                $('#validate_genre_name_Err').text('Please enter at least minimum of '+ minLength + ' characters')
                $('.validate_genre_name_Ok').css('display', 'none');
                $('.validate_genre_name_Req').css('display', 'none');
            } else {
                $('.validate_genre_name_Ok').css('display', 'block');
                $('#validate_genre_name_Ok').text('Ok')
                $('#validate_genre_name_Err').css('display', 'none');
                $('.validate_genre_name_Req').css('display', 'none');
            }
        });

        // edit modal validation
        $('#genre_title').keyup(function(e) {
            e.preventDefault();
            var genre_title = $(this).val();
            var minLength = 3;
            if(e.keyCode == 27 || genre_title == '') {
                $('.validategenre_titleOk').css('display', 'none');
                $('.validategenre_titleErr').css('display', 'none');
                $('.validategenre_titleReq').css('display', 'block');
                
            } else if($(this).val().length < minLength) {
                $('#validategenre_titleErr').css('display', 'block');
                $('#validategenre_titleErr').text('Please enter at least minimum of '+ minLength + ' characters')
                $('.validategenre_titleOk').css('display', 'none');
                $('.validategenre_titleReq').css('display', 'none');
            } else {
                $('.validategenre_titleOk').css('display', 'block');
                $('#validategenre_titleOk').text('Ok')
                $('#validategenre_titleErr').css('display', 'none');
                $('.validategenre_titleReq').css('display', 'none');
            }
        });
    })

    $(document).ready(function() {
        $.ajax({
            url: "{{ route('user.getAllGenres') }}",
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
                    html += '<td>'+value.genre_name+'</td>';
                    html += '<td><button type="button" class="btn btn-warning btn-sm" style="color:white; font-family: century gothic;" id="genre_edit" data-id="'+value.id+'"><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn btn-danger btn-sm" style="color:white; font-family: century gothic;" id="genre_delete" data-id="'+value.id+'"><i class="fa fa-trash"></i> Remove</button></td>';
                    html += '<tr>';
                })
                $('#genre').append(html);
            }
        });
    });

    $('#insertGen').on('click', function() {
        $('#insertModal').modal('show');
    });

    // save add genre
    $('#genre_save').on('click', function() {
        var genre_name = $('#genre_name').val();

        if(genre_name == "") {
            alert("This field is required!");
            return;
        } else if(genre_name.length < 3) {
            alert("Please enter at least minimum of 3 characters");
            return;
        }

        $.ajax({
            url: "{{ route('user.genre_save') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                genre_name:genre_name
           
            },
            method:"post",
            dataType:"json",
            success:function(e){
                    $('#insertModal').modal('hide');
                    alert("Successfully added new genre!");
                    var html = '';
                    html += '<tr>';
                    html += '<td>'+e.id+'</td>';
                    html += '<td>'+e.genre_name+'</td>';
                    html += '<td><button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="genre_edit" data-id="'+e.id+'"><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn btn-danger btn-sm" style="color:white; font-family: century gothic;" id="genre_delete" data-id="'+e.id+'"><i class="fa fa-trash"></i> Remove</button></td>'
                    html += '<tr>';
                    $('#genre').prepend(html);
                    location.reload(); 
            },
            error:function(e){
                console.log(e);
            }
        });
    });

    $(document).on('click', '#genre_edit[data-id]', function() {
        $('#editModal').modal('show');
        var id = $(this).data('id');

        $.ajax({
            url: "{{ route('user.genre_edit') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                id:id
            },
            method:"post",
            dataType:"json",
            success:function(e){
                $('#genre_id').val(e.id)
                $('#genre_title').val(e.genre_name);
            },
            error:function(e){
                console.log(e);
            }
        });
    });

    $('#genre_update').on('click', function() {
        $.ajax({
            url: "{{ url('genres/update') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                Gid: $('#genre_id').val(),
                Gname: $('#genre_title').val()
            },
            method:"post",
            dataType:"json",
            success:function(e){
                alert("Successfully updated genre!");
                location.reload();
            },
            error:function(e){
                console.log(e);
            }
        });
    });

    $(document).on('click', '#genre_delete[data-id]', function() {
        $.ajax({
            url: "{{ url('genres/delete') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                genre_id: $(this).data('id'),
            },
            method:"post",
            dataType:"json",
            success:function(e){
                alert("Successfully deleted genre!");
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
        
        //if esc is pressed or nothing is entered
        if(e.keyCode === 27) {
            $(this).val('');
        }

        $.ajax({
            url: "{{ route('genre.search') }}",
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
                    html += '<td colspan="'+count+'" style="text-align:center;">No record found!</td>';
                    html += '<tr>';
                } else {
                    $.each(data, function(key, value) {
                        html += '<tr>';
                        html += '<td>'+value.id+'</td>';
                        html += '<td><span class="badge badge-success" style="font-size: 16px; font-family: century gothic; background-color: rgb(3, 165, 173);">'+value.genre_name+'</span></td>';
                        html += '<td><button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="genre_edit" data-id="'+value.id+'"><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn btn-danger btn-sm" style="color:white; font-family: century gothic;" id="genre_delete" data-id="'+value.id+'"><i class="fa fa-trash"></i> Remove</button></td>'
                        html += '<tr>';
                    })
                }
                $('#res').append(html);
            },
            error:function(data){
                console.log(data);
            }
        });
    });
</script>
@endsection
