<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Form Tambah RS Rujukan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form class="formRsRujukan" id="form" action="<?= site_url('rs_rujukan/simpandata') ?>">
                <div class="modal-body">
                    <div class="wizard-content">
                        <section>
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nama">Nama Rumah Sakit :</label>
                                        <input type="text" id="nama" name="nama" class="form-control " required data-parsley-required-message="Nama RS harus diisi jika ingin menyimpan" data-parsley-length="[5,50]" data-parsley-length-message="Minimal 5 karakter, maksimal 50 karakter" data-parsley-trigger="keyup">
                                        <div class="invalid-feedback errorNamaRs">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="hotline">Hotline :</label>
                                        <input type="number" id="hotline" name="hotline" class="form-control " required data-parsley-required-message="Hotline harus diisi jika ingin menyimpan" data-parsley-length="[10,13]" data-parsley-length-message="Minimal 10 karakter, maksimal 13 karakter" data-parsley-trigger="keyup" data-parsley-type="number" data-parsley-type-message="Hanya boleh angka">
                                        <div class="invalid-feedback errorHotline">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="alamat">Alamat :</label>
                                        <input type="text" id="alamat" name="alamat" class="form-control " required data-parsley-required-message="Alamat harus diisi" data-parsley-minlength="10" data-parsley-minlength-message="Alamat terlalu singkat" data-parsley-maxlength="200" data-parsley-maxlength-message="Alamat terlalu panjang" data-parsley-trigger="keyup">
                                        <div class="invalid-feedback errorAlamat">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>

<script>
    $(document).ready(function() {
        $('.formRsRujukan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    // jika ada error
                    if (response.error) {
                        if (response.error.nama) {
                            // jika ada error maka tampilkan pesan errornya
                            $('#nama').addClass('is-invalid');
                            $('.errorNamaRs').html(response.error.nama);
                        } else {
                            // jika tdk ada error
                            $('#nama').removeClass('is-invalid');
                            $('#nama').addClass('is-valid');
                            $('.errorNamaRs').html('');
                        }
                        if (response.error.hotline) {
                            // jika ada error maka tampilkan pesan errornya
                            $('#hotline').addClass('is-invalid');
                            $('.errorHotline').html(response.error.hotline);
                        } else {
                            // jika tdk ada error
                            $('#hotline').removeClass('is-invalid');
                            $('#hotline').addClass('is-valid');
                            $('.errorHotline').html('');
                        }
                        if (response.error.alamat) {
                            // jika ada error maka tampilkan pesan errornya
                            $('#alamat').addClass('is-invalid');
                            $('.errorAlamat').html(response.error.alamat);
                        } else {
                            // jika tdk ada error
                            $('#alamat').removeClass('is-invalid');
                            $('#alamat').addClass('is-valid');
                            $('.errorAlamat').html('');
                        }
                    } else {
                        // jika tidak ada error
                        // munculkan pesan sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                        // tutup modal
                        $('#modaltambah').modal('hide');
                        dataRsRujukan();
                    }
                },
                // menampilkan pesan error:
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        })
    })
</script>