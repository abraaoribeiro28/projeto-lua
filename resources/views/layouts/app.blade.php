<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <x-admin.includes.meta-tags />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <x-admin.includes.styles />
</head>
<body class="nk-body bg-lighter npc-default has-sidebar">
    <div class="nk-app-root">
        <div class="nk-main ">
            <x-admin.layout.sidebar />
            <div class="nk-wrap ">
                <x-admin.layout.header />
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
                <x-admin.layout.footer />
            </div>
        </div>
    </div>
    <x-admin.includes.scripts />
</body>
</html>
