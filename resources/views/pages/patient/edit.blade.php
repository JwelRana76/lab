<x-admin title="Update Patient">
    {{-- <x-page-header head="Create Patient" /> --}}
    <x-card header="Update Patient" link="{{ route('patient.index') }}" title="Patient List">
      <x-form action="{{ route('patient.update',$patient->id) }}" method="post" id="patient_form">
        <div class="row">
          <x-select id="type" label="Patient Type" selectedId="{{ $patient->type }}" :options="$type" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-select id="contact_no" label="Select Contact Number" :options="[]" class="col-md-6 col-xl-4 col-sm-12 d-none contact_no" />
        </div>
        <hr>
        <div class="row">
          <div class="col-12">
            <h5>Patient Details</h5>
            <hr>
          </div>
          <x-input id="visit_date" type="date" value="{{ $patient->visit_date }}" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-input id="name" required value="{{ $patient->name }}" class="col-md-6 col-xl-4 col-sm-12" />
          <div class=" col-md-6 col-xl-4 col-sm-12">
            <label for="age">Age</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <input type="text" name="age" value="{{ $patient->age }}" class="form-control" >
              </div>
              <select class="custom-select" name="age_type" id="inputGroupSelect01">
                <option value="1" {{ $patient->age_type == 1?'selected':'' }}>Days</option>
                <option value="2" {{ $patient->age_type == 2?'selected':'' }}>Months</option>
                <option value="3" {{ $patient->age_type == 3?'selected':'' }}>Years</option>
              </select>
            </div>
          </div>
          <x-input id="contact" value="{{ $patient->contact }}" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-input id="address" value="{{ $patient->address }}" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-select id="doctor_id" selectedId="{{ $patient->doctor_id }}" label="Doctor" :options="$doctors" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-select id="gender_id" selectedId="{{ $patient->gender_id }}" label="Gender" :options="$gender" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-select id="religion_id" selectedId="{{ $patient->religion_id }}" label="Religion" :options="$religion" required class="col-md-6 col-xl-4 col-sm-12" />
          <x-select id="blood_group_id" selectedId="{{ $patient->blood_group_id }}" label="Blood Group" :options="$blood_group" required class="col-md-6 col-xl-4 col-sm-12" />
        </div>
        <x-button type="submit" />
      </x-form>
    </x-card> 
    
@push('js')
    <script>

    </script>
@endpush

</x-admin>