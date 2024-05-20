<div class="form-group">
    <label for="country">{{$xlabel}}</label>
    <input type="{{$xtype}}"  name="{{$xname}}" id="{{$xname}}" value=""
        placeholder="{{$xplaceholder}}" class="form-control">
</div>
<span class="text-danger">
    @error('country')
        {{ $message }}
    @enderror
</span>
