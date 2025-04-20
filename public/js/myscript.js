$(document).ready(function () {
    $('#myTable').DataTable();
});

setInterval(() => {
    const now = new Date();
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    };
    document.getElementById('currentDateTime').textContent = now.toLocaleDateString('en-US', options);
}, 1000);

function checkInput() {
    const productSku = document.getElementById('input').value;
    const link = document.getElementById('input').getAttribute('data-link');
    if (productSku) {
        // Perform an AJAX request to check username availability
        fetch(link, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                productSku: productSku
            }),
        })
            .then(response => {
                console.log('Response:', response);
                return response.json();
            })
            .then(data => {
                console.log('Data:', data);
                if (data.status === 'available') {
                    alert(`Username "${productSku}" is available!`);
                    document.getElementById('input').classList.add('is-valid');
                    document.getElementById('input').classList.remove('is-invalid');
                } else if (data.status === 'exists') {
                    alert(`Username "${productSku}" is already taken.`);
                    document.getElementById('input').classList.add('is-invalid');
                    document.getElementById('input').classList.remove('is-valid');
                } else {
                    alert('Unexpected response from the server.');
                    document.getElementById('input').classList.remove('is-valid', 'is-invalid');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while checking the username.');
            });
    } else {
        alert('Please enter a username to check.');
    }
}

function validateForm() {
    const input = document.getElementById('input');
    const description = document.getElementById('input').getAttribute('data-description');

    if (!input.classList.contains('is-valid')) {
        alert(`Please check the '${description}' availability first and ensure it is available.`);
        return false;
    }
}

