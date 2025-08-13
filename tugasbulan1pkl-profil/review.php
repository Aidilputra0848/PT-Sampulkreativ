<?php
// === Koneksi ke Database ===
$host = "localhost";
$user = "root"; // Default Laragon
$pass = "";
$db   = "perusahaan";
$conn = new mysqli($host, $user, $pass, $db);

// === Simpan Review Baru ===
if (isset($_POST['submit'])) {
    $nama     = $conn->real_escape_string($_POST['nama']);
    $rating   = (int) $_POST['rating'];
    $komentar = $conn->real_escape_string($_POST['komentar']);

    if ($rating > 0 && $rating <= 5) {
        $conn->query("INSERT INTO reviews (nama, rating, komentar) VALUES ('$nama', $rating, '$komentar')");
    }
}

// === Ambil Maksimal 6 Review Terbaru ===
$result = $conn->query("SELECT * FROM reviews ORDER BY tanggal DESC LIMIT 6");

// === Hitung Rata-rata Rating ===
$avgQuery  = $conn->query("SELECT AVG(rating) as avg_rating FROM reviews");
$avgData   = $avgQuery->fetch_assoc();
$avgRating = round($avgData['avg_rating'], 1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Rating & Review Perusahaan</title>
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
        background: linear-gradient(135deg, #1abc9c, #19af91ff);
        overflow-x: hidden;
        position: relative;
        min-height: 100vh;
    }

    /* Background Bubble */
    .bubbles {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        overflow: hidden;
        z-index: -1;
    }
    .bubbles span {
        position: absolute;
        bottom: -50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        animation: rise 20s infinite ease-in;
    }
    @keyframes rise {
        0% { transform: translateY(0) scale(1); opacity: 1; }
        100% { transform: translateY(-1200px) scale(0.5); opacity: 0; }
    }

    /* Tombol Back Floating */
    .back-btn {
        position: fixed;
        top: 20px;
        left: 20px;
        background: white;
        color: #000000ff;
        padding: 10px 18px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        transition: all 0.3s ease;
        z-index: 100;
    }
    .back-btn:hover {
        background: #f8f8f8;
        transform: translateY(-3px) scale(1.05);
    }

    /* Container */
    .container {
        max-width: 750px;
        margin: 80px auto 30px; /* supaya container turun sedikit */
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    /* Logo */
    .logo {
        display: block;
        margin: 0 auto 15px;
        max-width: 120px;
    }

    /* Judul & Rating */
    h1, h2 {
        text-align: center;
        color: #333;
    }
    .avg-rating {
        text-align: center;
        font-size: 22px;
        margin-bottom: 25px;
        font-weight: bold;
        color: #ffb400;
    }

    /* Form */
    form {
        margin-bottom: 35px;
    }
    input, textarea {
        width: 100%;
        padding: 12px;
        margin-top: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        transition: all 0.3s ease;
        font-size: 14px;
    }
    input:focus, textarea:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0,123,255,0.3);
        outline: none;
    }

    /* Stars */
    .stars {
        display: flex;
        justify-content: center;
        gap: 8px;
        font-size: 30px;
        margin: 15px 0;
        cursor: pointer;
    }
    .stars span {
        color: #ccc;
        transition: color 0.2s, transform 0.2s;
    }
    .stars span:hover {
        transform: scale(1.2);
    }
    .stars span.active {
        color: #ffb400;
    }

    /* Button Kirim */
    button {
        background: linear-gradient(90deg, #ffb400, #19af91ff);
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    button:hover {
        background: linear-gradient(90deg, #d29402ff, #003f80);
        transform: translateY(-2px);
    }

    /* Review */
    .review {
        border-bottom: 1px solid #eee;
        padding: 15px 0;
    }
    .review:last-child {
        border-bottom: none;
    }
    .review strong {
        color: #333;
    }
    .review small {
        color: #888;
        font-size: 12px;
    }
    .review p {
        margin: 8px 0 0;
        font-size: 14px;
        color: #555;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .container {
            padding: 15px;
        }
        .stars {
            font-size: 24px;
        }
        .logo {
            max-width: 90px;
        }
    }
</style>
</head>
<body>

<!-- Bubble Background -->
<div class="bubbles">
    <?php for ($i=0; $i<20; $i++): ?>
        <span style="
            left: <?= rand(0, 100) ?>%;
            width: <?= $size = rand(20, 80) ?>px;
            height: <?= $size ?>px;
            animation-duration: <?= rand(10, 30) ?>s;
            animation-delay: <?= rand(0, 20) ?>s;
        "></span>
    <?php endfor; ?>
</div>

<!-- Tombol Kembali Floating -->
<a href="index.php" class="back-btn">← Kembali</a>

<div class="container">
    <img src="aset/logo.png" alt="Logo Perusahaan" class="logo">

    <h1>Rating & Review</h1>
    <div class="avg-rating">⭐ <?= $avgRating ?: 0 ?>/5</div>

    <!-- Form -->
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Anda" required>

        <div class="stars" id="starContainer">
            <span data-value="1">&#9733;</span>
            <span data-value="2">&#9733;</span>
            <span data-value="3">&#9733;</span>
            <span data-value="4">&#9733;</span>
            <span data-value="5">&#9733;</span>
        </div>
        <input type="hidden" name="rating" id="ratingValue" required>

        <textarea name="komentar" placeholder="Tulis komentar..." rows="4" required></textarea>
        <button type="submit" name="submit">Kirim Review</button>
    </form>

    <h2>Review Terbaru</h2>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="review">
            <strong><?= htmlspecialchars($row['nama']) ?></strong> - <?= str_repeat("⭐", $row['rating']) ?>
            <p><?= nl2br(htmlspecialchars($row['komentar'])) ?></p>
            <small><?= $row['tanggal'] ?></small>
        </div>
    <?php endwhile; ?>
</div>

<script>
    const stars = document.querySelectorAll('#starContainer span');
    const ratingValue = document.getElementById('ratingValue');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            let value = star.getAttribute('data-value');
            ratingValue.value = value;
            updateStars(value);
        });

        star.addEventListener('mouseover', () => {
            updateStars(star.getAttribute('data-value'));
        });

        star.addEventListener('mouseout', () => {
            updateStars(ratingValue.value);
        });
    });

    function updateStars(value) {
        stars.forEach(s => s.classList.remove('active'));
        for (let i = 0; i < value; i++) {
            stars[i].classList.add('active');
        }
    }
</script>

</body>
</html>
