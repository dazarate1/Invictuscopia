<div id="modal" class="modal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); width: 300px; text-align: center;">
    <div class="modal-header">Acceso Permitido</div>
    <div class="modal-body">
        <p><strong>Nombre:</strong> <span id="client-name"></span></p>
        <p><strong>Email:</strong> <span id="client-email"></span></p>
        <p><strong>Clases Restantes:</strong> <span id="client-clases"></span></p>
    </div>
    <div class="modal-footer">Se cerrará en 3 segundos...</div>
</div>

<script>
    function checkNotification() {
        axios.get("http://127.0.0.1:8000/api/check-notification")
            .then(response => {
                if (response.data.client) {
                    const client = response.data.client;
                    document.getElementById("client-name").innerText = client.name;
                    document.getElementById("client-email").innerText = client.email;
                    document.getElementById("client-clases").innerText = client.clases;
                    
                    const modal = document.getElementById("modal");
                    modal.style.display = "block";

                    setTimeout(() => {
                        modal.style.display = "none";
                    }, 5000);
                }
            })
            .catch(error => console.error("Error al verificar la notificación:", error));
    }

    setInterval(checkNotification, 2000);
</script>
