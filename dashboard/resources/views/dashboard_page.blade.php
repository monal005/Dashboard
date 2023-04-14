@extends('layouts.app',['title'=>'Dashboard'])

@section('head-css')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
@section('content')

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>User Listing</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success mr-4" id="addUser" href="javascript:void(0)" style="float: right"> Sign Up</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card-body">
        <table class="table table-bordered" id="users">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>

                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
    <div class="modal fade" id="User-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="UserModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="UserForm" name="UserForm" class="form-horizontal" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name" maxlength="50" required="">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Email" maxlength="50" required="">

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter password" required="">

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="image" name="image"
                                    accept="image/*">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sectipe')
    <script type="text/javascript">
        $(function() {
            initDatatable();
        });


        function initDatatable() {
            userDataTable = $('#users').DataTable({
                processing: false,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },


                    {
                        data: 'image',
                        name: 'image',
                        // render: function (data, type, full, meta) {

                        //     return `<img src="${data}" height=\"50\"/>`;
                        //     // return data;

                        // }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    // { data: 'password', name: 'password' },
                    // { data: 'created_at', name: 'created_at' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });
        }

        $(document).on("click", "#addUser", function() {
            addUser();
        });

        function addUser() {
            $('#UserForm').trigger("reset");
            $('#UserModal').html("Add User");
            $('#User-modal').modal('show');
            $('#id').val('');
        }

        $('#UserForm').submit(async function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('users.store') }}";
            await createOrupdateUser(formData, url);

        });
        // const sweetAlert2 = {
        //     sweetAlert(title = 'sadf', text = 'ads', icon = 'success') {
        //         swal({
        //             title: title,
        //             text: text,
        //             icon: icon,
        //         });
        //     }
        // }

        function createOrupdateUser(formData, ServerUrl = '') {

            $.ajax({
                type: 'POST',
                url: ServerUrl,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    userDataTable.ajax.reload();
                    $("#User-modal").modal('hide');
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                    sweetAlert("user added", 'user added successfully!', 'success')
                },
                error: function(data) {
                    sweetAlert2.sweetAlert("Error", 'user not added!', 'warning')
                    console.log(data);
                }
            });
        }





        $(document).on('click', '.editPost', function() {
            var id = $(this).data('id');
            $.get(`/user/edit/${id}`, function(data) {
                $('#UserModal').html("Edit ");
                $('#btn-save').val("edit-user");
                $('#User-modal').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#btn-save').html('save');
                // $('#password').val(data.password);
            })



        });

        $('body').on('click', '.deletePost', function() {

            var id = $(this).data("id");
            // confirm("Are You sure want to delete!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('users.store') }}" + '/' + id,
                success: function(data) {
                    userDataTable.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });


        // $(document).on('click', '.viewPost', function() {
        //     var id = $(this).data('id');


            // $.ajax({
            //     url: "{{ route('view.index') }}"+'/'+id,
            //     success: function(data) {
            //         dd(data);
            //     }


            // });
            // $.get(`/view/${id}`, function(data) {
            //     echo $id;

            // })



        // });
    </script>
@endsection
