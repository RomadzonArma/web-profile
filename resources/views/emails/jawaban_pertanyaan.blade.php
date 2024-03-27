{{--  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jawaban Pertanyaan Laman KSPS TENDIK KEMENDIKBUDRISTEK</title>
</head>
<body>
    <p>Halo {{ $faq->nama ?? '' }},</p>
    <p>Anda menerima jawaban untuk pertanyaan Anda:</p>
    <p>{{ $faq->pertanyaan ?? '' }}</p>
    <p>Berikut adalah jawaban:</p>
    <p>{{ $faq->jawaban ?? '' }}</p>
    <p>Terima kasih.</p>
</body>
</html>  --}}




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JAWABAN FAQ LAMAN KSPS KEMENDIKBUDRISTEK</title>
    <style>
        /* Styles for better email appearance */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1, p {
            margin-bottom: 15px;
        }
        p {
            font-size: 16px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #666666;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('assets-front/img/logo-P3GTK.png')}}" alt="Logo Perusahaan Anda">
        </div>
        <h1 style="text-align: center; color: #333333;">FAQ LAMAN KSPS KEMENDIKBUDRISTEK</h1>
        <p>Kepada {{ $faq->nama ?? '' }},</p>
        <p>Kami mengucapkan terima kasih atas kesempatan untuk memberikan jawaban atas pertanyaan yang Anda sampaikan kepada kami. Kami telah memperoleh pertanyaan Anda yang diajukan pada tanggal {{ date('d F Y \p\u\k\u\l H:i', strtotime($faq->tgl_pertanyaan ?? '')) }}, dan dengan senang hati kami sampaikan jawaban berikut ini:</p>
        <p><strong>Pertanyaan Anda:</strong><br>
            {{ $faq->pertanyaan ?? '' }}</p>
        <p><strong>Jawaban Kami:</strong><br>
            {{ $faq->jawaban ?? '' }}</p>
       
        <p>Jika ada pertanyaan lebih lanjut atau Anda memerlukan klarifikasi lebih lanjut, jangan ragu untuk menghubungi kami kembali. Tim kami selalu siap membantu Anda dengan setiap pertanyaan atau kebutuhan yang Anda miliki.</p>
        <p>Kami sangat menghargai waktu dan minat Anda dalam menggunakan layanan kami. Semoga jawaban kami memenuhi harapan Anda.</p>
        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda kepada kami.</p>
            <p>Hormat kami,</p>
            <p>Tim Dukungan Laman KSPS TENDIK KEMENDIKBUDRISTEK</p>
        </div>
    </div>
</body>
</html>
