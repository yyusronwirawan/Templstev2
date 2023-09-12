<!DOCTYPE html>
<html lang="en">

    @section('title')

    {{__('Terms And Conditions') }}
    @endsection

        @include('layouts.front_header')

    <header id="home" class="bg-primary blog_detail">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-sm-12">
              <h1
                class="text-white mb-sm-4 wow animate__fadeInLeft"
                data-wow-delay="0.2s"
              >
              {{__('Terms And Conditions')}}
              </h1>
            </div>
          </div>
        </div>
      </header>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <article class="article article-detail article-noshadow">
                        <div class="p-0">
                            <div>
                                {!! Utility::getsettings('term_condition') !!}
                            </div>

                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>


    @include('layouts.front_footer')


</body>

</html>
