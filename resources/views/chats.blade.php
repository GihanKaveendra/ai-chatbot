<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AI Chatbot - Laravel + OpenAI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">🤖 AI Chatbot</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="message" class="form-label">Type your question:</label>
                        <textarea id="message" class="form-control" rows="4" placeholder="e.g., How do I reset my password?"></textarea>
                    </div>
                    <button class="btn btn-success w-100" onclick="sendMessage()">Ask AI</button>

                    <hr>

                    <div>
                        <h6>Bot Response:</h6>
                        <div id="response" class="alert alert-secondary" style="min-height: 80px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function sendMessage() {
        const message = document.getElementById('message').value;
        if (!message.trim()) return;

        document.getElementById('response').innerHTML = 'Thinking...';

        axios.post('/chat', { message })
            .then(res => {
                document.getElementById('response').innerText = res.data;
            })
            .catch(err => {
                document.getElementById('response').innerText = 'Something went wrong. Please try again.';
                console.error(err);
            });
    }
</script>

</body>
</html>
