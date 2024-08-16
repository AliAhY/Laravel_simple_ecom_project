@extends('site.layouts.layout')

@section('main')
    <div class="container">
        <div class="row">
            @foreach ($main_category as $category)
                <div class="col-4 right-col"><span
                        style="background-color: #87CEEB; padding: 5px; border-radius: 10px; margin:5px"><i
                            style="color: rgb(238, 25, 25); font-style: italic; font-size: 18px;"></i>{{ $category->name }}</span>
                    @foreach ($category->products as $product)
                        <div class="article">
                            <div class="image-container">
                                <img src="{{ url('/storage/media/products/' . $product->image) }}" alt="Article Image"
                                    class="article-image">
                            </div>
                            <div class="text">
                                <a href="{{ url('news/' . $product->id) }}">
                                    <h4 style="color: rgb(42, 110, 204)">{{ $product->title }}</h4>
                                </a>
                                <p class="date"> {{ $product->created_at }}</p>

                            </div>
                        </div>
                    @endforeach

                </div>
        </div>
        @endforeach
    </div>
    </div>
@endsection
