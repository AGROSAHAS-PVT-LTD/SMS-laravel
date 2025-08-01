@if (isset($schoolSettings['expert_teachers_status']) && $schoolSettings['expert_teachers_status'] == 1 && count($teachers))
    <section class="ourTeacher commonMT commonWaveSect">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="flex_column_center">
                        <span class="commonTag"> {{ $schoolSettings['expert_teachers_title'] ?? 'Our Teachers' }}
                        </span>
                        <span class="commonTitle">
                            {{ $schoolSettings['expert_teachers_heading'] ?? 'Our Expert Teachers' }}
                        </span>

                        <span class="commonDesc">
                            {{ $schoolSettings['expert_teachers_description'] ?? '' }}
                        </span>
                    </div>
                </div>

                <div class="col-12">
                    <div class="commonSlider">
                        <div class="slider-container">
                            <div class="slider-content owl-carousel">
                                <!-- Example slide -->
                                @foreach ($teachers as $teacher)
                                    <div class="swiperDataWrapper">
                                        <div class="card">
                                            <div>
                                                @if ($teacher->image)
                                                    <img src="{{ $teacher->image ? $teacher->image : asset('assets/no_image_available.jpg') }}" alt="no image available" onerror="this.onerror=null; this.src='{{ asset('assets/no_image_available.jpg') }}';" class="me-2" alt="image">
                                                @else
                                                    <img src="{{ asset('assets/no_image_available.jpg') }}" alt="no image available" onerror="this.onerror=null; this.src='{{ asset('assets/no_image_available.jpg') }}';" class="me-2" alt="image">
                                                @endif
                                            </div>
                                            <div class="teacherDetails">
                                                <span class="name">{{ $teacher->full_name }}</span>
                                                @if ($teacher->staff)
                                                    <span class="subject">{{ $teacher->staff->qualification }}</span>    
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- Add more swiperDataWrapper elements here -->
                            </div>
                            <!-- Navigation buttons -->
                            <div class="navigationBtns">
                                <button class="prev commonBtn">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </button>
                                <button class="next commonBtn">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<!-- ourTeacher ends here  -->