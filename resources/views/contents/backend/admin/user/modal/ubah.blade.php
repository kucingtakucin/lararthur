<div class="modal fade" id="modal_ubah" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="needs-validation" id="form_ubah" method="post" enctype="multipart/form-data" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title">Form Ubah Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"
                        data-original-title="" title=""><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" id="ubah_name" class="form-control" name="name" required
                                    autocomplete="off" placeholder="Masukkan Nama">
                                {!! validation_feedback('Nama', 'wajib diisi') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ubah_email">Email</label>
                                <input type="email" id="ubah_email" class="form-control" name="email" required
                                    autocomplete="off" placeholder="Masukkan Email">
                                {!! validation_feedback('Email', 'wajib diisi dan harus valid') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ubah_password">Password</label>
                                <input type="password" id="ubah_password" minlength="8" class="form-control"
                                    name="password" required autocomplete="off" placeholder="Masukkan Password">
                                {!! validation_feedback('Password', 'wajib diisi dan minimal 8 karakter') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ubah_password_confirmation">Password Confirmation</label>
                                <input type="password" id="ubah_password_confirmation" minlength="8"
                                    class="form-control" name="password_confirmation" required autocomplete="off"
                                    placeholder="Masukkan Password Confirmation">
                                {!! validation_feedback('Password confirmation', 'wajib diisi dan minimal 8 karakter') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ubah_select_roles">Roles</label>
                                <select name="roles" id="ubah_select_roles" required
                                    class="form-control js-select2 select_roles">
                                    <option></option>
                                </select>
                                {!! validation_feedback('Roles', 'wajib dipilih') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                <label for="ubah_select_permissions">Permission</label>
                                <div class="permission-container">

                                </div>
                            </div>
                            {!! validation_feedback('Permissions', 'wajib dipilih') !!}
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
