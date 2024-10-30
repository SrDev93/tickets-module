@extends('layouts.admin')

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
                        <h3 class="card-title">لیست تیکت ها</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">شماره تیکت</th>
                                    <th class="wd-15p border-bottom-0">دپارتمان</th>
                                    <th class="wd-15p border-bottom-0">کاربر</th>
                                    <th class="wd-15p border-bottom-0">موضوع</th>
                                    <th class="wd-15p border-bottom-0">وضعیت</th>
                                    <th class="wd-15p border-bottom-0">زمان</th>
                                    <th class="wd-20p border-bottom-0">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->department?->title }}</td>
                                        <td>{{ $item->user?->name }}</td>
                                        <td>{{ $item->subject }}</td>
                                        <td>
                                            @if($item->status == 'new')
                                                <span class="badge bg-info">ثبت شده</span>
                                            @elseif($item->status == 'pending')
                                                <span class="badge bg-success">پاسخ داده شده</span>
                                            @elseif($item->status == 'answered')
                                                <span class="badge bg-warning">پاسخ مشتری</span>
                                            @elseif($item->status == 'waiting')
                                                <span class="badge bg-danger">بسته شده</span>
                                            @elseif($item->status == 'closed')
                                                <span class="badge bg-danger">بسته شده</span>
                                            @endif
                                        </td>
                                        <td dir="ltr">{{ verta($item->created_at)->format('Y/m/d H:i') }}</td>
                                        <td>
                                            <a href="{{ route('tickets.show', $item->id) }}" class="btn btn-info fs-14 text-white edit-icn" title="مشاهده">
                                                <i class="fe fe-eye"></i>
                                            </a>
{{--                                            <a href="{{ route('tickets.edit', $item->id) }}" class="btn btn-primary fs-14 text-white edit-icn" title="ویرایش">--}}
{{--                                                <i class="fe fe-edit"></i>--}}
{{--                                            </a>--}}
{{--                                            <button type="submit" onclick="return confirm('برای حذف اطمبنان دارید؟')" form="form-{{ $item->id }}" class="btn btn-danger fs-14 text-white edit-icn" title="حذف">--}}
{{--                                                <i class="fe fe-trash"></i>--}}
{{--                                            </button>--}}
{{--                                            <form id="form-{{ $item->id }}" action="{{ route('tickets.destroy', $item->id) }}" method="post">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
{{--                                            </form>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">افزودن تیکت</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
@endsection
