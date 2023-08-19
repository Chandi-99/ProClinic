<!DOCTYPE html>

<head>
    <title>Prescription</title>
    <style>
        body {
            background-image: src='{{ $image }}';
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Other CSS styles for your PDF content */
    </style>
</head>

<body>
    <div>
        <center>
            <h2>Doctor's Prescription</h2>
        </center>

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
        <p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Contact Number: </span>0{{$appointment->Visiting->Doctor->contact}}</p>

        <h3>Prescription:</h3>
        <p style="font-weight:bold;">Medication:</p>
        @if(isset($pres_medi))
        <table style="border:1px solid black;">

            <tr style="border:1px solid black;">
                <th style="border:1px solid black;">Medication Name</th>
                <th style="border:1px solid black;">Dosage</th>
                <th style="border:1px solid black;">Quantity</th>
                <th style="border:1px solid black;">More Details</th>
            </tr>
            @foreach($pres_medi as $pres_medi)

            <tr style="border:1px solid black;">
                <td style="border:1px solid black;">{{$pres_medi->MedicineName()}} ({{$pres_medi->MedicineMg()}}mg)</td>
                <td style="border:1px solid black;">{{$pres_medi->dose}}</td>
                <td style="border:1px solid black;text-align:center;">{{$pres_medi->quantity}}</td>
                <td style="border:1px solid black;text-align:center;"><a href="http://127.0.0.1:8000/viewmedicine/{{$pres_medi->medi_id}}">Click here</a></td>
            </tr>
            @endforeach
        </table>
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