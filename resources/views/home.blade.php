<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1 class="text-2xl font-bold text-center uppercase my-10">home</h1>

    <livewire:counter1 :count="0" label="counter-1" />
    <livewire:counter1 :count="2" label="counter-2" />
    <livewire:counter1 :count="5" label="counter-3" />

</body>
</html>
