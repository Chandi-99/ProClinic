<!DOCTYPE html>

<head>
    <title>Medical Certificate</title>
</head>

<body>
    <div>

        <p style="margin:0px; padding:1px;">Dr. {{$appointment->Visiting->Doctor->fname}} {{$appointment->Visiting->Doctor->lname}},</p>
        <p style="margin:0px; padding:1px;">ProClinic Medical Center,</p>
        <p style="margin:0px; padding:1px;">No 20, Galle Road, Colombo 06.</p>
        <p style="margin:0px; padding:1px;">{{$appointment->Visiting->Doctor->User->email}}</p>
        <p style="margin:0px; padding:1px;">0{{$appointment->Visiting->Doctor->contact}}</p>
        <p style="margin:0px; padding:1px;">{{$today}}</p>
        </br>
        <p>To Whom It May Concern,</p>
        <p><u>Medicla Certification of {{$patient->fname}} {{$patient->lname}}</u></p>

        <p style="margin:0px; padding:1px; text-align:justify;">&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;I am writing this medical certification on behalf of {{$patient->fname}} {{$patient->lname}}, who is under my care and has recently attended a medical appointment at ProClinic Medical Center, located at Galle Road, on {{$appointment->date}}.

            {{$patient->fname}} {{$patient->lname}} was seen by me due to {{$diagnosis->chief_complain}}. After a thorough evaluation, it was determined that {{$gender}} was indeed suffering from {{$diagnosis->identified_disease}}. Appropriate medical advice and treatment were provided to manage the condition.

            As a result of {{$patient->fname}} {{$patient->lname}}'s health condition, I advised {{$gendernew}} to take a period of rest and recovery to facilitate a swift return to optimal health. Therefore, {{$gender}} was excused from work/school for {{$diagnosis->rest_no_days}} days, inclusive.

            I kindly request that {{$patient->fname}} {{$patient->lname}}'s absence during this period be considered valid and excused. I trust that {{$gender}} will follow the prescribed treatment plan diligently and will be able to resume {{$gendernew}} regular activities shortly.

            Please feel free to contact me if you require any further information or clarification regarding {{$patient->fname}} {{$patient->lname}}'s medical condition and the necessity of the recommended rest period.

            Thank you for your understanding and cooperation.
        </p>
        <p>Sincerely,</p>
        <p style="margin:0px; padding:1px;">Dr. {{$appointment->Visiting->Doctor->fname}} {{$appointment->Visiting->Doctor->lname}},</p>
        <p style="margin:0px; padding:1px;">[Medical License: {{$appointment->Visiting->Doctor->regNum}}]</p>
        <p style="margin:0px; padding:1px;">ProClinic Medical Center,</p>
        <p style="margin:0px; padding:1px;">Contact: 0{{$appointment->Visiting->Doctor->contact}}</p>
        </br>
        </br>
        <p>Note: you can use this key <a href="http://127.0.0.1:8000/">{{$key}}</a> to check if this Medicla Certificae Valid or not. Visit our web site and insert this key to check this documrnt validity.
        <p>
    </div>
</body>

</html>