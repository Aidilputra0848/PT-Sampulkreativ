<?php
// Konfigurasi email
$to_email = "king.ataama@gmail.com";
$from_email = "king.ataama@gmail.com"; // Ganti dengan domain Anda
$from_name = "Partnership Form";

$success_message = "";
$error_message = "";

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $nama_perusahaan = htmlspecialchars($_POST['nama_perusahaan']);
    $nama_kontak = htmlspecialchars($_POST['nama_kontak']);
    $email = htmlspecialchars($_POST['email']);
    $telepon = htmlspecialchars($_POST['telepon']);
    $jenis = htmlspecialchars($_POST['jenis']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    
    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Format email tidak valid!";
    } else {
        // Handle file upload
        $attachment = null;
        $attachment_name = "";
        
        if (isset($_FILES['proposal']) && $_FILES['proposal']['error'] == 0) {
            $allowed_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            $max_size = 10 * 1024 * 1024; // 10MB
            
            if (in_array($_FILES['proposal']['type'], $allowed_types) && $_FILES['proposal']['size'] <= $max_size) {
                $attachment = $_FILES['proposal']['tmp_name'];
                $attachment_name = $_FILES['proposal']['name'];
            } else {
                $error_message = "File harus berformat PDF/DOC/DOCX dan maksimal 10MB!";
            }
        }
        
        if (empty($error_message)) {
            // Kirim email
            if (sendPartnershipEmail($to_email, $from_email, $from_name, $nama_perusahaan, $nama_kontak, $email, $telepon, $jenis, $deskripsi, $attachment, $attachment_name)) {
                $success_message = "Pengajuan kerja sama berhasil dikirim! Tim kami akan menghubungi Anda segera.";
            } else {
                $error_message = "Terjadi kesalahan saat mengirim email. Silakan coba lagi.";
            }
        }
    }
}

function sendPartnershipEmail($to, $from_email, $from_name, $perusahaan, $kontak, $email, $telepon, $jenis, $deskripsi, $attachment, $attachment_name) {
    $subject = "Pengajuan Kerja Sama - " . $perusahaan;
    
    // Boundary untuk multipart email
    $boundary = md5(time());
    
    // Headers
    $headers = "From: " . $from_name . " <" . $from_email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";
    
    // Email body
    $message = "--" . $boundary . "\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    
    $message .= "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background: linear-gradient(135deg, #19af91, #16a085); color: white; padding: 20px; border-radius: 8px 8px 0 0; }
            .content { background: #f9f9f9; padding: 20px; }
            .footer { background: #2c3e50; color: white; padding: 15px; text-align: center; border-radius: 0 0 8px 8px; }
            .info-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
            .info-table th, .info-table td { padding: 12px; border: 1px solid #ddd; text-align: left; }
            .info-table th { background: #19af91; color: white; }
            .highlight { background: #e8f5e8; padding: 15px; border-left: 4px solid #19af91; margin: 15px 0; }
        </style>
    </head>
    <body>
        <div style='max-width: 600px; margin: 0 auto; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>
            <div class='header'>
                <h2 style='margin: 0; text-align: center;'>🤝 Pengajuan Kerja Sama Baru</h2>
                <p style='margin: 5px 0 0 0; text-align: center; font-size: 14px;'>Partnership Request</p>
            </div>
            
            <div class='content'>
                <p>Anda telah menerima pengajuan kerja sama baru dengan detail sebagai berikut:</p>
                
                <table class='info-table'>
                    <tr><th>Nama Perusahaan</th><td><strong>" . $perusahaan . "</strong></td></tr>
                    <tr><th>Nama Kontak</th><td>" . $kontak . "</td></tr>
                    <tr><th>Email</th><td><a href='mailto:" . $email . "'>" . $email . "</a></td></tr>
                    <tr><th>Telepon</th><td><a href='tel:" . $telepon . "'>" . $telepon . "</a></td></tr>
                    <tr><th>Jenis Kerja Sama</th><td><span style='background: #19af91; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;'>" . $jenis . "</span></td></tr>
                </table>
                
                <div class='highlight'>
                    <h4 style='margin: 0 0 10px 0; color: #19af91;'>📝 Deskripsi Project:</h4>
                    <p style='margin: 0; white-space: pre-line;'>" . nl2br($deskripsi) . "</p>
                </div>
                
                " . ($attachment_name ? "<p><strong>📎 Dokumen terlampir:</strong> " . $attachment_name . "</p>" : "<p><em>Tidak ada dokumen terlampir</em></p>") . "
                
                <div style='margin: 20px 0; padding: 15px; background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 4px;'>
                    <strong>⏰ Waktu Pengajuan:</strong> " . date('d F Y, H:i:s') . " WIB
                </div>
            </div>
            
            <div class='footer'>
                <p style='margin: 0; font-size: 12px;'>Email ini dikirim otomatis dari sistem Partnership Form</p>
                <p style='margin: 5px 0 0 0; font-size: 12px;'>Silakan balas email ini untuk merespons pengajuan</p>
            </div>
        </div>
    </body>
    </html>\r\n\r\n";
    
    // Attachment
    if ($attachment && file_exists($attachment)) {
        $file_content = chunk_split(base64_encode(file_get_contents($attachment)));
        $message .= "--" . $boundary . "\r\n";
        $message .= "Content-Type: application/octet-stream; name=\"" . $attachment_name . "\"\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n";
        $message .= "Content-Disposition: attachment; filename=\"" . $attachment_name . "\"\r\n\r\n";
        $message .= $file_content . "\r\n";
    }
    
    $message .= "--" . $boundary . "--\r\n";
    
    return mail($to, $subject, $message, $headers);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Kerja Sama</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            margin: 0;
            background: linear-gradient(135deg, #19af91, #16a085, #1abc9c);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
        }

        /* Animated Gradient Background */
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Enhanced Bubble Animation */
        .bubbles {
            position: fixed;
            top: 0; 
            left: 0;
            width: 100%; 
            height: 100%;
            overflow: hidden;
            z-index: -1;
            pointer-events: none;
        }
        
        .bubble {
            position: absolute;
            border-radius: 50%;
            opacity: 0;
            animation: bubbleRise linear infinite;
        }
        
        .bubble:nth-child(odd) {
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.3));
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .bubble:nth-child(even) {
            background: linear-gradient(45deg, rgba(26,188,156,0.3), rgba(25,175,145,0.1));
            border: 1px solid rgba(255,255,255,0.1);
        }
        
        @keyframes bubbleRise {
            0% {
                bottom: -100px;
                opacity: 0;
                transform: translateX(0) rotate(0deg) scale(0.5);
            }
            10% {
                opacity: 0.6;
            }
            50% {
                opacity: 0.8;
                transform: translateX(50px) rotate(180deg) scale(1);
            }
            100% {
                bottom: 100vh;
                opacity: 0;
                transform: translateX(-50px) rotate(360deg) scale(0.3);
            }
        }

        /* Floating particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }
        
        .particle {
            position: absolute;
            background: rgba(255,255,255,0.4);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }
        
        @keyframes float {
            0% {
                transform: translateY(100vh) translateX(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) translateX(200px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Back Button */
        .back-btn {
            position: fixed;
            top: 25px;
            left: 25px;
            background: rgba(255,255,255,0.95);
            color: #19af91;
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        .back-btn:hover {
            background: white;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 35px rgba(0,0,0,0.2);
        }

        /* Container */
        .container {
            max-width: 650px;
            margin: 80px auto 40px;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.3);
            animation: containerFadeIn 1s ease-out;
        }
        
        @keyframes containerFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Logo */
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 200px;
            height: auto;
            max-width: 100%;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        /* Custom Logo Design */
        .custom-logo {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .logo-icon {
            position: relative;
            width: 50px;
            height: 40px;
        }

        .logo-shape-1 {
            position: absolute;
            width: 30px;
            height: 20px;
            background: #19af91;
            border-radius: 4px;
            top: 0;
            left: 0;
            transform: skew(-15deg);
        }

        .logo-shape-2 {
            position: absolute;
            width: 30px;
            height: 20px;
            background: #f39c12;
            border-radius: 4px;
            bottom: 0;
            left: 10px;
            transform: skew(-15deg);
        }

        .logo-text {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .logo-title {
            font-size: 20px;
            font-weight: 800;
            color: #2c3e50;
            letter-spacing: -0.5px;
            margin: 0;
        }

        .logo-subtitle {
            font-size: 11px;
            font-weight: 500;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: -2px 0 0 0;
        }

        /* Header */
        h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .subtitle {
            text-align: center;
            color: #7f8c8d;
            font-size: 16px;
            margin-bottom: 30px;
            font-weight: 400;
        }

        /* Message Styling */
        .msg {
            text-align: center;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-weight: 500;
            animation: msgSlideIn 0.5s ease-out;
        }
        
        @keyframes msgSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .success {
            background: linear-gradient(135deg, rgba(39,174,96,0.1), rgba(46,204,113,0.1));
            color: #27ae60;
            border: 1px solid rgba(39,174,96,0.3);
            backdrop-filter: blur(10px);
        }
        
        .error {
            background: linear-gradient(135deg, rgba(231,76,60,0.1), rgba(192,57,43,0.1));
            color: #e74c3c;
            border: 1px solid rgba(231,76,60,0.3);
            backdrop-filter: blur(10px);
        }

        /* Form Styling */
        form {
            background: rgba(255,255,255,0.6);
            padding: 30px;
            border-radius: 20px;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* Label Styling */
        label {
            font-weight: 600;
            color: #2c3e50;
            margin-top: 20px;
            margin-bottom: 8px;
            display: block;
            font-size: 15px;
            position: relative;
        }

        label:first-child {
            margin-top: 0;
        }

        label::before {
            content: '';
            position: absolute;
            left: -15px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 20px;
            background: linear-gradient(135deg, #19af91, #16a085);
            border-radius: 2px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        label:hover::before {
            opacity: 1;
        }

        /* Input, Select, Textarea Styling */
        input, select, textarea {
            width: 100%;
            padding: 15px;
            margin-top: 8px;
            border: 2px solid rgba(25,175,145,0.2);
            border-radius: 12px;
            font-size: 15px;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(5px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: inherit;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #19af91;
            background: white;
            box-shadow: 0 0 20px rgba(25,175,145,0.2);
            transform: translateY(-2px);
        }

        /* File Input Special Styling */
        input[type="file"] {
            background: rgba(255,255,255,0.9);
            border: 2px dashed rgba(25,175,145,0.4);
            padding: 20px;
            text-align: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        input[type="file"]:hover {
            border-color: #19af91;
            background: rgba(25,175,145,0.05);
        }

        input[type="file"]:focus {
            border-style: solid;
        }

        /* Select Styling */
        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'><path fill='%2319af91' d='M2 0L0 2h4zm0 5L0 3h4z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 12px;
        }

        /* Textarea Styling */
        textarea {
            resize: vertical;
            min-height: 120px;
            font-family: inherit;
        }

        /* Button Styling */
        button {
            background: linear-gradient(135deg, #19af91, #16a085);
            color: white;
            padding: 18px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 6px 20px rgba(25,175,145,0.3);
            position: relative;
            overflow: hidden;
            margin-top: 25px;
        }
        
        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        button:hover::before {
            left: 100%;
        }
        
        button:hover {
            background: linear-gradient(135deg, #16a085, #1abc9c);
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(25,175,145,0.4);
        }
        
        button:active {
            transform: translateY(-1px);
        }

        /* Form Animation */
        .form-field {
            opacity: 0;
            transform: translateX(-20px);
            animation: fieldSlideIn 0.6s ease-out forwards;
        }

        @keyframes fieldSlideIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Progress Bar */
        .progress-bar {
            width: 100%;
            height: 4px;
            background: rgba(25,175,145,0.2);
            border-radius: 2px;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(90deg, #19af91, #16a085);
            border-radius: 2px;
            transition: width 0.3s ease;
            width: 0%;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                margin: 60px 15px 30px;
                padding: 30px 25px;
            }
            
            form {
                padding: 25px 20px;
            }
            
            h2 {
                font-size: 24px;
            }
            
            .back-btn {
                top: 15px;
                left: 15px;
                padding: 10px 16px;
            }

            .logo-title {
                font-size: 18px;
            }

            .logo-subtitle {
                font-size: 10px;
            }

            .logo-icon {
                width: 45px;
                height: 35px;
            }

            .logo-shape-1, .logo-shape-2 {
                width: 26px;
                height: 18px;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                margin: 50px 10px 20px;
                padding: 25px 20px;
            }
            
            form {
                padding: 20px 15px;
            }
            
            input, select, textarea, button {
                padding: 12px;
            }
            
            h2 {
                font-size: 22px;
            }

            .logo-title {
                font-size: 16px;
            }

            .logo-subtitle {
                font-size: 9px;
            }

            .logo-icon {
                width: 40px;
                height: 30px;
            }

            .logo-shape-1, .logo-shape-2 {
                width: 22px;
                height: 15px;
            }
        }

        /* Loading State */
        .loading {
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
    </style>
</head>
<body>

<!-- Enhanced Bubble Background -->
<div class="bubbles" id="bubbleContainer"></div>

<!-- Floating Particles -->
<div class="particles" id="particleContainer"></div>

<!-- Back Button -->
<a href="index.php" class="back-btn">← Kembali</a>

<div class="container">
    <img src="aset/logo.png" alt="Logo Perusahaan" class="logo" style="display: block;
        margin: 0 auto 15px;
        max-width: 120px;">

    <h2>Form Pengajuan Kerja Sama</h2>
    <p class="subtitle">Mari berkolaborasi untuk menciptakan solusi teknologi terbaik</p>

    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="progress" id="progressBar"></div>
    </div>

    <!-- Success/Error Message -->
    <?php if (!empty($success_message)): ?>
    <div class="msg success" id="successMsg">
        <?php echo $success_message; ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
    <div class="msg error" id="errorMsg">
        <?php echo $error_message; ?>
    </div>
    <?php endif; ?>

    <form id="partnershipForm" method="POST" enctype="multipart/form-data">
        <div class="form-field" style="animation-delay: 0.1s">
            <label for="nama_perusahaan">Nama Perusahaan:</label>
            <input type="text" name="nama_perusahaan" id="nama_perusahaan" placeholder="PT. Contoh Teknologi" value="<?php echo isset($_POST['nama_perusahaan']) ? htmlspecialchars($_POST['nama_perusahaan']) : ''; ?>" required>
        </div>

        <div class="form-field" style="animation-delay: 0.2s">
            <label for="nama_kontak">Nama Kontak:</label>
            <input type="text" name="nama_kontak" id="nama_kontak" placeholder="John Doe" value="<?php echo isset($_POST['nama_kontak']) ? htmlspecialchars($_POST['nama_kontak']) : ''; ?>" required>
        </div>

        <div class="form-field" style="animation-delay: 0.3s">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="john@example.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
        </div>

        <div class="form-field" style="animation-delay: 0.4s">
            <label for="telepon">Nomor Telepon:</label>
            <input type="text" name="telepon" id="telepon" placeholder="+62 812-3456-7890" value="<?php echo isset($_POST['telepon']) ? htmlspecialchars($_POST['telepon']) : ''; ?>" required>
        </div>

        <div class="form-field" style="animation-delay: 0.5s">
            <label for="jenis">Jenis Kerja Sama:</label>
            <select name="jenis" id="jenis" required>
                <option value="">-- Pilih Jenis Kerja Sama --</option>
                <option value="Web Development" <?php echo (isset($_POST['jenis']) && $_POST['jenis'] == 'Web Development') ? 'selected' : ''; ?>>Web Development</option>
                <option value="Android Apps" <?php echo (isset($_POST['jenis']) && $_POST['jenis'] == 'Android Apps') ? 'selected' : ''; ?>>Android Apps</option>
                <option value="iOS Apps" <?php echo (isset($_POST['jenis']) && $_POST['jenis'] == 'iOS Apps') ? 'selected' : ''; ?>>iOS Apps</option>
                <option value="IT Consultant" <?php echo (isset($_POST['jenis']) && $_POST['jenis'] == 'IT Consultant') ? 'selected' : ''; ?>>IT Consultant</option>
                <option value="AI & Machine Learning" <?php echo (isset($_POST['jenis']) && $_POST['jenis'] == 'AI & Machine Learning') ? 'selected' : ''; ?>>AI & Machine Learning</option>
                <option value="Digital Marketing" <?php echo (isset($_POST['jenis']) && $_POST['jenis'] == 'Digital Marketing') ? 'selected' : ''; ?>>Digital Marketing</option>
                <option value="UI/UX Design" <?php echo (isset($_POST['jenis']) && $_POST['jenis'] == 'UI/UX Design') ? 'selected' : ''; ?>>UI/UX Design</option>
                <option value="Lainnya" <?php echo (isset($_POST['jenis']) && $_POST['jenis'] == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
            </select>
        </div>

        <div class="form-field" style="animation-delay: 0.6s">
            <label for="proposal">Proposal / Dokumen (PDF/DOCX):</label>
            <input type="file" name="proposal" id="proposal" accept=".pdf,.doc,.docx" required>
        </div>

        <div class="form-field" style="animation-delay: 0.7s">
            <label for="deskripsi">Deskripsi Singkat Project:</label>
            <textarea name="deskripsi" id="deskripsi" rows="5" placeholder="Jelaskan secara singkat tentang project yang ingin dikerjakan, timeline, budget estimate, dan ekspektasi hasil..." required><?php echo isset($_POST['deskripsi']) ? htmlspecialchars($_POST['deskripsi']) : ''; ?></textarea>
        </div>

        <button type="submit" name="submit" id="submitBtn">
            Kirim Pengajuan
        </button>
    </form>
</div>

<script>
    // Dynamic Bubble Generation
    function createBubbles() {
        const bubbleContainer = document.getElementById('bubbleContainer');
        
        setInterval(() => {
            const bubble = document.createElement('div');
            bubble.className = 'bubble';
            
            const size = Math.random() * 60 + 20;
            const leftPos = Math.random() * 100;
            const duration = Math.random() * 15 + 10;
            
            bubble.style.left = leftPos + '%';
            bubble.style.width = size + 'px';
            bubble.style.height = size + 'px';
            bubble.style.animationDuration = duration + 's';
            
            bubbleContainer.appendChild(bubble);
            
            setTimeout(() => {
                bubble.remove();
            }, duration * 1000);
        }, 800);
    }

    // Dynamic Particle Generation
    function createParticles() {
        const particleContainer = document.getElementById('particleContainer');
        
        setInterval(() => {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            const size = Math.random() * 4 + 2;
            const leftPos = Math.random() * 100;
            const duration = Math.random() * 10 + 10;
            
            particle.style.left = leftPos + '%';
            particle.style.width = size + 'px';
            particle.style.height = size + 'px';
            particle.style.animationDuration = duration + 's';
            
            particleContainer.appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, duration * 1000);
        }, 1500);
    }

    // Progress Bar Update
    function updateProgress() {
        const formFields = document.querySelectorAll('input[required], select[required], textarea[required]');
        const progressBar = document.getElementById('progressBar');
        let filledFields = 0;

        formFields.forEach(field => {
            if (field.value.trim() !== '') {
                filledFields++;
            }
        });

        const progress = (filledFields / formFields.length) * 100;
        progressBar.style.width = progress + '%';
    }

    // Form Enhancement - Updated for PHP submission
    document.getElementById('partnershipForm').addEventListener('submit', function(e) {
        const button = document.getElementById('submitBtn');
        
        // Add loading state
        button.textContent = 'Mengirim...';
        button.classList.add('loading');
        button.disabled = true;
        
        // Form akan disubmit secara normal ke PHP
    });

    // Real-time progress tracking
    document.addEventListener('input', updateProgress);
    document.addEventListener('change', updateProgress);

    // File input enhancement
    document.getElementById('proposal').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const fileName = this.files[0].name;
            const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2);
            this.style.background = 'rgba(39,174,96,0.1)';
            this.style.borderColor = '#27ae60';
        }
    });

    // Initialize animations
    document.addEventListener('DOMContentLoaded', () => {
        createBubbles();
        createParticles();
        updateProgress();
        
        // Add smooth scrolling
        document.addEventListener('scroll', () => {
            const container = document.querySelector('.container');
            const scrolled = window.pageYOffset;
            container.style.transform = `translateY(${scrolled * 0.05}px)`;
        });

        // Form field focus animations
        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.parentElement.style.transition = 'transform 0.3s ease';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Auto-hide messages after 5 seconds
        const messages = document.querySelectorAll('.msg');
        messages.forEach(msg => {
            setTimeout(() => {
                msg.style.opacity = '0';
                setTimeout(() => {
                    msg.style.display = 'none';
                }, 300);
            }, 5000);
        });
    });

    // Phone number formatting
    document.getElementById('telepon').addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.startsWith('62')) {
            value = '+' + value;
        } else if (value.startsWith('0')) {
            value = '+62' + value.substring(1);
        }
        this.value = value;
    });
</script>

</body>
</html>