{{-- @foreach ($product->categories as $item)
    {{ $item->category_id }}
@endforeach --}}

{{-- @foreach ($categories as $category)
    @foreach ($product->categories as $item)
        @if ($item->category_id == $category->id)
            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            {{ $item->category_id }}
            <option value="{{ $category->id }}"> {{ $category->name }} </option>
        @else
        @endif
    @endforeach
@endforeach --}}
@extends('admin.layout')

@section('cssAndJs')
    <link rel="stylesheet" href="{{ asset('filepond/filepond.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script src="{{ asset('filepond/filepond.min.js') }}"></script>
@endsection

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

    <form action="{{ route('dashboard.products.update', [$product]) }}" method="post" enctype="multipart/form-data"
        id="form_post">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header text-center bg-secondary text-white">
                <h5>Update Product</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Product Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $product->title }}">
                </div>

                {{-- <div class="mb-3">
                    <label for="content" class="form-label">Product Content</label>
                    <input class="form-control" name="content" id="content" type="hidden">
                </div>

                <div id="editor">{!! $product->content !!}
                </div> <!-- عرض المحتوى بالتنسيق -->
 --}}


                <div class="mb-3">
                    <label for="content" class="form-label">Product Content</label>
                    <textarea class="form-control" name="content" id="content" rows="3">{{ $product->content }}</textarea>
                </div>


                <div class="mb-3">
                    <label for="resoureceName" class="form-label">Blog Author is :</label>
                    <select class="form-select" name="resoureceName">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }} </option>
                        @endforeach
                    </select>
                </div>


                <div class="row">
                    <div class="col-2">
                        <p>Current Image</p>

                        @if ($product->image == null)
                            No Image
                        @else
                            <img src="{{ url('/storage/media/products/' . $product->image) }}" style="width: 150px">
                        @endif

                        {{-- <img src="{{ url('/storage/media/products/' . $product->image) }}" style="width: 150px"> --}}
                    </div>

                    <div class="col-10">
                        <div class="mb-3">
                            <label for="name" class="form-label">Update product Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                    </div>

                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-secondary w-50">Update</button>
                </div>
            </div>
        </div>
        </div>
    </form>

    <script>
        const inputElement = document.querySelector('input[id="image"]');
        const pond = FilePond.create(inputElement);
        FilePond.setOptions({
            server: {
                url: '{{ route('dashboard.upload.products') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }

        });
        new TomSelect("#categories", {
            maxItems: 6
        });


        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        quill.on('text-change', function() {
            var content = quill.root.innerHTML;
            document.querySelector('#content').value = content;
        });

        // عندما يتم تقديم النموذج  
        document.querySelector('form_post').onsubmit = function() {
            // تأكد من تحديث الحقل المخفي بمحتوى محرر Quill  
            var content = quill.root.innerHTML;
            document.querySelector('#content').value = content;
        };
    </script>
@endsection
