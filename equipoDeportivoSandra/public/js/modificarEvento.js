document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById('btn');

    btn.addEventListener('click', (event) => {
        event.preventDefault();

        const formData = {
            name: document.getElementById('name').value,
            description: document.getElementById('description').value,
            location: document.getElementById('location').value,
            date: document.getElementById('date').value,
            hour: document.getElementById('hour').value,
            type: document.getElementById('type').value,
            tags: document.getElementById('tags').value
        };

        fetch('/api/events/' + idEvento, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            alert('Evento actualizado con éxito!');
        })
        .catch(error => {
            console.error('No se ha podido actualizar', error);
        });
    });
});
