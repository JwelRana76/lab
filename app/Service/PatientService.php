<?php

namespace App\Service;

use App\Models\Patient;
use App\Models\PatientDocument;
use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PatientService {
  protected $model = Patient::class;

  public function index()
  {
    $patients = $this->model::active();
    return DataTables::of($patients)
      ->addColumn('type', function ($item) {
        return $item->type == 1 ? 'New' : 'Old';
      })
      ->addColumn('visit_date', function ($item) {
        $date = strtotime($item->visit_date);
        return date('d-M-Y', $date);
      })
      ->addColumn('gender', function ($item) {
        return $item->gender->name ?? 'N/A';
      })
      ->addColumn('age', function ($item) {
        return $item->ages;
      })
      ->addColumn('action', function ($item) {
        return view('pages.patient.action', compact('item'))->render();
      })
      ->make(true);
  }
  public function create($data)
  {
    DB::beginTransaction();
    try {
      if ($data['type'] == 0) {
        $patient = $this->model::findOrFail($data['contact_no']);
        if ($data['visit_date'] == $patient->visit_date) {
          $message = ["warning" => "This patient Already Inputed today"];
          return $message;
        }
      }
      $this->model::create($data);
      DB::commit();
      $message = ["success" => "This patient Inputed Successfully"];
      return $message;
    } catch (Exception $e) {
      DB::rollBack();
      dd($e->getMessage());
    }
  }
  public function update($data, $id)
  {
    $patient = $this->model::findOrFail($id);
    DB::beginTransaction();
    try {
      if ($data['type'] == 0) {
        $count = $this->model::where('contact', $data['contact'])->count();
        if ($count < 2) {
          $message = ["warning" => "This patient can't select as a old patinet"];
          return $message;
        }
      }
      if ($data['type'] == 1) {
        $patient = $this->model::where('contact', $data['contact'])->get();
        if (count($patient) > 1) {
          $message = ["warning" => "This Contact Number is Already provided as new patient"];
          return $message;
        }
      }
      $patient->update($data);

      DB::commit();
    } catch (Exception $e) {
      DB::rollBack();
      dd($e->getMessage());
    }
  }
  public function delete($id)
  {
    $this->model::findOrFail($id)->update([
      'is_active' => false,
    ]);
  }
  public function upload_document($datas, $id)
  {
    dd($datas);
    foreach ($datas as $key => $item) {
      $data['patient_id'] = $id;
      $data['document'] = time() . '_' . $key . '.' . $item->getClientOriginalExtension();
      $item->move('upload/document/', $data['document']);
      PatientDocument::create($data);
    }
    return $message = ['success' => 'Document Uploaded Successfully'];
  }
}