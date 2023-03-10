@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="database"></i></div>
                            <div class="media-body">
                                <span class="m-0">Earnings</span>
                                <h4 class="mb-0 counter">6659</h4>
                                <i class="icon-bg" data-feather="database"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-secondary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                            <div class="media-body">
                                <span class="m-0">Products</span>
                                <h4 class="mb-0 counter">9856</h4>
                                <i class="icon-bg" data-feather="shopping-bag"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="message-circle"></i></div>
                            <div class="media-body">
                                <span class="m-0">Messages</span>
                                <h4 class="mb-0 counter">893</h4>
                                <i class="icon-bg" data-feather="message-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                            <div class="media-body">
                                <span class="m-0">New Use</span>
                                <h4 class="mb-0 counter">4531</h4>
                                <i class="icon-bg" data-feather="user-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 xl-100 box-col-12">
                <div class="card">
                    <div class="cal-date-widget card-body">
                        <div class="row">
                            <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                                <div class="cal-info text-center">
                                    <div>
                                        <h2>24</h2>
                                        <div class="d-inline-block"><span class="b-r-dark pe-3">March</span><span class="ps-3">2018</span></div>
                                        <p class="f-16">There is no minimum donation, any sum is appreciated</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                                <div class="cal-datepicker">
                                    <div class="datepicker-here float-sm-end" data-language="en">           </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 xl-100 box-col-12">
                <div class="widget-joins card">
                    <div class="row">
                        <div class="col-sm-6 pe-0">
                            <div class="media border-after-xs">
                                <div class="align-self-center me-3">68%<i class="fa fa-angle-up ms-2"></i></div>
                                <div class="media-body details ps-3">
                                    <span class="mb-1">New</span>
                                    <h5 class="mb-0 counter">6982</h5>
                                </div>
                                <div class="media-body align-self-center"><i class="font-primary float-end ms-2"
                                        data-feather="shopping-bag"></i></div>
                            </div>
                        </div>
                        <div class="col-sm-6 ps-0">
                            <div class="media">
                                <div class="align-self-center me-3">12%<i class="fa fa-angle-down ms-2"></i></div>
                                <div class="media-body details ps-3">
                                    <span class="mb-1">Pending</span>
                                    <h5 class="mb-0 counter">783</h5>
                                </div>
                                <div class="media-body align-self-center"><i class="font-primary float-end ms-3"
                                        data-feather="layers"></i></div>
                            </div>
                        </div>
                        <div class="col-sm-6 pe-0">
                            <div class="media border-after-xs">
                                <div class="align-self-center me-3">68%<i class="fa fa-angle-up ms-2"></i></div>
                                <div class="media-body details ps-3 pt-0">
                                    <span class="mb-1">Done</span>
                                    <h5 class="mb-0 counter">3674</h5>
                                </div>
                                <div class="media-body align-self-center"><i class="font-primary float-end ms-2"
                                        data-feather="shopping-cart"></i></div>
                            </div>
                        </div>
                        <div class="col-sm-6 ps-0">
                            <div class="media">
                                <div class="align-self-center me-3">68%<i class="fa fa-angle-up ms-2"></i></div>
                                <div class="media-body details ps-3 pt-0">
                                    <span class="mb-1">Cancel</span>
                                    <h5 class="mb-0 counter">069</h5>
                                </div>
                                <div class="media-body align-self-center"><i class="font-primary float-end ms-2"
                                        data-feather="dollar-sign"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
