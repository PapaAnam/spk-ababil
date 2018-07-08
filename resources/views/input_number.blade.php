<div class="form-group">
  <label for="{{ $id }}" class="col-lg-2 control-label">{{ $label }}</label>
  <div class="col-sm-6">
    <input name="{{ $id }}" type="number" class="form-control" id="{{ $id }}" placeholder="{{ $label }}" value="{{ old($id) ? old($id) : (isset($value) ? $value : '') }}">
  </div>
</div>