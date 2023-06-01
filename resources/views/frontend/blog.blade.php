@extends('frontend.layout.app')


@section('styles')
    <style>
        .deleteIcon {
            border: 0;
            background: none;
        }
    </style>
@endsection
@section('content')
    <!-- Blog Area
                                                                                                                                                                                                                                                                                                                                                                                                                                ===================================== -->
    <section id="blog" class="pt75 pb50">
        <div class="container">

            <div class="row">
                <div class="col-md-9">

                    <div class="blog-three-mini">
                        <h2 class="color-dark"><a href="#">{{ $blog->title }}</a></h2>
                        <div class="blog-three-attrib">
                            <div><i class="fa fa-calendar"></i>{{ $blog->published_at->diffForHumans() }}</div> |
                            <div><i class="fa fa-pencil"></i><a href="#">{{ $blog->author->name }}</a></div> |
                            <div><i class="fa fa-comment-o"></i><a
                                    href="{{ route('frontend.category', $blog->category->id) }}">{{ $blog->category->name }}</a>
                            </div> |
                            <div><a href="#"><i class="fa fa-thumbs-o-up"></i></a>150 Likes</div> |
                            <div>
                                Share: <a href="#"><i class="fa fa-facebook-official"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </div>

                        <img src="{{ asset($blog->image_path) }}" alt="Blog Image" class="img-responsive">
                        <p class="lead mt25">
                            {!! $blog->body !!}
                        </p>


                        <div class="blog-post-read-tag mt50">
                            <i class="fa fa-tags"></i> Tags:
                            @foreach ($blogTags as $tag)
                                <a href="{{ route('frontend.tag', $tag->id) }}">{{ $tag->name }}</a>,
                            @endforeach
                        </div>

                    </div>


                    <div class="blog-post-author mb50 pt30 bt-solid-1">
                        <img src="assets/img/other/photo-1.jpg" class="img-circle" alt="image">
                        <span class="blog-post-author-name">{{ $blog->author->name }}</span> <a
                            href="https://twitter.com/booisme"><i class="fa fa-twitter"></i></a>
                        <p>
                            Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,
                            nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea
                            voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo
                            voluptas nulla pariatur.
                        </p>
                    </div>


                    <div class="blog-post-comment-container">
                        {{-- <h5><i class="fa fa-comments-o mb25"></i> {{ Blog::withcount('comments') }}</h5> --}}
                        <h5><i class="fa fa-comment mt25 mb25"></i> Comments</h5>
                        @foreach ($comments as $comment)
                            <div class="blog-post-comment">
                                <img src="assets/img/other/photo-2.jpg" class="img-circle" alt="image">
                                <span class="blog-post-comment-name">{{ $comment->user_name }}</span>
                                {{ $comment->verified_at->diffForHumans() }}
                                <a href="#" class="pull-right text-gray"><i class="fa fa-comment"></i></a>
                                {{-- <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                    onclick="deleteModalHelper('{{ route('frontend.comments.destroy', $comment->id) }}')">
                                    <i class="fa fa-trash"></i>
                                </button> --}}
                                <button class="pull-right text-gray deleteIcon" data-toggle="modal"
                                    data-target="#deleteModal"
                                    onclick="deleteModalHelper('{{ route('frontend.comments.destroy', $comment->id) }}')"><i
                                        class="fa fa-trash"></i></button>
                                <p>
                                    {{ $comment->message }}
                                </p>
                            </div>
                        @endforeach





                        <button class="button button-default button-sm center-block button-block mt25 mb25">Load More
                            Comments</button>


                    </div>

                    <div class="blog-post-leave-comment">
                        <h5><i class="fa fa-comment mt25 mb25"></i> Leave Comment</h5>
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $blog->id }}" name="blog_Id">
                            @if (!auth()->user())
                                <input type="text" name="name" class="blog-leave-comment-input" placeholder="name"
                                    required>
                                <input type="email" name="email" class="blog-leave-comment-input" placeholder="email"
                                    required>
                            @endif
                            {{-- <input type="url" name="name" class="blog-leave-comment-input" placeholder="website"> --}}
                            <textarea name="comment" class="blog-leave-comment-textarea"></textarea>
                            <button class="button button-pasific button-sm center-block mb25">Leave Comment</button>
                        </form>

                    </div>

                </div>

                @include('frontend.layout._sidebar')



            </div>

        </div>




        <!-- Newsletter Area
                                                                                                                                                                                                                                                                                                                                                                                                                    =====================================-->
        <section id="newsletter" class="bg-dark2 pt50 pb50">
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



        </section>

        {{-- Delete Modal --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Comment?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Are you sure you want to delete the category?</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-secondary" type="submit">Delete</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    @endsection


    @section('scripts')
        <script>
            function deleteModalHelper(url) {

                console.log(url); //   http://localhost:8000/admin/categories/2
                document.getElementById("deleteForm").setAttribute('action', url);
            }
        </script>
    @endsection


    {{-- @include('frontend.layout._footer') --}}



    {{-- <div id="disqus_thread"></div>
        <script>
            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
            /*
            var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            */
            (function() { // DON'T EDIT BELOW THIS LINE
                var d = document,
                    s = d.createElement('script');
                s.src = 'https://pen-it-x3grcgy367.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to

            view the <a href="https://disqus.com/?ref_noscript">comments powered by
                Disqus.</a></noscript> --}}
