@component('mail::message')
# Appointment Created Successfully!

Dear {{$email}},

Your appointment has been created successfully.

<strong>Appointment Id: </strong>{{$id}}

<strong>Patient Name: </strong>{{$patientName}}

<strong>Doctor Name: </strong>{{$doctorName}}

<strong>Date: </strong>{{$date}}

<strong>Appointment Type: </strong>{{$type}}

<strong>Session: </strong>{{$session}}

<strong>Start Time: </strong>{{$startTime}}

<strong>Appointment Number: </strong>{{$AppointmentNumber}}

<strong>Amount Paid: </strong>{{$doctorFees}}

<strong>Bill Id: </strong>{{$billid}}

<strong>Prescription Id: </strong>{{$prescriptionid}}


<strong>Note:</strong>Please check your mobile to keep updated.


<strong>Instruction to Follow:</strong>
Before your doctor appointment, it's important to take a few steps to ensure a smooth and productive visit. Here are some instructions to follow:

Confirm the Appointment: Double-check the date, time, and location of your appointment. Make sure you have the correct details to avoid any confusion.

Review Medical History: Take some time to review your medical history, including any previous diagnoses, medications, allergies, or surgeries. This will help you provide accurate information to your doctor and ensure they have a comprehensive understanding of your health.

Prepare a List of Questions and Concerns: Jot down any questions or concerns you have regarding your health. This will help you address all your queries during the appointment and make the most of your time with the doctor. Prioritize your questions based on their importance.

Gather Relevant Documents: If you have any recent medical reports, test results, or imaging scans related to your condition, gather them and bring them with you. These documents can provide valuable insights to the doctor and assist in making an accurate diagnosis.

Make a List of Medications: Create a list of all the medications, supplements, or herbal remedies you are currently taking, along with their dosages. Include over-the-counter medications as well. This information will help the doctor understand your medication regimen and any potential interactions.

Follow Pre-Appointment Instructions: If your doctor has provided any specific instructions before the appointment, such as fasting for certain tests or discontinuing certain medications, make sure to follow them diligently. Adhering to these instructions will ensure accurate test results and proper evaluation by the doctor.

Arrive Early: Plan to arrive at the doctor's office a few minutes before the scheduled appointment time. This will give you ample time to complete any necessary paperwork and ensure a stress-free start to your visit.

By following these instructions, you can optimize your doctor appointment experience, ensure effective communication with your healthcare provider, and receive the best possible care for your health concerns.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
ProClinic Website
@endcomponent

Thanks,<br>
{{ _('ProClinic Medical Center') }}
@endcomponent