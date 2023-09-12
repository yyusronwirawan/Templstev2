@section('title')
    {{ __('Home') }}
@endsection
<!DOCTYPE html>
<html lang="en">
@include('layouts.front_header')
<header id="home" class="bg-primary blog_detail">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-sm-12">
                <h1 class="text-white mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.2s">
                    {{ __('Blog Details') }}
                </h1>
            </div>
        </div>
    </div>
</header>
<div>
    <div class="container">

        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="position-relative product-slider">
                                    <div id="carouselExampleCaptions" class="carousel slide carousel-fade"
                                        data-bs-ride="carousel">
                                        <div class="carousel-inner custom-carousel-inner">
                                            <div class="carousel-item active ">
                                                <img src="{{ Storage::url(tenant('id') . '/' . $post->photo) }}"
                                                    class="d-block w-100" alt="Product images">
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <h2 class="mt-0">{{ $post->title }}</h2>
                                <div class="mt-4">
                                    <h3>{{ $post->short_description }}</h3>
                                </div>
                                <div class="mt-4">
                                    <h6>{{__('Description')}}</h6>
                                    <p class="text-muted text-sm mb-0">{{ $post->description }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive mt-3">
                            <div class="main_content_wrapper">
                                <div class="container">
                                    <div class="row">
                                        @foreach ($random_posts as $post)
                                            <div class="col-lg-3 col-md-6">
                                                <div class="card mb-3">
                                                    <img class="img-fluid card-img-top card-img-custom"
                                                        src="{{ Storage::url(tenant('id') . '/' . $post->photo) }}"
                                                        alt="Card image cap">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $post->title }}</h5>
                                                        <p class="card-text ">
                                                            {{ substr($post->short_description, 0, 75) . (strlen($post->short_description) > 75 ? '...' : '') }}
                                                        </p>
                                                        {{-- {{-- <a href="{{ route('post.details', $post->slug) }}">Read More <i
                                                        class="fas fa-chevron-right"></i></a> --}}

                                                        <div class="article-cta">
                                                            <a href="{{ route('post.details', $post->slug) }}">{{__('Read
                                                                More ')}}<i class="fas fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->
</div>
@include('layouts.front_footer')

</body>

</html>
