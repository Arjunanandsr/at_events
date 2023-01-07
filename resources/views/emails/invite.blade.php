
<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>    
    <div class="mail_text">
        <hr class="sep">
        <p>Hello,</p>
 
        <p>Invitation for the events.</p>
 
        <a href="{{ $MailData['url'] }}">Click here</a> to activate!

        <p>- From {{ config('app.name', 'Company') }}</p>
        <hr class="sep">
    </div>
    <strong>Thank you</strong>
</body>
</html>