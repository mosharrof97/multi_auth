<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
<h1>this is editor dashboard</h1>

<h1>Welcome {{ Auth::guard('editor')->user()->name }} </h1>
<h1>your email is - {{ Auth::guard('editor')->user()->email }} </h1>
    </body>
</html>
