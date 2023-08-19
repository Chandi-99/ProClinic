<!DOCTYPE html>

<head>
    <title>Bill</title>
</head>

<body>
    <div>
        <p>---------------------------------------------------------------------------------------------------------------------------</p>
        <h3 style="text-align: center;"> DOCTOR APPOINTMENT BILL</h3>
        <p>---------------------------------------------------------------------------------------------------------------------------</p>
</br>
        <table>
            <thead>
                <tr>
                    <th style="padding-bottom: 10px;font-size:larger;font-weight:bold;">Patient Information</th>
                    <th style="padding-bottom: 10px;font-size:larger;font-weight:bold;">Doctor Information:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span style="font-weight:bold; ">Name: </span>{{$patient->fname}} {{$patient->lname}}</p>
                    </td>
                    <td><span style="font-weight:bold;margin-left:50px;">Name: </span>Dr. {{$appointment->Visiting->Doctor->fname}} {{$appointment->Visiting->Doctor->lname}}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Date of Birth: </span>{{$patient->dob}}</p>
                    </td>
                    <td>
                        <p style="margin:0px; padding:1px; margin-left:50px;"><span style="font-weight:bold;">Medical License: </span>{{$appointment->Visiting->Doctor->regNum}} </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Gender: </span>{{$patient->gender}} </p>
                    </td>
                    <td>
                        <p style="margin:0px; padding:1px; margin-left:50px;"><span style="font-weight:bold;">Specialty: </span>{{$appointment->Visiting->Doctor->specialization}}</p>
                    </td>

                </tr>
                <tr>
                    <td>
                        <p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Address: </span>{{$patient->address}}</p>
                    </td>
                    <td>
                        <p style="margin:0px; padding:1px; margin-left:50px;"><span style="font-weight:bold;">Clinic/Hospital Name: </span>ProClinic Medical Center</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Contact Number: </span>0{{$patient->contact}}</p>
                    </td>
                    <td>
                        <p style="margin:0px; padding:1px; margin-left:50px;"><span style="font-weight:bold;">Address: </span>No:20, Galle Road, Colombo 06.</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin:0px; padding:1px;"><span style="font-weight:bold;"></p>
                    </td>
                    <td>
                        <p style="margin:0px; padding:1px; margin-left:50px;"><span style="font-weight:bold;">Contact Number: </span>0{{$appointment->Visiting->Doctor->contact}}</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <p style="font-size:larger;font-weight:bold;margin-left:200px;">Appointment Details:</p>
        <p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Date: </span>{{$appointment->date}}</p>
        <p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Time: </span>{{$appointment->start_time}}</p>
        <p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Duration: </span>15 mins</p>

        <p><span style="font-size:larger;font-weight:bold;">Reason for Visit: </span>{{$diagnosis->chief_complain}}</p>

        <p style="font-size:larger;font-weight:bold;margin-left:200px;">Services Provided:</p>
        <ol>
            <li>Doctor Charges: {{$bill->doctor_charges}}</li>
            <li>Medicine Charges: {{$bill->medicine_charges}}</li>
            <li>Other Charges (tax, service charge, etc): {{$bill->other_charges}}</li>
        </ol>

        <ul>
            <li>Subtotal: {{$subtotal}}</li>
            <li>Discount: {{$bill->discount}}</li>
            <li>Total: {{$bill->total}}</li>
        </ul>
        <p style="font-size:larger;font-weight:bold;margin-left:200px;">Payment Information:</p>
        <p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Payment Method:</span>Cash </p>
        <p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Transaction ID: </span>Bill_{{$bill->id}} </p>
        <p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Date of Payment: </span> {{$appointment->date}} </p>
        <p style="margin:0px; padding:1px;"><span style="font-weight:bold;">Amount Paid: </span> {{$bill->total}} </p>

</br>
</br>
</br>
        <p>---------------------------------------------------------------------------------------------------------------------------</p>
        <h3 style="text-align: center;">THANK YOU FOR CHOOSING OUR MEDICAL SERVICES!</h3>
        <p>---------------------------------------------------------------------------------------------------------------------------</p>
    </div>

</body>

</html>