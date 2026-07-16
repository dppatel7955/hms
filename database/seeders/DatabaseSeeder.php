<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Room;
use App\Models\Admission;
use App\Models\Billing;
use App\Models\BillingItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admins
        $admin = User::create([
            'name' => 'Hospital Admin',
            'email' => 'admin@hms.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // 2. Create Departments
        $depts = [
            ['name' => 'Cardiology', 'code' => 'CARD', 'description' => 'Heart and vascular care'],
            ['name' => 'Pediatrics', 'code' => 'PED', 'description' => 'Children\'s healthcare'],
            ['name' => 'Neurology', 'code' => 'NEUR', 'description' => 'Brain and nervous system treatment'],
            ['name' => 'Orthopedics', 'code' => 'ORTH', 'description' => 'Bones and muscular skeletal treatments'],
            ['name' => 'General Medicine', 'code' => 'GEN', 'description' => 'Primary healthcare and general consultations'],
        ];

        $departmentModels = [];
        foreach ($depts as $dept) {
            $departmentModels[] = Department::create($dept);
        }

        // 3. Create Doctors & associated Users
        $doctorsData = [
            [
                'name' => 'Dr. Sarah Connor',
                'email' => 'sarah.connor@hms.com',
                'specialization' => 'Cardiologist',
                'license_number' => 'DOC10029',
                'biography' => 'Specializes in interventional cardiology and cardiovascular diseases with over 12 years of experience.',
                'consultation_fee' => 150.00,
                'dept_code' => 'CARD'
            ],
            [
                'name' => 'Dr. Gregory House',
                'email' => 'gregory.house@hms.com',
                'specialization' => 'Diagnostician & Neurologist',
                'license_number' => 'DOC99182',
                'biography' => 'Renowned diagnostic specialist with extreme expertise in infectious diseases and neurology.',
                'consultation_fee' => 250.00,
                'dept_code' => 'NEUR'
            ],
            [
                'name' => 'Dr. James Wilson',
                'email' => 'james.wilson@hms.com',
                'specialization' => 'General Physician',
                'license_number' => 'DOC88371',
                'biography' => 'Compassionate primary care specialist focusing on preventive medicine and chronic disease management.',
                'consultation_fee' => 80.00,
                'dept_code' => 'GEN'
            ],
            [
                'name' => 'Dr. Monica Geller',
                'email' => 'monica.geller@hms.com',
                'specialization' => 'Pediatrician',
                'license_number' => 'DOC77261',
                'biography' => 'Enthusiastic pediatrician dedicated to providing high-quality care to infants, children, and adolescents.',
                'consultation_fee' => 100.00,
                'dept_code' => 'PED'
            ],
            [
                'name' => 'Dr. John Dorian',
                'email' => 'john.dorian@hms.com',
                'specialization' => 'Orthopedic Surgeon',
                'license_number' => 'DOC55122',
                'biography' => 'Specialist in joint replacements, sports medicine, and reconstructive surgeries.',
                'consultation_fee' => 120.00,
                'dept_code' => 'ORTH'
            ],
        ];

        $doctorModels = [];
        foreach ($doctorsData as $doc) {
            $user = User::create([
                'name' => $doc['name'],
                'email' => $doc['email'],
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'status' => 'active',
            ]);

            $dept = collect($departmentModels)->firstWhere('code', $doc['dept_code']);

            $doctorModels[] = Doctor::create([
                'user_id' => $user->id,
                'department_id' => $dept->id,
                'specialization' => $doc['specialization'],
                'license_number' => $doc['license_number'],
                'biography' => $doc['biography'],
                'consultation_fee' => $doc['consultation_fee'],
            ]);
        }

        // 4. Create Nurses, Pharmacists, Receptionists
        $staffData = [
            ['name' => 'Nurse Joy', 'email' => 'joy@hms.com', 'role' => 'nurse'],
            ['name' => 'Nurse Abby', 'email' => 'abby@hms.com', 'role' => 'nurse'],
            ['name' => 'Pharmacist Tom', 'email' => 'tom@hms.com', 'role' => 'pharmacist'],
            ['name' => 'Receptionist Pam', 'email' => 'pam@hms.com', 'role' => 'receptionist'],
        ];

        foreach ($staffData as $staff) {
            User::create([
                'name' => $staff['name'],
                'email' => $staff['email'],
                'password' => Hash::make('password'),
                'role' => $staff['role'],
                'status' => 'active',
            ]);
        }

        // 5. Create Patients & associated Users
        $patientsData = [
            [
                'name' => 'Bruce Wayne',
                'email' => 'bruce@waynecorp.com',
                'date_of_birth' => '1985-02-19',
                'gender' => 'Male',
                'blood_group' => 'O+',
                'phone' => '+15550192',
                'address' => 'Wayne Manor, Gotham City',
                'emergency_contact_name' => 'Alfred Pennyworth',
                'emergency_contact_phone' => '+15550100',
                'medical_history' => 'Fractured ribs, multiple concussions, minor scars, insomnia.'
            ],
            [
                'name' => 'Clark Kent',
                'email' => 'clark@dailyplanet.com',
                'date_of_birth' => '1988-06-18',
                'gender' => 'Male',
                'blood_group' => 'AB+',
                'phone' => '+15550291',
                'address' => '344 Clinton St, Apt 3B, Metropolis',
                'emergency_contact_name' => 'Martha Kent',
                'emergency_contact_phone' => '+15550200',
                'medical_history' => 'Extremely healthy. Occasional exposure to radioactive green rocks causes severe weakness.'
            ],
            [
                'name' => 'Peter Parker',
                'email' => 'peter.parker@dailybugle.com',
                'date_of_birth' => '2001-08-10',
                'gender' => 'Male',
                'blood_group' => 'A-',
                'phone' => '+15550381',
                'address' => '20 Ingram St, Forest Hills, Queens, NY',
                'emergency_contact_name' => 'May Parker',
                'emergency_contact_phone' => '+15550300',
                'medical_history' => 'Bitten by genetically altered spider. High metabolic rate, rapid healing.'
            ],
            [
                'name' => 'Diana Prince',
                'email' => 'diana@themyscira.org',
                'date_of_birth' => '1970-11-20',
                'gender' => 'Female',
                'blood_group' => 'O-',
                'phone' => '+15550471',
                'address' => 'Gateway City Museum of Antiquities',
                'emergency_contact_name' => 'Steve Trevor',
                'emergency_contact_phone' => '+15550400',
                'medical_history' => 'Excellent health. High endurance.'
            ],
            [
                'name' => 'Tony Stark',
                'email' => 'tony@starkindustries.com',
                'date_of_birth' => '1970-05-29',
                'gender' => 'Male',
                'blood_group' => 'A+',
                'phone' => '+15550999',
                'address' => '10880 Malibu Point, CA',
                'emergency_contact_name' => 'Pepper Potts',
                'emergency_contact_phone' => '+15550900',
                'medical_history' => 'Surgical shrapnel removal from chest, arc reactor placement, heavy metal toxicity symptoms.'
            ]
        ];

        $patientModels = [];
        foreach ($patientsData as $pat) {
            $user = User::create([
                'name' => $pat['name'],
                'email' => $pat['email'],
                'password' => Hash::make('password'),
                'role' => 'patient',
                'status' => 'active',
            ]);

            $patientModels[] = Patient::create([
                'user_id' => $user->id,
                'date_of_birth' => $pat['date_of_birth'],
                'gender' => $pat['gender'],
                'blood_group' => $pat['blood_group'],
                'phone' => $pat['phone'],
                'address' => $pat['address'],
                'emergency_contact_name' => $pat['emergency_contact_name'],
                'emergency_contact_phone' => $pat['emergency_contact_phone'],
                'medical_history' => $pat['medical_history'],
            ]);
        }

        // 6. Create Rooms
        $roomsData = [
            ['room_number' => '101A', 'type' => 'general', 'status' => 'available', 'price_per_day' => 50.00],
            ['room_number' => '101B', 'type' => 'general', 'status' => 'available', 'price_per_day' => 50.00],
            ['room_number' => '201', 'type' => 'semi_private', 'status' => 'available', 'price_per_day' => 120.00],
            ['room_number' => '202', 'type' => 'semi_private', 'status' => 'available', 'price_per_day' => 120.00],
            ['room_number' => '301', 'type' => 'private', 'status' => 'occupied', 'price_per_day' => 250.00],
            ['room_number' => '302', 'type' => 'private', 'status' => 'available', 'price_per_day' => 250.00],
            ['room_number' => 'ICU-1', 'type' => 'icu', 'status' => 'occupied', 'price_per_day' => 500.00],
            ['room_number' => 'ICU-2', 'type' => 'icu', 'status' => 'maintenance', 'price_per_day' => 500.00],
        ];

        $roomModels = [];
        foreach ($roomsData as $r) {
            $roomModels[] = Room::create($r);
        }

        // 7. Create Appointments, Consultations, Prescriptions, Billings, & Admissions (Mock Flow)
        
        // 7.1 Appointment Flow for Bruce Wayne (Completed Appointment)
        $bruce = $patientModels[0];
        $house = $doctorModels[1]; // Dr. House

        $app1 = Appointment::create([
            'patient_id' => $bruce->id,
            'doctor_id' => $house->id,
            'appointment_date' => Carbon::yesterday()->setHour(10)->setMinute(0),
            'status' => 'completed',
            'reason' => 'Chronic insomnia and muscle soreness from night activities.',
            'notes' => 'Patient has extremely demanding physical routines.'
        ]);

        $cons1 = Consultation::create([
            'appointment_id' => $app1->id,
            'patient_id' => $bruce->id,
            'doctor_id' => $house->id,
            'symptoms' => 'Severe sleeplessness, physical fatigue, joint pain, chest bruising.',
            'diagnosis' => 'Physical trauma from high-impact activities combined with elevated adrenaline levels and severe stress-induced insomnia.',
            'treatment_plan' => 'Rest for 72 hours, thermal therapy for joints, and sleep regulation therapy.',
            'weight_kg' => 95.5,
            'blood_pressure' => '125/82',
            'temperature_c' => 36.8,
            'pulse_rate' => 64
        ]);

        $presc1 = Prescription::create([
            'consultation_id' => $cons1->id,
            'patient_id' => $bruce->id,
            'doctor_id' => $house->id,
            'notes' => 'Take medication strictly before sleeping. Avoid physical exertion.'
        ]);

        PrescriptionItem::create([
            'prescription_id' => $presc1->id,
            'medicine_name' => 'Melatonin 5mg',
            'dosage' => '1 tablet',
            'frequency' => 'Once daily (at bedtime)',
            'duration' => '10 days',
            'instructions' => 'Take 30 minutes before sleep.'
        ]);

        PrescriptionItem::create([
            'prescription_id' => $presc1->id,
            'medicine_name' => 'Ibuprofen 400mg',
            'dosage' => '1 tablet',
            'frequency' => 'Twice daily (after meals)',
            'duration' => '5 days',
            'instructions' => 'Only if joint pain persists.'
        ]);

        $bill1 = Billing::create([
            'patient_id' => $bruce->id,
            'appointment_id' => $app1->id,
            'invoice_number' => 'INV-2026-0001',
            'billing_date' => Carbon::yesterday()->toDateString(),
            'total_amount' => 260.00, // 250 fee + 10 pharmacy
            'discount' => 20.00,
            'tax' => 20.00,
            'grand_total' => 260.00,
            'status' => 'paid',
            'payment_method' => 'card'
        ]);

        BillingItem::create([
            'billing_id' => $bill1->id,
            'name' => 'Consultation Fee (Dr. Gregory House)',
            'amount' => 250.00,
            'quantity' => 1
        ]);

        BillingItem::create([
            'billing_id' => $bill1->id,
            'name' => 'Pharmacy - Melatonin & Ibuprofen',
            'amount' => 10.00,
            'quantity' => 1
        ]);


        // 7.2 Inpatient Flow for Tony Stark (Admitted)
        $tony = $patientModels[4];
        $sarah = $doctorModels[0]; // Dr. Connor (Cardiologist)
        
        $app2 = Appointment::create([
            'patient_id' => $tony->id,
            'doctor_id' => $sarah->id,
            'appointment_date' => Carbon::now()->subDays(3)->setHour(14)->setMinute(30),
            'status' => 'completed',
            'reason' => 'Arrhythmia symptoms and slight shortness of breath.',
            'notes' => 'Prior history of chest trauma.'
        ]);

        $cons2 = Consultation::create([
            'appointment_id' => $app2->id,
            'patient_id' => $tony->id,
            'doctor_id' => $sarah->id,
            'symptoms' => 'Irregular heartbeat, chest pressure, blood toxicity elevated.',
            'diagnosis' => 'Mild palladium poisoning triggering localized arrhythmia.',
            'treatment_plan' => 'Admit for observation, intravenous chelation therapy, continuous cardiac monitoring.',
            'weight_kg' => 82.0,
            'blood_pressure' => '138/90',
            'temperature_c' => 37.2,
            'pulse_rate' => 92
        ]);

        // Assign Room 301 (private)
        $room301 = collect($roomModels)->firstWhere('room_number', '301');
        $room301->update(['status' => 'occupied']);

        $admission1 = Admission::create([
            'patient_id' => $tony->id,
            'room_id' => $room301->id,
            'admission_date' => Carbon::now()->subDays(3)->setHour(16)->setMinute(0),
            'reason' => 'Continuous cardiac monitoring and intravenous chelation therapy.',
            'status' => 'admitted'
        ]);

        // Generate partial/unpaid invoice for Tony
        $bill2 = Billing::create([
            'patient_id' => $tony->id,
            'admission_id' => $admission1->id,
            'invoice_number' => 'INV-2026-0002',
            'billing_date' => Carbon::now()->toDateString(),
            'total_amount' => 900.00, // 150 consultation + 750 room (3 days x 250)
            'discount' => 0.00,
            'tax' => 72.00,
            'grand_total' => 972.00,
            'status' => 'unpaid'
        ]);

        BillingItem::create([
            'billing_id' => $bill2->id,
            'name' => 'Consultation Fee (Dr. Sarah Connor)',
            'amount' => 150.00,
            'quantity' => 1
        ]);

        BillingItem::create([
            'billing_id' => $bill2->id,
            'name' => 'Private Room 301 Charge (3 Days)',
            'amount' => 750.00,
            'quantity' => 3
        ]);


        // 7.3 General Appointments (Pending and Confirmed)
        // Clark Kent has a pending appointment
        Appointment::create([
            'patient_id' => $patientModels[1]->id, // Clark
            'doctor_id' => $doctorModels[2]->id, // Dr. Wilson
            'appointment_date' => Carbon::tomorrow()->setHour(11)->setMinute(0),
            'status' => 'confirmed',
            'reason' => 'Annual physical checkup for press accreditation.'
        ]);

        // Peter Parker has a pending appointment
        Appointment::create([
            'patient_id' => $patientModels[2]->id, // Peter
            'doctor_id' => $doctorModels[4]->id, // Dr. Dorian
            'appointment_date' => Carbon::now()->addDays(2)->setHour(15)->setMinute(0),
            'status' => 'pending',
            'reason' => 'Sprained wrist and lower back pain.'
        ]);
        
        // Diana Prince had a completed appointment today
        $app3 = Appointment::create([
            'patient_id' => $patientModels[3]->id, // Diana
            'doctor_id' => $doctorModels[2]->id, // Dr. Wilson
            'appointment_date' => Carbon::now()->setHour(8)->setMinute(30),
            'status' => 'completed',
            'reason' => 'Routine follow-up on vaccination status.'
        ]);

        $cons3 = Consultation::create([
            'appointment_id' => $app3->id,
            'patient_id' => $patientModels[3]->id,
            'doctor_id' => $doctorModels[2]->id,
            'symptoms' => 'None. Feels perfect.',
            'diagnosis' => 'Perfect physiological status.',
            'treatment_plan' => 'Maintain current diet and exercise.',
            'weight_kg' => 74.0,
            'blood_pressure' => '110/70',
            'temperature_c' => 36.6,
            'pulse_rate' => 58
        ]);
    }
}
