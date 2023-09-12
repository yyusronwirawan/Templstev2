<!DOCTYPE html>
<html lang="en">
@section('title')
{{__('Contact us') }}
@endsection

    @include('layouts.front_header')

    <!-- [ Header ] start -->
    <header id="home" class="bg-primary blog_detail">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-sm-12">
            <h1
              class="text-white mb-sm-4 wow animate__fadeInLeft"
              data-wow-delay="0.2s"
            >
            {{__('Contact Us')}}
            </h1>
          </div>
        </div>
      </div>
    </header>
    <!-- [ Header ] End -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <article class="article article-detail article-noshadow">
                        <div class="p-0">
                            <div>
                                {!! Utility::getsettings('contact_us') !!}
                            </div>

                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <article class="article article-detail article-noshadow">
                        <div class="p-0">
                            <iframe width="100%" height="450" frameborder="0" scrolling="no" marginheight="0"
                                marginwidth="0"
                                src="https://maps.google.com/maps?q={{ Utility::getsettings('latitude') }},{{ Utility::getsettings('longitude') }}&hl=en&z=14&amp;output=embed">
                            </iframe>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <article class="article article-detail article-noshadow">
                        <div class="p-0">
                            <section class="slice slice-lg" id="sct-form-contact">
                                <div class="container position-relative zindex-100">
                                    <div class="row justify-content-center mb-5">
                                        <div class="col-lg-6 text-center">
                                            <h3>{{__('Contact us')}}</h3>
                                            <p class="lh-190">{{__('If there is something we can help you with jut let us know. We will be more than happy to offer you our help')}}</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <!-- Form -->
                                            {!! Form::open(['route' => 'contact.mail', 'method' => 'Post', 'enctype' => 'multipart/form-data']) !!}
                                            <div class="form-group">
                                                <input class="form-control " type="text" name="name"
                                                    placeholder="{{__('Your name')}}" required>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control " type="email" name="email"
                                                    placeholder="{{__('email@example.com')}}" required>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control " type="text" name="contact_no"
                                                    placeholder="{{__('+40-745-234-567')}}" required>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control " data-toggle="autosize" name="message"
                                                    placeholder="{{__('Tell us a few words ...')}}" rows="3" required></textarea>
                                            </div>
                                            @if (Utility::getsettings('captcha_status') == 1)
                                                <div class="text-center">
                                                    {!! NoCaptcha::renderJs() !!}
                                                    {!! NoCaptcha::display() !!}
                                                </div>
                                            @endif
                                            <div>
                                                <button type="reset" class="btn-reset d-none"></button>
                                                <button type="submit" class="btn btn-block btn-lg btn-primary  mt-4">{{__('Send your message')}}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>


    @include('layouts.front_footer')

    <script type="text/javascript" charset="UTF-8"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>

</body>

</html>
