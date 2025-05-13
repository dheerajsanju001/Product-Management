@extends('layout.content')
@section('contents')
    <div class="container">
        <span class="fs-1">Product-Listing</span>
        <button type="button" class="btn btn-outline-primary float-end mt-3" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">Add <i class="fa-solid fa-circle-plus"></i></button>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productform" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
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
                            <div class="mb-3 col-md-6">
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
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Size</label>
                                <select class="form-select" name="size_id" id="size_id" aria-label="Default select example"
                                    required>
                                    <option value="">Select Size</option>
                                    @if(isset($sizeDropdown))
                                        @foreach ($sizeDropdown as $size)
                                            <option value="{{$size->id}}">{{$size->size}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="Product Status" class="form-label">Product Status</label>
                                <select class="form-select" name="status" id="status" aria-label="Default select example"
                                    required>
                                    <option value="">Select Product Status</option>
                                    <option value="1">In-Stock</option>
                                    <option value="0">Out-Stock</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="EG:Hex Nuts"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Product Description</label>
                            <input type="text" name="description" id="description" class="form-control"
                                placeholder="EG:Hex Nuts" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="productbtn">Create</button>
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
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Size</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($product))
                    @foreach ($product as $products)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$products->name}}</td>
                            <td>{{$products->description}}</td>
                            <td>{{$products->category->category}}</td>
                            <td>{{$products->subcategory->sub_category}}</td>
                            <td>{{$products->size->size}}</td>
                            <td>
                                @if($products->status == 1)
                                    <span class="badge bg-success">In-Stock</span>
                                @else
                                    <span class="badge bg-danger">Out-Stock</span>
                                @endif
                            </td>

                            <td><a href="javascript:void(0)" class="editproductbtn btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#producteditModal" data-id="{{ $products->id }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            <td> <a href="javascript:void(0)" class="deleteproductbtn btn btn-primary"
                                    data-id="{{ $products->id }}"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>S.No</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Size</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="modal fade" id="producteditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productform" method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" id="product_id" name="product_id" />
                            <div class="mb-3 col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Category</label>
                                <select class="form-select" name="edit_category_id" id="edit_category_id"
                                    aria-label="Default select example" required>
                                    <option value="">Select Category</option>
                                    @if(isset($categoryDropdown))
                                        @foreach ($categoryDropdown as $categories)
                                            <option value="{{$categories->id}}">{{$categories->category}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
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
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Size</label>
                                <select class="form-select" name="edit_size_id" id="edit_size_id"
                                    aria-label="Default select example" required>
                                    <option value="">Select Size</option>
                                    @if(isset($sizeDropdown))
                                        @foreach ($sizeDropdown as $size)
                                            <option value="{{$size->id}}">{{$size->size}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="Product Status" class="form-label">Product Status</label>
                                <select class="form-select" name="edit_status" id="edit_status"
                                    aria-label="Default select example" required>
                                    <option value="">Select Product Status</option>
                                    <option value="1">In-Stock</option>
                                    <option value="0">Out-Stock</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                            <input type="text" name="edit_name" id="edit_name" class="form-control"
                                placeholder="EG:Hex Nuts" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Product Description</label>
                            <input type="text" name="edit_description" id="edit_description" class="form-control"
                                placeholder="EG:Hex Nuts" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="updateproductbtn">Update</button>
                    </form>
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
        document.getElementById('productbtn').addEventListener('click', function () {
            const category_id = document.getElementById('category_id').value;
            const subcategory_id = document.getElementById('subcategory_id').value;
            const size_id = document.getElementById('size_id').value;
            const name = document.getElementById('name').value;
            const description = document.getElementById('description').value;
            const status = document.getElementById('status').value;

            fetch('/createproduct', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    category_id: category_id,
                    subcategory_id: subcategory_id,
                    size_id: size_id,
                    name: name,
                    description: description,
                    status: status
                })
            })
                .then(response => response.json())
                .then(data => {
                    toastr.success('Product added successfully!');
                    $('#productform').modal('hide');
                    location.reload();

                })
                .catch(error => {
                    console.error('Error occurred!:', error);
                    toastr.error('Failed to add product.');
                });
        });
        var table = $('#example').DataTable();
        $('#example').on('click', '.deleteproductbtn', function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            fetch(`destroyproduct/${id}`, {
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
                    toastr.success('Product deleted successfully');
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    toastr.error('Something Went Wrong');
                });
        });
        $('#example').on('click', '.editproductbtn', function () {
            const id = $(this).data('id');
            fetch(`/product/${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    $('#product_id').val(data.id);
                    $('#edit_size_id').val(data.size_id);
                    $('#edit_category_id').val(data.category_id);
                    $('#edit_subcategory_id').val(data.subcategory_id);
                    $('#edit_name').val(data.name);
                    $('#edit_status').val(data.status);
                    $('#edit_description').val(data.description);
                    $('#submitBtn').text('Update');
                })
                .catch(error => {
                    console.error('Error fetching subcategory:', error);
                    toastr.error('Failed to fetch subcategory data.');
                });
        });
        $('#updateproductbtn').on('click', function () {
            const id = $('#product_id').val();
            fetch(`/productupdate/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    size_id: $('#edit_size_id').val(),
                    category_id: $('#edit_category_id').val(),
                    subcategory_id: $('#edit_subcategory_id').val(),
                    name: $('#edit_name').val(),
                    status: $('#edit_status').val(),
                    description: $('#edit_description').val()
                })
            })
                .then(response => {
                    if (!response.ok) throw new Error('Update failed');
                    return response.json();
                })
                .then(data => {
                    toastr.success('Product updated successfully!');
                    $('#editProductModal').modal('hide');
                    location.reload();
                })
                .catch(error => {
                    console.error('Update error:', error);
                    toastr.error('Failed to update product.');
                });
        });
    });
</script>