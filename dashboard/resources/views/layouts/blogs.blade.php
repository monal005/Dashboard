@extends('layouts.app',['title'=>'Dashboard'])

@section('head-css')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
@section('content')

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>BLog Listing</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success mr-4" id="addUser" href="javascript:void(0)" style="float:right">Add posts</a>
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
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
    <div class="modal fade" id="User-modal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="UserModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="UserForm" name="UserForm" class="form-horizontal" method="POST"
                        enctype="multipart/form-data">

                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Select User</label>
                            <div class="col-sm-12">
                                <select class="form-select form-select-sm" name="user_id" id="user_id"  >

                                    @foreach ($data as $row )

                                    <option value="{{$row->id}}">{{$row->name}} : {{$row->email}}</option>

                                    @endforeach
                                    </select>

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter title" maxlength="50" required="">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>



                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="description" name="description"
                                    placeholder="Enter title" maxlength="50" required="">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="image" name="image[]" multiple
                                    accept="image/*">

                            </div>

                            <div id="imagePreview"></div>
                        </div>


                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save
                            </button>
                        </div>
                        <div>

                            <div class="preview">

                            </div>

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
        //     $('#images').change(function () {
        // previewImages(this);
    });

        // });/


        function initDatatable() {
            userDataTable = $('#users').DataTable({
                processing: false,
                serverSide: true,
                ajax: "{{ route('blogs.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },



                    {
                        data: 'title',
                        name: 'title'
                    },


                    {
                        data: 'description',
                        name: 'description'
                    },

                    {
                        data: 'image',
                        name: 'image',
                    },
                    // { data: 'created_at', name: 'created_at' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order:[0,'desc']

            });
        }

        $(document).on("click", "#addUser", function() {
            addUser();
        });

        function addUser() {
            $('#UserForm').trigger("reset");
            $('#UserModal').html("Add Post");
            $('#User-modal').modal('show');
            $('#id').val('');
        }

        $('#UserForm').submit(async function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('blogs.store') }}";




            await createOrupdateUser(formData, url);

        });


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
                    sweetAlert("Blog Updated", 'Blog added successfully!', 'success')
                },
                error: function(data) {
                    sweetAlert2.sweetAlert("Error", 'Blog not Updated!', 'warning')
                    console.log(data);
                }
            });
        }





        $(document).on('click', '.editPost', function() {
            var id = $(this).data('id');
            $.get(`/blog/edit/${id}`, function(data) {
                $('#UserModal').html("Edit ");
                $('#btn-save').val("edit-user");
                $('#User-modal').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#title').val(data.title);
                $('#description').val(data.description);
                $('#image').val(data.image);
            })



        });

        $('body').on('click', '.deletePost', function() {

            var id = $(this).data("id");
            // confirm("Are You sure want to delete!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('blogs.store') }}" + '/' + id,
                success: function(data) {
                    userDataTable.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });



        function previewImages(input) {
    $('#imagePreview').html('');
    if (input.files && input.files.length) {
        var images = input.files;
        for (var i = 0; i < images.length; i++) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var html = '<div class="col-sm-4"><img src="' + e.target.result + '" class="img-fluid"></div>';
                $('#imagePreview').append(html);
            }
            reader.readAsDataURL(images[i]);
        }
    }
}

    </script>
@endsection
