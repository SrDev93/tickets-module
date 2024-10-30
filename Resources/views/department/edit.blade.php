@extends('layouts.admin')

@push('stylesheets')
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
@endpush

@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
    @include('tickets::department.partial.header')
    <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">ویرایش تیکت</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ticketDepartment.update', $ticketDepartment->id) }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                            <div class="col-md-6">
                                <label for="title" class="form-label">عنوان</label>
                                <input type="text" name="title" class="form-control" id="title" required value="{{ $ticketDepartment->title }}">
                                <div class="invalid-feedback">لطفا عنوان را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">وضعیت</label>
                                <select name="status" class="form-control" required>
                                    <option value="active" @if($ticketDepartment->status == 'active') selected @endif>فعال</option>
                                    <option value="inactive" @if($ticketDepartment->status == 'inactive') selected @endif>غیر فعال</option>
                                </select>
                                <div class="invalid-feedback">لطفا وضعیت را انتخاب کنید</div>
                            </div>
                            @method('PATCH')
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary" type="submit">ارسال فرم</button>
                                @csrf
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->

    </div>

@endsection
