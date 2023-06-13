@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">
            <!-- 2023.05.24 コメントの数を表示 -->
            <i class="fa fa-comment"></i><span class="">{{ $post_comment->commentCounts($post->id)->count() }}</span>
          </div>
          <div>
            <!-- 2023.05.20 いいねの数を表示 -->
            <!-- 2023.05.20 User.phpのis_Likeメソッドと連動している -->
            @if(Auth::user()->is_Like($post->id))
            <!-- 2023.05.20 Like.phpのlikeCountsメソッドと連動している -->
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span></p>
            @else
            <!-- 2023.05.20 Like.phpのlikeCountsメソッドと連動している -->
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area border w-25">
    <div class="border m-4">
      <div class=""><a href="{{ route('post.input') }}">投稿</a></div>
      <div class="">
        <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input type="submit" value="検索" form="postSearchRequest">
      </div>
      <input type="submit" name="category_word" class="category_btn" value="サブカテゴリー" form="postSearchRequest">
      <input type="submit" name="like_posts" class="category_btn" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="category_btn" value="自分の投稿" form="postSearchRequest">
      <ul>
        <!-- 2023.06.11 サブカテゴリーを表示 苦戦した所 -->
        <!-- https://www.omakase.net/blog/2022/05/css-accordion.html -->

        <!-- ($category->subCategories as $subCategory)の$categoryは
        ($categories as $category)の$categoryと連動している -->

        <!-- ($category->subCategories as $subCategory)のsubCategoriesは
        MainCategory.phpのsubCategoriesメソッドと連動している-->

        <!-- 2023.06.13 改修後 サブカテゴリーの追加
        viewファイルから送られてくる情報がidではなくサブカテゴリーの単語だった場合の記述 -->
        <section class="accordion">
          @foreach($categories as $category)
            <input id="block-{{ $category->id }}" type="checkbox" class="toggle">
            <label class="Label" for="block-{{ $category->id }}"><li class="main_categories" category_id="{{ $category->id }}"><span>{{ $category->main_category }}</span></li></label>
            <div class="content">
              @foreach($category->subCategories as $subCategory)
              <input type="submit" name="category_word" class="category_btn" category_id="{{ $subCategory->id }}" value="{{ $subCategory->sub_category }}" form="postSearchRequest">
                <!-- <li class="sub_categories" category_id="{{ $subCategory->id }}"><span>{{ $subCategory->sub_category }}</span></li> -->
              @endforeach
            </div>
          @endforeach
        </section>


      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection