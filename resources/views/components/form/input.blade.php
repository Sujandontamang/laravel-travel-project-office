@props([
  'id' => $name,
  'label' => 'Label',
  'class' => '',
  'value' => '',
  'type' => 'text',
  'message' => '',
  'col' => '12',
  'req' => false,
  'labelDisplay' => true,
  'tooltip' => false,
  'tooltip_text' => 'Tooltip on top',
  'name'
])
<div class="col-md-{{$col}}">

    @if($labelDisplay === true)
        <label for="{{$id}}" class="col-form-label">{{$label}} @if($req === true)
                <span class="text-danger">*</span>
            @endif
            @if($tooltip === true)
                    <i class='bx bx-xs bxs-info-circle' data-bs-toggle="tooltip" data-bs-placement="right" title="{{$tooltip_text}}"></i>
            @endif
        </label>
    @endif
    <input type="{{$type}}" {{ $attributes->merge(['class' => $class . ' form-control text-14']) }} name="{{$name}}" id="{{$id}}" value="{{$value}}" {{$attributes}}>

    @error($name) <span class="text-danger small">{{ $message }}</span> @enderror
</div>
