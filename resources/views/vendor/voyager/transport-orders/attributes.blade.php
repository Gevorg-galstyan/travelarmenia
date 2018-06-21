@if(isset($data) && !empty($data))
    @php
        $data = explode(',',$data);
        $attributes = \App\Models\TransportAttribute::whereIn('id', $data)->get();

        $attributes_name = [];

        foreach($attributes as $attribute):

            $attributes_name[] = $attribute->name;

        endforeach;
    $attributes_name = implode(' , ', $attributes_name);
    @endphp

    {{$attributes_name}}
@endif