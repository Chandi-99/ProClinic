<!DOCTYPE html>
<head>
<title>Prescription</title>
</head>
<body>
<div>
<center><h1>Doctor's Prescription</h1></center>

<p style="font-size:x-large;font-weight:bold;">Patient Information:</p>
<p style="margin:0px; padding:1px;"><span style="font-weight:bold; ">Name: </span>{{$patient->fname}} {{$patient->lname}}</p>
<p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Date of Birth: </span>{{$patient->dob}}</p>
<p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Gender: </span>{{$patient->gender}} </p>
<p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Address: </span>{{$patient->address}}</p>
<p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Contact Number: </span>0{{$patient->contact}}</p>
<p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Date: </span>{{$appointment->date}}</p>

<p style="font-size:x-large;font-weight:bold;">Doctor Information:</p>
<p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Name: </span>Dr. {{$appointment->Visiting->Doctor->fname}} {{$appointment->Visiting->Doctor->lname}}</p>
<p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Medical License: </span>{{$appointment->Visiting->Doctor->regNum}} </p>
<p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Specialty: </span>{{$appointment->Visiting->Doctor->specialization}}</p>
<p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Clinic/Hospital Name: </span>ProClinic Medical Center</p>
<p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Address: </span>No:20, Galle Road, Colombo 06.</p>
<p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Contact Number: </span>{{$appointment->Visiting->Doctor->contact}}</p>

<h3>Prescription:</h3>
<p style="font-weight:bold;">Medication:</p>
@if(isset($pres_medi))
@foreach($pres_medi as $pres_medi)
<table style="border:1px solid black;">
    <tr>
        <th>Medication Name</th>
        <th>Dosage</th>
        <th>Quantity</th>
    </tr>
    <tr>
        <td>{{$pres_medi->MedicineName()}} ({{$pres_medi->MedicineMg()}})</td>
        <td>{{$pres_medi->dose}}</td>
        <td>{{$pres_medi->quantity}}</td>
    </tr>
</table>
@endforeach
<p>Take medication as prescribed.</p>
@else
<p>No medicine Assigned!</p>
@endif


<p style="font-size:x-large;font-weight:bold;">Other Recommendations:</p>
<p>Please do not hesitate to contact us if you have any questions or concerns.</p>

<p>Signature: ____________________</p>
<p style="margin:0px; padding:1px;">Dr. {{$appointment->Visiting->Doctor->fname}} {{$appointment->Visiting->Doctor->lname}}</p>
<p style="margin:0px; padding:1px;">[Doctor's Medical License: {{$appointment->Visiting->Doctor->regNum}}]</p>
</div>
</body>
</html>


