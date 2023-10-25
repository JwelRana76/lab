<x-admin title="Patient Details">
    {{-- <x-page-header head="Patient Details" /> --}}
    <x-card header="Patient Details" link="{{ route('patient.index') }}" title="Patient List">
        <table class="table">
            <tr>
                <td>Name</td>
                <td>:</td>
                <td>{{ $patient->name }}</td>
                <td>Age</td>
                <td>:</td>
                <td>{{ $patient->ages }}</td>
            </tr>
            <tr>
                <td>Contact</td>
                <td>:</td>
                <td>{{ $patient->contact }}</td>
                <td>Address</td>
                <td>:</td>
                <td>{{ $patient->address }}</td>
            </tr>
            <tr>
                <td>Doctor</td>
                <td>:</td>
                <td>{{ $patient->doctor->name ?? 'N/A' }}</td>
                <td>Visit Date</td>
                <td>:</td>
                <td>{{ date('d-M-Y',strtotime($patient->visit_date)) }}</td>
            </tr>
        </table>
        <h5 class="my-4">Patient Documents</h5>
        <hr>
        <div id="imageModal" class="modal">
            <span class="close" id="closeModal">&times;</span>
            <img src="" id="modalImage" class="modal-content">
            <a id="downloadButton" href="#" download>Download</a>
        </div>
        <div class="row">
            <div class="row">
                @foreach ($patient->documents as $document)
                    <div class="col-md-4 col-sm-12 document">
                        <img class="w-100" src="/upload/document/{{ $document->document }}" alt="Documents" onclick="openModal(this)">
                    </div>
                @endforeach
            </div>

        </div>
    </x-card>
    @push('js')
       <script>
        function openModal(image) {
            var modal = document.getElementById("imageModal");
            var modalImage = document.getElementById("modalImage");
            var downloadButton = document.getElementById("downloadButton");

            modal.style.display = "block";
            modalImage.src = image.src;
            downloadButton.href = image.src; // Set the download link to the image source
        }

        // Function to close the modal
        document.getElementById("closeModal").addEventListener("click", function() {
            var modal = document.getElementById("imageModal");
            modal.style.display = "none";
        });

        // Close the modal when the user clicks anywhere outside of it
        window.onclick = function(event) {
            var modal = document.getElementById("imageModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
       </script>
    @endpush
</x-admin>