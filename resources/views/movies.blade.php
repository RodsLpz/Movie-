@extends('layouts.dashboard')
@section('content')
<div class="container">
                <div class="pull-right">
                    <input type="text" name="search" id="searchText" class="form-control" placeholder="Search...">
                    <br>
                </div>
    <div class="col-md-12">
            <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="add_film"><i class="fa fa-plus"></i> Add Movie</button>
                </div>
            <h2>Movies</h2>
            <div class="row">
            
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="movies">
                        <thead style="background-color:#535E4B; color:white;">
                            <tr>
                                <th>ID</th>
                                <th>Movie Title</th>
                                <th style="width: 400px;">Synopsis</th>
                                <th>Date Released</th>
                                <th>Poster</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="res">
                        </tbody>
                    </table>
                </div>
            </div>

 <!-- view modal for Movie Details -->
 <div class="modal fade" id="viewmodal"tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true"> 
            <div class="modal-dialog" 
                 role="document"> 
                <div class="modal-content" style="background-color:#9E9793; color:black;"> 
                    <div class="modal-header" > 
                        <h5 class="modal-title w-100" 
                            id="exampleModalLabel"> 
                          Film Details
                      </h5> 
                        <button type="button"
                                class="close"
                                data-dismiss="modal" 
                                aria-label="Close"> 
                            <span aria-hidden="true"> 
                              × 
                          </span> 
                        </button> 
                    </div> 
                    <div class="modal-body"> 
                        <p style="text-align: center; font-size:16px;"><span id="filmtitle" style="font-weight: bold; font-size:22px;"></span></p><br>
                        <img src="#" id="img0" style="padding-left: 70px;width: 400px;"><br><br><br>
                        <p style="text-align: justify; font-size:14px;"> <strong>Summary:</strong><br> <span id="summary"></span></p>
                        <p style="text-align: justify; font-size:14px;"><strong>Date Release:<strong><br><span id="date"></span></p>                                                                                                           
                        <p>Country Release</p><h6 id="countryReleases"></h6>
                        <p style="text-align: left;">Actors:<br><span id="actor"></span></p>
                        <p style="text-align: left;">Producer:<br> <span id="producer" style="font-weight: bold;"></span></p>
                        <p style="text-align: left;">Genre: <span id="genre" style="font-weight: bold;"></span></p>        
                    </div> 
                    <div class="modal-footer"> 
                     <button type="button"
                        class="btn btn-danger" 
                        data-dismiss="modal"> 
                          Close 
                      </button> 
                    </div> 
                </div> 
            </div> 
        </div> 
                <!-- Add Modal -->
                <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" >
                            <form method="post" id="save-movie-form" enctype="multipart/form-data" style="background-color: #9E9793; color:black;">
                                @csrf
                                <div class="modal-header " >
                                    <h4 class="modal-title" id="myModalLabel" >Add Movie</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Movie Title:</b></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="title" name="title">
                                            <span style="color:blue; font-style: italic;" id="validate_filmtitle_Req" class="validate_filmtitle_Req">This field is required</span>
                                            <span style="color:red; font-style: italic;" id="validate_filmtitle_Err" class="validate_filmtitle_Err"></span>
                                            <span class="validate_filmtitle_Ok" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validate_filmtitle_Ok" class=""></span></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" id="" class="row col-md-12 col-form-label">
                                            <b>Select Actors:&nbsp;&nbsp;</b>
                                            <span style="color:blue; font-style: italic;" id="validateactorsReq" class="validateactorsReq">This field is required</span>
                                            <span style="color:red; font-style: italic;" id="validateactorsErr" class="validateactorsErr"></span>
                                            <span class="validateactorsOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validateactorsOk" class=""></span></i></span>
                                        </label>
                                        <div id="actors">

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Producers:</b></label>
                                        <div class="col-md-12">
                                            <select class="form-control" id="producers" name="producers">

                                            </select>
                                            <span style="color:blue; font-style: italic;" id="validate_filmprod_Req" class="validate_filmprod_Req">This field is required</span>
                                            <span style="color:red; font-style: italic;" id="validate_filmprod_Err" class="validate_filmprod_Err"></span>
                                            <span class="validate_filmprod_Ok" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validate_filmprod_Ok" class=""></span></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Genre:</b></label>
                                        <div class="col-md-12">
                                            <select class="form-control" id="genres" name="genres">

                                            </select>
                                            <span style="color:blue; font-style: italic;" id="validate_filmgenre_Req" class="validate_filmgenre_Req">This field is required</span>
                                            <span style="color:red; font-style: italic;" id="validate_filmgenre_Err" class="validate_filmgenre_Err"></span>
                                            <span class="validate_filmgenre_Ok" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validate_filmgenre_Ok" class=""></span></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Date Release:</b></label>
                                        <div class="col-md-12">
                                            <input type="date" class="form-control" id="date_released" name="date_released">
                                            <span style="color:blue; font-style: italic;" id="validatedateReleaseReq" class="validatedateReleaseReq">This field is required</span>
                                            <span style="color:red; font-style: italic;" id="validatedateReleaseErr" class="validatedateReleaseErr"></span>
                                            <span class="validatedateReleaseOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validatedateReleaseOk" class=""></span></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Country Release:</b></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="countryRelease" name="countryRelease">
                                            <span style="color:blue; font-style: italic;" id="validatecountryReleaseReq" class="validatecountryReleaseReq">This field is required</span>
                                            <span style="color:red; font-style: italic;" id="validatecountryReleaseErr" class="validatecountryReleaseErr"></span>
                                            <span class="validatecountryReleaseOk" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validatecountryReleaseOk" class=""></span></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Image:</b></label>
                                        <div class="col-md-12">
                                            <input type="file" class="form-control" id="poster" name="poster">
                                            <span style="color:blue; font-style: italic;" id="validate_poster_Req" class="validate_poster_Req">This field is required</span>
                                            <span style="color:red; font-style: italic;" id="validate_poster_Err" class="validate_poster_Err"></span>
                                            <span class="validate_poster_Ok" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validate_poster_Ok" class=""></span></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Content:</b></label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" rows="7" id="plot" name="plot"></textarea>
                                            <span style="color:blue; font-style: italic;" id="validate_plot_Req" class="validate_plot_Req">This field is required</span>
                                            <span style="color:red; font-style: italic;" id="validate_plot_Err" class="validate_plot_Err"></span>
                                            <span class="validate_plot_Ok" style="color:green; font-style: italic; display: none;"><i class="fa fa-check-circle"> <span style="" id="validate_plot_Ok" class=""></span></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm" id="savefilm">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                 <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" id="edit-film-form" enctype="multipart/form-data" style="background-color: #9E9793; color:black;">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Edit Movie</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body" id="updateform">
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Movie Title:</b></label>
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control" id="film_id" name="film_id">
                                            <input type="text" class="form-control" id="film_titles" name="film_titles">
                                            <span style="color:red; font-style: italic;" id="validatemovietitleErr" class="validatemovietitleErr"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" id="" class="row col-md-12 col-form-label">
                                            <b>Select Actors:&nbsp;&nbsp;</b>
                                            <span style="color:red; font-style: italic;" id="validatemovieactorsErr" class="validatemovieactorsErr"></span>
                                        </label>
                                        <div id="film_actors">

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Producers:</b></label>
                                        <div class="col-md-12">
                                            <select class="form-control" id="film_producers" name="film_producers">

                                            </select>
                                            <span style="color:red; font-style: italic;" id="validatemovieproducersErr" class="validatemovieproducersErr"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Genre:</b></label>
                                        <div class="col-md-12">
                                            <select class="form-control" id="film_genres" name="film_genres">

                                            </select>
                                            <span style="color:red; font-style: italic;" id="validatemoviegenresErr" class="validatemoviegenresErr"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Date Release:</b></label>
                                        <div class="col-md-12">
                                            <input type="date" class="form-control" id="film_date_released" name="film_date_released">
                                            <span style="color:red; font-style: italic;" id="validatemoviedateReleaseErr" class="validatemoviedateReleaseErr"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Country Release:</b></label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="film_country" name="film_country">
                                            <span style="color:red; font-style: italic;" id="validatemoviecountryReleaseErr" class="validatemoviecountryReleaseErr"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Image:</b></label>
                                        <div class="col-md-12">
                                            <input type="file" class="form-control" id="film_posters" name="film_posters">
                                            <input type="hidden" class="form-control" id="old_poster" name="old_poster">
                                            <span style="color:red; font-style: italic;" id="validatemovieavatarErr" class="validatemovieavatarErr"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-md-12 col-form-label"><b>Content:</b></label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" rows="7" id="film_contents" name="film_contents"></textarea>
                                            <span style="color:red; font-style: italic;" id="validatemoviecontentErr" class="validatemoviecontentErr"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm" id="update_film">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var actor = [];
        $.ajax({
            url: "{{ route('user.getMovies') }}",
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
                    html += '<td>'+value.film_title+'</td>';
                    html += '<td>'+value.summary.substr(0, 300)+'...</td>';
                    html += '<td>'+value.release_date+'</td>';
                    html += '<td><img src="/img/film_posters/'+value.image+'" alt="..." class="img-responsive" style="width:100px; height:100px; "><br><br></td>';
                    html += '<td><button type="button" class="btn btn-warning btn-sm" style="color:white; font-family: century gothic;" id="view" data-id="'+value.id+'">View</button> <button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="edit_film" data-id="'+value.id+'">Edit</button> <button type="button" class="btn btn-danger btn-sm" style="color:white; font-family: century gothic;" id="delete_film" data-id="'+value.id+'">Remove</button></td>';
                    html += '<tr>';
                })
                $('#movies').append(html);
            }   
        });
    });

    // View specific movie details
    $(document).on('click', '#view[data-id]', function() {
        var id = $(this).data('id');
        $('#viewmodal').modal('show');
        $.ajax({
            url: "{{ route('user.view_film') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                id:id
            },
            method:"post",
            dataType:"json",
            success:function(e){
                console.log(e.film_title)
                var html = [];
                $('#actor').text("");
                $('#filmtitle').text(e.film_title);
                $('#img0').attr('src','/img/film_posters/'+e.image);
                $('#summary').text(e.summary);         
                $('#countryReleases').text(e.country);
                $('#date').text(moment(e.release_date).format("MMMM DD, YYYY"));
                $('#producer').text(e.first_name+" "+e.last_name);
                $('#genre').text(e.genre_name);
                $.each(e.actor, function(key, value) {
                    html.push(' <span style="font-weight: bold;">'+ value.firstname +' '+ value.lastname +'</span>');
                });
                $('#actor').append(html.join(','));
       
            },
            error:function(e){
                console.log(e);
            }
        });
    });

        // add modal validation
        $('#title').keyup(function(e) {
            e.preventDefault();


            var title = $(this).val();
            var minLength = 3;
            if(e.keyCode == 27 || title == '') {
                //if esc is pressed we want to clear the value of search box
                $('.validate_filmtitle_Ok').css('display', 'none');
                $('.validate_filmtitle_Err').css('display', 'none');
                $('.validate_filmtitle_Req').css('display', 'block');
            } else if($(this).val().length < minLength) {
                $('#validate_filmtitle_Err').css('display', 'block');
                $('#validate_filmtitle_Err').text('Please enter at least minimum of '+ minLength + ' characters')
                $('.validate_filmtitle_Ok').css('display', 'none');
                $('.validate_filmtitle_Req').css('display', 'none');
            } else {
                $('.validate_filmtitle_Ok').css('display', 'block');
                $('#validate_filmtitle_Ok').text('Ok')
                $('#validate_filmtitle_Err').css('display', 'none');
                $('.validate_filmtitle_Req').css('display', 'none');
            }
        });

        $('#producers').on('change', function(e) {
            e.preventDefault();
            var producers = $(this).val();
            if(producers == '') {
                $('.validate_filmprod_Ok').css('display', 'none');
                $('.validate_filmprod_Err').css('display', 'none');
                $('.validate_filmprod_Req').css('display', 'block');
            } else {
                $('.validate_filmprod_Ok').css('display', 'block');
                $('#validate_filmprod_Ok').text('Ok')
                $('#validate_filmprod_Err').css('display', 'none');
                $('.validate_filmprod_Req').css('display', 'none');
            }
        });

        $('#genres').on('change', function(e) {
            e.preventDefault();
            var genres = $(this).val();
            if(genres == '') {
                $('.validate_filmgenre_Ok').css('display', 'none');
                $('.validate_filmgenre_Err').css('display', 'none');
                $('.validate_filmgenre_Req').css('display', 'block');
            } else {
                $('.validate_filmgenre_Ok').css('display', 'block');
                $('#validate_filmgenre_Ok').text('Ok')
                $('#validate_filmgenre_Err').css('display', 'none');
                $('.validate_filmgenre_Req').css('display', 'none');
            }
        });

        $('#date_released').keyup(function(e) {
            e.preventDefault();
            var date = document.getElementById("date_released").value.split("/");
            var day = date[0];
            var month = date[1];
            var dateString = document.getElementById("dateRelease").value;
            var regex = /^(0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/;

            if (regex.test(dateString) || dateString.length == 0) {
                $('#validatedateReleaseErr').css('display', 'block');
                $('#validatedateReleaseErr').text('Invalid Date')
                $('.validatedateReleaseOk').css('display', 'none');
                $('.validatedateReleaseReq').css('display', 'none');
            } else {
                $('.validatedateReleaseOk').css('display', 'block');
                $('#validatedateReleaseOk').text('Ok')
                $('#validatedateReleaseErr').css('display', 'none');
                $('.validatedateReleaseReq').css('display', 'none');
            }
            if (day > 31) {
                $('#validatedateReleaseErr').css('display', 'block');
                $('#validatedateReleaseErr').text('Invalid Date')
                $('.validatedateReleaseOk').css('display', 'none');
                $('.validatedateReleaseReq').css('display', 'none');
            } 
            if (month > 12) {
                $('#validatedateReleaseErr').css('display', 'block');
                $('#validatedateReleaseErr').text('Invalid Date')
                $('.validatedateReleaseOk').css('display', 'none');
                $('.validatedateReleaseReq').css('display', 'none');
            } 
        });

        $('#countryRelease').keyup(function(e) {
            e.preventDefault();
            var countryRelease = $(this).val();
            var minLength = 2;
            if(e.keyCode == 27 || countryRelease == '') {
                $('.validatecountryReleaseOk').css('display', 'none');
                $('.validatecountryReleaseErr').css('display', 'none');
                $('.validatecountryReleaseReq').css('display', 'block');
            } else if($(this).val().length < minLength) {
                $('#validatecountryReleaseErr').css('display', 'block');
                $('#validatecountryReleaseErr').text('Please enter at least minimum of '+ minLength + ' characters')
                $('.validatecountryReleaseOk').css('display', 'none');
                $('.validatecountryReleaseReq').css('display', 'none');
            } else {
                $('.validatecountryReleaseOk').css('display', 'block');
                $('#validatecountryReleaseOk').text('Ok')
                $('#validatecountryReleaseErr').css('display', 'none');
                $('.validatecountryReleaseReq').css('display', 'none');
            }
        });
        $('#poster').on('change', function(e) {
            e.preventDefault();
            var maxSize = 1000000;
            var flmposter;
            var file = $(this).val();
            if(file != '') {
                flmposter = $('#poster')[0].files[0].size;
            }

            if(file == '') {
                $('.validate_poster_Ok').css('display', 'none');
                $('.validate_poster_Err').css('display', 'none');
                $('.validate_poster_Req').css('display', 'block');
            } else if (flmposter > maxSize) {
                $('#validate_poster_Err').css('display', 'block');
                $('#validate_poster_Err').text('File size is greater than 1mb')
                $('.validate_poster_Ok').css('display', 'none');
                $('.validate_poster_Req').css('display', 'none');
            } else {
                $('.validate_poster_Ok').css('display', 'block');
                $('#validate_poster_Ok').text('Ok')
                $('#validate_poster_Err').css('display', 'none');
                $('.validate_poster_Req').css('display', 'none');
            }
        });

        $('#plot').keyup(function(e) {
            e.preventDefault();
            var plot = $(this).val();
            if(e.keyCode == 27 || plot == '') {
                //if esc is pressed we want to clear the value of search box
                $('.validate_plot_Ok').css('display', 'none');
                $('.validate_plot_Err').css('display', 'none');
                $('.validate_plot_Req').css('display', 'block');
            } else {
                $('.validate_plot_Ok').css('display', 'block');
                $('#validate_plot_Ok').text('Ok')
                $('#validate_plot_Err').css('display', 'none');
                $('.validate_plot_Req').css('display', 'none');
            }
        });


        // edit modal validation
        $('#film_titles').keyup(function(e) {
            e.preventDefault();
            var film_titles = $(this).val();
            var minLength = 3;
            if(e.keyCode == 27 || film_titles == '') {
                //if esc is pressed we want to clear the value of search box
                $('.validatemovietitleErr').css('display','block');
                $('#validatemovietitleErr').text('This field is required')
            } else if($(this).val().length < minLength) {
                $('#validatemovietitleErr').css('display', 'block');
                $('#validatemovietitleErr').text('Please enter at least minimum of '+ minLength + ' characters')
            } else {
                $('#validatemovietitleErr').css('display', 'none');
            }
        });

        

        $('#film_producers').on('change', function(e) {
            e.preventDefault();
            var movieproducers = $(this).val();
            if(movieproducers == '') {
                $('.validatemovieproducersErr').css('display','block');
                $('#validatemovieproducersErr').text('This field is required')
            } else {
                $('#validatemovieproducersErr').css('display', 'none');
            }
        });

        $('#film_genres').on('change', function(e) {
            e.preventDefault();
            var moviegenres = $(this).val();
            if(moviegenres == '') {
                $('.validatemoviegenresErr').css('display','block');
                $('#validatemoviegenresErr').text('This field is required')
            } else {
                $('#validatemoviegenresErr').css('display', 'none');
            }
        });

        $('#film_date_released').keyup(function(e) {
            e.preventDefault();
            var date = document.getElementById("film_date_released").value.split("/");
            var day = date[0];
            var month = date[1];
            var dateString = document.getElementById("film_date_released").value;
            var regex = /^(0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/;

            if (regex.test(dateString) || dateString.length == 0) {
                $('#validatemoviedateReleaseErr').css('display', 'block');
                $('#validatemoviedateReleaseErr').text('Invalid Date')
            } else {
                $('#validatemoviedateReleaseErr').css('display', 'none');
            }
            if (day > 31) {
                $('#validatemoviedateReleaseErr').css('display', 'block');
                $('#validatemoviedateReleaseErr').text('Invalid Date')
            } 
            if (month > 12) {
                $('#validatemoviedateReleaseErr').css('display', 'block');
                $('#validatemoviedateReleaseErr').text('Invalid Date')
            } 
        });

        $('#film_country').keyup(function(e) {
            e.preventDefault();
            var moviecountryRelease = $(this).val();
            var minLength = 2;
            if(e.keyCode == 27 || moviecountryRelease == '') {
                //if esc is pressed we want to clear the value of search box
                $('.validatemoviecountryReleaseErr').css('display','block');
                $('.validatemoviecountryReleaseErr').text('This field is required')
            } else if($(this).val().length < minLength) {
                $('#validatemoviecountryReleaseErr').css('display', 'block');
                $('#validatemoviecountryReleaseErr').text('Please enter at least minimum of '+ minLength + ' characters')
            } else {
                $('#validatemoviecountryReleaseErr').css('display', 'none');
            }
        });

        $('#film_posters').on('change', function(e) {
            e.preventDefault();
            var maxSize = 1000000;
            var flmposter;
            var file = $(this).val();
            if(file != '') {
                flmposter = $('#film_posters')[0].files[0].size;
            }

            if(file == '') {
                $('.validatemovieavatarOk').css('display', 'none');
                $('.validatemovieavatarErr').css('display', 'none');
                $('.validatemovieavatarReq').css('display', 'block');
            } else if (flmposter > maxSize) {
                $('#validatemovieavatarErr').css('display', 'block');
                $('#validatemovieavatarErr').text('File size is greater than 1mb')
                $('.validatemovieavatarOk').css('display', 'none');
                $('.validatemovieavatarReq').css('display', 'none');
            } else {
                $('.validatemovieavatarOk').css('display', 'block');
                $('#validatemovieavatarOk').text('Ok')
                $('#validatemovieavatarErr').css('display', 'none');
                $('.validatemovieavatarReq').css('display', 'none');
            }
        });

        $('#film_contents').keyup(function(e) {
            e.preventDefault();
            var plot = $(this).val();
            if(e.keyCode == 27 || plot == '') {
                //if esc is pressed we want to clear the value of search box
                $('.validatemoviecontentOk').css('display', 'none');
                $('.validatemoviecontentErr').css('display', 'none');
                $('.validatemoviecontentReq').css('display', 'block');
            } else {
                $('.validatemoviecontentOk').css('display', 'block');
                $('#validatemoviecontentOk').text('Ok')
                $('#validatemoviecontentErr').css('display', 'none');
                $('.validatemoviecontentReq').css('display', 'none');
            }
        });


    // add functiions
    $('#add_film').on('click', function() {
        $('#insertModal').modal('show');

        $.ajax({
            url: "{{ route('user.add_film') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            method:"get",
            dataType:"json",
            success:function(e){
                var film_actors = '';
                var film_genres = '';
                var film_producers = '';
                // actors
                $.each(e[0], function(key, val) {
                    film_actors += '<div class="col-md-12 form-check">'
                    film_actors += '<input type="checkbox" class="form-check-input" id="actor_id" value="'+ val.id +'" name="actor_id[]">'
                    film_actors += '<label class="form-check-label" for="exampleCheck1">'+ val.firstname+' '+ val.lastname +'</label>'
                    film_actors += '</div>'
                });
                $('#actors').append(film_actors);

                //genre
                film_genres += '<option value="">Select Genre...</option>';
                $.each(e[1], function(key, val) {
                    film_genres += '<option value="'+val.id+'">'+val.genre_name+'</option>';
                });
                $('#genres').append(film_genres);

                // producers
                film_producers += '<option value="">Select Producer...</option>';
                $.each(e[2], function(key, val) {
                    film_producers += '<option value="'+val.id+'">'+val.first_name+' '+val.last_name+'</option>';
                });
                $('#producers').append(film_producers);

                $(':checkbox').change(function(e) {
                    var film_actor = $(':checkbox:checked').length
                    var minActorLength = 2;
                    if(film_actor == 0) {
                        $('.validateactorsOk').css('display', 'none');
                        $('.validateactorsErr').css('display', 'none');
                        $('.validateactorsReq').css('display', 'block');
                    } else if(film_actor < minActorLength) {
                        $('#validateactorsErr').css('display', 'block');
                        $('#validateactorsErr').text('Please select at least '+ minActorLength + ' actors')
                        $('.validateactorsOk').css('display', 'none');
                        $('.validateactorsReq').css('display', 'none');
                    } else {
                        $('.validateactorsOk').css('display', 'block');
                        $('#validateactorsOk').text('Ok')
                        $('#validateactorsErr').css('display', 'none');
                        $('.validateactorsReq').css('display', 'none');
                    }
                });
            },
            error:function(e){
                console.log(e);
            }
        });
    });

    //save movie function
    $('#save-movie-form').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        if($('#title').val() == "") {
            alert("This field is required");
            return;
        } else if($('#title').val().length < 3) {
            alert("Please enter at least minimum of 3 characters");
            return;
        }

        if($(':checkbox:checked').length == 0) {
            alert("This field is required");
            return;
        } else if($(':checkbox:checked').length < 2) {
            alert('Please select at least 2 actors');
            return;
        }

        if($('#producers').val() == "") {
            alert("This field is required");
            return;
        }

        if($('#genres').val() == "") {
            alert("This field is required");
            return;
        }

        if($('#date_released').val() == "") {
            alert("This field is required");
            return;
        }

        if($('#countryRelease').val() == "") {
            alert("This field is required");
            return;
        } else if($('#countryRelease').val().length < 2) {
            alert("Please enter at least minimum of 2 characters");
            return;
        }

        if($('#poster').val() == '') {
            alert("This field is required");
            return;
        } else if($('#poster')[0].files[0].size > 1000000) {
            alert("File size is greater than 1mb");
            return;
        }

        if($('#plot').val() == "") {
            alert("This field is required");
            return;
        }

        $.ajax({
            url: "{{ route('user.save_film') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: formData,
            processData: false,
            contentType: false,
            method:"post",
            dataType:"json",
            success:function(e){
                if(e.status == "OK")
                {
                    $('#addModal').modal('hide');
                    alert("Successfully added new movie!")
                    location.reload(); 
                }
                else
                {
                    alert(e.status);
                    location.reload();
                }
               
            },
            error:function(e){
                console.log(e);
            }
        });
    });

    // edit function
    $(document).on('click', '#edit_film[data-id]', function() {
        var id = $(this).data('id');
        $('#editModal').modal('show');
        $('.form-check-input').val('');

        $.ajax({
            url: "{{ route('user.edit_film') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                id: id
            },
            method:"post",
            dataType:"json",
            success:function(e){
                var actors = '';
                let final = e[3].actor.map(actor_id => actor_id.id);

                $('#film_titles').val(e[3].film_title)
                $('#film_id').val(e[3].id)
                $.each(e[0], function(key, val) {
                    if(final.indexOf(val.id) !== -1) {
                        actors += '<div class="col-md-12 form-check">';
                        actors += '<input type="checkbox" class="form-check-input" id="exampleCheck1" id="film_actor_id" value="'+ val.id +'" name="film_actor_id[]" checked>';
                        actors += '<label class="form-check-label" for="exampleCheck1">'+ val.firstname+' '+ val.lastname +'</label>';
                        actors += '</div>';
                    } else {
                        actors += '<div class="col-md-12 form-check">';
                        actors += '<input type="checkbox" class="form-check-input" id="exampleCheck1" id="film_actor_id" value="'+ val.id +'" name="film_actor_id[]">';
                        actors += '<label class="form-check-label" for="exampleCheck1">'+ val.firstname+' '+ val.lastname +'</label>';
                        actors += '</div>';
                    }
                });
                $('#film_actors').append(actors);

                //genre
                genres += '<option value="">Select Genre...</option>';
                $.each(e[1], function(key, val) {
                    genres += '<option value="'+val.id+'">'+val.genre_name+'</option>';
                });
                $('#film_genres').append(genres);
                $('#film_genres').val(e[3].gen_id);

                // producers
                producers += '<option value="">Select Producer...</option>';
                $.each(e[2], function(key, val) {
                    producers += '<option value="'+val.id+'">'+val.first_name+' '+val.last_name+'</option>';
                });
                $('#film_producers').append(producers);
                $('#film_producers').val(e[3].prod_id);

                $('#film_date_released').val(e[3].release_date)
                $('#film_country').val(e[3].country)
                $('#film_contents').val(e[3].summary)
                $('#old_poster').val(e[3].image)

                $(':checkbox').change(function(e) {
                    var actor = $(':checkbox:checked').length
                    var minActorLength = 2;
                    if(actor == 0) {
                        $('.validatemovieactorsErr').css('display', 'block');
                        $('#validatemovieactorsErr').text('This field is required')
                    } else if(actor < minActorLength) {
                        $('#validatemovieactorsErr').css('display', 'block');
                        $('#validatemovieactorsErr').text('Please select at least '+ minActorLength + ' actors')
                    } else {
                        $('#validatemovieactorsErr').css('display', 'none');
                    }
                });
            },
            error:function(e){
                console.log(e);
            }
        });
    });

 

    // update function
    $('#edit-film-form').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('user.update_film') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: formData,
            processData: false,
            contentType: false,
            method:"post",
            dataType:"json",
            success:function(e){
                if(e.status == "OK")
                {
                    $('#editModal').modal('hide');
                    alert("Successfully updated movie!")
                    location.reload(); 
                }
            },
            error:function(e){
                console.log(e);
            }
        });
    });

// Delete Script
$(document).on('click', '#delete_film[data-id]', function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            url: "{{ route('user.delete_film') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                id:id
            },
            method:"post",
            dataType:"json",
            success:function(e){
                if(e.status == "OK")
                {
                    alert("Successfully deleted movie "+e.film_title+"!");
                    location.reload();
                }
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
            url: "{{ route('movies.search') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                search: txt,
            },
            method:"post",
            dataType:"json",
            success:function(data){
                $("#movies").empty();
                var html = '';
                if(data == '') {
                    var count = 5;
                    html += '<tr>';
                    html += '<td colspan="'+count+'" style="text-align:center;">No mpovie record found!</td>';
                    html += '<tr>';
                } else {
                    $.each(data, function(key, value) {
                        html += '<tr>';
                        html += '<td>'+value.id+'</td>';
                        html += '<td><span class="badge badge-success" style="font-size: 16px; font-family: century gothic; background-color: rgb(3, 165, 173);">'+value.film_title+'</span></td>';
                        html += '<td><span class="badge badge-success" style="font-size: 16px; font-family: century gothic; background-color: rgb(3, 165, 173);">'+value.release_date+'</span></td>';
                        html += '<td><span class="badge badge-success" style="font-size: 16px; font-family: century gothic; background-color: rgb(3, 165, 173);">'+value.country+'</span></td>';
                        html += '<td>'+value.summary.substr(0, 300)+'...</td>';
                        html += '<td><img src="/img/film_posters/'+value.image+'" alt="..." class="img-responsive" style="width:100px; height:100px; "><br><br></td>';
                        html += '<td><button type="button" class="btn btn-primary btn-sm" style="color:white; font-family: century gothic;" id="edit_film" data-id="'+value.id+'"><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn btn-danger btn-sm" style="color:white; font-family: century gothic;" id="delete_film" data-id="'+value.id+'"><i class="fa fa-trash"></i> Remove</button></td>'
                        html += '<tr>';
                    });
                }
                $('#movies').append(html);
            },
            error:function(data){
                console.log(data);
            }
        });
    });


  
</script>
@endsection
