<div class="bg-gray-13 bg-md-transparent">
  <div class="container">
    <!-- breadcrumb -->
    <div class="my-md-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
          <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('index') }}">Anasəhifə</a></li>
          @if($product->category->parent)
            @include('frontend.partials.menu', ['category' => $product->category->parent])
          @endif
          <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('category.show',[$product->category->id,\Illuminate\Support\Str::slug($product->category->name)]) }}">{{ $product->category->name }}</a></li>
          <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ $product->title }}</li>
        </ol>
      </nav>
    </div>
    <!-- End breadcrumb -->
  </div>
</div>