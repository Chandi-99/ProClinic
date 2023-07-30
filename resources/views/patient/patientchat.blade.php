
@extends('layouts.app')
@section('content')
<div class="chat-container" style="width:50%;">
    <div class="chat-log" id="chatLog">
        <div class="chat-message bot-message">Hello! How can I help you today?</div>
    </div>
    <div class="chat-input">
        <input type="text" class="textbox" id="userInput" placeholder="Type your message...">
        <button id="sendButton" class="sendButton">Send</button>
    </div>
</div>

<script src="script.js">
    document.addEventListener("DOMContentLoaded", function() {
        const chatLog = document.getElementById("chatLog");
        const userInput = document.getElementById("userInput");
        const sendButton = document.getElementById("sendButton");

        sendButton.addEventListener("click", sendMessage);
        userInput.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                sendMessage();
            }
        });

        function sendMessage() {
            const userMessage = userInput.value;
            if (userMessage.trim() === "") return;

            appendMessage(userMessage, "user-message");
            userInput.value = "";

            // Call your chatbot API or processing function here
            // Replace the botReply with the actual response from your chatbot
            const botReply = "Sorry, I'm just a simple chatbot and can't provide real answers yet!";
            setTimeout(() => appendMessage(botReply, "bot-message"), 500);
        }

        function appendMessage(message, messageType) {
            const messageDiv = document.createElement("div");
            messageDiv.classList.add("chat-message", messageType);
            messageDiv.innerText = message;
            chatLog.appendChild(messageDiv);
            chatLog.scrollTop = chatLog.scrollHeight;
        }
    });
</script>
@endsection