@if(isset($options->model) && isset($options->type))

    @if(class_exists($options->model))

        @php $relationshipField = $row->field; @endphp

        @if($options->type == 'belongsTo')

            @if(isset($view) && ($view == 'browse' || $view == 'read'))

                @php
                    $relationshipData = (isset($data)) ? $data : $dataTypeContent;
                    $model = app($options->model);
                    if (method_exists($model, 'getRelationship')) {
                        $query = $model::getRelationship($relationshipData->{$options->column});
                    } else {
                        $query = $model::find($relationshipData->{$options->column});
                    }
                @endphp

                @if(isset($query))
                    <p>{{ $query->{$options->label} }}</p>
                @else
                    <p>No results</p>
                @endif

            @else

                <select class="form-control select2" name="{{ $options->column }}">
                    <option value="">Choose ...</option>
                    @php
                        $model = app($options->model);
                        $query = $model::all();
                    @endphp
                    @foreach($query as $relationshipData)
                        <option value="{{ $relationshipData->{$options->key} }}" @if($dataTypeContent->{$options->column} == $relationshipData->{$options->key}){{ 'selected="selected"' }}@endif>{{ $relationshipData->{$options->label} }}</option>
                    @endforeach
                </select>

            @endif

        @elseif($options->type == 'hasOne')

            @php

                $relationshipData = (isset($data)) ? $data : $dataTypeContent;

                $model = app($options->model);
                $query = $model::where($options->column, '=', $relationshipData->id)->first();

            @endphp

            @if(isset($query))
                <p>{{ $query->{$options->label} }}</p>
            @else
                <p>None results</p>
            @endif

        @elseif($options->type == 'hasMany')

            @if(isset($view) && ($view == 'browse' || $view == 'read'))

                @php
                    $relationshipData = (isset($data)) ? $data : $dataTypeContent;
                    $model = app($options->model);
                    $selected_values = $model::where($options->column, '=', $relationshipData->id)->pluck($options->label)->all();
                @endphp

                @if($view == 'browse')
                    @php
                        $string_values = implode(", ", $selected_values);
                        if(strlen($string_values) > 25){ $string_values = substr($string_values, 0, 25) . '...'; }
                    @endphp
                    @if(empty($selected_values))
                        <p>No results</p>
                    @else
                        <p>{{ $string_values }}</p>
                    @endif
                @else
                    @if(empty($selected_values))
                        <p>No results</p>
                    @else
                        <ul>
                            @foreach($selected_values as $selected_value)
                                <li>{{ $selected_value }}</li>
                            @endforeach
                        </ul>
                    @endif
                @endif

            @else

                @php
                    $model = app($options->model);
                    $query = $model::where($options->column, '=', $dataTypeContent->id)->get();
                @endphp
                @if(isset($query))

                    @if($options->model == 'App\Models\RoomSeasin')
                        <a href="/admin/room-seasins/create?parent={{$query->first()->room_id}}" class="btn btn-success" title="Add Season"><i
                                    class="fas fa-plus"></i></a>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>price</th>
                                    <th>Sale</th>
                                    <th>edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($query as $i => $query_res)
                                    <tr>
                                        <td>{{$i + 1}}</td>
                                        <td>{{ $query_res->season->name }}</td>
                                        <td>{{$query_res->season->start}}</td>
                                        <td>{{$query_res->season->end}}</td>
                                        <td>{{$query_res->price}}</td>
                                        <td>{{$query_res->sale??0}}</td>
                                        <td>
                                            <a href="/admin/room-seasins/{{$query_res->id}}/edit?parent={{$query_res->room_id}}"
                                               class="btn btn-info">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    @else
                        <ul>
                            @foreach($query as $query_res)
                                <li>{{ $query_res->{$options->label} }}</li>
                            @endforeach
                        </ul>
                    @endif

                @else
                    <p>No results</p>
                @endif

            @endif

        @elseif($options->type == 'belongsToMany')

            @if(isset($view) && ($view == 'browse' || $view == 'read'))

                @php
                    $relationshipData = (isset($data)) ? $data : $dataTypeContent;
                    $selected_values = isset($relationshipData) ? $relationshipData->belongsToMany($options->model, $options->pivot_table)->pluck($options->label)->all() : array();
                @endphp

                @if($view == 'browse')
                    @php
                        $string_values = implode(", ", $selected_values);
                        if(strlen($string_values) > 25){ $string_values = substr($string_values, 0, 25) . '...'; }
                    @endphp
                    @if(empty($selected_values))
                        <p>No results</p>
                    @else
                        <p>{{ $string_values }}</p>
                    @endif
                @else
                    @if(empty($selected_values))
                        <p>No results</p>
                    @else
                        <ul>
                            @foreach($selected_values as $selected_value)
                                <li>{{ $selected_value }}</li>
                            @endforeach
                        </ul>
                    @endif
                @endif

            @else

                <select class="form-control select2" name="{{ $relationshipField }}[]" multiple>

                    @php
                        $selected_values = isset($dataTypeContent) ? $dataTypeContent->belongsToMany($options->model, $options->pivot_table)->pluck($options->table.'.'.$options->key)->all() : array();
                                $relationshipOptions = app($options->model)->all();
                    @endphp

                    @foreach($relationshipOptions as $relationshipOption)
                        <option value="{{ $relationshipOption->{$options->key} }}" @if(in_array($relationshipOption->{$options->key}, $selected_values)){{ 'selected="selected"' }}@endif>{{ $relationshipOption->{$options->label} }}</option>
                    @endforeach

                </select>

            @endif

        @endif

    @else

        cannot make relationship because {{ $options->model }} does not exist.

    @endif

@endif
