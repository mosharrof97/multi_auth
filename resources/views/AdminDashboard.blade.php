<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
<h1>this is admin dashboard</h1>

<h1>Welcome {{ Auth::guard('admin')->user()->name }} </h1>
<h1>your email is - {{ Auth::guard('admin')->user()->email }} </h1>
    </body>
</html>
