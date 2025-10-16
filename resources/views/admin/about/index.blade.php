@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Trang Giới Thiệu - Hudson Furnishing')
@section('page-title', 'Chỉnh Sửa Trang Giới Thiệu')

@section('content')

<!-- Thông báo hướng dẫn -->
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <i class="fas fa-info-circle me-2"></i>
    <strong>Hướng dẫn:</strong> Bạn có thể tùy ý định nghĩa nội dung cho từng khối. Ví dụ: Khối 1 có thể là "Sứ Mệnh", Khối 2 có thể là "Tầm Nhìn", hoặc bất kỳ nội dung nào bạn muốn. Tất cả các trường đều <strong>không bắt buộc</strong> - chỉ điền những gì bạn muốn hiển thị.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            
            <!-- Hero Section -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-star me-2"></i>Phần Hero
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="hero_title" class="form-label fw-bold">Tiêu đề chính</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="hero_title" 
                                       name="hero_title" 
                                       value="{{ old('hero_title', $aboutPage->hero_title) }}"
                                       placeholder="Về Hudson Furnishing">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="hero_image" class="form-label fw-bold">Ảnh hero</label>
                                <input type="file" 
                                       class="form-control" 
                                       id="hero_image" 
                                       name="hero_image" 
                                       accept="image/*">
                                @if($aboutPage->hero_image)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($aboutPage->hero_image) }}" 
                                             alt="Hero Image" 
                                             class="img-fluid rounded" 
                                             style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="hero_subtitle" class="form-label fw-bold">Mô tả phụ</label>
                        <textarea class="form-control" 
                                  id="hero_subtitle" 
                                  name="hero_subtitle" 
                                  rows="2"
                                  placeholder="Khám phá câu chuyện đằng sau thương hiệu nội thất hàng đầu Việt Nam">{{ old('hero_subtitle', $aboutPage->hero_subtitle) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Company Story -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-book me-2"></i>Câu Chuyện Công Ty
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="story_title" class="form-label fw-bold">Tiêu đề</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="story_title" 
                                       name="story_title" 
                                       value="{{ old('story_title', $aboutPage->story_title) }}"
                                       placeholder="Câu Chuyện Của Chúng Tôi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="story_image" class="form-label fw-bold">Ảnh câu chuyện</label>
                                <input type="file" 
                                       class="form-control" 
                                       id="story_image" 
                                       name="story_image" 
                                       accept="image/*">
                                @if($aboutPage->story_image)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($aboutPage->story_image) }}" 
                                             alt="Story Image" 
                                             class="img-fluid rounded" 
                                             style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="story_content_1" class="form-label fw-bold">Đoạn 1</label>
                                <textarea class="form-control" 
                                          id="story_content_1" 
                                          name="story_content_1" 
                                          rows="4">{{ old('story_content_1', $aboutPage->story_content_1) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="story_content_2" class="form-label fw-bold">Đoạn 2</label>
                                <textarea class="form-control" 
                                          id="story_content_2" 
                                          name="story_content_2" 
                                          rows="4">{{ old('story_content_2', $aboutPage->story_content_2) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="story_content_3" class="form-label fw-bold">Đoạn 3</label>
                                <textarea class="form-control" 
                                          id="story_content_3" 
                                          name="story_content_3" 
                                          rows="4">{{ old('story_content_3', $aboutPage->story_content_3) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Khối Nội Dung Chính -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-cubes me-2"></i>Khối Nội Dung Chính (3 khối)
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="mission_title" class="form-label fw-bold">Tiêu đề Khối 1</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="mission_title" 
                                       name="mission_title" 
                                       value="{{ old('mission_title', $aboutPage->mission_title) }}"
                                       placeholder="Nhập tiêu đề cho khối nội dung đầu tiên">
                            </div>
                            <div class="mb-3">
                                <label for="mission_content" class="form-label fw-bold">Nội dung Khối 1</label>
                                <textarea class="form-control" 
                                          id="mission_content" 
                                          name="mission_content" 
                                          rows="4">{{ old('mission_content', $aboutPage->mission_content) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="mission_icon" class="form-label fw-bold">Icon Khối 1</label>
                                <select class="form-control" id="mission_icon" name="mission_icon">
                                    <option value="">Không chọn icon</option>
                                    <option value="fas fa-bullseye" {{ old('mission_icon', $aboutPage->mission_icon) == 'fas fa-bullseye' ? 'selected' : '' }}>🎯 Bullseye</option>
                                    <option value="fas fa-target" {{ old('mission_icon', $aboutPage->mission_icon) == 'fas fa-target' ? 'selected' : '' }}>🎯 Target</option>
                                    <option value="fas fa-flag" {{ old('mission_icon', $aboutPage->mission_icon) == 'fas fa-flag' ? 'selected' : '' }}>🚩 Flag</option>
                                    <option value="fas fa-rocket" {{ old('mission_icon', $aboutPage->mission_icon) == 'fas fa-rocket' ? 'selected' : '' }}>🚀 Rocket</option>
                                    <option value="fas fa-star" {{ old('mission_icon', $aboutPage->mission_icon) == 'fas fa-star' ? 'selected' : '' }}>⭐ Star</option>
                                    <option value="fas fa-compass" {{ old('mission_icon', $aboutPage->mission_icon) == 'fas fa-compass' ? 'selected' : '' }}>🧭 Compass</option>
                                    <option value="fas fa-lightbulb" {{ old('mission_icon', $aboutPage->mission_icon) == 'fas fa-lightbulb' ? 'selected' : '' }}>💡 Lightbulb</option>
                                    <option value="fas fa-hand-holding-heart" {{ old('mission_icon', $aboutPage->mission_icon) == 'fas fa-hand-holding-heart' ? 'selected' : '' }}>🤝 Heart</option>
                                    <option value="fas fa-seedling" {{ old('mission_icon', $aboutPage->mission_icon) == 'fas fa-seedling' ? 'selected' : '' }}>🌱 Seedling</option>
                                    <option value="fas fa-fire" {{ old('mission_icon', $aboutPage->mission_icon) == 'fas fa-fire' ? 'selected' : '' }}>🔥 Fire</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="vision_title" class="form-label fw-bold">Tiêu đề Khối 2</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="vision_title" 
                                       name="vision_title" 
                                       value="{{ old('vision_title', $aboutPage->vision_title) }}"
                                       placeholder="Nhập tiêu đề cho khối nội dung thứ hai">
                            </div>
                            <div class="mb-3">
                                <label for="vision_content" class="form-label fw-bold">Nội dung Khối 2</label>
                                <textarea class="form-control" 
                                          id="vision_content" 
                                          name="vision_content" 
                                          rows="4">{{ old('vision_content', $aboutPage->vision_content) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="vision_icon" class="form-label fw-bold">Icon Khối 2</label>
                                <select class="form-control" id="vision_icon" name="vision_icon">
                                    <option value="">Không chọn icon</option>
                                    <option value="fas fa-eye" {{ old('vision_icon', $aboutPage->vision_icon) == 'fas fa-eye' ? 'selected' : '' }}>👁️ Eye</option>
                                    <option value="fas fa-binoculars" {{ old('vision_icon', $aboutPage->vision_icon) == 'fas fa-binoculars' ? 'selected' : '' }}>🔭 Binoculars</option>
                                    <option value="fas fa-telescope" {{ old('vision_icon', $aboutPage->vision_icon) == 'fas fa-telescope' ? 'selected' : '' }}>🔭 Telescope</option>
                                    <option value="fas fa-mountain" {{ old('vision_icon', $aboutPage->vision_icon) == 'fas fa-mountain' ? 'selected' : '' }}>🏔️ Mountain</option>
                                    <option value="fas fa-globe" {{ old('vision_icon', $aboutPage->vision_icon) == 'fas fa-globe' ? 'selected' : '' }}>🌍 Globe</option>
                                    <option value="fas fa-map" {{ old('vision_icon', $aboutPage->vision_icon) == 'fas fa-map' ? 'selected' : '' }}>🗺️ Map</option>
                                    <option value="fas fa-sun" {{ old('vision_icon', $aboutPage->vision_icon) == 'fas fa-sun' ? 'selected' : '' }}>☀️ Sun</option>
                                    <option value="fas fa-rainbow" {{ old('vision_icon', $aboutPage->vision_icon) == 'fas fa-rainbow' ? 'selected' : '' }}>🌈 Rainbow</option>
                                    <option value="fas fa-cloud" {{ old('vision_icon', $aboutPage->vision_icon) == 'fas fa-cloud' ? 'selected' : '' }}>☁️ Cloud</option>
                                    <option value="fas fa-tree" {{ old('vision_icon', $aboutPage->vision_icon) == 'fas fa-tree' ? 'selected' : '' }}>🌳 Tree</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="values_title" class="form-label fw-bold">Tiêu đề Khối 3</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="values_title" 
                                       name="values_title" 
                                       value="{{ old('values_title', $aboutPage->values_title) }}"
                                       placeholder="Nhập tiêu đề cho khối nội dung thứ ba">
                            </div>
                            <div class="mb-3">
                                <label for="values_content" class="form-label fw-bold">Nội dung Khối 3</label>
                                <textarea class="form-control" 
                                          id="values_content" 
                                          name="values_content" 
                                          rows="4">{{ old('values_content', $aboutPage->values_content) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="values_icon" class="form-label fw-bold">Icon Khối 3</label>
                                <select class="form-control" id="values_icon" name="values_icon">
                                    <option value="">Không chọn icon</option>
                                    <option value="fas fa-heart" {{ old('values_icon', $aboutPage->values_icon) == 'fas fa-heart' ? 'selected' : '' }}>❤️ Heart</option>
                                    <option value="fas fa-gem" {{ old('values_icon', $aboutPage->values_icon) == 'fas fa-gem' ? 'selected' : '' }}>💎 Gem</option>
                                    <option value="fas fa-shield-alt" {{ old('values_icon', $aboutPage->values_icon) == 'fas fa-shield-alt' ? 'selected' : '' }}>🛡️ Shield</option>
                                    <option value="fas fa-handshake" {{ old('values_icon', $aboutPage->values_icon) == 'fas fa-handshake' ? 'selected' : '' }}>🤝 Handshake</option>
                                    <option value="fas fa-award" {{ old('values_icon', $aboutPage->values_icon) == 'fas fa-award' ? 'selected' : '' }}>🏆 Award</option>
                                    <option value="fas fa-dove" {{ old('values_icon', $aboutPage->values_icon) == 'fas fa-dove' ? 'selected' : '' }}>🕊️ Dove</option>
                                    <option value="fas fa-balance-scale" {{ old('values_icon', $aboutPage->values_icon) == 'fas fa-balance-scale' ? 'selected' : '' }}>⚖️ Balance</option>
                                    <option value="fas fa-leaf" {{ old('values_icon', $aboutPage->values_icon) == 'fas fa-leaf' ? 'selected' : '' }}>🍃 Leaf</option>
                                    <option value="fas fa-infinity" {{ old('values_icon', $aboutPage->values_icon) == 'fas fa-infinity' ? 'selected' : '' }}>♾️ Infinity</option>
                                    <option value="fas fa-puzzle-piece" {{ old('values_icon', $aboutPage->values_icon) == 'fas fa-puzzle-piece' ? 'selected' : '' }}>🧩 Puzzle</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Values -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-gem me-2"></i>Giá Trị Của Chúng Tôi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="our_values_title" class="form-label fw-bold">Tiêu đề</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="our_values_title" 
                                       name="our_values_title" 
                                       value="{{ old('our_values_title', $aboutPage->our_values_title) }}"
                                       placeholder="Giá Trị Của Chúng Tôi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="our_values_subtitle" class="form-label fw-bold">Mô tả phụ</label>
                                <textarea class="form-control" 
                                          id="our_values_subtitle" 
                                          name="our_values_subtitle" 
                                          rows="2"
                                          placeholder="Những nguyên tắc định hướng mọi hoạt động">{{ old('our_values_subtitle', $aboutPage->our_values_subtitle) }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="value_1_title" class="form-label fw-bold">Giá trị 1 - Tiêu đề</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="value_1_title" 
                                       name="value_1_title" 
                                       value="{{ old('value_1_title', $aboutPage->value_1_title) }}"
                                       placeholder="Chất Lượng Cao Cấp">
                            </div>
                            <div class="mb-3">
                                <label for="value_1_content" class="form-label fw-bold">Giá trị 1 - Nội dung</label>
                                <textarea class="form-control" 
                                          id="value_1_content" 
                                          name="value_1_content" 
                                          rows="3">{{ old('value_1_content', $aboutPage->value_1_content) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="value_2_title" class="form-label fw-bold">Giá trị 2 - Tiêu đề</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="value_2_title" 
                                       name="value_2_title" 
                                       value="{{ old('value_2_title', $aboutPage->value_2_title) }}"
                                       placeholder="Thiết Kế Sáng Tạo">
                            </div>
                            <div class="mb-3">
                                <label for="value_2_content" class="form-label fw-bold">Giá trị 2 - Nội dung</label>
                                <textarea class="form-control" 
                                          id="value_2_content" 
                                          name="value_2_content" 
                                          rows="3">{{ old('value_2_content', $aboutPage->value_2_content) }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="value_3_title" class="form-label fw-bold">Giá trị 3 - Tiêu đề</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="value_3_title" 
                                       name="value_3_title" 
                                       value="{{ old('value_3_title', $aboutPage->value_3_title) }}"
                                       placeholder="Dịch Vụ Tận Tâm">
                            </div>
                            <div class="mb-3">
                                <label for="value_3_content" class="form-label fw-bold">Giá trị 3 - Nội dung</label>
                                <textarea class="form-control" 
                                          id="value_3_content" 
                                          name="value_3_content" 
                                          rows="3">{{ old('value_3_content', $aboutPage->value_3_content) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="value_4_title" class="form-label fw-bold">Giá trị 4 - Tiêu đề</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="value_4_title" 
                                       name="value_4_title" 
                                       value="{{ old('value_4_title', $aboutPage->value_4_title) }}"
                                       placeholder="Bền Vững Môi Trường">
                            </div>
                            <div class="mb-3">
                                <label for="value_4_content" class="form-label fw-bold">Giá trị 4 - Nội dung</label>
                                <textarea class="form-control" 
                                          id="value_4_content" 
                                          name="value_4_content" 
                                          rows="3">{{ old('value_4_content', $aboutPage->value_4_content) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Section -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-users me-2"></i>Đội Ngũ Của Chúng Tôi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="team_title" class="form-label fw-bold">Tiêu đề</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="team_title" 
                                       name="team_title" 
                                       value="{{ old('team_title', $aboutPage->team_title) }}"
                                       placeholder="Đội Ngũ Của Chúng Tôi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="team_subtitle" class="form-label fw-bold">Mô tả phụ</label>
                                <textarea class="form-control" 
                                          id="team_subtitle" 
                                          name="team_subtitle" 
                                          rows="2"
                                          placeholder="Những con người tài năng đằng sau thành công">{{ old('team_subtitle', $aboutPage->team_subtitle) }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Member 1 -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Thành viên 1</label>
                            <input type="file" 
                                   class="form-control mb-2" 
                                   name="member_1_image" 
                                   accept="image/*">
                            @if($aboutPage->member_1_image)
                                <img src="{{ Storage::url($aboutPage->member_1_image) }}" 
                                     alt="Member 1" 
                                     class="img-fluid rounded" 
                                     style="max-height: 80px;">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" 
                                           class="form-control mb-2" 
                                           name="member_1_name" 
                                           value="{{ old('member_1_name', $aboutPage->member_1_name) }}"
                                           placeholder="Tên thành viên 1">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" 
                                           class="form-control mb-2" 
                                           name="member_1_position" 
                                           value="{{ old('member_1_position', $aboutPage->member_1_position) }}"
                                           placeholder="Chức vụ">
                                </div>
                            </div>
                            <textarea class="form-control" 
                                      name="member_1_description" 
                                      rows="2"
                                      placeholder="Mô tả">{{ old('member_1_description', $aboutPage->member_1_description) }}</textarea>
                        </div>
                    </div>
                    
                    <!-- Member 2 -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Thành viên 2</label>
                            <input type="file" 
                                   class="form-control mb-2" 
                                   name="member_2_image" 
                                   accept="image/*">
                            @if($aboutPage->member_2_image)
                                <img src="{{ Storage::url($aboutPage->member_2_image) }}" 
                                     alt="Member 2" 
                                     class="img-fluid rounded" 
                                     style="max-height: 80px;">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" 
                                           class="form-control mb-2" 
                                           name="member_2_name" 
                                           value="{{ old('member_2_name', $aboutPage->member_2_name) }}"
                                           placeholder="Tên thành viên 2">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" 
                                           class="form-control mb-2" 
                                           name="member_2_position" 
                                           value="{{ old('member_2_position', $aboutPage->member_2_position) }}"
                                           placeholder="Chức vụ">
                                </div>
                            </div>
                            <textarea class="form-control" 
                                      name="member_2_description" 
                                      rows="2"
                                      placeholder="Mô tả">{{ old('member_2_description', $aboutPage->member_2_description) }}</textarea>
                        </div>
                    </div>
                    
                    <!-- Member 3 -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Thành viên 3</label>
                            <input type="file" 
                                   class="form-control mb-2" 
                                   name="member_3_image" 
                                   accept="image/*">
                            @if($aboutPage->member_3_image)
                                <img src="{{ Storage::url($aboutPage->member_3_image) }}" 
                                     alt="Member 3" 
                                     class="img-fluid rounded" 
                                     style="max-height: 80px;">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" 
                                           class="form-control mb-2" 
                                           name="member_3_name" 
                                           value="{{ old('member_3_name', $aboutPage->member_3_name) }}"
                                           placeholder="Tên thành viên 3">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" 
                                           class="form-control mb-2" 
                                           name="member_3_position" 
                                           value="{{ old('member_3_position', $aboutPage->member_3_position) }}"
                                           placeholder="Chức vụ">
                                </div>
                            </div>
                            <textarea class="form-control" 
                                      name="member_3_description" 
                                      rows="2"
                                      placeholder="Mô tả">{{ old('member_3_description', $aboutPage->member_3_description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-chart-bar me-2"></i>Thành Tựu & Thống Kê
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="stats_title" class="form-label fw-bold">Tiêu đề</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="stats_title" 
                                       name="stats_title" 
                                       value="{{ old('stats_title', $aboutPage->stats_title) }}"
                                       placeholder="Thành Tựu Của Chúng Tôi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="stats_subtitle" class="form-label fw-bold">Mô tả phụ</label>
                                <textarea class="form-control" 
                                          id="stats_subtitle" 
                                          name="stats_subtitle" 
                                          rows="2"
                                          placeholder="Những con số ấn tượng">{{ old('stats_subtitle', $aboutPage->stats_subtitle) }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Thống kê 1</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" 
                                               class="form-control mb-2" 
                                               name="stat_1_number" 
                                               value="{{ old('stat_1_number', $aboutPage->stat_1_number) }}"
                                               placeholder="100+">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" 
                                               class="form-control mb-2" 
                                               name="stat_1_label" 
                                               value="{{ old('stat_1_label', $aboutPage->stat_1_label) }}"
                                               placeholder="Dự Án Hoàn Thành">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control mb-2" name="stat_1_icon">
                                            <option value="">Không chọn</option>
                                            <option value="fas fa-home" {{ old('stat_1_icon', $aboutPage->stat_1_icon) == 'fas fa-home' ? 'selected' : '' }}>🏠 Home</option>
                                            <option value="fas fa-building" {{ old('stat_1_icon', $aboutPage->stat_1_icon) == 'fas fa-building' ? 'selected' : '' }}>🏢 Building</option>
                                            <option value="fas fa-project-diagram" {{ old('stat_1_icon', $aboutPage->stat_1_icon) == 'fas fa-project-diagram' ? 'selected' : '' }}>📊 Project</option>
                                            <option value="fas fa-check-circle" {{ old('stat_1_icon', $aboutPage->stat_1_icon) == 'fas fa-check-circle' ? 'selected' : '' }}>✅ Check</option>
                                            <option value="fas fa-tasks" {{ old('stat_1_icon', $aboutPage->stat_1_icon) == 'fas fa-tasks' ? 'selected' : '' }}>📋 Tasks</option>
                                            <option value="fas fa-folder-open" {{ old('stat_1_icon', $aboutPage->stat_1_icon) == 'fas fa-folder-open' ? 'selected' : '' }}>📁 Folder</option>
                                            <option value="fas fa-cogs" {{ old('stat_1_icon', $aboutPage->stat_1_icon) == 'fas fa-cogs' ? 'selected' : '' }}>⚙️ Cogs</option>
                                            <option value="fas fa-tools" {{ old('stat_1_icon', $aboutPage->stat_1_icon) == 'fas fa-tools' ? 'selected' : '' }}>🔧 Tools</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Thống kê 2</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" 
                                               class="form-control mb-2" 
                                               name="stat_2_number" 
                                               value="{{ old('stat_2_number', $aboutPage->stat_2_number) }}"
                                               placeholder="99+">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" 
                                               class="form-control mb-2" 
                                               name="stat_2_label" 
                                               value="{{ old('stat_2_label', $aboutPage->stat_2_label) }}"
                                               placeholder="Khách Hàng Hài Lòng">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control mb-2" name="stat_2_icon">
                                            <option value="">Không chọn</option>
                                            <option value="fas fa-users" {{ old('stat_2_icon', $aboutPage->stat_2_icon) == 'fas fa-users' ? 'selected' : '' }}>👥 Users</option>
                                            <option value="fas fa-user-friends" {{ old('stat_2_icon', $aboutPage->stat_2_icon) == 'fas fa-user-friends' ? 'selected' : '' }}>👫 User Friends</option>
                                            <option value="fas fa-smile" {{ old('stat_2_icon', $aboutPage->stat_2_icon) == 'fas fa-smile' ? 'selected' : '' }}>😊 Smile</option>
                                            <option value="fas fa-thumbs-up" {{ old('stat_2_icon', $aboutPage->stat_2_icon) == 'fas fa-thumbs-up' ? 'selected' : '' }}>👍 Thumbs Up</option>
                                            <option value="fas fa-heart" {{ old('stat_2_icon', $aboutPage->stat_2_icon) == 'fas fa-heart' ? 'selected' : '' }}>❤️ Heart</option>
                                            <option value="fas fa-star" {{ old('stat_2_icon', $aboutPage->stat_2_icon) == 'fas fa-star' ? 'selected' : '' }}>⭐ Star</option>
                                            <option value="fas fa-handshake" {{ old('stat_2_icon', $aboutPage->stat_2_icon) == 'fas fa-handshake' ? 'selected' : '' }}>🤝 Handshake</option>
                                            <option value="fas fa-gift" {{ old('stat_2_icon', $aboutPage->stat_2_icon) == 'fas fa-gift' ? 'selected' : '' }}>🎁 Gift</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Thống kê 3</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" 
                                               class="form-control mb-2" 
                                               name="stat_3_number" 
                                               value="{{ old('stat_3_number', $aboutPage->stat_3_number) }}"
                                               placeholder="5+">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" 
                                               class="form-control mb-2" 
                                               name="stat_3_label" 
                                               value="{{ old('stat_3_label', $aboutPage->stat_3_label) }}"
                                               placeholder="Giải Thưởng">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control mb-2" name="stat_3_icon">
                                            <option value="">Không chọn</option>
                                            <option value="fas fa-award" {{ old('stat_3_icon', $aboutPage->stat_3_icon) == 'fas fa-award' ? 'selected' : '' }}>🏆 Award</option>
                                            <option value="fas fa-trophy" {{ old('stat_3_icon', $aboutPage->stat_3_icon) == 'fas fa-trophy' ? 'selected' : '' }}>🏆 Trophy</option>
                                            <option value="fas fa-medal" {{ old('stat_3_icon', $aboutPage->stat_3_icon) == 'fas fa-medal' ? 'selected' : '' }}>🥇 Medal</option>
                                            <option value="fas fa-star" {{ old('stat_3_icon', $aboutPage->stat_3_icon) == 'fas fa-star' ? 'selected' : '' }}>⭐ Star</option>
                                            <option value="fas fa-crown" {{ old('stat_3_icon', $aboutPage->stat_3_icon) == 'fas fa-crown' ? 'selected' : '' }}>👑 Crown</option>
                                            <option value="fas fa-gem" {{ old('stat_3_icon', $aboutPage->stat_3_icon) == 'fas fa-gem' ? 'selected' : '' }}>💎 Gem</option>
                                            <option value="fas fa-certificate" {{ old('stat_3_icon', $aboutPage->stat_3_icon) == 'fas fa-certificate' ? 'selected' : '' }}>📜 Certificate</option>
                                            <option value="fas fa-ribbon" {{ old('stat_3_icon', $aboutPage->stat_3_icon) == 'fas fa-ribbon' ? 'selected' : '' }}>🎗️ Ribbon</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Thống kê 4</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" 
                                               class="form-control mb-2" 
                                               name="stat_4_number" 
                                               value="{{ old('stat_4_number', $aboutPage->stat_4_number) }}"
                                               placeholder="8">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" 
                                               class="form-control mb-2" 
                                               name="stat_4_label" 
                                               value="{{ old('stat_4_label', $aboutPage->stat_4_label) }}"
                                               placeholder="Năm Kinh Nghiệm">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control mb-2" name="stat_4_icon">
                                            <option value="">Không chọn</option>
                                            <option value="fas fa-calendar" {{ old('stat_4_icon', $aboutPage->stat_4_icon) == 'fas fa-calendar' ? 'selected' : '' }}>📅 Calendar</option>
                                            <option value="fas fa-clock" {{ old('stat_4_icon', $aboutPage->stat_4_icon) == 'fas fa-clock' ? 'selected' : '' }}>🕐 Clock</option>
                                            <option value="fas fa-history" {{ old('stat_4_icon', $aboutPage->stat_4_icon) == 'fas fa-history' ? 'selected' : '' }}>🕰️ History</option>
                                            <option value="fas fa-calendar-alt" {{ old('stat_4_icon', $aboutPage->stat_4_icon) == 'fas fa-calendar-alt' ? 'selected' : '' }}>📆 Calendar Alt</option>
                                            <option value="fas fa-hourglass-half" {{ old('stat_4_icon', $aboutPage->stat_4_icon) == 'fas fa-hourglass-half' ? 'selected' : '' }}>⏳ Hourglass</option>
                                            <option value="fas fa-stopwatch" {{ old('stat_4_icon', $aboutPage->stat_4_icon) == 'fas fa-stopwatch' ? 'selected' : '' }}>⏱️ Stopwatch</option>
                                            <option value="fas fa-birthday-cake" {{ old('stat_4_icon', $aboutPage->stat_4_icon) == 'fas fa-birthday-cake' ? 'selected' : '' }}>🎂 Birthday</option>
                                            <option value="fas fa-timeline" {{ old('stat_4_icon', $aboutPage->stat_4_icon) == 'fas fa-timeline' ? 'selected' : '' }}>📈 Timeline</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-phone me-2"></i>Call-to-Action
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="cta_title" class="form-label fw-bold">Tiêu đề CTA</label>
                        <input type="text" 
                               class="form-control" 
                               id="cta_title" 
                               name="cta_title" 
                               value="{{ old('cta_title', $aboutPage->cta_title) }}"
                               placeholder="Sẵn Sàng Tạo Nên Không Gian Mơ Ước?">
                    </div>
                    <div class="mb-3">
                        <label for="cta_subtitle" class="form-label fw-bold">Mô tả CTA</label>
                        <textarea class="form-control" 
                                  id="cta_subtitle" 
                                  name="cta_subtitle" 
                                  rows="2"
                                  placeholder="Hãy để chúng tôi giúp bạn biến ý tưởng thành hiện thực">{{ old('cta_subtitle', $aboutPage->cta_subtitle) }}</textarea>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Save Button -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">
                        <i class="fas fa-save me-2"></i>Lưu Thay Đổi
                    </h6>
                </div>
                <div class="card-body text-center">
                    <button type="submit" class="btn btn-success btn-lg w-100">
                        <i class="fas fa-save me-2"></i>Cập Nhật Trang Giới Thiệu
                    </button>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Tất cả thay đổi sẽ được lưu vào cơ sở dữ liệu
                        </small>
                    </div>
                </div>
            </div>

            <!-- Preview -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-eye me-2"></i>Xem Trước
                    </h6>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('about') }}" target="_blank" class="btn btn-info w-100">
                        <i class="fas fa-external-link-alt me-2"></i>Xem Trang Giới Thiệu
                    </a>
                </div>
            </div>

            <!-- Help -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">
                        <i class="fas fa-question-circle me-2"></i>Hướng Dẫn
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled small">
                        <li class="mb-2">
                            <i class="fas fa-info text-info me-1"></i>
                            <strong>Định nghĩa nội dung tùy ý</strong>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-1"></i>
                            Khối 1, 2, 3 có thể là bất kỳ nội dung nào
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-1"></i>
                            Ảnh tối đa 2MB (JPEG, PNG, JPG)
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-1"></i>
                            Chọn icon từ dropdown hoặc để trống
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-1"></i>
                            Nhấn "Xem Trang Giới Thiệu" để preview
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <strong>Có lỗi xảy ra:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@endsection