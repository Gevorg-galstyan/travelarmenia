<br>
@php($watermarks = \App\Models\Watermark::get())
<input @if($row->required == 1) required @endif type="file" name="{{ $row->field }}[]" multiple="multiple">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Watermark</label>
            <select class="form-control my-select2" name="multiple_watermark">
                <option value="">Select...</option>
                @foreach($watermarks as $watermark)
                    <option value="{{$watermark->image}}">{{Voyager::image($watermark->thumbnail('tumb'))}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>bottom</label>
            <input type="number" class="form-control" name="bottom">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>right</label>
            <input type="number" class="form-control" name="right">
        </div>
    </div>
</div>

@if(isset($dataTypeContent->{$row->field}))
    <?php $images = json_decode($dataTypeContent->{$row->field}); ?>
    @if($images != null)
        @foreach($images as $image)
            <div class="col-md-3">
                <div class="img_settings_container" data-field-name="{{ $row->field }}">
                    <a href="#" class="voyager-x remove-multi-image btn btn-danger"></a>
                    <img src="{{ Voyager::image( $image ) }}" data-image="{{ $image }}"
                         data-id="{{ $dataTypeContent->id }}" width="100%">
                </div>
            </div>
        @endforeach
    @endif
@endif
<div class="clearfix"></div>
