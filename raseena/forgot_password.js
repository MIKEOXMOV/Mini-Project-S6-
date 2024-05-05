document.getElementById("resetPasswordForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    var formData = new FormData(this);
    
    fetch('forgot_password.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      var messageElement = document.getElementById("message");
      messageElement.textContent = data.message;
      if (data.success) {
        messageElement.style.color = "green";
      } else {
        messageElement.style.color = "red";
      }
      messageElement.style.display = "block";
    })
    .catch(error => {
      console.error('Error:', error);
    });
  });
  