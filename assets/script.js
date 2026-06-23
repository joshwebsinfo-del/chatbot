$(document).ready(function() {
    const chatContainer = $('#chatbot-container');
    const chatTrigger = $('#chatbot-trigger');
    const closeChat = $('#close-chat');
    const chatBody = $('#chatbot-body');
    const chatForm = $('#chat-form');
    const userInput = $('#user-input');

    // Toggle chat
    chatTrigger.click(function() {
        chatContainer.removeClass('d-none');
        chatTrigger.addClass('d-none');
        userInput.focus();
        scrollToBottom();
    });

    closeChat.click(function() {
        chatContainer.addClass('d-none');
        chatTrigger.removeClass('d-none');
    });

    // Make openChat globally available for the hero button
    window.openChat = function() {
        chatTrigger.click();
    };

    // Handle Quick Action Buttons
    $('.chat-quick-btn').click(function() {
        const query = $(this).data('query');
        userInput.val(query);
        chatForm.submit();
        $(this).parent('.quick-replies').fadeOut(300); // Hide them after click
    });

    function scrollToBottom() {
        chatBody.scrollTop(chatBody[0].scrollHeight);
    }

    function appendMessage(sender, text) {
        const isUser = sender === 'user';
        const msgClass = isUser ? 'user-message' : 'bot-message';
        
        let avatarHtml = '';
        if (!isUser) {
            avatarHtml = `<div class="bot-avatar"><i class="fas fa-robot"></i></div>`;
        }
        
        const html = `
            <div class="${msgClass} d-flex mb-3 align-items-end" style="animation: fadeIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                ${avatarHtml}
                <div class="message-content p-3" style="max-width: 80%; font-size: 0.95rem; line-height: 1.5;">
                    ${isUser ? escapeHtml(text) : text} 
                </div>
            </div>
        `;
        chatBody.append(html);
        scrollToBottom();
    }
    
    // Convert new lines to <br> for better display of answers from DB (though DB might just have plain string without HTML)
    
    // Add typing indicator
    function showTyping() {
        const html = `
            <div class="bot-message typing-indicator d-flex mb-3 align-items-end" style="animation: fadeIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                <div class="bot-avatar"><i class="fas fa-robot"></i></div>
                <div class="message-content p-3 d-flex align-items-center shadow-sm" style="max-width: 80%;">
                    <div class="spinner-grow spinner-grow-sm text-primary opacity-50 me-1" role="status" style="width: 0.4rem; height: 0.4rem;"></div>
                    <div class="spinner-grow spinner-grow-sm text-primary opacity-50 me-1" role="status" style="width: 0.4rem; height: 0.4rem; animation-delay: 0.2s;"></div>
                    <div class="spinner-grow spinner-grow-sm text-primary opacity-50" role="status" style="width: 0.4rem; height: 0.4rem; animation-delay: 0.4s;"></div>
                </div>
            </div>
        `;
        chatBody.append(html);
        scrollToBottom();
    }
    
    function removeTyping() {
        $('.typing-indicator').remove();
    }

    // Escape HTML to prevent XSS (only on user input)
    function escapeHtml(text) {
        return text
             .replace(/&/g, "&amp;")
             .replace(/</g, "&lt;")
             .replace(/>/g, "&gt;")
             .replace(/"/g, "&quot;")
             .replace(/'/g, "&#039;");
    }

    // Add CSS rule for fadeIn animation
    $("<style>").text(`
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `).appendTo("head");

    chatForm.submit(function(e) {
        e.preventDefault();
        
        const question = userInput.val().trim();
        if (question === '') return;

        // Display user message
        appendMessage('user', question);
        userInput.val('');
        
        showTyping();

        // Send to backend
        $.ajax({
            url: 'chatbot.php',
            type: 'POST',
            data: { question: question },
            success: function(response) {
                // simple timeout to make it feel natural
                setTimeout(function() {
                    removeTyping();
                    appendMessage('bot', response);
                }, 600);
            },
            error: function() {
                setTimeout(function() {
                    removeTyping();
                    appendMessage('bot', "Sorry, I am facing a technical issue right now. Please try again later.");
                }, 600);
            }
        });
    });
});
