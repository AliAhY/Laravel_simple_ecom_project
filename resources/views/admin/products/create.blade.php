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

    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data" id="form_post">
        @csrf
        <div class="card">
            <div class="card-header text-center bg-secondary text-white">
                <h5>Add New Product</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Product Title</label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Product Content</label>
                    <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                </div>


                <div class="mb-3">
                    <label for="resoureceName" class="form-label">Blog Author</label>
                    <select class="form-select" name="resoureceName">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Product Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-secondary w-50">Send</button>
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

        // new TomSelect("#categories", {
        //     maxItems: 6
        // });

        // ----------- Quill Editor Code ----------- //
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
        // ------------------------------------------ //
    </script>
@endsection
