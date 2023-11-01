<?php

namespace App\Providers;

use App\Models\Insurance;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ArraysProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $insurances = [
            'abo_ali_staff',
            'al_ahly_bank',
            'al_ahly_club',
            'axa_insurance',
            'commercial_cendicate',
            'engineering_cendicate',
            'medical_cenicate',
            'pharmacy_cendicate',
            'journalist_cendicate',
            'enaya_insurance',
            'egycare',
            'globe_med',
            'honor_card',
            'hyper_one',
            'mustakbal_watan_party',
            'nextcare',
            'smart',
            'ubf',
            'we',
            'zeied_sport_club',
        ];
        $insurances_ar = [
            'موظفين_أبو علي',
            'البنك_الأهلي',
            'النادي_الأهلي',
            'تأمين_أكسا',
            'محل_تجاري',
            'مركز_الهندسة',
            'مركز_طبي',
            'صيدلية_سينديكات',
            'الصحفي سينديكت',
            'تأمين عناية',
            'أيجي_كير',
            'جلوب_ميد',
            'بطاقة_الشرف',
            'هايبر_ون',
            'حزب مستقبل_وطن',
            'نكست_كير',
            'سمارت',
            'يو_بي_أف',
            'وي',
            'نادي_زايد_الرياضي',
        ];
        $specialties = [
            'family_medicine' => 'Family Medicine',
            'general_surgery' => 'General Surgery',
            'vascular_surgery' => 'Vascular Surgery',
            'pediatric_surgery' => 'Pediatric Surgery',
            'neuro_surgery' => 'Neurosurgery',
            'cardio-thoracic_surgery' => 'Cardiot-horacic Surgery',
            'orthopedic_surgery' => 'Orthopedic Surgery',
            'plastic_surgery' => 'Plastic Surgery',
            'maxill-fascial_surgery' => 'Maxill-ofacial Surgery',
            'onco-surgery' => 'Onco-surgery',
            'urology' => 'Urology',
            'nephrology' => 'Nephrology',
            'medicine' => 'Medicine',
            'gastroentrology' => 'Gastroenterology',
            'ent' => 'ENT',
            'opthalmology' => 'Ophthalmology',
            'ob_&_gy' => 'Obstetrics and Gynecology',
            'endocrinology' => 'Endocrinology',
            'neurology' => 'Neurology',
            'pediatrics' => 'Pediatrics',
            'psychiatry' => 'Psychiatry',
            'dermatology' => 'Dermatology',
            'physio-therapy' => 'Physiotherapy',
            'oncology' => 'Oncology',
            'immunology_&_rheummatology' => 'Immunology and Rheumatology',
            'cardiology' => 'Cardiology',
            'geriatrics' => 'Geriatrics',
            'hematology' => 'Hematology',
            'pain_management' => 'Pain Management',
            'pulonology' => 'Pulmonology',
        ];
        $specialties_ar = [
            'family_medicine' => "طب الأسرة",
            'general_surgery' => "الجراحة العامة",
            'vascular_surgery' => "جراحة الأوعية الدموية",
            'pediatric_surgery' => "جراحة الأطفال",
            'neuro_surgery' => "جراحة المخ والأعصاب",
            'cardio-thoracic_surgery' => "جراحة القلب والصدر",
            'orthopedic_surgery' => "جراحة العظام",
            'plastic_surgery' => "الجراحة التجميلية",
            'maxill-fascial_surgery' => "جراحة الفم والوجه والفكين",
            'onco-surgery' => "الجراحة الأورامية",
            'urology' => "جراحة المسالك البولية",
            'nephrology' => "أمراض الكلى",
            'medicine' => "الطب الباطني",
            'gastroenterology' => "أمراض الجهاز الهضمي",
            'ent' => "الأنف والأذن والحنجرة",
            'opthalmology' => "طب العيون",
            'ob_&_gy' => "التوليد وأمراض النساء",
            'endocrinology' => "الغدد الصماء",
            'neurology' => "الأعصاب",
            'pediatrics' => "طب الأطفال",
            'psychiatry' => "الطب النفسي",
            'dermatology' => "الأمراض الجلدية",
            'physio-therapy' => "العلاج الطبيعي",
            'oncology' => "الأورام",
            'immunology_&_rheummatology' => "المناعة والأمراض الروماتيزمية",
            'cardiology' => "أمراض القلب",
            'geriatrics' => "طب الشيخوخة",
            'hematology' => "أمراض الدم",
            'pain_management' => "علاج الألم",
            'pulonology' => "أمراض الرئة",
        ];
        $work_hours = [
            '8-9',
            '9-10',
            '10-11',
            '11-12',
            '12-13',
            '13-14',
            '14-15',
            '15-16',
            '16-17',
            '17-18',
            '18-19',
            '19-20',
            '20-21',
            '21-22',
            '22-23',
            '23-00',
        ];
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];
        $laboratory = [
            'lab',
            'lab2'
        ];
        $radiology = [
            'rad'
        ];
        $medicine = [
            'med'
        ];
        // Share the specialties array with all views
        View::share('specialties', $specialties);
        View::share('specialties_ar', $specialties_ar);
        View::share('insurances', $insurances);
        View::share('insurances_ar', $insurances_ar);
        View::share('work_hours', $work_hours);
        View::share('months', $months);
        View::share('laboratory', $laboratory);
        View::share('radiology', $radiology);
        View::share('medicine', $medicine);
    }

}
