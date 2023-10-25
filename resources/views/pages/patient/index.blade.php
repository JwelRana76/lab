<x-admin title="Patient List">
    <x-page-header head="Patient List" />
    <a href="{{ route('patient.create') }}" class="btn btn-sm btn-primary my-2">
        <i class="fas fa-fw fa-plus"></i> Add Doctor
    </a>
    <x-data-table dataUrl="/patient" id="patients" :columns="$columns" />


</x-admin>