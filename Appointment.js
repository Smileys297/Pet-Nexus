document
  .getElementById("appointment-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("appointment.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        const confirmationMessage = `
        <p>Thank you, ${formData.get("ownerName")}!</p>
        <p>Your appointment for ${formData.get(
          "petName"
        )} has been scheduled for:</p>
        <p>Service: ${formData.get("service")}</p>
        <p>Date: ${formData.get("appointmentDate")}</p>
        <p>Time: ${formData.get("appointmentTime")}</p>
        <p>We will contact you at ${formData.get(
          "contact"
        )} for confirmation.</p>
      `;
        document.getElementById("confirmation").innerHTML = confirmationMessage;
        document.getElementById("appointment-form").reset();
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

document.querySelector(".back-btn").addEventListener("click", function () {
  window.location.href = "index2.php";
});
