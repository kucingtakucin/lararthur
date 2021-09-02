<script>
    /**
     * Keperluan disable inspect element
     */
    // ================================================== //
    // Disable right click
    $(document).contextmenu(function(event) {
        event.preventDefault()
    })

    $(document).keydown(function(event) {
        // Disable F12
        if (event.keyCode == 123) return false;

        // Disable Ctrl + Shift + I
        if (event.ctrlKey && event.shiftKey && event.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }

        // Disable Ctrl + Shift + J
        if (event.ctrlKey && event.shiftKey && event.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }

        // Disable Ctrl + U
        if (event.ctrlKey && event.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
    })

    // Document ready
    $(() => {

        let datatable, id_data, $get, status_crud = false,
            $insert, $update, $delete, $import;


        /**
         * Keperluan DataTable, Datepicker, Summernote dan BsCustomFileInput
         */
        // ================================================== //
        datatable = $('#table_data').DataTable({
            serverSide: true,
            processing: true,
            destroy: true,
            dom: `
                <"d-flex flex-row justify-content-end flex-wrap mb-2"B>
                <"d-flex flex-row justify-content-between"lf>
                rt
                <"d-flex flex-row justify-content-between"ip>`,
            buttons: {
                /** Tombol-tombol Export & Tambah Data */
                buttons: [{
                    className: 'btn btn-info m-2 text-white',
                    text: $('<i>', {
                        class: 'fa fa-plus'
                    }).prop('outerHTML') + ' Tambah Data', // Tambah Data
                    action: (e, dt, node, config) => {
                        $('#modal_tambah').modal('show');
                    }
                }, ],
                dom: {
                    button: {
                        className: 'btn'
                    },
                    buttonLiner: {
                        tag: null
                    }
                }
            },
            ajax: {
                url: "{{ route('backend.admin.user.data') }}",
                type: 'GET',
                dataType: 'JSON',
                data: {},
                beforeSend: () => {
                    if (!status_crud) {
                        Swal.fire({
                            title: 'Loading...',
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        })
                    }
                },
                complete: () => {
                    if (status_crud) {
                        status_crud = false
                    }
                    Swal.hideLoading()
                    Swal.close()
                }
            },
            columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5], // Sesuaikan dengan jumlah kolom
                    className: 'text-center'
                },
                {
                    targets: [0, 5],
                    searchable: false,
                    orderable: false,
                },
                {
                    targets: [6],
                    visible: false,
                    searchable: false,
                }
            ],
            order: [
                [6, 'ASC']
            ],
            columns: [{ // 0
                    title: '#',
                    name: '#',
                    data: 'DT_RowIndex',
                },
                { // 1
                    title: 'Nama',
                    name: 'name',
                    data: 'name',
                },
                { // 2
                    title: 'Email',
                    name: 'email',
                    data: 'email',
                },
                { // 3
                    title: 'Roles',
                    name: 'roles.name', // Table.column -> Untuk menghindari order clause is ambiguous
                    data: 'roles',
                }, // 4
                {
                    title: 'Permissions',
                    name: 'permissions.name',
                    data: 'permissions',
                },
                { // 5
                    title: 'Aksi',
                    name: 'id',
                    data: 'id',
                    render: (id) => {
                        let btn_edit = $('<button>', {
                            type: 'button',
                            class: 'btn btn-success btn_edit',
                            'data-id': id,
                            html: $('<i>', {
                                class: 'fa fa-edit'
                            }).prop('outerHTML'),
                            title: 'Ubah Data',
                        })

                        let btn_delete = $('<button>', {
                            type: 'button',
                            class: 'btn btn-danger btn_delete',
                            'data-id': id,
                            html: $('<i>', {
                                class: 'fa fa-trash'
                            }).prop('outerHTML'),
                            title: 'Hapus Data'
                        })

                        return $('<div>', {
                            role: 'group',
                            class: 'btn-group btn-group-sm',
                            html: [btn_edit, btn_delete]
                        }).prop('outerHTML')
                    }
                },
                { // 6
                    title: 'Created At',
                    name: 'users.created_at', // Table.column -> Untuk menghindari order clause is ambiguous
                    data: 'created_at',
                }
            ],
            initComplete: function(event) {
                $(this).on('click', '.btn_edit', function(event) {
                    event.preventDefault()
                    $get(this);
                });

                $(this).on('click', '.btn_delete', function(event) {
                    event.preventDefault()
                    $delete(this);
                });
            },
        })

        bsCustomFileInput.init()
        // ================================================== //

        /**
         * Keperluan CRUD
         */
        // ================================================== //

        // Get Data 
        $get = (element) => {
            let row = datatable.row($(element).closest('tr')).data()

            $('#modal_ubah').modal('show');
            $('#form_ubah input#ubah_id[name=id]').val(row.id)
            $('#form_ubah input#ubah_name[name=name]').val(row.name);
            $('#form_ubah input#ubah_email[name=email]').val(row.email);
            // $('#form_ubah input#ubah_password[name=password]').val(row.password);
            $('#form_ubah input#ubah_password_old[name=password_old]').val(row.password);

        }

        // Insert Data
        $insert = (form) => {
            $('#form_tambah button[type=submit]').hide();
            $('#form_tambah button.loader').show();
            Swal.fire({
                title: 'Loading...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            })

            let formData = new FormData(form);
            axios.post("{{ route('backend.admin.user.insert') }}", formData)
                .then(res => {
                    status_crud = true

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: res.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })

                }).catch(err => {
                    console.log(err.response)
                    if (err.response.data.errors) {
                        let errors = '';
                        Object.entries(err.response.data.errors)
                            .forEach(function([key, value]) {
                                value.map(item => {
                                    errors +=
                                        `<i><i class="fa fa-angle-right"></i> ${value}</i> <br>`
                                })
                            })

                        Swal.fire({
                            icon: 'error',
                            title: err.response.data.message,
                            html: errors,
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: err.response.statusText,
                        })
                    }
                }).then(() => {
                    $('#form_tambah button[type=submit]').show();
                    $('#form_tambah button.loader').hide();
                    $('#form_tambah').trigger('reset');
                    // $('#form_tambah select').val(null).trigger('change')
                    $('#form_tambah').removeClass('was-validated')
                    $('#modal_tambah').modal('hide');
                    datatable.ajax.reload();
                })
        }

        // Update Data
        $update = (form) => {
            Swal.fire({
                title: 'Loading...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            })

            status_crud = true
            let formData = new FormData(form);
            formData.append('_method', 'PUT')
            axios.post("{{ route('backend.admin.user.update') }}", formData)
                .then(res => {

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: res.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }).catch(err => {
                    console.log(err)

                    if (err.response.data.errors) {
                        let errors = '';
                        Object.entries(err.response.data.errors)
                            .forEach(function([key, value]) {
                                value.map(item => {
                                    errors +=
                                        `<i><i class="fa fa-angle-right"></i> ${value}</i> <br>`
                                })
                            })
                        Swal.fire({
                            icon: 'error',
                            title: err.response.data.message,
                            html: errors,
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: err.response.statusText,
                        })
                    }

                }).then(() => {
                    $('#form_ubah button[type=submit]').show();
                    $('#form_ubah button.loader').hide();
                    $('#form_ubah').trigger('reset');
                    // $('#form_ubah select').val(null).trigger('change')
                    $('#form_ubah').removeClass('was-validated')
                    $('#modal_ubah').modal('hide');
                    datatable.ajax.reload();
                })
        }

        // Delete Data
        $delete = (element) => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Loading...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    })

                    status_crud = true
                    let formData = new FormData();
                    formData.append('id', $(element).data('id'));
                    formData.append('_method', 'DELETE')

                    axios.post("{{ route('backend.admin.user.delete') }}", formData)
                        .then(res => {

                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: res.data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }).catch(err => {
                            console.error(err);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: err.response.statusText
                            })
                        }).then(() => {
                            datatable.ajax.reload()
                        })
                }
            })
        }

        // ================================================== //

        /**
         * Keperluan event click tombol, reset, validasi dan submit form
         */
        // ================================================== //
        $('#form_tambah').submit(function(event) {
            event.preventDefault()
            if (this.checkValidity()) {
                $insert(this);
            }
        });

        $('#form_ubah').submit(function(event) {
            event.preventDefault();
            if (this.checkValidity()) {
                $update(this);
            }
        });

        $('#modal_tambah').on('hide.bs.modal', () => {
            $('#form_tambah').removeClass('was-validated')
            $('#form_tambah').trigger('reset')
        })

        $('#modal_ubah').on('hide.bs.modal', () => {
            $('#form_ubah').removeClass('was-validated')
            $('#form_ubah').trigger('reset')
        })

        // ================================================== //

        /**
         * Keperluan input select2 didalam form
         */
        // ================================================== //
        const select2InModal = (status) => {
            $(`#form_${status} select#${status}_select_roles.select_roles`).select2({
                placeholder: 'Pilih roles',
                width: '100%',
                dropdownParent: $(`#modal_${status}`),
                ajax: {
                    url: "{{ route('backend.admin.user.get_roles') }}",
                    dataType: 'JSON',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term, // search term
                            page: params.page || 1
                        };
                    },
                    processResults: function(response, params) {
                        let myResults = [];
                        let results = response.data.data
                        results.map(item => {
                            myResults.push({
                                'id': item.id,
                                'text': item.display_name // Warning
                            });
                        })
                        params.page = params.page || 1;

                        return {
                            results: myResults,
                            pagination: {
                                more: (params.page * 10) < response.data.total
                            }
                        };
                    }
                }
            }).on('select2:select', function(event) {
                // $(`#form_${status} select#${status}_select_permissions.select_permissions`)
                //     .prop('disabled', false)
                axios.get(
                        "{{ route('backend.admin.user.get_permissions') }}")
                    .then(res => {
                        let permissions = '';
                        let results = res.data.data
                        results.map(item => {
                            permissions += $('<div>', {
                                class: 'checkbox checkbox-primary mb-2',
                                html: [
                                    $('<input>', {
                                        type: 'checkbox',
                                        name: 'permissions[]',
                                        id: `checkbox-${item.id}`,
                                        value: item.id
                                    }),
                                    $('<label>', {
                                        class: 'mb-0',
                                        for: `checkbox-${item.id}`,
                                        html: item.name
                                    })
                                ]
                            }).prop('outerHTML')
                        })

                        $('.permission-container').html(permissions)
                    })
            })
        }

        $('#modal_tambah').on('show.bs.modal', () => {
            select2InModal('tambah')
        })

        $('#modal_ubah').on('show.bs.modal', () => {
            select2InModal('ubah')
        })
    })
</script>
