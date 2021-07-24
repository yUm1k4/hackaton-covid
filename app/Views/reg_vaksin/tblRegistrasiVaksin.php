<table class="data-table table hover" id="tblRegistrasiVaksin">
    <thead class="text-center">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Username</th>
            <th>No Handphone</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th class="datatable-nosort"><i class="dw dw-settings1"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($tampildata as $row) :
        ?>
            <tr>
                <td class="text-center" width="20"><?= $i++ ?>.</td>
                <td><?= $row['fullname'] ?></td>
                <td><?= $row['nik'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['no_hp'] ?></td>
                <td><?= $row['registrasi_dibuat'] ?></td>
                <?php if ($row['status'] == 'pending') : ?>
                    <td class="text-center"><button class="badge badge-warning">Pending</button></td>
                <?php elseif ($row['status'] == 'proses') : ?>
                    <td class="text-center"><button class="badge badge-success">Proses</button></td>
                <?php elseif ($row['status'] == 'selesai') : ?>
                    <td class="text-center"><button class="badge badge-primary">Selesai</button></td>
                <?php endif; ?>

                <td class="text-center" width="10%">
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <!-- <button class="dropdown-item" onclick="edit(<?= $row['id_reg_vaksin'] ?>)"><i class="dw dw-edit2"></i> Edit</button> -->
                            <button type="button" onclick="hapus(<?= $row['id_reg_vaksin'] ?>)" class="dropdown-item"><i class="dw dw-delete-3"></i> Hapus</button>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('.data-table').DataTable({
            "destroy": true, //use for reinitialize datatable
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            "language": {
                "info": "_START_-_END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 data",
                "emptyTable": "Maaf, data kosong. :/",
                "lengthMenu": "Tampilkan _MENU_ data",
                "search": "Cari:",
                "zeroRecords": "Tidak ditemukan keyword yang cocok",
                searchPlaceholder: "Keyword",
                paginate: {
                    next: '<i class="ion-chevron-right"></i>',
                    previous: '<i class="ion-chevron-left"></i>'
                }
            },
        });
    });

    function hapus(id_reg_vaksin) {
        Swal.fire({
            title: 'Hapus Data',
            text: `Yakin ingin menghapus data? Data yang terhapus tidak akan bisa dikembalikan`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Data!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url('/reg_vaksin/hapus') ?>",
                    data: {
                        id_reg_vaksin: id_reg_vaksin
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses
                            })
                            dataVaksin();
                        }
                    },
                    // menampilkan pesan error:
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }
</script>