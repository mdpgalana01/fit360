document.addEventListener("DOMContentLoaded", () => {
  const progressBar = document.getElementById("loading-progress");
  const percentText = document.getElementById("loading-percent");
  const loadingScreen = document.getElementById("loading-screen");

  let progress = 0;

  // Simulación de carga progresiva
  const interval = setInterval(() => {
    progress += Math.floor(Math.random() * 8) + 3; // avance entre 3% y 10%

    if (progress > 100) progress = 100;

    progressBar.style.width = progress + "%";
    percentText.textContent = progress + "%";

    if (progress === 100) {
      clearInterval(interval);

      // Espera breve para suavidad
      setTimeout(() => {
        loadingScreen.style.opacity = "0";
        loadingScreen.style.transition = "opacity 0.6s ease";

        setTimeout(() => {
          loadingScreen.style.display = "none";
        }, 600);
      }, 300);
    }
  }, 120);
});
