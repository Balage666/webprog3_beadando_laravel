<div class="form-outline mb-4">

    <label for={{ $name }} @class(['form-label', 'fw-bold'])>
        {{ $label }}
    </label>

    <input

        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"

        @class(['form-control', 'form-control-lg'])
        @required($isRequired)
    >

</div>


