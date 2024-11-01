document.getElementById('register-btn').addEventListener('click', function() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (!username || !password) {
        alert('Please fill in both fields!');
        return;
    }

    fetch('register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            // Optionally clear the input fields after successful registration
            document.getElementById('username').value = '';
            document.getElementById('password').value = '';
        }
    })
    .catch(error => {
        console.error('Error during registration:', error);
        alert('An error occurred during registration. Please try again.');
    });
});

document.getElementById('login-btn').addEventListener('click', function() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (!username || !password) {
        alert('Please fill in both fields!');
        return;
    }

    fetch('login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message); // Show welcome message
            document.getElementById('auth-section').style.display = 'none';
            document.getElementById('game-section').style.display = 'block';
            document.getElementById('user-name').textContent = username;
            updateScore(data.userId);
        } else {
            alert(data.message); // Show error message
        }
    })
    .catch(error => {
        console.error('Error during login:', error);
        alert('An error occurred during login. Please try again.');
    });
});

function updateScore(userId) {
    let score = 0;
    document.getElementById('score-btn').addEventListener('click', function() {
        score++;
        document.getElementById('score').textContent = score;

        fetch('update_score.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ userId, score })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
        })
        .catch(error => {
            console.error('Error updating score:', error);
        });
    });
}
