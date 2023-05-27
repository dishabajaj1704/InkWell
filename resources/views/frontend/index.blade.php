@extends('frontend.layout.app')


@section('styles')
    <style>
        .button.button-pasific.disabled {
            background-color: #333 !important;
        }
    </style>
@endsection
@section('content')
    <header class="pt100 pb100 parallax-window-2" data-parallax="scroll" data-speed="0.5"
        data-image-src="frontend/assets/img/bg/img-bg-17.jpg" data-positiony="1000">
        <div class="intro-body text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 pt50">
                        <h1 class="brand-heading font-montserrat text-uppercase color-light" data-in-effect="fadeInDown">
                            Pen-It
                            <small class="color-light alpha7">Heaven for Bloggers!</small>
                        </h1>
                    </div>
                </div>
            </div>

        </div>
    </header>

    <!-- Blog Area
                                                            ===================================== -->
    <div id="blog" class="pt20 pb50">
        <div class="container">

            <div class="row">
                <div class="col-md-9 mt25">
                    <div class="row">
                        @foreach ($blogs as $blog)
                            <div class="col-md-4 col-sm-6 col-xs-12 mb50">
                                <h4 class="blog-title"><a href="#">{{ $blog->title }}</a></h4>
                                <div class="blog-three-attrib">
                                    <span class="icon-calendar"></span>{{ $blog->published_at->diffForHumans() }} |
                                    <span class=" icon-pencil"></span><a href="#">{{ $blog->author->name }}</a>
                                </div>
                                <img src="{{ asset($blog->image_path) }}" class="img-responsive" alt="image blog">
                                <p class="mt25">
                                    {{ $blog->excerpt }}
                                </p>
                                <a href="#" class="button button-gray button-xs">Read More <i
                                        class="fa fa-long-arrow-right"></i></a>

                            </div>
                        @endforeach



                    </div>

                    <!-- Blog Paging
                                                                            ===================================== -->

                    {{ $blogs->links('pagination::simple-bootstrap-5') }}

                </div>
                <!-- Blog Sidebar
                                                ===================================== -->
                @include('frontend.layout._sidebar')


            </div>

        </div>
    </div>


    <!-- Newsletter Area
                                                            =====================================-->
    <div id="newsletter" class="bg-dark2 pt50 pb50">
        <div class="container">
            <div class="row">

                <div class="col-md-2">
                    <h4 class="color-light">
                        Newsletter
                    </h4>
                </div>

                <div class="col-md-10">
                    <form name="newsletter">
                        <div class="input-newsletter-container">
                            <input type="text" name="email" class="input-newsletter"
                                placeholder="enter your email address">
                        </div>
                        <a href="#" class="button button-sm button-pasific hover-ripple-out">Subscribe<i
                                class="fa fa-envelope"></i></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
