<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @page { margin: 24px; }
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 12px; color: #111827; }
        h1, h2, h3, h4, h5, h6 { color: #111827; margin: 0.5rem 0; }
        p { line-height: 1.4; margin: 0.35rem 0; }
        img { max-width: 100%; height: auto; }
        .page-break { page-break-after: always; }
    </style>
    {{-- Dompdf supports limited CSS; keep styles simple. --}}
</head>
<body>
{!! $html !!}
</body>
<!-- Intentionally minimal wrapper: we pass precomposed HTML including header/body. -->
</html>


