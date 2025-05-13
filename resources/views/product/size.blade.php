@extends('layout.content')
@section('contents')
    <div class="container">
        <span class="fs-1">Size-Listing</span>
        <button type="button" class="btn btn-outline-primary float-end mt-3" data-bs-toggle="modal"
            data-bs-target="#sizemodal">Add <i class="fa-solid fa-circle-plus"></i></button>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="sizemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Size</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="sizeform" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Category</label>
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
                            <label for="exampleFormControlInput1" class="form-label">Sub Category</label>
                            <select class="form-select" name="subcategory_id" id="subcategory_id"
                                aria-label="Default select example" required>
                                <option value="">Select sub Category</option>
                                @if(isset($subCategoryDropdown))
                                    @foreach ($subCategoryDropdown as $subcategories)
                                        <option value="{{$subcategories->id}}">{{$subcategories->sub_category}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Size</label>
                            <input type="text" name="size" id="size" class="form-control" placeholder="EG:Hex Nuts"
                                required>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="min" class="form-label">Min</label>
                                <input type="number" name="min" id="min" class="form-control" placeholder="EG: 5" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="max" class="form-label">Max</label>
                                <input type="number" name="max" id="max" class="form-control" placeholder="EG: 10" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="sizebtn">Create</button>
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
                    <th>Size</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Minimum</th>
                    <th>Maximum</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($size))
                    @foreach ($size as $sizes)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$sizes->category->category}}</td>
                            <td>{{$sizes->subcategory->sub_category}}</td>
                            <td>{{$sizes->size}}</td>
                            <td>{{$sizes->min}}</td>
                            <td>{{$sizes->max}}</td>
                            <td><a href="javascript:void(0)" class="editsizebtn btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#sizeeditModal" data-id="{{ $sizes->id }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td> <a href="javascript:void(0)" class="deletesizebtn btn btn-primary" data-id="{{ $sizes->id }}"><i
                                        class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>S.No</th>
                    <th>Size</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Minimum</th>
                    <th>Maximum</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="modal fade" id="sizeeditModal" tabindex="-1" aria-labelledby="subcategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="subcategoryModalLabel">Edit Size</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="sizeForm">
                        @csrf
                        <!-- Hidden ID Field -->
                        <input type="hidden" id="edit_size_id" name="edit_size_id" />

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
                            <label for="exampleFormControlInput1" class="form-label">Sub Category</label>
                            <select class="form-select" name="edit_subcategory_id" id="edit_subcategory_id"
                                aria-label="Default select example" required>
                                <option value="">Select sub Category</option>
                                @if(isset($subCategoryDropdown))
                                    @foreach ($subCategoryDropdown as $subcategories)
                                        <option value="{{$subcategories->id}}">{{$subcategories->sub_category}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Size</label>
                            <input type="text" name="edit_size" id="edit_size" class="form-control"
                                placeholder="EG:Hex Nuts" required>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="min" class="form-label">Min</label>
                                <input type="number" name="edit_min" id="edit_min" class="form-control" placeholder="EG: 5"
                                    required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="max" class="form-label">Max</label>
                                <input type="number" name="edit_max" id="edit_max" class="form-control" placeholder="EG: 10"
                                    required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updatesizeBtn">Update</button>
                </div>

            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#example').DataTable({
            ordering: false
        });
        document.getElementById('sizebtn').addEventListener('click', function () {
            const category_id = document.getElementById('category_id').value;
            const subcategory_id = document.getElementById('subcategory_id').value;
            const size = document.getElementById('size').value;
            const min = document.getElementById('min').value;
            const max = document.getElementById('max').value;
            fetch('/createsize', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    category_id: category_id,
                    subcategory_id: subcategory_id,
                    size: size,
                    min: min,
                    max: max
                })
            })
                .then(response => response.json())
                .then(data => {
                    toastr.success('Size added successfully!');
                    $('#sizemodal').modal('hide');
                    location.reload();

                })
                .catch(error => {
                    console.error('Error occurred!', error);
                    toastr.error('Failed to add size.');
                });
        });
        var table = $('#example').DataTable();
        $('#example').on('click', '.deletesizebtn', function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            fetch(`destroysize/${id}`, {
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
                    toastr.success('Size deleted successfully');
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    toastr.error('Something Went Wrong');
                });
        });
        $('#example').on('click', '.editsizebtn', function () {
            const id = $(this).data('id');
            fetch(`/sizes/${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    $('#edit_size_id').val(data.id);
                    $('#edit_category_id').val(data.category_id);
                    $('#edit_subcategory_id').val(data.subcategory_id);
                    $('#edit_size').val(data.size);
                    $('#edit_min').val(data.min);
                    $('#edit_max').val(data.max);
                    $('#submitBtn').text('Update');
                })
                .catch(error => {
                    console.error('Error fetching subcategory:', error);
                    toastr.error('Failed to fetch subcategory data.');
                });
        });
        $('#updatesizeBtn').on('click', function () {
            const id = $('#edit_size_id').val();
            fetch(`/sizeupdate/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    category_id: $('#edit_category_id').val(),
                    subcategory_id: $('#edit_subcategory_id').val(),
                    size: $('#edit_size').val(),
                    min: $('#edit_min').val(),
                    max: $('#edit_max').val()
                })
            })
                .then(response => {
                    if (!response.ok) throw new Error('Update failed');
                    return response.json();
                })
                .then(data => {
                    toastr.success('Size updated successfully!');
                    $('#editSizeModal').modal('hide');
                    location.reload();
                })
                .catch(error => {
                    console.error('Error updating size:', error);
                    toastr.error('Failed to update size.');
                });
        });

    });
</script>