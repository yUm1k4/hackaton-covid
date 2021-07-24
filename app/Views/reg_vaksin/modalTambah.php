<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="modaltambah" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Form Registrasi Vaksin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form class="formRegVaksin" id="form" action="<?= site_url('reg_vaksin/simpandata') ?>">
                <div class="modal-body">
                    <div class="wizard-content">
                        <section>
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_id">User</label>
                                        <select name="user_id" id="user_id" class="form-control wide p-6" required data-parsley-required-message="User harus dipilih" data-parsley-trigger="keyup" style="width: 100%">
                                            <option value="0" selected>Cari Berdasarkan Username</option>
                                        </select>
                                        <div class="invalid-feedback erroruser_id">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No Induk Kependudukan :</label>
                                        <input type="number" class="form-control" name="nik" required data-parsley-trigger="keyup" data-parsley-required-message="NIK harus diisi" data-parsley-length="[16,16]" data-parsley-length-message="NIK harus berjumlah 16 digit" data-parsley-type="number" data-parsley-type-message="Hanya boleh angka">
                                        <div class="invalid-feedback errorNik">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Handphone :</label>
                                        <input type="number" class="form-control " name="no_hp" required data-parsley-trigger="keyup" data-parsley-required-message="No HP harus diisi" data-parsley-length="[10,13]" data-parsley-length-message="No HP minimal 10 digit, maximal 13 digit" data-parsley-type="number" data-parsley-type-message="Hanya boleh angka">
                                        <div class="invalid-feedback errorNoHp">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat Lengkap :</label>
                                        <input type="text" class="form-control" name="alamat" required data-parsley-trigger="keyup" data-parsley-required-message="Alamat harus diisi" data-parsley-minlength="20" data-parsley-minlength-message="Alamat terlalu singkat" data-parsley-maxlength="254" data-parsley-maxlength-message="Alamat terlalu panjang">
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
        $('.formRegVaksin').submit(function(e) {
            if (jQuery('#user_id').val() == 0) {
                $('#user_id').addClass('is-invalid');
                $('.errorUserId').html("User harus dipilih");
            } else {
                $('#user_id').removeClass('is-invalid');
                $('.errorUserId').html('');
            }


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
                        if (response.error.user_id) {
                            // jika ada error maka tampilkan pesan errornya
                            $('#user_id').addClass('is-invalid');
                            $('.erroruser_id').html(response.error.user_id);
                        } else {
                            // jika tdk ada error
                            $('#user_id').removeClass('is-invalid');
                            $('#user_id').addClass('is-valid');
                            $('.erroruser_id').html('');
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
                        dataVaksin();
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

<script type="text/javascript">
    $(document).ready(function() {
        // Initialize select2
        $("#user_id").select2({
            ajax: {
                url: "<?= site_url('/reg_vaksin/get_user') ?>",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term, // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response.data
                    };
                },
                cache: true
            }
        });
    });
</script>