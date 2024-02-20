<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
<h1>this is student dashboard</h1>

<h1>Welcome {{ Auth::guard('student')->user()->name }} </h1>
<h1>your email is - {{ Auth::guard('student')->user()->email }} </h1>
    </body>
</html>
