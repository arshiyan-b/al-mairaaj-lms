<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/React-student/app.jsx'])
</head>
    <body>
        <div id="app" data-user="{{ json_encode($user) }}"></div>
    </body>
</html>
