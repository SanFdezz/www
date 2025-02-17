fetch('/api/events') // Petición a la ruta de Laravel
    .then(response => response.json())
    .then((data) => {
        const contenedor = document.getElementById('contenedorEventos');
        data.forEach(infoEvento => {
            const evento = document.createElement('div');
            evento.className = 'evento';
            evento.id = infoEvento.id;
            const nombre = document.createElement('h2');
            nombre.textContent = infoEvento.name;
            const fechaYhora = document.createElement('div');
            fechaYhora.textContent = infoEvento.hour;
            const donde = document.createElement('div');
            donde.textContent = infoEvento.location;

            evento.appendChild(nombre);
            evento.appendChild(fechaYhora);
            evento.appendChild(donde);

            const botones = document.createElement('div');
            if(typeof userRole !== 'undefined'){
                const like = document.createElement('button');
                if(localStorage.getItem(infoEvento.id)){
                    like.textContent = 'Quitar like';
                } else {
                    like.textContent = 'Dar like';
                }
                botones.appendChild(like);
                like.addEventListener('click',()=>{
                    let likeId = localStorage.getItem(infoEvento.id);
                    if (likeId) {
                        localStorage.removeItem(infoEvento.id);
                        like.textContent = 'Dar like'
                    } else {
                        localStorage.setItem(infoEvento.id,'like');
                        like.textContent = 'Quitar like'
                    }
                });
            }

            if(typeof userRole !== 'undefined'){
                if (userRole === 'admin') {
                    const modificar = document.createElement('button');
                    modificar.textContent = 'Modificar evento'
                    modificar.id = 'modificar';
                    const eliminar = document.createElement('button');
                    eliminar.textContent = 'Eliminar evento';
                    eliminar.id = 'eliminar';
                    botones.appendChild(modificar);
                    botones.appendChild(eliminar);
                }
            }

            contenedor.appendChild(evento);
            contenedor.appendChild(botones);

            evento.addEventListener('click', () => {
                window.location.href = eventRoute.replace(':id', infoEvento.id);
            });
        });
    });
