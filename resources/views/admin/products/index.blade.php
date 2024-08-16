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
    <div class="card">
        <div class="card-header text-center">Add New Product</div>
        <div class="card-body">
            <a class="btn btn-secondary" href="{{ url('/dashboard/products/create') }}">اضافة منتج</a>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>الصورة</th>
                        <th>العنوان</th>
                        <th>التصنيف</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            {{-- <td></td> --}}
                            <td>
                                @if ($product->image == null)
                                    No Image
                                @else
                                    <img src="{{ url('/storage/media/products/' . $product->image) }}" style="width: 150px">
                                @endif

                            </td>
                            <td>{{ $product->title }}</td>
                            <td>
                                    {{ $product->categories->name }}
                            </td>
                            <td>
                                <form action="{{ route('dashboard.products.destroy', [$product->id]) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    

                                    <a href="{{ url('dashboard/products/' . $product->id . '/edit') }}"
                                        class="btn btn-primary mx-2">
                                        <i class="fa-solid fa-edit mx-2"></i>
                                    </a>


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
