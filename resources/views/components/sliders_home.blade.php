<div class="slider">
    <ul class="navigation">
        <li>-
            <a href="#" id="slider_nav_prev"><i class="fas fa-chevron-left"></i></a>
        </li>
        <li>
            <a href="#" id="slider_nav_next"><i class="fas fa-chevron-right"></i></a>
        </li>
    </ul>
    @foreach($sliders as $slider)
    <div class="slider-item">
        <div class="row">
            <div class="col-md-7">
                {!! $slider->content !!}
            </div>
            <div class="col-md-5">
                <img src="{{ url('/uploads/'.$slider->file_path.'/'.$slider->file_name) }}" class="img-fluid">
            </div>
        </div>
    </div>
    @endforeach
</div>
