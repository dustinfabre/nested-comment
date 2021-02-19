<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            html, body {
                font-family: "Helvetica Neue",Helvetica,"PingFang SC","Hiragino Sans GB","Microsoft YaHei",Arial,sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
        </style>

        <title>Nested Comment</title>
        <script src="{{ mix('js/app.js') }}" defer></script>

    </head>
    <body>
        <div id="app">
            <el-container>
                <el-main>
                    <nested-comment></nested-comment>
                </el-main>
            </el-container>
        </div>
    </body>
</html>
