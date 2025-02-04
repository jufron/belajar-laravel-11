<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- ? cdn lib datatable 2.2.1 --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">

    {{-- ? cdn lib fontawesome 6.7.2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- ? cdn lib toastify 1.12.0 --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  </head>
  <body>
    <div class="container-fluid">
        <h1 class="my-4">User Yajra Datatable</h1>

        <div class="row my-1">
            <div class="col-md-2">
                <label for="bulan">Bulan</label>
                <select class="form-select" aria-label="Bulan" id="month">
                    <option disabled selected>Pilih</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
            </div>
            <div class="col-md-2">
                <label for="tahun">Tahun</label>
                <select class="form-select" aria-label="Default select example" id="year">
                    <option disabled selected>Pilih</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                  </select>
            </div>
        </div>

        <button class="btn btn-success my-4" id="tambah">Tambah</button>
        <button class="btn btn-primary my-4" id="reload">Reset</button>
        <button class="btn btn-danger my-4" id="delete-select">Hapus Data Terpilih</button>

        <div class="table-responsive">
            <table class="table table-striped table-hover" id="table-user" data-url="{{ route('get.user') }}">
                <thead>
                <tr>
                    <th scope="col">List</th>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Intro</th>
                    <th style="width: 80px" scope="col">aksi</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    {{-- todo Modal for adding user --}}
    <div class="modal fade" tabindex="-1" id="userModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name">
                        <div id="invalid-name" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email">
                        <div id="invalid-email" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password">
                        <div id="invalid-password" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation">
                        <div id="invalid-password-confirm" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-url="{{ route('store.user') }}" id="saveUser">
                        <span id="loading-button" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- todo Modal for show user --}}
    <div class="modal fade" tabindex="-1" id="userShowModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Show User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container-show-user">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- todo Modal for update user --}}
    <div class="modal fade" tabindex="-1" id="userEditModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name-edit" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name-edit">
                        <div id="invalid-name-edit" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email-edit" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email-edit">
                        <div id="invalid-email-edit" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password-edit" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password-edit">
                        <div id="invalid-password-edit" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation-edit" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation-edit">
                        <div id="invalid-password-confirm-edit" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update-user">
                        <span id="loading-button-update" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- todo Modal for delete user --}}
    <div class="modal fade" tabindex="-1" id="userDeleteModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="delete-user">
                        <span id="loading-button-delete" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ? frmwork bootstrap 5 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    {{-- ? lib cdn fontawesome --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- ? cdn lib jquery 3.7.1, datatable need jquery for working --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    {{-- ? cdn lib datatable 2.2.1 --}}
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>

    {{-- ? cdn lib toastify 1.12.0 --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    {{-- ? myscript --}}
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{ asset('js/user-show.js') }}"></script>
    <script src="{{ asset('js/user-edit.js') }}"></script>
    <script src="{{ asset('js/user-delete.js') }}"></script>

  </body>
</html>
