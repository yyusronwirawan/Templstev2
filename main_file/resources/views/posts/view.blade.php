@section('title','Blog')
<!DOCTYPE html>
<html lang="en">

@include('layouts.front_header')
<header id="home" class="bg-primary blog_detail">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-sm-12">
                <h1 class="text-white mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.2s">
                    {{ __('Posts') }}
                </h1>
            </div>
        </div>
    </div>
</header>

<div class="main_content_wrapper">
    <div class="dash-container">
        <div class="col-11 mt-2">
            <div class="form-group">
                {{ Form::label('category_id', __('Category'), ['class' => 'p-2']) }}
                {!! Form::select('category_id', $category, null, ['class' => 'form-select custom_select','data-trigger']) !!}
            </div>
        </div>
        <div class=" col-11 mt-6 pl-4">
            <div class="row all_posts">
                @foreach ($posts as $post)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <div class="card">
                                <img class="img-fluid card-img-top card-img-custom"
                                    src="{{ Storage::url(tenant('id') . '/' . $post->photo) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">
                                    {{ substr($post->short_description, 0, 75) . (strlen($post->short_description) > 75 ? '...' : '') }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('post.details', $post->slug) }}">{{ __('Read More') }}<i
                                        class="ti ti-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('layouts.front_footer')
<script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var genericExamples = document.querySelectorAll('[data-trigger]');
        for (i = 0; i < genericExamples.length; ++i) {
            var element = genericExamples[i];
            new Choices(element, {
                placeholderValue: 'This is a placeholder set in the config',
                searchPlaceholderValue: 'This is a search placeholder',
            });
        }
    });
</script>
<script>
    $(document).on("change", "#category_id", function() {
        var cate_id = $(this).val();
        $.ajax({
            url: '{{ route('get.category.post') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                category: cate_id,
            },
            success: function(data) {
                // console.log(data);
                $(".all_posts").html('');
                $.each(data, function(index, val) {
                    var img_path = '{{ Storage::url(tenant('id') . '/') }}' + val.photo;
                    var url = '{{ url('blog-detail') }}/' + val.slug;
                    $(".all_posts").append(
                        '<div class="col-12 col-sm-6 col-md-6 col-lg-3"><article class="article article-style-b"><div class="article-header"><div class="article-image" style="background-image:url(' +
                        img_path +
                        ')" ></div></div><div class="article-details"><div class="article-title"><h2>' +
                        val.title +
                        '</h2></div><p>' + val
                        .short_description + '</p><div class="article-cta"><a href="' +
                        url +
                        '">Read More <i class="ti ti-chevron-right"></i></a></div></div></article></div>'
                    );
                });
            }
        })
    });
</script>

</body>

</html>
