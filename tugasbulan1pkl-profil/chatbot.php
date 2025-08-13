<?php
session_start();

// Hapus chat history setiap kali halaman dimuat ulang (bukan dari AJAX)
if (!isset($_GET['ajax']) && !isset($_POST['message'])) {
    unset($_SESSION['chat_history']);
}

if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
}

// Handle AJAX request
if (isset($_GET['ajax']) && isset($_POST['message'])) {
    $msg = strtolower(trim($_POST['message']));

    $qa = [
        'halo' => "Halo! Selamat datang di website kami. Ada yang bisa saya bantu?",
        'hallo' => "Halo! Selamat datang di website kami. Ada yang bisa saya bantu?",
        'hi' => "Halo! Selamat datang di website kami. Ada yang bisa saya bantu?",
        'p' => "Halo! Selamat datang di website kami. Ada yang bisa saya bantu?",
        'produk' => "Kami menyediakan berbagai produk berkualitas tinggi. Silakan kunjungi halaman produk kami.",
        'layanan' => "Layanan kami meliputi konsultasi, implementasi, dan support teknis 24/7.",
        'harga' => "Untuk informasi harga terbaru, silakan hubungi tim sales kami melalui kontak yang tersedia.",
        'kontak' => "Anda bisa menghubungi kami melalui email: info@perusahaan.com atau telepon: (021) 1234-5678",
        'alamat' => "Kantor pusat kami berlokasi di Jakarta Pusat. Alamat lengkap ada di halaman kontak.",
        'jam kerja' => "Jam operasional kami: Senin-Jumat 08:00-17:00, Sabtu 09:00-15:00.",
        'terima kasih' => "Sama-sama! Senang bisa membantu Anda.",
        'faq' => "Untuk FAQ lengkap, silakan kunjungi halaman FAQ di website kami.",
    ];

    $found = false;
    foreach ($qa as $question => $answer) {
        if (strpos($msg, $question) !== false) {
            $reply = $answer;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $reply = "Maaf, saya belum mengerti pertanyaanmu. Bisa ulangi dengan kata lain?";
    }

    $_SESSION['chat_history'][] = ['user' => $_POST['message'], 'bot' => $reply];

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'bot_message' => $reply
    ]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Professional Chatbot Assistant</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        height: 100vh;
        overflow: hidden;
        position: relative;
        background: linear-gradient(135deg, #1abc9c 0%, #16a085 50%, #f1c40f 100%);
        background-size: 400% 400%;
        animation: gradientShift 8s ease infinite;
    }

    /* Animated Background */
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Floating particles */
    .particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
    }

    .particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .particle:nth-child(1) {
        width: 80px;
        height: 80px;
        left: 10%;
        animation-delay: 0s;
        animation-duration: 6s;
    }

    .particle:nth-child(2) {
        width: 60px;
        height: 60px;
        left: 80%;
        animation-delay: 2s;
        animation-duration: 8s;
    }

    .particle:nth-child(3) {
        width: 40px;
        height: 40px;
        left: 60%;
        animation-delay: 4s;
        animation-duration: 7s;
    }

    .particle:nth-child(4) {
        width: 100px;
        height: 100px;
        left: 30%;
        animation-delay: 1s;
        animation-duration: 9s;
    }

    .particle:nth-child(5) {
        width: 50px;
        height: 50px;
        left: 90%;
        animation-delay: 3s;
        animation-duration: 5s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(100vh) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        50% {
            transform: translateY(-10vh) rotate(180deg);
            opacity: 0.7;
        }
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        padding: 20px;
        position: relative;
        z-index: 10;
    }

    .btn-back {
        position: fixed;
        top: 25px;
        left: 25px;
        background: rgba(255, 215, 0, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 12px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .btn-back svg {
        width: 18px;
        height: 18px;
        fill: white;
    }

    .chat-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        width: 450px;
        max-width: 95vw;
        border-radius: 24px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        display: flex;
        flex-direction: column;
        height: 650px;
        overflow: hidden;
        position: relative;
        animation: slideUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chat-header {
        background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
        color: white;
        padding: 25px 30px;
        font-weight: 700;
        font-size: 1.4rem;
        position: relative;
        overflow: hidden;
    }

    .chat-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .chat-header-subtitle {
        font-size: 0.9rem;
        font-weight: 400;
        opacity: 0.9;
        margin-top: 5px;
    }

    .chat-body {
        flex-grow: 1;
        padding: 20px;
        overflow-y: auto;
        background: rgba(248, 250, 252, 0.8);
        position: relative;
    }

    .chat-message {
        display: flex;
        margin-bottom: 16px;
        max-width: 85%;
        animation: messageSlide 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes messageSlide {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chat-message.user {
        justify-content: flex-end;
        margin-left: auto;
    }

    .chat-message.bot {
        justify-content: flex-start;
    }

    .chat-message .bubble {
        padding: 14px 18px;
        border-radius: 20px;
        font-size: 0.95rem;
        line-height: 1.5;
        white-space: pre-wrap;
        word-wrap: break-word;
        max-width: 100%;
        position: relative;
        font-weight: 400;
    }

    .chat-message.user .bubble {
        background: linear-gradient(135deg, #f1c40f 0%, #f39c12 100%);
        color: #2c3e50;
        border-bottom-right-radius: 4px;
        box-shadow: 0 4px 20px rgba(241, 196, 15, 0.3);
        font-weight: 500;
    }

    .chat-message.bot .bubble {
        background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
        color: white;
        border-bottom-left-radius: 4px;
        box-shadow: 0 4px 20px rgba(26, 188, 156, 0.3);
    }

    .chat-input-area {
        display: flex;
        padding: 20px 25px 25px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        align-items: center;
        gap: 12px;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .chat-input-area input[type="text"] {
        flex-grow: 1;
        padding: 16px 20px;
        font-size: 0.95rem;
        border-radius: 50px;
        border: 2px solid rgba(26, 188, 156, 0.2);
        outline: none;
        background: rgba(255, 255, 255, 0.8);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-family: 'Inter', sans-serif;
    }

    .chat-input-area input[type="text"]:focus {
        border-color: #1abc9c;
        background: white;
        box-shadow: 0 0 0 3px rgba(26, 188, 156, 0.1);
        transform: translateY(-1px);
    }

    .chat-input-area input[type="text"]:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .chat-input-area button {
        background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
        border: none;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 16px 24px;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(26, 188, 156, 0.3);
        font-family: 'Inter', sans-serif;
    }

    .chat-input-area button:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26, 188, 156, 0.4);
        background: linear-gradient(135deg, #16a085 0%, #1abc9c 100%);
    }

    .chat-input-area button:active {
        transform: translateY(0);
    }

    .chat-input-area button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Custom Scrollbar */
    .chat-body::-webkit-scrollbar {
        width: 6px;
    }

    .chat-body::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05);
        border-radius: 10px;
    }

    .chat-body::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #1abc9c, #f1c40f);
        border-radius: 10px;
    }

    .chat-body::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #16a085, #f39c12);
    }

    /* Welcome message */
    .welcome-message {
        text-align: center;
        margin-top: 50px;
        color: #7f8c8d;
        font-size: 1rem;
        padding: 20px;
    }

    .welcome-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #1abc9c;
    }

    /* Typing indicator */
    .typing-indicator {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-bottom: 16px;
        max-width: 85%;
        animation: messageSlide 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .typing-bubble {
        background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
        color: white;
        padding: 14px 18px;
        border-radius: 20px;
        border-bottom-left-radius: 4px;
        box-shadow: 0 4px 20px rgba(26, 188, 156, 0.3);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .typing-dots {
        display: flex;
        gap: 4px;
        align-items: center;
    }

    .typing-dots span {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.7);
        animation: typingAnimation 1.4s infinite ease-in-out;
    }

    .typing-dots span:nth-child(1) { animation-delay: 0s; }
    .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
    .typing-dots span:nth-child(3) { animation-delay: 0.4s; }

    @keyframes typingAnimation {
        0%, 60%, 100% {
            transform: translateY(0);
            opacity: 0.4;
        }
        30% {
            transform: translateY(-10px);
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-width: 480px) {
        .chat-container {
            width: 95vw;
            height: 90vh;
            border-radius: 20px;
        }
        
        .btn-back {
            top: 15px;
            left: 15px;
            padding: 10px 16px;
            font-size: 0.85rem;
        }
        
        .chat-header {
            padding: 20px 25px;
            font-size: 1.25rem;
        }
        
        .chat-input-area {
            padding: 15px 20px 20px;
        }
        
        .chat-input-area input[type="text"] {
            padding: 14px 18px;
            font-size: 0.9rem;
        }
        
        .chat-input-area button {
            padding: 14px 20px;
            font-size: 0.85rem;
        }
    }
</style>
</head>
<body>

<!-- Animated particles -->
<div class="particles">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
</div>

<!-- Back button -->
<a href="javascript:history.back()" class="btn-back" title="Kembali ke halaman sebelumnya">
    <svg viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
    Kembali
</a>

<div class="container">
    <div class="chat-container" id="chat-container">
        <div class="chat-header">
            <img src="aset/logo.png" alt="Logo Perusahaan" class="logo" style="display: block; margin-top: none; transform: translateY(-8px); max-width: 100px;">
        </div>
        
        <div class="chat-body" id="chat-body">
            <?php if (empty($_SESSION['chat_history'])): ?>
                <div class="welcome-message">
                    <div class="welcome-icon">🤖</div>
                    <strong>Selamat datang!</strong><br>
                    Saya adalah asisten virtual Anda.<br>
                    Silakan mulai percakapan dengan mengetik pesan di bawah.
                </div>
            <?php else: ?>
                <?php foreach ($_SESSION['chat_history'] as $chat): ?>
                    <div class="chat-message user">
                        <div class="bubble"><?= htmlspecialchars($chat['user']) ?></div>
                    </div>
                    <div class="chat-message bot">
                        <div class="bubble"><?= nl2br(htmlspecialchars($chat['bot'])) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <form id="chat-form" class="chat-input-area" autocomplete="off">
            <input type="text" name="message" id="message" placeholder="Ketik pesan Anda di sini..." required autofocus />
            <button type="submit" id="send-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z" />
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
    const chatBody = document.getElementById('chat-body');
    const messageInput = document.getElementById('message');
    const sendBtn = document.getElementById('send-btn');
    const chatForm = document.getElementById('chat-form');
    
    function scrollToBottom() {
        setTimeout(() => {
            chatBody.scrollTop = chatBody.scrollHeight;
        }, 100);
    }
    
    function createUserMessage(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'chat-message user';
        messageDiv.innerHTML = `<div class="bubble">${escapeHtml(message)}</div>`;
        return messageDiv;
    }
    
    function createBotMessage(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'chat-message bot';
        messageDiv.innerHTML = `<div class="bubble">${escapeHtml(message)}</div>`;
        return messageDiv;
    }
    
    function createTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'typing-indicator';
        typingDiv.id = 'typing-indicator';
        typingDiv.innerHTML = `
            <div class="typing-bubble">
                <div class="typing-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        `;
        return typingDiv;
    }
    
    function showTypingIndicator() {
        const existingIndicator = document.getElementById('typing-indicator');
        if (!existingIndicator) {
            const typingIndicator = createTypingIndicator();
            chatBody.appendChild(typingIndicator);
            scrollToBottom();
        }
    }
    
    function hideTypingIndicator() {
        const typingIndicator = document.getElementById('typing-indicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }
    
    function typeWriter(element, text, speed = 40) {
        return new Promise((resolve) => {
            const bubble = element.querySelector('.bubble');
            bubble.textContent = '';
            let i = 0;
            
            function type() {
                if (i < text.length) {
                    bubble.textContent += text.charAt(i);
                    i++;
                    scrollToBottom();
                    setTimeout(type, speed);
                } else {
                    resolve();
                }
            }
            
            type();
        });
    }
    
    function disableInput() {
        messageInput.disabled = true;
        sendBtn.disabled = true;
    }
    
    function enableInput() {
        messageInput.disabled = false;
        sendBtn.disabled = false;
        messageInput.focus();
    }
    
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }
    
    async function handleFormSubmit(e) {
        e.preventDefault();
        
        const message = messageInput.value.trim();
        if (!message) return;
        
        // Clear welcome message if exists
        const welcomeMessage = document.querySelector('.welcome-message');
        if (welcomeMessage) {
            welcomeMessage.remove();
        }
        
        // Add user message
        const userMessage = createUserMessage(message);
        chatBody.appendChild(userMessage);
        scrollToBottom();
        
        // Clear input and disable
        messageInput.value = '';
        disableInput();
        
        // Show typing indicator
        showTypingIndicator();
        
        try {
            // Send AJAX request
            const formData = new FormData();
            formData.append('message', message);
            
            const response = await fetch('?ajax=1', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            // Wait for realistic typing delay (1-3 seconds based on message length)
            const typingDelay = Math.min(Math.max(1000, message.length * 50), 3000);
            await new Promise(resolve => setTimeout(resolve, typingDelay));
            
            // Hide typing indicator
            hideTypingIndicator();
            
            if (data.success) {
                // Add bot message with typing effect
                const botMessage = createBotMessage(data.bot_message);
                chatBody.appendChild(botMessage);
                scrollToBottom();
                
                // Type out the bot message
                await typeWriter(botMessage, data.bot_message, 40);
            } else {
                throw new Error('Server error');
            }
        } catch (error) {
            console.error('Error:', error);
            hideTypingIndicator();
            
            const errorMessage = createBotMessage('Maaf, terjadi kesalahan. Silakan coba lagi.');
            chatBody.appendChild(errorMessage);
            await typeWriter(errorMessage, 'Maaf, terjadi kesalahan. Silakan coba lagi.', 40);
        } finally {
            enableInput();
            scrollToBottom();
        }
    }
    
    // Event listeners
    chatForm.addEventListener('submit', handleFormSubmit);
    
    // Enter key handling
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            handleFormSubmit(e);
        }
    });
    
    // Auto-resize input
    messageInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });
    
    // Initialize
    window.onload = function() {
        scrollToBottom();
        messageInput.focus();
    };
</script>

</body>
</html>