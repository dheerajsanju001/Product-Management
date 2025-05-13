@extends('layout.content')
@section('contents')
    <div class="container">
        <span class="fs-1">Remaining-Stock</span>
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
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <th>S.No</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Size</th>
                <th>Status</th>
            </tfoot>
        </table>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id">
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" id="edit_category" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select id="edit_status" class="form-select" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="categoryupdateBtn">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#example').DataTable({
            ordering: false
        });
        document.getElementById('createBtn').addEventListener('click', function () {
            const category = document.getElementById('category').value;
            const status = document.getElementById('status').value;

            fetch('/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    category: category,
                    status: status
                })
            })
                .then(response => response.json())
                .then(data => {
                    toastr.success('Category added successfully!');
                    $('#addForm').modal('hide');
                    location.reload();

                })
                .catch(error => {
                    toastr.error('Update failed.');
                });

        });

        var table = $('#example').DataTable();
        $('#example').on('click', '.deletebtn', function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            fetch(`destroy/${id}`, {
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
                    toastr.success('Record deleted successfully');
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    toastr.error('Something Went Wrong');
                });
        });
        $('#example').on('click', '.editcategorybtn', function () {
            const id = $(this).data('id');
            fetch(`/categoryedit/${id}`)
                .then(response => response.json())
                .then(data => {
                    $('#edit_id').val(data.id);
                    $('#edit_category').val(data.category);
                    $('#edit_status').val(data.status);
                    $('#editModal').modal('show');
                })
                .catch(error => {
                    console.error('Error fetching record:', error);
                    toastr.error('Failed to load record.');
                });
        });
        $('#categoryupdateBtn').on('click', function () {
            const id = $('#edit_id').val();
            const category = $('#edit_category').val();
            const status = $('#edit_status').val();

            fetch(`/categoryupdate/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    category: category,
                    status: status
                })
            })
                .then(response => {
                    if (!response.ok) throw new Error('Update failed');
                    return response.json();
                })
                .then(data => {
                    toastr.success('Category updated successfully!');
                    $('#editModal').modal('hide');
                    location.reload();
                })
                .catch(error => {
                    console.error('Error updating category:', error);
                    toastr.error('Update failed.');
                });
        });
    });
</script>