@extends('admin.layout')

@section('main')
    @if ($errors->any())
        <ol>
            @foreach ($errors->all() as $error)
                <li style="color: red;font-size: 28px">{{ $error }}</li>
            @endforeach
        </ol>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif

    <h2 style="text-align: center">الرسائل الجديدة</h2>

    @if ($notifications->isNotEmpty())
        <div id="notification-container" style="position: relative; max-width: 400px; margin: auto;">
            @foreach ($notifications as $notification)
                <div class="notification"
                    style="background: #f9f9f9; border: 1px solid #ddd; padding: 10px; margin: 10px 0; border-radius: 5px;">
                    <button onclick="hideNotification(this.parentElement)" style="position: absolute; top: 5px; right: 10px; border: none; background: transparent; cursor: pointer; font-size: 18px;">&times;</button>
                    <p>{{ $notification->message }} - <small>{{ $notification->created_at }}</small></p>
                </div>
            @endforeach
            <p style="text-align: center">انتهى</p>
        </div>
    @else
        <p>لا توجد رسائل جديدة.</p>
    @endif


    <div class="card">
        <div class="card-header text-center">All Odrers</div>
        <div class="card-body">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>product image</th>
                        <th>product name</th>
                        <th>ordered by</th>
                        <th>status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            {{-- <td></td> --}}
                            <td>
                                @if ($order->product->image == null)
                                    No Image
                                @else
                                    <img src="{{ url('/storage/media/products/' . $order->product->image) }}"
                                        style="width: 150px;">
                                @endif

                            </td>
                            <td>{{ $order->product->title }}</td>
                            <td>
                                {{ $order->user->name }}
                            </td>
                            <td>
                                {{ $order->status }}
                            </td>
                            <td>
                                {{-- {{ $order->created_at->diffForHumans() }} --}}
                                {{ $order->created_at->translatedFormat('l, d F Y') }}
                            </td>
                            <td>
                                <form action="{{ route('dashboard.DeleteOrder', $order->id) }}" method="post">
                                    @csrf
                                    {{-- @method('delete') --}}

                                    <button type="submit" class="btn btn-danger mx-2"><i
                                            class="fa-solid fa-trash mx-2"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach

                </tbody>

        </div>
    </div>



    <script>
        let table = new DataTable('#myTable', {
            "pageLength": 4
        });
    </script>
@endsection
