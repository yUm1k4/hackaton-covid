
<!-- Data Terbaru per Provinsi start -->
<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row text-center">
                    <div class="col">
                        <div class="title">
                            <h5>Data Kasus Covid-19 di Indonesia Berdasarkan Provinsi</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-20 px-2">
                <small>
                    <div class="table-responsive">
                        <table class="data-table table hover" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th width="20">No.</th>
                                    <th>Nama Provinsi</th>
                                    <th>Positif</th>
                                    <th>Sembuh</th>
                                    <th>Meninggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($provinsi as $prov) { ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td><?= $prov['attributes']['Provinsi'] ?></td>
                                        <td class="text-center"><?= $prov['attributes']['Kasus_Posi'] ?></td>
                                        <td class="text-center"><?= $prov['attributes']['Kasus_Semb'] ?></td>
                                        <td class="text-center"><?= $prov['attributes']['Kasus_Meni'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </small>
            </div>
        </div>
    </div>
</div>
<!-- Data Terbaru per Provinsi end -->