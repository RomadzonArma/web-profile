<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jawaban Pertanyaan Anda</title>
</head>
<body>
    <p>Halo {{ $user->name }},</p>
    <p>Anda menerima jawaban untuk pertanyaan Anda:</p>
    <p>{{ $faq->pertanyaan }}</p>
    <p>Berikut adalah jawaban:</p>
    <p>{{ $faq->jawaban }}</p>
    <p>Terima kasih.</p>
</body>
</html>
