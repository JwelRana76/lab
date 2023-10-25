<?php

namespace App\Http\Controllers;

use App\Models\BloodGroup;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Patient;
use App\Models\Religion;
use App\Service\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->baseService = new PatientService;
    }

    public function index()
    {
        $doctors = $this->baseService->index();
        $columns = Patient::$columns;
        if (request()->ajax()) {
            return $doctors;
        }
        return view('pages.patient.index', compact('columns'));
    }

    public function create()
    {
        $gender = Gender::all();
        $blood_group = BloodGroup::all();
        $religion = Religion::all();
        $doctors = Doctor::where('is_active', 1)->get();
        $type = [
            ['id' => 0, 'name' => 'Old'],
            ['id' => 1, 'name' => 'New'],
        ];
        return view('pages.patient.create', compact('gender', 'blood_group', 'religion', 'doctors', 'type'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'gender_id' => 'required',
            'religion_id' => 'required',
            'doctor_id' => 'required',
        ]);
        if ($request->type == 1) {
            $request->validate([
                'contact' => 'unique:patients',
            ]);
        }
        $data = $request->all();
        $message = $this->baseService->create($data);
        return redirect()->route('patient.index')->with($message);
    }
    public function edit($id)
    {
        $gender = Gender::all();
        $blood_group = BloodGroup::all();
        $religion = Religion::all();
        $doctors = Doctor::where('is_active', 1)->get();
        $type = [
            ['id' => 0, 'name' => 'Old'],
            ['id' => 1, 'name' => 'New'],
        ];
        $patient = Patient::findOrFail($id);
        return view('pages.patient.edit', compact('patient', 'doctors', 'gender', 'blood_group', 'religion', 'type'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'gender_id' => 'required',
            'religion_id' => 'required',
            'doctor_id' => 'required',
        ]);
        $data = $request->all();
        $message = $this->baseService->update($data, $id);
        return redirect()->route('patient.index')->with($message);
    }
    public function delete($id)
    {
        $this->baseService->delete($id);
        return redirect()->route('patient.index')->with('success', 'Doctor Deleted Successfully');
    }

    public function old_patient()
    {
        $data = Patient::select('id', 'contact')->where('type', 1)->get();
        return $data;
    }
    public function old_patient_details($id)
    {
        return Patient::findOrFail($id);
    }
    public function upload_document($id)
    {
        $patient = Patient::findOrFail($id);
        return view('pages.patient.document', compact('patient'));
    }
    public function upload_document_store(Request $request, $id)
    {
        $data = $request->document;
        $message = $this->baseService->upload_document($data, $id);
        return redirect()->route('patient.index')->with($message);
    }
}
