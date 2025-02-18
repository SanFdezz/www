fetch('/api/events/'+idEvento)
    .then((response) => response.json())
    .then((evento)=>{
        const contenedor = document.getElementById('contenedorEvento');
        const nombre = document.createElement('h2');
        nombre.textContent = evento.name;
        const ubicacion = document.createElement('h3');
        ubicacion.textContent = evento.location;
        const fechaHora = document.createElement('div');
        fechaHora.textContent = evento.hour;
        const tipo = document.createElement('div');
        tipo.textContent = evento.type;
        const descripcion = document.createElement('div');
        descripcion.textContent = evento.description;
        const contador = document.createElement('div');
        contador.className = 'contador';

        contenedor.appendChild(nombre);
        contenedor.appendChild(ubicacion);
        contenedor.appendChild(fechaHora);
        contenedor.appendChild(tipo);
        contenedor.appendChild(descripcion);
        contenedor.appendChild(contador);


        function actualizarContador() {
            const tiempo = new Date(evento.hour);
            const ahora = new Date();
            const diferencia = tiempo - ahora;

            if (diferencia > 0) {
                const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
                const horas = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
                const segundos = Math.floor((diferencia % (1000 * 60)) / 1000);

                contador.textContent = dias+' dias, '+horas+' horas, '+minutos+' minutos, '+segundos+' segundos.';

            } else {
                contador.textContent = "Se esta celebrando";
            }
        }


        setInterval(actualizarContador, 1000);
        actualizarContador();

        const botones = document.createElement('div');
        botones.className = 'botones';

        if(typeof userRole !== 'undefined'){
            const like = document.createElement('button');
            like.className = 'btn';
            if(localStorage.getItem(evento.id)){
                like.textContent = 'Quitar like';
            } else {
                like.textContent = 'Dar like';
            }
            botones.appendChild(like);
            like.addEventListener('click',()=>{
                let likeId = localStorage.getItem(evento.id);
                if (likeId) {
                    localStorage.removeItem(evento.id);
                    like.textContent = 'Dar like'
                } else {
                    localStorage.setItem(evento.id,'like');
                    like.textContent = 'Quitar like'
                }
            });
        }

        if(typeof userRole !== 'undefined'){
            if (userRole === 'admin') {
                const modificar = document.createElement('button');
                modificar.textContent = 'Modificar evento'
                modificar.id = 'modificar';
                modificar.className = 'btn';
                const eliminar = document.createElement('button');
                eliminar.textContent = 'Eliminar evento';
                eliminar.id = 'eliminar';
                eliminar.className = 'btn'
                botones.appendChild(modificar);
                botones.appendChild(eliminar);

                modificar.addEventListener('click',()=>{
                    window.location.href = eventRoute.replace(':id', evento.id);
                });

                eliminar.addEventListener('click',()=>{
                    let confirm = window.confirm('¿Seguro que quieres borrar el evento?');
                    if(confirm){
                        fetch('/api/events/'+evento.id, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('No se pudo eliminar el evento');
                            }
                            return response.json();
                        })
                        .then(() => {
                            window.location.href = allEventsRoute;
                        })
                        .catch(error => {
                            console.error("Error eliminando el evento:", error);
                            alert("Hubo un error al eliminar el evento.");
                        });
                    }
                })



            }
        }
        contenedor.appendChild(botones);
    })
