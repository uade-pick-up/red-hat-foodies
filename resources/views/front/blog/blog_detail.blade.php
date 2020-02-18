@extends('theme.master')
@section('title', "$blog->heading")
@section('content')

@include('admin.message')

<!-- blog-dtl start-->
<section id="blog-dtl" class="blog-dtl-main-block">
    <div class="container">
        <div class="blog-link btm-30"><a href="{{ route('blog.all') }}" title="back to blog"><i class="fa fa-chevron-left"></i>Back to Blog</a></div>
        <div class="blog-dtl-block-heading text-center btm-20">{{ $blog->heading }}</div>
        <div class="blog-dtl-heading-dtl text-center">{{ date('jS F Y', strtotime($blog->created_at)) }} By <a href="#" title="post of">{{ $blog->user->fname }}</a></div>
        <div class="blog-idea text-center btm-30"><a href="#" title="blog-idea">{{ $blog->text }}</a></div>
        <div class="blog-dtl-img text-center btm-30">
            <img src="{{ asset('images/blog/'.$blog->image) }}" alt="blog" class="text-center"> 
        </div>
        <div class="blog-dtl-block">
            <div class="offset-lg-1 col-lg-10">
                <p class="btm-20">{{ strip_tags($blog->detail) }}</p>
            </div>
            
        </div>
        
    </div>
</section>
<hr>
<!-- blog-dtl end-->
@endsection
