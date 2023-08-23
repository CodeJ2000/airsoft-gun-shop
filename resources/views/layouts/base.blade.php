<!DOCTYPE html>
<html lang="en">
<head>
    <x-partials._head/>
    @stack('styles')
</head>
<body>
    <x-partials._nav/>
    {{ $slot }}
    <x-partials._footer/>
    @stack('scripts')
</body>
</html>