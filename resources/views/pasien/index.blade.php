@extends('layouts.app')
@section('title','Pasien')
@section('content')
<div class="row mt-4">
     <div class="col-12">
          <div class="card">
               <div class="card-header">
                    <h3>Pasien</h3>
               </div>
               <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPasien">
                              Tambah
                         </button>
                         <div class="d-flex align-items-center">
                              <label for="filter_rs" class="me-2 mb-0">Filter:</label>
                              <select id="filter_rs" class="form-control select2" style="min-width: 220px;">
                                   <option value="">-- Semua Rumah Sakit --</option>
                                   @foreach($rs as $r)
                                        <option value="{{ $r->id }}">{{ $r->nama_rumah_sakit }}</option>
                                   @endforeach
                              </select>
                         </div>
                    </div>

                    <hr>
                    <div class="table-responsive">
                         <table class="table table-striped" id="tabel-pasien">
                              <thead>
                                   <th width="10">No</th>
                                   <th>Nama Pasien</th>
                                   <th>Alamat</th>
                                   <th>Telepon</th>
                                   <th>Rumah Sakit</th>
                                   <th width="100">#</th>
                              </thead>
                              <tbody></tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalPasien" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               
               <div class="modal-header">
                    <h5 class="modal-title">Tambah Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
               </div>

               <div class="modal-body">
                    <form id="formTambahPasien">
                         @csrf

                         <div class="mb-3">
                              <label class="form-label">Rumah Sakit</label>
                              <select name="rumah_sakit_id" id="rumah_sakit_id" class="form-control select2" required>
                                   <option value="">-- Pilih --</option>
                                   @foreach($rs as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_rumah_sakit }}</option>
                                   @endforeach
                              </select>
                         </div>

                         <div class="mb-3">
                              <label class="form-label">Nama Pasien</label>
                              <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" required>
                         </div>

                         <div class="mb-3">
                              <label class="form-label">Alamat</label>
                              <input type="text" name="alamat" id="alamat" class="form-control" required>
                         </div>

                         <div class="mb-3">
                              <label class="form-label">Telepon</label>
                              <input type="text" name="telepon" id="telepon" class="form-control" required>
                         </div>

                         <hr>
                         <div class="mb-3">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                         </div>

                    </form>
               </div>

          </div>
     </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="editPasienModal" tabindex="-1">
     <div class="modal-dialog">
          <div class="modal-content">

               <div class="modal-header">
                    <h5 class="modal-title">Edit Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
               </div>

               <div class="modal-body">
                    <form id="editPasienForm">
                         @csrf
                         @method('PUT')

                         <input type="hidden" name="id" id="edit_id">

                         <div class="mb-3">
                              <label class="form-label">Rumah Sakit</label>
                              <select id="edit_rumah_sakit_id" class="form-control select2" required>
                                   @foreach($rs as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_rumah_sakit }}</option>
                                   @endforeach
                              </select>
                         </div>

                         <div class="mb-3">
                              <label class="form-label">Nama Pasien</label>
                              <input type="text" id="edit_nama_pasien" class="form-control" required>
                         </div>

                         <div class="mb-3">
                              <label class="form-label">Alamat</label>
                              <input type="text" id="edit_alamat" class="form-control" required>
                         </div>

                         <div class="mb-3">
                              <label class="form-label">Telepon</label>
                              <input type="text" id="edit_telepon" class="form-control" required>
                         </div>

                         <hr>
                         <div>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Update</button>
                         </div>

                    </form>
               </div>

          </div>
     </div>
</div>

@endsection

@push('css')
@endpush
@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- Datatable --}}
<script>
     $(document).ready(function() {
          var table = $('#tabel-pasien').DataTable({
               processing: true,
               serverSide: true,
               ajax: {
                    url: "{{ route('pasien.index') }}",
                    data: function(d) {
                         d.rumah_sakit_id = $('#filter_rs').val();
                    }
               },
               columns: [
                    { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                    { data: 'nama_pasien' },
                    { data: 'alamat' },
                    { data: 'telepon' },
                    { data: 'rs.nama_rumah_sakit' },
                    { data: 'action', orderable: false, searchable: false }
               ]
          });

          $('#filter_rs').change(function() {
               table.ajax.reload();
          });
     });
</script>

{{-- Tambah --}}
<script>
$(document).ready(function() {

     $("#formTambahPasien").submit(function(e) {
          e.preventDefault();

          $.ajax({
               url: "{{ route('pasien.store') }}",
               type: "POST",
               data: $(this).serialize(),
               success: function(res) {
                    Swal.fire("Berhasil", "Data pasien berhasil ditambahkan!", "success");

                    $("#modalPasien").modal("hide");
                    $("#formTambahPasien")[0].reset();
                    $("#tabel-pasien").DataTable().ajax.reload();
               },
               error: function(xhr) {
                    Swal.fire("Gagal!", xhr.responseJSON.message ?? "Terjadi kesalahan.", "error");
               }
          });
     });

});
</script>

{{-- Edit --}}
<script>
$(document).ready(function () {

     $(document).on('click', '.btn-edit', function () {
          $("#edit_id").val($(this).data('id'));
          let rsID = $(this).data('rs');
          $("#edit_rumah_sakit_id").val(rsID).trigger('change');
          $("#edit_nama_pasien").val($(this).data('nama'));
          $("#edit_alamat").val($(this).data('alamat'));
          $("#edit_telepon").val($(this).data('telepon'));
          $("#editPasienModal").modal("show");
     });

     $("#editPasienForm").submit(function(e) {
          e.preventDefault();

          let id = $("#edit_id").val();

          $.ajax({
               url: "/pasien/" + id,
               type: "POST",
               data: {
                    rumah_sakit_id: $("#edit_rumah_sakit_id").val(),
                    nama_pasien: $("#edit_nama_pasien").val(),
                    alamat: $("#edit_alamat").val(),
                    telepon: $("#edit_telepon").val(),
                    _method: "PUT",
                    _token: "{{ csrf_token() }}"
               },
               success: function(res) {
                    Swal.fire("Berhasil", "Data pasien berhasil diperbarui!", "success");
                    $("#editPasienModal").modal("hide");
                    $("#tabel-pasien").DataTable().ajax.reload();
               },
               error: function(xhr) {
                    Swal.fire("Gagal!", xhr.responseJSON.message ?? "Terjadi kesalahan.", "error");
               }
          });
     });

});
</script>

{{-- Delete --}}
<script>
     function alert_delete(pasienId) {
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
                         url: '/pasien/' + pasienId,
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
                              $('#tabel-pasien').DataTable().ajax.reload();
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

<script>
// INIT SELECT2 ======================================
$(document).ready(function() {

     // Select2 untuk modal Tambah
     $('#rumah_sakit_id').select2({
          dropdownParent: $('#modalPasien'),
          width: '100%'
     });

     // Select2 untuk modal Edit
     $('#edit_rumah_sakit_id').select2({
          dropdownParent: $('#editPasienModal'),
          width: '100%'
     });

     $('#filter_rs').select2();
});

</script>
@endpush
