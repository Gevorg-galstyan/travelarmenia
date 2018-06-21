@php($watermarks = \App\Models\Watermark::get())
@if(isset($dataTypeContent->{$row->field}))
    <img src="@if( !filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL)){{ Voyager::image( $dataTypeContent->{$row->field} ) }}@else{{ $dataTypeContent->{$row->field} }}@endif"
         style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
@endif
<input @if($row->required == 1 && !isset($dataTypeContent->{$row->field})) required @endif type="file" name="{{ $row->field }}">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Watermark</label>
            <select class="form-control my-select2" name="watermark">
                <option value="">Select...</option>
                @foreach($watermarks as $watermark)
                    <option
                            value="{{$watermark->image}}"
                    >{{Voyager::image($watermark->thumbnail('tumb'))}}</option>
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