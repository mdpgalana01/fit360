// Esperamos a que el DOM esté cargado
document.addEventListener("DOMContentLoaded", () => {
  // --- REFERENCIAS A ELEMENTOS DEL DOM ---
  const emailInput = document.getElementById("email");
  const passInput = document.getElementById("password");
  const btnLogin = document.getElementById("btn-login");
  const togglePass = document.getElementById("toggle-pass");

  const emailError = document.getElementById("email-error");
  const passError = document.getElementById("password-error");

  // ============================================================
  // VALIDACIÓN DEL EMAIL EN TIEMPO REAL
  // ============================================================
  emailInput.addEventListener("input", () => {
    const email = emailInput.value.trim();
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // formato básico de email

    if (!regex.test(email)) {
      emailError.textContent = "Introduce un email válido";
      emailInput.style.borderColor = "#ff4444"; // rojo
    } else {
      emailError.textContent = "";
      emailInput.style.borderColor = "#28a745"; // verde
    }
  });

  // ============================================================
  // VALIDACIÓN DE CONTRASEÑA EN TIEMPO REAL
  // ============================================================
  passInput.addEventListener("input", () => {
    const pass = passInput.value.trim();

    if (pass.length < 6) {
      passError.textContent = "La contraseña debe tener al menos 6 caracteres";
      passInput.style.borderColor = "#ff4444";
    } else {
      passError.textContent = "";
      passInput.style.borderColor = "#28a745";
    }
  });

  // ============================================================
  // MOSTRAR / OCULTAR CONTRASEÑA
  // ============================================================
  togglePass.addEventListener("click", () => {
    if (passInput.type === "password") {
      passInput.type = "text";
      togglePass.textContent = "Ocultar";
    } else {
      passInput.type = "password";
      togglePass.textContent = "Mostrar";
    }
  });

  // ============================================================
  // ENVÍO REAL DEL FORMULARIO + ANIMACIÓN "PROCESANDO..."
  // ============================================================
  const form = document.querySelector(".login-form");

  form.addEventListener("submit", (e) => {
    // Si hay errores visibles, NO enviamos el formulario
    if (emailError.textContent !== "" || passError.textContent !== "") {
      e.preventDefault();
      return;
    }

    // Si todo está correcto → animación de carga
    btnLogin.textContent = "Procesando...";
    btnLogin.disabled = true;
    btnLogin.style.opacity = "0.6";

    // Aquí NO hacemos preventDefault → el formulario se envía de verdad
  });
});
