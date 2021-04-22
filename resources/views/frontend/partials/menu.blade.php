<li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('category.show',[$category->id,\Illuminate\Support\Str::slug($category->name)]) }}">{{ $category->name }}</a></li>
@if($category->parent)
  @include('frontend.partials.menu',['category' => $category->parent])
@endif