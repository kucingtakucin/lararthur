<div class="modal fade" id="modal_tambah" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="needs-validation" id="form_tambah" method="post" enctype="multipart/form-data" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title">Form Tambah Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"
                        data-original-title="" title=""><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nama Permission</label>
                                <input type="text" id="tambah_permission" class="form-control" name="name" required
                                    autocomplete="off" placeholder="Masukkan Nama Permission">
                                {!! validation_feedback('Nama permission', 'wajib diisi') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tambah_display_name">Display Name</label>
                                <input type="text" id="tambah_display_name" class="form-control" name="display_name"
                                    required autocomplete="off" placeholder="Masukkan Nama">
                                {!! validation_feedback('Display name', 'wajib diisi') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tambah_deskripsi">Deskripsi</label>
                                <input type="text" id="tambah_deskripsi" class="form-control" name="description"
                                    required autocomplete="off" placeholder="Masukkan Deskripsi">
                                {!! validation_feedback('deskripsi', 'wajib diisi') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" data-original-title=""
                        title="">Close</button>
                    <button class="btn btn-primary" type="submit" data-original-title="" title="">Submit Data</button>
                    <button class="btn btn-primary loader" type="button" disabled style="display: none;">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Pop In Modal -->
