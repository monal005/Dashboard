@extends('layouts.app',['title'=>$title])

@section('content')

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{$title}}</h2>
            </div>
            {{-- <div class="pull-right mb-2">
                <a class="btn btn-success" id="addUser" href="javascript:void(0)"> Sign Up</a>
            </div> --}}
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card-body">
        <table class="table table-bordered" id="posts">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>title</th>
                    <th>description</th>

                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@section('sectipe')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(function() {
            initDatatable();
        });



        function initDatatable() {
        userDataTable = $('#posts').DataTable({
            processing: false,
            serverSide: true,
            ajax: "{{ route('view.index') }}",
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                data: 'name',
                name: 'name',

                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                // { data: 'password', name: 'password' },
                // { data: 'created_at', name: 'created_at' },
                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: false,
                //     searchable: false
                // },
            ],
            order: [
                [0, 'desc']
            ]
        });
    }
        // $(document).on("click", "#addUser", function() {
        //     addUser();
        // });

        // function addUser() {
        //     $('#UserForm').trigger("reset");
        //     $('#UserModal').html("Add User");
        //     $('#User-modal').modal('show');
        //     $('#id').val('');
        // }

        // $('#UserForm').submit(async function(e) {
        //     e.preventDefault();
        //     var formData = new FormData(this);
        //     var url = "{{ route('users.store') }}";
        //     await createOrupdateUser(formData, url);

        // });
        // const sweetAlert2 = {
        //     sweetAlert(title = 'sadf', text = 'ads', icon = 'success') {
        //         swal({
        //             title: title,
        //             text: text,
        //             icon: icon,
        //         });
        //     }
        // }

        // function createOrupdateUser(formData, ServerUrl = '') {

        //     $.ajax({
        //         type: 'POST',
        //         url: ServerUrl,
        //         data: formData,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: (data) => {
        //             userDataTable.ajax.reload();
        //             $("#User-modal").modal('hide');
        //             $("#btn-save").html('Submit');
        //             $("#btn-save").attr("disabled", false);
        //             sweetAlert("user added", 'user added successfully!', 'success')
        //         },
        //         error: function(data) {
        //             sweetAlert2.sweetAlert("Error", 'user not added!', 'warning')
        //             console.log(data);
        //         }
        //     });
        // }





        // $(document).on('click', '.editPost', function() {
        //     var id = $(this).data('id');
        //     $.get(`/user/edit/${id}`, function(data) {
        //         $('#UserModal').html("Edit ");
        //         $('#btn-save').val("edit-user");
        //         $('#User-modal').modal('show');
        //         $('#id').val(data.id);
        //         $('#name').val(data.name);
        //         $('#email').val(data.email);
        //         // $('#password').val(data.password);
        //     })



        // });

        // $('body').on('click', '.deletePost', function() {

        //     var id = $(this).data("id");
        //     // confirm("Are You sure want to delete!");

        //     $.ajax({
        //         type: "DELETE",
        //         url: "{{ route('users.store') }}" + '/' + id,
        //         success: function(data) {
        //             userDataTable.draw();
        //         },
        //         error: function(data) {
        //             console.log('Error:', data);
        //         }
        //     });
        // });


        // $(document).on('click', '.viewPost', function() {
        //     var id = $(this).data('id');


        //     // $.ajax({
        //     //     url: "{{ route('view.index') }}"+'/'+id,
        //     //     success: function(data) {
        //     //         dd(data);
        //     //     }


        //     // });
        //     // $.get(`/view/${id}`, function(data) {
        //     //     echo $id;

        //     // })



        // });

    </script>
@endsection
