@extends('layouts.guest')

@section('title', 'Trang đang bảo trì - Hudson Furnishing')

@section('content')
<section class="hero-section position-relative text-white d-flex align-items-center justify-content-center" style="min-height: 65vh; overflow: hidden;">
    <!-- Nền Hero Image -->
    <div class="position-absolute top-0 start-0 w-100 h-100">
        @if(!empty($siteSettings['hero_image_1']))
            <img src="{{ Storage::url($siteSettings['hero_image_1']) }}" 
                 class="w-100 h-100" 
                 style="object-fit: cover; object-position: center;">
        @else
            <div style="background:#2f3e46;width:100%;height:100%;"></div>
        @endif
    </div>

    <!-- Overlay mờ -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.5);"></div>

    <!-- Nội dung -->
    <div class="container position-relative text-center z-2">
        <h1 class="display-4 fw-bold mb-3">Chúng tôi đang bảo trì</h1>
        <p class="lead mb-4">Xin lỗi vì sự bất tiện. Hudson Furnishing sẽ trở lại sớm nhất có thể.</p>
        @if(!empty($siteSettings['contact_email']))
            <p>Liên hệ: <a href="mailto:{{ $siteSettings['contact_email'] }}" class="text-light">{{ $siteSettings['contact_email'] }}</a></p>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 60vh;
    color: #fff;
}
</style>
@endpush
