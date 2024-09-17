{{ Form::model($payment_data, ['method' => 'POST', 'route' => ['paymentsettingsUpdates'], 'enctype' => 'multipart/form-data', 'data-toggle' => 'validator']) }}

{{ Form::hidden('id', null, array('placeholder' => 'id', 'class' => 'form-control')) }}
{{ Form::hidden('type', $tabpage, array('placeholder' => 'id', 'class' => 'form-control')) }}
<div class="row">
    <div class="form-group col-md-12">
        <label for="enable_momo">{{__('messages.payment_on', ['gateway' => __('messages.momo')])}}</label>
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" name="status" id="enable_momo" {{!empty($payment_data) && $payment_data->status == 1 ? 'checked' : ''}}>
            <label class="custom-control-label" for="enable_momo"></label>
        </div>
    </div>
</div>
<div class="row" id='enable_momo_payment'>
    <div class="form-group col-md-12">
        <label
            class="form-control-label">{{__('messages.payment_option', ['gateway' => __('messages.momo')])}}</label><br />
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input is_test" value="on" name="is_test" data-type="is_test_mode"
                    {{!empty($payment_data) && $payment_data->is_test == 1 ? 'checked' : ''}}>{{__('messages.is_test_mode')}}
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input is_test" value="off" name="is_test" data-type="is_live_mode"
                    {{!empty($payment_data) && $payment_data->is_test == 0 ? 'checked' : ''}}>{{__('messages.is_live_mode')}}
            </label>
        </div>
        <small class="help-block with-errors text-danger"></small>
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('title', trans('messages.gateway_name') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
        {{ Form::text('title', old('title'), ['id' => 'title', 'placeholder' => trans('messages.title'), 'class' => 'form-control']) }}
        <small class="help-block with-errors text-danger"></small>
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('momo_url', trans('messages.momo_url') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
        {{ Form::text('momo_url', old('momo_url'), ['id' => 'momo_url', 'placeholder' => trans('messages.momo_url'), 'class' => 'form-control']) }}
        <small class="help-block with-errors text-danger"></small>
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('momo_partnerCode', trans('messages.momo_partnerCode') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
        {{ Form::text('momo_partnerCode', old('momo_partnerCode'), ['id' => 'momo_partnerCode', 'placeholder' => trans('messages.momo_partnerCode'), 'class' => 'form-control']) }}
        <small class="help-block with-errors text-danger"></small>
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('momo_accesskey', trans('messages.momo_accesskey') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
        {{ Form::text('momo_accesskey', old('momo_accesskey'), ['id' => 'momo_accesskey', 'placeholder' => trans('messages.momo_accesskey'), 'class' => 'form-control']) }}
        <small class="help-block with-errors text-danger"></small>
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('momo_secretKey', trans('messages.momo_secretKey') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
        {{ Form::text('momo_secretKey', old('momo_secretKey'), ['id' => 'momo_secretKey', 'placeholder' => trans('messages.momo_secretKey'), 'class' => 'form-control']) }}
        <small class="help-block with-errors text-danger"></small>
    </div>
</div>
{{ Form::submit(__('messages.save'), ['class' => "btn btn-md btn-primary float-md-right"]) }}
{{ Form::close() }}
<script>
    var enable_momo = $("input[name='status']").prop('checked');
    checkPaymentTabOption(enable_momo);

    $('#enable_momo').change(function () {
        value = $(this).prop('checked') == true ? true : false;
        checkPaymentTabOption(value);
    });
    function checkPaymentTabOption(value) {
        if (value == true) {
            $('#enable_momo_payment').removeClass('d-none');
            $('#title').prop('required', true);
            $('#momo_url').prop('required', true);
            $('#momo_partnerCode').prop('required', true);
            $('#momo_accesskey').prop('required', true);
            $('#momo_secretKey').prop('required', true);
        } else {
            $('#enable_momo_payment').addClass('d-none');
            $('#title').prop('required', false);
            $('#momo_url').prop('required', false);
            $('#momo_partnerCode').prop('required', false);
            $('#momo_accesskey').prop('required', false);
            $('#momo_secretKey').prop('required', false);
        }
    }

    var get_value = $('input[name="is_test"]:checked').data("type");
    getConfig(get_value)
    $('.is_test').change(function () {
        value = $(this).prop('checked') == true ? true : false;
        type = $(this).data("type");
        getConfig(type)

    });

    function getConfig(type) {
        var _token = $('meta[name="csrf-token"]').attr('content');
        var page = "{{$tabpage}}";
        $.ajax({
            url: "/get_payment_config",
            type: "POST",
            data: {
                type: type,
                page: page,
                _token: _token
            },
            success: function (response) {
                var obj = '';
                var momo_url = momo_partnerCode = momo_accesskey = title = '';

                if (response) {

                    if (response.data.type == 'is_test_mode') {
                        obj = JSON.parse(response.data.value);
                    } else {
                        obj = JSON.parse(response.data.live_value);
                    }

                    if (response.data.title != '') {
                        title = response.data.title
                    }

                    if (obj !== null) {
                        var momo_url = obj.momo_url;
                        var momo_partnerCode = obj.momo_partnerCode;
                        var momo_accesskey = obj.momo_accesskey;
                        var momo_secretKey = obj.momo_secretKey;
                    }

                    $('#momo_url').val(momo_url)
                    $('#momo_partnerCode').val(momo_partnerCode)
                    $('#momo_accesskey').val(momo_accesskey)
                    $('#momo_secretKey').val(momo_secretKey)
                    $('#title').val(title)

                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

</script>