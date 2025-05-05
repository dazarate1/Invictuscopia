const axios = require("axios");
const readline = require("readline");

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout,
});

const processCode = async (code) => {
  try {
    const response = await axios.post("http://127.0.0.1:8000/api/validate-access", { code });

    if (response.data.access) {
      console.log("✅ Acceso permitido");

      const clientResponse = await axios.get(`http://127.0.0.1:8000/api/client/${code}`);
      const clientData = clientResponse.data;

      if (clientData.clases > 0) {
        let newValue = clientData.clases - 1;
        await axios.put(`http://127.0.0.1:8000/api/client/${code}`, { value: newValue });

        console.log(`🟢 Nuevo valor actualizado: ${newValue}`);

        await axios.post("http://127.0.0.1:8000/api/success-notification", {
          name: clientData.nombre,
          email: clientData.correo,
          clases: newValue,
        }, {
          timeout: 5000 // 🔹 5 segundos de espera máxima
        });
      } else {
        console.log("⚠️ El cliente ya no tiene clases disponibles.");
      }
    } else {
      console.log("❌ Acceso denegado");
    }
  } catch (error) {
    console.error("Error en la API:", error.response?.data || error.message);
  }
};

rl.question("🔹 Ingresa el código de acceso y presiona Enter: ", (code) => {
  processCode(code);
  rl.close();
});
