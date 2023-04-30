<div class="form-outline mb-4">

    <label for={{ $name }} @class(['form-label', 'fw-bold'])>
        {{ $label }}
    </label>

    <textarea
        name="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        @class(['form-control', 'form-control-lg'])
        @required($isRequired)
    >{{ $value ? $value : '' }}</textarea>

</div>
