<div class="row gx-3 align-center mt-4">
    <div class="col-lg-5">
        <div class="form-group">
            <label class="form-label" for="{{{ $id }}}">
                {{ $dataArray ? $dataArray['title'] : $title }}
            </label>
            <span class="form-note">
                {{ $dataArray ? $dataArray['description'] : $description }}
            </span>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="d-none" name="{{ $id }}" value="0" checked>
                <input type="checkbox" class="custom-control-input"
                       name="{{ $id }}" id="{{ $id }}" value="1"
                        {{
                            old($id) ?? ($dataArray ?
                            ($dataArray['value'] ? 'checked' : '') :
                            ($value ? 'checked' : ''))
                        }}>

                <label class="custom-control-label" for="{{ $id }}"></label>
            </div>
        </div>
    </div>
</div>

