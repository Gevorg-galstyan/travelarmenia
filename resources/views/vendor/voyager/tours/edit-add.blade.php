@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager.generic.'.(!is_null($dataTypeContent->getKey()) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager.generic.'.(!is_null($dataTypeContent->getKey()) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                          class="form-edit-add"
                          action="@if(!is_null($dataTypeContent->getKey())){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                    @if(!is_null($dataTypeContent->getKey()))
                        {{ method_field("PUT") }}
                    @endif

                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{(!is_null($dataTypeContent->getKey()) ? 'editRows' : 'addRows' )};
                            @endphp

                            @foreach($dataTypeRows as $row)
                            <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                    $options = json_decode($row->details);
                                    $display_options = isset($options->display) ? $options->display : NULL;
                                @endphp
                                @if ($options && isset($options->formfields_custom))
                                    @include('voyager::formfields.custom.' . $options->formfields_custom)
                                @else
                                    <div class="form-group {{$row->type == 'relationship' ? 'col-md-4':''}} @if($row->type == 'hidden') hidden @endif @if(isset($display_options->width)){{ 'col-md-' . $display_options->width }}@else{{ '' }}@endif" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                        {{ $row->slugify }}
                                        <h4 class="text-center">{{ $row->display_name }}</h4>
                                        @include('voyager::multilingual.input-hidden-bread-edit-add')
                                        @if($row->type == 'relationship')
                                            @include('vendor.voyager.tours.relationship')
                                        @else
                                            {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                        @endif

                                        @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                            {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                        @endforeach
                                    </div>
                                @endif
                                @if($row->type == 'image')
                                    <div class="form-group col-md-12 date-column">
                                        <h4 class="text-center">
                                            Date
                                            <button type="button" class="btn btn-info add_date" title="Add Date">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </h4>
                                        @if(isset($dataTypeContent->check_in) && !empty($dataTypeContent->check_in))
                                            @php
                                                $check_ins = explode('/', $dataTypeContent->check_in);
                                                $check_outs = explode('/', $dataTypeContent->check_out);
                                            @endphp
                                        @foreach($check_ins as $i => $item)
                                            <div class="col-sm-4" data-status="delete_date_1">
                                                <div class="panel panel-info ">
                                                    <div class="panel panel-body text-center">
                                                        <div class=" text-center input-group">
                                                            <div class="form-group">
                                                                <label for="sel1" class="text-center">Check in</label>
                                                                <input type="date" class="input-sm form-control"
                                                                       name="start[]" value="{{$item}}" required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="sel1" class="text-center">Check out</label>
                                                                <input type="date" class="input-sm form-control"
                                                                       name="end[]" value="{{$check_outs[$i]}}" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-danger delete_date"
                                                            data-target="delete_date_1">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <h4 class="text-center">Price Table</h4>
                                        <div class="col-sm-2 col-sm-offset-2">
                                            <div class="form-group">
                                                <input type="number"
                                                       class="form-control price-row"
                                                       placeholder="Row">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input type="number"
                                                       class="form-control column"
                                                       placeholder="Column">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input type="button"
                                                       class="form-control btn btn-success create-pricing-table"
                                                       data-href="{{route('price_table')}}"
                                                       value="Create">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 pricing-content">
                                        @if(isset($dataTypeContent->pricing) && $dataTypeContent->pricing()->count())
                                            @php($data = json_decode($dataTypeContent->pricing->details,true))
                                            <table class="table table-responsive table-bordered">
                                                <thead>
                                                <tr>
                                                    <th class="text-center"><h4>Hotel Name</h4></th>
                                                    @foreach($data[0]['column'] as $i => $column)
                                                        <th data-status="count_{{$i}}">
                                                            <button type="button"
                                                                    class=" btn-danger pull-right delete-pricing"
                                                                    data-target="count_{{$i}}">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="column[{{$i}}]"
                                                                   value="{{$column['title']}}"
                                                                   placeholder="Enter Count Man">
                                                            <input type="hidden" value="{{$i}}"
                                                                   name="test_column[{{$i}}]">
                                                        </th>
                                                    @endforeach
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data as $j => $row)
                                                    <tr>
                                                        <td data-change="{{$j}}">
                                                            <div class="col-md-3">
                                                                <button type="button"
                                                                        class="btn btn-default change-hotel-name"
                                                                        data-target="{{$j}}">
                                                                    <i class="fas fa-exchange-alt"></i>
                                                                </button>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control"
                                                                           name="hotel_name_ru[{{$j}}]"
                                                                           placeholder="Ru Name"
                                                                           @if($row['hotel_id'])
                                                                           style="display: none" disabled
                                                                           @else
                                                                           value="{{$row['hotel_ru_name']}}"
                                                                            @endif>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control"
                                                                           name="hotel_name_en[{{$j}}]"
                                                                           placeholder="En Name"
                                                                           @if($row['hotel_id'])
                                                                           style="display: none" disabled
                                                                           @else
                                                                           value="{{$row['hotel_en_name']}}"
                                                                            @endif
                                                                    >
                                                                </div>
                                                                <input type="hidden" value="{{$j}}" name="row[{{$j}}]">

                                                                <select class="form-control {{$row['hotel_id'] ? ' flag' : ''}}"
                                                                        style="display: {{$row['hotel_id'] ? 'block' : 'none'}}"
                                                                        data-placeholder="Select a hotel"
                                                                        name="hotel_id[{{$j}}]"
                                                                        {{!$row['hotel_id']?'disabled':''}}>
                                                                    <option value=""></option>
                                                                    @foreach($hotels as $hotel)
                                                                        @if (($hotel->city->count() && $hotel->city->capital == 1))

                                                                            <option value="{{$hotel->id}}"
                                                                                    {{$row['hotel_id'] == $hotel->id ? 'selected':''}}>
                                                                                {{$hotel->translate()->name}}
                                                                            </option>
                                                                        @else
                                                                            @continue
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </td>
                                                        @foreach($data[$j]['column'] as $i => $column)
                                                            <td data-status="count_{{$i}}">
                                                                <input type="text"
                                                                       class="form-control"
                                                                       placeholder="Enter Price"
                                                                       value="{{$column['value']}}"
                                                                       name="individual_price[{{$j}}][{{$i}}]"

                                                                >
                                                            </td>
                                                        @endforeach
                                                        <td>
                                                            <button type="button" class="btn-danger delete-row"
                                                                    data-td="row_{{$j}}">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                @endif
                            @endforeach

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">{{ __('voyager.generic.save') }}</button>
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                               onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager.generic.are_you_sure') }}
                    </h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager.generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ __('voyager.generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger"
                            id="confirm_delete">{{ __('voyager.generic.delete_confirm') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {}
        var $image

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
            $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function (i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', function (e) {
                $image = $(this).siblings('img');

                params = {
                    slug: '{{ $dataType->slug }}',
                    image: $image.data('image'),
                    id: $image.data('id'),
                    field: $image.parent().data('field-name'),
                    _token: '{{ csrf_token() }}'
                }

                $('.confirm_delete_name').text($image.data('image'));
                $('#confirm_delete_modal').modal('show');
            });

            $('#confirm_delete').on('click', function () {
                $.post('{{ route('voyager.media.remove') }}', params, function (response) {
                    if (response
                        && response.data
                        && response.data.status
                        && response.data.status == 200) {

                        toastr.success(response.data.message);
                        $image.parent().fadeOut(300, function () {
                            $(this).remove();
                        })
                    } else {
                        toastr.error("Error removing image.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
        $(".my-select2").select2({
            width: 'resolve',
            formatResult: format,
            formatSelection: format,
            templateResult: format,
            escapeMarkup: function (m) {
                if (m == 'Select...') {
                    return m;
                }
                return '<div><img class="flag"  src="' + m + '"/></div>';
            }
        });
        $('#slug').slugify();
        function format(state) {
            return state.text;
        }
    </script>
@stop
