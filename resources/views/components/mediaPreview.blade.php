<div class="form-group">
    <label class="control-label">{{ $previewType }} Preview</label>
    <div class="controls">
        <div class="preview-images-zone ui-sortable"  id="previewImagesZone">
                @foreach ($files as $file)
                    @if ($previewType == 'Image')
                        <div class="preview-image preview-show-{{ $identifier ?? '' }}-{{ $loop->index + 1}}">
                            <div class="image-cancel-{{ $identifier ?? '' }}" data-no="{{ $loop->index + 1}}" data-name="{{ $file->image_link }}">x</div>

                            <div class="image-zone">
                                <img id="pro-img-{{ $loop->index + 1}}" src="{{ URL::asset($file->image_link) }}"  width="25%" height="auto">
                            </div>
                        </div>
                    @else
                        <a href="{{ URL::asset($file->video_link) }}">
                            {{ URL::asset($file->video_link) }}
                        </a>
                    @endif
                @endforeach
        </div>
    </div>
</div>