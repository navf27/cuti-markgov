@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Edit Data</h5>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate="">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="validationCustom01">Nama</label>
                                    <input class="form-control" id="validationCustom01" type="text" placeholder="nama"
                                        required="" />
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="validationCustom04">Tanggal Lahir</label>
                                    <input class="datepicker-here form-control digits" type="text" data-language="en" placeholder="tanggal lahir" />
                                    <div class="invalid-feedback">Please select a valid state.</div>
                                </div>
                            </div>
                            <br>
                            <div class="row g-2">
                                <div class="col mb-6">
                                    <label class="form-label" for="validationCustomUsername">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input class="form-control" id="validationCustomUsername" type="text"
                                            placeholder="Email" aria-describedby="inputGroupPrepend" required="" />
                                        <div class="invalid-feedback">Please choose a email.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="validationCustom03">Nomor Handphone</label>
                                    <input class="form-control" id="validationCustom03" type="text" placeholder="08...."
                                        required="" />
                                    <div class="invalid-feedback">Please provide a valid city.</div>
                                </div>
                            </div>
                            <br>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="validationCustom02">Password</label>
                                    <input class="form-control" id="validationCustom02" type="text" placeholder="password"
                                        required="" />
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="validationCustom04">Foto</label>
                                    <select class="form-select" id="validationCustom04" required="">
                                        <option selected="" disabled="" value="">Choose...
                                        </option>
                                        <option>...</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a valid state.</div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-primary" type="submit">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection