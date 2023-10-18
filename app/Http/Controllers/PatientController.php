<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Patient;
use Gufy\PdfToHtml\Pdf;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use Mpdf\Output\Destination;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Font;
use Illuminate\Support\Facades\File;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\TemplateProcessor;

class PatientController extends Controller
{
    public function adminUpdate(Request $req) {
        Patient::find($req->id)->update($req->validate(
            [
                'name' => 'required',
                'phone' => 'required',
                'phone' => 'required',
            ]
            ));
        Toast::title('Patient Updated Successfuly!')
        ->autoDismiss(5);
        return redirect()->route('admin.manage.admins.index');
    }
    public function createIn(Request $req) {
        $req->validate(
            [
                'name' => 'required',
                'phone' => 'required|numeric',
                'gender' => 'required',
                'age' => 'required|numeric',
                'national_id' => 'required|numeric',
                'address' => 'required',
                'admission_time' => 'required',
                'admission_date' => 'required',
                'diagnosis' => 'required',
                'surgical_procedure' => 'required',
                'room_number' => 'required|numeric',
                'physician' => 'required',
                'physician_code' => 'required|numeric',
                'insurance' => 'required',
                'relative_name' => 'required',
                'degree' => 'required',
                'relative_national_id' => 'required|numeric',
                'relative_phone' => 'required|numeric',
                'relative_another_phone' => 'required|numeric',
            ]
        );
        $patient = new Patient();
        $patient->name = $req->name;
        $patient->phone = $req->phone;
        $patient->age = $req->age;
        $patient->gender = $req->gender;
        $patient->address = $req->address;
        $patient->national_id = $req->national_id;
        $patient->admission_time = $req->admission_time;
        $patient->admission_date = $req->admission_date;
        $patient->diagnosis = $req->diagnosis;
        $patient->national_id = $req->national_id;
        $patient->surgical_procedure = $req->surgical_procedure;
        $patient->room_number = $req->room_number;
        $patient->physician = $req->physician;
        $patient->physician_code = $req->physician_code;
        $patient->insurance = $req->insurance;
        $patient->relative_name = $req->relative_name;
        $patient->degree = $req->degree;
        $patient->relative_national_id = $req->relative_national_id;
        $patient->relative_phone = $req->relative_phone;
        $patient->relative_another_phone = $req->relative_another_phone;
        $patient->type = 'in_patient';
        $templatePath = public_path('word/patient_form.docx');
        $templateProcessor = new TemplateProcessor($templatePath);
        $font = new Font();
        $font->setName('DejaVu Sans');
        // values
        $templateProcessor->setValue('name', $patient->name);
        $templateProcessor->setValue('phone', $patient->phone);
        $templateProcessor->setValue('age', $patient->age);
        $templateProcessor->setValue('gender', $patient->gender);
        $templateProcessor->setValue('address', $patient->address);
        $templateProcessor->setValue('national_id', $patient->national_id);
        $templateProcessor->setValue('admission_time', $patient->admission_time);
        $templateProcessor->setValue('admission_date', $patient->admission_date);
        $templateProcessor->setValue('diagnosis', $patient->diagnosis);
        $templateProcessor->setValue('national_id', $patient->national_id);
        $templateProcessor->setValue('surgical_procedure', $patient->surgical_procedure);
        $templateProcessor->setValue('room_number', $patient->room_number);
        $templateProcessor->setValue('physician', $patient->physician);
        $templateProcessor->setValue('physician_code', $patient->physician_code);
        $templateProcessor->setValue('insurance', $patient->insurance);
        $templateProcessor->setValue('relative_name', $patient->relative_name);
        $templateProcessor->setValue('degree', $patient->degree);
        $templateProcessor->setValue('relative_national_id', $patient->relative_national_id);
        $templateProcessor->setValue('relative_phone', $patient->relative_phone);
        $templateProcessor->setValue('relative_another_phone', $patient->relative_another_phone);
        $templateProcessor->setValue('lol', $patient->empty);
        $templateProcessor->setValue('empty', $patient->empty);
        $docName = $patient->name.'-'.date('Y-m-d-H-i-s');
        $newDocumentPath = 'word/patient_forms/'. $docName.'.docx';
        $templateProcessor->saveAs($newDocumentPath);
        $relative_path = 'word/patient_forms/'.$docName.'.docx';
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "5000000");
        $phpWord = IOFactory::load(public_path('word/patient_forms/'.$docName.'.docx'));
        $objWriter = IOFactory::createWriter($phpWord, 'HTML');
        $objWriter->save('temp/temp.html');
        $htmlContent = file_get_contents('temp/temp.html');
        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->WriteHTML($htmlContent);
        $mpdf->Output(public_path('pdf/patient_forms/'.$docName.'.pdf'), Destination::FILE);
        $patient->patient_form = 'pdf/patient_forms/'.$docName.'.pdf';
        $save = $patient->save();
        if($save) {
            Toast::title('Patient Registered Successfuly!')
            ->autoDismiss(5);
            Session::put('patient', $patient);
            Session::put('word','word/patient_forms/'.$docName.'.docx');
            return redirect()->back();
        }else {
            Toast::danger('Patient Registered Failed!')
            ->autoDismiss(5);
            return redirect()->back();
        }
    }
    public function createOut(Request $req) {
        $req->validate(
            [
                'name' => 'required',
                'phone' => 'required|numeric',
                'gender' => 'required',
                'age' => 'required|numeric',
                'address' => 'required',
                'national_id' => 'required|numeric',
            ]
        );
        $patient = new Patient();
        $patient->name = $req->name;
        $patient->phone = $req->phone;
        $patient->age = $req->age;
        $patient->gender = $req->gender;
        $patient->address = $req->address;
        $patient->national_id = $req->national_id;
        $patient->type = 'out_patient';
        $save = $patient->save();

        if($save) {
            Toast::title('Patient Registered Successfuly!')
            ->autoDismiss(5);
            return redirect()->back();;
        }else {
            Toast::danger('Patient Registered Failed!')
            ->autoDismiss(5);
            return redirect()->back();
        }
    }
    public function adminDelete(Request $req) {
        Patient::find($req->id)->delete();
        Toast::success('Patient Removed Successfuly!');
        return redirect()->back();
    }
}

