@if (count($entity_name::$struct_formats[$struct]) > 6)

<select name="{{ $struct }}" lay-verify="required" lay-filter="aihao" lay-search>
  <option value=""></option>
@foreach ($entity_name::$struct_formats[$struct] as $key => $value)
  <option value="{{ $key }}">{{ $value }}</option>
@endforeach
</select>

@else

@foreach ($entity_name::$struct_formats[$struct] as $key => $value)
<input type="radio" name="{{ $struct }}" value="{{ $key }}" title="{{ $value }}">
@endforeach

@endif
