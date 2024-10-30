@extends('layouts.admin')
@push('stylesheets')
    <style>
        .text-left {
            text-align: left;
            direction: ltr;
        }
    </style>
@endpush

@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">


        <!-- PAGE-HEADER -->
        @include('tickets::partial.header')
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">مشاهده تیکت  شماره {{ $ticket->number }}</h3>
                    </div>
                    <div class="card-body">

                        <div class="card">
                            <div class="card-header border-bottom">
                                <h3 class="card-title">تغییر وضعیت تیکت</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('tickets.status', $ticket->id) }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                                    <div class="col-md-12">
                                        <label for="status" class="form-label">وضعیت</label>
                                        <select name="status" class="form-control">
                                            <option value="pending">در حال بررسی</option>
                                            <option value="closed">بسته شده</option>
                                        </select>
                                        <div class="invalid-feedback">لطفا وضعیت را انتخاب کنید</div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <button class="btn btn-primary" type="submit">ارسال فرم</button>
                                        @csrf
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header border-bottom">
                                <h3 class="card-title">ارسال پاسخ</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('tickets.reply', $ticket->id) }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                                    <div class="col-md-12">
                                        <label for="message" class="form-label">متن تیکت</label>
                                        <textarea name="message" class="form-control" required rows="7">{{ old('message') }}</textarea>
                                        <div class="invalid-feedback">لطفا متن را وارد کنید</div>
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <a href="javascript:void(0);" class="btn btn-info add-attach"><i class="fa fa-plus"></i> افزودن پیوست </a>
                                    </div>
                                    <div class="attachments col-md-12 row">
                                        <div class="col-md-6">
                                            <label for="subject" class="form-label">فایل پیوست</label>
                                            <input type="file" name="attach[]" class="form-control">
                                            <div class="invalid-feedback">لطفا فایل را انتخاب کنید</div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <button class="btn btn-primary" type="submit">ارسال فرم</button>
                                        @csrf
                                    </div>
                                </form>
                            </div>
                        </div>

                        @foreach($ticket->messages as $message)
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h3 class="card-title col-10">{{ optional($message->user)->name }}</h3>
                                    <h3 class="card-title col-2 text-left">{{ verta($message->created_at)->format('Y/m/d H:i') }}</h3>
                                </div>
                                <div class="card-body">
                                    <p>
                                        {{ $message->message }}
                                    </p>
                                </div>
                                @if(count($message->attachments))
                                    <div class="card-footer">
                                        <ul>
                                        @foreach($message->attachments as $attach)
                                            <li><a href="{{ url($attach->path) }}" target="_blank"><i class="fa fa-download"></i> دانلود فایل پیوست </a> </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>

    @push('scripts')
        <script>
            $('.add-attach').click(function (){
                $('.attachments').append('<div class="col-md-6">' +
                    '<label for="subject" class="form-label">فایل پیوست</label>' +
                    '<input type="file" name="attach[]" class="form-control">' +
                    '<div class="invalid-feedback">لطفا فایل را انتخاب کنید</div>' +
                    '</div>');
            });
        </script>
    @endpush
@endsection
