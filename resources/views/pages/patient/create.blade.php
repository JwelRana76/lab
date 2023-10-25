<x-admin title="Create Patient">
    {{-- <x-page-header head="Create Patient" /> --}}
    <x-card header="Create Patient" link="{{ route('patient.index') }}" title="Patient List">
      <x-form action="{{ route('patient.store') }}" method="post" id="patient_form">
        <div class="row">
          <x-select id="type" label="Patient Type" selectedId="1" :options="$type" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-select id="contact_no" label="Select Contact Number" :options="[]" class="col-md-6 col-xl-4 col-sm-12 d-none contact_no" />
        </div>
        <hr>
        <div class="row">
          <div class="col-12">
            <h5>Patient Details</h5>
            <hr>
          </div>
          <x-input id="visit_date" type="date" value="{{ date('Y-m-d') }}" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-input id="name" required class="col-md-6 col-xl-4 col-sm-12" />
          <div class=" col-md-6 col-xl-4 col-sm-12">
            <label for="age">Age</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <input type="text" name="age" class="form-control" >
              </div>
              <select class="custom-select" name="age_type" id="inputGroupSelect01">
                <option value="1">Days</option>
                <option value="2">Months</option>
                <option selected value="3">Years</option>
              </select>
            </div>
          </div>
          <x-input id="contact" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-input id="address" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-select id="doctor_id" label="Doctor" :options="$doctors" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-select id="gender_id" label="Gender" :options="$gender" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-select id="religion_id" label="Religion" :options="$religion" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-select id="blood_group_id" label="Blood Group" :options="$blood_group" required class="col-md-6 col-xl-4 col-sm-12" />
        </div>
        <x-button type="submit" />
      </x-form>
    </x-card> 
    
@push('js')
    <script>
      $('select[name="type"]').change(function () {
        if ($(this).val() == 0) {
          $('.contact_no').removeClass('d-none');

          $.get("/patient/old_patient", function (data) {
            var contactNoSelect = $('#contact_no');
            contactNoSelect.empty(); // Clear existing options

            $.each(data, function (index, value) {
              contactNoSelect.append($('<option>', {
                value: value.id,
                text: value.contact
              }));
            });

            // Update the Selectpicker to reflect the changes
            contactNoSelect.selectpicker('refresh');
          });
        } else {
          $('.contact_no').addClass('d-none');
          $('#patient_form').trigger('reset');
          // Update the Selectpicker to reflect the changes
          
        }
      });
      $('select[name="contact_no"]').change(function(){
        var id = $(this).val();
        $.get("/patient/old_patient_details/"+id,
          function (data) {
            $('input[name="visit_date"]').val(data.visit_date);
            $('input[name="name"]').val(data.name);
            $('input[name="age"]').val(data.age);
            $('select[name="age_type"]').val(data.age_type).change();
            $('input[name="contact"]').val(data.contact);
            $('input[name="address"]').val(data.address);
            $('select[name="doctor_id"]').val(data.doctor_id).change();
            $('select[name="blood_group_id"]').val(data.blood_group_id).change();
            $('select[name="gender_id"]').val(data.gender_id).change();
            $('select[name="religion_id"]').val(data.religion_id).change();
          }
        );
      });

    </script>
@endpush

</x-admin>