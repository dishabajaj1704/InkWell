                <!-- Blog Sidebar
                            ===================================== -->
                <div id="sidebar" class="col-md-3 mt50 animated" data-animation="fadeInRight" data-animation-delay="250">


                    <!-- Search
                                ===================================== -->
                    <div class="pr25 pl25 clearfix">
                        <form action="{{ Route::currentRouteName() == 'frontend.blogs.show' ? route('home') : '#' }}">
                            <div class="blog-sidebar-form-search">
                                <input type="text" name="search" class="" placeholder="e.g. Javascript"
                                    value="{{ request()->search }}">
                                <button type="submit" name="submit" class="pull-right"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </form>

                    </div>


                    <!-- Categories
                                ===================================== -->
                    <div class="mt25 pr25 pl25 clearfix">
                        <h5 class="mt25">
                            Categories
                            <span class="heading-divider mt10"></span>
                        </h5>
                        <ul class="blog-sidebar pl25">
                            @foreach ($categories as $category)
                                <li class="">
                                    <a href="{{ route('frontend.category', $category->id) }}">{{ $category->name }}<span
                                            class="badge badge-pasific pull-right">{{ $category->blogs_count }}</span></a>
                                </li>
                            @endforeach

                        </ul>

                    </div>


                    <!-- Tags
                                ===================================== -->
                    <div class="pr25 pl25 clearfix">
                        <h5 class="mt25">
                            Popular Tags
                            <span class="heading-divider mt10"></span>
                        </h5>
                        <ul class="tag">
                            @foreach ($tags as $tag)
                                <li><a href="{{ route('frontend.tag', $tag->id) }}">{{ $tag->name }}</a></li>
                            @endforeach


                        </ul>

                    </div>
                </div>
