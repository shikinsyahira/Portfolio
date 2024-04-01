@extends('admin.layout.main')
@section('main')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Portofolio Project</h1>
      </div>
      <div class="col-lg-7">
        <form method="POST" action="/admin/portofolio/{{ $project->id }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            {{-- title --}}
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" id="title" name="title" class="form-control @error ('title') is-invalid @enderror" value="{{ old('title', $project->title) }}">
              @error('title')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            {{-- slug --}}
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" id="slug" name="slug" class="form-control @error ('slug') is-invalid @enderror" value="{{ old('slug', $project->slug) }}">
                @error('slug')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            {{-- Post image --}}
            <div class="mb-3">
                <label for="image" class="form-label  @error ('image') is-invalid @enderror">Post Image</label>
                <input type="hidden" name="oldimage" value=" {{ $project->image }}">
                <input class="form-control" type="file" id="image" name="image">
                @if ($project->image)
                <img id="currentImage" src="{{ asset('storage/'.$project->image) }}" class="img-fluid" style="max-height: 200px;" />
                
                @else
                <div id="imagePreview" class="mt-4">
                  <img  class="img-fluid" style="max-height: 200px;" />
                </div> 
                @endif
                @error('image')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
            {{-- git link --}}
            <div class="mb-3">
                <label for="git_link" class="form-label">Git Link</label>
                <input type="text" id="git_link" name="git_link" class="form-control @error ('git_link') is-invalid @enderror" value="{{ old('git_link',$project->git_link) }}">
                @error('git_link')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
      </div>
</main>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
        $('#title').change(function(e) {
            var title = $(this).val();
            $.get('{{ url('/admin/portofolio/check_slug') }}/' + encodeURIComponent(title))
                .done(function(response) {
                    $('#slug').val(response.slug);
                });
        });
    });
</script>
<script>
  $(document).ready(function () {
    $("#title").on("input", function () {
        var titleValue = $(this).val().toLowerCase();
        titleValue = titleValue.replace(/\s+/g, '-');
        $("#slug").val(titleValue);
    });
});
</script>
<script>
    // Function to display preview of selected image
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#currentImage').attr('src', e.target.result);
                $('#currentImage').show();
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    // Trigger preview when a file is selected
    $("#image").change(function() {
        previewImage(this);
    });

    // Display preview when editing an existing image
    $(document).ready(function() {
        var existingImage = "{{ $existingImage ?? '' }}"; // Assuming you pass the existing image URL from the backend
        if (existingImage) {
            $('#currentImage').attr('src', existingImage);
            $('#currentImage').show();
        }
    });
</script>
@endsection