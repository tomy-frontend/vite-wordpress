function animation() {
  console.log("animation loaded OK!");
  const toggleButton = document.querySelector(".js-toggle");

  toggleButton.addEventListener("click", () => {
    toggleButton.style.color = "red";
  });
}

export default animation;
