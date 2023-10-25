<x-admin title="Upload Document">
  <style>
    /* Define the CSS styles for the displayed images */
    .show_document img {
      max-width: 100px; 
      max-height: 100px;
      margin: 10px;
      border: 1px solid #ddd;
    }
  </style>
    {{-- <x-page-header head="Create Patient" /> --}}
    <x-card header="Upload Document" link="{{ route('patient.index') }}" title="Patient List">
      <x-form action="{{ route('patient.upload_document_store',$patient->id) }}" method="post" id="patient_form">
        <hr>
        <div class="row">
          <x-input id="document" name="document[]" type="file" multiple onchange="displaySelectedFiles()" required  />
          <div class="col-md-12">
            <hr>
            <h6>Document show Space</h6>
            <hr>
            <div class="show_document">

            </div>
          </div>
        </div>
        <x-button type="submit" />
      </x-form>
    </x-card> 
    
@push('js')
    <script>
    function displaySelectedFiles() {
      const fileInput = document.getElementById('document');
      const showDocumentDiv = document.querySelector('.show_document');
      showDocumentDiv.innerHTML = ''; // Clear the previous content

      if (fileInput.files.length > 0) {
        for (const file of fileInput.files) {
          const fileReader = new FileReader();

          fileReader.onload = function (e) {
            const fileURL = e.target.result;

            // Create an image element to display the selected file (you can modify this for other file types)
            const img = document.createElement('img');
            img.src = fileURL;

            // Append the image to the show_document div
            showDocumentDiv.appendChild(img);
          };

          fileReader.readAsDataURL(file);
        }
      }
    }
  </script>
@endpush

</x-admin>