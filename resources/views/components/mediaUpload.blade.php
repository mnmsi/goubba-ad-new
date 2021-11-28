<div class="col-md-8">
    <div class="custom-file">
        <div id="imageSection">
            <input
                type="file" class="custom-file-input"
                id="customFile_{{explode('[]', $fileName)[0]}}" name="{{$fileName}}" {{ $multiStatus }} accept="{{ $fileType }}/*">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
        {{-- <span class="help-inline alert-danger">{{ $errors->first($fileName) }}</span> --}}
    </div>
</div>
<div class="col-md-4">
    <input type="url" id="{{$referalName}}" name="{{$referalName}}" placeholder="Enter Referal Link" class="form-control" value="{{ $referalLink ?? ''}}">
</div>

