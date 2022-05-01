<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <title>Non Racikan</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Aplikasi Resep</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('non_racikan.index') }}">Non Racikan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"href="{{ route('racikan.index') }}">Racikan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="h5">Non Racikan</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah</button>
            <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Non Racikan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formCreate" method="POST">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Obat</label>
                                    <div class="col-sm-8">
                                        <select name="obat_id" id="obat_id" class="form-control form-control-sm obat_id" style='width: 300px;'></select>
                                        <span class="text-danger small" id="obat_iderror"></span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Signa</label>
                                    <div class="col-sm-8">
                                        <select name="resep_id" id="resep_id" class="form-control form-control-sm resep_id" style='width: 300px;' ></select>
                                        <span class="text-danger small" id="resep_iderror"></span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Qty</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="qty" class="form-control form-control-sm" id="qty" placeholder="masukkan qty">
                                        <span class="text-danger small" id="qtyerror"></span>
                                    </div>
                                </div>
                                <br>
                                <div class="table-responsive">
                                    <h5 class="h5">Draft Resep</h5>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Nama Obat</th>
                                            <th>Signa</th>
                                            <th>Qty</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control form-control-sm" id="draftObat"></td>
                                            <td><input type="text" class="form-control form-control-sm" id="draftSigna"></td>
                                            <td><input type="text" class="form-control form-control-sm" id="draftQty"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display" id="nonracikanTable" width="100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Kategori Resep</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $('#nonracikanTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            pageLength : 6,
            lengthMenu: [[6, 10, 20, -1], [6, 10, 20, 'Todos']],
            ajax: {
                url: "{{ route('non_racikan.index') }}",
                type: 'GET'
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false },
                { data: 'obatalkes_nama', name: 'obatalkes_nama' },
                { data: 'signa_nama', name: 'signa_nama' },
                { data: 'qty', name: 'qty' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            order: [[0, 'desc']]
        });

        $('#obat_id').select2({
            placeholder: '-- pilih obat --',
            theme: 'bootstrap-5',
            ajax: {
                url: "{{ route('non_racikan.obat') }}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            if (item.stok == '0.00') {
                                return {
                                    text: [item.obatalkes_nama , ' (stok = ' + parseInt(item.stok) + ')'], disabled : true,
                                    id: item.obatalkes_id
                                }   
                            } else {
                                return {
                                    text: [item.obatalkes_nama , ' (stok = ' + parseInt(item.stok) + ')'], 
                                    id: item.obatalkes_id
                                }   
                            }
                            
                        })
                    };
                },
                cache: true
            }
        });

        $('#resep_id').select2({
            placeholder: '-- pilih resep --',
            theme: 'bootstrap-5',
            ajax: {
                url: "{{ route('non_racikan.resep') }}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.signa_nama, 
                                id: item.signa_id
                            }   
                        })
                    };
                },
                cache: true
            }
        });

        $('.obat_id').change(function() {
            var obat = $( ".obat_id option:selected" ).text();
            $("#draftObat").val(obat);
        });

        $('.resep_id').change(function() {
            var signa = $( ".resep_id option:selected" ).text();
            $("#draftSigna").val(signa);
        });

        $('#qty').keyup(function() {
            var reqstock = $('#obat_id').val(); 
            var qty = $('#qty').val(); 
            $("#draftQty").val(qty);
            $.ajax({ 
                url: "/non_racikan/obat/" + reqstock,
                type: "post",
                dataType: 'json',
                delay: 250,
                success: function (data) {
                    var qtyTotal = parseInt(data.stok);
                    if (qty >= qtyTotal) {
                        Swal.fire({
                            title: 'Gagal',
                            text: "Stok yang anda minta melebihi stok yang ada !",
                            icon: 'error',
                            confirmButtonColor: '#004028',
                            confirmButtonText: 'Oke',
                            allowOutsideClick: false
                        });
                        $('#qty').val(''); 
                        return false;
                    }
                },
            }) 
        });

        $(document).on('submit', '#formCreate', function(event){  
            event.preventDefault();  
            var obat_id = $('#obat_id').val();    
            var resep_id = $('#resep_id').val(); 
            var qty = $('#qty').val(); 
            $.ajax({
                url: "{{ route('non_racikan.create') }}",
                cache: false,  
                method:'POST',  
                data:  $(this).serialize(),
                success: function(data){
                    Swal.fire({
                        title: 'Berhasil',
                        text: "sukses",
                        icon: 'success',
                        confirmButtonColor: '#004028',
                        confirmButtonText: 'Yes',
                        allowOutsideClick: false
                    });
                    $('#formCreate')[0].reset(); 
                    $('#modalCreate').modal('hide');  
                    $('#obat_id').val(null).trigger('change');
                    $('#resep_id').val(null).trigger('change');
                    $('#nonracikanTable').DataTable().ajax.reload( null, false ); 
                },
                error:function (response) {
                    $("#obat_iderror").hide().text(response.responseJSON.errors.obat_id).fadeIn('slow').delay(2000).hide(1);
                    $("#resep_iderror").hide().text(response.responseJSON.errors.resep_id).fadeIn('slow').delay(2000).hide(1);
                    $("#qtyerror").hide().text(response.responseJSON.errors.qty).fadeIn('slow').delay(2000).hide(1);
                }
            })
        }); 
    });
</script>
</body>
</html>