<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <title><?=$title ?></title>
</head>

<body>
    <p>Dear <?=$firstname ?>,</p>
    <p>That time of the day has come again. Your colleagues wait for you to tell them what you are working on.</p>
    <p>You can reply to this mail, explaining 3 things: what you did yesterday, what will you be working on for today, and if there are any issues that block you, or if you need help from any of your colleagues.</p>
    <p>Please separate these 3 topics with the hash (#) symbol. Here is an example: <br/><br/>
        <span style="font-style: italic;">Yesterday I was working on implementing a new form for making payments</span><br/>#<br/>
        <span style="font-style: italic;">Today, I will complete the validations needed for the form</span><br/>#<br/>
        <span style="font-style: italic;">I am still waiting for some icons from the designer though. John, can we have a quick chat at 14.00?</span>
    </p>
    <p>Simple, isn't it?</p>
    <p>Oh, and don't forget... The project you are writing the report for is: <b><?=$projectName?></b></p>
</body>
</html>