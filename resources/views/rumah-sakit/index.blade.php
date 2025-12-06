@extends('layouts.app')
@section('title','Rumah Sakit')
@section('content')
<div class="row mt-4">
     <div class="col-12">
          <div class="card">
               <div class="card-header">
                    <h3>Rumah Sakit</h3>
               </div>
               <div class="card-body">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRs">Tambah</button>
                    <hr>
                    <div class="table-responsive">
                         <table class="table table-striped" id="tabel-rumah-sakit">
                              <thead>
                                   <th width="10">No</th>
                                   <th>Nama Rumah Sakit</th>
                                   <th>Alamat</th>
                                   <th>Email</th>
                                   <th>Telepon</th>
                                   <th width="100">#</th>
                              </thead>
                              <tbody></tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- Button trigger modal -->

{{-- Modal Tambah --}}
<div class="modal fade" id="modalRs" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalRsLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="modalRsLabel">Tambah Rumah Sakit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form id="formTambahRs">
                         @csrf
                         <div class="mb-3">
                              <label for="nama_rumah_sakit" class="form-label">Nama Rumah Sakit</label>
                              <input type="text" name="nama_rumah_sakit" class="form-control" id="nama_rumah_sakit" required>
                         </div>
                         <div class="mb-3">
                              <label for="alamat" class="form-label">Alamat</label>
                              <input type="text" name="alamat" class="form-control" id="alamat" required>
                         </div>
                         <div class="mb-3">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" name="email" class="form-control" id="email" required>
                         </div>
                         <div class="mb-3">
                              <label for="telepon" class="form-label">Telepon</label>
                              <input type="text" name="telepon" class="form-control" id="telepon" required>
                         </div>
                         <hr>
                         <div class="mb-3">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary" id="btnSimpanRs">Simpan</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Rumah Sakit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form id="editRsForm" method="POST">
                         @csrf
                         @method('PUT')
                         <input type="hidden" name="id" id="edit_id">
                         <div class="mb-3">
                              <label for="edit_nama_rumah_sakit" class="form-label">Nama Rumah Sakit</label>
                              <input type="text" name="nama_rumah_sakit" class="form-control" id="edit_nama_rumah_sakit" required>
                         </div>
                         <div class="mb-3">
                              <label for="edit_alamat" class="form-label">Alamat</label>
                              <input type="text" name="alamat" class="form-control" id="edit_alamat" required>
                         </div>
                         <div class="mb-3">
                              <label for="edit_email" class="form-label">Email</label>
                              <input type="email" name="email" class="form-control" id="edit_email" required>
                         </div>
                         <div class="mb-3">
                              <label for="edit_telepon" class="form-label">Telepon</label>
                              <input type="text" name="telepon" class="form-control" id="edit_telepon" required>
                         </div>
                         <hr>
                         <div class="mb-3">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Update</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

@endsection
@push('script')
     <script>
          $(document).ready(function(){
               $('#tabel-rumah-sakit').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('rumah-sakit.index') }}",
                    columns: [
                              { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
                              { data: 'nama_rumah_sakit', name: 'nama_rumah_sakit' },
                              { data: 'alamat', name: 'alamat' },
                              { data: 'email', name: 'email' },
                              { data: 'telepon', name: 'telepon' },
                              { data: 'action', name: 'action', orderable: false, searchable: false }
                         ]
               });
          });
     </script>

{{-- Tambah --}}
<script>
     $(document).ready(function() {
          $("#formTambahRs").on("submit", function(e) {
               e.preventDefault();

               let formData = {
                    nama_rumah_sakit: $("#nama_rumah_sakit").val(),
                    alamat: $("#alamat").val(),
                    email: $("#email").val(),
                    telepon: $("#telepon").val(),
                    _token: "{{ csrf_token() }}"
               };

               $.ajax({
                    url: "{{ route('rumah-sakit.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                         Swal.fire({
                              icon: "success",
                              title: "Berhasil",
                              text: "Data rumah sakit berhasil ditambahkan!",
                         });

                         $("#modalRs").modal("hide");
                         $("#formTambahRs")[0].reset();
                         $("#tabel-rumah-sakit").DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                         Swal.fire({
                              icon: "error",
                              title: "Gagal!",
                              text: xhr.responseJSON.message ?? "Terjadi kesalahan.",
                         });
                    }
               });
          });
     });
</script>

{{-- Edit --}}
<script>
     $(document).ready(function () {
          $(document).on('click', '.btn-edit', function () {
               let id = $(this).data('id');

               $("#edit_id").val(id);
               $("#edit_nama_rumah_sakit").val($(this).data('nama'));
               $("#edit_alamat").val($(this).data('alamat'));
               $("#edit_email").val($(this).data('email'));
               $("#edit_telepon").val($(this).data('telepon'));

               $("#editModal").modal("show");
          });

          // Submit update AJAX
          $("#editRsForm").on("submit", function(e) {
               e.preventDefault();

               let id = $("#edit_id").val();

               let formData = {
                    nama_rumah_sakit: $("#edit_nama_rumah_sakit").val(),
                    alamat: $("#edit_alamat").val(),
                    email: $("#edit_email").val(),
                    telepon: $("#edit_telepon").val(),
                    _method: "PUT",
                    _token: "{{ csrf_token() }}",
               };

               $.ajax({
                    url: "/rumah-sakit/" + id,
                    type: "POST",
                    data: formData,
                    success: function(response) {
                         Swal.fire({
                              icon: "success",
                              title: "Berhasil",
                              text: "Data berhasil diperbarui!",
                         });

                         $("#editModal").modal("hide");
                         $("#tabel-rumah-sakit").DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                         Swal.fire({
                              icon: "error",
                              title: "Gagal!",
                              text: xhr.responseJSON.message ?? "Terjadi kesalahan.",
                         });
                    }
               });
          });

     });
</script>

<script>
     function alert_delete(rsId) {
          Swal.fire({
               title: "Are you sure?",
               text: "Data tersebut akan dihapus.",
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Delete!"
          }).then((result) => {
               if (result.isConfirmed) {
                    $.ajax({
                         url: '/rumah-sakit/' + rsId,
                         type: 'POST',
                         data: {
                              _method: 'DELETE',
                              _token: '{{ csrf_token() }}'
                         },
                         success: function(response) {
                              Swal.fire({
                              title: "Deleted!",
                              text: response.message,
                              icon: "success"
                              });
                              $('#tabel-rumah-sakit').DataTable().ajax.reload();
                         },
                         error: function() {
                              Swal.fire({
                              title: "Failed!",
                              text: "Terjadi kesalahan saat menghapus.",
                              icon: "error"
                              });
                         }
                    });
               }
          });
     }
</script>
@endpush