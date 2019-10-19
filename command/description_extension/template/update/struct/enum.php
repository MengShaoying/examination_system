@if (count($entity_name::$struct_formats[$struct]) > 6)

<select name="{{ $struct }}" lay-verify="required" lay-filter="aihao">
  <option value=""></option>
@foreach ($entity_name::$struct_formats[$struct] as $key => $value)
  <option value="{{ $key }}" ^{^{ '{{ $key }}' === ${{ $entity_name }}->{{$struct}}?'selected':'' ^}^}>{{ $value }}</option>
@endforeach
</select>

@else

@foreach ($entity_name::$struct_formats[$struct] as $key => $value)
  <input type="radio" name="{{ $struct }}" value="{{ $key }}" title="{{ $value }}" ^{^{ '{{ $key }}' === ${{ $entity_name }}->{{$struct}}?'checked':'' ^}^}>
@endforeach

@endif
