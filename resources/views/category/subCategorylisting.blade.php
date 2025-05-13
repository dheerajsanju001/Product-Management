@extends('layout.content')
@section('contents')
    <div class="container">
        <span class="fs-1">SubCategory-Listing</span>
        <button type="button" class="btn btn-outline-primary float-end mt-3" data-bs-toggle="modal"
            data-bs-target="#subCategoryModal">Add <i class="fa-solid fa-circle-plus"></i></button>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="subCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Sub-Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="subCategoryForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControl  Input1" class="form-label">Category</label>
                            <select class="form-select" name="category_id" id="category_id"
                                aria-label="Default select example" required>
                                <option value="">Select Category</option>
                                @if(isset($categoryDropdown))
                                    @foreach ($categoryDropdown as $categories)
                                        <option value="{{$categories->id}}">{{$categories->category}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControl  Input1" class="form-label">Sub-Category</label>
                            <input type="text" name="sub_category" id="sub_category" class="form-control"
                                placeholder="Enter Subcategory" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControl  Input1" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status" aria-label="Default select example"
                                required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                        </div>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="createBtn">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Category</th>
                    <th>Sub-Category</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($subcategory))
                    @foreach ($subcategory as $subcategories)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$subcategories->category->category}}</td>
                            <td>{{$subcategories->sub_category}}</td>
                            <td>
                                @if($subcategories->status == '1')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td><a href="javascript:void(0)" class="editsubcategorybtn btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#subcategoryeditModal" data-id="{{ $subcategories->id }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td> <a href="javascript:void(0)" class="deletesubcategorybtn btn btn-primary"
                                    data-id="{{ $subcategories->id }}"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>S.No</th>
                    <th>Category</th>
                    <th>Sub-Category</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="modal fade" id="subcategoryeditModal" tabindex="-1" aria-labelledby="subcategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="subcategoryModalLabel">Edit Subcategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="subCategoryForm">
                        @csrf
                        <!-- Hidden ID Field -->
                        <input type="hidden" id="sub_category_id" name="sub_category_id" />

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="edit_category_id" id="edit_category_id" required>
                                <option value="">Select Category</option>
                                @if(isset($categoryDropdown))
                                    @foreach ($categoryDropdown as $categories)
                                        <option value="{{ $categories->id }}">{{ $categories->category }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sub-Category</label>
                            <input type="text" name="edit_sub_category" id="edit_sub_category" class="form-control"
                                placeholder="Enter Subcategory" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="edit_status" id="edit_status" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateSubcategoryBtn">Update</button>
                </div>

            </div>
        </div>
    </div>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#example').DataTable({
            ordering: false
        });
        document.getElementById('createBtn').addEventListener('click', function () {
            const category_id = document.getElementById('category_id').value;
            const sub_category = document.getElementById('sub_category').value;
            const status = document.getElementById('status').value;

            fetch('/createsubcategory', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    category_id: category_id,
                    sub_category: sub_category,
                    status: status
                })
            })
                .then(response => response.json())
                .then(data => {
                    toastr.success('Subcategory added successfully!');
                    $('#subCategoryForm').modal('hide');
                    location.reload();
                })
                .catch(error => {
                    console.error('Error occurred!:', error);
                    toastr.error('Failed to update subcategory.');
                });
        });

        var table = $('#example').DataTable();
        $('#example').on('click', '.deletesubcategorybtn', function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            fetch(`destroysubcategory/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    table.row($(e.target).parents('tr')).remove().draw();
                    toastr.success('Subcategory deleted successfully');
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    toastr.error('Something Went Wrong');
                });
        });

        $('#example').on('click', '.editsubcategorybtn', function () {
            const id = $(this).data('id');
            fetch(`/subcategories/${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data.sub_category)
                    $('#sub_category_id').val(data.id);
                    $('#edit_category_id').val(data.category_id);
                    $('#edit_sub_category').val(data.sub_category);
                    $('#edit_status').val(data.status);
                    $('#submitBtn').text('Update');
                })
                .catch(error => {
                    console.error('Error fetching subcategory:', error);
                    toastr.error('Failed to fetch subcategory data.');
                });
        });
        $('#updateSubcategoryBtn').on('click', function () {
            const id = $('#sub_category_id').val();

            fetch(`/subcategoryupdate/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    category_id: $('#edit_category_id').val(),
                    sub_category: $('#edit_sub_category').val(),
                    status: $('#edit_status').val()
                })
            })
                .then(response => {
                    if (!response.ok) throw new Error('Update failed');
                    return response.json();
                })
                .then(data => {
                    toastr.success('Subcategory updated successfully!');
                    $('#subcategoryeditModal').modal('hide');
                    location.reload();
                })
                .catch(error => {
                    console.error('Error updating subcategory:', error);
                    toastr.error('Failed to update subcategory.');
                });
        });

    });
</script>