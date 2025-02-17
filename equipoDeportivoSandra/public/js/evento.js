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

        // CREAR EL CONTADOR !!!!!!!!!

        contenedor.appendChild(nombre);
        contenedor.appendChild(ubicacion);
        contenedor.appendChild(fechaHora);
        contenedor.appendChild(tipo);
        contenedor.appendChild(descripcion);

        if(typeof userRole !== 'undefined'){
            const like = document.createElement('button');
            if(localStorage.getItem(evento.id)){
                like.textContent = 'Quitar like';
            } else {
                like.textContent = 'Dar like';
            }
            contenedor.appendChild(like);
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
                const eliminar = document.createElement('button');
                eliminar.textContent = 'Eliminar evento';
                eliminar.id = 'eliminar';
                contenedor.appendChild(modificar);
                contenedor.appendChild(eliminar);

                modificar.addEventListener('click',()=>{
                    console.log(eventRoute);
                    window.location.href = eventRoute.replace(':id', evento.id);
                });


            }
        }
    })
